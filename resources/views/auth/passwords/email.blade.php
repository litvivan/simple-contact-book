@extends('layouts.auth')

@section('styles')
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet" />
@endsection

@section('content')
<div class="container">
    <div class="text-center">
        <form class="form-signin" method="POST" action="{{ route('password.email') }}">
            @csrf

            <i class="far fa-address-book mb-4 auth-logo"></i>
            <h1 class="h3 mb-3 font-weight-normal">[{{ config('app.name', 'Laravel') }}] {{ __('Reset Password') }}</h1>

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Email input -->
            <label for="email" class="sr-only">{{ __('auth.email') }}</label>
            <input type="email" id="email" placeholder="{{ __('auth.email') }}" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

            <!-- Auth Errors -->
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <button class="btn btn-lg btn-primary btn-block mt-3" type="submit">{{ __('Send Password Reset Link') }}</button>

            <p class="mt-5 mb-3 text-muted">© 2020</p>
        </form>
    </div>
</div>

@endsection
