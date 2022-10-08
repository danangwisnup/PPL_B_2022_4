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
                        <div class="card-header d-sm-flex text-center align-items-center justify-content-between border-0 pb-0">
                            <h1 class="card-title h5">Cari Mahasiswa</h1>
                        </div>
                        <div class="card-body">
                            <form class="row g-3" action="/dosen/progress" method="POST">
                                @csrf
                                <div class="col-11">
                                    <input type="text" class="form-control" id="identifier" name="identifier" placeholder="NIM atau Email Mahasiswa" required>
                                </div>
                                <div class="col-1">
                                    <button type="submit" class="icon-md btn btn-primary-soft p-0">
                                        <i class="bi bi-search fs-6"> </i>
                                    </button>
                                </div>
                            </form>
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