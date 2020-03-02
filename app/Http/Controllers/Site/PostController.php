<?php

namespace App\Http\Controllers\Site;

use App\Models\Post;
use App\Models\PostCategory;
use App\Services\PostService;
use Illuminate\Http\Request;

/**
 * Class PostController.
 *
 * @property PostService $postService
 */
final class PostController extends SiteController
{
    public function __construct(PostService $postService)
    {
        parent::__construct();
        $this->postService = $postService;
    }

    public function index(Request $request, $slugCategory)
    {
        $this->postService->buildCondition($request->all(), $condition, $sortBy, $sortType);

        $items = $this->postService->getPostBySlugCategory($slugCategory, $request->all());

        $postCategory = PostCategory::query()->where('slug', $slugCategory)->first();

        $data = [
            'postCategory' => $postCategory,
            'items' => $items,
            'title' => $postCategory->title,
            'error' => session('error'),
        ];

        return view($this->layout.'post.index', $this->render($data));
    }

    public function view(Request $request, $slugCategory, $slugPost)
    {
        $post = Post::query()->where('slug', $slugPost)->first();

        if (empty($post)) {
            return redirect(base_url('404.html'));
        }

        Post::query()->increment('views');

        $items = Post::query()->where(['category_id' => $post->category_id])->orderByDesc('id')->paginate($this->page_number);

        $data = [
            'title' => $post->title,
            'post' => $post,
            'items' => $items,
        ];

        return view($this->layout.'post.view', $this->render($data));
    }
}
