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
                            <h1 class="card-title h5">Manage Users</h1>
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
                                        @if ($mahasiswa->count() > 0)
                                        <div class="d-flex flex-column align-items-end">
                                            <a class="btn btn-danger-soft btn-sm" id="buttonConfirmDelete_Mhs" data-bs-toggle="modal" data-bs-target="#confirm_delete_mhs" data-attr="{{ route('delete_mahasiswa', 'all') }}">
                                                <i class="bi bi-trash-fill"></i> Delete All
                                            </a>
                                        </div>
                                        @endif
                                        <div class="col-12">
                                            <div class="table-responsive">
                                                <table class="table" id="table_1">
                                                    <thead class="thead-dark">
                                                        <tr>
                                                            <th>NIM</th>
                                                            <th>Nama</th>
                                                            <th>Angkatan</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($mahasiswa as $data)
                                                        <tr>
                                                            <td>{{$data->nim}}</td>
                                                            <td>{{$data->nama}}</td>
                                                            <td>{{$data->angkatan}}</td>
                                                            <td>{{$data->status}}</td>
                                                            <td>
                                                                <a class="btn btn-success-soft rounded-circle icon-md" id="buttonModalMahasiswa" data-bs-toggle="modal" data-bs-target="#mahasiswa_view" data-attr="{{ route('mahasiswa.edit', $data->nim) }}">
                                                                    <i class="bi bi-pencil-fill"></i>
                                                                </a>
                                                                <a class="btn btn-danger-soft rounded-circle icon-md" id="buttonConfirmDelete_Mhs" data-bs-toggle="modal" data-bs-target="#confirm_delete_mhs" data-attr="{{ route('delete_mahasiswa', $data->nim) }}">
                                                                    <i class="bi bi-trash-fill"></i>
                                                                </a>
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
                                        @if ($dosen->count() > 0)
                                        <div class="d-flex flex-column align-items-end">
                                            <a class="btn btn-danger-soft btn-sm" id="buttonConfirmDelete_dsn" data-bs-toggle="modal" data-bs-target="#confirm_delete_dsn" data-attr="{{ route('delete_dosen', 'all') }}">
                                                <i class="bi bi-trash-fill"></i> Delete All
                                            </a>
                                        </div>
                                        @endif
                                        <div class="col-12">
                                            <div class="table-responsive">
                                                <table class="table" id="table_2">
                                                    <thead class="thead-dark">
                                                        <tr>
                                                            <th>NIP</th>
                                                            <th width="300px">Nama</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($dosen as $data)
                                                        <tr>
                                                            <td>{{$data->nip}}</td>
                                                            <td>{{$data->nama}}</td>
                                                            <td>{{$data->status}}</td>
                                                            <td>
                                                                <a class="btn btn-success-soft rounded-circle icon-md" id="buttonModalDosen" data-bs-toggle="modal" data-bs-target="#dosen_view" data-attr="{{ route('dosen.edit', $data->nip) }}">
                                                                    <i class="bi bi-pencil-fill"></i>
                                                                </a>
                                                                <a class="btn btn-danger-soft rounded-circle icon-md" id="buttonConfirmDelete_dsn" data-bs-toggle="modal" data-bs-target="#confirm_delete_dsn" data-attr="{{ route('delete_dosen', $data->nip) }}">
                                                                    <i class="bi bi-trash-fill"></i>
                                                                </a>
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
@include('sweetalert::alert')

<div class="modal fade" data-bs-backdrop="static" data-keyboard="false" id="mahasiswa_view" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data Mahasiswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="showModalMahasiswa">

            </div>
        </div>
    </div>
</div>

<div class="modal fade" data-bs-backdrop="static" data-keyboard="false" id="dosen_view" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data Dosen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="showModalDosen">

            </div>
        </div>
    </div>
</div>

<!-- modal confirm delete -->
<div class="modal fade" data-bs-backdrop="static" id="confirm_delete_mhs" tabindex="-1" role="dialog" aria-labelledby="modalConfirmDeleteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalConfirmDeleteLabel">Konfirmasi Hapus Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="showModalConfirmDelete_mhs">

            </div>
        </div>
    </div>
</div>

<div class="modal fade" data-bs-backdrop="static" id="confirm_delete_dsn" tabindex="-1" role="dialog" aria-labelledby="modalConfirmDeleteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalConfirmDeleteLabel">Konfirmasi Hapus Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="showModalConfirmDelete_dsn">

            </div>
        </div>
    </div>
</div>

@endsection

@section('script')

<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script src="{{ asset('assets/js/javascript-ajax.js') }}"></script>
<script src="{{ asset('assets/js/data-table.js') }}"></script>

<script>
    // disable all input and button after submit
    $('form').submit(function() {
        $('button').attr('disabled', 'disabled');
    });
</script>

@stop