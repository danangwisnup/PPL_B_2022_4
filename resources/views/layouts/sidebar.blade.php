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
                    <div class="h-90px mb-2" style="background-image:url('/assets/images/bg/informatika.jpg'); background-position: center; background-size: cover; background-repeat: no-repeat;">
                    </div>
                    <!-- Card body START -->
                    <div class="card-body pt-0">
                        <div class="text-center">
                            <!-- Avatar -->
                            <div class="avatar avatar-xxl mt-n5 mb-1">
                                @if (Auth::user()->role == 'mahasiswa')
                                <a href="#"><img class="avatar-img rounded-circle border border-white border-5" src="{{ $mahasiswa->foto == null ? asset('assets/images/avatar/default.jpg') : asset($mahasiswa->foto) }}" alt=""></a>
                                @elseif (Auth::user()->role == 'dosen')
                                <a href="#"><img class="avatar-img rounded-circle border border-white border-5" src="{{ $dosen->foto == null ? asset('assets/images/avatar/default.jpg') : asset($dosen->foto) }}" alt=""></a>
                                @else
                                <a href="#"><img class="avatar-img rounded-circle border border-white border-5" src="{{ asset('assets/images/avatar/profile_department.jpg') }}" alt=""></a>
                                @endif
                            </div>
                            <!-- Info -->
                            <h1 class="mb-0 mt-2 small bold"><a href=""><strong>{{ Auth::user()->nama }}</strong></a></h1>
                            <div class="mt-1 small bold">{{ Auth::user()->nim_nip }}</div>
                            <div class="mt-1 text-dark" style="font-size: 14px;">
                                {{ Auth::user()->role == 'operator' ? 'Operator Department' : ''}}
                                {{ Auth::user()->role == 'mahasiswa' ? 'Student' : ''}}
                                {{ Auth::user()->role == 'dosen' ? 'Lecturer' : ''}}
                                {{ Auth::user()->role == 'department' ? 'Department' : ''}}
                            </div>
                        </div>

                        @if ($title != 'Edit Profile' && $title != 'Change Password')

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
                                <a style="font-size: 14px;" class="nav-link {{ ($title == 'Manage Users')? 'active' : '' }}" href="/operator/manage_users">
                                    <i class="bi bi-people"></i><span> Manage Users</span>
                                </a>
                            </li>
                            @elseif (Auth::user()->role == 'mahasiswa')
                            <li class="nav-item">
                                <a style="font-size: 14px;" class="nav-link {{ ($title == 'Entry Progress' || $title == 'Entry IRS' || $title == 'Entry KHS' || $title == 'Entry PKL' || $title == 'Entry Skripsi')? 'active' : '' }}" href="/mahasiswa/entry">
                                    <i class="bi bi-bar-chart"></i><span> Entry Progress</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a style="font-size: 14px;" class="nav-link {{ ($title == 'IRS')? 'active' : '' }}" href="/mahasiswa/data/irs">
                                    <i class="bi bi-book"></i><span> IRS</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a style="font-size: 14px;" class="nav-link {{ ($title == 'KHS')? 'active' : '' }}" href="/mahasiswa/data/khs">
                                    <i class="bi bi-list-columns"></i><span> KHS</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a style="font-size: 14px;" class="nav-link {{ ($title == 'PKL')? 'active' : '' }}" href="/mahasiswa/data/pkl">
                                    <i class="bi bi-building"></i><span> PKL</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a style="font-size: 14px;" class="nav-link {{ ($title == 'Skripsi')? 'active' : '' }}" href="/mahasiswa/data/skripsi">
                                    <i class="bi bi-mortarboard"></i><span> Skripsi</span>
                                </a>
                            </li>
                            @elseif (Auth::user()->role == 'dosen')
                            <li class="nav-item">
                                <a style="font-size: 14px;" class="nav-link {{ ($title == 'Progress Studi Mahasiswa')? 'active' : '' }}" href="/dosen/progress_studi_mahasiswa">
                                    <i class="bi bi-clipboard2-data"></i><span> Progress Studi Mahasiswa</span>
                                </a>
                            </li>
                            <?php
                            $progress = App\Models\tb_entry_progress::where('nip', Auth::user()->nim_nip)->where('is_irs', 1)->where('is_khs', 1)->where('is_pkl', 1)->where('is_skripsi', 1)->where('is_verifikasi', '0')->get();
                            $count = count($progress);
                            ?>
                            <li class="nav-item">
                                <a style="font-size: 14px;" class="nav-link {{ ($title == 'Verifikasi Berkas Mahasiswa')? 'active' : '' }}" href="/dosen/verifikasi_berkas_mahasiswa">
                                    <i class="bi bi-clipboard2-check"></i><span> Verifikasi Berkas Mahasiswa
                                        @if ($count > 0)
                                        <span class="badge bg-danger">{{ $count }}</span>
                                        @endif
                                </a>
                            </li>
                            @elseif (Auth::user()->role == 'department')
                            <li class="nav-item">
                                <a style="font-size: 14px;" class="nav-link {{ ($title == 'Progress Studi Mahasiswa')? 'active' : '' }}" href="/department/progress_studi_mahasiswa">
                                    <i class="bi bi-clipboard2-data"></i><span> Progress Studi Mahasiswa</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a style="font-size: 14px;" class="nav-link {{ ($title == 'Data Dosen')? 'active' : '' }}" href="/department/data_dosen">
                                    <i class="bi bi-file-earmark-text"></i><span> Data Dosen</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a style="font-size: 14px;" class="nav-link {{ ($title == 'Data Mahasiswa')? 'active' : '' }}" href="/department/data_mahasiswa">
                                    <i class="bi bi-file-earmark-text"></i><span> Data Mahasiswa</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a style="font-size: 14px;" class="nav-link {{ ($title == 'Data Mahasiswa PKL')? 'active' : '' }}" href="/department/data_mahasiswa_pkl">
                                    <i class="bi bi-building"></i><span> Data Mahasiswa PKL</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a style="font-size: 14px;" class="nav-link {{ ($title == 'Data Mahasiswa Skripsi')? 'active' : '' }}" href="/department/data_mahasiswa_skripsi">
                                    <i class="bi bi-mortarboard"></i><span> Data Mahasiswa Skripsi</span>
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
                    @if ($title == 'Edit Profile' || $title == 'Change Password')
                    <div class="card-footer text-center py-2">
                        <div class="mt-3">
                            Informatika S1 <br />
                            Fakultas Sains dan Matematika
                        </div>
                        <ul class="nav nav-link-secondary flex-column">
                            <li class="nav-item mt-2 mb-0">
                                <a style="font-size: 14px;" class="nav-link" href="/">
                                    <i class="bi bi-house-door"></i><span> Dashboard</span>
                                </a>
                            </li>
                            <hr />
                            <li class="nav-item">
                                <a style="font-size: 14px;" class="nav-link {{ ($title == 'Edit Profile')? 'active' : '' }}" href="/{{ Auth::User()->role }}/edit_profile">
                                    <i class="bi bi-mortarboard"></i><span> Edit Profile</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a style="font-size: 14px;" class="nav-link {{ ($title == 'Change Password') ? 'active' : '' }}" href="/{{ Auth::User()->role }}/change_password">
                                    <i class="bi bi-key"></i><span> Change Password</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                    <a style="font-size: 14px;" class="nav-link {{ ($title == 'Logout') ? 'active' : '' }}" href="{{ route('logout') }}">
                                        <i class="bi bi-power"></i><span> Logout</span>
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </div>
                    @else
                    <div class="card-footer text-center py-2">
                        <a class="btn btn-link btn-sm bold" style="font-size: 14px;" href="/{{ Auth::user()->role }}/edit_profile">Edit Profile </a>
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