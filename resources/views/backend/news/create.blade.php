@extends('backend.master')
@section('main')
<div class="container mt-4">
    <h3>Add News</h3>
    <form action="{{ route('news.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">News Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select class="form-select" id="category_id" name="category_id" required>
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="subcategory_id" class="form-label">Subcategory</label>
            <select class="form-select" id="subcategory_id" name="subcategory_id">
                <option value="">Select Subcategory</option>
                @foreach($subcategories as $subcategory)
                    <option value="{{ $subcategory->id }}" data-category="{{ $subcategory->categoryId }}">
                        {{ $subcategory->SubCategoryName }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea class="form-control" id="content" name="content" rows="5"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Add News</button>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const categorySelect = document.getElementById('category_id');
    const subcategorySelect = document.getElementById('subcategory_id');
    const allOptions = Array.from(subcategorySelect.options);

    categorySelect.addEventListener('change', function () {
        const selectedCategory = this.value;
        subcategorySelect.innerHTML = '<option value="">Select Subcategory</option>';
        allOptions.forEach(option => {
            if (option.value === "") return; // skip placeholder
            if (option.getAttribute('data-category') === selectedCategory) {
                subcategorySelect.appendChild(option);
            }
        });
    });
});
</script>

@endsection
