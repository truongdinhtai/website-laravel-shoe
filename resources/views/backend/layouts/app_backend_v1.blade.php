<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>CMS - {{ date('Y') }}</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/dashboard/">
    <!-- Bootstrap core CSS -->
    <link href="{{asset('theme_admin/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{asset('theme_admin/css/dashboard.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .nav-tab-profile .nav-item.active {
            border-bottom:  1px solid #dedede;
        }
        .select2-container--default .select2-selection--single {
            height: 48px !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 48px !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 48px !important;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="">Hi - {{ Auth::user()->name ?? "" }}</a>
    <a class="navbar-brand mr-0" style="padding-left: 5px;padding-right: 5px" href="/" target="_blank">Về trang web</a>
    <input class="form-control form-control-dark w-80" type="text" placeholder="Search" aria-label="Search">
    <div class="dropdown" style="margin-right: 10px;">
        <button class="btn dropdown-toggle" style="background: none;color: white" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="{{ pare_url_file(Auth::user()->avatar) }}" onerror="this.src='/images/preloader.gif';" style="width: 40px;height: 40px;border-radius: 50%" alt="">
        </button>
        <div class="dropdown-menu" style="left: unset;right: 10px" aria-labelledby="dropdownMenu2">
            <a href="{{ route('get_admin.profile.index') }}" class="dropdown-item" title="Cập nhật thông tin">Cập nhật thông tin</a>
            <a href="{{ route('get_admin.logout') }}" title="Đăng xuất" class="dropdown-item">Đăng xuất</a>
        </div>
    </div>
</nav>
<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    @foreach(config('nav') as $item)
                        <li class="nav-item">
                            <a class="nav-link {{  in_array(Request::segment(2), $item['prefix']) ? 'active' : '' }}" href="{{ route($item['route']) }}" title="{{ $item['name'] }}">
                                <span data-feather="{{ $item['icon'] }}"></span>
                                {{ $item['name'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>-----------</span>
                </h6>
            </div>
        </nav>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
            @yield('content')
        </main>
    </div>
</div>
<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
{{--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>--}}
<script src="https://code.jquery.com/jquery-3.1.1.min.js">
<script src="{{ asset('theme_admin/js/popper.min.js') }}"></script>
<script src="{{ asset('theme_admin/js/bootstrap.min.js') }}"></script>
<!-- Icons -->
<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
<script>
    feather.replace();

    $(function (){
        $("#loadDistrict").change(function (){
            let province_id = $(this).find(":selected").val();

            $.ajax({
                url: "/admin/location/district",
                data: {
                    province_id: province_id
                },
                beforeSend: function( xhr ) {
                    // xhr.overrideMimeType( "text/plain; charset=x-user-defined" );
                }
            }).done(function( data ) {

                let dataOptions = `<option value="">Chọn quận huyện</option>`;
                data.map( function (index, key) {
                    dataOptions += `<option value=${index.id}>${index.name}</option>`
                });

                $("#districtsData").html(dataOptions);
            });
        })

        $("#districtsData").change(function (){
            let district_id = $(this).find(":selected").val();
            $.ajax({
                url: "/admin/location/ward",
                data: {
                    district_id: district_id
                },
                beforeSend: function( xhr ) {
                    // xhr.overrideMimeType( "text/plain; charset=x-user-defined" );
                }
            }).done(function( data ) {
                console.log('---- data: ', data);

                let dataOptions = `<option value="">Chọn phường xã</option>`;
                data.map( function (index, key) {
                    dataOptions += `<option value=${index.id}>${index.name}</option>`
                });

                $("#wardData").html(dataOptions);
            });
        })
    })
</script>
<!-- Graphs -->
{{--<script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.1/dist/Chart.min.js"></script>--}}
@yield('script')
</body>
</html>
