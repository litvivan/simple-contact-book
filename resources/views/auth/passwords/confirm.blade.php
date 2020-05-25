@extends('layouts.auth')

@section('styles')
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet" />
@endsection

@section('content')
<div class="container">
    <div class="text-center">
        <form class="form-signin" method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <i class="far fa-address-book mb-4 auth-logo"></i>
            <h1 class="h3 mb-3 font-weight-normal">[{{ config('app.name', 'Laravel') }}] {{ __('Confirm password') }}</h1>

            <p>{{ __('Please confirm your password before continuing.') }}</p>

            <!-- Password input -->
            <label for="password" class="sr-only">{{ __('auth.password') }}</label>
            <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="{{ __('auth.password') }}" name="password" required autocomplete="current-password" autofocus>

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <!-- Forgot password -->
            @if (Route::has('password.request'))
                <a class="btn btn-link mt-3 mb-2" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            @endif

            <button class="btn btn-lg btn-primary btn-block" type="submit">{{ __('Confirm password') }}</button>

            <p class="mt-5 mb-3 text-muted">© 2020</p>
        </form>
    </div>
</div>

@endsection
