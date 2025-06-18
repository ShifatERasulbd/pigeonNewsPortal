  <!-- Add Image Gallery Modal -->
                <div class="modal fade" id="addImageGalleryModal" tabindex="-1" aria-labelledby="addImageGalleryModal" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title text-dark" id="addImageGalleryModalLabel">Add Images to Gallery</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form action="{{ route('image-gallery.store') }}" method="POST" enctype="multipart/form-data">
                          @csrf

                          <div class="mb-3">
                            <label for="category_id" class="form-label">Image Category</label>
                            <select class="form-select" id="category_id" name="categoryId" required>
                              <option value="">Select Category</option>
                              @foreach($imageCategories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                              @endforeach
                            </select>
                          </div>

                          <div class="mb-3">
                            <label for="title" class="form-label">Gallery Title</label>
                            <input type="text" class="form-control" name="title" placeholder="Enter gallery title" required>
                          </div>

                          <div class="mb-3">
                            <label for="description" class="form-label">Gallery Description</label>
                            <textarea class="form-control" name="description" rows="3" placeholder="Enter gallery description"></textarea>
                          </div>

                          <!-- Image Repeater Section -->
                          <div class="mb-3">
                            <label class="form-label">Upload Images</label>
                            <div class="image-repeater-wrapper">
                              <div class="control-group">
                                <div class="input-group mb-3">
                                  <input type="file" class="form-control image-input" name="images[]" accept="image/*" required>
                                  <button type="button" class="btn btn-danger remove-btn">Remove</button>
                                </div>
                                <div class="image-preview mb-3"></div>
                              </div>
                            </div>

                            <button type="button" class="btn btn-success btn-sm btn-increment mt-2">
                              <i class="fa fa-plus"></i> Add Another Image
                            </button>
                          </div>

                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Gallery</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>

  <!-- Hidden template for cloning -->
                <div class="clone d-none">
                  <div class="control-group">
                    <div class="input-group mb-3">
                      <input type="file" class="form-control image-input" name="images[]" accept="image/*" required>
                      <button type="button" class="btn btn-danger remove-btn">Remove</button>
                    </div>
                    <div class="image-preview mb-3"></div>
                  </div>
                </div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Initialize image preview for existing inputs
    initImagePreviews();

    // Add new repeater block
    document.querySelector('.btn-increment').addEventListener('click', function() {
      const template = document.querySelector('.clone').innerHTML;
      document.querySelector('.image-repeater-wrapper').insertAdjacentHTML('beforeend', template);
      initImagePreviews();
    });

    // Remove repeater block
    document.addEventListener('click', function(e) {
      if (e.target && e.target.classList.contains('remove-btn')) {
        // Don't remove if it's the only one
        const controlGroups = document.querySelectorAll('.image-repeater-wrapper .control-group');
        if (controlGroups.length > 1) {
          e.target.closest('.control-group').remove();
        } else {
          alert('You need at least one image.');
        }
      }
    });

    // Function to initialize image previews
    function initImagePreviews() {
      const imageInputs = document.querySelectorAll('.image-input');

      imageInputs.forEach(input => {
        if (!input.hasAttribute('data-initialized')) {
          input.setAttribute('data-initialized', 'true');

          input.addEventListener('change', function() {
            const preview = this.closest('.control-group').querySelector('.image-preview');
            preview.innerHTML = '';

            if (this.files && this.files[0]) {
              const reader = new FileReader();

              reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'img-fluid';
                img.style.maxHeight = '150px';
                img.style.borderRadius = '5px';
                preview.appendChild(img);
              }

              reader.readAsDataURL(this.files[0]);
            }
          });
        }
      });
    }
  });
</script>



