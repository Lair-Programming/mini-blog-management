@extends('layouts.public')

@section('title', 'Admin Login')

@section('content')

    <div class="mx-auto" style="max-width: 420px;">
        <h1 class="page-title h3 mb-4 text-center">Admin Login</h1>

        <div class="card shadow-sm">
            <div class="card-body p-4">

                {{-- This form sends the email and password to the login() method in AuthController. --}}
                <form action="{{ route('login.submit') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Email</label>
                        <input type="email" name="email" id="email"
                               class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email') }}" autofocus>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label fw-semibold">Password</label>
                        <input type="password" name="password" id="password"
                               class="form-control @error('password') is-invalid @enderror">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-box-arrow-in-right me-1"></i>Log in
                    </button>
                </form>

            </div>
        </div>
    </div>

@endsection
