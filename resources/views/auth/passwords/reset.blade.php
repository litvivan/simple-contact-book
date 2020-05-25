@extends('layouts.auth')

@section('styles')
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet" />
@endsection

@section('content')
<div class="container">
    <div class="text-center">
        <form class="form-signin" method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <i class="far fa-address-book mb-4 auth-logo"></i>
            <h1 class="h3 mb-3 font-weight-normal">[{{ config('app.name', 'Laravel') }}] {{ __('Reset Password') }}</h1>

            <!-- Email input -->
            <label for="email" class="sr-only">{{ __('auth.email') }}</label>
            <input type="email" id="email" placeholder="{{ __('auth.email') }}" class="mt-2 form-control @error('email') is-invalid @enderror" name="email" value="{{ $email }}" required readonly autocomplete="email" >
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <div class="vertical-input-group mt-2">
                <!-- Password input -->
                <label for="password" class="sr-only">{{ __('auth.password') }}</label>
                <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="{{ __('auth.password') }}" name="password" required confirmed autocomplete="new-password" autofocus>

                <!-- Password confirmation input -->
                <label for="password_confirmation" class="sr-only">{{ __('Confirm password') }}</label>
                <input type="password" id="password_confirmation" class="form-control @error('password') is-invalid @enderror" placeholder="{{ __('Confirm password') }}" name="password_confirmation" required autocomplete="new-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <button class="btn btn-lg btn-primary btn-block mt-3" type="submit">{{ __('Reset Password') }}</button>

            <p class="mt-5 mb-3 text-muted">© 2020</p>
        </form>
    </div>
</div>

@endsection
