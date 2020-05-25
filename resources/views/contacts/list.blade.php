@extends('layouts.app')

@section('styles')
    <link href="{{ asset('css/contacts.css') }}" rel="stylesheet" />
@endsection

@section('scripts')
    <script>

    </script>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Contact list') }}</div>

                    <div class="card-body">
                        @if(session('messages'))
                            @foreach (session('messages') as $message)
                                <div class="alert alert-{{ $message['type'] }}" role="alert">
                                    {{ $message['text'] }}
                                </div>
                            @endforeach
                        @endif

                        <div class="contact-list">
                            @if (count($contacts) == 0)
                                <p>{{ __('There are no contacts yet')  }}</p>
                            @endif

                            @foreach ($contacts as $contact)
                                <div class="contact-row">
                                    <span class="contact-fio">
                                        <i class="contact-row-icon far fa-user"></i>
                                        <span class="contact-row-value">{{ $contact->getFullName() }}</span>
                                    </span>
                                    <span class="contact-phone">
                                        <i class="contact-row-icon fas fa-phone-alt"></i>
                                        <span class="contact-row-value">{{ $contact->getPhone() }}</span>
                                    </span>
                                    <span class="contact-view contact-control-btn">
                                        <a href="{{ route('contact.view', ['id' => $contact->getId()]) }}">
                                            <i class="fas fa-info"></i>
                                        </a>

                                    </span>
                                    <contact-list-fav-btn
                                        contact-id="{{ $contact->getId() }}"
                                        api-token="{{ $currentUser->getApiToken() }}"
                                        {{ $contact->getIsFavorite() ? 'init-is-favorite' : '' }}
                                    ></contact-list-fav-btn>

                                    {{--
                                    <span class="contact-favorite contact-control-btn">
                                        <i class="{{ ($contact->getIsFavorite()) ? 'is-favorite fas' : 'far' }} fa-star"></i>
                                    </span>
                                    --}}

                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
