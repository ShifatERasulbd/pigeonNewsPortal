<!-- Edit Advertisement Modal -->
<div class="modal fade" id="editAdvertiseModal{{ $advertisement->id }}" tabindex="-1" aria-labelledby="editAdvertiseModalLabel{{ $advertisement->id }}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-dark" id="editAdvertiseModalLabel{{ $advertisement->id }}">Edit Advertisement</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('advertise.update', $advertisement->id) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <input type="hidden" name="id" value="{{ $advertisement->id }}">
          
          <div class="mb-3">
            <label for="location_id{{ $advertisement->id }}" class="form-label">Location</label>
            <select class="form-select" id="location_id{{ $advertisement->id }}" name="location_id" required>
              <option value="">Select Location</option>
              @foreach($advertiseLocations as $location)
                <option value="{{ $location->id }}" {{ $advertisement->location_id == $location->id ? 'selected' : '' }}>
                  {{ $location->location }}
                </option>
              @endforeach
            </select>
          </div>
          
          <div class="mb-3">
            <label for="image{{ $advertisement->id }}" class="form-label">Image</label>
            @if($advertisement->image)
              <div class="mb-2">
                <img src="{{ asset($advertisement->image) }}" alt="Current Image" width="100" class="img-thumbnail">
              </div>
            @endif
            <input type="file" class="form-control" id="image{{ $advertisement->id }}" name="image" accept="image/*">
            <small class="text-muted">Upload a new image to replace the current one (leave empty to keep current image)</small>
          </div>
          
          <div class="mb-3">
            <label for="video{{ $advertisement->id }}" class="form-label">Video URL</label>
            <input type="url" class="form-control" id="video{{ $advertisement->id }}" name="video" value="{{ $advertisement->video }}" placeholder="https://example.com/video">
            <small class="text-muted">Enter a video URL for the advertisement (optional if image is provided)</small>
          </div>
          
          <div class="mb-3">
            <label for="link{{ $advertisement->id }}" class="form-label">Link URL</label>
            <input type="url" class="form-control" id="link{{ $advertisement->id }}" name="link" value="{{ $advertisement->link }}" placeholder="https://example.com">
            <small class="text-muted">Enter a URL where the advertisement should link to</small>
          </div>
          
          <div class="modal-footer px-0 pb-0">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update Advertisement</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>