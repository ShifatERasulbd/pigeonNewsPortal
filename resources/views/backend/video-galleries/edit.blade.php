<!-- Edit Video Gallery Modal -->
<div class="modal fade" id="editVideoGalleryModal{{ $gallery->id }}" tabindex="-1" aria-labelledby="editVideoGalleryModalLabel{{ $gallery->id }}" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-dark" id="editVideoGalleryModalLabel{{ $gallery->id }}">Edit Video</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('video-gallery.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <input type="hidden" name="id" value="{{ $gallery->id }}">
          
          <div class="mb-3">
            <label for="category_id{{ $gallery->id }}" class="form-label">Video Category</label>
            <select class="form-select" id="category_id{{ $gallery->id }}" name="category_id" required>
              <option value="">Select Category</option>
              @foreach($videoGalleryCategories as $category)
                <option value="{{ $category->id }}" {{ $gallery->category_id == $category->id ? 'selected' : '' }}>
                  {{ $category->name }}
                </option>
              @endforeach
            </select>
          </div>
          
          <div class="mb-3">
            <label for="title{{ $gallery->id }}" class="form-label">Video Title</label>
            <input type="text" class="form-control" id="title{{ $gallery->id }}" name="title" value="{{ $gallery->title }}" required>
          </div>
          
          <div class="mb-3">
            <label for="video_url{{ $gallery->id }}" class="form-label">Video URL</label>
            <input type="url" class="form-control" id="video_url{{ $gallery->id }}" name="video_url" value="{{ $gallery->video_url }}" required>
            <small class="text-muted">Enter a YouTube or Vimeo video URL</small>
          </div>
          
          <div class="mb-3">
            <label for="thumbnail{{ $gallery->id }}" class="form-label">Thumbnail Image</label>
            @if($gallery->thumbnail)
              <div class="mb-2">
                <img src="{{ asset($gallery->thumbnail) }}" alt="Current Thumbnail" class="img-thumbnail" style="max-height: 150px;">
                <p class="text-muted small">Current thumbnail</p>
              </div>
            @endif
            <input type="file" class="form-control" id="thumbnail{{ $gallery->id }}" name="thumbnail" accept="image/*" onchange="previewEditImage(this, {{ $gallery->id }})">
            <small class="text-muted">Upload a new thumbnail image (leave empty to keep current image)</small>
            <div id="thumbnailEditPreview{{ $gallery->id }}" class="mt-2" style="display: none;">
              <img src="" alt="New Thumbnail Preview" class="img-thumbnail" style="max-height: 150px;">
              <p class="text-muted small">New thumbnail preview</p>
            </div>
          </div>
          
          <div class="mb-3">
            <label for="description{{ $gallery->id }}" class="form-label">Description</label>
            <textarea class="form-control" id="description{{ $gallery->id }}" name="description" rows="3">{{ $gallery->description }}</textarea>
          </div>
          
          <div class="modal-footer px-0 pb-0">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update Video</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  function previewEditImage(input, galleryId) {
    const preview = document.getElementById('thumbnailEditPreview' + galleryId);
    const previewImg = preview.querySelector('img');
    
    if (input.files && input.files[0]) {
      const reader = new FileReader();
      
      reader.onload = function(e) {
        previewImg.src = e.target.result;
        preview.style.display = 'block';
      }
      
      reader.readAsDataURL(input.files[0]);
    } else {
      previewImg.src = '';
      preview.style.display = 'none';
    }
  }
</script>