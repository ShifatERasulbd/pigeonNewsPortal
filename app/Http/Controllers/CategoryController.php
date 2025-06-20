<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
         $categories = Category::all();
        return view('backend.categories.index', compact('categories'));
    }

    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //


        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        // Create the category
        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'showOnTopBar'=>$request->active,
        ]);

        // Redirect back with a success message
        return redirect()->route('categories.index')->with('success', 'Category created successfully!');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
        // Validate the request
    $request->validate([
        'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
    ]);

    // Update the category
    $category->update([
        'name' => $request->name,
        'slug' => Str::slug($request->name),
        'showOnTopBar'=>$request->active,
    ]);

    // Redirect back with a success message
    return redirect()->route('categories.index')->with('success', 'Category updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
         $category->delete();
         return redirect()->route('categories.index')->with('success', 'Category deleted successfully!');
    }
}
