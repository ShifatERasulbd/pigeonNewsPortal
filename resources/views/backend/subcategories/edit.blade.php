<div class="modal fade" id="editSubCategoryModal{{ $subcategory->id }}" tabindex="-1" aria-labelledby="editSubCategoryModalLabel{{ $subcategory->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('subcategories.update', $subcategory->id) }}" method="POST">
                @csrf
                @method('PUT')
                 <input type="hidden" class="form-control"  name="id" value="{{ $subcategory->id }}" required>
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="editSubCategoryModalLabel{{ $subcategory->id }}">Edit Sub Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="editSubCategoryName{{ $subcategory->id }}" class="form-label">Sub Category Name</label>
                        <input type="text" class="form-control" id="editSubCategoryName{{ $subcategory->id }}" name="name" value="{{ $subcategory->SubCategoryName }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="editCategoryId{{ $subcategory->id }}" class="form-label">Select Category</label>
                        <select class="form-select" id="editCategoryId{{ $subcategory->id }}" name="category_id" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $subcategory->categoryId == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Sub Category</button>
                </div>
            </form>
        </div>
    </div>
</div>
