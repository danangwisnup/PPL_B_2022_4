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
                            </ul>

                            <div class="tab-content mb-0 pb-0">

                                <!-- Tab Mahasiswa -->
                                <div class="tab-pane fade show active" id="tab-1">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-responsive-lg table-hover">
                                                    <thead class="thead-dark">
                                                        <tr>
                                                            <th>NIM</th>
                                                            <th>Nama</th>
                                                            <th>Email</th>
                                                            <th>Angkatan</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($mahasiswa as $data)
                                                        <tr>
                                                            <td>{{$data->nim}}</td>
                                                            <td>{{$data->nama}}</td>
                                                            <td>{{$data->email}}</td>
                                                            <td>{{$data->angkatan}}</td>
                                                            <td>
                                                                <button type="submit" class="btn btn-info-soft rounded-circle icon-md" data-bs-toggle="modal" data-bs-target="#mahasiswa_view" data-attr="">
                                                                    <i class="fa fa-pencil"></i>
                                                                </button>
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
                                        <div class="col-12">
                                            <div class="table-responsive">
                                                <table class="table table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>NIP</th>
                                                            <th>Nama</th>
                                                            <th>Email</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($dosen as $data)
                                                        <tr>
                                                            <td>{{$data->nim_nip}}</td>
                                                            <td>{{$data->nama}}</td>
                                                            <td>{{$data->email}}</td>
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
                                <!-- Tab Dosen END -->

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


<!-- Modal Mahasiswa -->
<div class="modal fade" data-bs-backdrop="static" data-keyboard="false" id="mahasiswa_view" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data Topup</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group row">
                        <div class="col-10">
                            <label for="recipient-name" class="col-form-label">Email </label>
                            <input type="text" class="form-control" id="topup_email" name="topup_email" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Deskripsi </label>
                        <h6 id="topup_deskripsi" name="topup_deskripsi"></h6>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <label for="recipient-name" class="col-form-label">Nominal </label>
                            <input type="number" class="form-control" id="topup_nominal" name="topup_nominal" readonly>
                        </div>
                        <div class="col">
                            <label for="recipient-name" class="col-form-label">Status </label>
                            <select class="form-control" id="topup_status" name="topup_status">
                                <option value="">-- Pilih Status --</option>
                                <option value="pending">Pending</option>
                                <option value="success">Success</option>
                                <option value="failed">Failed</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal" onclick="topup_update()">Submit</button>
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection