@extends('backend.master')
@section('main')

<!-- Recent Sales Start -->
<div class="container-fluid pt-4 px-4">
    <div class="d-flex justify-content-end mb-2">
        <!-- Button trigger modal -->
       <button type="button" class="btn btn-primary btn-sm d-flex align-items-center gap-1 text-dark" data-bs-toggle="modal" data-bs-target="#addVideoGalleryModal">
            <i class="fa fa-plus"></i>
            Add Video
        </button>
    </div>

   @if(session('success'))
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1055">
            <div id="successToast" class="toast align-items-center text-bg-success border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('success') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1055">
            <div id="errorToast" class="toast align-items-center text-bg-danger border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('error') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif

  @include('backend.video-galleries.create')

    <div class="bg-secondary bg-white text-center rounded p-4">
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark">
                        <th scope="col">SL</th>
                        <th scope="col">Thumbnail</th>
                        <th scope="col">Title</th>
                        <th scope="col">Category</th>
                        <th scope="col">Video URL</th>
                        <th scope="col">Description</th>
                        <th scope="col">Option</th>
                    </tr>
                </thead>
                <tbody>
                    @if($videoGalleries->isNotEmpty())
                        @foreach($videoGalleries as $key => $gallery)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    @if($gallery->thumbnail)
                                        <img src="{{ asset($gallery->thumbnail) }}" alt="Video Thumbnail" 
                                             class="img-thumbnail" style="width: 100px; height: 60px; object-fit: cover;">
                                    @else
                                        <span class="text-muted">No thumbnail</span>
                                    @endif
                                </td>
                                <td>{{ $gallery->title }}</td>
                                <td>
                                    @if($gallery->category)
                                        {{ $gallery->category->name }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    @if($gallery->video_url)
                                        <a href="{{ $gallery->video_url }}" target="_blank" class="btn btn-sm btn-info">
                                            <i class="fa-solid fa-play"></i> Watch
                                        </a>
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    @if(strlen($gallery->description) > 50)
                                        {{ substr($gallery->description, 0, 50) }}...
                                    @else
                                        {{ $gallery->description }}
                                    @endif
                                </td>
                                <td>
                                  <a class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editVideoGalleryModal{{ $gallery->id }}">
                                    <i class="fa-solid fa-pen"></i> Edit
                                  </a>
                                   <form action="{{ route('video-gallery.destroy', $gallery->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this video?')">
                                            <i class="fa-solid fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Include edit modal for each gallery -->
                            @include('backend.video-galleries.edit', ['gallery' => $gallery])
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7" class="text-center text-dark">No videos found.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Recent Sales End -->

<!-- Video Preview Modal -->
<div class="modal fade" id="videoPreviewModal" tabindex="-1" aria-labelledby="videoPreviewModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="videoPreviewModalLabel">Video Preview</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="ratio ratio-16x9">
          <iframe id="videoFrame" src="" allowfullscreen></iframe>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Auto-hide success toast after 5 seconds
    setTimeout(function() {
      const successToast = document.getElementById('successToast');
      if (successToast) {
        const bsToast = new bootstrap.Toast(successToast);
        bsToast.hide();
      }
      
      const errorToast = document.getElementById('errorToast');
      if (errorToast) {
        const bsToast = new bootstrap.Toast(errorToast);
        bsToast.hide();
      }
    }, 5000);
    
    // Setup video preview modal
    const videoPreviewModal = document.getElementById('videoPreviewModal');
    if (videoPreviewModal) {
      videoPreviewModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const videoUrl = button.getAttribute('data-video-url');
        const videoFrame = document.getElementById('videoFrame');
        
        // Convert YouTube URL to embed format if needed
        let embedUrl = videoUrl;
        if (videoUrl.includes('youtube.com/watch?v=')) {
          const videoId = videoUrl.split('v=')[1].split('&')[0];
          embedUrl = `https://www.youtube.com/embed/${videoId}`;
        } else if (videoUrl.includes('youtu.be/')) {
          const videoId = videoUrl.split('youtu.be/')[1];
          embedUrl = `https://www.youtube.com/embed/${videoId}`;
        }
        
        videoFrame.src = embedUrl;
      });
      
      videoPreviewModal.addEventListener('hidden.bs.modal', function () {
        const videoFrame = document.getElementById('videoFrame');
        videoFrame.src = '';
      });
    }
    
    // Make watch buttons open the preview modal
    const watchButtons = document.querySelectorAll('.btn-info');
    watchButtons.forEach(button => {
      button.addEventListener('click', function(e) {
        e.preventDefault();
        const videoUrl = this.getAttribute('href');
        this.setAttribute('data-video-url', videoUrl);
        
        const videoModal = new bootstrap.Modal(document.getElementById('videoPreviewModal'));
        videoModal.show();
      });
    });
  });
</script>

@endsection