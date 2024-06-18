@extends('backend.layouts.app_backend')
@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h2>Chi tiết đơn hàng #{{ $order->id }}</h2>
    </div>
    <div class="row mb-2">
        <div class="col-6">
            <h5>Địa chỉ giao hàng</h5>
            <p class="mb-0">{{ $order->receiver_name }}</p>
            <p class="mb-0">{{ $order->receiver_phone }}</p>
            <p class="mb-0">{{ $order->receiver_address }}</p>
        </div>
        <div class="col-4">
            <h5>Thanh toán</h5>
            <p class="mb-0">Thanh toán khi giao hàng (COD)</p>
            <p class="mb-0">Tổng tiền <b>{{ number_format($order->total_price,0,',','.') }} đ</b></p>
        </div>
        <div class="col-2">
            <h5>Ghi chú</h5>
            <p class="mb-0">{{ $order->note ?? 'Không có' }}</p>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>#</th>
                <th>Ảnh Sp</th>
                <th>Tên SP</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th>Thao tác</th>
            </tr>
            </thead>
            <tbody>
            @foreach($transactions ?? [] as $item)
                <tr>
                    <th>
                        <a style="color: #007bff">{{ $item->id }}</a>
                    </th>
                    <td>
                        <a href="">
                            <img src="{{ pare_url_file($item->avatar) }}" style="width: 100px; height: auto" alt="">
                        </a>
                    </td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->price,0,',','.') }}đ</td>
                    <td>{{ number_format($item->quantity * $item->price,0,',','.') }}đ</td>
                    <td>
                        <span class="badge badge-{{ $item->getStatus($item->status)['class'] ?? "badge badge-light" }}">{{ $item->getStatus($item->status)['name'] ?? "Tạm dừng" }}</span>
                    </td>
                    <td>
                        <a href="{{ route('get_admin.order.delete', $item->id) }}">Huỷ</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop
