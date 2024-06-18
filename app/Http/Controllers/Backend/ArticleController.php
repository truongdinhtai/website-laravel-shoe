<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Article;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductWholesalePrice;
use App\Models\Province;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $articles = Article::with('menu:id,name','user');

        if ($name = $request->n)
            $articles->where('name', 'like', '%' . $name . '%');

        if ($s = $request->status)
            $articles->where('status', $s);

        $articles = $articles
            ->orderByDesc('id')
            ->paginate(20);


        $viewData = [
            'articles' => $articles,
            'query'    => $request->query()
        ];

        return view('backend.article.index', $viewData);
    }

    public function create()
    {
        $menus = Menu::all();
        $tags = Tag::all();
        $tagsOld = [];
        return view('backend.article.create', compact('menus', 'tags','tagsOld'));
    }

    public function store(Request $request)
    {
        try {
            $data = $request->except('_token', 'avatar', 'tags');
            $data['slug'] = Str::slug($request->name);
            $data['created_at'] = Carbon::now();

            if ($request->avatar) {
                $file = upload_image('avatar');
                if (isset($file['code']) && $file['code'] == 1) $data['avatar'] = $file['name'];
            }

            $data['user_id'] = Auth::user()->id;

            $idArticle = Article::insertGetId($data);
            if ($idArticle) {
                $this->syncTags($request->tags, $idArticle);
            }

        } catch ( \Exception $exception ) {
            Log::error("ERROR => ArticleController@store => " . $exception->getMessage());
            return redirect()->route('get_admin.article.create');
        }
        return redirect()->route('get_admin.article.index');
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);
        $menus = Menu::all();
        $tags = Tag::all();

        $tagsOld = \DB::table('articles_tags')
            ->where('article_id', $id)
            ->pluck('tag_id')
            ->toArray() ?? [];

        $viewData = [
            'article' => $article,
            'menus'   => $menus,
            'tags'    => $tags,
            'tagsOld' => $tagsOld
        ];

        return view('backend.article.update', $viewData);
    }

    public function update(Request $request, $id)
    {
        try {
            $data = $request->except('_token', 'avatar', 'wholesale', 'tags');
            $data['slug'] = Str::slug($request->name);
            $data['updated_at'] = Carbon::now();

            if ($request->avatar) {
                $file = upload_image('avatar');
                if (isset($file['code']) && $file['code'] == 1) $data['avatar'] = $file['name'];
            }

            Article::find($id)->update($data);
            $this->syncTags($request->tags, $id);
        } catch ( \Exception $exception ) {
            Log::error("ERROR => ArticleController@store => " . $exception->getMessage());
            toastr()->error('Xử lý thất bại', 'Thông báo');
            return redirect()->route('get_admin.article.update', $id);
        }

        toastr()->success('Xử lý thành công', 'Thông báo');
        return redirect()->route('get_admin.article.index');
    }

    public function delete(Request $request, $id)
    {
        try {
            $article = Article::findOrFail($id);
            if ($article) $article->delete();

        } catch ( \Exception $exception ) {
            Log::error("ERROR => ArticleController@delete => " . $exception->getMessage());
        }
        return redirect()->route('get_admin.article.index');
    }

    private function syncTags($tags, $idArticle)
    {
        if (!empty($tags)) {
            $datas = [];
            foreach ($tags as $key => $tag) {
                $datas[] = [
                    'article_id' => $idArticle,
                    'tag_id'     => $tag
                ];
            }

            \DB::table('articles_tags')->where('article_id', $idArticle)->delete();
            \DB::table('articles_tags')->insert($datas);
        }
    }
}
