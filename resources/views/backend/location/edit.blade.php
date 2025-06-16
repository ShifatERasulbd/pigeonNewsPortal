<div class="modal fade" id="editLocationModal{{ $location->id }}" tabindex="-1" aria-labelledby="editLocationModalLabel{{ $location->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="{{ route('location.update', $location->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="id" value="{{ $location->id }}">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title text-dark" id="editLocationModalLabel{{ $location->id }}">Edit Location</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="editCategoryName{{ $location->id }}" class="form-label">Location</label>
                                                                <input type="text" class="form-control" id="editCategoryName{{ $location->id }}" name="name" value="{{ $location->name }}" required>
                                                            </div>


                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Update Location</button>
                                                        </div>
                                                    </form>
                                                                                                    </div>
                                            </div>
                                        </div>
