@extends('backend.master')
@section('main')
<div class="container mt-4">
    <h3>Add News</h3>
    <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <!-- Left Column (col-md-8) -->
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0 text-dark">News Content</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="title" class="form-label">News Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>

                        <div class="mb-3">
                            <label for="author" class="form-label">Author Name</label>
                            <input type="text" class="form-control" id="author" name="author" placeholder="Enter author name">
                        </div>

                        <div class="mb-3">
                            <label for="location" class="form-label">Location</label>
                            <select class="form-select" id="location" name="location">
                                <option value="">Select Location</option>
                                @foreach($location as $location)
                                 <option value="{{ $location->id }}">{{ $location->name }}</option>
                                @endforeach
                                
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="meta_keywords" class="form-label">Meta Keywords</label>
                            <div class="tags-input-wrapper">
                                <input type="text" class="form-control" id="meta_keywords_input" placeholder="Type and press Enter">
                                <div class="tags-container mt-2" id="tags_container"></div>
                                <input type="hidden" name="meta_keywords" id="meta_keywords_hidden">
                            </div>
                            <small class="form-text text-muted">Type keywords and press Enter to add them</small>
                        </div>



                        <div class="mb-3">
                            <label for="content" class="form-label">Content</label>
                           <textarea class="form-control" id="content" name="content" rows="5"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column (col-md-4) -->
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">News Details</h5>
                    </div>
                    <div class="card-body">
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
                            <label for="image" class="form-label">Featured Image</label>
                            <div class="input-group">
                                <span class="input-group-btn">

                                </span>
                                <input  class="form-control" type="file" name="image">
                            </div>
                            <div id="holder" class="img-preview mt-2"></div>
                        </div>
                        <div class="mb-3">
                            <label for="video" class="form-label">Video URL</label>
                            <input type="url" class="form-control" id="video" name="video" placeholder="YouTube or Vimeo URL">
                            <small class="form-text text-muted">Enter YouTube or Vimeo video URL (optional)</small>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="topLeadSwitch" name="top_lead" value="1">
                                    <label class="form-check-label" for="topLeadSwitch">Top Lead News</label>
                                    {{-- <small class="d-block text-muted">Display in top lead section</small> --}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="featuredSwitch" name="lead_news" value="1">
                                    <label class="form-check-label" for="featuredSwitch">Lead News</label>
                                    {{-- <small class="d-block text-muted">Display as featured news</small> --}}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Publish News</button>
                </div>
            </div>
        </div>
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

    // Tags input functionality
    const tagsInput = document.getElementById('meta_keywords_input');
    const tagsContainer = document.getElementById('tags_container');
    const hiddenInput = document.getElementById('meta_keywords_hidden');
    let tags = [];

    // Function to render tags
    function renderTags() {
        tagsContainer.innerHTML = '';
        tags.forEach((tag, index) => {
            const tagElement = document.createElement('span');
            tagElement.classList.add('tag');
            tagElement.innerHTML = `${tag} <span class="tag-close" data-index="${index}">&times;</span>`;
            tagsContainer.appendChild(tagElement);
        });

        // Update hidden input with comma-separated tags
        hiddenInput.value = tags.join(',');
    }

    // Add tag when Enter is pressed
    tagsInput.addEventListener('keydown', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            const tag = this.value.trim();
            if (tag && !tags.includes(tag)) {
                tags.push(tag);
                renderTags();
                this.value = '';
            }
        }
    });

    // Remove tag when close button is clicked
    tagsContainer.addEventListener('click', function(e) {
        if (e.target.classList.contains('tag-close')) {
            const index = parseInt(e.target.dataset.index);
            tags.splice(index, 1);
            renderTags();
        }
    });
});
</script>

@endsection








