
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>CMS - Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- App favicon -->
    <link rel="shortcut icon" href="/theme_admin_v2/images/favicon.ico">

    <!-- App css -->
    <link href="/theme_admin_v2/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="/theme_admin_v2/css/app.min.css" rel="stylesheet" type="text/css" id="light-style" />
    <link href="/theme_admin_v2/css/app-dark.min.css" rel="stylesheet" type="text/css" id="dark-style" />

</head>

<body class="loading authentication-bg" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
<div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xxl-4 col-lg-5">
                <div class="card">

                    <!-- Logo -->
                    <div class="card-header pt-4 pb-4 text-center bg-primary">
                        <a href="{{ route('get.home') }}">
                            <span><img src="/theme_admin_v2/images/logo.png" alt="" height="18"></span>
                        </a>
                    </div>

                    <div class="card-body p-4">

                        <div class="text-center w-75 m-auto">
                            <h4 class="text-dark-50 text-center pb-0 fw-bold">Đăng nhập</h4>
                            <p class="text-muted mb-4">Điền đầy đủ thông tin email, password của bạn</p>
                        </div>

                        <form action="" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="emailaddress" class="form-label">Email address</label>
                                <input class="form-control" type="email" id="emailaddress" required="" name="email" placeholder="Enter your email">
                            </div>

                            <div class="mb-3">
{{--                                <a href="pages-recoverpw.html" class="text-muted float-end"><small>Forgot your password?</small></a>--}}
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password">
                                    <div class="input-group-text" data-password="false">
                                        <span class="password-eye"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 mb-0 text-center">
                                <button class="btn btn-primary" type="submit"> Đăng nhập </button>
                            </div>

                        </form>
                    </div> <!-- end card-body -->
                </div>
            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
<!-- end page -->

<footer class="footer footer-alt">
    {{ date('Y') }} © doan
</footer>

<!-- bundle -->
<script src="/theme_admin_v2/js/vendor.min.js"></script>
<script src="/theme_admin_v2/js/app.min.js"></script>

</body>
</html>
