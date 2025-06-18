
<!-- Sidebar Start -->
<div class="sidebar pe-4 pb-3 col-md-6">
    <nav class="navbar bg-secondary navbar-dark">
        <a href="index.html" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary">
                <!-- Example SVG for user-edit -->
                <svg width="24" height="24" fill="currentColor" class="me-2" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706l-1.439 1.439-2.121-2.121 1.439-1.439a.5.5 0 0 1 .706 0l1.415 1.415zm-2.561 2.561-2.121-2.121-8.486 8.486a.5.5 0 0 0-.121.196l-1 4a.5.5 0 0 0 .606.606l4-1a.5.5 0 0 0 .196-.12l8.486-8.487z"/>
                </svg>
                Pigeon News
            </h3>
        </a>

        {{-- <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0">Jhon Doe</h6>
                <span>Admin</span>
            </div>
        </div> --}}

        <div>
            <div class="row align-items-stretch">
                <div class="col-md-6 mb-3 sidebar-menu-box">
                    <div class=" shadow-lg rounded-4 p-3">
                        <a href="{{ route('dashboard') }}" class="nav-item nav-link d-flex flex-column align-items-center p-0 active">
                            <!-- Dashboard SVG -->
                            <svg viewBox="0 0 16 16">
                                <path d="M3 13h2v-2H3v2zm0-4h2V7H3v2zm4 4h2v-2H7v2zm0-4h2V7H7v2zm4 4h2v-2h-2v2zm0-4h2V7h-2v2z"/>
                                <path d="M1 2.5A1.5 1.5 0 0 1 2.5 1h11A1.5 1.5 0 0 1 15 2.5v11a1.5 1.5 0 0 1-1.5 1.5h-11A1.5 1.5 0 0 1 1 13.5v-11zm1 0A.5.5 0 0 0 1.5 3v11a.5.5 0 0 0 .5.5h11a.5.5 0 0 0 .5-.5v-11A.5.5 0 0 0 13.5 2h-11z"/>
                            </svg>
                            <span class="text-white">Dashboard</span>
                        </a>
                    </div>
                </div>
                <div class="col-md-6 mb-3 sidebar-menu-box ">
                    <div class="shadow-lg rounded-4 p-3">
                        <a href="{{ route('categories.index') }}" class="nav-item nav-link d-flex flex-column align-items-center p-0">
                            <!-- Bed SVG -->
                            <svg viewBox="0 0 16 16">
                                <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H2zm0 1h12v12H2V2zm2 2a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm8 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm-8 4h8v4H4V8z"/>
                            </svg>
                            <span class="text-white">Category</span>
                        </a>
                    </div>
                </div>

                <div class="col-md-6 mb-3 sidebar-menu-box ">
                    <div class="shadow-lg rounded-4 p-3">
                        <a href="{{ route('subcategories.index') }}" class="nav-item nav-link d-flex flex-column align-items-center p-0">
                            <!-- Bed SVG -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers">
                                <rect x="3" y="4" width="8" height="4" rx="1" />
                                <line x1="11" y1="6" x2="20" y2="6" />
                                <rect x="6" y="10" width="8" height="4" rx="1" />
                                <line x1="14" y1="12" x2="20" y2="12" />
                                <rect x="9" y="16" width="8" height="4" rx="1" />
                                <line x1="17" y1="18" x2="20" y2="18" />
                                </svg>

                            <span class="text-white">Sub Category</span>
                        </a>
                    </div>
                </div>





                  <div class="col-md-6 mb-3 sidebar-menu-box ">
                    <div class="shadow-lg rounded-4 p-3">
                        <a href="{{ route('news.index') }}" class="nav-item nav-link d-flex flex-column align-items-center p-0">
                            <!-- Widgets SVG (grid) -->
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-news">
                            <rect x="3" y="5" width="18" height="14" rx="2" ry="2" stroke="currentColor" fill="none"/>
                            <path d="M7 8h10M7 12h6M7 16h10" />
                          </svg>

                            <span class="text-white">News</span>
                        </a>
                    </div>
                </div>

                 <div class="col-md-6 mb-3 sidebar-menu-box ">
                    <div class="shadow-lg rounded-4 p-3">
                        <a href="{{ route('Top-lead-news') }}" class="nav-item nav-link d-flex flex-column align-items-center p-0">
                            <!-- Widgets SVG (grid) -->
                         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <!-- Newspaper outline -->
                                <rect x="3" y="5" width="18" height="14" rx="2" ry="2" fill="none" stroke="white"/>

                                <!-- Headline line -->
                                <line x1="7" y1="9" x2="17" y2="9" stroke="white"/>

                                <!-- Content lines -->
                                <line x1="7" y1="12" x2="14" y2="12" stroke="white"/>
                                <line x1="7" y1="15" x2="14" y2="15" stroke="white"/>

                                <!-- Crown icon (Top indicator) -->
                                <path d="M6 4l2 2 2-2 2 2 2-2 2 2 2-2v2H6V4z" fill="white" stroke="white"/>
                            </svg>



                            <span class="text-white">Top Lead News</span>
                        </a>
                    </div>
                </div>

                <div class="col-md-6 mb-3 sidebar-menu-box ">
                    <div class="shadow-lg rounded-4 p-3">
                        <a href="{{ route('lead-news') }}" class="nav-item nav-link d-flex flex-column align-items-center p-0">
                            <!-- Widgets SVG (grid) -->
                         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <!-- Newspaper outline -->
                                <rect x="3" y="5" width="18" height="14" rx="2" ry="2" fill="none" stroke="white"/>

                                <!-- Headline line -->
                                <line x1="7" y1="9" x2="17" y2="9" stroke="white"/>

                                <!-- Content lines -->
                                <line x1="7" y1="12" x2="14" y2="12" stroke="white"/>
                                <line x1="7" y1="15" x2="14" y2="15" stroke="white"/>

                                <!-- Crown icon (Top indicator) -->
                                <path d="M6 4l2 2 2-2 2 2 2-2 2 2 2-2v2H6V4z" fill="white" stroke="white"/>
                            </svg>



                            <span class="text-white">Lead News</span>
                        </a>
                    </div>
                </div>


                  <div class="col-md-6 mb-3 sidebar-menu-box ">
                    <div class="shadow-lg rounded-4 p-3">
                        <a href="{{ route('location.index') }}" class="nav-item nav-link d-flex flex-column align-items-center p-0">
                            <!-- Widgets SVG (grid) -->
                         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="white" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <!-- Map pin -->
                            <path d="M12 21s-6-5.5-6-10a6 6 0 1 1 12 0c0 4.5-6 10-6 10z" />
                            <!-- Center circle -->
                            <circle cx="12" cy="11" r="2.5" fill="white" stroke="white"/>
                        </svg>
                            <span class="text-white">Location</span>
                        </a>
                    </div>
                </div>



                 <div class="col-md-6 mb-3 sidebar-menu-box ">
                    <div class="shadow-lg rounded-4 p-3">
                        <a href="{{ route('image-category.index') }}" class="nav-item nav-link d-flex flex-column align-items-center p-0">
                            <!-- Widgets SVG (grid) -->
                         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="white" viewBox="0 0 24 24">
                            <path d="M4 4h5l2 2h9a1 1 0 0 1 1 1v11a2 2 0 0 1-2 2H5a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1zm1 3v11h14V8H6zm3 9l2.5-3.01L14 17h-8zm7-6.5a1.5 1.5 0 1 0-3.001-.001A1.5 1.5 0 0 0 16 9.5z"/>
                        </svg>

                            <span class="text-white">Image Category</span>
                        </a>
                    </div>
                </div>

                 <div class="col-md-6 mb-3 sidebar-menu-box ">
                    <div class="shadow-lg rounded-4 p-3">
                        <a href="{{ route('image-gallery.index') }}" class="nav-item nav-link d-flex flex-column align-items-center p-0">
                            <!-- Widgets SVG (grid) -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-photo">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
                            <circle cx="8.5" cy="8.5" r="1.5" />
                            <path d="M21 15l-5-5L5 21" />
                        </svg>


                            <span class="text-white">Image Gallery</span>
                        </a>
                    </div>
                </div>




            </div>
        </div>
    </nav>
</div>
<!-- Sidebar End -->
