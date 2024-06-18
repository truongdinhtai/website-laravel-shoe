<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\PageStatic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PageStaticController extends Controller
{
    public function about(Request $request)
    {
        $url = \Request::url();
        $url = replace_url($url);
        if (!$url) $url = '/';

        $pageContent = $this->renderContent($url);
        return view('frontend.static.about', compact('pageContent'));
    }

    public function policy(Request $request)
    {
        $url = \Request::url();
        $url = replace_url($url);
        if (!$url) $url = '/';

        $pageContent = $this->renderContent($url);

        return view('frontend.static.policy', compact('pageContent'));
    }

    protected function renderContent($url)
    {
        return Page::where('url', $url)->first();
    }
}
