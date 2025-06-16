<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\News;
use App\Models\Location;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $news = News::all();
        return view('backend.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $location=Location::all();
         $categories = Category::all();
    $subcategories = SubCategory::all();
    return view('backend.news.create', compact('categories', 'subcategories','location'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'meta_keywords' => 'nullable|string',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image
            'author' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ]);

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/news'), $imageName);
            $imagePath = 'uploads/news/' . $imageName;
        }

        News::create([
            'title' => $request->title,
            'author_name' => $request->author ,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'description' => $request->content, // map content to description
            'video' => $request->video,
            'slug' => \Str::slug($request->title),
            'TopLead' => $request->top_lead,
            'meta_keywords' => $request->meta_keywords,
            'image' => $imagePath, // Save the image path
            'lead_news' => $request->lead_news,
             'location' => $request->location,
        ]);

        return redirect()->route('news.index')->with('success', 'News created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        //
        $location=Location::all();
         $categories = Category::all();
    $subcategories = SubCategory::all();
    return view('backend.news.edit', compact('categories', 'subcategories','location','news'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, News $news)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'nullable|exists:sub_categories,id',
            'content' => 'required|string',
            'author' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'meta_keywords' => 'nullable|string',
            'video' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload
        $imagePath = $news->image; // Keep existing image by default
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($news->image && file_exists(public_path($news->image))) {
                unlink(public_path($news->image));
            }

            // Upload new image
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/news'), $imageName);
            $imagePath = 'uploads/news/' . $imageName;
        }

        // Update the news
        $news->update([
            'title' => $request->title,
            'author_name' => $request->author,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'description' => $request->content,
            'video' => $request->video,
            'slug' => \Str::slug($request->title),
            'TopLead' => $request->has('top_lead') ? 1 : 0,
            'lead_news' => $request->has('lead_news') ? 1 : 0,
            'meta_keywords' => $request->meta_keywords,
            'image' => $imagePath,
            'location' => $request->location,
        ]);

        return redirect()->route('news.index')->with('success', 'News updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        try {
            // Delete the image file if it exists
            if ($news->image && file_exists(public_path($news->image))) {
                unlink(public_path($news->image));
            }

            // Delete the news record
            $news->delete();

            return redirect()->route('news.index')->with('success', 'News deleted successfully!');
        } catch (\Exception $e) {
            \Log::error('Error deleting news: ' . $e->getMessage());
            return redirect()->route('news.index')->with('error', 'Failed to delete news. ' . $e->getMessage());
        }
    }
}



