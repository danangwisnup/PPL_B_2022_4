<form class="row g-3" action="{{ route('pkl.update', $data->semester_aktif) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <input type="hidden" name="nim" value="{{ $data->nim }}">
    <!-- Input Pilih Status START -->
    <div class="col-6">
        <label class="form-label text-dark">Status</label>
        <select class="form-select" id="status_pkl" name="status_pkl">
            <option value="">-- Pilih Status --</option>
            <option value="Belum Ambil" {{ $data->status == 'Belum Ambil' ? 'selected="true"' : '' }}>Belum Ambil</option>
            <option value="Sedang Ambil" {{ $data->status == 'Sedang Ambil' ? 'selected="true"' : '' }}>Sedang Ambil</option>
            <option value="Lulus" {{ $data->status == 'Lulus' ? 'selected="true"' : '' }}>Lulus</option>
        </select>
    </div>
    <!-- Input Pilih Status END -->

    <!-- Pilih Nilai START-->
    <div class="col-6">
        <label class="form-label text-dark">Nilai</label>
        <select class="form-select" id="nilai_pkl" name="nilai_pkl">
            <option value="">-- Pilih Nilai --</option>
            <option value="A" {{ $data->nilai == 'A' ? 'selected="true"' : '' }}>A</option>
            <option value="B" {{ $data->nilai == 'B' ? 'selected="true"' : '' }}>B</option>
            <option value="C" {{ $data->nilai == 'C' ? 'selected="true"' : '' }}>C</option>
            <option value="D" {{ $data->nilai == 'D' ? 'selected="true"' : '' }}>D</option>
            <option value="E" {{ $data->nilai == 'E' ? 'selected="true"' : '' }}>E</option>
        </select>
    </div>
    <!-- Pilih Nilai END -->

    <div class="col-12">
        <input class="form-check-input" type="checkbox" id="confirm" name="confirm">
        <label class="form-check-label" for="confirm">
            Ulangi scan PKL?
        </label>
    </div>
    <div class="col-12" id="dropzone">
        <label class="form-label">Scan PKL</label>
        <div class="dropzone" style="height: 160px;">
            <input type="file" class="filepond" id="fileEdit" name="fileEdit" data-allow-reorder="true">
        </div>
        <div class="text-danger small fst-italic mt-2 mb-0">*Format file [.pdf], pastikan file yang diupload benar.</div>
        <div class="small fst-italic mt-0">File baru akan menimpa file sebelumya.</div>
    </div>
    <div class="col-12 text-end">
        <button type="submit" class="btn btn-sm btn-primary mb-0">Edit</button>
        <button type="button" class="btn btn-sm btn-secondary mb-0" data-bs-dismiss="modal">Batal</button>
    </div>
</form>

<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>

<script>
    // disable all input and button after submit
    $('form').submit(function() {
        // show spinner on button
        $(this).find('button[type=submit]').html(
            `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            Loading...`
        );
        $('button').attr('disabled', 'disabled');
    });

    // data-bs-dismiss="modal" click reload page
    $('button[data-bs-dismiss="modal"]').click(function() {
        location.reload();
    });
</script>

<!-- Load FilePond library -->
<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
<script src="https://unpkg.com/filepond@4.17.1/dist/filepond.js"></script>

<!-- Turn all file input elements into ponds -->
<script>
    $(document).ready(function() {
        $('#dropzone').hide();
        $('#confirm').click(function() {
            if ($(this).is(':checked')) {
                $('#dropzone').show();
            } else {
                $('#dropzone').hide();
            }
        });
    });
    FilePond.registerPlugin(
        FilePondPluginFileValidateType,
        FilePondPluginFileValidateSize
    );

    FilePond.create(document.getElementById('fileEdit'), {
        maxParallelUploads: 1,
        maxFileSize: "15MB",
        acceptedFileTypes: ['application/pdf'],
        labelIdle: '<br/><div class="avatar avatar-sm"><a class="link"><img class="avatar-img" src="{{ asset("assets/images/upload.png") }}" alt=""></a></div><br/><span class="link">Upload File</span><br/>',
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