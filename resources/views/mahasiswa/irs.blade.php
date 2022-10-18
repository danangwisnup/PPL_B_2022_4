@extends('layouts.main')

@section('content')

<div class="container-scroller">

    @include('layouts.navbar')

    <main>

        <!-- Container START -->
        <div class="container">
            <div class="row g-4">

                @include('layouts.sidebar')

                <div class="col-md-8 col-lg-6 vstack gap-4">
                    <!-- Card START -->
                    <div class="card">
                        <!-- Card header START -->
                        <div class="card-header d-sm-flex text-center align-items-center justify-content-between border-0 pb-0">
                            <h1 class="card-title h5">Data IRS</h1>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="table_mahasiswa">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Semester</th>
                                            <th>SKS</th>
                                            <th>Scan IRS</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>24</td>
                                            <td><a href="{{ asset('file/irs/irs_nim_semseter.pdf') }}" class="btn btn-info btn-sm"><i class="bi bi-download"></i> Download</a></td>
                                            <td>
                                                <a href="{{ url('/mahasiswa/irs/1') }}" class="btn btn-success btn-sm" id="buttonModalIRS" data-bs-toggle="modal" data-bs-target="#editIRS"><i class="bi bi-pencil"></i> Edit</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Event alert START -->
                    @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    <!-- Event alert END -->

                    <!-- Card START -->
                    <div class="card">
                        <!-- Card header START -->
                        <div class="card-header d-sm-flex text-center align-items-center justify-content-between border-0 pb-0">
                            <h1 class="card-title h5">Input IRS</h1>
                        </div>
                        <div class="card-body">
                            <form class="row g-3" action="" method="POST">
                                @csrf
                                <!-- Pilih Semester START-->
                                <div class="col-6">
                                    <label class="form-label text-dark">Semester Aktif</label>
                                    <select class="form-select" id="semester_aktif" name="semester_aktif" required>
                                        <option value="">Pilih Angkatan</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        <option value="13">13</option>
                                        <option value="14">14</option>
                                    </select>
                                </div>
                                <!-- Pilih Semester END -->

                                <!-- Input Jumlah SKS START -->
                                <div class="col-6">
                                    <label class="form-label text-dark">Jumlah SKS</label>
                                    <input type="text" class="form-control" id="jumlah_sks" name="jumlah_sks" placeholder="Jumlah SKS" required>
                                </div>
                                <!-- Input Jumlah SKS END-->

                                <!-- Dropzone START-->
                                <div>
                                    <label class="form-label">Scan IRS</label>
                                    <div class="dropzone dropzone-default shadow-none" data-dropzone='{"maxFiles":1}'>
                                        <div class="dz-message">
                                            <i class="bi bi-upload display-4"></i>
                                            <p>Upload File</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Dropzone END -->
                                <div class="text-danger small fst-italic">*format nama irs_nim_semseter.pdf</div>

                                <div class="col-12 text-end">
                                    <button type="submit" class="btn btn-sm btn-primary mb-0">Submit</button>
                                </div>
                            </form>
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

<!-- modal edit irs -->
<div class="modal fade" data-bs-backdrop="static" data-keyboard="false" id="editIRS" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit IRS</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" id="btnClose" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3" action="" method="POST">
                    @csrf
                    <div class="col-12">
                        <label class="form-label text-dark">SKS</label>
                        <input type="number" class="form-control" id="jumlah_sks" name="jumlah_sks" placeholder="Jumlah SKS" value="{{ 24 }}" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label text-dark">Scan IRS</label>
                        <div class="dropzone dropzone-default shadow-none" data-dropzone='{"maxFiles":1}'>
                            <div class="dz-message">
                                <i class="bi bi-upload display-4"></i>
                                <p>Upload File</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-sm btn-primary mb-0">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@include('sweetalert::alert')

<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('assets/js/javascript-ajax.js') }}"></script>
<script src="{{ asset('assets/js/data-table.js') }}"></script>

@endsection