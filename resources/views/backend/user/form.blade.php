<form method="POST" action="" autocomplete="off" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                <label for="exampleInputEmail1">Tên</label>
                <input type="text" name="name" placeholder="Tên" class="form-control" value="{{ old('name', $user->name ?? "") }}">
                @error('name')
                <small id="emailHelp" class="form-text text-danger">{{ $errors->first('name') }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input type="text" name="email" placeholder="Email" class="form-control" value="{{ old('email', $user->email ?? "") }}">
                @error('email')
                <small id="emailHelp" class="form-text text-danger">{{ $errors->first('email') }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Số điện thoại</label>
                <input type="number" name="phone" placeholder="0986..." class="form-control" value="{{ old('phone', $user->phone ?? "") }}">
                @error('phone')
                <small id="emailHelp" class="form-text text-danger">{{ $errors->first('phone') }}</small>
                @enderror
            </div>

            <div class="row">
                @foreach($roles ?? [] as $item)
                    <div class="form-group form-check col-sm-3">
                        <div class="form-group form-check">
                            <label class="form-check-label" style="display: flex;justify-content: space-between" for="exampleCheck1">
                                <span>{{ $item->description }}</span>
                                <input type="checkbox" class="form-check-input" {{ in_array($item->id,$roleActive) ? "checked" : "" }}   value="{{ $item->id }}" name="roles[]">
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
            <button type="submit" class="btn btn-primary">Lưu dữ liệu</button>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="exampleInputEmail1">Trạng thái</label>
                <select name="status" id="" class="form-control">
                    <option value="-1" {{ ($user->status ?? 1) == -1 ? "selected" : "" }}>Tạm dừng</option>
                    <option value="1" {{ ($user->status ?? 1) == 1 ? "selected" : "" }}>Chờ kích hoạt</option>
                    <option value="2" {{ ($user->status ?? 1) == 2 ? "selected" : "" }}>Hoạt động</option>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">User Type</label>
                <select name="user_type" id="" class="form-control">
                    @foreach($usersType ?? [] as $item)
                        <option value="{{ $item->id }}" {{ in_array($item->id, $userHasType) ? "selected" : "" }}>{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group form-check">
                <div class="form-group form-check">
                    <label class="form-check-label" style="display: flex;justify-content: space-between" for="exampleCheck1">
                        <span>Khách sỉ</span>
                        <input type="checkbox" class="form-check-input" {{ ($user->is_wholesale ?? 0) == 1 ? "checked" : "" }}   value="1" name="is_wholesale">
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Hình ảnh</label>
                <input type="file" class="form-control" name="avatar">
                @if (isset($user->avatar) && $user->avatar)
                    <img src="{{ pare_url_file($user->avatar) }}" style="width: 60px;height: 60px; border-radius: 10px; margin-top: 10px" alt="">
                @endif
            </div>
        </div>
    </div>
</form>
