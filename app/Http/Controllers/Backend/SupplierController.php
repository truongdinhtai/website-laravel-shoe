<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::orderByDesc('id')
            ->paginate(20);

        $viewData = [
            'suppliers' => $suppliers
        ];

        return view('backend.supplier.index', $viewData);
    }

    public function create()
    {
        return view('backend.supplier.create');
    }

    public function store(Request $request)
    {
        try {
            $data = $request->except('_token','avatar');
            $data['created_at'] = Carbon::now();
            if ($request->avatar){
                $file = upload_image('avatar');
                if (isset($file['code']) && $file['code'] == 1) $data['avatar'] = $file['name'];
            }
            $supplier = Supplier::create($data);
        }catch (\Exception $exception) {
            toastr()->error('Thêm mới thất bại!', 'Thông báo');
            Log::error("ERROR => SupplierController@store => ". $exception->getMessage());
            return redirect()->route('get_admin.supplier.create');
        }
        toastr()->success('Thêm mới thành công!', 'Thông báo');
        return redirect()->route('get_admin.supplier.index');
    }

    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('backend.supplier.update', compact('supplier'));
    }

    public function update(CategoryRequest $request, $id) {
        try {
            $data = $request->except('_token','avatar');
            $data['updated_at'] = Carbon::now();
            if ($request->avatar){
                $file = upload_image('avatar');
                if (isset($file['code']) && $file['code'] == 1) $data['avatar'] = $file['name'];
            }
            Supplier::find($id)->update($data);
        }catch (\Exception $exception) {
            toastr()->error('Update thất bại!', 'Thông báo');
            Log::error("ERROR => SupplierController@store => ". $exception->getMessage());
            return redirect()->route('get_admin.supplier.update', $id);
        }

        toastr()->success('Update thành công!', 'Thông báo');
        return redirect()->route('get_admin.supplier.index');
    }

    public function delete(Request $request, $id) {
        try {
            $category = Supplier::findOrFail($id);
            if ($category) $category->delete();

        }catch (\Exception $exception) {
            toastr()->error('Update thất bại!', 'Thông báo');
            Log::error("ERROR => SupplierController@delete => ". $exception->getMessage());
        }

        toastr()->success('Update thành công!', 'Thông báo');
        return redirect()->route('get_admin.supplier.index');
    }
}
