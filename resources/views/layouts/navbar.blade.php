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

                    <!-- <ul class="navbar-nav navbar-nav-scroll ms-auto">
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
                    </ul> -->

                </div>
                <!-- Main navbar END -->

                <!-- Nav right START -->
                <ul class="nav flex-nowrap align-items-center list-unstyled">

                    <li class="nav-item dropdown ms-2">
                        <a class="icon-md btn btn-primary p-0" href="#" id="notifDropdown" role="button" data-bs-auto-close="outside" data-bs-display="static" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="badge-notif animation-blink"></span>
                            <i class="bi bi-chat-left-text-fill fs-6"> </i>
                        </a>
                        <div class="dropdown-menu dropdown-animation dropdown-menu-end dropdown-menu-size-md p-0 shadow-lg border-0" aria-labelledby="notifDropdown">
                            <div class="card">
                                <div class="card-body p-0">
                                    <ul class="list-group list-group-flush list-unstyled p-">
                                        <!-- Notif item -->
                                        <li>
                                            <a href="#" class="list-group-item list-group-item-action rounded d-flex border-0 mb-1 p-3">
                                                <div class="avatar text-center d-none d-sm-inline-block">
                                                    <img class="avatar-img rounded-circle" src="/assets/images/avatar/profile_department.jpg" alt="">
                                                </div>
                                                <div class="ms-sm-3">
                                                    <div class="d-flex">
                                                        <p class="small mb-2"><b>Department:</b> Silahkan mengisi progress Anda</p>
                                                        <p class="small ms-3" style="font-size: 11px;"><?php \Carbon\Carbon::setLocale('id')?> {{ \Carbon\Carbon::createFromDate('2022-10-30')->diffForHumans() }} </p>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                    <!-- Notification dropdown END -->

                    <li class="nav-item ms-2 dropdown">
                        <a class="icon-md btn btn-primary p-0" href="" id="profileDropdown" role="button" data-bs-auto-close="outside" data-bs-display="static" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle fs-6"> </i>
                        </a>
                        <ul class="dropdown-menu dropdown-animation dropdown-menu-end pt-3 small me-md-n3" aria-labelledby="profileDropdown">
                            <!-- Profile info -->
                            <li class="px-3">
                                <div class="position-relative text-center">
                                    <div>
                                        <h1 class="mt-3 mb-4 small bold"><a href=""><strong>{{ Auth::user()->nama }}</strong>
                                            </a></h1>
                                    </div>
                                </div>
                                <a class="dropdown-item btn btn-primary-soft btn-sm my-2 text-center" href="/{{ Auth::User()->role }}/edit_profile">View profile</a>
                            </li>
                            <li class="dropdown-divider m-3"></li>
                            <li>
                                <a class="dropdown-item bg-danger-soft-hover" href="/{{ Auth::user()->role }}/change_password"><i class="bi bi-key fa-fw me-2"></i>Change password</a>
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