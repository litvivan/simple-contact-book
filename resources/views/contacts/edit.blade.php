@extends('contacts._form')

@section('header', __('Edit contact'))
@section('form-action', route('contact.update', $contact->getId()))
@section('cancel-button-href', route('contact.view', $contact->getId()))
@section('submit-button-text', __('Save'))

