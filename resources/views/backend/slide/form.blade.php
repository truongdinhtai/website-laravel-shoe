<form method="POST" action="" autocomplete="off" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="exampleInputEmail1">Tên</label>
        <input type="text" name="name" placeholder="Tên" class="form-control" value="{{ old('name', $slide->name ?? "") }}">
        @error('name')
            <small id="emailHelp" class="form-text text-danger">{{ $errors->first('name') }}</small>
        @enderror

    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Link</label>
        <input type="text" name="link" placeholder="link" class="form-control" value="{{ old('link', $slide->link ?? "") }}">
        @error('link')
        <small id="emailHelp" class="form-text text-danger">{{ $errors->first('link') }}</small>
        @enderror
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Position</label>
        <select name="type" class="form-control" id="">
            <option value="1" {{ ($slide->type ?? 1) == 1 ? "selected" : "" }}>[Home] Slide trang chủ</option>
            <option value="2" {{ ($slide->type ?? 1) == 2 ? "selected" : "" }}>[Home] dưới nổi bật</option>
            <option value="3" {{ ($slide->type ?? 1) == 3 ? "selected" : "" }}>[Home] Top bán chạy</option>
            <option value="4" {{ ($slide->type ?? 1) == 4 ? "selected" : "" }}>[Home] Sản phẩm mới</option>
            <option value="5" {{ ($slide->type ?? 1) == 5 ? "selected" : "" }}>[Footer]</option>
        </select>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Hình ảnh</label>
        <input type="file" class="form-control" name="avatar">
        @if (isset($slide->avatar) && $slide->avatar)
            <img src="{{ pare_url_file($slide->avatar) }}" style="width: 60px;height: 60px; border-radius: 10px; margin-top: 10px" alt="">
        @endif
    </div>
    <button type="submit" class="btn btn-primary">Lưu dữ liệu</button>
</form>
