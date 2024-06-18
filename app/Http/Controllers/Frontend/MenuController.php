<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Menu;
use App\Models\Tag;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function getListsArticle($slug, $id)
    {
        $menu = Menu::where('id', $id)->first();
        if (!$menu) {
            return abort(404);
        }

        $articles = Article::where('menu_id', $id)
            ->orderByDesc('id')
            ->paginate(10);

        $articleNew = Article::orderByDesc('id')
            ->limit(5)->get();

        $tags = Tag::all();

        $viewData = [
            'articles'   => $articles,
            'articleNew' => $articleNew,
            'menu'       => $menu,
            'tags'       => $tags,
        ];

        return view('frontend.blog.index', $viewData);
    }
}
