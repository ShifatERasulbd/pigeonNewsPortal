  <!-- Add Category Modal -->
                <div class="modal fade" id="addSubCategoryModal" tabindex="-1" aria-labelledby="addSubCategoryModal" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title text-dark" id="addSubCategoryModalLabel">Add Sub Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <!-- Add your form fields here -->
                        <form action="{{ route('subcategories.store') }}" method="POST">
                          @csrf
                          <div class="mb-3">
                            <label for="category_id" class="form-label">Select Category</label>
                            <select class="form-select" id="category_id" name="category_id" required>
                                <option value="">Choose Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                         <div class="mb-3">
                            <label for="categoryName" class="form-label">Sub Category Name</label>
                            <input type="text" class="form-control" id="SubCategoryName" name="name" placeholder="Enter room name">
                          </div>

                          {{-- <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="activeSwitch" name="active" checked>
                            <label class="form-check-label" for="activeSwitch">Show On Top Bar</label>
                        </div> --}}

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
