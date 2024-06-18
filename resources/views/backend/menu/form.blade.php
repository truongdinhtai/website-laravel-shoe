<form method="POST" action="" autocomplete="off" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="exampleInputEmail1">Tên </label>
        <input type="text" name="name" placeholder="Tên" class="form-control" value="{{ old('name', $menu->name ?? "") }}">
        @error('name')
            <small id="emailHelp" class="form-text text-danger">{{ $errors->first('name') }}</small>
        @enderror

    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Mô tả</label>
        <textarea name="description" class="form-control" id="" cols="30" rows="3">{{ old('description', $menu->description ?? "") }}</textarea>
        @error('description')
        <small id="emailHelp" class="form-text text-danger">{{ $errors->first('description') }}</small>
        @enderror
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Hình ảnh</label>
        <input type="file" class="form-control" name="avatar">
        @if (isset($menu->avatar) && $menu->avatar)
            <img src="{{ pare_url_file($menu->avatar) }}" style="width: 60px;height: 60px; border-radius: 10px; margin-top: 10px" alt="">
        @endif
    </div>
    <button type="submit" class="btn btn-primary">Lưu dữ liệu</button>
</form>
