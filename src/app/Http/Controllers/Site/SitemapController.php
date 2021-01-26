<?php

namespace App\Http\Controllers\Site;

use App\Models\Nav;
use App\Models\Post;
use App\Models\PostTag;
use Illuminate\Http\Request;

class SitemapController extends SiteController
{
    public function index(Request $r)
    {
        $navs = Nav::query()->get();
        $posts = Post::query()->orderBy('id', 'desc')->where('status', Post::STATUS_ACTIVE)->get();
        $tags = PostTag::query()->orderBy('id', 'desc')->where('source_id', '>', 0)->get();

        return response()->view('site/sitemap.index', compact('posts', 'tags', 'navs'))->header('Content-Type', 'text/xml');
    }
}
