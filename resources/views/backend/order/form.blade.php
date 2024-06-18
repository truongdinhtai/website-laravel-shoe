<form method="POST" action="" autocomplete="off" enctype="multipart/form-data">
    <div class="row">
        <div class="col-sm-8">
            @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">Tên người nhận</label>
                <input type="text" name="receiver_name" placeholder="" class="form-control" value="{{ old('receiver_name', $order->receiver_name ?? "") }}">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">SĐT người nhận</label>
                <input type="text" name="receiver_phone" placeholder="" class="form-control" value="{{ old('receiver_phone', $order->receiver_phone ?? "") }}">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email người nhận</label>
                <input type="text" name="receiver_email" placeholder="" class="form-control" value="{{ old('receiver_email', $order->receiver_email ?? "") }}">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Ghi chú</label>
                <textarea name="note" class="form-control" id="" cols="30" rows="3">{{ old('note', $order->note ?? "") }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Lưu dữ liệu</button>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="exampleInputEmail1">Trạng thái thanh toán</label>
                <select name="status" id="" class="form-control">
                    @foreach($status ?? [] as $key => $item)
                        <option value="{{ $key }}" {{ ($order->status ?? 0) == $key ? "selected" : "" }}>{{ $item['name'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Trạng thái vận chuyển</label>
                <select name="shipping_status" id="" class="form-control">
                    @foreach($statusShippingConfig ?? [] as $key => $item)
                        <option value="{{ $key }}" {{ ($order->shipping_status ?? 0) == $key ? "selected" : "" }}>{{ $item['name'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</form>
