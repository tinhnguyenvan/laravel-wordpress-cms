<?php

namespace App\Http\Controllers\Site;

use App\Models\Member;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\RolePermission;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use willvincent\Rateable\Rating;

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

    public function index(Request $request, $slugCategory = null)
    {
        $this->postService->buildCondition($request->all(), $condition, $sortBy, $sortType);

        $postCategory = PostCategory::query()->where('slug', $slugCategory)->first();
        if (!empty($postCategory->id)) {
            $items = $this->postService->getPostBySlugCategory($slugCategory, $request->all());
            PostCategory::query()->where('id', $postCategory->id)->increment('views');

            // set seo
            $this->seo($postCategory, $this->data);
        } else {
            $items = Post::active()->orderByDesc('id')->paginate($this->page_number);
            $this->data['title'] = $this->data['config']['company_name'];
        }

        // update view
        $data = [
            'postCategory' => $postCategory,
            'items' => $items,
            'slugCategory' => $slugCategory,
        ];

        return view($this->layout . 'post.index', $this->render($data));
    }

    public function view($slugCategory, $slugPost)
    {
        $post = Post::query()->whereTranslation('slug', $slugPost)->first();

        if (empty($post)) {
            return redirect(base_url('404.html'));
        }

        // rating
        if (Auth::guard(RolePermission::GUARD_NAME_WEB)->check()) {
            $rating = new Rating;
            $rating->rating = 3;
            $rating->member_id = auth(RolePermission::GUARD_NAME_WEB)->id();
            $post->ratings()->save($rating);
        }

        // update view
        Post::query()->where('id', $post->id)->increment('views');

        $items = Post::query()->where(['category_id' => $post->category_id])->orderByDesc('id')->paginate(
            $this->page_number
        );

        // check bookmark
        $isBookmark = 0;
        if (!empty(auth(RolePermission::GUARD_NAME_WEB)->check())) {
            $member = Member::query()->where('id', auth(RolePermission::GUARD_NAME_WEB)->id())->first();
            $isBookmark = $member->isBookmarked($post);
        }

        $data = [
            'title' => $post->title,
            'post' => $post,
            'isBookmark' => $isBookmark,
            'items' => $items,
        ];

        // set seo
        $this->seo($post, $this->data);

        return view($this->layout . 'post.view', $this->render($data));
    }

    public function show($slugPost)
    {
        $post = Post::query()->whereTranslation('slug', $slugPost)->first();

        if (empty($post)) {
            return redirect(base_url('404.html'));
        }

        // rating
        if (Auth::guard(RolePermission::GUARD_NAME_WEB)->check()) {
            $rating = new Rating;
            $rating->rating = 3;
            $rating->member_id = auth(RolePermission::GUARD_NAME_WEB)->id();
            $post->ratings()->save($rating);
        }

        // update view
        Post::query()->where('id', $post->id)->increment('views');

        $items = Post::query()->where(['category_id' => $post->category_id])->orderByDesc('id')->paginate(
            $this->page_number
        );

        // check bookmark
        $isBookmark = 0;
        if (!empty(auth(RolePermission::GUARD_NAME_WEB)->check())) {
            $member = Member::query()->where('id', auth(RolePermission::GUARD_NAME_WEB)->id())->first();
            $isBookmark = $member->isBookmarked($post);
        }

        $data = [
            'title' => $post->title,
            'post' => $post,
            'isBookmark' => $isBookmark,
            'items' => $items,
        ];

        // set seo
        $this->seo($post, $this->data);

        return view($this->layout . 'post.view', $this->render($data));
    }

    public function postBookmark(Request $request)
    {
        if (!auth(RolePermission::GUARD_NAME_WEB)->check()) {
            return redirect(base_url('member'));
        }

        $postId = $request->input('post_id');
        $object = Post::query()->where('id', $postId)->first();
        if (!empty($object->id)) {
            // bookmark
            $member = Member::query()->where('id', auth(RolePermission::GUARD_NAME_WEB)->id())->first();
            $member->bookmark($object); // bookmark or unbookmark
        }

        return back()->withInput();
    }
}
