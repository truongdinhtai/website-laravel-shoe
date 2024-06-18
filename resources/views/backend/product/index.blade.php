@extends('backend.layouts.app_backend')
@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h2>Sản phẩm</h2>
        <div class="d-flex">
            <a href="{{ route('get_admin.product.export') }}" class="btn btn-success btn-sm">Export</a>
            <a href="{{ route('get_admin.product.create') }}" class="btn btn-primary btn-sm" style="margin-left: 10px">Thêm mới</a>
        </div>
    </div>
    <div>
        <form class="form-inline">
            <div class="form-group mb-2 mr-2">
                <label for="inputPassword2" class="sr-only">Tên</label>
                <input type="text" name="n" class="form-control" value="{{ Request::get('n') }}" placeholder="Nhập tên sản phẩm ...">
            </div>

            <div class="form-group mb-2 mr-2">
                <label for="inputPassword2" class="sr-only">Trạng thái</label>
                <select name="status" id="" class="form-control">
                    <option value="">---</option>
                    @foreach($status ?? [] as $key => $item)
                        <option value="{{ $key }}" {{ (Request::get('status') ?? 0) == $key ? "selected" : "" }}>{{ $item['name'] }}</option>
                    @endforeach
                </select>
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
                    <th style="width: 30%">Tên sản phẩm</th>
                    <th>Danh mục</th>
                    <th>Author</th>
                    <th>Giá</th>
                    <th>Tình trạng</th>
                    <th>Trạng thái</th>
                    <th>Ngày tạo</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products ?? [] as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>
                            <a href="" style="display: inline-block;position: relative">
                                <img src="{{ pare_url_file($item->avatar) }}" style="width: 60px;height: 60px; border-radius: 10px" alt="">
                                <span class="badge badge-danger" style="position: absolute;right: 10px;top: 10px">{{ $item->images_count }}</span>
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('get.product.item',['id' => $item->id, 'slug' => $item->slug]) }}" target="_blank" title="{{ $item->name }}">{{ $item->name }} </a><br>
                            <span>{{ $item->province->name ?? "..." }} - {{ $item->district->name ?? "..." }} - {{ $item->ward->name ?? "..." }}</span>
                        </td>
                        <td>{{ $item->category->name ?? "[N\A]" }}</td>
                        <td>{{ $item->user->name ?? "[N\A]" }}</td>
                        <td>{{ number_format($item->price,0,',','.') }}đ</td>
                        <td>
                            <span class="badge badge-{{ $item->number <= 0 ? "secondary text-light bg-secondary" : "danger bg-danger" }}">{{ $item->number > 0 ? "Còn hàng" : "Hết hàng" }}</span>
                        </td>
                        <td>
                            <span class="{{ $item->getStatus($item->status)['class'] ?? "badge badge-light" }}">{{ $item->getStatus($item->status)['name'] ?? "Tạm dừng" }}</span>
                        </td>
                        <td>{{ $item->created_at }}</td>
                        <td>
                            <a href="{{ route('get_admin.product.update', $item->id) }}">Edit</a>
                            <a href="javascript:;void(0)">|</a>
                            <a href="{{ route('get_admin.product.delete', $item->id) }}">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="col-12">
            {!! $products->appends($query ?? [])->links() !!}
        </div>
    </div>
@stop
