<?php

namespace App\Http\Controllers\Site;

use App\Models\Comment;
use App\Services\CommentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

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
     * @return RedirectResponse
     */
    public function addComment(Request $request)
    {
        $params = $request->all();
        if (! empty($params['author_email'])) {
            $params['status'] = Comment::STATUS_NEW;
            $params['author_ip'] = $request->ip();
            $params['agent'] = $request->userAgent();
            $params['date'] = date('Y-m-d H:i:s');
            $result = $this->commentService->create($params);

            if (empty($result['message'])) {
                // push queue send mail
                //CommentJob::dispatch(['action' => CommentJob::ACTION_FORM, 'params' => $result->toArray()])->onQueue('admin');
                $request->session()->flash('success', trans('comment.add.success'));

                return back();
            } else {
                $request->session()->flash('error', $result['message']);
            }
        } else {
            $request->session()->flash('error', trans('comment.error.email_is_required'));
        }

        return back()->withInput();
    }
}
