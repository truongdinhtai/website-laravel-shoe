<form method="POST" action="" autocomplete="off" enctype="multipart/form-data">
    @csrf
{{--    <div class="form-group">--}}
{{--        <label for="exampleInputEmail1">Số lượng</label>--}}
{{--        <input type="number" name="qty" class="form-control" required value="{{ old('name', $warehouse->qty ?? "0") }}">--}}
{{--    </div>--}}

{{--    <div class="form-group">--}}
{{--        <label for="exampleInputEmail1">Giá</label>--}}
{{--        <input type="number" name="price" class="form-control" required value="{{ old('name', $warehouse->price ?? "0") }}">--}}
{{--    </div>--}}
    <div class="form-group">
        <label for="exampleInputEmail1">Ngày</label>
        <input type="date" name="date_time" class="form-control" required value="{{ old('name', $warehouse->date_time ?? "") }}">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Nhập / Xuât</label>
        <select name="type" class="form-control" id="">
            <option value="input" {{ ($warehouse->type ?? "input") == "input" ? "selected" : "" }}>Nhập</option>
            <option value="output" {{ ($warehouse->type ?? "input") == "output" ? "selected" : "" }}>Xuất</option>
        </select>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Nhà cung cấp</label>
        <select name="supplier_id" required class="form-control" id="">
            <option value="">Chọn nhà cung cấp</option>
            @foreach($suppliers as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>
    </div>
    <div id="wrap-row-option">
        <h5>Chọn sản phẩm</h5>
        @if(isset($productValues) && !$productValues->IsEmpty())
            @foreach($productValues as $key => $value)
                <div class="row row-menu {{ $key == 0 ? 'row-option-temple' : '' }}">
                    <div class="col-sm-3">
                        <div class="form-group mlr-10">
                            <select name="options[productOptionId][]" id="" class="form-control">
                                @foreach($productOptions ?? [] as $item)
                                    <option value="{{ $item->id }}" {{ $value->product_option_id == $item->id ? "selected" : "" }}>{{ $item->option_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mlr-10">
                            <input type="text" class="form-control" name="options[value][]"
                                   value="{{ $value->name_value }}"
                                   placeholder="Giá trị"/>
                        </div>
                    </div>
                    <div class="col-md-2 action-row-menu hide">
                        <div class="form-group">
                            <a href="javascript:void(0)" class="btn btn-sm btn-default btn-remove"><i class="fa fa-trash"></i>  </a>
                            <a href="javascript:void(0)" class="btn btn-sm btn-default btn-move-up"><i class="fa fa-arrow-up"></i></a>
                            <a href="javascript:void(0)" class="btn btn-sm btn-default btn-move-down"><i class="fa fa-arrow-down"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="row row-menu row-option-temple">
                <div class="col-sm-3">
                    <div class="form-group mlr-10">
                        <select name="options[product_ids][]" id="" class="form-control">
                            @foreach($products as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group mlr-10">
                        <input type="text" class="form-control" name="options[price][]"
                               value=""
                               placeholder="Giá trị"/>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group mlr-10">
                        <input type="text" class="form-control" name="options[qty][]"
                               value=""
                               placeholder="Số lượng"/>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <div class="row">
        <div class="form-group">
            <a id="copy_option" class="col-sm-12" href="javascript:void(0)"><i class="fa fa-plus"></i> Thêm sản phẩm</a>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Lưu dữ liệu</button>
</form>

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/css/fileinput.css" media="all"
      rel="stylesheet" type="text/css"/>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/js/fileinput.js"
        type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/themes/fa/theme.js"
        type="text/javascript"></script>


<script>
    $(function (){
        $('#copy_menu').off('click').click(function () {
            let $rowMenu = $('.row-menu-temple').clone().removeClass('row-menu-temple');
            $rowMenu.find('.action-row-menu').removeClass('hide');
            $('#wrap-row-menu').append($rowMenu);
        })

        $('#copy_option').off('click').click(function () {
            let $rowMenu = $('.row-option-temple').clone().removeClass('row-option-temple');
            $rowMenu.find('.action-row-menu').removeClass('hide');
            $('#wrap-row-option').append($rowMenu);
        })



        $('#wrap-row-menu').on('click', '.btn-remove', function () {
            let $this = $(this);
            if (confirm("Bạn có chắc chắn muốn xoá menu này?"))
            {
                $this.closest('.row-menu').remove();
            }
        })

        $('#wrap-row-option').on('click', '.btn-remove', function () {
            let $this = $(this);
            if (confirm("Bạn có chắc chắn muốn xoá menu này?"))
            {
                $this.closest('.row-menu').remove();
            }
        })

        $('#wrap-row-menu').on('click', '.btn-move-up' ,function () {
            let $this = $(this);
            let $rowMenu  = $this.closest('.row-menu');
            let $rowMenuBefore = $rowMenu.prev();
            $rowMenu.after($rowMenuBefore);
        })

        $('#wrap-row-option').on('click', '.btn-move-up' ,function () {
            let $this = $(this);
            let $rowMenu  = $this.closest('.row-menu');
            let $rowMenuBefore = $rowMenu.prev();
            $rowMenu.after($rowMenuBefore);
        })

        $('#wrap-row-menu').on('click', '.btn-move-down', function () {
            let $this = $(this);
            let $rowMenu  = $this.closest('.row-menu');
            let $rowMenuBefore = $rowMenu.next();
            $rowMenu.before($rowMenuBefore);
        })

        $('#wrap-row-option').on('click', '.btn-move-down', function () {
            let $this = $(this);
            let $rowMenu  = $this.closest('.row-menu');
            let $rowMenuBefore = $rowMenu.next();
            $rowMenu.before($rowMenuBefore);
        })

        $(".js-money").on('input', function (e) {
            $(this).val(formatCurrency(this.value.replace(/[,VNĐ]/g, '')));
        }).on('keypress', function (e) {
            if (!$.isNumeric(String.fromCharCode(e.which))) e.preventDefault();
        }).on('paste', function (e) {
            var cb = e.originalEvent.clipboardData || window.clipboardData;
            if (!$.isNumeric(cb.getData('text'))) e.preventDefault();
        });

        function formatCurrency(number) {
            let n = number.split('').reverse().join("");
            let n2 = n.replace(/\d\d\d(?!$)/g, "$&,");

            return n2.split('').reverse().join('');
        }
    })
</script>