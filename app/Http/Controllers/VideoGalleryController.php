<?php

namespace App\Http\Controllers;

use App\Models\VideoGallery;
use App\Models\VideoGalleryCategory;
use Illuminate\Http\Request;

class VideoGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all video galleries with their categories
        $videoGalleries = VideoGallery::with('category')->latest()->get();

        // Get all video gallery categories for the create form
        $videoGalleryCategories = VideoGalleryCategory::all();

        // Return view with video galleries and categories
        return view('backend.video-galleries.index', compact('videoGalleries', 'videoGalleryCategories'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:video_gallery_categories,id',
            'video_url' => 'required|url',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
        ]);

        try {
            // Handle thumbnail upload
            $thumbnailPath = null;
            if ($request->hasFile('thumbnail')) {
                $thumbnail = $request->file('thumbnail');
                $thumbnailName = time() . '_' . uniqid() . '.' . $thumbnail->getClientOriginalExtension();
                $thumbnail->move(public_path('uploads/video-gallery'), $thumbnailName);
                $thumbnailPath = 'uploads/video-gallery/' . $thumbnailName;
            } else {
                // You could implement logic to fetch thumbnail from video URL
                // For example, getting YouTube thumbnail from video ID
                if (strpos($request->video_url, 'youtube.com') !== false || strpos($request->video_url, 'youtu.be') !== false) {
                    // Extract YouTube video ID
                    $videoId = null;
                    if (strpos($request->video_url, 'youtube.com/watch?v=') !== false) {
                        $videoId = explode('v=', $request->video_url)[1];
                        $ampersandPosition = strpos($videoId, '&');
                        if ($ampersandPosition !== false) {
                            $videoId = substr($videoId, 0, $ampersandPosition);
                        }
                    } elseif (strpos($request->video_url, 'youtu.be/') !== false) {
                        $videoId = explode('youtu.be/', $request->video_url)[1];
                    }

                    if ($videoId) {
                        // Use YouTube thumbnail
                        $thumbnailUrl = "https://img.youtube.com/vi/{$videoId}/maxresdefault.jpg";
                        $thumbnailName = time() . '_' . uniqid() . '.jpg';
                        $thumbnailPath = 'uploads/video-gallery/' . $thumbnailName;

                        // Download and save the thumbnail
                        file_put_contents(public_path($thumbnailPath), file_get_contents($thumbnailUrl));
                    }
                }
            }
            $videogallery=new VideoGallery();
            $videogallery->title=$request->title;
            $videogallery->category_id=$request->category_id;
            $videogallery->video_url=$request->video_url;
            $videogallery->thumbnail=$thumbnailPath;
            $videogallery->description=$request->description;
            $videogallery->save();
           

            // Redirect back with a success message
            return redirect()->route('video-gallery.index')->with('success', 'Video added to gallery successfully!');
        } catch (\Exception $e) {
            // Log the error
            \Log::error('Error adding video to gallery: ' . $e->getMessage());

            // Redirect back with an error message
            return redirect()->route('video-gallery.index')->with('error', 'Failed to add video to gallery. ' . $e->getMessage());
        }
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VideoGallery $videoGallery)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:video_gallery_categories,id',
            'video_url' => 'required|url',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
        ]);

        try {
            // Prepare data for update
            $data = [
                'title' => $request->title,
                'category_id' => $request->category_id,
                'video_url' => $request->video_url,
                'description' => $request->description,
            ];

            // Handle thumbnail upload if a new one is provided
            if ($request->hasFile('thumbnail')) {
                // Delete old thumbnail if it exists
                if ($videoGallery->thumbnail && file_exists(public_path($videoGallery->thumbnail))) {
                    unlink(public_path($videoGallery->thumbnail));
                }

                // Upload new thumbnail
                $thumbnail = $request->file('thumbnail');
                $thumbnailName = time() . '_' . uniqid() . '.' . $thumbnail->getClientOriginalExtension();
                $thumbnail->move(public_path('uploads/video-gallery'), $thumbnailName);
                $data['thumbnail'] = 'uploads/video-gallery/' . $thumbnailName;
            }

            // Check if video URL has changed and no new thumbnail was uploaded
            // If so, we might want to update the thumbnail from the new video
            if ($request->video_url !== $videoGallery->video_url && !$request->hasFile('thumbnail') &&
                (strpos($request->video_url, 'youtube.com') !== false || strpos($request->video_url, 'youtu.be') !== false)) {

                // Extract YouTube video ID
                $videoId = null;
                if (strpos($request->video_url, 'youtube.com/watch?v=') !== false) {
                    $videoId = explode('v=', $request->video_url)[1];
                    $ampersandPosition = strpos($videoId, '&');
                    if ($ampersandPosition !== false) {
                        $videoId = substr($videoId, 0, $ampersandPosition);
                    }
                } elseif (strpos($request->video_url, 'youtu.be/') !== false) {
                    $videoId = explode('youtu.be/', $request->video_url)[1];
                }

                if ($videoId) {
                    // Delete old thumbnail if it exists
                    if ($videoGallery->thumbnail && file_exists(public_path($videoGallery->thumbnail))) {
                        unlink(public_path($videoGallery->thumbnail));
                    }

                    // Use YouTube thumbnail
                    $thumbnailUrl = "https://img.youtube.com/vi/{$videoId}/maxresdefault.jpg";
                    $thumbnailName = time() . '_' . uniqid() . '.jpg';
                    $thumbnailPath = 'uploads/video-gallery/' . $thumbnailName;

                    // Download and save the thumbnail
                    file_put_contents(public_path($thumbnailPath), file_get_contents($thumbnailUrl));
                    $data['thumbnail'] = $thumbnailPath;
                }
            }

            // Update the video gallery
            $videoGallery->update($data);

            // Redirect back with a success message
            return redirect()->route('video-gallery.index')->with('success', 'Video updated successfully!');
        } catch (\Exception $e) {
            // Log the error
            \Log::error('Error updating video: ' . $e->getMessage());

            // Redirect back with an error message
            return redirect()->route('video-gallery.index')->with('error', 'Failed to update video. ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VideoGallery $videoGallery)
    {
        try {
            // Delete the thumbnail file if it exists
            if ($videoGallery->thumbnail && file_exists(public_path($videoGallery->thumbnail))) {
                unlink(public_path($videoGallery->thumbnail));
            }

            // Delete the video gallery record
            $videoGallery->delete();

            return redirect()->route('video-gallery.index')->with('success', 'Video deleted successfully!');
        } catch (\Exception $e) {
            \Log::error('Error deleting video: ' . $e->getMessage());
            return redirect()->route('video-gallery.index')->with('error', 'Failed to delete video. ' . $e->getMessage());
        }
    }
}




