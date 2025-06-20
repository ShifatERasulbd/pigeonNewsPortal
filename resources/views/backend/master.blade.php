
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Pigeon News</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{asset('backend')}}/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="{{asset('backend')}}/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    <!-- Summernote CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet">

    <!-- Summernote JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>
    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('backend')}}/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{asset('backend')}}/css/style.css" rel="stylesheet">

</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->
        {{-- left side bar --}}
        @include('backend.sidebar')
        {{-- left side bar   --}}
        <!-- Content Start -->
        <div class="content bg-white">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <form class="d-none d-md-flex ms-4">
                    <input class="form-control bg-dark border-0" type="search" placeholder="Search">
                </form>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-envelope me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Message</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all message</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-bell me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Notificatin</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Profile updated</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">New user added</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Password changed</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all notifications</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex">John Doe</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">My Profile</a>
                            <a href="#" class="dropdown-item">Settings</a>
                            <a href="#" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->


        @yield('main')



            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="#">Your Site Name</a>, All Right Reserved.
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end">
                            <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                            Designed By <a href="https://htmlcodex.com">HTML Codex</a>
                            <br>Distributed By: <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('backend')}}/lib/chart/chart.min.js"></script>
    <script src="{{asset('backend')}}/lib/easing/easing.min.js"></script>
    <script src="{{asset('backend')}}/lib/waypoints/waypoints.min.js"></script>
    <script src="{{asset('backend')}}/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="{{asset('backend')}}/lib/tempusdominus/js/moment.min.js"></script>
    <script src="{{asset('backend')}}/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="{{asset('backend')}}/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="{{asset('backend')}}/js/main.js"></script>
<!--https://unisharp.github.io/laravel-filemanager/installation  -->
    <script>
    function initSummernote(selector) {
        $(selector).summernote({
            height: 250,
            callbacks: {
                onImageUpload: function(files) {
                    sendFile(files[0], $(this));
                },
                onInit: function() {
                    let toolbar = $(this).next('.note-editor').find('.note-toolbar');
                    toolbar.append(`
                        <button type="button" class="btn btn-sm btn-light btn-lfm" data-type="Images">
                            <i class="note-icon-picture"></i> Browse
                        </button>
                    `);
                }
            }
        });
    }

    function sendFile(file, $editor) {
        var data = new FormData();
        data.append("upload", file);
        data.append("_token", $('meta[name="csrf-token"]').attr('content'));

        $.ajax({
            url: "/laravel-filemanager/upload?type=Images",
            method: "POST",
            data: data,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.url) {
                    $editor.summernote('insertImage', response.url);
                } else {
                    alert("Upload failed");
                }
            },
            error: function(jqXHR) {
                console.error("Upload error:", jqXHR);
                alert("Upload error: " + jqXHR.statusText);
            }
        });
    }

    function openLfm(callback, type = 'Images') {
        window.open('/laravel-filemanager?type=' + type, 'FileManager', 'width=900,height=600');
        window.SetUrl = callback;
    }

    $(document).ready(function() {
        const APP_URL = "{{ url('/') }}";

        // ✅ Initialize Summernote for .my-editor class
        $('.my-editor').each(function() {
            initSummernote(this);
        });

        // ✅ Initialize Summernote for .summernote class
        $('.summernote').each(function() {
            initSummernote(this);
        });

        // ✅ Add new repeater block
        $('body').on('click', '.btn-increment', function() {
            let html = $('.clone').html();
            let newElement = $(html);
            $('.image-repeater-wrapper').append(newElement);
            newElement.find('.summernote, .my-editor').each(function() {
                initSummernote(this);
            });
        });

        // ✅ Remove repeater block
        $('body').on('click', '.remove-btn', function() {
            $(this).closest('.control-group').remove();
        });

        // ✅ Handle image upload to Summernote via "Browse"
        $('body').on('click', '.btn-lfm', function() {
            let $note = $(this).closest('.note-editor').prev('.summernote, .my-editor');
            openLfm(function(urls) {
                if (typeof urls === 'string') {
                    $note.summernote('insertImage', urls);
                } else if (Array.isArray(urls)) {
                    urls.forEach(function(item) {
                        $note.summernote('insertImage', item.url);
                    });
                }
            }, 'Images');
        });

        function lfm(id, type, options) {
            let button = document.getElementById(id);
            if (!button) return;

            button.addEventListener('click', function() {
                var route_prefix = (options && options.prefix) ? options.prefix : '/laravel-filemanager';
                var target_input = document.getElementById(button.getAttribute('data-input'));
                var target_preview = document.getElementById(button.getAttribute('data-preview'));

                window.open(route_prefix + '?type=' + (options.type || 'file'), 'FileManager', 'width=900,height=600');

                window.SetUrl = function(items) {
                    var file_path = items.map(item => item.url).join(',');
                    target_input.value = file_path;
                    target_input.dispatchEvent(new Event('change'));

                    if (target_preview) {
                        target_preview.innerHTML = '';
                        items.forEach(item => {
                            let img = document.createElement('img');
                            img.setAttribute('style', 'height: 5rem');
                            img.setAttribute('src', item.thumb_url);
                            target_preview.appendChild(img);
                        });
                        target_preview.dispatchEvent(new Event('change'));
                    }
                };
            });
        }

        // ✅ Initialize LFM picker button
        lfm('lfm', 'image', {
            prefix: '/laravel-filemanager'
        });
    });
</script>
</body>

</html>
