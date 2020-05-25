<form id="delete-button-form" action="{{ route('contact.delete', $contactId) }}" method="post">
    @csrf
    @method('DELETE')
{{--    <input type="hidden" name="api_token" value="{{ $currentUser->getApiToken() }}" />--}}
    <input type="submit" class="btn btn-danger" role="button" value="{{ __('Delete') }}" />
</form>
