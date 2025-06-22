<?php

namespace App\Http\Controllers;

use App\Models\ImageCategory;
use App\Http\Requests\StoreImageCategoryRequest;
use App\Http\Requests\UpdateImageCategoryRequest;
use Illuminate\Http\Request;

class ImageCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all image categories
        $imageCategories = ImageCategory::latest()->get();

        return view('backend.image-categories.index', compact('imageCategories'));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255|unique:image_categories,name',

        ]);



        // Create the image category
        ImageCategory::create([
            'name' => $request->name,
            'slug' => \Str::slug($request->name),
        ]);

        // Redirect back with a success message
        return redirect()->route('image-category.index')->with('success', 'Image category created successfully!');
    }


  
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ImageCategory $imageCategory)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255|unique:image_categories,name,' . $imageCategory->id,

        ]);



        // Update the image category
        $imageCategory->update([
            'name' => $request->name,
            'slug' => \Str::slug($request->name),
        ]);

        // Redirect back with a success message
        return redirect()->route('image-category.index')->with('success', 'Image category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ImageCategory $imageCategory)
    {
        try {
            // Delete the image file if it exists
            if ($imageCategory->image && file_exists(public_path($imageCategory->image))) {
                unlink(public_path($imageCategory->image));
            }

            // Delete the image category
            $imageCategory->delete();

            return redirect()->route('image-category.index')->with('success', 'Image category deleted successfully!');
        } catch (\Exception $e) {
            \Log::error('Error deleting image category: ' . $e->getMessage());
            return redirect()->route('image-category.index')->with('error', 'Failed to delete image category. ' . $e->getMessage());
        }
    }
}




