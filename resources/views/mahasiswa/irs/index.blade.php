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
                            <h1 class="card-title h5">Data IRS</h1>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="table_1">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Semester</th>
                                            <th>SKS</th>
                                            <th>Status</th>
                                            <th>Scan IRS</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($irs as $item)
                                        <tr>
                                            <td>{{ $item->semester_aktif }}</td>
                                            <td>{{ $item->sks }}</td>
                                            <td>
                                                @if ($item->status == 'Belum Diverifikasi')
                                                <span class="badge bg-warning">Belum Diverifikasi</span>
                                                @elseif($item->status == 'Diverifikasi')
                                                <span class="badge bg-success">Diverifikasi</span>
                                                @endif
                                            </td>
                                            <td><a href="{{ asset($item->upload_irs) }}" class="btn btn-info btn-sm"><i class="bi bi-eye"></i> Lihat</a></td>
                                            <td>
                                                <a href="" class="btn btn-success btn-sm" id="buttonModalIRS" data-bs-toggle="modal" data-bs-target="#editIRS" data-attr="{{ route('irs.edit', [$item->semester_aktif, $item->nim]) }}">
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
                            <h1 class="card-title h5">Input IRS</h1>
                            <div class="text-dark small">Harap diisi dengan data yang benar.</div>
                        </div>
                        <div class="card-body">
                            <form class="row g-3" action="{{ route('irs.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <!-- Pilih Semester START-->
                                <div class="col-6">
                                    <label class="form-label text-dark">Semester Aktif</label>
                                    <select class="form-select" id="semester_aktif" name="semester_aktif" required>
                                        <option value="">Pilih Semester</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        <option value="13">13</option>
                                        <option value="14">14</option>
                                    </select>
                                </div>
                                <!-- Pilih Semester END -->

                                <!-- Input Jumlah SKS START -->
                                <div class="col-6">
                                    <label class="form-label text-dark">Jumlah SKS</label>
                                    <input type="text" class="form-control" id="jumlah_sks" name="jumlah_sks" placeholder="Jumlah SKS" required>
                                </div>
                                <!-- Input Jumlah SKS END-->

                                <!-- Dropzone START-->
                                <div class="col-12">
                                    <label class="form-label">Scan IRS</label>
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