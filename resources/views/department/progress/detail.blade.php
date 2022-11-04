@extends('layouts.main')

@section('content')

<div class="container-scroller">

    @include('layouts.navbar')

    <main>

        <!-- Container START -->
        <div class="container">
            <div class="row g-4">

                @include('layouts.sidebar')

                <!-- Main content START -->
                <div class="col-md-8 col-lg-6 vstack gap-4">
                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                        <li>{{session('error')}}</li>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    <!-- Card START -->
                    <div class="card">
                        <!-- Card header START -->
                        <div class="card-header d-sm-flex text-center align-items-center justify-content-between border-0 pb-0">
                            <a href="/department/progress_studi_mahasiswa" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-backspace"></i>
                                Kembali
                            </a>
                        </div>
                        <div class="card-body">
                            <h1 class="text-center h5">Progress Mahasiswa</h1>
                            <div class="row g-3 mt-3 table-responsive">
                                <div class="col-1">
                                </div>
                                <div class="col-11">
                                    <table cellpadding="5" width="100%">
                                        <tr>
                                            <td class="mb-3">
                                                <p class="mb-3 border-bottom border-2 border-white"> <strong> Nama: </strong></p>
                                            </td>
                                            <td width="400px">
                                                <p class="mb-3 border-bottom border-2"> {{ $mahasiswa->nama }} </p>
                                            </td>
                                            <td rowspan="5">
                                                <div class="avatar avatar-xxxl">
                                                    <a href="#!">
                                                        <img class="avatar-img border border-white border-3 rounded-circle" src="{{ $mahasiswa->foto == null ? asset('assets/images/avatar/default.jpg') : asset($mahasiswa->foto) }}" alt="">
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="mb-3">
                                                <p class="mb-3 border-bottom border-2 border-white"> <strong> NIM: </strong></p>
                                            </td>
                                            <td>
                                                <p class="mb-3 border-bottom border-2"> {{ $mahasiswa->nim }} </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="mb-3">
                                                <p class="mb-3 border-bottom border-2 border-white"> <strong> Angkatan: </strong></p>
                                            </td>
                                            <td>
                                                <p class="mb-3 border-bottom border-2"> {{ $mahasiswa->angkatan }} </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="mb-3">
                                                <p class="mb-3 border-bottom border-2 border-white"> <strong> Dosen Wali: </strong></p>
                                            </td>
                                            <td>
                                                <p class="mb-3 border-bottom border-2"> {{ $dosen != null ? $dosen->nama : '-' }} </p>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="row g-3 mt-2">
                                <div class=" col-1">
                                </div>
                                <div class="col-10">
                                    <h6>Semester</h6>
                                    <a class="btn {{ $semester[1] }} avatar-xl mb-3 me-3 text-white" id="buttonModalProgress" data-bs-toggle="modal" data-bs-target="#progress_view" data-attr="{{ route('department_progress_detail_semester', ['nim' => $mahasiswa->nim, 'semester' => 1]) }}"><br />1</a>
                                    <a class="btn {{ $semester[2] }} avatar-xl mb-3 me-3 text-white" id="buttonModalProgress" data-bs-toggle="modal" data-bs-target="#progress_view" data-attr="{{ route('department_progress_detail_semester', ['nim' => $mahasiswa->nim, 'semester' => 2]) }}"><br />2</a>
                                    <a class="btn {{ $semester[3] }} avatar-xl mb-3 me-3 text-white" id="buttonModalProgress" data-bs-toggle="modal" data-bs-target="#progress_view" data-attr="{{ route('department_progress_detail_semester', ['nim' => $mahasiswa->nim, 'semester' => 3]) }}"><br />3</a>
                                    <a class="btn {{ $semester[4] }} avatar-xl mb-3 me-3 text-white" id="buttonModalProgress" data-bs-toggle="modal" data-bs-target="#progress_view" data-attr="{{ route('department_progress_detail_semester', ['nim' => $mahasiswa->nim, 'semester' => 4]) }}"><br />4</a>
                                    <a class="btn {{ $semester[5] }} avatar-xl mb-3 me-3 text-white" id="buttonModalProgress" data-bs-toggle="modal" data-bs-target="#progress_view" data-attr="{{ route('department_progress_detail_semester', ['nim' => $mahasiswa->nim, 'semester' => 5]) }}"><br />5</a>
                                    <a class="btn {{ $semester[6] }} avatar-xl mb-3 me-3 text-white" id="buttonModalProgress" data-bs-toggle="modal" data-bs-target="#progress_view" data-attr="{{ route('department_progress_detail_semester', ['nim' => $mahasiswa->nim, 'semester' => 6]) }}"><br />6</a>
                                    <a class="btn {{ $semester[7] }} avatar-xl mb-3 me-3 text-white" id="buttonModalProgress" data-bs-toggle="modal" data-bs-target="#progress_view" data-attr="{{ route('department_progress_detail_semester', ['nim' => $mahasiswa->nim, 'semester' => 7]) }}"><br />7</a>
                                    <a class="btn {{ $semester[8] }} avatar-xl mb-3 me-3 text-white" id="buttonModalProgress" data-bs-toggle="modal" data-bs-target="#progress_view" data-attr="{{ route('department_progress_detail_semester', ['nim' => $mahasiswa->nim, 'semester' => 8]) }}"><br />8</a>
                                    <a class="btn {{ $semester[9] }} avatar-xl mb-3 me-3 text-white" id="buttonModalProgress" data-bs-toggle="modal" data-bs-target="#progress_view" data-attr="{{ route('department_progress_detail_semester', ['nim' => $mahasiswa->nim, 'semester' => 9]) }}"><br />9</a>
                                    <a class="btn {{ $semester[10] }} avatar-xl mb-3 me-3 text-white" id="buttonModalProgress" data-bs-toggle="modal" data-bs-target="#progress_view" data-attr="{{ route('department_progress_detail_semester', ['nim' => $mahasiswa->nim, 'semester' => 10]) }}"><br />10</a>
                                    <a class="btn {{ $semester[11] }} avatar-xl mb-3 me-3 text-white" id="buttonModalProgress" data-bs-toggle="modal" data-bs-target="#progress_view" data-attr="{{ route('department_progress_detail_semester', ['nim' => $mahasiswa->nim, 'semester' => 11]) }}"><br />11</a>
                                    <a class="btn {{ $semester[12] }} avatar-xl mb-3 me-3 text-white" id="buttonModalProgress" data-bs-toggle="modal" data-bs-target="#progress_view" data-attr="{{ route('department_progress_detail_semester', ['nim' => $mahasiswa->nim, 'semester' => 12]) }}"><br />12</a>
                                    <a class="btn {{ $semester[13] }} avatar-xl mb-3 me-3 text-white" id="buttonModalProgress" data-bs-toggle="modal" data-bs-target="#progress_view" data-attr="{{ route('department_progress_detail_semester', ['nim' => $mahasiswa->nim, 'semester' => 13]) }}"><br />13</a>
                                    <a class="btn {{ $semester[14] }} avatar-xl mb-3 me-3 text-white" id="buttonModalProgress" data-bs-toggle="modal" data-bs-target="#progress_view" data-attr="{{ route('department_progress_detail_semester', ['nim' => $mahasiswa->nim, 'semester' => 14]) }}"><br />14</a>
                                    <br />
                                    <h6 class="mt-2 mb-2">Keterangan:</h6>
                                    <a class="btn btn-danger btn-sm mb-1"></a> <small>Belum diisikan (IRS dan KHS) atau tidak digunakan</small><br />
                                    <a class="btn btn-info btn-sm mb-1"></a> <small>Sudah diisikan (IRS dan KHS)</small><br />
                                    <a class="btn btn-warning btn-sm mb-1"></a> <small>Sudah Lulus PKL (IRS, KHS, dan PKL)</small><br />
                                    <a class="btn btn-success btn-sm mb-1"></a> <small>Sudah Lulus Skripsi)</small><br />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<div class="modal fade" data-bs-backdrop="static" data-keyboard="false" id="progress_view" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-info">
            <div class="modal-header">
                <ul class="nav nav-tabs nav-bottom-line justify-content-center justify-content-md-start">
                    <li class="nav-item"> <a class="text-white nav-link active" data-bs-toggle="tab" href="#tab-1" id="tab1"> IRS </a> </li>
                    <li class="nav-item"> <a class="text-white nav-link" data-bs-toggle="tab" href="#tab-2" id="tab2"> KHS </a> </li>
                    <li class="nav-item"> <a class="text-white nav-link" data-bs-toggle="tab" href="#tab-3" id="tab3"> PKL </a> </li>
                    <li class="nav-item"> <a class="text-white nav-link" data-bs-toggle="tab" href="#tab-4" id="tab4"> Skripsi </a> </li>
                </ul>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" id="btnClose" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="showModalProgress">
            </div>
            <div class="modal-footer">
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

<script type="text/javascript">
    $(document).on("click", "#buttonModalProgress", function() {
        event.preventDefault();
        let href = $(this).attr("data-attr");
        $.ajax({
            url: href,
            // return the result
            success: function(result) {
                $("#progress_view").modal("show");
                $("#showModalProgress").html(result).show();
            },
            error: function(jqXHR, testStatus, error) {
                console.log(error);
                alert("Page " + href + " cannot open. Error:" + error);
            },
        });
    });
</script>

@stop