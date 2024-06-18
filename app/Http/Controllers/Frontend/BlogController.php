<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Tag;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $articles = Article::orderByDesc('id')
            ->paginate(20);

        $articlesNew = Article::orderByDesc('id')->limit(4)->get();

        $tags = Tag::all();

        $viewData = [
            'articles'    => $articles,
            'articlesNew' => $articlesNew,
            'tags'        => $tags
        ];

        return view('frontend.blog.index', $viewData);
    }
}
