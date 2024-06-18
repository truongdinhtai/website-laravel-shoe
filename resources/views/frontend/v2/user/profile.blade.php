@extends('frontend.layouts.master')
@section('title_page','Thông tin cá nhân')
@section('content')
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('get.home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Thông tin cá nhân</li>
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
                                <a class="nav-link active"  href="{{ route('get.account') }}" >Thông tin cá nhân</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"  href="{{ route('get_user.profile.update_password') }}" >Đổi mật khẩu</a>
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
                                    <label>Họ tên *</label>
                                    <input type="text" name="name" class="form-control" value="{{ $user->name }}" required="">

                                    <label>Email *</label>
                                    <input type="email" name="email" class="form-control" value="{{ $user->email }}" required="">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Ngày sinh *</label>
                                            <input type="date" name="birthday" placeholder="birthday" class="form-control" value="{{ old('birthday', $user->birthday ?? "") }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label>SĐT *</label>
                                            <input type="number" name="phone" class="form-control" value="{{ $user->phone }}" required="">
                                        </div>
                                    </div>
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