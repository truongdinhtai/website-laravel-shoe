<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\Menu;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::orderByDesc('id')
            ->paginate(20);

        $viewData = [
            'menus' => $menus
        ];

        return view('backend.menu.index', $viewData);
    }

    public function create()
    {
        return view('backend.menu.create');
    }

    public function store(Request $request)
    {
        try {
            $data = $request->except('_token','avatar');
            $data['slug'] = Str::slug($request->name);
            $data['created_at'] = Carbon::now();

            if ($request->avatar){
                $file = upload_image('avatar');
                if (isset($file['code']) && $file['code'] == 1) $data['avatar'] = $file['name'];
            }

            $menu = Menu::create($data);
        }catch (\Exception $exception) {
            toastr()->error('Thêm mới thất bại!', 'Thông báo');
            Log::error("ERROR => MenuController@store => ". $exception->getMessage());
            return redirect()->route('get_admin.menu.create');
        }
        toastr()->success('Thêm mới thành công!', 'Thông báo');
        return redirect()->route('get_admin.menu.index');
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        return view('backend.menu.update', compact('menu'));
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

            Menu::find($id)->update($data);
        }catch (\Exception $exception) {
            toastr()->error('Update thất bại!', 'Thông báo');
            Log::error("ERROR => MenuController@store => ". $exception->getMessage());
            return redirect()->route('get_admin.menu.update', $id);
        }

        toastr()->success('Update thành công!', 'Thông báo');
        return redirect()->route('get_admin.menu.index');
    }

    public function delete(Request $request, $id) {
        try {
            $menu = Menu::findOrFail($id);
            if ($menu) $menu->delete();

        }catch (\Exception $exception) {
            toastr()->error('Update thất bại!', 'Thông báo');
            Log::error("ERROR => MenuController@delete => ". $exception->getMessage());
        }

        toastr()->success('Update thành công!', 'Thông báo');
        return redirect()->route('get_admin.menu.index');
    }
}
