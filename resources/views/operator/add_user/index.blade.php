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
                            <h1 class="card-title h5">Add User</h1>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-tabs nav-bottom-line justify-content-center justify-content-md-start">
                                <li class="nav-item"> <a class="nav-link active" data-bs-toggle="tab" href="#tab-1"> Mahasiswa </a> </li>
                                <li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#tab-2"> Dosen </a> </li>
                            </ul>

                            <div class="tab-content mb-0 pb-0">

                                <!-- Tab Mahasiswa -->
                                <div class="tab-pane fade show active" id="tab-1">
                                    <form class="row g-3" action="/operator/mahasiswa" method="POST">
                                        @csrf
                                        <div class="col-6">
                                            <label class="form-label text-dark">NIM</label>
                                            <input type="text" class="form-control" id="nim" name="nim" placeholder="NIM" value="{{ old('nim') }}" required>
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label text-dark">Nama Mahasiswa</label>
                                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" value="{{ old('nama') }}" required>
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label text-dark">Angkatan</label>
                                            <select class="form-select" id="angkatan" name="angkatan" required>
                                                <option value="">Pilih Angkatan</option>
                                                <option value="2015" @if (old('angkatan')=="2015" ) {{ 'selected' }} @endif>2015</option>
                                                <option value="2016" @if (old('angkatan')=="2016" ) {{ 'selected' }} @endif>2016</option>
                                                <option value="2017" @if (old('angkatan')=="2017" ) {{ 'selected' }} @endif>2017</option>
                                                <option value="2018" @if (old('angkatan')=="2018" ) {{ 'selected' }} @endif>2018</option>
                                                <option value="2019" @if (old('angkatan')=="2019" ) {{ 'selected' }} @endif>2019</option>
                                                <option value="2020" @if (old('angkatan')=="2020" ) {{ 'selected' }} @endif>2020</option>
                                                <option value="2021" @if (old('angkatan')=="2021" ) {{ 'selected' }} @endif>2021</option>
                                                <option value="2022" @if (old('angkatan')=="2022" ) {{ 'selected' }} @endif>2022</option>
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label text-dark">Status </label>
                                            <select class="form-select" id="status" name="status" required>
                                                <option value="">Pilih Status</option>
                                                <option value="Aktif" @if (old('status')=="Aktif" ) {{ 'selected' }} @endif>Aktif</option>
                                                <option value="Cuti" @if (old('status')=="Cuti" ) {{ 'selected' }} @endif>Cuti</option>
                                                <option value="Mangkir" @if (old('status')=="Mangkir" ) {{ 'selected' }} @endif>Mangkir</option>
                                                <option value="DO" @if (old('status')=="DO" ) {{ 'selected' }} @endif>DO</option>
                                                <option value="Undur Diri" @if (old('status')=="Undur Diri" ) {{ 'selected' }} @endif>Undur Diri</option>
                                                <option value="Meninggal Dunia" @if (old('status')=="Meninggal Dunia" ) {{ 'selected' }} @endif>Meninggal Dunia</option>
                                                <option value="Lulus" @if (old('status')=="Lulus" ) {{ 'selected' }} @endif>Lulus</option>
                                            </select>
                                        </div>
                                        <div class="col-12 text-end">
                                            <button type="submit" class="btn btn-sm btn-primary mb-0">Generate</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- Tab Mahasiswa END -->

                                <!-- Tab Dosen -->
                                <div class="tab-pane fade" id="tab-2">
                                    <form class="row g-3" action="/operator/dosen" method="POST">
                                        @csrf
                                        <div class="col-6">
                                            <label class="form-label text-dark">NIP</label>
                                            <input type="text" class="form-control" id="nip" name="nip" placeholder="NIP" value="{{ old('nip') }}" required>
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label text-dark">Nama Dosen</label>
                                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" value="{{ old('nama') }}" required>
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label text-dark">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label text-dark">Status </label>
                                            <select class="form-select" id="status" name="status" required>
                                                <option value="">Pilih Status</option>
                                                <option value="Aktif" @if (old('status')=="Aktif" ) {{ 'selected' }} @endif>Aktif</option>
                                                <option value="Cuti" @if (old('status')=="Cuti" ) {{ 'selected' }} @endif>Cuti</option>
                                            </select>
                                        </div>
                                        <div class="col-12 text-end">
                                            <button type="submit" class="btn btn-sm btn-primary mb-0">Generate</button>
                                        </div>
                                    </form>
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

@endsection