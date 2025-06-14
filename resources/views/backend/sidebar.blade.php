
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
                        <a href="#" class="nav-item nav-link d-flex flex-column align-items-center p-0">
                            <!-- Widgets SVG (grid) -->
                            <svg viewBox="0 0 16 16">
                                <rect width="4" height="4" x="1" y="1" rx="1"/>
                                <rect width="4" height="4" x="6" y="1" rx="1"/>
                                <rect width="4" height="4" x="11" y="1" rx="1"/>
                                <rect width="4" height="4" x="1" y="6" rx="1"/>
                                <rect width="4" height="4" x="6" y="6" rx="1"/>
                                <rect width="4" height="4" x="11" y="6" rx="1"/>
                            </svg>
                            <span class="text-white">Widgets</span>
                        </a>
                    </div>
                </div>
                <div class="col-md-6 mb-3 sidebar-menu-box ">
                    <div class="shadow-lg rounded-4 p-3">
                        <a href="#" class="nav-item nav-link d-flex flex-column align-items-center p-0">
                            <!-- Forms SVG (keyboard) -->
                            <svg viewBox="0 0 16 16">
                                <rect width="14" height="6" x="1" y="5" rx="1"/>
                                <rect width="2" height="2" x="3" y="7" rx="0.5"/>
                                <rect width="2" height="2" x="6" y="7" rx="0.5"/>
                                <rect width="2" height="2" x="9" y="7" rx="0.5"/>
                                <rect width="2" height="2" x="12" y="7" rx="0.5"/>
                            </svg>
                            <span class="text-white">Forms</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</div>
<!-- Sidebar End -->
