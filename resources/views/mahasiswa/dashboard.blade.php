@include('layouts.sidebar')

<div class="col-md-8 col-lg-6 vstack gap-4">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Dashboard</h5>
            <br />
            <h4 class="text-center desktop" style="font-size:20px">Selamat Datang di SI-Monitoring Akademik Informatika</h4>
            <h4 class="text-center mobile" style="font-size:20px">Selamat Datang di SI-MAIF</h4>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Informasi Mahasiswa</h5>
            <br />
            <div class="hstack gap-2 gap-xl-3 justify-content-center text-center">
                <div>
                    <h5 class="mb-3">Total SKS</h5>
                    {{-- Bingung, blm tau nampilin total sks-nya --}}
                    <span>{{ 0 }}</span>
                </div>
                <div class="vr"></div>
                <div>
                    <h5 class="mb-3">PKL</h5>
                    <span class="badge btn-success-soft">Lulus</span>
                </div>
                <div class="vr"></div>
                <div>
                    <h5 class="mb-3">Skripsi</h5>
                    <span class="badge btn-danger-soft">Belum ambil</span>
                </div>
            </div>
        </div>
        <br>
    </div>
</div>