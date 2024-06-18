<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Tag;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request, $slug, $id)
    {
        $article = Article::with('tags')->find($id);
        $articleNew = Article::orderByDesc('id')
            ->limit(5)->get();

        $viewData = [
            'article'    => $article,
            'articleNew' => $articleNew
        ];

        return view('frontend.article.index', $viewData);

    }

    public function tagDetail(Request $request, $slug, $id)
    {
        $tag = Tag::where('id', $id)->first();
        if (!$tag) return abort(404);

        $articles = Article::whereHas('tags', function ($query) use ($tag) {
            $query->where('tag_id', $tag->id);
        })
            ->orderByDesc('id')
            ->paginate(10);

        $articleNew = Article::orderByDesc('id')
            ->limit(5)->get();
        $tags = Tag::all();

        $viewData = [
            'articles'   => $articles,
            'articleNew' => $articleNew,
            'tags'       => $tags
        ];

        return view('frontend.blog.index', $viewData);
    }
}
