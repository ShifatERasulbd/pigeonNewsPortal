<!-- Add Advertise Location Modal -->
<div class="modal fade" id="addAdvertiseLocationModal" tabindex="-1" aria-labelledby="addAdvertiseLocationModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-dark" id="addAdvertiseLocationModalLabel">Add Advertise Location</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Add your form fields here -->
        <form action="{{ route('advertise-location.store') }}" method="POST">
          @csrf
         <div class="mb-3">
            <label for="locationName" class="form-label">Location</label>
            <input type="text" class="form-control" id="locationName" name="location" placeholder="Enter Advertise Location">
          </div>
          <!-- Add more fields as needed -->

      </div>
       <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save Location</button>
        </div>

      </form>
    </div>
  </div>
</div>