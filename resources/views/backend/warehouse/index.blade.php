@extends('backend.layouts.app_backend')
@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h2>Nhập xuất kho</h2>
        <div class="d-flex">
            <a href="{{ route('get_admin.warehouse.export') }}" class="btn btn-success btn-sm">Export</a>
            <a href="{{ route('get_admin.warehouse.create') }}" class="btn btn-primary btn-sm" style="margin-left: 10px">Thêm mới</a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nhà cung cấp</th>
                    <th>Ngày</th>
                    <th>Số lượng</th>
                    <th>Tổng tiền</th>
                    <th>Phương thức</th>
                    <th>Ngày tạo</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach($warehouses ?? [] as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->supplier->name ?? "" }}</td>
                        <td>{{ $item->date_time }}</td>
                        <td>{{ $item->qty }}</td>
                        <td>{{ number_format($item->total_money,0,',','.') }}đ</td>
                        <td><span class="badge badge-{{ $item->type == 'input' ? "secondary text-light bg-secondary" : "danger bg-danger" }}">{{ $item->type == 'input' ? "Nhập kho" : "Xuất kho" }}</span></td>
                        <td>{{ $item->created_at }}</td>
                        <td>
                            <a href="{{ route('get_admin.warehouse.delete', $item->id) }}">Delete</a>
                            <a href="javascript:;void(0)">|</a>
                            <a href="{{ route('get_admin.warehouse.view', $item->id) }}">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop
