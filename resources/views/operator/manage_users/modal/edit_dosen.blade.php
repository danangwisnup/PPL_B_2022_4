    <form action="{{ route('dosen.update', $dosen->nip) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-body">
            <div class="form-group row">
                <div class="col-12">
                    <label for="recipient-name" class="col-form-label">NIP </label>
                    <input type="text" class="form-control" id="nip" name="nip" value="{{ $dosen->nip }}" readonly>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <label for="recipient-name" class="col-form-label">Nama </label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{ $dosen->nama }}" required>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <label for="recipient-name" class="col-form-label">Email </label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $dosen->email }}">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <label for="recipient-name" class="col-form-label">New Password </label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <label for="recipient-name" class="col-form-label">Status</label>
                    <select class="form-select" id="status" name="status" required>
                        <option value="">Pilih Status</option>
                        <option value="Aktif" {{ $dosen->status == 'Aktif' ? 'selected="true"' : '' }}>Aktif</option>
                        <option value="Cuti" {{ $dosen->status == 'Cuti' ? 'selected="true"' : '' }}>Cuti</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="modal-footer bg-white">
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
        </div>
    </form>