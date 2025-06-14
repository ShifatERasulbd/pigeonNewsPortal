@extends('backend.master')
@section('main')
        




            <!-- Recent Sales Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="d-flex justify-content-end mb-2">
                    <!-- Button trigger modal -->
                   <button type="button" class="btn btn-primary btn-sm d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                        <i class="fa fa-plus"></i>
                        Add Category
                    </button>
                </div>


               @if(session('success'))
                    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1055">
                        <div id="successToast" class="toast align-items-center text-bg-success border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="d-flex">
                                <div class="toast-body">
                                    {{ session('success') }}
                                </div>
                                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                        </div>
                    </div>
                @endif


                <!-- Add Category Modal -->
                <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModal" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="addCategoryModalLabel">Add Room</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <!-- Add your form fields here -->
                        <form action="{{ route('categories.store') }}" method="POST">
                          @csrf
                            <div class="mb-3">
                            <label for="categoryName" class="form-label">Category Name</label>
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

                <div class="bg-secondary bg-white  text-center rounded p-4">

                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark">

                                    <th scope="col">SL</th>
                                    <th scope="col">Category Name</th>
                                    <th scope="col">Option</th>

                                </tr>
                            </thead>
                            <tbody>
                                @if($categories->isNotEmpty())
                                    @foreach($categories as $key => $category)
                                        <tr>

                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td>
                                              <a class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editCategoryModal{{ $category->id }}">
                                                <i class="fa-solid fa-pen"></i> Edit
                                              </a>
                                               <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this category?')">
                                                        <i class="fa-solid fa-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>



                                         <div class="modal fade" id="editCategoryModal{{ $category->id }}" tabindex="-1" aria-labelledby="editCategoryModalLabel{{ $category->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="{{ route('categories.update', $category->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="id" value="{{ $category->id }}">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editCategoryModalLabel{{ $category->id }}">Edit Category</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="editCategoryName{{ $category->id }}" class="form-label">Category Name</label>
                                                                <input type="text" class="form-control" id="editCategoryName{{ $category->id }}" name="name" value="{{ $category->name }}" required>
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
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4" class="text-center text-white">No categories found.</td>
                                    </tr>
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Recent Sales End -->



@endsection
