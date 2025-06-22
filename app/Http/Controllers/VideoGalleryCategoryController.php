<?php

namespace App\Http\Controllers;

use App\Models\VideoGalleryCategory;
use Illuminate\Http\Request;

class VideoGalleryCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all video gallery categories
        $videoGalleryCategories = VideoGalleryCategory::latest()->get();

        // Return view with video gallery categories
        return view('backend.video-gallery-categories.index', compact('videoGalleryCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255|unique:video_gallery_categories,name',
        ]);

        // Create the video gallery category
        VideoGalleryCategory::create([
            'name' => $request->name,
            'slug' => \Str::slug($request->name),
        ]);

        // Redirect back with a success message
        return redirect()->route('video-gallery-category.index')->with('success', 'Video category created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(VideoGalleryCategory $videoGalleryCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VideoGalleryCategory $videoGalleryCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VideoGalleryCategory $videoGalleryCategory)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255|unique:video_gallery_categories,name,' . $videoGalleryCategory->id,
        ]);

        // Update the video gallery category
        $videoGalleryCategory->update([
            'name' => $request->name,
            'slug' => \Str::slug($request->name),
        ]);

        // Redirect back with a success message
        return redirect()->route('video-gallery-category.index')->with('success', 'Video category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            // Find the category by ID
            $videoGalleryCategory = VideoGalleryCategory::findOrFail($id);

            // Delete the video gallery category
            $videoGalleryCategory->delete();

            return redirect()->route('video-gallery-category.index')
                ->with('success', 'Video category deleted successfully!');
        } catch (\Exception $e) {
            \Log::error('Error deleting video gallery category: ' . $e->getMessage());
            return redirect()->route('video-gallery-category.index')
                ->with('error', 'Failed to delete video category. ' . $e->getMessage());
        }
    }

}









