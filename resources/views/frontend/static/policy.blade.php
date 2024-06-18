@extends('frontend.layouts.master')
@section('title_page','Chính sách bảo hành')
@section('content')
    <div class="breadcrumb-wrapper mt-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcumb">
                        <a href="" style="color: #007bff">Trang chủ</a>
                        <span class="breadcumb-icon mx-1"><i class="fa-solid fa-angles-right"></i></span>
                        <span>Chính sách bảo hành</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                @include('frontend.static._inc_content')
            </div>
        </div>
    </div>
@stop
