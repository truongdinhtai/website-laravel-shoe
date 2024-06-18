<form method="POST" action="" autocomplete="off" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="exampleInputEmail1">Tên </label>
        <input type="text" name="option_name" required placeholder="Tên" class="form-control" value="{{ old('option_name', $productOption->option_name ?? "") }}">
        @error('option_name')
            <small id="emailHelp" class="form-text text-danger">{{ $errors->first('option_name') }}</small>
        @enderror

    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Nhóm group </label>
        <input type="text" name="group_name" required placeholder="group" class="form-control" value="{{ old('group_name', $productOption->group_name ?? "") }}">
        @error('group_name')
            <small id="emailHelp" class="form-text text-danger">{{ $errors->first('group_name') }}</small>
        @enderror
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Danh mục</label>
        <select name="category_id" class="form-control">
            <option value="">Chọn danh mục</option>
            @foreach($categories ?? [] as $item)
                <option value="{{ $item->id }}" {{ ($productOption->category_id ?? 0) == $item->id ? "selected" : "" }}>{{ $item->name }}</option>
            @endforeach
        </select>
        @error('category_id')
        <small id="emailHelp" class="form-text text-danger">{{ $errors->first('category_id') }}</small>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Lưu dữ liệu</button>
</form>
