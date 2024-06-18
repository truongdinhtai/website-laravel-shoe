@extends('backend.layouts.app_backend')
@section('content')
    <div class="">
        <h2>Chi tiết</h2>
        <p>Mã #{{ $warehouse->id }}</p>
        <p>Nhà cung cấp {{ $warehouse->supplier->name ?? "" }}</p>
    </div>
    <div class="d-flex justify-content-between align-items-center">
        <h4>Thông tin sản phẩm</h4>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>#</th>
                <th>Sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Tổng tiền</th>
                <th>Ngày tạo</th>
            </tr>
            </thead>
            <tbody>
            @foreach($productsWarehouse ?? [] as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->product->name ?? "" }}</td>
                    <td>{{ $item->qty }}</td>
                    <td>{{ number_format($item->price,0,',','.') }}đ</td>
                    <td>{{ number_format($item->total,0,',','.') }}đ</td>
                    <td>{{ $item->created_at }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop
