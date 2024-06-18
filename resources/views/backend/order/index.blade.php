@extends('backend.layouts.app_backend')
@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h2>Đơn hàng</h2>
    </div>
    <div>
        <form class="form-inline">
            <div class="form-group mb-2 mr-2">
                <label for="inputPassword2" class="sr-only">Tên</label>
                <input type="text" name="n" class="form-control" value="{{ Request::get('n') }}" placeholder="Tên khách hàng ..">
            </div>

            <div class="form-group mb-2 mr-2">
                <label for="inputPassword2" class="sr-only">Trạng thái</label>
                <select name="status" id="" class="form-control">
                    <option value="">---</option>
                    @foreach($status ?? [] as $key => $item)
                        <option value="{{ $key }}" {{ (Request::get('status') ?? 0) == $key ? "selected" : "" }}>{{ $item['name'] }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary mb-2">Find</button>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>Mã ĐH</th>
                    <th>Thông tin KH</th>
                    <th>Tổng tiền</th>
                    <th>Loại đơn</th>
                    <th>Thanh toán</th>
                    <th>Vận chuyển</th>
                    <th>Ghi chú</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders ?? [] as $item)
                    <tr>
                        <td><a href="{{ route('get_admin.order.show', $item->id) }}">#DH{{ $item->id }}</a></td>
                        <td>
                            <span>{{ $item->receiver_name }}</span> <br>
                            <span>{{ $item->receiver_phone }}</span><br>
                            <span>{{ $item->receiver_email }}</span>
                        </td>
                        <td>{{ number_format($item->total_price,0,',','.') }}đ</td>
                        <td>
                            <span class="badge badge-{{ $item->getOrderType($item->order_type)['class'] ?? "" }} bg-{{ $item->getOrderType($item->order_type)['class'] ?? "" }}">{{ $item->getOrderType($item->order_type)['name'] ?? "" }}</span>
                        </td>
                        <td>
                            <span class="badge badge-{{ $item->getStatus($item->status)['class'] ?? "badge badge-light" }} bg-{{ $item->getStatus($item->status)['class'] ?? "badge badge-light" }}">{{ $item->getStatus($item->status)['name'] ?? "Tạm dừng" }}</span>
                        </td>
                        <td>
                            <span class="badge badge-{{ $item->getStatusShippingConfig($item->shipping_status)['class'] ?? "badge badge-light" }} bg-{{ $item->getStatusShippingConfig($item->shipping_status)['class'] ?? "badge badge-light" }}">{{ $item->getStatusShippingConfig($item->shipping_status)['name'] ?? "Tạm dừng" }}</span>
                        </td>
                        <td>{{ $item->note }}</td>
                        <td>
                            <a href="{{ route('get_admin.order.update', $item->id) }}">Update</a>
                            <a href="javascript:;void(0)">|</a>
                            <a href="{{ route('get_admin.order.delete', $item->id) }}">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="col-12">
            {!! $orders->appends($query ?? [])->links() !!}
        </div>
    </div>
@stop
