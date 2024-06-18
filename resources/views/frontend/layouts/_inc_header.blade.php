<header class="header">
    <div class="topbar">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-12">
                    <div class="top-bar_left d-lg-block d-flex justify-content-center">
                        <span class="text-white">Hotline: <a class="font-weight-bold" href="tel: {{ $settingGlobal->phone ?? "" }}">{{ $settingGlobal->phone ?? "" }}</a></span>
                        <span class="text-white ml-2 font-weight-normal d-none d-lg-inline-block"><strong>Địa chỉ:</strong> {{ $settingGlobal->address ?? "" }}</span>
                    </div>
                </div>
                <div class="col-md-4 d-none d-lg-block">
                    <div class="top-bar_right text-right">
                        @if (!Auth::check())
                            <a class="font-weight-bold" href="{{ route('get.login') }}"><i class="fa-solid fa-user-large mr-1"></i>Đăng nhập</a>
                            <span class="text-white mx-0">hoặc</span>
                            <a class="font-weight-bold" href="{{ route('get.register') }}">Đăng ký</a>
                        @else
                            <a class="font-weight-bold" href="{{ route('get.order') }}"><i class="fa-solid fa-user-large mr-1"></i>Đơn hàng</a>
                            <span class="text-white mx-0"> \ </span>
                            <a class="font-weight-bold" href="{{ route('get.logout') }}"><i class="fa-solid fa-user-large mr-1"></i>Xin chào {{ Auth::user()->name ?? "" }}</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (Auth::check() && get_data_user('web','status') == 1)
    <div class="" style="position: fixed;top: 0;width: 100%;z-index: 999999">
        <div class="alert alert-danger alert-dismissible" style="text-align: center">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Thông báo!</strong> Tài khoản chưa được kích hoạt, xin vui lòng kích kiểm tra email và hoạt tài khoản
            <p>Nếu bạn chưa nhận được email hãy có thể yêu cầu lại <a href="{{ route('get.resend.verify_account') }}" style="color: #007bff !important;">tại đây</a></p>
        </div>
    </div>
    @endif
    <div class="header-content">
        <div class="container">
            <div class="row">
                <div class="col-2 d-lg-none col-sm-4">
                    <div class="menu-icon-mobile h-100 d-flex align-items-center justify-content-start">
                        <i class="fa-solid fa-bars"></i>
                    </div>
                </div>
                <div class="col-lg-3 col-8 col-sm-4">
                    <div class="header-logo">
                        <a href="/" title="Trang chủ">
                            <img src="{{ pare_url_file($settingGlobal->logo ?? "")}}" alt="logo" class="w-100">
                        </a>
                    </div>
                </div>
                <div class="col-2 d-lg-none  col-sm-4">
                    <div class="icon-cart-mobile h-100 d-flex align-items-center justify-content-end position-relative">
                        <i class="fa-solid fa-bag-shopping"></i>
                        <div class="number-cart position-absolute">1</div>
                    </div>
                </div>

                <div class="col-lg-7 col-12 d-none d-sm-block px-lg-0 px-5 my-lg-0 my-4">
                    <div class="list-policy row h-100 align-items-center d-flex justify-content-between">


                        <div class="item-policy d-flex align-items-center">
                            <img src="/assets/img/policy1.webp" alt="policy1">
                            <div class="item-policy-content d-flex flex-column ml-3">
                                <a href="#" class="item-policy-text font-weight-bold">
                                    FREESHIP 5KM
                                </a>
                                <span class="item-policy-text">Với hóa đơn từ 500k</span>
                            </div>
                        </div>
                        <div class="item-policy d-flex align-items-center">
                            <img src="/assets/img/policy1.webp" alt="policy1">
                            <div class="item-policy-content d-flex flex-column ml-3">
                                <a href="#" class="item-policy-text font-weight-bold">
                                    FREESHIP 5KM
                                </a>
                                <span class="item-policy-text">Với hóa đơn từ 500k</span>
                            </div>
                        </div>
                        <div class="item-policy d-flex align-items-center">
                            <img src="/assets/img/policy1.webp" alt="policy1">
                            <div class="item-policy-content d-flex flex-column ml-3">
                                <a href="#" class="item-policy-text font-weight-bold">
                                    FREESHIP 5KM
                                </a>
                                <span class="item-policy-text">Với hóa đơn từ 500k</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 d-none d-lg-flex align-items-center justify-content-end">
                    <div class="mini-cart d-inline-flex align-items-center justify-content-center position-relative">
                        <span><i class="fa-solid fa-bag-shopping"></i></span>
                        <a href="{{ route('get.shopping.list') }}" class="mx-1">Giỏ hàng</a>
                        <span>({{ \Cart::count() }})</span>
                        @if (\Cart::count() <= 0)
                            <div class="no-cart position-absolute bg-white">
                                <span>Không có sản phẩm nào trong giỏ hàng</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="menu-header d-lg-flex align-items-center justify-content-center d-none">
        <div class="container h-100">
            <div class="row h-100">
                <div class="col-md-12 d-flex align-items-center">
                    <ul class="list-menu d-flex h-100">
                        <li class="item-menu h-100">
                            <a href="{{ route('get.home') }}" title="Trang chủ" class="{{ \Request::route()->getName() == 'get.home' ? 'active' : '' }} link-menu h-100 d-flex align-items-center px-3">Trang chủ</a>
                        </li>
                        <li class="item-menu h-100">
                            <a href="{{ route('get.product') }}" class="{{ \Request::route()->getName() == 'get.product' ? 'active' : '' }} link-menu h-100 d-flex align-items-center px-3">Sản phẩm</a>
                        </li>
                        <li class="item-menu h-100">
                            <a href="{{ route('get.product.wholesale') }}" class="{{ \Request::route()->getName() == 'get.product.wholesale' ? 'active' : '' }} link-menu h-100 d-flex align-items-center px-3">Sản phẩm sỉ</a>
                        </li>
                        <li class="item-menu h-100">
                            <a href="{{ route('get.blog') }}" class="link-menu h-100 d-flex align-items-center px-3">Tin tức</a>
                        </li>
                        <li class="item-menu h-100">
                            <a href="{{ route('get.contact') }}" class="link-menu h-100 d-flex align-items-center px-3">Liên hệ</a>
                        </li>
                    </ul>
                    <div class="menu-search ml-auto">
                        <form action="{{ route('get.product') }}" method="GET">
                            <input placeholder="Tìm sản phẩm" name="k" value="{{ Request::get('k') }}" type="text" class="input-menu-search">
                            <button style="background: none;outline: none;border: none" type="submit" class="icon-menu-search"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="menu-mobile d-block d-lg-none">
        <div class="menu-mobile-head position-relative">
            <ul class="mobile-list-inline">
                <li>
                    <a href="/account/login"><i class="fa fa-user"></i> Đăng nhập</a>
                </li>
                <li><span>hoặc</span></li>
                <li><a href="/account/register">Đăng ký</a>
                </li>
                <li class="menu-mobile-search">
                    <div class="header_search search_form">
                        <form class="input-group search-bar search_form" action="/">
                            <input type="search" name="query" value="" placeholder="Tìm sản phẩm" class="input-group-field st-default-search-input search-text" autocomplete="off">
                            <span class="input-group-btn">
                                    <button class="btn icon-fallback-text">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                        </form>
                    </div>

                </li>
            </ul>
            <div class="menuclose"><i class="fa fa-times"></i></div>
        </div>
        <nav class="nav-menu-mobile">
            <p class="title">Menu</p>
            <ul class="nav-mb-list">
                <li class="nav-mb-item ">
                    <a href="#" class="nav-mobile-link position-relative">Tất cả sản phẩm
                        <span class="icon-sub-nav position-absolute">
                            <i class="fa-solid fa-angle-right">

                            </i></span>
                    </a>
                </li>
                <li class="nav-mb-item has-sub-nav">
                    <a href="#" class="nav-mobile-link position-relative">Tất cả sản phẩm
                        <span class="icon-sub-nav position-absolute">
                            <i class="fa-solid fa-angle-right">

                            </i></span>
                    </a>

                    <ul class="nav-mb-sub-list">
                        <li class="nav-mb-sub-item">
                            <a href="#" class="nav-mobile-link">Bánh tráng</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-mb-item ">
                    <a href="#" class="nav-mobile-link position-relative">Tất cả sản phẩm
                        <span class="icon-sub-nav position-absolute">
                            <i class="fa-solid fa-angle-right">

                            </i></span>
                    </a>
                </li>
                <li class="nav-mb-item has-sub-nav">
                    <a href="#" class="nav-mobile-link position-relative">Tất cả sản phẩm
                        <span class="icon-sub-nav position-absolute">
                            <i class="fa-solid fa-angle-right">

                            </i></span>
                    </a>

                    <ul class="nav-mb-sub-list">
                        <li class="nav-mb-sub-item">
                            <a href="#" class="nav-mobile-link">Bánh tráng</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</header>
