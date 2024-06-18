@extends('backend.layouts.app_backend')
@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h2>Nội dung page</h2>
        <a href="{{ route('get_admin.page.create') }}">Thêm mới</a>
    </div>
    <div>
        <form class="form-inline">
            <div class="form-group mb-2 mr-2">
                <label for="inputPassword2" class="sr-only">Tên</label>
                <input type="text" name="n" class="form-control" value="{{ Request::get('n') }}" placeholder="Nội dung tìm kiếm">
            </div>
            <button type="submit" class="btn btn-primary mb-2">Find</button>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Avatar</th>
                    <th>Nội dung page</th>
                    <th>Ngày tạo</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pages ?? [] as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>
                            <a href="" style="display: inline-block;position: relative">
                                <img src="{{ pare_url_file($item->avatar) }}" style="width: 60px;height: 60px; border-radius: 10px" alt="">
                            </a>
                        </td>
                        <td>
                            {{ $item->name }} <br>
                            {{ $item->description }} <br>
                        </td>
                        <td>{{ $item->created_at }}</td>
                        <td>
                            <a href="{{ route('get_admin.page.update', $item->id) }}">Edit</a>
                            <a href="javascript:;void(0)">|</a>
                            <a href="{{ route('get_admin.page.delete', $item->id) }}">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop
