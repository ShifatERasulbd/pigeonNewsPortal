@extends('backend.master')
@section('main')

<!-- Recent Sales Start -->
<div class="container-fluid pt-4 px-4">
    <div class="d-flex justify-content-end mb-2">
        <!-- Button trigger modal -->
       <button type="button" class="btn btn-primary btn-sm d-flex align-items-center gap-1 text-dark" data-bs-toggle="modal" data-bs-target="#addImageGalleryModal">
            <i class="fa fa-plus"></i>
            Add Image
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

  @include ('backend.image-galleries.create')

    <div class="bg-secondary bg-white text-center rounded p-4">
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark">
                        <th scope="col">SL</th>
                        <th scope="col">Image</th>
                        <th scope="col">Title</th>
                        <th scope="col">Category</th>
                        <th scope="col">Description</th>
                        <th scope="col">Option</th>
                    </tr>
                </thead>
                <tbody>
                    @if($imageGalleries->isNotEmpty())
                        @foreach($imageGalleries as $key => $gallery)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    <div class="gallery-thumbnails d-flex flex-wrap gap-1 justify-content-center">
                                        @if($gallery->images && $gallery->images->count() > 0)
                                            @foreach($gallery->images->take(3) as $image)
                                                <img src="{{ asset($image->image_path) }}" alt="Gallery Image"
                                                     class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover;">
                                            @endforeach

                                            @if($gallery->images->count() > 3)
                                                <div class="more-images bg-secondary rounded d-flex align-items-center justify-content-center"
                                                     style="width: 50px; height: 50px; font-size: 12px;">
                                                    +{{ $gallery->images->count() - 3 }}
                                                </div>
                                            @endif
                                        @else
                                            <span class="text-muted">No images</span>
                                        @endif
                                    </div>
                                </td>
                                <td>{{ $gallery->title }}</td>
                                <td>
                                    @if($gallery->category)
                                        {{ $gallery->category->name }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    @if(strlen($gallery->description) > 50)
                                        {{ substr($gallery->description, 0, 50) }}...
                                    @else
                                        {{ $gallery->description }}
                                    @endif
                                </td>
                                <td>
                                  <a class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editImageGalleryModal{{ $gallery->id }}">
                                    <i class="fa-solid fa-pen"></i> Edit
                                  </a>
                                   <form action="{{ route('image-gallery.destroy', $gallery->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this gallery?')">
                                            <i class="fa-solid fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Include edit modal for each gallery -->
                            @include('backend.image-galleries.edit', ['gallery' => $gallery])
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="text-center text-dark">No galleries found.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Recent Sales End -->

<!-- Image Preview Modal -->
<div class="modal fade" id="imagePreviewModal" tabindex="-1" aria-labelledby="imagePreviewModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="imagePreviewModalLabel">Gallery Images</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="galleryCarousel" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner" id="carouselInner">
            <!-- Images will be loaded here dynamically -->
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#galleryCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#galleryCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Auto-hide success toast after 5 seconds
    setTimeout(function() {
      const successToast = document.getElementById('successToast');
      if (successToast) {
        const bsToast = new bootstrap.Toast(successToast);
        bsToast.hide();
      }
    }, 5000);

    // Make gallery thumbnails clickable to show full gallery
    const galleryThumbnails = document.querySelectorAll('.gallery-thumbnails');

    galleryThumbnails.forEach(thumbnailContainer => {
      thumbnailContainer.addEventListener('click', function() {
        const galleryId = this.closest('tr').querySelector('[data-bs-target^="#editImageGalleryModal"]')
                             .getAttribute('data-bs-target').replace('#editImageGalleryModal', '');

        // Find all images for this gallery
        const modalImages = document.querySelectorAll(`#editImageGalleryModal${galleryId} .image-container img`);
        const carouselInner = document.getElementById('carouselInner');
        carouselInner.innerHTML = '';

        modalImages.forEach((img, index) => {
          const slide = document.createElement('div');
          slide.className = index === 0 ? 'carousel-item active' : 'carousel-item';

          const image = document.createElement('img');
          image.src = img.src;
          image.className = 'd-block w-100';
          image.style.maxHeight = '500px';
          image.style.objectFit = 'contain';

          slide.appendChild(image);
          carouselInner.appendChild(slide);
        });

        // Show the modal
        const imagePreviewModal = new bootstrap.Modal(document.getElementById('imagePreviewModal'));
        imagePreviewModal.show();
      });
    });
  });
</script>

@endsection


