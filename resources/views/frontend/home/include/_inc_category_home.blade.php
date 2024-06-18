<div class="wrapper-category">
    <h3 class="category-title">
        Danh mục
    </h3>
    <ul class="category-list">
        @foreach($categories ?? [] as $item)
            <li class="category-item">
                <a href="{{ route('get.category.item', $item->slug) }}" title="{{ $item->name }}" class="category-link">
                    <i class="fa-solid fa-circle-right"></i>
                    {{ $item->name }}
                </a>
            </li>
        @endforeach

{{--        <li class="category-item has-sub">--}}
{{--            <a href="#" class="category-link">--}}
{{--                <i class="fa-solid fa-circle-right"></i>--}}
{{--                Tất cả sản phẩm--}}

{{--            </a>--}}
{{--            <span class="category-item-icon">--}}
{{--                                    <i class="fa-solid fa-angle-right"></i>--}}
{{--                                </span>--}}
{{--            <ul class="list-sub-category">--}}
{{--                <li class="item-sub-category">--}}
{{--                    <a href="" class="link-sub-category">--}}
{{--                        Bánh Tráng--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="item-sub-category">--}}
{{--                    <a href="" class="link-sub-category">--}}
{{--                        Bánh Tráng--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </li>--}}
{{--        <li class="category-item">--}}
{{--            <a href="#" class="category-link">--}}
{{--                <i class="fa-solid fa-circle-right"></i>--}}
{{--                Tất cả sản phẩm--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li class="category-item has-sub">--}}
{{--            <a href="#" class="category-link">--}}
{{--                <i class="fa-solid fa-circle-right"></i>--}}
{{--                Tất cả sản phẩm--}}

{{--            </a>--}}
{{--            <span class="category-item-icon">--}}
{{--                                    <i class="fa-solid fa-angle-right"></i>--}}
{{--                                </span>--}}
{{--            <ul class="list-sub-category">--}}
{{--                <li class="item-sub-category">--}}
{{--                    <a href="" class="link-sub-category">--}}
{{--                        Bánh Tráng--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="item-sub-category">--}}
{{--                    <a href="" class="link-sub-category">--}}
{{--                        Bánh Tráng--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </li>--}}
{{--        <li class="category-item">--}}
{{--            <a href="#" class="category-link">--}}
{{--                <i class="fa-solid fa-circle-right"></i>--}}
{{--                Tất cả sản phẩm--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li class="category-item has-sub">--}}
{{--            <a href="#" class="category-link">--}}
{{--                <i class="fa-solid fa-circle-right"></i>--}}
{{--                Tất cả sản phẩm--}}

{{--            </a>--}}
{{--            <span class="category-item-icon">--}}
{{--                                    <i class="fa-solid fa-angle-right"></i>--}}
{{--                                </span>--}}
{{--            <ul class="list-sub-category">--}}
{{--                <li class="item-sub-category">--}}
{{--                    <a href="" class="link-sub-category">--}}
{{--                        Bánh Tráng--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="item-sub-category">--}}
{{--                    <a href="" class="link-sub-category">--}}
{{--                        Bánh Tráng--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </li>--}}
{{--        <li class="category-item">--}}
{{--            <a href="#" class="category-link">--}}
{{--                <i class="fa-solid fa-circle-right"></i>--}}
{{--                Tất cả sản phẩm--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li class="category-item has-sub">--}}
{{--            <a href="#" class="category-link">--}}
{{--                <i class="fa-solid fa-circle-right"></i>--}}
{{--                Tất cả sản phẩm--}}

{{--            </a>--}}
{{--            <span class="category-item-icon">--}}
{{--                                    <i class="fa-solid fa-angle-right"></i>--}}
{{--                                </span>--}}
{{--            <ul class="list-sub-category">--}}
{{--                <li class="item-sub-category">--}}
{{--                    <a href="" class="link-sub-category">--}}
{{--                        Bánh Tráng--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="item-sub-category">--}}
{{--                    <a href="" class="link-sub-category">--}}
{{--                        Bánh Tráng--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </li>--}}
    </ul>
</div>
