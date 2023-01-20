@if (session('success'))
    <div id="alert-data-success" data-status="{{ session('success') }}">{{ session('success') }}</div>
@elseif(session('error'))
    <div id="alert-data-error" data-status="{{ session('error') }}">{{ session('error') }}</div>
@endif
