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
                    <div id="search">
                        <!-- Card START -->
                        <div class="card">
                            <!-- Card header START -->
                            <div class="card-header d-sm-flex text-center align-items-center justify-content-between border-0 pb-0">
                                <h1 class="card-title h5">Cari Mahasiswa</h1>
                            </div>
                            <div class="card-body">
                                <div class="row g-3 mb-4">
                                    <div class="col-6">
                                        <div id="filter_col3" data-column="3">
                                            <label class="form-label text-dark">Pilih Angkatan</label>
                                            <select class="form-select column_filter" id="col3_filter">
                                                <option value="">Semua</option>
                                                @for ($i = 2015; $i <= date('Y'); $i++) <option value="{{ $i }}">{{ $i }}</option>
                                                    @endfor
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <form action="{{ route('progress_detail') }}" method="GET">
                                    @csrf
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover" id="table_1">
                                                <thead>
                                                    <tr>
                                                        <th>Nama</th>
                                                        <th>NIM</th>
                                                        <th>Email</th>
                                                        <th>Angkatan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($mahasiswa as $data)
                                                    <tr style="cursor: pointer;">
                                                        <td>{{ $data->nama }}</td>
                                                        <td>{{ $data->nim }}</td>
                                                        <td>{{ $data->email }}</td>
                                                        <td>{{ $data->angkatan }}</td>
                                                        <button type="submit" name="nim" id="{{ $data->nim }}" value="{{ $data->nim }}" hidden>Detail</button>
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
<script src="{{ asset('assets/js/javascript-ajax.js') }}"></script>
<script src="{{ asset('assets/js/data-table.js') }}"></script>
<script>
    $('#table_1 tbody').on('click', 'tr', function() {
        var data = $('#table_1').DataTable().row(this).data();
        var nim = data[1];
        document.getElementById(nim).click();
    });
</script>

@stop