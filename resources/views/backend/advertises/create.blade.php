<!-- Add Advertisement Modal -->
<div class="modal fade" id="addAdvertiseModal" tabindex="-1" aria-labelledby="addAdvertiseModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-dark" id="addAdvertiseModalLabel">Add Advertisement</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('advertise.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          
          <div class="mb-3">
            <label for="location_id" class="form-label">Location</label>
            <select class="form-select" id="location_id" name="location_id" required>
              <option value="">Select Location</option>
              @foreach($advertiseLocations as $location)
                <option value="{{ $location->id }}">{{ $location->location }}</option>
              @endforeach
            </select>
          </div>
          
          <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*">
            <small class="text-muted">Upload an image for the advertisement (optional if video is provided)</small>
          </div>
          
          <div class="mb-3">
            <label for="video" class="form-label">Video URL</label>
            <input type="url" class="form-control" id="video" name="video" placeholder="https://example.com/video">
            <small class="text-muted">Enter a video URL for the advertisement (optional if image is provided)</small>
          </div>
          
          <div class="mb-3">
            <label for="link" class="form-label">Link URL</label>
            <input type="url" class="form-control" id="link" name="link" placeholder="https://example.com">
            <small class="text-muted">Enter a URL where the advertisement should link to</small>
          </div>
          
          <div class="modal-footer px-0 pb-0">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Add Advertisement</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>