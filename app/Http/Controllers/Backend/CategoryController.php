<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderByDesc('id')
            ->paginate(20);

        $viewData = [
            'categories' => $categories
        ];

        return view('backend.category.index', $viewData);
    }

    public function create()
    {
        return view('backend.category.create');
    }

    public function store(CategoryRequest $request)
    {
        try {
            $data = $request->except('_token','avatar');
            $data['slug'] = Str::slug($request->name);
            $data['created_at'] = Carbon::now();

            if ($request->avatar){
                $file = upload_image('avatar');
                if (isset($file['code']) && $file['code'] == 1) $data['avatar'] = $file['name'];
            }

            $category = Category::create($data);
        }catch (\Exception $exception) {
            toastr()->error('Thêm mới thất bại!', 'Thông báo');
            Log::error("ERROR => CategoryController@store => ". $exception->getMessage());
            return redirect()->route('get_admin.category.create');
        }
        toastr()->success('Thêm mới thành công!', 'Thông báo');
        return redirect()->route('get_admin.category.index');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('backend.category.update', compact('category'));
    }

    public function update(CategoryRequest $request, $id) {
        try {
            $data = $request->except('_token','avatar');
            $data['slug'] = Str::slug($request->name);
            $data['updated_at'] = Carbon::now();

            if ($request->avatar){
                $file = upload_image('avatar');
                if (isset($file['code']) && $file['code'] == 1) $data['avatar'] = $file['name'];
            }

            Category::find($id)->update($data);
        }catch (\Exception $exception) {
            toastr()->error('Update thất bại!', 'Thông báo');
            Log::error("ERROR => CategoryController@store => ". $exception->getMessage());
            return redirect()->route('get_admin.category.update', $id);
        }

        toastr()->success('Update thành công!', 'Thông báo');
        return redirect()->route('get_admin.category.index');
    }

    public function delete(Request $request, $id) {
        try {
            $category = Category::findOrFail($id);
            if ($category) $category->delete();

        }catch (\Exception $exception) {
            toastr()->error('Update thất bại!', 'Thông báo');
            Log::error("ERROR => CategoryController@delete => ". $exception->getMessage());
        }

        toastr()->success('Update thành công!', 'Thông báo');
        return redirect()->route('get_admin.category.index');
    }
}
