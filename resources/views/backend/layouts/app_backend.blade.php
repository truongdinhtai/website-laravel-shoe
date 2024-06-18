@if (config('app.layout_admin') == 'v1')
    @include('backend.layouts.app_backend_v1')
@else
    @include('backend.layouts.app_backend_v2')
@endif
