

@extends('backend.master')
@section('main')
<div class="container mt-4">
    <h3>Edit News</h3>
    <form action="{{ route('news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
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
                            <input type="text" class="form-control" id="title" name="title" value="{{ $news->title }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="author" class="form-label">Author Name</label>
                            <input type="text" class="form-control" id="author" name="author" value="{{ $news->author_name }}" placeholder="Enter author name">
                        </div>

                        <div class="mb-3">
                            <label for="location" class="form-label">Location</label>
                            <select class="form-select" id="location" name="location">
                                <option value="">Select Location</option>
                                @foreach($location as $loc)
                                    <option value="{{ $loc->id }}" {{ $news->location == $loc->id ? 'selected' : '' }}>{{ $loc->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="meta_keywords" class="form-label">Meta Keywords</label>
                            <div class="tags-input-wrapper">
                                <input type="text" class="form-control" id="meta_keywords_input" placeholder="Type and press Enter">
                                <div class="tags-container mt-2" id="tags_container"></div>
                                <input type="hidden" name="meta_keywords" id="meta_keywords_hidden" value="{{ $news->meta_keywords }}">
                            </div>
                            <small class="form-text text-muted">Type keywords and press Enter to add them</small>
                        </div>

                        <div class="mb-3">
                            <label for="content" class="form-label">Content</label>
                           <textarea class="form-control" id="content" name="content" rows="5">{{ $news->description }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column (col-md-4) -->
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0 text-dark">News Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Category</label>
                            <select class="form-select" id="category_id" name="category_id" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $news->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="subcategory_id" class="form-label">Subcategory</label>
                            <select class="form-select" id="subcategory_id" name="subcategory_id">
                                <option value="">Select Subcategory</option>
                                @foreach($subcategories as $subcategory)
                                    <option value="{{ $subcategory->id }}"
                                        data-category="{{ $subcategory->categoryId }}"
                                        {{ $news->subcategory_id == $subcategory->id ? 'selected' : '' }}>
                                        {{ $subcategory->SubCategoryName }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Featured Image</label>
                            <div class="input-group">
                                <input class="form-control" type="file" name="image" id="image" accept="image/*" onchange="previewImage(this)">
                            </div>
                            <div id="holder" class="img-preview mt-2">
                                @if($news->image)
                                    <img src="{{ asset($news->image) }}" alt="{{ $news->title }}" class="img-fluid" style="max-height: 200px; border-radius: 5px;">
                                @endif
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="video" class="form-label">Video URL</label>
                            <input type="url" class="form-control" id="video" name="video" value="{{ $news->video }}" placeholder="YouTube or Vimeo URL">
                            <small class="form-text text-muted">Enter YouTube or Vimeo video URL (optional)</small>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="topLeadSwitch" name="top_lead" value="1" {{ $news->TopLead ? 'checked' : '' }}>
                                    <label class="form-check-label" for="topLeadSwitch">Top Lead News</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="featuredSwitch" name="lead_news" value="1" {{ $news->lead_news ? 'checked' : '' }}>
                                    <label class="form-check-label" for="featuredSwitch">Lead News</label>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Update News</button>
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

    // Store the initially selected subcategory ID
    const initialSubcategoryId = "{{ $news->subcategory_id }}";

    categorySelect.addEventListener('change', function () {
        filterSubcategories();
    });

    function filterSubcategories() {
        const selectedCategory = categorySelect.value;
        subcategorySelect.innerHTML = '<option value="">Select Subcategory</option>';

        allOptions.forEach(option => {
            if (option.value === "") return; // skip placeholder
            if (option.getAttribute('data-category') === selectedCategory) {
                subcategorySelect.appendChild(option.cloneNode(true));
            }
        });
    }

    // Initial filtering based on selected category
    if (categorySelect.value) {
        filterSubcategories();

        // Re-select the initial subcategory if it belongs to the selected category
        if (initialSubcategoryId) {
            for (let i = 0; i < subcategorySelect.options.length; i++) {
                if (subcategorySelect.options[i].value === initialSubcategoryId) {
                    subcategorySelect.options[i].selected = true;
                    break;
                }
            }
        }
    }

    // Tags input functionality
    const tagsInput = document.getElementById('meta_keywords_input');
    const tagsContainer = document.getElementById('tags_container');
    const hiddenInput = document.getElementById('meta_keywords_hidden');
    let tags = hiddenInput.value ? hiddenInput.value.split(',') : [];

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

    // Initial render of tags
    renderTags();

    // Image preview functionality
    window.previewImage = function(input) {
        const preview = document.getElementById('holder');
        preview.innerHTML = '';

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'img-fluid';
                img.style.maxHeight = '200px';
                img.style.borderRadius = '5px';
                preview.appendChild(img);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
});
</script>

@endsection


