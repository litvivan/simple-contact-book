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
                        <span class="card-header-text">{{ __('Contact information') }}</span>

                        <contact-view-fav-btn
                            contact-id="{{ $contact->getId() }}"
                            api-token="{{ $currentUser->getApiToken() }}"
                            {{ $contact->getIsFavorite() ? 'init-is-favorite' : '' }}
                            text-marked="{{ __('Unmark favorite') }}"
                            text-unmarked="{{ __('Mark as favorite') }}"
                        ></contact-view-fav-btn>
                    </div>

                    <div class="card-body">
                        @if(session('messages'))
                            @foreach (session('messages') as $message)
                                <div class="alert alert-{{ $message['type'] }}" role="alert">
                                    {{ $message['text'] }}
                                </div>
                            @endforeach
                        @endif

                        <div class="contact-view">
                            <div class="attr-row row">
                                <span class="attr-title col-4">
                                    <i class="attr-title-icon fa fa-user"></i>
                                    <span class="attr-title-text">{{ __('Full name') }}</span>
                                </span>
                                <span class="col-8">
                                    <span class="attr-value">{{ $contact->getFullName() }}</span>
                                </span>
                            </div>

                            <div class="attr-row row">
                                <span class="attr-title col-4">
                                    <i class="attr-title-icon fa fa-phone-alt"></i>
                                    <span class="attr-title-text">{{ __('Phone') }}</span>
                                </span>
                                <span class="col-8">
                                    <span class="attr-value">{{ $contact->getPhone() }}</span>
                                </span>
                            </div>

                            <div class="contact-control-panel">
                                <a class="btn btn-primary" href="{{ route('contact.edit', $contact->getId()) }}" role="button">{{ __('Edit') }}</a>
                                @include('contacts._deleteBtn', ['contactId' => $contact->getId()])
                            </div>

                            {{--
                            <span class="contact-phone">{{ $contact->getPhone() }}</span>
                            <span class="contact-view contact-control-btn">
                                <a href="{{ url('contact.view', ['id' => $contact->getId()]) }}">
                                    <i class="fas fa-info"></i>
                                </a>

                            </span>
                            <span class="contact-favorite contact-control-btn">
                                <i class="{{ ($contact->getIsFavorite()) ? 'is-favorite fas' : 'far' }} fa-star"></i>
                            </span>
                            --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
