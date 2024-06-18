@extends('backend.layouts.app_backend')
@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h2>Thông tin website</h2>
    </div>
    <div class=" mt-3">
        <form method="POST" class="row" action="" autocomplete="off" enctype="multipart/form-data">
            @csrf
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="exampleInputEmail1">Tên</label>
                    <input type="text" name="name" placeholder="Tên" class="form-control" value="{{ old('name', $setting->name ?? "") }}">
                    @error('name')
                    <small id="emailHelp" class="form-text text-danger">{{ $errors->first('name') }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="text" name="email" placeholder="Email" class="form-control" value="{{ old('email', $setting->email ?? "") }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Address</label>
                    <input type="text" name="address" placeholder="Ba Đình - Hà Nội" class="form-control" value="{{ old('address', $setting->address ?? "") }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Số điện thoại</label>
                    <input type="number" name="phone" placeholder="0986..." class="form-control" value="{{ old('phone', $setting->phone ?? "") }}">
                    @error('phone')
                    <small id="emailHelp" class="form-text text-danger">{{ $errors->first('phone') }}</small>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Lưu dữ liệu</button>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="exampleInputEmail1">Mô tả</label>
                    <textarea name="description" id="" class="form-control" cols="30" rows="5">{{ old('description', $setting->description ?? "") }}</textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Logo</label>
                    <input type="file" class="form-control" name="avatar">
                    @if (isset($setting->logo) && $setting->logo)
                        <img src="{{ pare_url_file($setting->logo) }}" style="width: 100px;height: auto; border-radius: 10px; margin-top: 10px" alt="">
                    @endif
                </div>
            </div>
        </form>

    </div>
@stop
