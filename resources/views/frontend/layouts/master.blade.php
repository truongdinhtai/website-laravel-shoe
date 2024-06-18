@if (config('app.layout_admin') == 'v1')
    @include('frontend.layouts.master_v1')
@else
    @include('frontend.layouts.master_v2')
@endif
