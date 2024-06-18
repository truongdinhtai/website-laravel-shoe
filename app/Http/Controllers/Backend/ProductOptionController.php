<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\Menu;
use App\Models\ProductOption;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ProductOptionController extends Controller
{
    public function index()
    {
        $productOptions = ProductOption::with('category:id,name')->orderByDesc('id')
            ->paginate(20);

        $viewData = [
            'productOptions' => $productOptions
        ];

        return view('backend.product_option.index', $viewData);
    }

    public function create()
    {
        $categories = Category::all();
        return view('backend.product_option.create', compact('categories'));
    }

    public function store(Request $request)
    {
        try {
            $data = $request->except('_token','avatar');
            $data['created_at'] = Carbon::now();

            $menu = ProductOption::create($data);
        }catch (\Exception $exception) {
            toastr()->error('Thêm mới thất bại!', 'Thông báo');
            Log::error("ERROR => ProductOptionController@store => ". $exception->getMessage());
            return redirect()->route('get_admin.product_option.create');
        }
        toastr()->success('Thêm mới thành công!', 'Thông báo');
        return redirect()->route('get_admin.product_option.index');
    }

    public function edit($id)
    {
        $productOption = ProductOption::findOrFail($id);
        $categories = Category::all();
        return view('backend.product_option.update', compact('productOption','categories'));
    }

    public function update(Request $request, $id) {
        try {
            $data = $request->except('_token','avatar');
            $data['updated_at'] = Carbon::now();

            ProductOption::find($id)->update($data);
        }catch (\Exception $exception) {
            toastr()->error('Update thất bại!', 'Thông báo');
            Log::error("ERROR => ProductOptionController@store => ". $exception->getMessage());
            return redirect()->route('get_admin.menu.update', $id);
        }

        toastr()->success('Update thành công!', 'Thông báo');
        return redirect()->route('get_admin.product_option.index');
    }

    public function delete(Request $request, $id) {
        try {
            $productOption = ProductOption::findOrFail($id);
            if ($productOption) $productOption->delete();

        }catch (\Exception $exception) {
            toastr()->error('Update thất bại!', 'Thông báo');
            Log::error("ERROR => ProductOptionController@delete => ". $exception->getMessage());
        }

        toastr()->success('Update thành công!', 'Thông báo');
        return redirect()->route('get_admin.product_option.index');
    }
}
