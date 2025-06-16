<div class="modal fade" id="editImageCategoryModal{{ $imageCategories->id }}" tabindex="-1" aria-labelledby="editImageCategoryModalLabel{{ $imageCategories->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="{{ route('image-category.update', $imageCategories->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="id" value="{{ $imageCategories->id }}">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title text-dark" id="editImageCategoryModalLabel{{ $imageCategories->id }}">Edit Category</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="editCategoryName{{ $imageCategories->id }}" class="form-label">Image Category Name</label>
                                                                <input type="text" class="form-control" id="editCategoryName{{ $imageCategories->id }}" name="name" value="{{ $imageCategories->name }}" required>
                                                            </div>


                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Update Category</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
