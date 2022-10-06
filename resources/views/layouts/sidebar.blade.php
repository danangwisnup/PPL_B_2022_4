<!-- Sidenav START -->
<div class="col-lg-3">

    <!-- Advanced filter responsive toggler START -->
    <div class="d-flex align-items-center d-lg-none">
        <button class="border-0 bg-transparent" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSideNavbar" aria-controls="offcanvasSideNavbar">
            <i class="btn btn-primary fw-bold fa-solid fa-sliders-h"></i>
            <span class="h6 mb-0 fw-bold d-lg-none ms-2">My profile</span>
        </button>
    </div>
    <!-- Advanced filter responsive toggler END -->

    <!-- Navbar START-->
    <nav class="navbar navbar-expand-lg mx-0">
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasSideNavbar">
            <!-- Offcanvas header -->
            <div class="offcanvas-header">
                <button type="button" class="btn-close text-reset ms-auto" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>

            <!-- Offcanvas body -->
            <div class="offcanvas-body d-block px-2 px-lg-0">
                <!-- Card START -->
                <div class="card overflow-hidden">
                    <!-- Cover image -->
                    <div class="h-50px" style="background-image:url(http://ppl-project.test/assets/images/bg/01.jpg); background-position: center; background-size: cover; background-repeat: no-repeat;"></div>
                    <!-- Card body START -->
                    <div class="card-body pt-0">
                        <div class="text-center">
                            <!-- Avatar -->
                            <div class="avatar avatar-lg mt-n5 mb-3">
                                <a href="#!"><img class="avatar-img rounded border border-white border-3" src="{{ asset('assets/images/avatar/07.jpg') }}" alt=""></a>
                            </div>
                            <!-- Info -->
                            <h5 class="mb-0"> <a href="#!">{{ Auth::user()->nama }}</a> </h5>
                            <small class="mb-2">{{ Auth::user()->email }}</small>
                            <br>
                            <small>{{ Auth::user()->role }}</small>
                        </div>

                        <!-- Divider -->
                        <hr>

                        <!-- Side Nav START -->
                        @if (Auth::user()->role == 'operator')
                        <ul class="nav nav-tabs nav-pills nav-pills-soft flex-column fw-bold gap-0 border-0">
                            <li>
                                <a class="dropdown-item {{ ($title == 'Dashboard')? 'active' : '' }}" href="/dashboard">
                                    <i class="bi bi-house-door-fill"></i><span> Dashboard</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item {{ ($title == 'Add User')? 'active' : '' }}" href="/operator/add_user">
                                    <i class="bi bi-person-plus-fill"></i><span> Add User</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item {{ ($title == 'Manajemen User')? 'active' : '' }}" href="/operator/manajemen_user">
                                    <i class="bi bi-people-fill"></i><span> Manajemen User</span>
                                </a>
                            </li>
                        </ul>
                        @elseif (Auth::user()->role == 'mahasiswa')
                        <ul class="nav nav-tabs nav-pills nav-pills-soft flex-column fw-bold gap-0 border-0">
                            <li>
                                <a class="dropdown-item {{ ($title == 'Dashboard')? 'active' : '' }}" href="/dashboard">
                                    <i class="bi bi-house-door-fill"></i><span> Dashboard</span>
                                </a>
                            </li>
                        </ul>
                        @elseif (Auth::user()->role == 'dosen')
                        <ul class="nav nav-tabs nav-pills nav-pills-soft flex-column fw-bold gap-0 border-0">
                            <li>
                                <a class="dropdown-item {{ ($title == 'Dashboard')? 'active' : '' }}" href="/dashboard">
                                    <i class="bi bi-house-door-fill"></i><span> Dashboard</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item {{ ($title == 'Dashboard')? 'active' : '' }}" href="/dashboard">
                                    <i class="bi bi-people-fill"></i><span> Progress Studi Mahasiswa</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item {{ ($title == 'Dashboard')? 'active' : '' }}" href="/dashboard">
                                    <i class="bi bi-house-door-fill"></i><span> Dashboard</span>
                                </a>
                            </li>
                        </ul>
                        @else
                        <ul class="nav nav-tabs nav-pills nav-pills-soft flex-column fw-bold gap-0 border-0">
                            <li>
                                <a class="dropdown-item {{ ($title == 'Dashboard')? 'active' : '' }}" href="/dashboard">
                                    <i class="bi bi-house-door-fill"></i><span> Dashboard</span>
                                </a>
                            </li>
                        </ul>
                        @endif

                        <!-- Side Nav END -->
                    </div>
                    <!-- Card body END -->
                    <!-- Card footer -->
                    <div class="card-footer text-center py-2">
                        <a class="btn btn-link btn-sm" href="javascript:;">View Profile </a>
                    </div>
                </div>
                <!-- Card END -->
            </div>
        </div>
    </nav>
    <!-- Navbar END-->
</div>
<!-- Sidenav END -->