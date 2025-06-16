<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
         $location = Location::all();
        return view('backend.location.index', compact('location'));
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
        Location::create([
            'name' => $request->name,

        ]);

        // Redirect back with a success message
        return redirect()->route('location.index')->with('success', 'Location created successfully!');
    }




    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Location $location)
    {
        //
             // Validate the request
    $request->validate([
        'name' => 'required|string|max:255|unique:categories,name,' . $location->id,
    ]);

    // Update the category
    $location->update([
        'name' => $request->name,

    ]);

    // Redirect back with a success message
    return redirect()->route('location.index')->with('success', 'Location updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $location)
    {
        //
         $location->delete();
         return redirect()->route('location.index')->with('success', 'Location deleted successfully!');
    }
}
