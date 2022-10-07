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
                                    <div class="card-header">Progres Studi Mahasiswa</div>
                                    <div class="card-body">
                                        <p>KOSONG</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @endsection