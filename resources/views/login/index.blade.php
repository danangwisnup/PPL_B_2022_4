@extends('layouts/main')

@section('content')
<main>
    <!-- Container START -->
    <div class="container">
        <div class="row justify-content-center align-items-center vh-100 py-5">
            <!-- Main content START -->
            <div class="col-sm-10 col-md-8 col-lg-7 col-xl-6 col-xxl-5">
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
                        <!-- Remember me -->
                        <div class="mb-3 d-sm-flex justify-content-between">
                            <div>
                                <input type="checkbox" class="form-check-input">
                                <label class="form-check-label" for="rememberCheck">Remember me?</label>
                            </div>
                            <a href="javascript:;">Forgot password?</a>
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