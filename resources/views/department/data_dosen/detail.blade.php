@extends('layouts.main')

@section('content')

<div class="container-scroller">

    @include('layouts.navbar')

    <main>

        <!-- Container START -->
        <div class="container">
            <div class="row g-4">

                <!-- Main content START -->
                <div class="col-md-12 col-lg-6 vstack gap-4">
                    <!-- Card START -->
                    <div class="card">
                        <div class="card-header d-sm-flex text-center align-items-center justify-content-between border-0 pb-0">
                            <a href="/department/data_dosen" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-backspace"></i>
                                Kembali
                            </a>
                        </div>
                        <div class="text-center h5 mt-3">Detail Data Dosen</div>
                        <div class="card-body">
                            <div class="row g-3 mb-3 table-responsive">
                                <div class="col-2">
                                </div>
                                <div class="col-8">
                                    <div class="text-center">
                                        <div class="avatar avatar-xxxl mb-3">
                                            <a href="#!"><img class="avatar-img border border-white border-3 rounded-circle" src="{{ $dosen->foto != null ? asset($dosen->foto) : asset('assets/images/avatar/default.jpg') }}" alt=""></a>
                                        </div>
                                    </div>

                                    <table width="100%">
                                        <tr>
                                            <td width="160px">
                                                <p class="mb-3 border-bottom border-2 border-white"> <strong> Nama: </strong></p>
                                            </td>
                                            <td>
                                                <p class="border-bottom border-2"> {{ $dosen->nama }} </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p class="mb-3 border-bottom border-2 border-white"> <strong> NIP: </strong></p>
                                            </td>
                                            <td>
                                                <p class="border-bottom border-2"> {{ $dosen->nip }} </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p class="mb-3 border-bottom border-2 border-white"> <strong> Alamat: </strong></p>
                                            </td>
                                            <td>
                                                <p class="border-bottom border-2"> {{ $dosen->alamat != null ? $dosen->alamat : '-' }} </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p class="mb-3 border-bottom border-2 border-white"> <strong> No Handphone: </strong></p>
                                            </td>
                                            <td>
                                                <p class="border-bottom border-2"> {{ $dosen->handphone != null ? $dosen->handphone : '-' }} </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p class="mb-3 border-bottom border-2 border-white"> <strong> Status: </strong></p>
                                            </td>
                                            <td>
                                                <p class="border-bottom border-2"> {{ $dosen->status }} </p>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

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