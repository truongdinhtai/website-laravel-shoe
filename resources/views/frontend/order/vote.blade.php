@extends('frontend.layouts.master')
@section('title_page','Xác nhận - Cập nhật tài khoản')
@section('content')
    <div class="breadcrumb-wrapper mt-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcumb">
                        <a href="/" style="color: #007bff">Trang chủ</a>
                        <span class="breadcumb-icon mx-1"><i class="fa-solid fa-angles-right"></i></span>
                        <span>Đánh giá sản phẩm</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mt-3">
                <h4>Sản phẩm <b>{{ $product->name }}</b> | <a href="{{ route('get.order.detail', $transaction->id) }}" style="font-size: 14px;color: #007bff">Về đơn hàng</a></h4>
                <form method="POST" action="" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tiêu đề</label>
                        <input name="title" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nội dung đánh giá</label>
                        <textarea name="content_vote" class="form-control" id="" cols="5" rows="2"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Điểm đánh giá</label>
                        <input type="number" name="number_vote" required placeholder="1,2,3,4,5" class="form-control" value="">
                    </div>
                    <button type="submit" class="btn btn-primary mb-5">Đánh giá</button>
                </form>
            </div>
        </div>
    </div>
@stop
