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
                    <div class="h-80px mb-2" style="background-image:url(http://ppl-project.test/assets/images/bg/Widya-Puraya-1.jpg); background-position: center; background-size: cover; background-repeat: no-repeat;"></div>
                    <!-- Card body START -->
                    <div class="card-body pt-0">
                        <div class="text-center">
                            <!-- Avatar -->
                            <div class="avatar avatar-xxl mt-n5 mb-1">
                                <a href="#!"><img class="avatar-img border border-white border-3 rounded-circle" src="{{ asset('assets/images/avatar/03.jpg') }}" alt=""></a>
                            </div>
                            <!-- Info -->
                            <h5 class="mb-0"> <a href="#!">{{ Auth::user()->nama }}</a> </h5>
                            <div>{{ Auth::user()->nim_nip }}</div>
                            <div class="mt-1 text-dark" style="font-size: 15px;">{{ Auth::user()->role }}</div>
                        </div>

                        @if ($title != 'Edit Profile')

                        <!-- Divider -->
                        <hr>
                        <!-- Side Nav START -->
                        <ul class="nav nav-link-secondary flex-column fw-bold gap-2">
                            <li class="nav-item">
                                <a style="font-size: 14px;" class="nav-link {{ ($title == 'Dashboard')? 'active' : '' }}" href="/dashboard">
                                    <i class="bi bi-house-door"></i><span> Dashboard</span>
                                </a>
                            </li>
                            @if (Auth::user()->role == 'operator')
                            <li class="nav-item">
                                <a style="font-size: 14px;" class="nav-link {{ ($title == 'Add User')? 'active' : '' }}" href="/operator/add_user">
                                    <i class="bi bi-person-plus"></i><span> Add User</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a style="font-size: 14px;" class="nav-link {{ ($title == 'Manajemen User')? 'active' : '' }}" href="/operator/manajemen_user">
                                    <i class="bi bi-people"></i><span> Manajemen User</span>
                                </a>
                            </li>
                            @elseif (Auth::user()->role == 'mahasiswa')
                            <li class="nav-item">
                                <a style="font-size: 14px;" class="nav-link {{ ($title == 'IRS')? 'active' : '' }}" href="/mahasiswa/irs">
                                    <i class="bi bi-book"></i><span> IRS</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a style="font-size: 14px;" class="nav-link {{ ($title == 'KHS')? 'active' : '' }}" href="/mahasiswa/khs">
                                    <i class="bi bi-list-columns"></i><span> KHS</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a style="font-size: 14px;" class="nav-link {{ ($title == 'PKL')? 'active' : '' }}" href="/mahasiswa/pkl">
                                    <i class="bi bi-building"></i><span> PKL</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a style="font-size: 14px;" class="nav-link {{ ($title == 'Skripsi')? 'active' : '' }}" href="/mahasiswa/skripsi">
                                    <i class="bi bi-mortarboard"></i><span> Skripsi</span>
                                </a>
                            </li>
                            @elseif (Auth::user()->role == 'dosen')
                            <li class="nav-item">
                                <a style="font-size: 14px;" class="nav-link {{ ($title == 'Progress Studi Mahasiswa')? 'active' : '' }}" href="/dosen/progress_studi_mahasiswa">
                                    <i class="bi bi-clipboard2-data"></i><span> Progress Studi Mahasiswa</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a style="font-size: 14px;" class="nav-link {{ ($title == 'Verifikasi Berkas Mahasiswa')? 'active' : '' }}" href="/dosen/verifikasi_berkas_mahasiswa">
                                    <i class="bi bi-clipboard2-check"></i><span> Verifikasi Berkas Mahasiswa</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a style="font-size: 14px;" class="nav-link {{ ($title == 'Data Mahasiswa')? 'active' : '' }}" href="/dosen/data_mahasiswa">
                                    <i class="bi bi-file-earmark-text"></i><span> Data Mahasiswa</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a style="font-size: 14px;" class="nav-link {{ ($title == 'Data Mahasiswa PKL')? 'active' : '' }}" href="/dosen/data_mahasiswa_pkl">
                                    <i class="bi bi-building"></i><span> Data Mahasiswa PKL</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a style="font-size: 14px;" class="nav-link {{ ($title == 'Data Mahasiswa Skripsi')? 'active' : '' }}" href="/dosen/data_mahasiswa_skripsi">
                                    <i class="bi bi-mortarboard"></i><span> Data Mahasiswa Skripsi</span>
                                </a>
                            </li>
                            @elseif (Auth::user()->role == 'department')
                            <li class="nav-item">
                                <a style="font-size: 14px;" class="nav-link {{ ($title == 'Progress Studi Mahasiswa')? 'active' : '' }}" href="/department/progress_studi_mahasiswa">
                                    <i class="bi bi-clipboard2-data"></i><span> Progress Studi Mahasiswa</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a style="font-size: 14px;" class="nav-link {{ ($title == 'Data Mahasiswa')? 'active' : '' }}" href="/department/data_mahasiswa">
                                    <i class="bi bi-file-earmark-text"></i><span> Data Mahasiswa</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a style="font-size: 14px;" class="nav-link {{ ($title == 'Data Dosen')? 'active' : '' }}" href="/department/data_dosen">
                                    <i class="bi bi-file-earmark-text"></i><span> Data Dosen</span>
                                </a>
                            </li>
                            @endif

                            <li class="nav-item">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button style="font-size: 14px;" class="nav-link btn fw-bold">
                                        <i class="bi bi-power"></i><span> Logout</span>
                                    </button>
                                </form>
                            </li>
                        </ul>
                        <!-- Side Nav END -->
                        @endif
                    </div>
                    <!-- Card body END -->
                    <!-- Card footer -->
                    @if ($title == 'Edit Profile')
                    <div class="card-footer text-center py-2">
                        Informatika S1 <br />
                        Fakultas Sains dan Matematika
                        <a class="btn btn-link btn-sm bold mt-3" style="font-size: 14px;" href="{{ url()->previous() }}">
                            <i class="bi bi-arrow-bar-left"></i> Kembali
                        </a>
                    </div>
                    @elseif (Auth::user()->role == 'mahasiswa')
                    <div class="card-footer text-center py-2">
                        <a class="btn btn-link btn-sm bold" style="font-size: 14px;" href="/mahasiswa/edit_profile">Edit Profile </a>
                    </div>
                    @endif
                </div>
                <!-- Card END -->
            </div>
        </div>
    </nav>
    <!-- Navbar END-->
</div>
<!-- Sidenav END -->