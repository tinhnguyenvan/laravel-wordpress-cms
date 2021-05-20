<?php
/**
 * @author: nguyentinh
 * @create: 11/18/19, 10:46 AM
 */

namespace App\Http\Controllers\Admin;

use App\Models\Comment;
use App\Models\RolePermission;
use App\Services\CommentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

/**
 * Class CommentController.
 *
 * @property CommentService $commentService
 */
class CommentController extends AdminController
{
    public function __construct(CommentService $commentService)
    {
        parent::__construct();
        $this->middleware(['permission:' . RolePermission::COMMENT_SHOW]);
        $this->commentService = $commentService;
    }

    public function index(Request $request)
    {
        $this->commentService->buildCondition($request->all(), $condition, $sortBy, $sortType);
        $items = Comment::query()->where($condition)->orderBy($sortBy, $sortType)->paginate($this->page_number);
        $filter = $this->commentService->filter($request->all());
        $data = [
            'title' => trans('common.list'),
            'items' => $items,
            'filter' => $filter,
        ];

        return view('admin/comment.index', $this->render($data));
    }

    public function create()
    {
        $data = [];

        return view('admin/comment.form', $this->render($data));
    }

    public function store(Request $request)
    {
        $params = $request->all();
        if (!empty($params['_token'])) {
            $result = $this->commentService->create($params);
            if (empty($result['message'])) {
                $request->session()->flash('success', trans('common.add.success'));

                return redirect(admin_url('comments'), 302);
            } else {
                $request->session()->flash('error', $result['message']);
            }
        }

        return back()->withInput();
    }

    public function show($id)
    {
        return redirect(admin_url('comments/' . $id . '/edit'), 302);
    }

    public function edit($id)
    {
        $data = [
            'comment' => Comment::query()->findOrFail($id),
        ];

        return view('admin/comment.form', $this->render($data));
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request, $id)
    {
        $params = $request->all();
        if (!empty($params['_token'])) {
            $result = $this->commentService->update($id, $params);

            if (empty($result['message'])) {
                $request->session()->flash('success', trans('common.edit.success'));

                return redirect(admin_url('comments'), 302);
            } else {
                $request->session()->flash('error', $result['message']);
            }
        }

        return back()->withInput();
    }

    public function status(Request $request, $id)
    {
        $myObject = Comment::query()->findOrFail($id);
        $status = $request['status'];
        $myObject->status = $status;
        $myObject->save();

        $request->session()->flash('success', trans('comment.update_status_success'));

        return back();
    }

    public function destroy(Request $request, $id)
    {
        $myObject = Comment::query()->findOrFail($id);

        if (!empty($myObject->id)) {
            Comment::destroy($id);
        }

        $request->session()->flash('success', trans('common.delete.success'));

        return redirect(admin_url('comments'));
    }

    /**
     * delete multi.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function putStatus(Request $request)
    {
        $params = $request->all();
        $buttonType = $params['button_type'];
        if (!empty($params['ids'])) {
            $items = Comment::query()->whereIn('id', $params['ids'])->get();
            foreach ($items as $item) {
                if ($buttonType == 0) {
                    $item->delete();
                } else {
                    $item->status = $buttonType;
                    $item->save();
                }
            }
            $request->session()->flash('success', trans('common.approved.success'));
        } else {
            $request->session()->flash('error', trans('common.error_check_ids'));
        }

        return back();
    }

    /**
     * delete multi.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function destroyMulti(Request $request)
    {
        $params = $request->all();

        if (!empty($params['ids'])) {
            $items = Comment::query()->whereIn('id', $params['ids'])->get();
            foreach ($items as $item) {
                $item->delete();
            }
            $request->session()->flash('success', trans('common.delete.success'));
        } else {
            $request->session()->flash('error', trans('common.error_check_ids'));
        }

        return back();
    }
}
