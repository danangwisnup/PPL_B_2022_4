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
                                        <div class="mb-4 alert alert-success">
                                            Semester yang telah dientry adalah
                                            <strong>
                                                @if ($progress == null)
                                                Belum ada data
                                                @else
                                                @for ($i = 1; $i <= $progress->semester_aktif; $i++)
                                                    @if ($i != $progress->semester_aktif)
                                                    {{ $i }},
                                                    @else
                                                    {{ $i }}
                                                    @endif
                                                    @endfor
                                                    @endif
                                            </strong>
                                        </div>
                                    </div>
                                    <!-- Card header START -->
                                    <div class="card-header d-sm-flex text-center align-items-center justify-content-between border-0 pb-0">
                                        <h1 class="card-title h5">Progress Semester</h1>
                                        <div class="text-dark small">Harap diisi dengan data yang benar.</div>
                                    </div>
                                    <div class="card-body">
                                        <form class="row g-3" action="{{ route('entry_progress') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <!-- Pilih Semester START-->
                                            <div class="col-12">
                                                <label class="form-label text-dark">Semester Aktif</label>
                                                <select class="form-select @error('semester_aktif') is-invalid @enderror" id="semester_aktif" name="semester_aktif" required>
                                                    <option value="">Pilih Semester</option>
                                                    {{ $progress == null ? $i = 1 : $i = $progress->semester_aktif + 1 }}
                                                    @for ($i = $i; $i <= 14; $i++) <option value="{{ $i }}">Semester {{ $i }}</option>
                                                        @endfor
                                                </select>
                                            </div>
                                            <!-- Pilih Semester END -->
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

<!-- modal edit irs -->
<div class="modal fade" data-bs-backdrop="static" data-keyboard="false" id="editIRS" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit IRS</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" id="btnClose" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="showModalIRS">
                </div>
            </div>
        </div>
    </div>
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

<script src="{{ asset('assets/js/javascript-ajax.js') }}"></script>

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
    $(document).on("click", "#buttonModalIRS", function() {
        event.preventDefault();
        let href = $(this).attr("data-attr");
        $.ajax({
            url: href,
            // return the result
            success: function(result) {
                $("#editIRS").modal("show");
                $("#showModalIRS").html(result).show();
            },
            error: function(jqXHR, testStatus, error) {
                console.log(error);
                alert("Page " + href + " cannot open. Error:" + error);
            },
        });
    });
</script>

@stop