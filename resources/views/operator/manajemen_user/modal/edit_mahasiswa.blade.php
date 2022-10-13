    <form action="{{ route('mahasiswa.update', $mahasiswa->nim) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-body">
            <div class="form-group row">
                <div class="col-12">
                    <label for="recipient-name" class="col-form-label">NIM </label>
                    <input type="text" class="form-control" id="nim" name="nim" value="{{ $mahasiswa->nim }}" readonly>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <label for="recipient-name" class="col-form-label">Nama </label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{ $mahasiswa->nama }}" required>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <label for="recipient-name" class="col-form-label">Email </label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $mahasiswa->email }}">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <label for="recipient-name" class="col-form-label">New Password </label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-6">
                    <label for="recipient-name" class="col-form-label">Angkatan</label>
                    <select class="form-select" id="angkatan" name="angkatan" required>
                        <option value="">Pilih Angkatan</option>
                        <option value="2015" {{ $mahasiswa->angkatan == '2015' ? 'selected="true"' : '' }}>2015</option>
                        <option value="2016" {{ $mahasiswa->angkatan == '2016' ? 'selected="true"' : '' }}>2016</option>
                        <option value="2017" {{ $mahasiswa->angkatan == '2017' ? 'selected="true"' : '' }}>2017</option>
                        <option value="2018" {{ $mahasiswa->angkatan == '2018' ? 'selected="true"' : '' }}>2018</option>
                        <option value="2019" {{ $mahasiswa->angkatan == '2019' ? 'selected="true"' : '' }}>2019</option>
                        <option value="2020" {{ $mahasiswa->angkatan == '2020' ? 'selected="true"' : '' }}>2020</option>
                        <option value="2021" {{ $mahasiswa->angkatan == '2021' ? 'selected="true"' : '' }}>2021</option>
                        <option value="2022" {{ $mahasiswa->angkatan == '2022' ? 'selected="true"' : '' }}>2022</option>
                    </select>
                </div>
                <div class="col-6">
                    <label for="recipient-name" class="col-form-label">Jenis Masuk</label>
                    <select class="form-select" id="jalur_masuk" name="jalur_masuk" required>
                        <option value="">Pilih Jenis Masuk</option>
                        <option value="SNMPTN" {{ $mahasiswa->jalur_masuk == 'SNMPTN' ? 'selected="true"' : '' }}>SNMPTN</option>
                        <option value="SBMPTN" {{ $mahasiswa->jalur_masuk == 'SBMPTN' ? 'selected="true"' : '' }}>SBMPTN</option>
                        <option value="SBUB" {{ $mahasiswa->jalur_masuk == 'SBUB' ? 'selected="true"' : '' }}>SBUB</option>
                        <option value="Ujian Mandiri" {{ $mahasiswa->jalur_masuk == 'Ujian Mandiri' ? 'selected="true"' : '' }}>Ujian Mandiri</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <label for="recipient-name" class="col-form-label">Status </label>
                    <select class="form-select" id="status" name="status" required>
                        <option value="">Pilih Status</option>
                        <option value="Aktif" {{ $mahasiswa->status == 'Aktif' ? 'selected="true"' : '' }}>Aktif</option>
                        <option value="Cuti" {{ $mahasiswa->status == 'Cuti' ? 'selected="true"' : '' }}>Cuti</option>
                        <option value="Mangkir" {{ $mahasiswa->status == 'Mangkir' ? 'selected="true"' : '' }}>Mangkir</option>
                        <option value="DO" {{ $mahasiswa->status == 'DO' ? 'selected="true"' : '' }}>DO</option>
                        <option value="Undur Diri" {{ $mahasiswa->status == 'Undur Diri' ? 'selected="true"' : '' }}>Undur Diri</option>
                        <option value="Meninggal Dunia" {{ $mahasiswa->status == 'Meninggal Dunia' ? 'selected="true"' : '' }}>Meninggal Dunia</option>
                        <option value="Lulus" {{ $mahasiswa->status == 'Lulus' ? 'selected="true"' : '' }}>Lulus</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="modal-footer bg-white">
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
        </div>
    </form>