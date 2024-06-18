<form method="POST" action="" autocomplete="off" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="exampleInputEmail1">Tên </label>
        <input type="text" name="name" placeholder="Tên" class="form-control" value="{{ old('name', $tag->name ?? "") }}">
        @error('name')
            <small id="emailHelp" class="form-text text-danger">{{ $errors->first('name') }}</small>
        @enderror

    </div>
    <button type="submit" class="btn btn-primary">Lưu dữ liệu</button>
</form>
