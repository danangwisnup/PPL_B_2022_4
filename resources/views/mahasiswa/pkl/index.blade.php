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
                            <h1 class="card-title h5">PKL</h1>
                        </div>
                        <div class="card-body">
                            <form class="row g-3" action="" method="POST">
                                @csrf
                                <!-- Pilih Nilai START-->
                                <div class="col-6">
                                    <label class="form-label text-dark">Nilai</label>
                                    <select class="form-select" id="nilai_pkl" name="nilai_pkl" required>
                                        <option value="">-- Pilih Nilai --</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="D">D</option>
                                        <option value="E">E</option>
                                    </select>
                                </div>
                                <!-- Pilih Nilai END -->

                                <!-- Input Pilih Status START -->
                                <div class="col-6">
                                    <label class="form-label text-dark">Status</label>
                                    <select class="form-select" id="status_pkl" name="status_pkl" required>
                                        <option value="">-- Pilih Status --</option>
                                        <option value="Belum ambil">Belum ambil</option>
                                        <option value="Sedang ambil">Sedang ambil</option>
                                        <option value="Lulus">Lulus</option>
                                    </select>
                                </div>
                                <!-- Input Pilih Status END -->

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
                                    <label class="form-label">Scan PKL</label>
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