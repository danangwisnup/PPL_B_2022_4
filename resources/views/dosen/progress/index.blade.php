@extends('layouts.main')

@section('content')

<div class="container-scroller">

    @include('layouts.navbar')

    <main>

        <!-- Container START -->
        <div class="container">
            <div class="row g-4">

                @include('layouts.sidebar')

                <!-- Main content START -->
                <div class="col-md-8 col-lg-6 vstack gap-4">
                    @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    <!-- Card START -->
                    <div class="card">
                        <!-- Card header START -->
                        <div class="card-header d-sm-flex text-center align-items-center justify-content-between border-0 pb-0">
                            <h1 class="card-title h5">Cari Mahasiswa</h1>
                        </div>
                        <div class="card-body">
                            <form class="row g-3" action="/dosen/progress" method="POST">
                                @csrf
                                <div class="col-11">
                                    <input type="text" class="form-control" id="identifier" name="identifier" placeholder="Masukkan Nama, NIM atau Email Mahasiswa" required>
                                </div>
                                <div class="col-1">
                                    <button type="submit" class="icon-md btn btn-primary-soft p-0">
                                        <i class="bi bi-search fs-6"> </i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Card START -->
                    <div class="card">
                        <!-- Card header START -->
                        <div class="card-header d-sm-flex text-center align-items-center justify-content-between border-0 pb-0">
                            <h1 class="card-title h5">Progress Mahasiswa</h1>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class=" col-1">
                                </div>
                                <div class="col-2">
                                    <ul class="list-unstyled">
                                        <br />
                                        <li class="mb-3 border-bottom border-white border-2"> <strong> Nama: </strong> </li>
                                        <li class="mb-3 border-bottom border-white border-2"> <strong> NIM: </strong> </li>
                                        <li class="mb-3 border-bottom border-white border-2"> <strong> Angkatan: </strong> </li>
                                        <li class="mb-3 border-bottom border-white border-2"> <strong> Dosen Wali: </strong> </li>
                                    </ul>
                                </div>
                                <div class="col-5">
                                    <ul class="list-unstyled">
                                        <br />
                                        <li class="mb-3 border-bottom border-2"> 123 </li>
                                        <li class="mb-3 border-bottom border-2"> 123 </li>
                                        <li class="mb-3 border-bottom border-2"> 2020 </li>
                                        <li class="mb-3 border-bottom border-2"> webestica </li>
                                    </ul>
                                </div>
                                <div class="col-3">
                                    <div class="avatar avatar-xxxl mt-2 mb-2">
                                        <a href="#!"><img class="avatar-img border border-white border-3 rounded-circle" src="{{ asset('assets/images/avatar/03.jpg') }}" alt=""></a>
                                    </div>
                                </div>
                            </div>
                            <br />
                            <form class="row g-3" action="/dosen/progress_studi_mahasiswa" method="POST">
                                @csrf
                                @method('GET')
                                <div class=" col-1">
                                </div>
                                <div class="col-10">
                                    <h6>Semester</h6>
                                    <button class="btn btn-danger avatar-xl mb-3 me-2" type="submit">1</button>
                                    <button class="btn btn-danger avatar-xl mb-3 me-2" type="submit">2</button>
                                    <button class="btn btn-danger avatar-xl mb-3 me-2" type="submit">3</button>
                                    <button class="btn btn-danger avatar-xl mb-3 me-2" type="submit">4</button>
                                    <button class="btn btn-danger avatar-xl mb-3 me-2" type="submit">5</button>
                                    <button class="btn btn-danger avatar-xl mb-3 me-2" type="submit">6</button>
                                    <button class="btn btn-danger avatar-xl mb-3 me-2" type="submit">7</button>
                                    <button class="btn btn-danger avatar-xl mb-3 me-2" type="submit">8</button>
                                    <button class="btn btn-danger avatar-xl mb-3 me-2" type="submit">9</button>
                                    <button class="btn btn-danger avatar-xl mb-3 me-2" type="submit">10</button>
                                    <button class="btn btn-danger avatar-xl mb-3 me-2" type="submit">11</button>
                                    <button class="btn btn-danger avatar-xl mb-3 me-2" type="submit">12</button>
                                    <button class="btn btn-danger avatar-xl mb-3 me-2" type="submit">13</button>
                                    <button class="btn btn-danger avatar-xl mb-3 me-2" type="submit">14</button>

                                    <br />
                                    <h6 class="mt-2 mb-2">Keterangan:</h6>
                                    <a class="btn btn-info btn-sm mb-1"></a> <small>Sudah diisikan (IRS dan KHS)</small><br />
                                    <a class="btn btn-warning btn-sm mb-1"></a> <small>Sudah Lulus PKL (IRS, KHS, dan PKL)</small><br />
                                    <a class="btn btn-success btn-sm mb-1"></a> <small>Sudah Lulus Skripsi)</small><br />
                                    <a class="btn btn-danger btn-sm mb-1"></a> <small>Belum diisikan (IRS dan KHS) atau tidak digunakan</small><br />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

@endsection