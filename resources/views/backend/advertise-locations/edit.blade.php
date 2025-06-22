<!-- Edit Advertise Location Modal -->
<div class="modal fade" id="editAdvertiseLocationModal{{ $location->id }}" tabindex="-1" aria-labelledby="editAdvertiseLocationModalLabel{{ $location->id }}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-dark" id="editAdvertiseLocationModalLabel{{ $location->id }}">Edit Advertise Location</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('advertise-location.update', $location->id) }}" method="POST">
          @csrf
          @method('PUT')
          <input type="hidden" name="id" value="{{ $location->id }}">
          
          <div class="mb-3">
            <label for="editLocationName{{ $location->id }}" class="form-label">Location</label>
            <input type="text" class="form-control" id="editLocationName{{ $location->id }}" name="location" value="{{ $location->location }}" required>
          </div>
          
          <div class="modal-footer px-0 pb-0">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update Location</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>