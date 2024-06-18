@extends('frontend.layouts.master')
@section('title_page',"[$order->id] - Chi tiết đơn hàng" )
@section('content')
    <div class="breadcrumb-wrapper mt-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcumb">
                        <a href="{{ route('get.account') }}" style="color: #007bff">Tài khoản</a>
                        <span class="breadcumb-icon mx-1"><i class="fa-solid fa-angles-right"></i></span>
                        <a style="color: #007bff" href="{{ route('get.order') }}" title="Đơn hàng">Đơn hàng</a>
                        <span class="breadcumb-icon mx-1"><i class="fa-solid fa-angle-right"></i></span>
                        <span>DH{{ $order->id ?? 0 }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-3">
        <div class="row">
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
        @if ($order->order_referral_code)
            <style>
                iframe .header {
                    display: none !important;
                }
            </style>
            <div class="row">
                <div class="col-sm-12">
                    <h5 class="mt-5">Thông tin đơn hàng tại giao hàng nhanh</h5>
                    <iframe src="https://tracking.ghn.dev/?order_code={{ $order->order_referral_code }}" style="width: 100%;height: 400px"  frameborder="0"></iframe>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-lg-12 mt-2">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Đơn hàng</th>
                        <th scope="col">Sản phẩm</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Giá</th>
                        <th scope="col">Tổng tiền</th>
                        <th scope="col">#</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($transactions ?? [] as $item)
                        <tr>
                            <th scope="row">
                                <a style="color: #007bff">#DH{{ $item->id }}</a>
                            </th>
                            <td>
                                <a href="">
                                    <img src="{{ pare_url_file($item->avatar) }}" style="width: 100px; height: auto" alt="">
                                </a>
                            </td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ number_format($item->price,0,',','.') }}đ</td>
                            <td>{{ number_format($item->quantity * $item->price,0,',','.') }}đ</td>
                            <td><a style="font-size: 14px;color: #007bff" href="{{ route('get.vote.create', ['transactionID' => $order->id,'id' => $item->product_id]) }}">Đánh giá</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
