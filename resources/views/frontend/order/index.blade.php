@extends('frontend.layouts.master')
@section('title_page','Đơn hàng của tôi')
@section('content')
    <div class="breadcrumb-wrapper mt-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcumb">
                        <a href="{{ route('get.account') }}" title="Tài khoản" style="color: #007bff">Tài khoản</a>
                        <span class="breadcumb-icon mx-1"><i class="fa-solid fa-angles-right"></i></span>
                        <span>Danh sách đơn hàng</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mt-2">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Đơn hàng</th>
                            <th scope="col">Khách hàng</th>
                            <th scope="col">Địa chỉ</th>
                            <th scope="col">Loại đơn</th>
                            <th scope="col">Hình thức</th>
                            <th scope="col">Tổng tiền</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Vận chuyển</th>
                            <th scope="col">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($orders ?? [] as $item)
                        <tr>
                            <th scope="row">
                                <a href="{{ route('get.order.detail',$item->id) }}" style="color: #007bff">#DH{{ $item->id }}</a>
                            </th>
                            <td>
                                <span>{{ $item->receiver_name }}</span>
                                <span>{{ $item->receiver_address }}</span>
                            </td>
                            <td>{{ $item->receiver_address }}</td>
                            <td>
                                <span class="badge badge-{{ $item->getOrderType($item->order_type)['class'] ?? "" }}">{{ $item->getOrderType($item->order_type)['name'] ?? "" }}</span>
                            </td>
                            <td>
                                <span class="badge badge-{{ $item->getOrderPaymentType($item->payment_type)['class'] ?? "" }}">{{ $item->getOrderPaymentType($item->payment_type)['name'] ?? "" }}</span>
                            </td>
                            <td>{{ number_format($item->total_price,0,',','.') }}đ</td>
                            <td>
                                <span class="badge badge-{{ $item->getStatus($item->status)['class'] }}">{{ $item->getStatus($item->status)['name'] }}</span>
                            </td>
                            <td>
                                <span class="badge badge-{{ $item->getStatusShippingConfig($item->shipping_status)['class'] }}">{{ $item->getStatusShippingConfig($item->shipping_status)['name'] }}</span>
                            </td>
                            <td>
                                @if ($item->status == 1)
                                    <a href="{{ route('get.order.update_status',$item->id) }}?status=-1">Huỷ đơn</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="col-12">
                    {!! $orders->appends($query ?? [])->links() !!}
                </div>
            </div>
        </div>
    </div>
@stop
