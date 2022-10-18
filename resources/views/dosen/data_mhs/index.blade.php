@extends('layouts.main')

@section('content')

<div class="container-scroller">

    @include('layouts.navbar')

    <main>
        <!-- Container START -->
        <div class="container">
            <div class="row g-4">

                @include('layouts.sidebar')

                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Data Mahasiswa</h5><br>
                                    <div class="row">
                                        <!--  -->
                                        <div class="col-md-2">
                                            <select class="form-select form-select-sm" name="" id="">
                                                <option value="5">5</option>
                                                <option value="10">10</option>
                                                <option value="10">20</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <select class="form-select form-select-sm" name="angkatan" id="angkatan">
                                                <option value="2016">2016</option>
                                                <option value="2017">2017</option>
                                                <option value="2018">2018</option>
                                                <option value="2019" selected>2019</option>
                                                <option value="2020">2020</option>
                                                <option value="2021">2021</option>
                                                <option value="2022">2022</option>
                                            </select>                                        
                                        </div>
                                        <div class="col-md-8">
                                            <div class="row">
                                                <div class="d-flex flex-column align-items-end">
                                                    <div class="col-md-6">
                                                        <div class="input-group input-group-sm">
                                                            <input class="form-control border-end-0 border rounded-start" type="text" value="" id="example-search-input" placeholder="Search">
                                                            <span class="input-group-append">
                                                                <button class="btn btn-sm btn-light bg-white border-start-0 border rounded-end ms-n3" type="button">
                                                                    <i class="fa fa-search"></i>
                                                                </button>
                                                            </span>
                                                        </div>   
                                                    </div>
                                                </div>
                                            </div>     
                                        </div>
                                    </div><br>
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr class="table-active">
                                                <th>NIM</th>
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th>Angkatan</th>
                                                <th></th>
                                            </tr>
                                            <tr>
                                                <td>123475</td>
                                                <td>John</td>
                                                <td>Email</td>
                                                <td>2019</td>
                                                <td><a href="#">More</a></td>
                                            </tr>
                                            <tr>
                                                <td>123475</td>
                                                <td>John</td>
                                                <td>Email</td>
                                                <td>2019</td>
                                                <td><a href="#">More</a></td>
                                            </tr>
                                            <tr>
                                                <td>123475</td>
                                                <td>John</td>
                                                <td>Email</td>
                                                <td>2019</td>
                                                <td><a href="#">More</a></td>
                                            </tr>
                                            <tr>
                                                <td>123475</td>
                                                <td>John</td>
                                                <td>Email</td>
                                                <td>2019</td>
                                                <td><a href="#">More</a></td>
                                            </tr>
                                            <tr>
                                                <td>123475</td>
                                                <td>John</td>
                                                <td>Email</td>
                                                <td>2019</td>
                                                <td><a href="#">More</a></td>
                                            </tr>
                                        </thead>
                                    </table>
                                    <div class="container">
                                        <div class="d-flex align-items-center">
                                            <div class="col-md-3">
                                                <div class="d-flex justify-content-center">
                                                    <button class="btn btn-light btn-sm"><i class="bi bi-arrow-left"></i></button>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="d-flex justify-content-center text-center">
                                                    <p>Page 1 of 10</p>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="d-flex justify-content-center">
                                                    <button class="btn btn-light btn-sm"><i class="bi bi-arrow-right"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

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

@stop
