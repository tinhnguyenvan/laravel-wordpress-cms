<?php

namespace App\Http\Controllers\Site;

use App\Models\Post;
use App\Models\PostTag;
use App\Services\PostService;

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

    public function index($slug)
    {
        $postTag = PostTag::query()->where('slug', $slug)->first();
        if (empty($postTag->id)) {
            return redirect(base_url('404.html'));
        }

        $itemPosts = Post::active()->where('tags', 'LIKE', '%' . $postTag->title . '%')->orderByDesc('id')->paginate(10);

        $data = [
            'postTag' => $postTag,
            'itemPosts' => $itemPosts,
            'title' => 'Tag: ' . $postTag->title . ' | ' . $this->data['title'],
        ];

        return view($this->layout . '.tag.index', $this->render($data));
    }
}
