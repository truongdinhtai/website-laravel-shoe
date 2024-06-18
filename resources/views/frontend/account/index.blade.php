@extends('frontend.layouts.master')
@section('title_page','Thông tin tài khoản')
@section('content')
    <div class="breadcrumb-wrapper mt-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcumb">
                        <a href="{{ route('get.account') }}" title="Tài khoản" style="color: #007bff">Tài khoản</a>
                        <span class="breadcumb-icon mx-1"><i class="fa-solid fa-angles-right"></i></span>
                        <span>Thông tin</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <form method="POST" action="" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="text" disabled name="email" placeholder="Email" class="form-control" value="{{ old('email', $user->email ?? "") }}">
                        @error('email')
                        <small id="emailHelp" class="form-text text-danger">{{ $errors->first('email') }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" name="name" placeholder="Name" class="form-control" value="{{ old('name', $user->name ?? "") }}">
                        @error('name')
                        <small id="emailHelp" class="form-text text-danger">{{ $errors->first('name') }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Birthday</label>
                        <input type="date" name="birthday" placeholder="birthday" class="form-control" value="{{ old('birthday', $user->birthday ?? "") }}">
                        @error('birthday')
                        <small id="emailHelp" class="form-text text-danger">{{ $errors->first('birthday') }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Phone</label>
                        <input type="number" name="phone" placeholder="09.." class="form-control" value="{{ old('phone', $user->phone ?? "") }}">
                        @error('phone')
                        <small id="emailHelp" class="form-text text-danger">{{ $errors->first('phone') }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Avatar</label>
                        <input type="file" name="avatar" class="form-control">
                        @if (isset($user->avatar) && $user->avatar)
                            <img src="{{ pare_url_file($user->avatar) }}" style="width: 60px;height: 60px; border-radius: 10px; margin-top: 10px" alt="">
                        @endif
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Cập nhật thông tin</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
