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
                                <div class="card mt-4">
                                    <h3 class="card-header">Data Dosen</h3>
                                    <div class="card-body">
                                        <input type="text" class="form-control" placeholder="Cari Dosen"><br>
                                        <table class="table table-striped">
                                            <tr>
                                                <th>NIP</th>
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th>Alamat</th>
                                                <th>Headphone</th>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

@endsection