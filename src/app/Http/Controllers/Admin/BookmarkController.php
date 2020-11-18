<?php
/**
 * @author: nguyentinh
 * @create: 11/18/19, 10:46 AM
 */

namespace App\Http\Controllers\Admin;

use App\Models\Bookmark;
use App\Models\RolePermission;
use App\Services\BookmarkService;
use Illuminate\Http\Request;

/**
 * Class BookmarkController.
 *
 * @property BookmarkService $bookmarkService
 */
class BookmarkController extends AdminController
{
    public function __construct(BookmarkService $bookmarkService)
    {
        parent::__construct();
        $this->middleware(['permission:' . RolePermission::POST_SHOW]);
        $this->bookmarkService = $bookmarkService;
    }

    public function index(Request $request)
    {
        $this->bookmarkService->buildCondition($request->all(), $condition, $sortBy, $sortType);
        $items = Bookmark::query()->where($condition)->orderBy($sortBy, $sortType)->paginate($this->page_number);
        $filter = $this->bookmarkService->filter($request->all());
        $data = [
            'title' => trans('common.list'),
            'items' => $items,
            'filter' => $filter,
        ];

        return view('admin/bookmark.index', $this->render($data));
    }

    public function destroy(Request $request, $id)
    {
        $myObject = Bookmark::query()->findOrFail($id);

        if (!empty($myObject->id)) {
            Bookmark::destroy($id);
        }

        $request->session()->flash('success', trans('common.delete.success'));

        return redirect(admin_url('bookmarks'));
    }
}
