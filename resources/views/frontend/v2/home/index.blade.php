@extends('frontend.layouts.master')
@section('title_page','Trang chủ')
@section('content')
    <div class="intro-slider-container mb-5">
        <div class="intro-slider owl-carousel owl-theme owl-nav-inside owl-light" data-toggle="owl"
             data-owl-options='{
                        "dots": true,
                        "nav": false,
                        "responsive": {
                            "1200": {
                                "nav": true,
                                "dots": false
                            }
                        }
                    }'>
            @foreach($slides ?? [] as $item)
                <div class="intro-slide" style="background-image: url({{ pare_url_file($item->avatar) }});">
                    <div class="container intro-content">
                        <div class="row justify-content-end">
                            <div class="col-auto col-sm-7 col-md-6 col-lg-5">
                                <h3 class="intro-subtitle text-third">{{ $item->name }}</h3>
                                <a href="{{ $item->link }}" class="btn btn-primary btn-round">
                                    <span>Xem thêm</span>
                                    <i class="icon-long-arrow-right"></i>
                                </a>
                            </div><!-- End .col-lg-11 offset-lg-1 -->
                        </div><!-- End .row -->
                    </div><!-- End .intro-content -->
                </div><!-- End .intro-slide -->

            @endforeach
        </div><!-- End .intro-slider owl-carousel owl-simple -->

        <span class="slider-loader"></span><!-- End .slider-loader -->
    </div><!-- End .intro-slider-container -->

    <div class="container">
        <h2 class="title text-center mb-4">Danh mục nổi bật</h2><!-- End .title text-center -->

        <div class="cat-blocks-container">
            <div class="row">
                @foreach($categories ?? [] as $item)
                    <div class="col-6 col-sm-4 col-lg-2">
                        <a href="{{ route('get.category.item', $item->slug) }}" class="cat-block">
                            <figure>
                                    <span>
                                        <img src="{{ pare_url_file($item->avatar)  }}" onerror="this.src='/images/preloader.gif'" alt="{{ $item->name }}">
                                    </span>
                            </figure>

                            <h3 class="cat-block-title">{{ $item->name }}</h3><!-- End .cat-block-title -->
                        </a>
                    </div><!-- End .col-sm-4 col-lg-2 -->
                @endforeach
            </div><!-- End .row -->
        </div><!-- End .cat-blocks-container -->
    </div><!-- End .container -->

    <div class="mb-3"></div><!-- End .mb-5 -->

    <div class="container new-arrivals">
        <div class="heading heading-flex mb-3">
            <div class="heading-left">
                <h2 class="title">Nổi bật</h2><!-- End .title -->
            </div><!-- End .heading-left -->

            <div class="heading-right">
                <ul class="nav nav-pills nav-border-anim justify-content-center">
                    @foreach($categoriesHome ?? [] as $key => $category)
                    <li class="nav-item">
                        <a class="nav-link {{ $key == 0 ? 'active' : '' }}" href="{{ route('get.category.item', $category->slug) }}">{{ $category->name }}</a>
                    </li>
                    @endforeach
                </ul>
            </div><!-- End .heading-right -->
        </div><!-- End .heading -->

        <div class="tab-content tab-content-carousel just-action-icons-sm">
            @foreach($categoriesHome ?? [] as $key => $category)
                <div class="tab-pane p-0 fade {{ $key == 0 ? 'show active' : '' }}" id="c{{ $category->id }}" role="tabpanel" aria-labelledby="c{{ $category->id }}">
                <div class="owl-carousel owl-full carousel-equal-height carousel-with-shadow" data-toggle="owl"
                     data-owl-options='{
                                "nav": true,
                                "dots": true,
                                "margin": 20,
                                "loop": false,
                                "responsive": {
                                    "0": {
                                        "items":2
                                    },
                                    "480": {
                                        "items":2
                                    },
                                    "768": {
                                        "items":3
                                    },
                                    "992": {
                                        "items":4
                                    },
                                    "1200": {
                                        "items":5
                                    }
                                }
                            }'>

                    @if(isset($category->products) && !$category->products->isEmpty())
                        @foreach($category->products ?? [] as $item)
                            @include('frontend.v2.components.product_item')
                        @endforeach
                    @endif
                </div><!-- End .owl-carousel -->
            </div><!-- .End .tab-pane -->
            @endforeach
        </div><!-- End .tab-content -->
    </div><!-- End .container -->

    <div class="mb-6"></div><!-- End .mb-6 -->

{{--    <div class="container">--}}
{{--        <div class="cta cta-border mb-5" style="background-image: url(assets/images/demos/demo-4/bg-1.jpg);">--}}
{{--            <img src="/fe_v2/assets/images/demos/demo-4/camera.png" alt="camera" class="cta-img">--}}
{{--            <div class="row justify-content-center">--}}
{{--                <div class="col-md-12">--}}
{{--                    <div class="cta-content">--}}
{{--                        <div class="cta-text text-right text-white">--}}
{{--                            <p>Shop Today’s Deals <br><strong>Awesome Made Easy. HERO7 Black</strong></p>--}}
{{--                        </div><!-- End .cta-text -->--}}
{{--                        <a href="#" class="btn btn-primary btn-round"><span>Shop Now - $429.99</span><i class="icon-long-arrow-right"></i></a>--}}
{{--                    </div><!-- End .cta-content -->--}}
{{--                </div><!-- End .col-md-12 -->--}}
{{--            </div><!-- End .row -->--}}
{{--        </div><!-- End .cta -->--}}
{{--    </div><!-- End .container -->--}}

    <div class="container">
        <hr class="mb-0">
        <div class="owl-carousel mt-5 mb-5 owl-simple" data-toggle="owl"
             data-owl-options='{
                        "nav": false,
                        "dots": false,
                        "margin": 30,
                        "loop": false,
                        "responsive": {
                            "0": {
                                "items":2
                            },
                            "420": {
                                "items":3
                            },
                            "600": {
                                "items":4
                            },
                            "900": {
                                "items":5
                            },
                            "1024": {
                                "items":6
                            }
                        }
                    }'>
            @foreach($suppliers ?? [] as $item)
                <a href="{{ route('get.product',['s' => $item->id]) }}" class="brand">
                    <img src="{{ pare_url_file($item->avatar) }}" alt="{{ $item->name }}">
                </a>
            @endforeach
        </div><!-- End .owl-carousel -->
    </div><!-- End .container -->

    <div class="bg-light pt-5 pb-6">
        <div class="container trending-products">
            <div class="heading heading-flex mb-4">
                <div class="heading-left">
                    <h2 class="title">Top sản phẩm bán chạy</h2><!-- End .title -->
                </div><!-- End .heading-left -->
            </div><!-- End .heading -->

            <div class="row">
                <div class="col-xl-5col d-none d-xl-block">
                    <div class="banner">
                        <a href="#">
                            <img src="{{ pare_url_file($slideTopPay->avatar ?? "") }}" alt="banner">
                        </a>
                    </div><!-- End .banner -->
                </div><!-- End .col-xl-5col -->

                <div class="col-xl-4-5col">
                    <div class="tab-content tab-content-carousel just-action-icons-sm">
                        <div class="tab-pane p-0 fade show active" id="trending-top-tab" role="tabpanel" aria-labelledby="trending-top-link">
                            <div class="owl-carousel owl-full carousel-equal-height carousel-with-shadow" data-toggle="owl"
                                 data-owl-options='{
                                            "nav": true,
                                            "dots": false,
                                            "margin": 20,
                                            "loop": false,
                                            "responsive": {
                                                "0": {
                                                    "items":2
                                                },
                                                "480": {
                                                    "items":2
                                                },
                                                "768": {
                                                    "items":3
                                                },
                                                "992": {
                                                    "items":4
                                                }
                                            }
                                        }'>
                                @foreach($productsBuy ?? [] as $item)
                                    @include('frontend.v2.components.product_item')
                                @endforeach

                            </div><!-- End .owl-carousel -->
                        </div><!-- .End .tab-pane -->
                    </div><!-- End .tab-content -->
                </div><!-- End .col-xl-4-5col -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .bg-light pt-5 pb-6 -->

    <div class="mb-5"></div><!-- End .mb-5 -->

    <div class="container for-you">
        <div class="heading heading-flex mb-3">
            <div class="heading-left">
                <h2 class="title">Sản phẩm mới</h2><!-- End .title -->
            </div><!-- End .heading-left -->
        </div><!-- End .heading -->

        <div class="products">
            <div class="row justify-content-center">
                @foreach($products ?? [] as $item)
                    <div class="col-6 col-md-4 col-lg-3">
                    <div class="product product-2">
                        <figure class="product-media">
{{--                            <span class="product-label label-circle label-sale">Sale</span>--}}
                            <a href="{{ route('get.product.item',['id' => $item->id, 'slug' => $item->slug]) }}">
                                <img src="{{ pare_url_file($item->avatar) }}" onerror="this.src='/images/preloader.gif'"  alt="" class="product-image">
                            </a>

{{--                            <div class="product-action-vertical">--}}
{{--                                <a href="#" class="btn-product-icon btn-wishlist" title="Add to wishlist"></a>--}}
{{--                            </div>--}}

{{--                            <div class="product-action">--}}
{{--                                <a href="#" class="btn-product btn-cart" title="Add to cart"><span>add to cart</span></a>--}}
{{--                                <a href="popup/quickView.html" class="btn-product btn-quickview" title="Quick view"><span>quick view</span></a>--}}
{{--                            </div>--}}
                        </figure>

                        <div class="product-body">
                            @if(isset($item->category))
                                <div class="product-cat">
                                    <a href="{{ route('get.category.item', $item->category->slug) }}" title="{{ $item->category->name }}">{{ $item->category->name }}</a>
                                </div><!-- End .product-cat -->
                            @endif
                            <h3 class="product-title"><a href="{{ route('get.product.item',['id' => $item->id, 'slug' => $item->slug]) }}">{{ $item->name }}</a></h3><!-- End .product-title -->
                            <div class="product-price">
{{--                                <span class="new-price">$279.99</span>--}}
{{--                                <span class="old-price">Was $349.99</span>--}}
                                {{ number_format($item->price,0,',',',') }} đ
                            </div><!-- End .product-price -->
                            <div class="ratings-container">
                                <div class="ratings">
                                    <div class="ratings-val" style="width: 40%;"></div><!-- End .ratings-val -->
                                </div><!-- End .ratings -->
                                <span class="ratings-text">( {{ $item->total_vote }} Đánh giá )</span>
                            </div><!-- End .rating-container -->
                        </div><!-- End .product-body -->
                    </div><!-- End .product -->
                </div><!-- End .col-sm-6 col-md-4 col-lg-3 -->
                @endforeach
            </div><!-- End .row -->
        </div><!-- End .products -->
    </div><!-- End .container -->

    <div class="mb-4"></div><!-- End .mb-4 -->

    <div class="container">
        <hr class="mb-0">
    </div><!-- End .container -->

    <div class="icon-boxes-container bg-transparent">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-lg-3">
                    <div class="icon-box icon-box-side">
                                <span class="icon-box-icon text-dark">
                                    <i class="icon-rocket"></i>
                                </span>
                        <div class="icon-box-content">
                            <h3 class="icon-box-title">Free Shipping</h3><!-- End .icon-box-title -->
                            <p>Orders $50 or more</p>
                        </div><!-- End .icon-box-content -->
                    </div><!-- End .icon-box -->
                </div><!-- End .col-sm-6 col-lg-3 -->

                <div class="col-sm-6 col-lg-3">
                    <div class="icon-box icon-box-side">
                                <span class="icon-box-icon text-dark">
                                    <i class="icon-rotate-left"></i>
                                </span>

                        <div class="icon-box-content">
                            <h3 class="icon-box-title">Free Returns</h3><!-- End .icon-box-title -->
                            <p>Within 30 days</p>
                        </div><!-- End .icon-box-content -->
                    </div><!-- End .icon-box -->
                </div><!-- End .col-sm-6 col-lg-3 -->

                <div class="col-sm-6 col-lg-3">
                    <div class="icon-box icon-box-side">
                                <span class="icon-box-icon text-dark">
                                    <i class="icon-info-circle"></i>
                                </span>

                        <div class="icon-box-content">
                            <h3 class="icon-box-title">Get 20% Off 1 Item</h3><!-- End .icon-box-title -->
                            <p>when you sign up</p>
                        </div><!-- End .icon-box-content -->
                    </div><!-- End .icon-box -->
                </div><!-- End .col-sm-6 col-lg-3 -->

                <div class="col-sm-6 col-lg-3">
                    <div class="icon-box icon-box-side">
                                <span class="icon-box-icon text-dark">
                                    <i class="icon-life-ring"></i>
                                </span>

                        <div class="icon-box-content">
                            <h3 class="icon-box-title">We Support</h3><!-- End .icon-box-title -->
                            <p>24/7 amazing services</p>
                        </div><!-- End .icon-box-content -->
                    </div><!-- End .icon-box -->
                </div><!-- End .col-sm-6 col-lg-3 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .icon-boxes-container -->
@stop