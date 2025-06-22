<!-- Edit Video Gallery Category Modal -->
<div class="modal fade" id="editVideoGalleryCategoryModal{{ $category->id }}" tabindex="-1" aria-labelledby="editVideoGalleryCategoryModalLabel{{ $category->id }}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-dark" id="editVideoGalleryCategoryModalLabel{{ $category->id }}">Edit Video Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('video-gallery-category.update', $category->id) }}" method="POST">
          @csrf
          @method('PUT')
          <input type="hidden" name="id" value="{{ $category->id }}">
          
          <div class="mb-3">
            <label for="editCategoryName{{ $category->id }}" class="form-label">Video Category Name</label>
            <input type="text" class="form-control" id="editCategoryName{{ $category->id }}" name="name" value="{{ $category->name }}" required>
          </div>
          
          <!-- Add more fields as needed -->
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update Category</button>
      </div>
      </form>
    </div>
  </div>
</div>