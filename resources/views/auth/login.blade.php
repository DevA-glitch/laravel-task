@extends('layouts.auth')
@section('title', 'LOGO | LOGIN')
@section('content')

    <div class="text-center mt-2">
        <h5 class="text-primary">Welcome Back !</h5>
        <p class="text-muted">Sign in to continue to Dashboards.</p>
    </div>
    <div class="p-2 mt-4 pb-5">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                    placeholder="Enter email" name="email" value="{{ old('email') }}" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">

                <label class="form-label" for="password-input">Password</label>
                <div class="position-relative auth-pass-inputgroup mb-3">
                    <input type="password" class="form-control pe-5 password-input @error('password') is-invalid @enderror"
                        placeholder="Enter password" id="password" name="password" autocomplete="current-password">
                    <button
                        class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                        type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                </div>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>



            <div class="mt-4">
                <button class="btn btn-success w-100" type="submit">Sign In</button>
            </div>


        </form>
    </div>
@endsection
