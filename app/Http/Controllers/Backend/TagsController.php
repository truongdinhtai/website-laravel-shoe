<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Menu;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class TagsController extends Controller
{
    public function index()
    {
        $tags = Tag::orderByDesc('id')
            ->paginate(20);

        $viewData = [
            'tags' => $tags
        ];

        return view('backend.tag.index', $viewData);
    }

    public function create()
    {
        return view('backend.tag.create');
    }

    public function store(Request $request)
    {
        try {
            $data = $request->except('_token','avatar');
            $data['created_at'] = Carbon::now();

            $menu = Tag::create($data);
        }catch (\Exception $exception) {
            toastr()->error('Thêm mới thất bại!', 'Thông báo');
            Log::error("ERROR => MenuController@store => ". $exception->getMessage());
            return redirect()->route('get_admin.tag.create');
        }
        toastr()->success('Thêm mới thành công!', 'Thông báo');
        return redirect()->route('get_admin.tag.index');
    }

    public function edit($id)
    {
        $tag = Tag::findOrFail($id);
        return view('backend.tag.update', compact('tag'));
    }

    public function update(Request $request, $id) {
        try {
            $data = $request->except('_token','avatar');
            $data['updated_at'] = Carbon::now();

            Tag::find($id)->update($data);
        }catch (\Exception $exception) {
            toastr()->error('Update thất bại!', 'Thông báo');
            Log::error("ERROR => MenuController@store => ". $exception->getMessage());
            return redirect()->route('get_admin.tag.update', $id);
        }

        toastr()->success('Update thành công!', 'Thông báo');
        return redirect()->route('get_admin.tag.index');
    }

    public function delete(Request $request, $id) {
        try {
            $menu = Tag::findOrFail($id);
            if ($menu) $menu->delete();

        }catch (\Exception $exception) {
            toastr()->error('Update thất bại!', 'Thông báo');
            Log::error("ERROR => MenuController@delete => ". $exception->getMessage());
        }

        toastr()->success('Update thành công!', 'Thông báo');
        return redirect()->route('get_admin.tag.index');
    }
}
