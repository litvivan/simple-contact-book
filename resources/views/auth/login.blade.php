@extends('layouts.auth')

@section('styles')
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet" />
@endsection

@section('content')
<div class="container">
    <div class="text-center">
        <form class="form-signin" method="POST" action="{{ route('login') }}">
            @csrf

            <i class="far fa-address-book mb-4 auth-logo"></i>
            <h1 class="h3 mb-3 font-weight-normal">[{{ config('app.name', 'Laravel') }}] {{ __('auth.login-title') }}</h1>

            <div class="vertical-input-group">
                <!-- Email input -->
                <label for="email" class="sr-only">{{ __('auth.email') }}</label>
                <input type="email" id="email" placeholder="{{ __('auth.email') }}" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                <!-- Password input -->
                <label for="password" class="sr-only">{{ __('auth.password') }}</label>
                <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="{{ __('auth.password') }}" name="password" required autocomplete="current-password">

                <!-- Auth Errors -->
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Remember me checkbox -->
            <div class="checkbox mt-3">
                <label>
                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                </label>
            </div>

            <!-- Forgot password -->
            @if (Route::has('password.request'))
                <a class="btn btn-link mb-2" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            @endif

            <button class="btn btn-lg btn-primary btn-block" type="submit">{{ __('auth.login-action') }}</button>

            <a class="btn btn-link mb-2" href="{{ route('register') }}">
                {{ __('auth.register-action') }}
            </a>

            <p class="mt-5 mb-3 text-muted">© 2020</p>
        </form>
    </div>
</div>

@endsection
