<div class="sidebar">
    <div class="wrapper-category">
        <h3 class="category-title">
            Danh mục
        </h3>
        <ul class="category-list">
            <li class="category-item has-sub">
                @foreach($categoriesGlobal ?? [] as $item)
                    <a href="{{ route('get.category.item', $item->slug) }}" class="category-link {{ Request::segment(2) == $item->slug ? 'active' : '' }}" title="{{ $item->name }}">
                        {{ $item->name }}
                    </a>
                @endforeach
            </li>
        </ul>
        <h3 class="category-title">
            Sắp xếp
        </h3>
        <ul class="category-list">
            <li class="category-item has-sub">
                <a href="{{ request()->fullUrlWithQuery(["sort" =>'price,asc']) }}" class="category-link {{ Request::get('sort') == 'price,asc' ? 'active' : '' }}" title="">
                    Giá tăng dần
                </a>
                <a href="{{ request()->fullUrlWithQuery(["sort" =>'price,desc']) }}" class="category-link {{ Request::get('sort') == 'price,desc' ? 'active' : '' }}" title="">
                    Giá giảm dần
                </a>
                <a href="{{ request()->fullUrlWithQuery(["sort" =>'id,desc']) }}" class="category-link {{ Request::get('sort') == 'id,desc' ? 'active' : '' }}" title="">
                    Mới nhất
                </a>
                <a href="{{ request()->fullUrlWithQuery(["sort" =>'id,asc']) }}" class="category-link {{ Request::get('sort') == 'id,asc' ? 'active' : '' }}" title="">
                    Cũ nhất
                </a>
            </li>
        </ul>
    </div>
</div>
