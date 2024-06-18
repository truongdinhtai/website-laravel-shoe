<div class="product product-2">
    @php
        $age = 0;
        if ($item->total_vote > 0) $age = round(($item->total_stars / $item->total_vote),2);
    @endphp
    <figure class="product-media">
        <span class="product-label label-circle label-top">Top</span>
        <a href="{{ route('get.product.item',['id' => $item->id, 'slug' => $item->slug]) }}">
            <img src="{{ pare_url_file($item->avatar) }}" onerror="this.src='/images/preloader.gif'"  alt="" class="product-image">
        </a>

        {{--                                    <div class="product-action-vertical">--}}
        {{--                                        <a href="#" class="btn-product-icon btn-wishlist" title="Add to wishlist"></a>--}}
        {{--                                    </div>--}}

        {{--                                    <div class="product-action">--}}
        {{--                                        <a href="#" class="btn-product btn-cart" title="Add to cart"><span>Thêm giỏ hàng</span></a>--}}
        {{--                                        <a href="popup/quickView.html" class="btn-product btn-quickview" title="Quick view"><span>quick view</span></a>--}}
        {{--                                    </div>--}}
    </figure><!-- End .product-media -->

    <div class="product-body">
        <div class="product-cat">
            <a href="{{ route('get.category.item', $category->slug) }}">{{ $category->name }}</a>
        </div><!-- End .product-cat -->

        <h3 class="product-title"><a href="{{ route('get.product.item',['id' => $item->id, 'slug' => $item->slug]) }}">{{ $item->name }}</a></h3><!-- End .product-title -->
        <div class="product-price">
            {{ number_format($item->price,0,',',',') }} đ
        </div><!-- End .product-price -->
        <div class="ratings-container">
            <div class="ratings">
                <div class="ratings-val" style="width: {{ $age * 20 }}%;"></div><!-- End .ratings-val -->
            </div><!-- End .ratings -->
            <span class="ratings-text">( {{ $item->total_vote }} Đánh giá )</span>
        </div><!-- End .rating-container -->
    </div><!-- End .product-body -->
</div><!-- End .product -->