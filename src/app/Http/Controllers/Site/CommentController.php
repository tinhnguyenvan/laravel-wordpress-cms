<?php

namespace App\Http\Controllers\Site;

use App\Models\Comment;
use App\Models\Post;
use App\Models\RolePermission;
use TinhPHP\School\Models\School;
use App\Services\CommentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use willvincent\Rateable\Rating;

/**
 * Class CommentController.
 *
 * @property CommentService $commentService
 */
final class CommentController extends SiteController
{
    public function __construct(CommentService $commentService)
    {
        parent::__construct();
        $this->commentService = $commentService;
    }

    /**
     * @description
     *  - form Comment.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function addComment(Request $request)
    {
        $params = $request->all();
        if (!empty($params['author_email'])) {
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
                //CommentJob::dispatch(['action' => CommentJob::ACTION_FORM, 'params' => $result->toArray()]);
                $request->session()->flash('success', trans('comment.add.success'));

                // rating
                $objectRating = null;
                if ($comment['type'] == Comment::TYPE_POST) {
                    $objectRating = Post::query()->where('id', $params['post_id'])->first();
                }

                if ($comment['type'] == Comment::TYPE_SCHOOL) {
                    $objectRating = School::query()->where('id', $params['post_id'])->first();
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
        } else {
            $request->session()->flash('error', trans('comment.error.email_is_required'));
        }

        return back()->withInput();
    }
}
