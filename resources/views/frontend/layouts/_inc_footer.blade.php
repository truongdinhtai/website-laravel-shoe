<footer class="wrapper-footer mt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="item-footer-wrraper">
                    <div class="title-footer">
                        LIÊN HỆ
                    </div>
                    <ul class="list-footer">
                        <li class="item-footer">
                            <span>{{ $settingGlobal->name ?? "Đồ án" }}</span>
                        </li>
                        <li class="item-footer">
                            <i class="fa-solid fa-location-pin"></i>
                            <span>{{ $settingGlobal->description ?? "Đồ án" }}</span>
                        </li>
                        <li class="item-footer">
                            <i class="fa-solid fa-location-pin"></i>
                            <span>
                                    <a href="#" class="link-footer">{{ $settingGlobal->phone ?? "123.456.789" }}</a>
                                    Thứ 2 - Chủ nhật: 8:00 - 22:00
                                </span>
                        </li>
                        <li class="item-footer">
                            <i class="fa-solid fa-location-pin"></i>
                            <a href="#" class="link-footer">{{ $settingGlobal->email ?? "doantotnghiep@gmail.com" }}</a>
                        </li>
                    </ul>
                    <div class="icon-footer-plus d-block d-sm-none">
                        <span><i class="fa-solid fa-plus"></i></span>
                    </div>
                    <div class="icon-footer-minus d-block d-sm-none">
                        <span><i class="fa-solid fa-minus"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="item-footer-wrraper">
                    <div class="title-footer">
                        danh mục
                    </div>
                    <ul class="list-footer">
                        @foreach($categoriesGlobal ?? [] as $item)
                            <li class="item-footer align-items-center">
                                <a href="{{ route('get.category.item', $item->slug) }}" title="{{ $item->name }}" class="link-footer">
                                    {{ $item->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="icon-footer-plus d-block d-sm-none">
                        <span><i class="fa-solid fa-plus"></i></span>
                    </div>
                    <div class="icon-footer-minus d-block d-sm-none">
                        <span><i class="fa-solid fa-minus"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="item-footer-wrraper">
                    <div class="title-footer">
                        Về chúng tôi
                    </div>
                    <ul class="list-footer">
                        <li class="item-footer align-items-center">
                            <a href="{{ route('get.about') }}" title="Giới thiệu" class="link-footer">Giới thiệu</a>
                        </li>
                        <li class="item-footer align-items-center">
                            <a href="{{ route('get.policy') }}" title="Chính sách bảo hành" class="link-footer">Chính sách bảo hành</a>
                        </li>
                    </ul>
                    <div class="icon-footer-plus d-block d-sm-none">
                        <span><i class="fa-solid fa-plus"></i></span>
                    </div>
                    <div class="icon-footer-minus d-block d-sm-none">
                        <span><i class="fa-solid fa-minus"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="item-footer-wrraper">
                    <div class="title-footer">Kết nối với chúng tôi</div>
                    <ul class="list-footer">
                        @foreach($categoriesGlobal ?? [] as $item)
                            <li class="item-footer align-items-center">
                                <a href="{{ route('get.category.item', $item->slug) }}" title="{{ $item->name }}" class="link-footer">
                                    {{ $item->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="icon-footer-plus d-block d-sm-none">
                        <span><i class="fa-solid fa-plus"></i></span>
                    </div>
                    <div class="icon-footer-minus d-block d-sm-none">
                        <span><i class="fa-solid fa-minus"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
