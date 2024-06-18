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
            <div class="product-item-star">
                @php  $age = renderAgeVote($item) @endphp
                @for($i = 1 ; $i <= 5 ; $i ++)
                    <span class="{{ $age >= $i  ? 'active' : '' }}"><i class="fa-regular fa-star"></i></span>
                @endfor
            </div>
            <div class="product-item-price d-flex ">
                <h4 class="m-0 price">{{ number_format($item->price,0,',','.') }}đ</h4>
                {{--                                            <h4 class="m-0 price-down">20.000đ</h4>--}}
            </div>
        </div>
    </div>
</div>
