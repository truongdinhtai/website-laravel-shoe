@extends('frontend.layouts.master')
@section('title_page', $category->name)
@section('content')
    <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">{{ $category->name }}</h1>
        </div><!-- End .container -->
    </div>
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('get.home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>
            </ol>
        </div><!-- End .container -->
    </nav>
    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    @include('frontend.v2.components.product_lists')
                </div><!-- End .col-lg-9 -->
                <aside class="col-lg-3 order-lg-first">
                    @include('frontend.component._inc_sidebar_v2')
                </aside><!-- End .col-lg-3 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div>
@stop