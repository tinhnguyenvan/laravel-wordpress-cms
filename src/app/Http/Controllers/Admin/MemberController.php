<?php
/**
 * @author: nguyentinh
 * @time: 10/29/19 4:05 PM
 */

namespace App\Http\Controllers\Admin;

use App\Models\Member;
use App\Models\MemberTag;
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
            'items' => $items,
            'filter' => $filter,
        ];

        return view('admin/member.index', $this->render($data));
    }

    public function setStatusExpert(Request $request, $id)
    {
        $member = Member::query()->findOrFail($id);

        if (!empty($member)) {
            if (Member::MEMBER_TYPE_NORMAL == $member->member_type) {
                $memberType = Member::MEMBER_TYPE_EXPERT;
            } else {
                $memberType = Member::MEMBER_TYPE_NORMAL;
            }

            Member::query()->where('id', $id)->update(['member_type' => $memberType]);
            $request->session()->flash('success', trans('common.edit.success'));
        } else {
            $request->session()->flash('error', trans('common.edit.error'));
        }

        return back();
    }

    public function tags($id)
    {
        $member = Member::query()->findOrFail($id);
        $tags = !empty($member->tags) ? json_decode($member->tags, true) : [];
        $typeItems = MemberTag::query()
            ->orderByRaw('CASE WHEN parent_id = 0 THEN id ELSE parent_id END, parent_id,id')
            ->get();

        $data = [
            'member' => $member,
            'typeItems' => $typeItems,
            'tags' => $tags,
            'title' => 'Update Tags'
        ];
        return view('admin/member.tags', $this->render($data));
    }

    public function putTags(Request $request, $id)
    {
        $member = Member::query()->findOrFail($id);
        $tags = $request->input('tags');

        if (!empty($member)) {
            if (!empty($tags)) {
                $tags = json_encode(array_keys($tags));
            }
            Member::query()->where('id', $id)->update(['tags' => $tags]);
            $request->session()->flash('success', trans('common.edit.success'));

            return redirect(admin_url('members'));
        } else {
            $request->session()->flash('error', trans('common.edit.error'));
        }

        return back();
    }
}
