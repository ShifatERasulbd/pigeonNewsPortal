@extends('backend.master')
@section('main')





            <!-- Recent Sales Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="d-flex justify-content-end mb-2">
                    <!-- Button trigger modal -->
                   <button type="button" class="btn btn-primary btn-sm d-flex align-items-center gap-1 text-dark" data-bs-toggle="modal" data-bs-target="#addSubCategoryModal">
                        <i class="fa fa-plus"></i>
                        Add Sub Category
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


              @include ('backend.subcategories.create')

                <div class="bg-secondary bg-white  text-center rounded p-4">

                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark">

                                    <th scope="col">SL</th>
                                    <th scope="col">Category Name</th>
                                      <th scope="col">Sub Category Name</th>
                                    <th scope="col">Option</th>

                                </tr>
                            </thead>
                            <tbody>
                                @if($subcategories->isNotEmpty())
                                    @foreach($subcategories as $key => $subcategory)
                                        <tr>

                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $subcategory->category ? $subcategory->category->name : '-' }}</td>
                                            <td>{{ $subcategory->SubCategoryName }}</td>
                                            <td>
                                              <a class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editSubCategoryModal{{ $subcategory->id }}">
                                                <i class="fa-solid fa-pen"></i> Edit
                                              </a>
                                               <form action="{{ route('subcategories.destroy', $subcategory->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                     <input type="hidden" class="form-control"  name="id" value="{{ $subcategory->id }}" required>
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this category?')">
                                                        <i class="fa-solid fa-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>



                                         @include ('backend.subcategories.edit')
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4" class="text-center text-dark">No categories found.</td>
                                    </tr>
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Recent Sales End -->



@endsection
