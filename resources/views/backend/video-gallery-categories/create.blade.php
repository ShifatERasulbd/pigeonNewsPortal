<!-- Add Video Gallery Category Modal -->
<div class="modal fade" id="addVideoGalleryCategoryModal" tabindex="-1" aria-labelledby="addVideoGalleryCategoryModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-dark" id="addVideoGalleryCategoryModalLabel">Add Video Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Add your form fields here -->
        <form action="{{ route('video-gallery-category.store') }}" method="POST">
          @csrf
          <div class="mb-3">
            <label for="categoryName" class="form-label">Video Category Name</label>
            <input type="text" class="form-control" id="categoryName" name="name" placeholder="Enter category name" required>
          </div>

          <!-- Add more fields as needed -->

      </div>
       <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save Category</button>
        </div>

      </form>
    </div>
  </div>
</div>