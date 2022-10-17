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
                    {{-- Buat apaan nih event alert? --}}
                    {{-- Jawab: ... --}}
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
                            <h1 class="card-title h5">KHS</h1>
                        </div>
                        <div class="card-body">
                            <form class="row g-3" action="" method="POST">
                                @csrf
                                <!-- Pilih Semester START-->
                                <div class="col-12">
                                    <label class="form-label text-dark">Semester Aktif</label>
                                    <select class="form-select" id="semester_aktif" name="semester_aktif" required>
                                        <option value="">Pilih Semester Aktif</option>
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

                                <!-- Input Jumlah SKS Semester START -->
                                <div class="col-6">
                                    <label class="form-label text-dark">SKS Semester</label>
                                    <input type="text" class="form-control" id="sks_semester" name="sks_semester" placeholder="SKS Semester" required>
                                </div>
                                <!-- Input Jumlah SKS Semester END -->

                                <!-- Input Jumlah SKS Kumulatif START -->
                                <div class="col-6">
                                    <label class="form-label text-dark">SKS Kumulatif</label>
                                    <input type="text" class="form-control" id="sks_kumulatif" name="sks_kumulatif" placeholder="SKS Kumulatif" required>
                                </div>
                                <!-- Input Jumlah SKS Semester END -->

                                <!-- Input IP Semester START -->
                                <div class="col-6">
                                    <label class="form-label text-dark">IP Semester</label>
                                    <input type="text" class="form-control" id="ip_semester" name="ip_semester" placeholder="IP Semester" required>
                                </div>
                                <!-- Input IP Semester END -->

                                <!-- Input IP Kumulatif START -->
                                <div class="col-6">
                                    <label class="form-label text-dark">IP Kumulatif</label>
                                    <input type="text" class="form-control" id="ip_kumulatif" name="ip_kumulatif" placeholder="IP Kumulatif" required>
                                </div>
                                <!-- Input IP Kumulatif END -->

                                <!-- Dropzone START-->
                                <!-- Note:
                                     - Copy dari template, cuma tampilan blm bisa upload beneran 
                                     - Ini misal pake style buat memperkecil, area uploadnya tetep dalam area itu apa bisa diluar ya?
                                       Takutnya kalau area uploadnya diperkecil tapi tetep bisa upload di luar area
                                -->
                                <style>
                                    .dropzone {
                                        height: 190px;
                                    }
                                </style>

                                <div>
                                    <label class="form-label">Scan KHS</label>
                                    <div class="dropzone dropzone-default card shadow-none" data-dropzone='{"maxFiles":1}'>
                                        <div class="dz-message">
                                            <i class="bi bi-upload display-4"></i>
                                            <p>Upload File</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Dropzone END -->

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

@endsection