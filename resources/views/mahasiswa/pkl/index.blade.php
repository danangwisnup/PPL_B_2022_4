@extends('layouts.main')

@section('content')

<div class="container-scroller">

    @include('layouts.navbar')

    <main>

        <!-- Container START -->
        <div class="container">
            <div class="row g-4">

                @include('layouts.sidebar')

                <div class="col-md-8 col-lg-6 vstack gap-4">

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
                            <h1 class="card-title h5">Data PKL</h1>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="table_1">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Semester</th>
                                            <th>Nilai</th>
                                            <th>Status</th>
                                            <th>Scan KHS</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pkl as $item)
                                        <tr>
                                            <td>{{$item->semester_aktif}}</td>
                                            <td>{{$item->nilai}}</td>
                                            <td>{{$item->status}}</td>
                                            <td><a href="{{ asset($item->upload_pkl) }}" class="btn btn-info btn-sm"><i class="bi bi-eye"></i> Lihat</a></td></td>
                                            <td>
                                                <a href="" class="btn btn-success btn-sm" id="buttonModalKHS" data-bs-toggle="modal" data-bs-target="#editKHS" data-attr="{{ route('khs.edit', [$item->semester_aktif, $item->nim]) }}">
                                                    <i class="bi bi-pencil-square"></i> Edit
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Card START -->
                    <div class="card">
                        <!-- Card header START -->
                        <div class="card-header d-sm-flex text-center align-items-center justify-content-between border-0 pb-0">
                            <h1 class="card-title h5">PKL</h1>
                            <div class="text-dark small">Harap diisi dengan data yang benar.</div>
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
                                <div class="col-12">
                                    <label class="form-label">Scan PKL</label>
                                    <div class="dropzone">
                                        <input type="file" class="filepond" id="file" name="file" data-allow-reorder="true">
                                    </div>
                                </div>
                                <!-- Dropzone END -->
                                <div class="text-danger small fst-italic">*Format file [.pdf], pastikan file yang diupload benar.</div>

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

@section('script')

@include('sweetalert::alert')

<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script src="{{ asset('assets/js/javascript-ajax.js') }}"></script>
<script src="{{ asset('assets/js/data-table.js') }}"></script>

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
    FilePond.create(document.getElementById('file'), {
        maxParallelUploads: 1,
        maxFileSize: "15MB",
        acceptedFileTypes: ['application/pdf'],
        labelIdle: '<br/><div class="avatar avatar-xxl"><a class="link"><img class="avatar-img" src="{{ asset("assets/images/upload.png") }}" alt=""></a></div><br/><span class="link">Upload File</span><br/><br><br/>',
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

<script type="text/javascript">
    // display a modal dosen
    $(document).on("click", "#buttonModalKHS", function() {
        event.preventDefault();
        let href = $(this).attr("data-attr");
        $.ajax({
            url: href,
            // return the result
            success: function(result) {
                $("#editKHS").modal("show");
                $("#showModalKHS").html(result).show();
            },
            error: function(jqXHR, testStatus, error) {
                console.log(error);
                alert("Page " + href + " cannot open. Error:" + error);
            },
        });
    });
</script>

@stop