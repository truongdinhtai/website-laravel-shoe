@extends('frontend.layouts.master')
@section('title_page', $product->name)
@section('content')
    <style>
        .liright {
            display: flex;
            justify-content: start;
        }

        .liright .comma {
            width: 35px;
            height: 35px;
            display: flex;
            border: 1px solid #a074741f;
            justify-content: center;
            align-items: center;
            margin-left: 10px;
            padding: 5px 30px;
        }

        .liright .comma:hover , .liright .active{
            cursor: pointer;
            color: red;
            border: 1px solid red;
        }
    </style>
    <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
        <div class="container d-flex align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('get.home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
            </ol>
        </div><!-- End .container -->
    </nav>
    <div class="page-content">
        <div class="container">
            <div class="product-details-top">
                <div class="row">
                    <div class="col-md-6">
                        <div class="product-gallery">
                            <figure class="product-main-image">
                                <img id="product-zoom" src="{{ pare_url_file($product->avatar) }}"
                                     data-zoom-image="{{ pare_url_file($product->avatar) }}" alt="product image">

                                <a href="#" id="btn-product-gallery" class="btn-product-gallery">
                                    <i class="icon-arrows"></i>
                                </a>
                            </figure><!-- End .product-main-image -->

                            <div id="product-zoom-gallery" class="product-image-gallery">
                                @if(isset($product->images) && !$product->images->isEmpty())
                                    @foreach($product->images ?? [] as $key => $img)
                                        <a class="product-gallery-item {{ $key == 0 ? 'active' : '' }}" href="#"
                                           data-image="{{ pare_url_file($img->path) }}"
                                           data-zoom-image="{{ pare_url_file($img->path) }}">
                                            <img src="{{ pare_url_file($img->path) }}" alt="product side">
                                        </a>
                                    @endforeach
                                @else
                                    <a class="product-gallery-item active" href="#"
                                       data-image="{{ pare_url_file($product->avatar) }}"
                                       data-zoom-image="{{ pare_url_file($product->avatar) }}">
                                        <img src="{{ pare_url_file($product->avatar) }}" alt="product side">
                                    </a>
                                @endif
                            </div><!-- End .product-image-gallery -->
                        </div><!-- End .product-gallery -->
                    </div><!-- End .col-md-6 -->
                    <div class="col-md-6">
                        <div class="product-details">
                            <h1 class="product-title">{{ $product->name }}</h1><!-- End .product-title -->

                            <div class="ratings-container">
                                @php  $age = renderAgeVote($product) @endphp
                                {{--                                <div class="ratings">--}}
                                {{--                                    <div class="ratings-val" style="width: 80%;"></div><!-- End .ratings-val -->--}}
                                {{--                                </div>--}}
                                <a class="ratings-text" href="#product-review-link"
                                   id="review-link">( {{ $product->total_vote }} Reviews )</a>
                            </div><!-- End .rating-container -->

                            <div class="product-price">
                                {{ number_format($product->price,0,',',',') }} đ
                            </div><!-- End .product-price -->

                            <div class="product-content">
                                <p>{{ $product->description }}</p>
                            </div><!-- End .product-content -->

                            <form action="{{ route('get.shopping.add', $query) }}">
                                <div class="details-filter-row details-row-size">
                                    <label for="qty">Qty:</label>
                                    <div class="product-details-quantity">
                                        <input type="number" id="qty" name="qty" class="form-control" value="1" min="1"
                                               max="10" step="1" data-decimals="0" required>
                                    </div><!-- End .product-details-quantity -->
                                </div><!-- End .details-filter-row -->
                                @if(!empty($attributes))
                                    <div class="detail-product-selector">
                                        <style>
                                            .parameter__list.active {
                                                display: block;
                                                margin-bottom: 15px;
                                            }

                                            .parameter__list li {
                                                align-items: flex-start;
                                                display: flex;
                                                padding: 10px;
                                            }

                                            .parameter__list li:nth-child(odd) {
                                                background-color: #f5f5f5;
                                            }

                                            .parameter__list .lileft {
                                                width: 140px;
                                                margin-bottom: 0;
                                            }

                                            .parameter__list .liright {
                                                width: calc(100% - 140px);
                                                padding: 0 5px 0 25px !important;
                                            }
                                        </style>
                                        <ul class="parameter__list 306530 active">
                                            @foreach($attributes as $key =>  $attribute)
                                                <li data-index="0" data-prop="0">
                                                    <p class="lileft">{{ $key }}:</p>
                                                    <div class="liright">
                                                        @foreach($attribute as $item)
                                                            <a  href="{{ request()->fullUrlWithQuery(['attr_'.$item['product_option_id']=> $item['id']]) }}" >
                                                                <span  class="comma {{ Request::get('attr_'.$item['product_option_id']) == $item['id'] ? 'active' : '' }}">{{ $item['name_value'] }}</span>
                                                            </a>
                                                        @endforeach
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @foreach($query ?? [] as $key => $item)
                                    <input type="hidden" value="{{ $item }}" name="{{ $key  }}">
                                @endforeach
                                <div class="product-details-action">
                                    <button type="submit" class="btn-product btn-cart"><span>Thêm giỏ hàng</span></button>
                                </div>
                            </form>

                            <div class="product-details-footer">
                                @if (isset($product->category))
                                    <div class="product-cat">
                                        <span>Danh mục:</span>
                                        <a href="{{ route('get.category.item', $product->category->slug) }}"
                                           title="{{ $product->category->name ?? "" }}">{{ $product->category->name ?? "" }}</a>
                                    </div><!-- End .product-cat -->
                                @endif

                                <div class="social-icons social-icons-sm">
                                    <span class="social-label">Share:</span>
                                    <a href="#" class="social-icon" title="Facebook" target="_blank"><i
                                                class="icon-facebook-f"></i></a>
                                    <a href="#" class="social-icon" title="Twitter" target="_blank"><i
                                                class="icon-twitter"></i></a>
                                    <a href="#" class="social-icon" title="Instagram" target="_blank"><i
                                                class="icon-instagram"></i></a>
                                    <a href="#" class="social-icon" title="Pinterest" target="_blank"><i
                                                class="icon-pinterest"></i></a>
                                </div>
                            </div><!-- End .product-details-footer -->
                        </div><!-- End .product-details -->
                    </div><!-- End .col-md-6 -->
                </div><!-- End .row -->
            </div><!-- End .product-details-top -->

            <div class="product-details-tab">
                <ul class="nav nav-pills justify-content-center" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="product-desc-link" data-toggle="tab" href="#product-desc-tab"
                           role="tab" aria-controls="product-desc-tab" aria-selected="true">Nội dung</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="product-review-link" data-toggle="tab" href="#product-review-tab"
                           role="tab" aria-controls="product-review-tab" aria-selected="false">Đánh giá sản phẩm
                            ({{ $product->total_vote }})</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="product-desc-tab" role="tabpanel"
                         aria-labelledby="product-desc-link">
                        <div class="product-desc-content">
                            {!! $product->content !!}
                        </div><!-- End .product-desc-content -->
                    </div><!-- .End .tab-pane -->

                    <div class="tab-pane fade" id="product-shipping-tab" role="tabpanel"
                         aria-labelledby="product-shipping-link">
                        <div class="product-desc-content">
                            <h3>Delivery &amp; returns</h3>
                            <p>We deliver to over 100 countries around the world. For full details of the delivery
                                options we offer, please view our <a href="#">Delivery information</a><br>
                                We hope you’ll love every purchase, but if you ever need to return an item you can do so
                                within a month of receipt. For full details of how to make a return, please view our <a
                                        href="#">Returns information</a></p>
                        </div><!-- End .product-desc-content -->
                    </div><!-- .End .tab-pane -->
                    <div class="tab-pane fade" id="product-review-tab" role="tabpanel"
                         aria-labelledby="product-review-link">
                        <div class="reviews">
                            <h3>Reviews ({{ $ratings->total() ?? 0 }})</h3>
                            @if($product->total_vote > 0)
                                @foreach($ratings as $item)
                                    <div class="review">
                                        <div class="row no-gutters">
                                            <div class="col-auto">
                                                <h4><a href="#">{{ $item->user->name ?? "Không xác định" }}</a></h4>
                                                <div class="ratings-container">
                                                    <div class="ratings">
                                                        <div class="ratings-val"
                                                             style="width: {{ $item->number_vote * 20 }}%;"></div>
                                                        <!-- End .ratings-val -->
                                                    </div><!-- End .ratings -->
                                                </div><!-- End .rating-container -->
                                                <span class="review-date">{{ $item->created_at }}</span>
                                            </div><!-- End .col -->
                                            <div class="col">
                                                <h4>{{ $item->title }}</h4>

                                                <div class="review-content">
                                                    <p>{{ $item->content_vote }}</p>
                                                </div><!-- End .review-content -->

                                                {{--                                                <div class="review-action">--}}
                                                {{--                                                    <a href="#"><i class="icon-thumbs-up"></i>Helpful (2)</a>--}}
                                                {{--                                                    <a href="#"><i class="icon-thumbs-down"></i>Unhelpful (0)</a>--}}
                                                {{--                                                </div><!-- End .review-action -->--}}
                                            </div><!-- End .col-auto -->
                                        </div><!-- End .row -->
                                    </div><!-- End .review -->
                                @endforeach
                            @endif
                        </div><!-- End .reviews -->
                    </div><!-- .End .tab-pane -->
                </div><!-- End .tab-content -->
            </div><!-- End .product-details-tab -->

            <h2 class="title text-center mb-4">Sản phẩm liên quan</h2><!-- End .title text-center -->
            <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl"
                 data-owl-options='{
                            "nav": false,
                            "dots": true,
                            "margin": 20,
                            "loop": false,
                            "responsive": {
                                "0": {
                                    "items":1
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
                                    "items":4,
                                    "nav": true,
                                    "dots": false
                                }
                            }
                        }'>
                @foreach($productsSuggest ?? [] as $item)
                    <div class="product product-7">
                        <figure class="product-media">
                            {{--                        <span class="product-label label-new">New</span>--}}
                            <a href="{{ route('get.product.item',['id' => $item->id, 'slug' => $item->slug]) }}">
                                <img src="{{ pare_url_file($item->avatar) }}"
                                     onerror="this.src='/images/preloader.gif'" alt=""
                                     class="product-image">
                            </a>

                            {{--                        <div class="product-action-vertical">--}}
                            {{--                            <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>--}}
                            {{--                            <a href="popup/quickView.html" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick view</span></a>--}}
                            {{--                            <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>--}}
                            {{--                        </div><!-- End .product-action-vertical -->--}}
                        </figure><!-- End .product-media -->

                        <div class="product-body">
                            @if(isset($item->category))
                                <div class="product-cat">
                                    <a href="{{ route('get.category.item', $item->category->slug) }}"
                                       title="{{ $item->category->name }}">{{ $item->category->name }}</a>
                                </div><!-- End .product-cat -->
                            @endif
                            <h3 class="product-title"><a
                                        href="{{ route('get.product.item',['id' => $item->id, 'slug' => $item->slug]) }}">{{ $item->name }}</a>
                            </h3><!-- End .product-title -->
                            <div class="product-price">
                                {{ number_format($item->price,0,',',',') }} đ
                            </div><!-- End .product-price -->
                            <div class="ratings-container">
                                <div class="ratings">
                                    <div class="ratings-val" style="width: 100%;"></div><!-- End .ratings-val -->
                                </div><!-- End .ratings -->
                                <span class="ratings-text">( {{ $item->total_vote }} Đánh giá )</span>
                            </div><!-- End .rating-container -->
                        </div><!-- End .product-body -->
                    </div><!-- End .product -->
                @endforeach
            </div><!-- End .owl-carousel -->
            <!-- End .owl-carousel -->
        </div><!-- End .container -->
    </div>
@stop