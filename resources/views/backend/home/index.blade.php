@extends('backend.layouts.app_backend')
@section('content')
    <h2>Thống kê</h2>
    <div class="row">
        <div class="col-sm-3">
            <div class="box p-3 mb-2 bg-primary text-white">
                <h6>Thành viên <b id="totalUser"><i class="fa fa-spinner fa-spin"
                                                    style="font-size:24px;color:white"></i></b></h6>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="box p-3 mb-2 bg-danger text-white">
                <h6>Sản phẩm <b id="totalProduct"><i class="fa fa-spinner fa-spin"
                                                     style="font-size:24px;color:white"></i></b></h6>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="box p-3 mb-2 bg-info text-white">
                <h6>Đơn hàng <b id="totalOrder"><i class="fa fa-spinner fa-spin" style="font-size:24px;color:white"></i></b>
                </h6>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="box p-3 mb-2 bg-secondary text-white">
                <h6>User mới <b id="totalUserNew"><i class="fa fa-spinner fa-spin"
                                                     style="font-size:24px;color:white"></i></b></h6>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <div class="box p-3 mb-2 bg-secondary text-white">
                <h6 style="min-height: 48px">Doanh thu ngày <b id="totalMoneyDay"><i class="fa fa-spinner fa-spin"
                                                            style="font-size:24px;color:white"></i></b></h6>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="box p-3 mb-2 bg-danger text-white">
                <h6 style="min-height: 48px">Doanh thu tuần <b id="totalMoneyWeed"><i class="fa fa-spinner fa-spin"
                                                             style="font-size:24px;color:white"></i></b></h6>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="box p-3 mb-2 bg-primary text-white">
                <h6 style="min-height: 48px">Doanh thu tháng <b id="totalMoneyMonth"><i class="fa fa-spinner fa-spin"
                                                              style="font-size:24px;color:white"></i></b></h6>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="box p-3 mb-2 bg-info text-white">
                <h6 style="min-height: 48px">Doanh thu năm <b id="totalMoneyYear"><i class="fa fa-spinner fa-spin"
                                                            style="font-size:24px;color:white"></i></b></h6>
            </div>
        </div>
    </div>
    <div class="row" style="margin-bottom: 15px;">
        <div class="col-sm-8">
            <figure class="highcharts-figure">
                <div id="container2" data-list-day="{{ $listDay }}"
                     data-money-default={{ $arrRevenueTransactionMonthDefault }} data-money={{ $arrRevenueTransactionMonth }}>
                </div>
            </figure>
        </div>
        <div class="col-sm-4">
            <figure class="highcharts-figure">
                <div id="container" data-json="{{ $statusTransaction }}"></div>
            </figure>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-md-4">
            <h2>Thành viên mới</h2>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Thông tin</th>
                        <th>Active</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users ?? [] as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>
                                {{ $item->name }} <br>
                                {{ $item->email }}
                            </td>
                            <td>
                                <span
                                    class="{{ $item->getStatus($item->status)['class'] ?? "badge badge-light" }}">{{ $item->getStatus($item->status)['name'] ?? "Tạm dừng" }}</span>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-8">
            <h2>Tin mới</h2>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th style="width: 30%">Tên sản phẩm</th>
                        <th>Danh mục</th>
                        <th>Người đăng</th>
                        <th>Giá</th>
                        <th>Trạng thái</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products ?? [] as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->category->name ?? "[N\A]" }}</td>
                            <td>{{ $item->user->name ?? "[N\A]" }}</td>
                            <td>{{ number_format($item->price,0,',','.') }}đ</td>
                            <td>
                                <span
                                    class="{{ $item->getStatus($item->status)['class'] ?? "badge badge-light" }}">{{ $item->getStatus($item->status)['name'] ?? "Tạm dừng" }}</span>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

@section('script')
    <link rel="stylesheet" href="https://code.highcharts.com/css/highcharts.css">
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script type="text/javascript">
        console.log('============== LOADING DATA')
        let dataTransaction = $("#container").attr('data-json');
        dataTransaction = JSON.parse(dataTransaction);

        let listday = $("#container2").attr("data-list-day");
        listday = JSON.parse(listday);

        let listMoneyMonth = $("#container2").attr('data-money');
        listMoneyMonth = JSON.parse(listMoneyMonth);

        let listMoneyMonthDefault = $("#container2").attr('data-money-default');
        listMoneyMonthDefault = JSON.parse(listMoneyMonthDefault);

        Highcharts.chart('container', {
            chart: {
                styledMode: true
            },

            title: {
                text: 'Thống kê trạng thái đơn hàng'
            },

            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr']
            },

            series: [{
                type: 'pie',
                allowPointSelect: true,
                keys: ['name', 'y', 'selected', 'sliced'],
                data: dataTransaction,
                showInLegend: true
            }]
        });

        Highcharts.chart('container2', {
            chart: {
                type: 'spline'
            },
            title: {
                text: 'Biểu đồ doanh thu các ngày trong tháng'
            },
            xAxis: {
                categories: listday
            },
            yAxis: {
                title: {
                    text: 'Biển đồ giá trị'
                },
                labels: {
                    formatter: function () {
                        return this.value + '°';
                    }
                }
            },
            tooltip: {
                crosshairs: true,
                shared: true
            },
            plotOptions: {
                spline: {
                    marker: {
                        radius: 4,
                        lineColor: '#666666',
                        lineWidth: 1
                    }
                }
            },
            series: [
                {
                    name: 'Hoàn tất giao dịch',
                    marker: {
                        symbol: 'square'
                    },
                    data: listMoneyMonth
                },
                {
                    name: 'Tiếp nhận',
                    marker: {
                        symbol: 'square'
                    },
                    data: listMoneyMonthDefault
                }
            ]
        });
        $("body .highcharts-credits").remove();
        $(function () {
            $.ajax({
                method: "GET",
                url: '{{ route('get_admin.dashboard.ajax') }}'
            })
                .done(function (response) {
                    $("#totalUser").html(response.totalUser);
                    $("#totalProduct").html(response.totalProduct);
                    $("#totalOrder").html(response.totalOrder);
                    $("#totalUserNew").html(response.totalUserNew);
                    $("#totalMoneyDay").html(response.totalMoneyDay);
                    $("#totalMoneyMonth").html(response.totalMoneyMonth);
                    $("#totalMoneyYear").html(response.totalMoneyYear);
                    $("#totalMoneyWeed").html(response.totalMoneyWeed);
                });
        })
    </script>

@stop
