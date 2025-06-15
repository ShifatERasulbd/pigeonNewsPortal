<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\News;
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
         $categories = Category::all();
    $subcategories = SubCategory::all();
    return view('backend.news.create', compact('categories', 'subcategories'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
         // Validate the request
     $request->validate([
        'title' => 'required|string|max:255',
        'category_id' => 'required|exists:categories,id',
     
        'content' => 'required|string',
    ]);

    News::create([
        'title' => $request->title,
        'category_id' => $request->category_id,
        'subcategory_id' => $request->subcategory_id,
        'description' => $request->content, // map content to description
        'slug' => \Str::slug($request->title),
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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, News $news)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        //
    }
}
