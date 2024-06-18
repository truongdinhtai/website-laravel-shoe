@extends('frontend.layouts.master')
@section('title_page','Cập nhật mật khẩu')
@section('content')
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('get.home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Cập nhật mật khẩu</li>
            </ol>
        </div><!-- End .container -->
    </nav>
    <div class="page-content">
        <div class="dashboard">
            <div class="container">
                <div class="row">
                    <aside class="col-md-4 col-lg-3">
                        <ul class="nav nav-dashboard flex-column mb-3 mb-md-0" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link"  href="{{ route('get.account') }}" >Thông tin cá nhân</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active"  href="{{ route('get_user.profile.update_password') }}" >Đổi mật khẩu</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('get.logout') }}">Đăng xuất</a>
                            </li>
                        </ul>
                    </aside><!-- End .col-lg-3 -->

                    <div class="col-md-8 col-lg-9">
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="tab-account" role="tabpanel" aria-labelledby="tab-account-link">
                                <form action="" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Mật khẩu mới</label>
                                        <input type="password" name="password" placeholder="********" class="form-control">
                                        @error('password')
                                        <small id="emailHelp" class="form-text text-danger">{{ $errors->first('password') }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Xác nhận mật khẩu</label>
                                        <input type="password" name="password_confirmation" placeholder="********" class="form-control">
                                        @error('password_confirmation')
                                        <small id="emailHelp" class="form-text text-danger">{{ $errors->first('password_confirmation') }}</small>
                                        @enderror
                                    </div>
{{--                                    --}}
{{--                                    <label>Current password (leave blank to leave unchanged)</label>--}}
{{--                                    <input type="password" class="form-control">--}}

{{--                                    <label>New password (leave blank to leave unchanged)</label>--}}
{{--                                    <input type="password" class="form-control">--}}

{{--                                    <label>Confirm new password</label>--}}
{{--                                    <input type="password" class="form-control mb-2">--}}
                                    <button type="submit" class="btn btn-outline-primary-2">
                                        <span>Cập nhật</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </button>
                                </form>
                            </div><!-- .End .tab-pane -->
                        </div>
                    </div><!-- End .col-lg-9 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .dashboard -->
    </div>
@stop