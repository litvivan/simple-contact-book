@extends('layouts.auth')

@section('styles')
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet" />
@endsection

@section('content')
<div class="container">
    <div class="text-center">
        <form class="form-signin" method="POST" action="{{ route('register') }}">
            @csrf

            <i class="far fa-address-book mb-4 auth-logo"></i>
            <h1 class="h3 mb-3 font-weight-normal">[{{ config('app.name', 'Laravel') }}] {{ __('auth.register-title') }}</h1>

            <!-- Name input -->
            <label for="name" class="sr-only">{{ __('auth.name') }}</label>
            <input type="text" id="name" placeholder="{{ __('auth.name') }}" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <!-- Email input -->
            <label for="email" class="sr-only">{{ __('auth.email') }}</label>
            <input type="email" id="email" placeholder="{{ __('auth.email') }}" class="mt-2 form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <div class="vertical-input-group mt-2">
                <!-- Password input -->
                <label for="password" class="sr-only">{{ __('auth.password') }}</label>
                <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="{{ __('auth.password') }}" name="password" required confirmed autocomplete="current-password">

                <!-- Password confirmation input -->
                <label for="password_confirmation" class="sr-only">{{ __('Confirm password') }}</label>
                <input type="password" id="password_confirmation" class="form-control @error('password') is-invalid @enderror" placeholder="{{ __('Confirm password') }}" name="password_confirmation" required autocomplete="new-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <button class="btn btn-lg btn-primary btn-block mt-3" type="submit">{{ __('auth.register-action') }}</button>
            <p class="mt-5 mb-3 text-muted">© 2020</p>
        </form>
    </div>
</div>
@endsection
