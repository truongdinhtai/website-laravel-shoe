<div class="sidebar sidebar-shop">
    <div class="widget widget-collapsible">
        <h3 class="widget-title">
            <a data-toggle="collapse" href="#widget-3" role="button" aria-expanded="true" aria-controls="widget-3">
                Nhà cung cấp
            </a>
        </h3><!-- End .widget-title -->

        <div class="collapse show" id="widget-3">
            <div class="widget-body">
                <div class="filter-colors">
                    @foreach($suppliers ?? [] as $item)
                        <a href="{{ request()->fullUrlWithQuery(['s'=> $item->id]) }}" style="display: block;width: 100%;height: auto"><span class="">{{ $item->name }}</span></a>
                    @endforeach
                </div><!-- End .filter-colors -->
            </div><!-- End .widget-body -->
        </div><!-- End .collapse -->
    </div><!-- End .widget -->
    <div class="widget widget-collapsible">
        <h3 class="widget-title">
            <a data-toggle="collapse" href="#widget-4" role="button" aria-expanded="true" aria-controls="widget-3">
                Giá
            </a>
        </h3><!-- End .widget-title -->

        <div class="collapse show" id="widget-4">
            <div class="widget-body">
                <div class="filter-colors">
                    @foreach($prices ?? [] as $key => $item)
                        <a href="{{ request()->fullUrlWithQuery(['price'=> $item['value']]) }}" style="display: block;width: 100%;height: auto"><span class="">{{ $item['name'] }}</span></a>
                    @endforeach
                </div><!-- End .filter-colors -->
            </div><!-- End .widget-body -->
        </div><!-- End .collapse -->
    </div><!-- End .widget -->
</div><!-- End .sidebar sidebar-shop -->