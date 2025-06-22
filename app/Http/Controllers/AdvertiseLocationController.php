<?php

namespace App\Http\Controllers;

use App\Models\AdvertiseLocation;
use Illuminate\Http\Request;

class AdvertiseLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all advertise locations
        $advertiseLocations = AdvertiseLocation::latest()->get();

        // Return view with advertise locations
        return view('backend.advertise-locations.index', compact('advertiseLocations'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'location' => 'required|string|max:255|unique:advertise_locations,location',
        ]);

        // Create the advertise location
        AdvertiseLocation::create([
            'location' => $request->location,
        ]);

        // Redirect back with a success message
        return redirect()->route('advertise-location.index')->with('success', 'Advertise location created successfully!');
    }

  
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AdvertiseLocation $advertiseLocation)
    {
        // Validate the request
        $request->validate([
            'location' => 'required|string|max:255|unique:advertise_locations,location,' . $advertiseLocation->id,
        ]);

        // Update the advertise location
        $advertiseLocation->update([
            'location' => $request->location,
        ]);

        // Redirect back with a success message
        return redirect()->route('advertise-location.index')->with('success', 'Advertise location updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AdvertiseLocation $advertiseLocation)
    {
        try {
            // Delete the advertise location
            $advertiseLocation->delete();

            return redirect()->route('advertise-location.index')->with('success', 'Advertise location deleted successfully!');
        } catch (\Exception $e) {
            \Log::error('Error deleting advertise location: ' . $e->getMessage());
            return redirect()->route('advertise-location.index')->with('error', 'Failed to delete advertise location. ' . $e->getMessage());
        }
    }
}




