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
                            <h1 class="card-title h5">Profile</h1>
                        </div>
                        <div class="card-body">
                            <form action="" method="POST">
                                {{-- Form Nama --}}
                                <div class="row mt-1 mb-1">
                                    <label class="col-sm-2 col-form-label text-dark">Nama :</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" required>
                                    </div>
                                </div>

                                {{-- Form NIM --}}
                                <div class="row mb-1">
                                    <label class="col-sm-2 col-form-label text-dark">NIM :</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nim" name="nim" placeholder="NIM" readonly>
                                    </div>
                                </div>

                                {{-- Form Angkatan --}}
                                <div class="row mb-1">
                                    <label class="col-sm-2 col-form-label text-dark">Angkatan :</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="angkatan" name="angkatan" placeholder="Angkatan" readonly>
                                    </div>
                                </div>

                                {{-- Form Status --}}
                                <div class="row mb-1">
                                    <label class="col-sm-2 col-form-label text-dark">Status :</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="status" name="status" placeholder="Status" readonly>
                                    </div>
                                </div>

                                {{-- Form Jalur Masuk --}}
                                <div class="row mb-1">
                                    <label class="col-sm-2 col-form-label text-dark">Jalur Masuk :</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="jalur_Masuk" name="jalur_masuk" placeholder="Jalur Masuk" readonly>
                                    </div>
                                </div>

                                {{-- Form Nomor HP --}}
                                <div class="row mb-1">
                                    <label class="col-sm-2 col-form-label text-dark">Nomor HP :</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nomor_hp" name="nomor_hp" placeholder="Nomor HP" required>
                                    </div>
                                </div>

                                {{-- Form Email Pribadi --}}
                                <div class="row mb-1">
                                    <label class="col-sm-2 col-form-label text-dark">Email Pribadi :</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                                    </div>
                                </div>

                                {{-- Form Alamat --}}
                                <div class="row mb-1">
                                    <label class="col-sm-2 col-form-label text-dark">Alamat :</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="alamat" name="alamat" placeholder="Alamat" required></textarea>
                                    </div>
                                </div>

                                {{-- Select Kota/Kab --}}
                                <div class="row mb-1">
                                    <label class="col-sm-2 col-form-label text-dark">Kota/Kab :</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" id="kota_kab" name="kota_kab" required>
                                            <option value="">Pilih Kota/Kab</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Select Provinsi --}}
                                <div class="row mb-1">
                                    <label class="col-sm-2 col-form-label text-dark">Provinsi :</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" id="provinsi" name="provinsi" required>
                                            <option value="">Pilih Provinsi</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Select Dosen Wali --}}
                                <div class="row mb-1">
                                    <label class="col-sm-2 col-form-label text-dark">Dosen Wali :</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" id="dosen_wali" name="dosen_wali" required>
                                            <option value="">Pilih Dosen Wali</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-12 text-end">
                                    <button type="submit" class="btn btn-sm btn-primary mt-2 mb-0">Save</button>
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

@endsection