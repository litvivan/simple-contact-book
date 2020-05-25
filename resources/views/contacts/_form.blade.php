@extends('layouts.app')

@section('styles')
    <link href="{{ asset('css/contacts.css') }}" rel="stylesheet" />
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <span class="card-header-text">@yield('header')</span>
                    </div>

                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </div>
                        @endif

                        <form method="post" action="@yield('form-action')">
                            @csrf
                            @if (isset($contact))
                                <input type="hidden" name="id" value="{{ $contact->getId() }}"/>
                            @endif

                            <div class="contact-edit">
                                <div class="form-group row">
                                    <span class="col-sm-4 col-form-label">
                                        <i class="attr-title-icon fa fa-user"></i>
                                        <label for="inputPhone">{{ __('Last name') }}</label>
                                    </span>
                                    <span class="col-8">
                                        <input type="text" class="form-control" id="inputLname" name="last_name"
                                               @if (isset($contact))
                                                    value="{{ $contact->getLastName() }}"
                                               @endif
                                        >
                                    </span>
                                </div>

                                <div class="form-group row">
                                    <span class="col-sm-4 col-form-label">
                                        <i class="attr-title-icon fa fa-user"></i>
                                        <label class="required" for="inputPhone">{{ __('First name') }}</label>
                                    </span>
                                    <span class="col-8">
                                        <input type="text" class="form-control" id="inputFname" name="first_name"
                                               @if (isset($contact))
                                                    value="{{ $contact->getFirstName() }}"
                                               @endif
                                        required>
                                    </span>
                                </div>

                                <div class="form-group row">
                                    <span class="col-sm-4 col-form-label">
                                        <i class="attr-title-icon fa fa-user"></i>
                                        <label for="inputPhone">{{ __('Patronymic name') }}</label>
                                    </span>
                                    <span class="col-8">
                                        <input type="text" class="form-control" id="inputPname" name="patronymic_name"
                                               @if (isset($contact))
                                                    value="{{ $contact->getPatronymicName() }}"
                                               @endif
                                        >
                                    </span>
                                </div>

                                <div class="form-group row">
                                    <span class="col-sm-4 col-form-label">
                                        <i class="attr-title-icon fa fa-phone-alt"></i>
                                        <label class="required" for="inputPhone">{{ __('Phone') }}</label>
                                    </span>
                                    <span class="col-8">
                                        <input type="text" class="form-control" id="inputPhone" name="phone"
                                               @if (isset($contact))
                                                    value="{{ $contact->getPhone() }}"
                                               @endif
                                         required>
                                    </span>
                                </div>

                                <div class="contact-control-panel">
                                    <a class="btn btn-secondary" href="@yield('cancel-button-href')" role="button">{{ __('Cancel') }}</a>
                                    <input type="submit" class="btn btn-primary" role="button" value="@yield('submit-button-text')"/>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
