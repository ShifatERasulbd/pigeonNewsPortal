<?php

namespace App\Http\Controllers;
use App\Models\ImageCategory;
use App\Models\GalleryImage;
use App\Models\ImageGallery;
use Illuminate\Http\Request;

class ImageGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $imageCategories = ImageCategory::all();
        $imageGalleries = ImageGallery::all();
        return view('backend.image-galleries.index', compact('imageGalleries', 'imageCategories'));
    }

   
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // Validate the request
        $request->validate([

            'title' => 'required|string|max:255',
            'description' => 'nullable|string',

        ]);

        // // Check if images were uploaded
        // if (!$request->hasFile('images')) {
        //     return redirect()->back()->with('error', 'Please upload at least one image.');
        // }

        // Create a gallery record
        $gallery = ImageGallery::create([
            'title' => $request->title,
            'description' => $request->description,
            'categoryId' => $request->categoryId,
        ]);

        // Process each image
        foreach ($request->file('images') as $image) {
            // Generate unique filename
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            // Move the file to the uploads directory
            $image->move(public_path('uploads/gallery'), $imageName);
            $imagePath = 'uploads/gallery/' . $imageName;

            // Create gallery image record
            GalleryImage::create([
                'gallery_id' => $gallery->id,
                'image_path' => $imagePath,
            ]);
        }

        return redirect()->route('image-gallery.index')->with('success', 'Gallery created successfully!');
    }




    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ImageGallery $imageGallery)
    {
         // Validate the request
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'category_id' => 'required|exists:image_categories,id',
        'new_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
    ]);



    // Update basic fields
    $imageGallery->update([
        'title' => $request->title,
        'description' => $request->description,
        'category_id' => $request->category_id,
    ]);

     // Remove old contents
        GalleryImage::where('gallery_id', $imageGallery->id)->delete();

    // Process new uploaded images if any
    if ($request->hasFile('new_images')) {
        foreach ($request->file('new_images') as $image) {
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/gallery'), $imageName);

            $imagePath = 'uploads/gallery/' . $imageName;

            GalleryImage::create([
                'gallery_id' => $imageGallery->id,
                'image_path' => $imagePath,
            ]);
        }
    }

    return redirect()->back()->with('success', 'Gallery updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ImageGallery $imageGallery)
    {
        try {
            // Get all images associated with this gallery
            $images = $imageGallery->images;

            // Delete each image file from storage
            foreach ($images as $image) {
                if (file_exists(public_path($image->image_path))) {
                    unlink(public_path($image->image_path));
                }

                // Delete the image record
                $image->delete();
            }

            // Delete the gallery itself
            $imageGallery->delete();

            return redirect()->route('image-gallery.index')->with('success', 'Gallery and all associated images deleted successfully!');
        } catch (\Exception $e) {
            \Log::error('Error deleting gallery: ' . $e->getMessage());
            return redirect()->route('image-gallery.index')->with('error', 'Failed to delete gallery. ' . $e->getMessage());
        }
    }
}





