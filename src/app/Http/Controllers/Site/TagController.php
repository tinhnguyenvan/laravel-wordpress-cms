<?php

namespace App\Http\Controllers\Site;

use App\Models\Post;
use App\Models\PostTag;
use App\Models\Product;
use App\Services\PostService;
use Illuminate\Http\Request;

/**
 * Class TagController.
 *
 * @property PostService $postService
 */
final class TagController extends SiteController
{
    public function __construct(PostService $postService)
    {
        parent::__construct();
        $this->postService = $postService;
    }

    public function index(Request $request, $slug)
    {
        $itemPosts = Post::query()->where(['status' => Post::STATUS_ACTIVE])->orderByDesc('id')->get()->take(10);
        $itemProducts = Product::query()->where(['status' => Product::STATUS_ACTIVE])->orderByDesc('id')->get()->take(10);

        $postTag = PostTag::query()->where('slug', $slug)->first();

        $data = [
            'postTag' => $postTag,
            'itemPosts' => $itemPosts,
            'itemProducts' => $itemProducts,
            'title' => 'Tag: ' . $postTag->title,
        ];

        return view($this->layout . 'tag.index', $this->render($data));
    }
}
