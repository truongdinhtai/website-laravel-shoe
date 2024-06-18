@extends('backend.layouts.app_backend')
@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h2>Bài viết</h2>
        <a href="{{ route('get_admin.article.create') }}">Thêm mới</a>
    </div>
    <div>
        <form class="form-inline">
            <div class="form-group mb-2 mr-2">
                <label for="inputPassword2" class="sr-only">Tên</label>
                <input type="text" name="n" class="form-control" value="{{ Request::get('n') }}" placeholder="Tên bài viết..">
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
                    <th>Tên bài viết</th>
                    <th>Danh mục</th>
                    <th>Author</th>
                    <th>Ngày tạo</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach($articles ?? [] as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>
                            <a href="" style="display: inline-block;position: relative">
                                <img src="{{ pare_url_file($item->avatar) }}" style="width: 60px;height: 60px; border-radius: 10px;object-fit: contain" alt="">
                                <span class="badge badge-danger" style="position: absolute;right: 10px;top: 10px">{{ $item->images_count }}</span>
                            </a>
                        </td>
                        <td>
                            {{ $item->name }} <br>
                        </td>
                        <td>{{ $item->menu->name ?? "[N\A]" }}</td>
                        <td>{{ $item->user->name ?? "[N\A]" }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>
                            <a href="{{ route('get_admin.article.update', $item->id) }}">Edit</a>
                            <a href="javascript:;void(0)">|</a>
                            <a href="{{ route('get_admin.article.delete', $item->id) }}">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop
