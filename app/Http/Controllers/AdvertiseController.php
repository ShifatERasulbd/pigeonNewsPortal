<?php

namespace App\Http\Controllers;

use App\Models\Advertise;
use Illuminate\Http\Request;
use App\Models\AdvertiseLocation;

class AdvertiseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all advertisements with their locations
        $advertisements = Advertise::with('location')->latest()->get();

        // Get all advertise locations for the create/edit forms
        $advertiseLocations = AdvertiseLocation::all();

        // Return view with advertisements and locations
        return view('backend.advertises.index', compact('advertisements', 'advertiseLocations'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'location_id' => 'required|exists:advertise_locations,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video' => 'nullable|url',
            'link' => 'nullable|url',
        ]);

        // Ensure at least one of image or video is provided
        if (!$request->hasFile('image') && !$request->filled('video')) {
            return redirect()->back()->with('error', 'Either an image or a video URL must be provided.');
        }

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/advertisements'), $imageName);
            $imagePath = 'uploads/advertisements/' . $imageName;
        }

        // Create the advertisement
        Advertise::create([
            'location_id' => $request->location_id,
            'image' => $imagePath,
            'video' => $request->video,
            'link' => $request->link,
        ]);

        // Redirect back with a success message
        return redirect()->route('advertise.index')->with('success', 'Advertisement created successfully!');
    }

  
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Advertise $advertise)
    {
        // Validate the request
        $request->validate([
            'location_id' => 'required|exists:advertise_locations,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video' => 'nullable|url',
            'link' => 'nullable|url',
        ]);

        // Prepare data for update
        $data = [
            'location_id' => $request->location_id,
            'video' => $request->video,
            'link' => $request->link,
        ];

        // Handle image upload if a new image is provided
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($advertise->image && file_exists(public_path($advertise->image))) {
                unlink(public_path($advertise->image));
            }

            // Upload new image
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/advertisements'), $imageName);
            $data['image'] = 'uploads/advertisements/' . $imageName;
        }

        // Ensure at least one of image or video is provided
        if (!$request->hasFile('image') && !$advertise->image && !$request->filled('video')) {
            return redirect()->back()->with('error', 'Either an image or a video URL must be provided.');
        }

        // Update the advertisement
        $advertise->update($data);

        // Redirect back with a success message
        return redirect()->route('advertise.index')->with('success', 'Advertisement updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Advertise $advertise)
    {
        try {
            // Delete the image file if it exists
            if ($advertise->image && file_exists(public_path($advertise->image))) {
                unlink(public_path($advertise->image));
            }

            // Delete the advertisement record
            $advertise->delete();

            return redirect()->route('advertise.index')->with('success', 'Advertisement deleted successfully!');
        } catch (\Exception $e) {
            \Log::error('Error deleting advertisement: ' . $e->getMessage());
            return redirect()->route('advertise.index')->with('error', 'Failed to delete advertisement. ' . $e->getMessage());
        }
    }
}




