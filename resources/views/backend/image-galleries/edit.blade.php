<!-- Edit Image Gallery Modal -->
<div class="modal fade" id="editImageGalleryModal{{ $gallery->id }}" tabindex="-1" aria-labelledby="editImageGalleryModalLabel{{ $gallery->id }}" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="{{ route('image-gallery.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal-header">
          <h5 class="modal-title text-dark" id="editImageGalleryModalLabel{{ $gallery->id }}">Edit Gallery</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <div class="mb-3">
            <label for="category_id" class="form-label">Image Category</label>
            <select class="form-select" name="category_id" required>
              <option value="">Select Category</option>
              @foreach($imageCategories as $category)
                <option value="{{ $category->id }}" {{ $gallery->categoryId == $category->id ? 'selected' : '' }}>
                  {{ $category->name }}
                </option>
              @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label">Gallery Title</label>
            <input type="text" class="form-control" name="title" value="{{ $gallery->title }}" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Gallery Description</label>
            <textarea class="form-control summernote" name="description" rows="3">{{ $gallery->description }}</textarea>
          </div>

          <!-- Current Images -->
          <div class="mb-3">
            <label class="form-label">Current Images</label>
            <div class="row">
              @if($gallery->images && $gallery->images->count() > 0)
                @foreach($gallery->images as $image)
                  <div class="col-md-3 mb-3">
                    <div class="position-relative image-container">
                      <img src="{{ asset($image->image_path) }}" alt="Gallery Image" class="img-thumbnail" style="width: 100%; height: 120px; object-fit: cover;">
                      <div class="position-absolute top-0 end-0 d-flex" style="margin: 5px;">
                        <button type="button" class="btn btn-danger btn-sm delete-image" data-image-id="{{ $image->id }}">
                          <i class="fa-solid fa-trash"></i>
                        </button>
                      </div>
                      <input type="hidden" name="existing_images[]" value="{{ $image->id }}">
                    </div>
                  </div>
                @endforeach
              @else
                <div class="col-12">
                  <p class="text-muted">No images available</p>
                </div>
              @endif
            </div>
          </div>

          <!-- Upload New Images -->
          <div class="mb-3">
            <label class="form-label">Add New Images</label>
            <div class="edit-image-repeater-wrapper">
              <div class="control-group">
                <div class="input-group mb-3">
                  <input type="file" class="form-control image-input" name="new_images[]" accept="image/*">
                  <button type="button" class="btn btn-danger remove-btn">Remove</button>
                </div>
                <div class="image-preview mb-3"></div>
              </div>
            </div>

            <button type="button" class="btn btn-success btn-sm btn-increment mt-2">
              <i class="fa fa-plus"></i> Add Another Image
            </button>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Update Gallery</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Hidden form for deleting individual images -->
<form id="delete-image-form-{{ $gallery->id }}" action="" method="POST" style="display: none;">
  @csrf
  @method('DELETE')
</form>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Initialize image previews for the edit modal
    const editModal{{ $gallery->id }} = document.getElementById('editImageGalleryModal{{ $gallery->id }}');

    if (editModal{{ $gallery->id }}) {
      // Initialize image preview for existing inputs
      const imageInputs = editModal{{ $gallery->id }}.querySelectorAll('.image-input');
      imageInputs.forEach(input => {
        input.addEventListener('change', function() {
          const previewContainer = this.closest('.control-group').querySelector('.image-preview');
          previewContainer.innerHTML = '';

          if (this.files && this.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
              const img = document.createElement('img');
              img.src = e.target.result;
              img.className = 'img-thumbnail';
              img.style.maxHeight = '100px';
              previewContainer.appendChild(img);
            }

            reader.readAsDataURL(this.files[0]);
          }
        });
      });

      // Add new repeater block
      const btnIncrement = editModal{{ $gallery->id }}.querySelector('.btn-increment');
      if (btnIncrement) {
        btnIncrement.addEventListener('click', function() {
          const repeaterWrapper = editModal{{ $gallery->id }}.querySelector('.edit-image-repeater-wrapper');
          const newGroup = document.createElement('div');
          newGroup.className = 'control-group';
          newGroup.innerHTML = `
            <div class="input-group mb-3">
              <input type="file" class="form-control image-input" name="new_images[]" accept="image/*">
              <button type="button" class="btn btn-danger remove-btn">Remove</button>
            </div>
            <div class="image-preview mb-3"></div>
          `;

          repeaterWrapper.appendChild(newGroup);

          // Initialize the new file input
          const newInput = newGroup.querySelector('.image-input');
          newInput.addEventListener('change', function() {
            const previewContainer = this.closest('.control-group').querySelector('.image-preview');
            previewContainer.innerHTML = '';

            if (this.files && this.files[0]) {
              const reader = new FileReader();

              reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'img-thumbnail';
                img.style.maxHeight = '100px';
                previewContainer.appendChild(img);
              }

              reader.readAsDataURL(this.files[0]);
            }
          });
        });
      }

      // Remove repeater block
      editModal{{ $gallery->id }}.addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('remove-btn')) {
          e.target.closest('.control-group').remove();
        }
      });

      // Handle existing image deletion
      const deleteButtons = editModal{{ $gallery->id }}.querySelectorAll('.delete-image');
      const deleteForm = document.getElementById('delete-image-form-{{ $gallery->id }}');

      deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
          e.preventDefault();
          const imageId = this.getAttribute('data-image-id');
          const imageContainer = this.closest('.image-container');

          if (confirm('Are you sure you want to remove this image?')) {
            // Just remove from the form (will be deleted on form submit)
            imageContainer.remove();
          }
        });
      });
    }
  });
</script>

