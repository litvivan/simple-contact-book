@extends('layouts.auth')

@section('styles')
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet" />
@endsection

@section('content')
<div class="container">
    <div class="text-center">
        <form class="form-signin" method="POST" action="{{ route('verification.resend') }}">
            @csrf

            <i class="far fa-address-book mb-4 auth-logo"></i>
            <h1 class="h3 mb-3 font-weight-normal">[{{ config('app.name', 'Laravel') }}] {{ __('Verify Your Email Address') }}</h1>

            @if (session('resent'))
                <div class="alert alert-success" role="alert">
                    {{ __('A fresh verification link has been sent to your email address.') }}
                </div>
            @endif

            <p>

                {{ __('Before proceeding, please check your email for a verification link.') }}
                {{ __('If you did not receive the email') }},
            </p>

            <button class="btn btn-lg btn-primary btn-block" type="submit">{{ __('click here to request another') }}</button>

            <p class="mt-5 mb-3 text-muted">© 2020</p>
        </form>
    </div>
</div>

@endsection
