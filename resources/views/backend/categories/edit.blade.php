<div class="modal fade" id="editCategoryModal{{ $category->id }}" tabindex="-1" aria-labelledby="editCategoryModalLabel{{ $category->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="{{ route('categories.update', $category->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="id" value="{{ $category->id }}">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title text-dark" id="editCategoryModalLabel{{ $category->id }}">Edit Category</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="editCategoryName{{ $category->id }}" class="form-label">Category Name</label>
                                                                <input type="text" class="form-control" id="editCategoryName{{ $category->id }}" name="name" value="{{ $category->name }}" required>
                                                            </div>

                                                              <div class="form-check form-switch mb-3">
                                                                <input class="form-check-input" type="checkbox" id="editActiveSwitch{{ $category->id }}" name="active" {{ $category->showOnTopBar ? 'checked' : '' }}>
                                                                <label class="form-check-label" for="editActiveSwitch{{ $category->id }}">Show On Top Bar</label>
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
