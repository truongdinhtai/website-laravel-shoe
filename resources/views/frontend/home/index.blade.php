@extends('frontend.layouts.master')
@section('content')
    <section class="section-1 mt-md-4">
        <div class="container">
            <div class="row flex-lg-row-reverse">
                <div class="col-12 col-lg-9">
                    <div class="owl-carousel slide">
                        @foreach($slides ?? [] as $item)
                            <div class="slide-img">
                                <a href="{{ $item->link }}">
                                    <img src="{{ pare_url_file($item->avatar) }}" alt="{{ $item->name }}">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-12 col-lg-3 d-none d-sm-block">
                    @include('frontend.home.include._inc_category_home')
                </div>
            </div>
        </div>
    </section>

{{--    @include('frontend.home.include._inc_banner_home')--}}
    @include('frontend.home.include._inc_products_buy')
    @include('frontend.home.include._inc_category_hot_home')
@stop
