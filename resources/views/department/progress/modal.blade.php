<div class="tab-content">
    <div class="tab-pane fade show active" id="tab-1">
        <div class="row g-3">
            <div class="text-end">
                <h2 class="text-white">{{ $request->semester }}</h2>
            </div>
            <div class="col-12 text-center text-white">
                @if ($irs == null)
                <h4 class="text-white">Belum ada progress</h4><br />
                @else
                <h1 class="text-white">{{ $irs->sks }} SKS</h1>
                @endif
                <form action="{{ route('department_berkas_detail') }}" method="GET">
                    @csrf
                    <input type="hidden" name="nim" value="{{ $request->nim }}">
                    <input type="hidden" name="semester" value="{{ $request->semester }}">
                    <button type="submit" class="btn btn-dark mt-3 mb-0"><i class="bi bi-eye"></i> Detail</button>
                </form>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="tab-2">
        <div class="row g-3">
            <div class="text-end">
                <h2 class="text-white">{{ $request->semester }}</h2>
            </div>
            <div class="col-12 text-center text-white">
                @if ($khs == null)
                <h4 class="text-white">Belum ada progress</h4><br />
                @else
                SKS Semester: {{ $khs->sks }}<br />
                IP Semester: {{ $khs->ip }}<br />
                SKS Kumulatif: {{ $khs->sks_kumulatif }}<br />
                IP Kumulatif: {{ $khs->ip_kumulatif }}<br />
                @endif
                <form action="{{ route('department_berkas_detail') }}" method="GET">
                    @csrf
                    <input type="hidden" name="nim" value="{{ $request->nim }}">
                    <input type="hidden" name="semester" value="{{ $request->semester }}">
                    <button type="submit" class="btn btn-dark mt-3 mb-0"><i class="bi bi-eye"></i> Detail</button>
                </form>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="tab-3">
        <div class="row g-3">
            <div class="text-end">
                <h2 class="text-white">{{ $request->semester }}</h2>
            </div>
            <div class="col-12 text-center text-white">
                @if ($pkl == null)
                <h4 class="text-white">Belum ada progress</h4><br />
                @else
                @if ($pkl->status == 'Lulus')
                Nilai PKL: {{ $pkl->nilai != null ? $pkl->nilai : '-' }}<br />
                @endif
                Status: {{ $pkl->status }}<br />
                @endif
                <form action="{{ route('department_berkas_detail') }}" method="GET">
                    @csrf
                    <input type="hidden" name="nim" value="{{ $request->nim }}">
                    <input type="hidden" name="semester" value="{{ $request->semester }}">
                    <button type="submit" class="btn btn-dark mt-3 mb-0"><i class="bi bi-eye"></i> Detail</button>
                </form>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="tab-4">
        <div class="row g-3">
            <div class="text-end">
                <h2 class="text-white">{{ $request->semester }}</h2>
            </div>
            <div class="col-12 text-center text-white">
                @if ($skripsi == null)
                <h4 class="text-white">Belum ada progress</h4><br />
                @else
                @if ($skripsi->status == 'Lulus')
                Nilai Skripsi: {{ $skripsi->nilai != null ? $skripsi->nilai : '-' }}<br />
                Tanggal Skripsi: {{ $skripsi->tanggal_sidang != null ? $skripsi->tanggal_sidang : '-' }}<br />
                @endif
                Status: {{ $skripsi->status }}<br />
                @endif
                <form action="{{ route('department_berkas_detail') }}" method="GET">
                    @csrf
                    <input type="hidden" name="nim" value="{{ $request->nim }}">
                    <input type="hidden" name="semester" value="{{ $request->semester }}">
                    <button type="submit" class="btn btn-dark mt-3 mb-0"><i class="bi bi-eye"></i> Detail</button>
                </form>
            </div>
        </div>
    </div>
</div>