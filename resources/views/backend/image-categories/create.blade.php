  <!-- Add Category Modal -->
                <div class="modal fade" id="addImageCategoryModal" tabindex="-1" aria-labelledby="addImageCategoryModal" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title text-dark" id="addImageCategoryModalLabel">Add Image Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <!-- Add your form fields here -->
                        <form action="{{ route('image-category.store') }}" method="POST">
                          @csrf
                         <div class="mb-3">
                            <label for="categoryName" class="form-label">Image Category Name</label>
                            <input type="text" class="form-control" id="CategoryName" name="name" placeholder="Enter room name">
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
