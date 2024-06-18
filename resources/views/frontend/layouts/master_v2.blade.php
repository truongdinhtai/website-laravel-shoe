
<!DOCTYPE html>
<html lang="en">


<!-- molla/index-4.html  22 Nov 2019 09:53:08 GMT -->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title_page','Đồ án')</title>
    <meta name="keywords" content="HTML5 Template">
    <meta name="description" content="Molla - Bootstrap eCommerce Template">
    <meta name="author" content="p-themes">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="/fe_v2/assets/images/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/fe_v2/assets/images/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/fe_v2/assets/images/icons/favicon-16x16.png">
    <link rel="manifest" href="/fe_v2/assets/images/icons/site.html">
    <link rel="mask-icon" href="/fe_v2/assets/images/icons/safari-pinned-tab.svg" color="#666666">
    <link rel="shortcut icon" href="/fe_v2/assets/images/icons/favicon.ico">
    <meta name="apple-mobile-web-app-title" content="Molla">
    <meta name="application-name" content="Molla">
    <meta name="msapplication-TileColor" content="#cc9966">
    <meta name="msapplication-config" content="/fe_v2/assets/images/icons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="/fe_v2/assets/vendor/line-awesome/line-awesome/line-awesome/css/line-awesome.min.css">
    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="/fe_v2/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/fe_v2/assets/css/plugins/owl-carousel/owl.carousel.css">
    <link rel="stylesheet" href="/fe_v2/assets/css/plugins/magnific-popup/magnific-popup.css">
    <link rel="stylesheet" href="/fe_v2/assets/css/plugins/jquery.countdown.css">
    <!-- Main CSS File -->
    <link rel="stylesheet" href="/fe_v2/assets/css/style.css">
    <link rel="stylesheet" href="/fe_v2/assets/css/skins/skin-demo-4.css">
    <link rel="stylesheet" href="/fe_v2/assets/css/demos/demo-4.css">
    <style>
        .product-title a {
            display: -webkit-box;
            overflow: hidden;
            text-overflow: ellipsis;
            max-height: 44px;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
            margin: 10px 0;
        }
        .filter-colors a:hover,.filter-colors a:focus{
            /*border: none;*/
            box-shadow:none;
        }
        .btn-cart:hover span {
            color: white;
        }
        .product-image {
            height: 270px;
            object-fit: cover;
        }
        .cat-block img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
        }
    </style>
</head>

<body>
<div class="page-wrapper">
    <header class="header header-intro-clearance header-4">
        <div class="header-top">
            <div class="container">
                <div class="header-left">
                    <a href="tel:#{{ $settingGlobal->phone ?? "0986420994" }}"><i class="icon-phone"></i>Call: {{ $settingGlobal->phone ?? "0986420994" }}</a>
                </div><!-- End .header-left -->

                <div class="header-right">

                    <ul class="top-menu">
                        <li style="padding:10px 5px">
                            <ul>
                                @if (!Auth::check())
                                    <li><a href="#signin-modal" data-toggle="modal">Đăng ký Or Đăng nhập</a></li>
                                @else
                                    <li><a href="" >Xin chào {{ Auth::user()->name ?? "" }}</a></li>
                                    <li><a href="{{ route('get.account') }}">Quản lý tài khoản</a></li>
                                    <li><a href="{{ route('get.order') }}">Quản lý đơn hàng</a></li>
                                    <li><a href="{{ route('get.logout') }}">Đăng xuất</a></li>
                                @endif
                            </ul>
                        </li>
                    </ul><!-- End .top-menu -->
                </div><!-- End .header-right -->

            </div><!-- End .container -->
        </div><!-- End .header-top -->

        <div class="header-middle">
            <div class="container">
                <div class="header-left">
                    <button class="mobile-menu-toggler">
                        <span class="sr-only">Toggle mobile menu</span>
                        <i class="icon-bars"></i>
                    </button>

                    <a href="{{ route('get.home') }}" class="logo">
                        <img src="{{ pare_url_file($settingGlobal->logo ?? "")}}" alt="Molla Logo" width="105" height="25">
                    </a>
                </div><!-- End .header-left -->

                <div class="header-center">
                    <div class="header-search header-search-extended header-search-visible d-none d-lg-block">
                        <a href="{{ route('get.product') }}" class="search-toggle" role="button"><i class="icon-search"></i></a>
                        <form action="{{ route('get.product') }}" method="get">
                            <div class="header-search-wrapper search-wrapper-wide">
                                <label for="k" class="sr-only">Search</label>
                                <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
                                <input type="search" class="form-control" name="k" id="k" value="{{ Request::get('k') }}" placeholder="Search product ..." required>
                            </div><!-- End .header-search-wrapper -->
                        </form>
                    </div><!-- End .header-search -->
                </div>

                <div class="header-right">
                    <div class="dropdown cart-dropdown">
                        <a href="{{ route('get.shopping.list') }}" class="dropdown-toggle" role="button">
                            <div class="icon">
                                <i class="icon-shopping-cart"></i>
                                <span class="cart-count">{{ \Cart::count() }}</span>
                            </div>
                            <p>Cart</p>
                        </a>
                    </div><!-- End .cart-dropdown -->
                </div><!-- End .header-right -->
            </div><!-- End .container -->
        </div><!-- End .header-middle -->

        <div class="header-bottom sticky-header">
            <div class="container">
                <div class="header-left">
                    <div class="dropdown category-dropdown">
                        <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static" title="Browse Categories">
                            Danh mục <i class="icon-angle-down"></i>
                        </a>

                        <div class="dropdown-menu">
                            <nav class="side-nav">
                                <ul class="menu-vertical sf-arrows">
                                    @foreach($categoriesGlobal ?? [] as $item)
                                        <li class="item-lead"><a href="{{ route('get.category.item', $item->slug) }}">{{ $item->name }}</a></li>
                                    @endforeach
                                </ul><!-- End .menu-vertical -->
                            </nav><!-- End .side-nav -->
                        </div><!-- End .dropdown-menu -->
                    </div><!-- End .category-dropdown -->
                </div><!-- End .header-left -->

                <div class="header-center">
                    <nav class="main-nav">
                        <ul class="menu sf-arrows">
                            <li class="megamenu-container {{ \Request::route()->getName() == 'get.home' ? 'active' : '' }}">
                                <a href="{{ route('get.home') }}">Trang chủ</a>
                            </li>
                            <li class="megamenu-container {{ \Request::route()->getName() == 'get.product' ? 'active' : '' }}">
                                <a href="{{ route('get.product') }}">Sản phẩm</a>
                            </li>
                        </ul><!-- End .menu -->
                    </nav><!-- End .main-nav -->
                </div><!-- End .header-center -->

                <div class="header-right">
                    <i class="la la-lightbulb-o"></i><p>Clearance<span class="highlight">&nbsp;Up to 30% Off</span></p>
                </div>
            </div><!-- End .container -->
        </div><!-- End .header-bottom -->
    </header><!-- End .header -->

    <main class="main">
        @yield('content')
    </main><!-- End .main -->

    <footer class="footer">
        <div class="cta bg-image bg-dark pt-4 pb-5 mb-0" style="background-image: url({{ pare_url_file($bgFooter->avatar ?? '') }});">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-sm-10 col-md-8 col-lg-6">
                        <div class="cta-heading text-center">
                            <h3 class="cta-title text-white">Get The Latest Deals</h3><!-- End .cta-title -->
                            <p class="cta-desc text-white">and receive <span class="font-weight-normal">$20 coupon</span> for first shopping</p><!-- End .cta-desc -->
                        </div><!-- End .text-center -->

                        <form action="#">
                            <div class="input-group input-group-round">
                                <input type="email" class="form-control form-control-white" placeholder="Enter your Email Address" aria-label="Email Adress" required>
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><span>Subscribe</span><i class="icon-long-arrow-right"></i></button>
                                </div><!-- .End .input-group-append -->
                            </div><!-- .End .input-group -->
                        </form>
                    </div><!-- End .col-sm-10 col-md-8 col-lg-6 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .cta -->
        <div class="footer-middle">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-lg-3">
                        <div class="widget widget-about">
                            <img src="{{ pare_url_file($settingGlobal->logo ?? '') }}" class="footer-logo" alt="Footer Logo" width="105" height="25">
                            <p>Praesent dapibus, neque id cursus ucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. </p>

                            <div class="widget-call">
                                <i class="icon-phone"></i>
                                Got Question? Call us 24/7
                                <a href="tel:#{{ $settingGlobal->phone ?? "0986420994" }}">+{{ $settingGlobal->phone ?? "0986420994" }}</a>
                            </div><!-- End .widget-call -->
                        </div><!-- End .widget about-widget -->
                    </div><!-- End .col-sm-6 col-lg-3 -->

                    <div class="col-sm-6 col-lg-3">
                        <div class="widget">
                            <h4 class="widget-title">Useful Links</h4><!-- End .widget-title -->

                            <ul class="widget-list">
                                <li><a href="about.html">About Molla</a></li>
                                <li><a href="#">Our Services</a></li>
                                <li><a href="#">How to shop on Molla</a></li>
                                <li><a href="faq.html">FAQ</a></li>
                                <li><a href="contact.html">Contact us</a></li>
                            </ul><!-- End .widget-list -->
                        </div><!-- End .widget -->
                    </div><!-- End .col-sm-6 col-lg-3 -->

                    <div class="col-sm-6 col-lg-3">
                        <div class="widget">
                            <h4 class="widget-title">Customer Service</h4><!-- End .widget-title -->

                            <ul class="widget-list">
                                <li><a href="#">Payment Methods</a></li>
                                <li><a href="#">Money-back guarantee!</a></li>
                                <li><a href="#">Returns</a></li>
                                <li><a href="#">Shipping</a></li>
                                <li><a href="#">Terms and conditions</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                            </ul><!-- End .widget-list -->
                        </div><!-- End .widget -->
                    </div><!-- End .col-sm-6 col-lg-3 -->

                    <div class="col-sm-6 col-lg-3">
                        <div class="widget">
                            <h4 class="widget-title">My Account</h4><!-- End .widget-title -->

                            <ul class="widget-list">
                                <li><a href="#">Sign In</a></li>
                                <li><a href="cart.html">View Cart</a></li>
                                <li><a href="#">My Wishlist</a></li>
                                <li><a href="#">Track My Order</a></li>
                                <li><a href="#">Help</a></li>
                            </ul><!-- End .widget-list -->
                        </div><!-- End .widget -->
                    </div><!-- End .col-sm-6 col-lg-3 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .footer-middle -->

        <div class="footer-bottom">
            <div class="container">
                <p class="footer-copyright">Copyright © {{ date('Y') }} Đồ án. All Rights Reserved.</p><!-- End .footer-copyright -->
                <figure class="footer-payments">
                    <img src="/fe_v2/assets/images/payments.png" alt="Payment methods" width="272" height="20">
                </figure><!-- End .footer-payments -->
            </div><!-- End .container -->
        </div><!-- End .footer-bottom -->
    </footer><!-- End .footer -->
</div><!-- End .page-wrapper -->
<button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>

<!-- Mobile Menu -->
<div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->

<div class="mobile-menu-container mobile-menu-light">
    <div class="mobile-menu-wrapper">
        <span class="mobile-menu-close"><i class="icon-close"></i></span>

        <form action="#" method="get" class="mobile-search">
            <label for="mobile-search" class="sr-only">Search</label>
            <input type="search" class="form-control" name="mobile-search" id="mobile-search" placeholder="Search in..." required>
            <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
        </form>

        <ul class="nav nav-pills-mobile nav-border-anim" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="mobile-menu-link" data-toggle="tab" href="#mobile-menu-tab" role="tab" aria-controls="mobile-menu-tab" aria-selected="true">Menu</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="mobile-cats-link" data-toggle="tab" href="#mobile-cats-tab" role="tab" aria-controls="mobile-cats-tab" aria-selected="false">Categories</a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade show active" id="mobile-menu-tab" role="tabpanel" aria-labelledby="mobile-menu-link">
                <nav class="mobile-nav">
                    <ul class="mobile-menu">
                        <li class="active">
                            <a href="index.html">Home</a>

                            <ul>
                                <li><a href="index-1.html">01 - furniture store</a></li>
                                <li><a href="index-2.html">02 - furniture store</a></li>
                                <li><a href="index-3.html">03 - electronic store</a></li>
                                <li><a href="index-4.html">04 - electronic store</a></li>
                                <li><a href="index-5.html">05 - fashion store</a></li>
                                <li><a href="index-6.html">06 - fashion store</a></li>
                                <li><a href="index-7.html">07 - fashion store</a></li>
                                <li><a href="index-8.html">08 - fashion store</a></li>
                                <li><a href="index-9.html">09 - fashion store</a></li>
                                <li><a href="index-10.html">10 - shoes store</a></li>
                                <li><a href="index-11.html">11 - furniture simple store</a></li>
                                <li><a href="index-12.html">12 - fashion simple store</a></li>
                                <li><a href="index-13.html">13 - market</a></li>
                                <li><a href="index-14.html">14 - market fullwidth</a></li>
                                <li><a href="index-15.html">15 - lookbook 1</a></li>
                                <li><a href="index-16.html">16 - lookbook 2</a></li>
                                <li><a href="index-17.html">17 - fashion store</a></li>
                                <li><a href="index-18.html">18 - fashion store (with sidebar)</a></li>
                                <li><a href="index-19.html">19 - games store</a></li>
                                <li><a href="index-20.html">20 - book store</a></li>
                                <li><a href="index-21.html">21 - sport store</a></li>
                                <li><a href="index-22.html">22 - tools store</a></li>
                                <li><a href="index-23.html">23 - fashion left navigation store</a></li>
                                <li><a href="index-24.html">24 - extreme sport store</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="category.html">Shop</a>
                            <ul>
                                <li><a href="category-list.html">Shop List</a></li>
                                <li><a href="category-2cols.html">Shop Grid 2 Columns</a></li>
                                <li><a href="category.html">Shop Grid 3 Columns</a></li>
                                <li><a href="category-4cols.html">Shop Grid 4 Columns</a></li>
                                <li><a href="category-boxed.html"><span>Shop Boxed No Sidebar<span class="tip tip-hot">Hot</span></span></a></li>
                                <li><a href="category-fullwidth.html">Shop Fullwidth No Sidebar</a></li>
                                <li><a href="product-category-boxed.html">Product Category Boxed</a></li>
                                <li><a href="product-category-fullwidth.html"><span>Product Category Fullwidth<span class="tip tip-new">New</span></span></a></li>
                                <li><a href="cart.html">Cart</a></li>
                                <li><a href="checkout.html">Checkout</a></li>
                                <li><a href="wishlist.html">Wishlist</a></li>
                                <li><a href="#">Lookbook</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="product.html" class="sf-with-ul">Product</a>
                            <ul>
                                <li><a href="product.html">Default</a></li>
                                <li><a href="product-centered.html">Centered</a></li>
                                <li><a href="product-extended.html"><span>Extended Info<span class="tip tip-new">New</span></span></a></li>
                                <li><a href="product-gallery.html">Gallery</a></li>
                                <li><a href="product-sticky.html">Sticky Info</a></li>
                                <li><a href="product-sidebar.html">Boxed With Sidebar</a></li>
                                <li><a href="product-fullwidth.html">Full Width</a></li>
                                <li><a href="product-masonry.html">Masonry Sticky Info</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">Pages</a>
                            <ul>
                                <li>
                                    <a href="about.html">About</a>

                                    <ul>
                                        <li><a href="about.html">About 01</a></li>
                                        <li><a href="about-2.html">About 02</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="contact.html">Contact</a>

                                    <ul>
                                        <li><a href="contact.html">Contact 01</a></li>
                                        <li><a href="contact-2.html">Contact 02</a></li>
                                    </ul>
                                </li>
                                <li><a href="login.html">Login</a></li>
                                <li><a href="faq.html">FAQs</a></li>
                                <li><a href="404.html">Error 404</a></li>
                                <li><a href="coming-soon.html">Coming Soon</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="blog.html">Blog</a>

                            <ul>
                                <li><a href="blog.html">Classic</a></li>
                                <li><a href="blog-listing.html">Listing</a></li>
                                <li>
                                    <a href="#">Grid</a>
                                    <ul>
                                        <li><a href="blog-grid-2cols.html">Grid 2 columns</a></li>
                                        <li><a href="blog-grid-3cols.html">Grid 3 columns</a></li>
                                        <li><a href="blog-grid-4cols.html">Grid 4 columns</a></li>
                                        <li><a href="blog-grid-sidebar.html">Grid sidebar</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Masonry</a>
                                    <ul>
                                        <li><a href="blog-masonry-2cols.html">Masonry 2 columns</a></li>
                                        <li><a href="blog-masonry-3cols.html">Masonry 3 columns</a></li>
                                        <li><a href="blog-masonry-4cols.html">Masonry 4 columns</a></li>
                                        <li><a href="blog-masonry-sidebar.html">Masonry sidebar</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Mask</a>
                                    <ul>
                                        <li><a href="blog-mask-grid.html">Blog mask grid</a></li>
                                        <li><a href="blog-mask-masonry.html">Blog mask masonry</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Single Post</a>
                                    <ul>
                                        <li><a href="single.html">Default with sidebar</a></li>
                                        <li><a href="single-fullwidth.html">Fullwidth no sidebar</a></li>
                                        <li><a href="single-fullwidth-sidebar.html">Fullwidth with sidebar</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="elements-list.html">Elements</a>
                            <ul>
                                <li><a href="elements-products.html">Products</a></li>
                                <li><a href="elements-typography.html">Typography</a></li>
                                <li><a href="elements-titles.html">Titles</a></li>
                                <li><a href="elements-banners.html">Banners</a></li>
                                <li><a href="elements-product-category.html">Product Category</a></li>
                                <li><a href="elements-video-banners.html">Video Banners</a></li>
                                <li><a href="elements-buttons.html">Buttons</a></li>
                                <li><a href="elements-accordions.html">Accordions</a></li>
                                <li><a href="elements-tabs.html">Tabs</a></li>
                                <li><a href="elements-testimonials.html">Testimonials</a></li>
                                <li><a href="elements-blog-posts.html">Blog Posts</a></li>
                                <li><a href="elements-portfolio.html">Portfolio</a></li>
                                <li><a href="elements-cta.html">Call to Action</a></li>
                                <li><a href="elements-icon-boxes.html">Icon Boxes</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav><!-- End .mobile-nav -->
            </div><!-- .End .tab-pane -->
            <div class="tab-pane fade" id="mobile-cats-tab" role="tabpanel" aria-labelledby="mobile-cats-link">
                <nav class="mobile-cats-nav">
                    <ul class="mobile-cats-menu">
                        <li><a class="mobile-cats-lead" href="#">Daily offers</a></li>
                        <li><a class="mobile-cats-lead" href="#">Gift Ideas</a></li>
                        <li><a href="#">Beds</a></li>
                        <li><a href="#">Lighting</a></li>
                        <li><a href="#">Sofas & Sleeper sofas</a></li>
                        <li><a href="#">Storage</a></li>
                        <li><a href="#">Armchairs & Chaises</a></li>
                        <li><a href="#">Decoration </a></li>
                        <li><a href="#">Kitchen Cabinets</a></li>
                        <li><a href="#">Coffee & Tables</a></li>
                        <li><a href="#">Outdoor Furniture </a></li>
                    </ul><!-- End .mobile-cats-menu -->
                </nav><!-- End .mobile-cats-nav -->
            </div><!-- .End .tab-pane -->
        </div><!-- End .tab-content -->

        <div class="social-icons">
            <a href="#" class="social-icon" target="_blank" title="Facebook"><i class="icon-facebook-f"></i></a>
            <a href="#" class="social-icon" target="_blank" title="Twitter"><i class="icon-twitter"></i></a>
            <a href="#" class="social-icon" target="_blank" title="Instagram"><i class="icon-instagram"></i></a>
            <a href="#" class="social-icon" target="_blank" title="Youtube"><i class="icon-youtube"></i></a>
        </div><!-- End .social-icons -->
    </div><!-- End .mobile-menu-wrapper -->
</div><!-- End .mobile-menu-container -->

<!-- Sign in / Register Modal -->
<div class="modal fade" id="signin-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="icon-close"></i></span>
                </button>

                <div class="form-box">
                    <div class="form-tab">
                        <ul class="nav nav-pills nav-fill nav-border-anim" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="signin-tab" data-toggle="tab" href="#signin" role="tab" aria-controls="signin" aria-selected="true">Đăng nhập</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="register-tab" data-toggle="tab" href="#register" role="tab" aria-controls="register" aria-selected="false">Đăng ký</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="tab-content-5">
                            <div class="tab-pane fade show active" id="signin" role="tabpanel" aria-labelledby="signin-tab">
                                <form action="{{ route('post.login') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="singin-email">Email *</label>
                                        <input type="email" class="form-control" id="singin-email" name="email" required>
                                    </div><!-- End .form-group -->

                                    <div class="form-group">
                                        <label for="singin-password">Password *</label>
                                        <input type="password" min="8" class="form-control" id="singin-password" name="password" required>
                                    </div><!-- End .form-group -->

                                    <div class="form-footer">
                                        <button type="submit" class="btn btn-outline-primary-2">
                                            <span>Đăng nhập</span>
                                            <i class="icon-long-arrow-right"></i>
                                        </button>
{{--                                        <a href="#" class="forgot-link">Forgot Your Password?</a>--}}
                                    </div><!-- End .form-footer -->
                                </form>
{{--                                <div class="form-choice">--}}
{{--                                    <p class="text-center">or sign in with</p>--}}
{{--                                    <div class="row">--}}
{{--                                        <div class="col-sm-6">--}}
{{--                                            <a href="#" class="btn btn-login btn-g">--}}
{{--                                                <i class="icon-google"></i>--}}
{{--                                                Login With Google--}}
{{--                                            </a>--}}
{{--                                        </div><!-- End .col-6 -->--}}
{{--                                        <div class="col-sm-6">--}}
{{--                                            <a href="#" class="btn btn-login btn-f">--}}
{{--                                                <i class="icon-facebook-f"></i>--}}
{{--                                                Login With Facebook--}}
{{--                                            </a>--}}
{{--                                        </div><!-- End .col-6 -->--}}
{{--                                    </div><!-- End .row -->--}}
{{--                                </div><!-- End .form-choice -->--}}
                            </div><!-- .End .tab-pane -->
                            <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                                <form action="{{ route('post.register') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="register-email">Name *</label>
                                        <input type="text" class="form-control" id="register-email" name="name" required>
                                    </div><!-- End .form-group -->
                                    <div class="form-group">
                                        <label for="register-email">Email *</label>
                                        <input type="email" class="form-control" id="register-email" name="email" required>
                                    </div><!-- End .form-group -->

                                    <div class="form-group">
                                        <label for="register-password">Password *</label>
                                        <input type="password" class="form-control" id="register-password" name="password" required>
                                    </div><!-- End .form-group -->
                                    <div class="form-group">
                                        <label for="register-password">Phone *</label>
                                        <input type="number" class="form-control" name="phone" required />
                                    </div><!-- End .form-group -->
                                    <div class="form-group">
                                        <label for="register-password">Address *</label>
                                        <input type="text" class="form-control" id="register-password" name="address" required>
                                    </div><!-- End .form-group -->

                                    <div class="form-footer">
                                        <button type="submit" class="btn btn-outline-primary-2">
                                            <span>Đăng ký</span>
                                            <i class="icon-long-arrow-right"></i>
                                        </button>

{{--                                        <div class="custom-control custom-checkbox">--}}
{{--                                            <input type="checkbox" class="custom-control-input" id="register-policy" required>--}}
{{--                                            <label class="custom-control-label" for="register-policy">I agree to the <a href="#">privacy policy</a> *</label>--}}
{{--                                        </div><!-- End .custom-checkbox -->--}}
                                    </div><!-- End .form-footer -->
                                </form>
{{--                                <div class="form-choice">--}}
{{--                                    <p class="text-center">or sign in with</p>--}}
{{--                                    <div class="row">--}}
{{--                                        <div class="col-sm-6">--}}
{{--                                            <a href="#" class="btn btn-login btn-g">--}}
{{--                                                <i class="icon-google"></i>--}}
{{--                                                Login With Google--}}
{{--                                            </a>--}}
{{--                                        </div><!-- End .col-6 -->--}}
{{--                                        <div class="col-sm-6">--}}
{{--                                            <a href="#" class="btn btn-login  btn-f">--}}
{{--                                                <i class="icon-facebook-f"></i>--}}
{{--                                                Login With Facebook--}}
{{--                                            </a>--}}
{{--                                        </div><!-- End .col-6 -->--}}
{{--                                    </div><!-- End .row -->--}}
{{--                                </div><!-- End .form-choice -->--}}
                            </div><!-- .End .tab-pane -->
                        </div><!-- End .tab-content -->
                    </div><!-- End .form-tab -->
                </div><!-- End .form-box -->
            </div><!-- End .modal-body -->
        </div><!-- End .modal-content -->
    </div><!-- End .modal-dialog -->
</div><!-- End .modal -->

{{--<div class="container newsletter-popup-container mfp-hide" id="newsletter-popup-form">--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-10">--}}
{{--            <div class="row no-gutters bg-white newsletter-popup-content">--}}
{{--                <div class="col-xl-3-5col col-lg-7 banner-content-wrap">--}}
{{--                    <div class="banner-content text-center">--}}
{{--                        <img src="/fe_v2/assets/images/popup/newsletter/logo.png" class="logo" alt="logo" width="60" height="15">--}}
{{--                        <h2 class="banner-title">get <span>25<light>%</light></span> off</h2>--}}
{{--                        <p>Subscribe to the Molla eCommerce newsletter to receive timely updates from your favorite products.</p>--}}
{{--                        <form action="#">--}}
{{--                            <div class="input-group input-group-round">--}}
{{--                                <input type="email" class="form-control form-control-white" placeholder="Your Email Address" aria-label="Email Adress" required>--}}
{{--                                <div class="input-group-append">--}}
{{--                                    <button class="btn" type="submit"><span>go</span></button>--}}
{{--                                </div><!-- .End .input-group-append -->--}}
{{--                            </div><!-- .End .input-group -->--}}
{{--                        </form>--}}
{{--                        <div class="custom-control custom-checkbox">--}}
{{--                            <input type="checkbox" class="custom-control-input" id="register-policy-2" required>--}}
{{--                            <label class="custom-control-label" for="register-policy-2">Do not show this popup again</label>--}}
{{--                        </div><!-- End .custom-checkbox -->--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-xl-2-5col col-lg-5 ">--}}
{{--                    <img src="/fe_v2/assets/images/popup/newsletter/img-1.jpg" class="newsletter-img" alt="newsletter">--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
<!-- Plugins JS File -->
<script src="/fe_v2/assets/js/jquery.min.js"></script>
<script src="/fe_v2/assets/js/bootstrap.bundle.min.js"></script>
<script src="/fe_v2/assets/js/jquery.hoverIntent.min.js"></script>
<script src="/fe_v2/assets/js/jquery.waypoints.min.js"></script>
<script src="/fe_v2/assets/js/superfish.min.js"></script>
<script src="/fe_v2/assets/js/owl.carousel.min.js"></script>
<script src="/fe_v2/assets/js/bootstrap-input-spinner.js"></script>
<script src="/fe_v2/assets/js/jquery.plugin.min.js"></script>
<script src="/fe_v2/assets/js/jquery.magnific-popup.min.js"></script>
<script src="/fe_v2/assets/js/jquery.countdown.min.js"></script>
<!-- Main JS File -->
<script src="/fe_v2/assets/js/main.js"></script>
<script src="/fe_v2/assets/js/demos/demo-4.js"></script>
</body>


<!-- molla/index-4.html  22 Nov 2019 09:54:18 GMT -->
</html>