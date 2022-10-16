<form class="row g-3" action="{{ route('irs.update', $data->semester_aktif) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <input type="hidden" name="nim" value="{{ $data->nim }}">
    <div class="col-12">
        <label class="form-label text-dark">SKS</label>
        <input type="number" class="form-control" id="jumlah_sks" name="jumlah_sks" placeholder="Jumlah SKS" value="{{ $data->sks }}" required>
    </div>
    <div class="col-12">
        <label class="form-label">Scan IRS</label>
        <div class="dropzone">
            <input type="file" class="filepond" id="fileEdit" name="fileEdit" data-allow-reorder="true">
        </div>
    </div>
    <div class="text-danger small fst-italic mb-0">*Format file [.pdf], pastikan file yang diupload benar.</div>
    <div class="small fst-italic mt-0">File baru akan menimpa file sebelumya.</div>
    <div class="col-12 text-end">
        <button type="submit" class="btn btn-sm btn-primary mb-0">Edit</button>
    </div>
</form>

<!-- Load FilePond library -->
<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
<script src="https://unpkg.com/filepond@4.17.1/dist/filepond.js"></script>

<!-- Turn all file input elements into ponds -->
<script>
    FilePond.registerPlugin(
        FilePondPluginFileValidateType,
        FilePondPluginFileValidateSize
    );

    FilePond.create(document.getElementById('fileEdit'), {
        maxParallelUploads: 1,
        maxFileSize: "15MB",
        acceptedFileTypes: ['application/pdf'],
        labelIdle: '<div class="avatar avatar-sm mt-3"><a class="link"><img class="avatar-img" src="{{ asset("assets/images/upload.png") }}" alt=""></a></div><br/><span class="link">Upload File</span><br/><br/>',
        stylePanelAspectRatio: 0.2,
    });

    // Send the files to the Controller
    FilePond.setOptions({
        server: {
            url: '/upload',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        }
    });
</script>