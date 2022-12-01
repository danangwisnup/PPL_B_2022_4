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

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Entry Progress</h5>
                            @include('layouts/entryprogress')
                            <div class="tab-content mb-0 pb-0">
                                <div class="tab-pane fade show active">
                                    <div class="col-12">
                                        <div class="mb-4 alert alert-info"> Semester aktif saat ini adalah <strong> {{ $progress != null ? $progress->semester_aktif : 'Belum ada data' }} </strong> </div>
                                    </div>
                                    <!-- Card header START -->
                                    <div class="card-header d-sm-flex text-center align-items-center justify-content-between border-0 pb-0">
                                        <h1 class="card-title h5">KHS</h1>
                                        <div class="text-dark small">Harap diisi dengan data yang benar.</div>
                                    </div>
                                    <div class="card-body">
                                        <form class="row g-3" action="{{ route('khs.store') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="semester_aktif" value="{{ $progress != null ? $progress->semester_aktif : '' }}">

                                            <!-- Input IP Semester START -->
                                            <div class="col-6">
                                                <label class="form-label text-dark">IP Semester</label>
                                                <input type="number" step="0.01" class="form-control @error('ip_semester') is-invalid @enderror" id="ip_semester" name="ip_semester" placeholder="IP Semester" required>
                                                <div class="small italic text-danger center mt-1">Contoh: 3,99</div>
                                            </div>

                                            <!-- Input IP Semester END -->

                                            <!-- Input IP Kumulatif START -->
                                            <div class="col-6">
                                                <label class="form-label text-dark">IP Kumulatif</label>
                                                <input type="number" step="0.01" class="form-control @error('ip_kumulatif') is-invalid @enderror" id="ip_kumulatif" name="ip_kumulatif" placeholder="IP Kumulatif" required>
                                                <div class="small italic text-danger center mt-1">Contoh: 3,99</div>
                                            </div>
                                            <!-- Input IP Kumulatif END -->

                                            <!-- Dropzone START-->
                                            <div class="col-12">
                                                <label class="form-label">Scan KHS</label>
                                                <div class="dropzone">
                                                    <input type="file" class="filepond" id="file" name="file" data-allow-reorder="true">
                                                </div>
                                            </div>
                                            <!-- Dropzone END -->
                                            <div class="text-danger small fst-italic">*Format file [.pdf], pastikan file yang diupload benar.</div>

                                            <div class="col-12 text-end">
                                                <button type="submit" class="btn btn-sm btn-primary mb-0">Next</button>
                                            </div>
                                        </form>
                                    </div>

                                </div> <!-- Row END -->
                            </div>
                            <!-- Container END -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

@endsection

@section('script')

@include('sweetalert::alert')

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
</script>

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