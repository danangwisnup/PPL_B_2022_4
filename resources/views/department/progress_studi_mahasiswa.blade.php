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
                                    <h5 class="card-title">Progres Studi Mahasiswa</h5>
                                    <div class="col-md-10">
                                        <div class="nav mt-3 mt-lg-0 d-flex align-items-center px-4 px-lg-0">
                                            <div class="nav-item w-100">
                                                <form class="rounded position-relative">
                                                    <input class="form-control ps-5 bg-light" type="search" placeholder="Search..." aria-label="Search">
                                                    <button class="btn bg-transparent px-2 py-0 position-absolute top-50 start-0 translate-middle-y" type="submit"><i class="bi bi-search fs-5"> </i></button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @endsection