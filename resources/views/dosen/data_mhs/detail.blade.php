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
                            <a href="{{ url()->previous() }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-backspace"></i>
                                Kembali
                            </a>
                        </div>
                        <div class="text-center h5 mt-3">Detail Data Mahasiswa</div>
                        <div class="card-body">
                            <div class="row g-3 mb-3 table-responsive">
                                <div class="col-2">
                                </div>
                                <div class="col-8">
                                    <div class="text-center">
                                        <div class="avatar avatar-xxxl mb-3">
                                            <a href="#!"><img class="avatar-img border border-white border-3 rounded-circle" src="{{ asset('assets/images/avatar/03.jpg') }}" alt=""></a>
                                        </div>
                                    </div>

                                    <table width="100%">
                                        <tr>
                                            <td class="col-2"> <strong> Nama: </strong> </td>
                                            <td>
                                                <p class="border-bottom border-2"> {{ $mahasiswa->nama }} </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-2"> <strong> NIM: </strong> </td>
                                            <td>
                                                <p class="border-bottom border-2"> {{ $mahasiswa->nim }} </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-2"> <strong> Angkatan: </strong> </td>
                                            <td>
                                                <p class="border-bottom border-2"> {{ $mahasiswa->angkatan }} </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-2"> <strong> Dosen Wali: </strong> </td>
                                            <td>
                                                <p class="border-bottom border-2"> {{ $mahasiswa->kode_wali }} </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-2"> <strong> Alamat: </strong> </td>
                                            <td>
                                                <p class="border-bottom border-2"> {{ $mahasiswa->alamat }} </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-2"> <strong> Kota/Kabupaten: </strong> </td>
                                            <td>
                                                <p class="border-bottom border-2"> {{ $kabupaten->nama_kab }} </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-2"> <strong> Provinsi: </strong> </td>
                                            <td>
                                                <p class="border-bottom border-2"> {{ $provinsi->nama_prov }} </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-2"> <strong> Jalur Masuk: </strong> </td>
                                            <td>
                                                <p class="border-bottom border-2"> {{ $mahasiswa->jalur_masuk }} </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-2"> <strong> No Handphone: </strong> </td>
                                            <td>
                                                <p class="border-bottom border-2"> {{ $mahasiswa->handphone }} </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-2"> <strong> Status: </strong> </td>
                                            <td>
                                                <p class="border-bottom border-2"> {{ $mahasiswa->status }} </p>
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