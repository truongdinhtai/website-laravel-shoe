<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Menu;
use App\Models\Page;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index(Request $request)
    {
        $pages = Page::whereRaw(1);

        if ($name = $request->n)
            $pages->where('name', 'like', '%' . $name . '%');

        $pages = $pages
            ->orderByDesc('id')
            ->paginate(20);


        $viewData = [
            'pages' => $pages,
            'query' => $request->query()
        ];

        return view('backend.page.index', $viewData);
    }

    public function create()
    {
        return view('backend.page.create');
    }

    public function store(Request $request)
    {
        try {
            $data = $request->except('_token', 'avatar');
            $data['created_at'] = Carbon::now();
            $data['url'] = $this->replaceUrl($request->url);

            if ($request->avatar) {
                $file = upload_image('avatar');
                if (isset($file['code']) && $file['code'] == 1) $data['avatar'] = $file['name'];
            }

            $page = Page::create($data);

        } catch ( \Exception $exception ) {
            Log::error("ERROR => PageController@store => " . $exception->getMessage());
            return redirect()->route('get_admin.page.create');
        }
        return redirect()->route('get_admin.page.index');
    }

    public function edit($id)
    {
        $page = Page::findOrFail($id);
        $menus = Menu::all();

        $viewData = [
            'page' => $page
        ];

        return view('backend.page.update', $viewData);
    }

    public function update(Request $request, $id)
    {
        try {
            $data = $request->except('_token', 'avatar');
            $data['updated_at'] = Carbon::now();

            if ($request->avatar) {
                $file = upload_image('avatar');
                if (isset($file['code']) && $file['code'] == 1) $data['avatar'] = $file['name'];
            }
            $data['url'] = $this->replaceUrl($request->url);

            Page::find($id)->update($data);

        } catch ( \Exception $exception ) {
            Log::error("ERROR => PageController@store => " . $exception->getMessage());
            toastr()->error('Xử lý thất bại', 'Thông báo');
            return redirect()->route('get_admin.page.update', $id);
        }

        toastr()->success('Xử lý thành công', 'Thông báo');
        return redirect()->route('get_admin.page.index');
    }

    public function delete(Request $request, $id)
    {
        try {
            $page = Page::findOrFail($id);
            if ($page) $page->delete();

        } catch ( \Exception $exception ) {
            Log::error("ERROR => PageController@delete => " . $exception->getMessage());
        }
        return redirect()->route('get_admin.page.index');
    }

    protected function replaceUrl($url)
    {
        return parse_url($url)['path'] ?? '';
    }
}
