<form action="{{ route('dosen.destroy', 'all') }}" method="POST">
    @csrf
    @method('DELETE')
    <div class="modal-body">
        <p>Apakah anda yakin ingin menghapus data ini?</p>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-sm btn-danger" id="btnDelete">Hapus</button>
    </div>
</form>