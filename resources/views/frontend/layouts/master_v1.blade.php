<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/bootstrap-4.0.0-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/fontawesome-free-6.4.0-web/css/all.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="/assets/css/OwlCarousel2-2.3.4/dist/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="/assets/css/responsive.css">

    <title>@yield('title_page','Đồ án')</title>

</head>
<body>
@include('frontend.layouts._inc_header')
@yield('content')
@include('frontend.layouts._inc_footer')
<div class="copyright">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="copyright-item">
                    <span>© Bản quyền thuộc về {{ $settingGlobal->name ?? "Đồ án" }}</span>
                </div>
            </div>
            <div class="col-md-6 d-none d-lg-block">
                <div class="copyright-menu">
                    <ul>
                        <li>
                            <a href="{{ route('get.product') }}">Tìm kiếm</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/assets/js/jquery.min.js"></script>
<script src="/assets/css/OwlCarousel2-2.3.4/dist/owl.carousel.min.js"></script>
<script src="/assets/js/main.js"></script>
<!-- Messenger Plugin chat Code -->
<div id="fb-root"></div>

<!-- Your Plugin chat code -->
<div id="fb-customer-chat" class="fb-customerchat">
</div>

<script>
  var chatbox = document.getElementById('fb-customer-chat');
  chatbox.setAttribute("page_id", "102008512678631");
  chatbox.setAttribute("attribution", "biz_inbox");
</script>

<!-- Your SDK code -->
<script>
  window.fbAsyncInit = function() {
    FB.init({
      xfbml            : true,
      version          : 'v17.0'
    });
  };

  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
</script>
@yield('script')
</body>
</html>
