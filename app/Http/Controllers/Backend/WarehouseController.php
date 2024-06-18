<?php

namespace App\Http\Controllers\Backend;

use App\Exports\WarehouseExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductsWarehouse;
use App\Models\Supplier;
use App\Models\Warehouse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class WarehouseController extends Controller
{
    public function index()
    {
        $warehouses = Warehouse::with('product', 'supplier')->orderByDesc('id')
            ->paginate(20);

        $viewData = [
            'warehouses' => $warehouses
        ];

        return view('backend.warehouse.index', $viewData);
    }

    public function export(Request $request)
    {
        return \Excel::download(new WarehouseExport(), 'warehouse-export.xlsx');
    }

    public function create()
    {
        $products = Product::all();
        $suppliers = Supplier::all();
        return view('backend.warehouse.create', compact('products', 'suppliers'));
    }

    public function store(Request $request)
    {
        try {
            $data = $request->except('_token', 'avatar');
            $data['created_at'] = Carbon::now();
            $warehouse = Warehouse::create($data);
            $totalQty = $totalPrice = 0;
            if ($warehouse) {
                $products = $request->options['product_ids'] ?? [];
                if (!empty($products)) {
                    foreach ($products as $key => $id) {
                        $product = Product::find($id);
                        ProductsWarehouse::create([
                            'product_id'   => $id,
                            'warehouse_id' => $warehouse->id,
                            'qty'          => $request->options['qty'][$key] ?? 0,
                            'price'        => $request->options['price'][$key] ?? 0,
                            'total' => ($request->options['qty'][$key] ?? 0) * ($request->options['price'][$key] ?? 0)
                        ]);

                        $totalQty += $request->options['qty'][$key] ?? 0;
                        $totalPrice += ($request->options['price'][$key] ?? 0) * ($request->options['qty'][$key] ?? 0);
                        if ($product && $warehouse->type == 'input')
                        {
                            Log::info("========= CỘng QTY ". $request->options['qty'][$key] ?? 0);
                            Log::info("========= CỘng ID ". $product->id);
                            $product->number += $request->options['qty'][$key] ?? 0;
                            $product->save();
                        }else{
                            Log::info("========= Trừ QTY ". $request->options['qty'][$key] ?? 0);
                            Log::info("========= Trừ ID ". $product->id);

                            $product->number -= $request->options['qty'][$key] ?? 0;
                            $product->save();
                            if ($product->number < 0) {
                                Log::info("========= RESET = 0 ID ". $product->id);
                                $product->number = 0;
                                $product->save();
                            }
                        }
                    }
                }
                $warehouse->qty = $totalQty;
                $warehouse->total_money = $totalPrice;
                $warehouse->save();
            }


        } catch (\Exception $exception) {
            toastr()->error('Thêm mới thất bại!', 'Thông báo');
            Log::error("ERROR => WarehouseController@store => " . $exception->getMessage());
            return redirect()->route('get_admin.warehouse.create');
        }
        toastr()->success('Thêm mới thành công!', 'Thông báo');
        return redirect()->route('get_admin.warehouse.index');
    }

    public function edit($id)
    {
        $warehouse = Warehouse::findOrFail($id);
        return view('backend.warehouse.update', compact('warehouse'));
    }

    public function view($id)
    {
        $warehouse = Warehouse::with('supplier')->find($id);
        $productsWarehouse = ProductsWarehouse::with('product')->where('warehouse_id', $id)->get();
        return view('backend.warehouse.view', compact('warehouse','productsWarehouse'));
    }

    public function update(Request $request, $id)
    {
        try {
            $data = $request->except('_token', 'avatar');
            $data['slug'] = Str::slug($request->name);
            $data['updated_at'] = Carbon::now();

            if ($request->avatar) {
                $file = upload_image('avatar');
                if (isset($file['code']) && $file['code'] == 1) {
                    $data['avatar'] = $file['name'];
                }
            }

            Warehouse::find($id)->update($data);
        } catch (\Exception $exception) {
            toastr()->error('Update thất bại!', 'Thông báo');
            Log::error("ERROR => WarehouseController@store => " . $exception->getMessage());
            return redirect()->route('get_admin.warehouse.update', $id);
        }

        toastr()->success('Update thành công!', 'Thông báo');
        return redirect()->route('get_admin.warehouse.index');
    }

    public function delete(Request $request, $id)
    {
        try {
            $warehouse = Warehouse::findOrFail($id);
            if ($warehouse) {
                $warehouse->delete();
            }

        } catch (\Exception $exception) {
            toastr()->error('Update thất bại!', 'Thông báo');
            Log::error("ERROR => WarehouseController@delete => " . $exception->getMessage());
        }

        toastr()->success('Update thành công!', 'Thông báo');
        return redirect()->route('get_admin.warehouse.index');
    }
}
