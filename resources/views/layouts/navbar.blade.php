    <!-- Header START -->
    <header class="navbar-light fixed-top header-static bg-mode">

        <!-- Logo Nav START -->
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <!-- Logo START -->
                <a class="navbar-brand" href="/">
                    <img class="light-mode-item navbar-brand-item" src="{{ asset('assets/images/undip.png') }}" alt="logo">
                </a>
                <a class="text-dark desktop" href="/">
                    <strong>SI-Monitoring Akademik Informatika</strong>
                </a>
                <a class="text-dark mobile" href="/">
                    <strong>SI-MAIF</strong>
                </a>
                <!-- Logo END -->

                <!-- Main navbar START -->
                <div class="collapse navbar-collapse" id="navbarCollapse">

                    <ul class="navbar-nav navbar-nav-scroll ms-auto">
                        <li class="nav-item ms-2">
                            <a class="icon-md btn btn-primary p-0" href="">
                                <i class="bi bi-chat-left-text-fill fs-6"> </i>
                            </a>
                        </li>
                        <li class="nav-item ms-2">
                            <a class="icon-md btn btn-primary p-0" href="">
                                <i class="bi bi-gear-fill fs-6"> </i>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- Main navbar END -->

                <!-- Nav right START -->
                <ul class="nav flex-nowrap align-items-center list-unstyled">

                    <li class="nav-item ms-2 dropdown">
                        <a class="icon-md btn btn-primary p-0" href="" id="profileDropdown" role="button" data-bs-auto-close="outside" data-bs-display="static" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle fs-6"> </i>
                        </a>
                        <ul class="dropdown-menu dropdown-animation dropdown-menu-end pt-3 small me-md-n3" aria-labelledby="profileDropdown">
                            <!-- Profile info -->
                            <li class="px-3">
                                <div class="position-relative text-center">
                                    <div>
                                        <h1 class="mt-3 mb-4 small bold"><a href=""><strong>{{ Auth::user()->nama }}</strong></a></h1>
                                    </div>
                                </div>
                                <a class="dropdown-item btn btn-primary-soft btn-sm my-2 text-center" href="javascript:;">View profile</a>
                            </li>
                            <li class="dropdown-divider m-3"></li>
                            <li>
                                <form method="POST" action="/{{ Auth::user()->role }}/change_password/">
                                    <button class="dropdown-item bg-danger-soft-hover"><i class="bi bi-key fa-fw me-2"></i>Change Password</button>
                                </form>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item bg-danger-soft-hover"><i class="bi bi-power fa-fw me-2"></i>Log Out</button>
                                </form>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                        </ul>
                    </li>
                    <!-- Profile START -->

                </ul>
                <!-- Nav right END -->
            </div>
        </nav>
        <!-- Logo Nav END -->
    </header>