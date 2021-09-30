<?php

namespace App\Http\Controllers\Site;

use App\Jobs\CommentJob;
use App\Models\Comment;
use App\Models\Post;
use App\Models\RolePermission;
use Illuminate\Support\Facades\URL;
use App\Services\CommentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use willvincent\Rateable\Rating;
use Illuminate\Support\Facades\Validator;

/**
 * @property CommentService $commentService
 */
final class CommentController extends SiteController
{
    public function __construct(CommentService $commentService)
    {
        parent::__construct();
        $this->commentService = $commentService;

        $this->redirect = URL::previous() . '#box-comment';
    }

    /**
     * @description
     *  - form Comment.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function addComment(Request $request): RedirectResponse
    {
        $params = $request->all();

        $rules = [
            'author_email' => 'required|min:5|max:255',
            'author' => 'required|min:5|max:255',
            'post_id' => 'required',
            'type' => 'required',
        ];

        if (config('services.recaptcha.enable')) {
            $rules['g-recaptcha-response'] = 'required|min:5|recaptcha';
        }
        $validator = Validator::make($params, $rules);

        if ($validator->fails()) {
            return redirect($params['redirect'])->withInput()->withErrors($validator);
        }

        $params['status'] = Comment::STATUS_NEW;
        $params['parent'] = $params['comment_id'] ?? 0;
        $params['author_ip'] = $request->ip();
        $params['agent'] = $request->userAgent();
        $params['date'] = date('Y-m-d H:i:s');
        if (empty($params['author'])) {
            $params['author'] = auth('web')->user()->first_name;
        }
        $comment = $this->commentService->create($params);

        if (empty($comment['message'])) {
            // push queue send mail
            CommentJob::dispatch(['comment_id' => $comment->id]);
            $request->session()->flash('success', trans('comment.add.success'));

            // rating
            $objectRating = null;
            if ($comment['type'] == Comment::TYPE_POST) {
                $objectRating = Post::query()->where('id', $params['post_id'])->first();
            }

            if (!empty(auth(RolePermission::GUARD_NAME_WEB)->id()) && $objectRating) {
                $rating = new Rating();
                $rating->rating = $params['rating'] ?? 0;
                $rating->rateable_id = $params['post_id'] ?? 0;
                $rating->member_id = auth(RolePermission::GUARD_NAME_WEB)->id() ?? 0;
                $objectRating->ratings()->save($rating);

                // update comment rating_id
                $comment->rating_id = $rating->id;
                $comment->save();
            }

            return back();
        } else {
            $request->session()->flash('error', $comment['message']);
        }


        return back()->withInput();
    }
}
