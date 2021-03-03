<?php
/**
 * @author: nguyentinh
 * @time: 10/29/19 4:05 PM
 */

namespace App\Http\Controllers\Admin;

use App\Models\Member;
use App\Services\MemberService;
use Illuminate\Http\Request;

/**
 * Class MemberController.
 *
 * @property MemberService $memberService
 */
class MemberController extends AdminController
{
    public function __construct(MemberService $memberServices)
    {
        parent::__construct();

        $this->memberService = $memberServices;
    }

    public function index(Request $request)
    {
        $this->memberService->buildCondition($request->all(), $condition, $sortBy, $sortType);
        $items = Member::query()->where($condition)->orderBy($sortBy, $sortType)->paginate($this->page_number);
        $filter = $this->memberService->filter($request->all());
        $data = [
            'title' => trans('nav.menu_left.member_list'),
            'items' => $items,
            'filter' => $filter,
        ];

        return view('admin/member.index', $this->render($data));
    }
}
