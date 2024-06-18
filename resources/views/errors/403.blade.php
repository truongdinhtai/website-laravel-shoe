@extends('backend.layouts.app_backend')
@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h2>Errors</h2>
    </div>
    <div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Cảnh báo!</strong> Bạn không có quyền truy cập. Xin vui lòng liên hệ Admin để được hỗ trợ.
    </div>
@stop
