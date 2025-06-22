<!-- Add Video Gallery Modal -->
<div class="modal fade" id="addVideoGalleryModal" tabindex="-1" aria-labelledby="addVideoGalleryModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-dark" id="addVideoGalleryModalLabel">Add Video to Gallery</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('video-gallery.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          
          <div class="mb-3">
            <label for="category_id" class="form-label">Video Category</label>
            <select class="form-select" id="category_id" name="category_id" required>
              <option value="">Select Category</option>
              @foreach($videoGalleryCategories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
              @endforeach
            </select>
          </div>
          
          <div class="mb-3">
            <label for="title" class="form-label">Video Title</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Enter video title" required>
          </div>
          
          <div class="mb-3">
            <label for="video_url" class="form-label">Video URL</label>
            <input type="url" class="form-control" id="video_url" name="video_url" placeholder="Enter YouTube or Vimeo URL" required>
            <small class="text-muted">Enter a YouTube or Vimeo video URL</small>
          </div>
          
          <div class="mb-3">
            <label for="thumbnail" class="form-label">Thumbnail Image</label>
            <input type="file" class="form-control" id="thumbnail" name="thumbnail" accept="image/*" onchange="previewImage(this)">
            <small class="text-muted">Upload a thumbnail image (optional - will use video thumbnail if not provided)</small>
            <div id="thumbnailPreview" class="mt-2" style="display: none;">
              <img src="" alt="Thumbnail Preview" class="img-thumbnail" style="max-height: 150px;">
            </div>
          </div>
          
          <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter video description"></textarea>
          </div>
          
          <div class="modal-footer px-0 pb-0">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Add Video</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  function previewImage(input) {
    const preview = document.getElementById('thumbnailPreview');
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