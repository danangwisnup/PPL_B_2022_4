@include('layouts.sidebar')

<div class="col-md-5 vstack gap-4">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Mahasiswa</h5>
            <br />
            <div class="hstack gap-2 gap-xl-3 justify-content-center text-center">
                <div>
                    <h5 class="mb-0">{{ $mahasiswaAll->where('status', 'Aktif')->count() }}</h5>
                    <span class="badge btn-success-soft small">Aktif</span>
                </div>
                <div>
                    <h5 class="mb-0">{{ $mahasiswaAll->where('status', 'Cuti')->count() }}</h5>
                    <span class="badge btn-primary-soft small">Cuti</span>
                </div>
                <div>
                    <h5 class="mb-0">{{ $mahasiswaAll->where('status', 'Mangkir')->count() }}</h5>
                    <span class="badge btn-warning-soft small">Mangkir</span>
                </div>
                <div>
                    <h5 class="mb-0">{{ $mahasiswaAll->where('status', 'DO')->count() }}</h5>
                    <span class="badge btn-danger-soft small">DO</span>
                </div>
            </div>
            <br />
            <div class="hstack gap-2 gap-xl-3 justify-content-center text-center">
                <div>
                    <h5 class="mb-0">{{ $mahasiswaAll->where('status', 'Undur Diri')->count() }}</h5>
                    <span class="badge btn-secondary-soft small">Undur Diri</span>
                </div>
                <div>
                    <h5 class="mb-0">{{ $mahasiswaAll->where('status', 'Meninggal Dunia')->count() }}</h5>
                    <span class="badge bg-dark bg-opacity-25 small">Meninggal Dunia</span>
                </div>
                <div>
                    <h5 class="mb-0">{{ $mahasiswaAll->where('status', 'Lulus')->count() }}</h5>
                    <span class="badge btn-info small">Lulus</span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-3 vstack gap-4">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Dosen</h5>
            <br />
            <div class="hstack gap-2 gap-xl-3 justify-content-center text-center">
                <div>
                    <h5 class="mb-0">{{ $dosenAll->where('status', 'Aktif')->count()}}</h5>
                    <span class="badge btn-success-soft">Aktif</span>
                </div>
                <div class="vr"></div>
                <div>
                    <h5 class="mb-0">{{ $dosenAll->where('status', 'Cuti')->count() }}</h5>
                    <span class="badge btn-warning-soft mb-0">Cuti</span>
                </div>
            </div>
        </div>
    </div>
</div>