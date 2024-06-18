@extends('frontend.layouts.master')
@section('content')
    <div class="container">
        <h3 class="text-center" style="padding: 20px 0">Thông tin liên hệ</h3>
        <hr>
        <div class="row">
            <div class="col-sm-8">
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d11880.492291371422!2d12.4922309!3d41.8902102!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x28f1c82e908503c4!2sColosseo!5e0!3m2!1sit!2sit!4v1524815927977" width="100%" height="320" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
{{--            {{ dd($settingGlobal) }}--}}
            <div class="col-sm-4" id="contact2">
                <h4 class="pt-2">Thông tin</h4>
                <hr align="left" width="50%">
                <i class="fas fa-globe" style="color:#000"></i> Địa chỉ : {{ $settingGlobal->address ?? "" }}<br>
                <h4 class="pt-2">Số điện thoại</h4>
                <i class="fas fa-phone" style="color:#000"></i> <a href="tel:+" style="color: #007bff"> {{ $settingGlobal->phone ?? "" }} </a><br>
                <h4 class="pt-2">Email</h4>
                <i class="fa fa-envelope" style="color:#000"></i> <a href="" style="color: #007bff">{{ $settingGlobal->email ?? "" }}</a><br>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-7">
                <form method="POST" action="" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="text" name="email" placeholder="Email" class="form-control" value="{{ old('email', $user->email ?? "") }}">
                        @error('email')
                        <small id="emailHelp" class="form-text text-danger">{{ $errors->first('email') }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Password</label>
                        <input type="password" name="password" placeholder="******" class="form-control" value="">
                        @error('password')
                        <small id="emailHelp" class="form-text text-danger">{{ $errors->first('password') }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div style="display: flex; justify-content: space-between">
                            <p>Bạn chưa có tài khoản?  đăng ký <a href="{{ route('get.register') }}" style="color: #007bff"> tại đây</a></p>
                            <p>Quên mật khẩu?  Cấp lại <a href="{{ route('get.restart_password') }}" style="color: #007bff"> tại đây</a></p>
                        </div>
                        <button type="submit" class="btn btn-primary">Đăng nhập</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
