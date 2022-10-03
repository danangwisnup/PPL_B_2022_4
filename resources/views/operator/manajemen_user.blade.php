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
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
                        <li>{{session('success')}}</li>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    <!-- Card START -->
                    <div class="card">
                        <!-- Card header START -->
                        <div class="card-header d-sm-flex text-center align-items-center justify-content-between border-0 pb-0">
                            <h1 class="card-title h5">Manajemen User</h1>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-tabs nav-bottom-line justify-content-center justify-content-md-start">
                                <li class="nav-item"> <a class="nav-link active" data-bs-toggle="tab" href="#tab-1"> Mahasiswa </a> </li>
                                <li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#tab-2"> Dosen </a> </li>
                                <li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#tab-3"> Departemen </a> </li>
                                <li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#tab-4"> Operator </a> </li>
                            </ul>

                            <div class="tab-content mb-0 pb-0">

                                <!-- Tab Mahasiswa -->
                                <div class="tab-pane fade show active" id="tab-1">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <div class="table-responsive">
                                                <table class="table table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>NIM</th>
                                                            <th>Nama</th>
                                                            <th>Email</th>
                                                            <th>Angkatan</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($mahasiswa as $mhs)
                                                        <tr>
                                                            <td>{{$mhs->nim}}</td>
                                                            <td>{{$mhs->nama}}</td>
                                                            <td>{{$mhs->email}}</td>
                                                            <td>{{$mhs->angkatan}}</td>
                                                            <td>
                                                                <a href="" class="btn btn-sm btn-success-soft">View More</a>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Tab Mahasiswa END -->

                                <!-- Tab Dosen -->
                                <div class="tab-pane fade" id="tab-2">
                                    <div class="row g-3">
                                        //Input
                                    </div>
                                </div>
                                <!-- Tab Dosen END -->

                                <!-- Tab Departemen -->
                                <div class="tab-pane fade" id="tab-3">
                                    <div class="row g-3">
                                        //Input
                                    </div>
                                </div>
                                <!-- Tab Departemen END -->

                                <!-- Tab Operator -->
                                <div class="tab-pane fade" id="tab-4">
                                    <div class="row g-3">
                                        //Input
                                    </div>
                                </div>
                                <!-- Tab Operator END -->

                            </div>
                        </div>
                        <!-- Card body END -->
                    </div>
                    <!-- Card END -->
                </div>

            </div> <!-- Row END -->
        </div>
        <!-- Container END -->
    </main>
</div>

@endsection