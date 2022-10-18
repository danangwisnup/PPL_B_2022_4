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
                                    <h5 class="card-title">Data Mahasiswa PKL per Angkatan</h5>
                                    <table class="table table-borderless text-center">
                                        <thead>
                                            <tr class="table-active">
                                                <th colspan="8">Angkatan</th>
                                            </tr>
                                            <tr class="table-active">
                                                <th></th>
                                                <th>2016</th>
                                                <th>2017</th>
                                                <th>2018</th>
                                                <th>2019</th>
                                                <th>2020</th>
                                                <th>2021</th>
                                                <th>2022</th>
                                            </tr>
                                            <tr>
                                                <th class="table-active">Sudah</th>
                                                <td>90</td>
                                                <td>108</td>
                                                <td>87</td>
                                                <td>32</td>
                                                <td>26</td>
                                                <td>0</td>
                                                <td>0</td>
                                            </tr>
                                            <tr>
                                                <th class="table-active">Belum</th>
                                                <td>20</td>
                                                <td>24</td>
                                                <td>40</td>
                                                <td>98</td>
                                                <td>135</td>
                                                <td>162</td>
                                                <td>179</td>
                                            </tr>
                                            <tr>

                                            </tr>
                                        </thead>
                                    </table>
                                    <div class="d-flex flex-column align-items-end">
                                        <button class="btn btn-primary btn-sm"><i class="bi bi-printer"></i> Cetak</button>
                                    </div>
                                </div>  
                                </div>
                            </div>
                                   
                        </div>
                        <div class="col-md-12 pt-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Rincian Data Mahasiswa PKL</h5>
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr class="table-active">
                                                <th>Nama</th>
                                                <th>NIM</th>
                                                <th>Angkatan</th>
                                                <th>Nilai</th>
                                                <th>Status</th>
                                            </tr>
                                            <tr>
                                                <td>Siapa</td>
                                                <td>12345</td>
                                                <td>2020</td>
                                                <td class="bg-light bg-opacity-75">Kosong</td>
                                                <td><span class="badge btn-danger-soft small">Belum</span></td>
                                            </tr>
                                            <tr>
                                                <td>Kars</td>
                                                <td>123464</td>
                                                <td>2018</td>
                                                <td>A</td>
                                                <td><span class="badge btn-success-soft small">Lulus</span></td>
                                            </tr>
                                            <tr>
                                                <td>John</td>
                                                <td>123475</td>
                                                <td>2019</td>
                                                <td class="bg-light bg-opacity-75">Kosong</td>
                                                <td><span class="badge btn-primary-soft small">Sedang</span></td>
                                            </tr>
                                        </thead>
                                    </table>
                                    <div class="d-flex flex-column align-items-end">
                                        <button class="btn btn-primary btn-sm"><i class="bi bi-printer"></i> Cetak</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @endsection