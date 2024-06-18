<div class="toolbox">
    <div class="toolbox-left">
        <div class="toolbox-info">
            Hiển thị <span>{{ $products->perPage() ?? 0 }} of {{ $products->total() ?? 0 }}</span> sản phẩm
        </div><!-- End .toolbox-info -->
    </div><!-- End .toolbox-left -->
</div><!-- End .toolbox -->

<div class="products mb-3">
    <div class="row">
{{--    <div class="row justify-content-center">--}}
        @foreach($products ?? [] as $item)
            @php
                $age = 0;
                if ($item->total_vote > 0) $age = round(($item->total_stars / $item->total_vote),2);
            @endphp
            <div class="col-6 col-md-4 col-lg-4 col-xl-3">
                <div class="product product-7 text-center">
                    <figure class="product-media">
                        {{--                                        <span class="product-label label-new">New</span>--}}
                        <a href="{{ route('get.product.item',['slug' => 'san-pham','id' => $item->id]) }}">
                            <img src="{{ pare_url_file($item->avatar) }}" onerror="this.src='/images/preloader.gif'"  alt="{{ $item->name }}">
                        </a>
                    </figure><!-- End .product-media -->

                    <div class="product-body">
                        @if(isset($item->category))
                            <div class="product-cat">
                                <a href="{{ route('get.category.item', $item->category->slug) }}" title="{{ $item->category->name }}">{{ $item->category->name }}</a>
                            </div><!-- End .product-cat -->
                        @endif
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
            </div><!-- End .col-sm-6 col-lg-4 col-xl-3 -->
        @endforeach
    </div><!-- End .row -->
</div><!-- End .products -->


<nav aria-label="Page navigation">
    {!! $products->appends($query ?? [])->links() !!}
</nav>