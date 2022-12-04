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
                    @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    <!-- Card START -->
                    <div class="card">
                        <!-- Card header START -->
                        <div class="card-body">
                            <h1 class="card-title h5">Dosen</h1>
                            <div class="d-flex flex-column align-items-end mb-4">
                                <div id="table_wrapper"></div>
                            </div>
                            <div class="row g-3 mb-4">
                                <div class="col-6">
                                    <div id="filter_col4" data-column="4">
                                        <label class="form-label text-dark">Pilih Status</label>
                                        <select class="form-select column_filter" id="col4_filter">
                                            <option value="">Semua</option>
                                            <option value="Aktif">Aktif</option>
                                            <option value="Cuti">Cuti</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <form class="row g-3" action="{{ route('data_dosen_detail') }}" method="POST">
                                @csrf
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover" id="table_1">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama</th>
                                                    <th>NIP</th>
                                                    <th>Email</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($dosenAll as $dosen)
                                                <tr style="cursor: pointer;">
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $dosen->nama }}</td>
                                                    <td>{{ $dosen->nip }}</td>
                                                    <td>{{ $dosen->email }}</td>
                                                    <td>{{ $dosen->status }}</td>
                                                    <button type="submit" name="nip" id="{{ $dosen->nip }}" value="{{ $dosen->nip }}" hidden>Detail</button>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </form>
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
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.min.js"></script>

<script src="{{ asset('assets/js/javascript-ajax.js') }}"></script>
<script>
    var title = 'Dosen';
</script>
<script src="{{ asset('assets/js/data-table.js') }}"></script>
<script>
    $(document).ready(function() {
        $("#table_1").DataTable().buttons().container().appendTo("#table_wrapper");
    });
    $('#table_1 tbody').on('click', 'tr', function() {
        var data = $('#table_1').DataTable().row(this).data();
        var nip = data[2];
        document.getElementById(nip).click();
    });

    // change no from 1 if filter
    $('#table_1').on('draw.dt', function() {
        $('#table_1').DataTable().column(0, {
            search: 'applied',
            order: 'applied',
            page: 'applied'
        }).nodes().each(function(cell, i) {
            cell.innerHTML = i + 1;
        });
    });
</script>

@stop