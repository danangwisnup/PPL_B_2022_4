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
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table" id="table_1">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>Nama</th>
                                                    <th>NIM</th>
                                                    <th>Angkatan</th>
                                                    <th>Wali</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
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
                                    <a class="btn btn-danger avatar-xl mb-3 me-3" id="buttonModalProgress" data-bs-toggle="modal" data-bs-target="#progress_view" data-attr=""><br>1</a>
                                    <a class="btn btn-danger avatar-xl mb-3 me-3" id="buttonModalProgress" data-bs-toggle="modal" data-bs-target="#progress_view" data-attr=""><br>2</a>
                                    <a class="btn btn-danger avatar-xl mb-3 me-3" id="buttonModalProgress" data-bs-toggle="modal" data-bs-target="#progress_view" data-attr=""><br>3</a>
                                    <a class="btn btn-danger avatar-xl mb-3 me-3" id="buttonModalProgress" data-bs-toggle="modal" data-bs-target="#progress_view" data-attr=""><br>4</a>
                                    <a class="btn btn-danger avatar-xl mb-3 me-3" id="buttonModalProgress" data-bs-toggle="modal" data-bs-target="#progress_view" data-attr=""><br>5</a>
                                    <a class="btn btn-danger avatar-xl mb-3 me-3" id="buttonModalProgress" data-bs-toggle="modal" data-bs-target="#progress_view" data-attr=""><br>6</a>
                                    <a class="btn btn-danger avatar-xl mb-3 me-3" id="buttonModalProgress" data-bs-toggle="modal" data-bs-target="#progress_view" data-attr=""><br>7</a>
                                    <a class="btn btn-danger avatar-xl mb-3 me-3" id="buttonModalProgress" data-bs-toggle="modal" data-bs-target="#progress_view" data-attr=""><br>8</a>
                                    <a class="btn btn-danger avatar-xl mb-3 me-3" id="buttonModalProgress" data-bs-toggle="modal" data-bs-target="#progress_view" data-attr=""><br>9</a>
                                    <a class="btn btn-danger avatar-xl mb-3 me-3" id="buttonModalProgress" data-bs-toggle="modal" data-bs-target="#progress_view" data-attr=""><br>10</a>
                                    <a class="btn btn-danger avatar-xl mb-3 me-3" id="buttonModalProgress" data-bs-toggle="modal" data-bs-target="#progress_view" data-attr=""><br>11</a>
                                    <a class="btn btn-danger avatar-xl mb-3 me-3" id="buttonModalProgress" data-bs-toggle="modal" data-bs-target="#progress_view" data-attr=""><br>12</a>
                                    <a class="btn btn-danger avatar-xl mb-3 me-3" id="buttonModalProgress" data-bs-toggle="modal" data-bs-target="#progress_view" data-attr=""><br>13</a>
                                    <a class="btn btn-danger avatar-xl mb-3 me-3" id="buttonModalProgress" data-bs-toggle="modal" data-bs-target="#progress_view" data-attr=""><br>14</a>

                                    <br />
                                    <h6 class="mt-2 mb-2">Keterangan:</h6>
                                    <a class="btn btn-danger btn-sm mb-1"></a> <small>Belum diisikan (IRS dan KHS) atau tidak digunakan</small><br />
                                    <a class="btn btn-info btn-sm mb-1"></a> <small>Sudah diisikan (IRS dan KHS)</small><br />
                                    <a class="btn btn-warning btn-sm mb-1"></a> <small>Sudah Lulus PKL (IRS, KHS, dan PKL)</small><br />
                                    <a class="btn btn-success btn-sm mb-1"></a> <small>Sudah Lulus Skripsi)</small><br />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<div class="modal fade" data-bs-backdrop="static" data-keyboard="false" id="progress_view" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-info">
            <div class="modal-header">
                <ul class="nav nav-tabs nav-bottom-line justify-content-center justify-content-md-start">
                    <li class="nav-item"> <a class="text-white nav-link active" data-bs-toggle="tab" href="#tab-1" id="tab1"> IRS </a> </li>
                    <li class="nav-item"> <a class="text-white nav-link" data-bs-toggle="tab" href="#tab-2" id="tab2"> KHS </a> </li>
                    <li class="nav-item"> <a class="text-white nav-link" data-bs-toggle="tab" href="#tab-3" id="tab3"> PKL </a> </li>
                    <li class="nav-item"> <a class="text-white nav-link" data-bs-toggle="tab" href="#tab-4" id="tab4"> Skripsi </a> </li>
                </ul>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" id="btnClose" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-1">
                        <div class="row g-3">
                            <div class="text-end">
                                <h2 class="text-white">1</h2>
                            </div>
                            <div class="col-12 text-center">
                                <h1 class="text-white">24 SKS</h1>
                                <button class="btn btn-dark mt-3 mb-0">Detail</button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab-2">
                        <div class="row g-3">
                            <div class="text-end">
                                <h2 class="text-white">1</h2>
                            </div>
                            <div class="col-12 text-center text-white">
                                SKS Semester: <br />
                                IP Semester: <br />
                                SKS Kumulatif: <br />
                                IP Kumulatif: <br />
                                <button class="btn btn-dark mt-3 mb-0">Detail</button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab-3">
                        <div class="row g-3">
                            <div class="text-end">
                                <h2 class="text-white">1</h2>
                            </div>
                            <div class="col-12 text-center text-white">
                                Nilai PKL: <br />
                                Seminar PKL: <br />
                                Status: <br />
                                <button class="btn btn-dark mt-3 mb-0">Detail</button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab-4">
                        <div class="row g-3">
                            <div class="text-end">
                                <h2 class="text-white">1</h2>
                            </div>
                            <div class="col-12 text-center text-white">
                                Nilai Skripsi: <br />
                                Tanggal Skripsi: <br />
                                Status: <br />
                                <button class="btn btn-dark mt-3 mb-0">Detail</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@include('sweetalert::alert')

<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script src="{{ asset('assets/js/javascript-ajax.js') }}"></script>
<script src="{{ asset('assets/js/data-table.js') }}"></script>

@stop