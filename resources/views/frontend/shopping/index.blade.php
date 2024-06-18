<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>[Giỏ hàng]</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style type="text/css">
        body {
            margin-top: 20px;
        }

        .cart-item-thumb {
            display: block;
            width: 10rem
        }

        .cart-item-thumb > img {
            display: block;
            width: 100%
        }

        .product-card-title > a {
            color: #222;
        }

        .font-weight-semibold {
            font-weight: 600 !important;
        }

        .product-card-title {
            display: block;
            margin-bottom: .75rem;
            padding-bottom: .875rem;
            border-bottom: 1px dashed #e2e2e2;
            font-size: 1rem;
            font-weight: normal;
        }

        .text-muted {
            color: #888 !important;
        }

        .bg-secondary {
            background-color: #f7f7f7 !important;
        }

        .accordion .accordion-heading {
            margin-bottom: 0;
            font-size: 1rem;
            font-weight: bold;
        }

        .font-weight-semibold {
            font-weight: 600 !important;
        }
    </style>
</head>
<body>
<div class="container pb-5 mt-n2 mt-md-n3">

    <div class="row">
        <div class="col-xl-8 col-md-8">
            <h2 class="h6 d-flex flex-wrap justify-content-between align-items-center px-4 py-3 bg-secondary"><span>Sản phẩm</span>
                <a class="font-size-sm" href="{{ route('get.home') }}">Về trang chủ</a></h2>
            @foreach($shopping ?? [] as $key => $item)
                <div class="d-sm-flex justify-content-between my-4 pb-4 border-bottom">
                    <div class="media d-block d-sm-flex text-center text-sm-left">
                        <a class="cart-item-thumb mx-auto mr-sm-4" target="_blank"
                           href="{{ route('get.product.item',['id' => $item->id, 'slug' => \Illuminate\Support\Str::slug($item->name)]) }}">
                            <img src="{{ pare_url_file($item->options->image) }}"
                                 onerror="this.src='/images/preloader.gif'" alt="{{ $item->name }}"></a>
                        <div class="media-body pt-3">
                            <h3 class="product-card-title font-weight-semibold border-0 pb-0">
                                <a href="{{ route('get.product.item',['id' => $item->id, 'slug' => \Illuminate\Support\Str::slug($item->name)]) }}"
                                   target="_blank">{{ $item->name }}</a>
                            </h3>
                            @if ($item->options->attributes)
                                @foreach($item->options->attributes as $attribute)
                                    <div class="font-size-sm"><span class="text-muted mr-2">{{ $attribute['product_option']['option_name'] ?? "[N\A]" }}:</span>{{ $attribute['name_value'] }}</div>
                                @endforeach
                            @else
                                {{ json_encode(($item->options->attributes)) }}
                            @endif
                            <div class="font-size-lg text-primary pt-2">{{ number_format($item->price,0,',','.') }}đ</div>
                        </div>
                    </div>
                    <div class="pt-2 pt-sm-0 pl-sm-3 mx-auto mx-sm-0 text-center text-sm-left"
                         style="max-width: 10rem;">
                        <form action="{{ route('ajax_get.shopping.update', $key) }}" method="GET">
                            <div class="form-group mb-2">
                                <label for="quantity1">Số lượng</label>
                                <input class="form-control form-control-sm" type="number" name="qty"
                                       value="{{ $item->qty }}">
                            </div>
                            <button class="btn btn-outline-secondary btn-sm btn-block mb-2" type="submit">
                                Cập nhật
                            </button>
                        </form>
                        <a href="{{ route('get.shopping.delete', $key) }}"
                           class="btn btn-outline-danger btn-sm btn-block mb-2" type="button">
                            Xoá
                        </a>
                    </div>
                </div>
            @endforeach
            <h2 class="h6 px-4 py-3 bg-secondary d-flex justify-content-between">
                <span>Tổng tiền hàng</span>
                <span>{{ \Cart::subtotal(0) }}đ</span>
            </h2>
            <h2 class="h6 px-4 py-3 bg-secondary d-flex justify-content-between">
                <span>Phí ship</span>
                <span class="total-shipping-order">0 đ</span>
            </h2>
            <h2 class="h6 px-4 py-3 bg-secondary d-flex justify-content-between">
                <span>Thành tiền</span>
                <span class="total-order">0 đ</span>
            </h2>
        </div>
        <div class="col-xl-4 col-md-4 pt-3 pt-md-0">
            <form action="" method="POST">
                @csrf
                <input type="hidden" name="total_shipping_order" value="0" id="total_shipping_order">
                <div class="card">
                    <div class="card-header">
                        <h5>Địa chỉ nhận hàng</h5>
                    </div>
                    <div class="collapse show">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <select name="province_id" class="form-control" id="loadDistrict">
                                            <option value="">Chọn tỉnh thành</option>
                                            @foreach($provinces ?? [] as $item)
                                                <option value="{{ $item->id }}" {{ ($product->province_id ?? 0) == $item->id ? "selected" : "" }}>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <select name="district_id" class="form-control" id="districtsData">
                                            <option value="">Chọn quận huyện</option>
                                            @foreach($activeDistricts ?? [] as $key =>  $item)
                                                <option value="{{ $key }}" selected>{{ $item }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <select name="ward_id" class="form-control" id="wardData">
                                            <option value="">Chọn phường xã</option>
                                            @foreach($activeWard ?? [] as $key =>  $item)
                                                <option value="{{ $key }}" selected>{{ $item }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="d-flex justify-content-between">
                                        <span>Phí ship <a href="" class="js-shipping-order">Tính phí</a></span>
                                        <span class="total-shipping-order">0 đ</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-header">
                        <h5>Thông tin thanh toán</h5>
                    </div>
                    <div class="collapse show">
                        <div class="card-body">
                            <input type="text" placeholder="Tên người nhận" name="receiver_name"
                                   class="form-control mb-2" value="{{ Auth::user()->name ?? '' }}">
                            <input type="text" placeholder="Email người nhận" name="receiver_email"
                                   class="form-control mb-2" value="{{ Auth::user()->email ?? '' }}">
                            <input type="text" placeholder="SĐT người nhận" name="receiver_phone"
                                   class="form-control mb-2" value="{{ Auth::user()->phone ?? '' }}">
                            <div class="form-group">
                                <select name="payment_type" required class="form-control">
                                    <option value="1">Nhận hàng thanh toán</option>
                                    <option value="2">Thanh toán Online</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <h3 class="h6 pt-4 font-weight-semibold"><span class="badge badge-success mr-2">Note</span>Ghi chú</h3>
                <textarea name="note" class="form-control mb-3" id="order-comments" rows="2"></textarea>
                <button type="submit" class="btn btn-primary mt-3">Xác nhận</button>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
    $(function () {
        $("#loadDistrict").change(function () {
            let province_id = $(this).find(":selected").val();

            $.ajax({
                url: "/location/district",
                data: {
                    province_id: province_id
                },
                beforeSend: function (xhr) {
                    // xhr.overrideMimeType( "text/plain; charset=x-user-defined" );
                }
            }).done(function (data) {

                let dataOptions = `<option value="">Chọn quận huyện</option>`;
                data.map(function (index, key) {
                    dataOptions += `<option value=${index.id}>${index.name}</option>`
                });

                $("#districtsData").html(dataOptions);
            });
        })

        $("#districtsData").change(function () {
            let district_id = $(this).find(":selected").val();
            $.ajax({
                url: "/location/ward",
                data: {
                    district_id: district_id
                },
                beforeSend: function (xhr) {
                    // xhr.overrideMimeType( "text/plain; charset=x-user-defined" );
                }
            }).done(function (data) {
                let dataOptions = `<option value="">Chọn phường xã</option>`;
                data.map(function (index, key) {
                    dataOptions += `<option value=${index.id}>${index.name}</option>`
                });

                $("#wardData").html(dataOptions);
            });
        })

        $("body .js-shipping-order").on("click", function ($event){
            $event.preventDefault();
            let province_id = $("select[name='province_id']").find(":selected").val();
            let ward_id = $("select[name='ward_id']").find(":selected").val();
            let district_id = $("select[name='district_id']").find(":selected").val();
            $(".total-shipping-order").html(`<i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);
            $.ajax({
                url: "/ghn/shipping-order",
                data: {
                    province_id: province_id,
                    district_id: district_id,
                    ward_id: ward_id,
                },
                beforeSend: function (xhr) {
                    // $(".total-shipping-order").html(`<i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);
                }
            }).done(function (res) {
                console.log('---- res: ', res);
                let total = res.ghn?.total;
                $(".total-shipping-order").html(total.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
                total += parseInt(res.totalOrder);
                total = total.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")
                $(".total-order").html(` ${total} đ`)
            });

        })
    })
</script>
</body>
</html>
