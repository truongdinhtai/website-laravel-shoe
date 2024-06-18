@extends('frontend.layouts.master')
@section('title_page','Sản phẩm sỉ')
@section('content')
    <div class="wrapper-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-item py-3">
                        <a href="{{ route('get.home') }}" title="Trang chủ">Trang chủ</a>
                        <span><i class="fa-solid fa-angle-right"></i></span>
                        <span>Sản phẩm sỉ</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="wrapper-list-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    @include('frontend.component._inc_sidebar')
                </div>
                <div class="col-lg-9">
                    <div class="row">
                        @if (isset($user->is_wholesale) && $user->is_wholesale == 1)
                            <div class="col-md-12  ">
                                <div class="wrapper-view-soft border-bottom d-flex justify-content-between mb-4 pb-3">

                                    <div class="view-more">
                                        <span><i class="fa-solid fa-table"></i></span>
                                    </div>
                                    <div class="sort-by d-flex align-items-center">
                                        <span>
                                            Sắp xếp:
                                        </span>
                                        <select class="form-control form-control-sm">
                                            <option>Mặc định</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            @foreach($products ?? [] as $item)
                                <div class="col-md-4 col-6">
                                    <div class="product-item d-flex flex-column align-items-center ">
                                        <div class="product-item-avt position-relative">
                                            <a href="{{ route('get.product.item',['slug' => 'san-pham','id' => $item->id]) }}">
                                                <img src="{{ pare_url_file($item->avatar) }}" onerror="this.src='/images/preloader.gif'"  alt="{{ $item->name }}">
                                            </a>
                                        </div>
                                        <div class="product-item-info d-flex flex-column align-items-center">
                                            <h3 class="product-item-title m-0">
                                                <a href="{{ route('get.product.item',['id' => $item->id, 'slug' => $item->slug]) }}" title="{{ $item->name }}">{{ $item->name }}</a>
                                            </h3>
                                            <ul class="w-100 pb-2">
                                                @foreach($item->wholesale ?? [] as $key => $whole)
                                                    <li class="wholesale product-item-price d-flex justify-content-between mb-0" style="font-size: 13px;">
                                                        <span>{{ $whole->form }} - {{ $whole->to }} sp</span>
                                                        <span class="price" style="color: #F1486F">{{ number_format($whole->price,0,',','.') }} vnđ / 1sp</span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="alert alert-danger" role="alert">
                                Xin lỗi, chỉ có thành viên <b>Sỉ</b> mới có quyền truy cập page này, hãy liên hệ <b>Admin</b>
                                để đăng ký
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
