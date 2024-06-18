@extends('frontend.layouts.master')
@section('title_page','Thông báo')
@section('content')
    <div class="breadcrumb-wrapper mt-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcumb">
                        <a href="#" style="color: #007bff">Tài khoản</a>
                        <span class="breadcumb-icon mx-1"><i class="fa-solid fa-angles-right"></i></span>
                        <span>Cập nhật mật khẩu</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mt-5">
                <div class="alert alert-success" role="alert">
                    Link đổi mật khẩu đã được gủi vào email của bạn, xin vui lòng kiểm tra
                </div>
            </div>
        </div>
    </div>
@stop
