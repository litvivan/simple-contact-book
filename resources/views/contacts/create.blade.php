@extends('contacts._form')

@section('header', __('Add new contact'))
@section('form-action', route('contact.store'))
@section('cancel-button-href', route('contact.list'))
@section('submit-button-text', __('Create'))

