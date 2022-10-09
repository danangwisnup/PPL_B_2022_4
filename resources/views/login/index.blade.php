@extends('layouts/main')

@section('content')
<main>
    <!-- Container START -->
    <div class="container">
        <div class="row justify-content-center align-items-center vh-100 py-5">
            <!-- Main content START -->
            <div class="col-sm-10 col-md-8 col-lg-7 col-xl-6 col-xxl-5">
                <div class="alert alert-info alert-message">
                    <strong>Operator</strong> : 123 | op@if.com | 123 <br />
                    <strong>Mahasiswa</strong> : 24060120120120 | mahasiswa20@if.com | 123 <br />
                    <strong>Dosen</strong> : H.1.299112052022042000 | dosen@if.com | 123 <br />
                    <strong>Department</strong> : 24060 | department@if.com | 123
                </div>
                <!-- Sign in START -->
                <div class="card card-body text-center p-4 p-sm-5">
                    @error('loginError')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <!-- Title -->
                    <h1 class="mb-2">Sign in</h1>
                    <!-- Form START -->
                    <form class="mt-4" action="/login" method="POST">
                        @csrf
                        <!-- Identifier -->
                        <div class="mb-3 input-group-lg">
                            <input type="text" class="form-control" id="identifier" name="identifier" placeholder="NIM or Email" value="{{ old('identifier') }}" required>
                        </div>
                        <!-- New password -->
                        <div class="mb-3 position-relative">
                            <!-- Password -->
                            <div class="input-group input-group-lg">
                                <input type="password" class="form-control fakepassword" id="password" name="password" placeholder="Password" required>
                                <span class="input-group-text p-0">
                                    <i class="fakepasswordicon fa-solid fa-eye-slash cursor-pointer p-2 w-40px"></i>
                                </span>
                            </div>
                        </div>
                        <!-- Button -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-lg btn-primary">Login</button>
                        </div>
                    </form>
                    <!-- Form END -->
                </div>
                <!-- Sign in START -->
            </div>
        </div> <!-- Row END -->
    </div>
    <!-- Container END -->

</main>
@endsection