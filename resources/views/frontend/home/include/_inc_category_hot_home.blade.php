@foreach($categoriesHome ?? [] as $category)
    <section class="section-3 mt-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="wrapper-title-section">

                        <h3 class="title-section">
                            <a href="#">{{ $category->name }}</a>
                        </h3>
                        <p class="des-section">{{ $category->description }}</p>
                    </div>
                </div>
                @if(isset($category->products) && !$category->products->isEmpty())
                    <div class="owl-carousel product">
                        @foreach($category->products ?? [] as $item)
                            <div class="product-item d-flex flex-column align-items-center ">
                                <div class="product-item-avt position-relative">
                                    <a href="{{ route('get.product.item',['id' => $item->id, 'slug' => $item->slug]) }}">
                                        <img src="{{ pare_url_file($item->avatar) }}" onerror="this.src='/images/preloader.gif'"  alt="">
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
                                        <span>({{ $age }})</span>
                                    </div>
                                    <div class="product-item-price d-flex ">
                                        <h4 class="m-0 price">{{ number_format($item->price,0,',','.') }}đ</h4>
{{--                                        <h4 class="m-0 price-down">20.000đ</h4>--}}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </section>
@endforeach
