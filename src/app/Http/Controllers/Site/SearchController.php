<?php

namespace App\Http\Controllers\Site;

use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\Request;

/**
 * Class SearchController.
 *
 * @property PostService $postService
 */
final class SearchController extends SiteController
{
    public function __construct(PostService $postService)
    {
        parent::__construct();
        $this->postService = $postService;
    }

    public function index(Request $request)
    {
        $params = $request->only('s');
        $itemPosts = $itemProducts = null;

        if (!empty($params['s'])) {
            $keyword = $params['s'];
            $itemPosts = Post::active()->whereTranslationLike('title', '%' . $keyword . '%')->orderByDesc('id')->paginate(10);
        }

        $data = [
            'itemPosts' => $itemPosts,
            'title' => trans('common.search'),
        ];

        $view = 'index';
        if ($request->get('type') == 'product') {
            $view = 'product';
        }

        return view($this->layout . '.search.' . $view, $this->render($data));
    }
}
