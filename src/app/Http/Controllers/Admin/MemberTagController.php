<?php

namespace App\Http\Controllers\Admin;

use App\Models\MemberTag;
use App\Services\MemberTagService;
use Illuminate\Http\Request;

/**
 * class MemberTagController
 * @package App\Http\Controllers\Admin
 *
 * @property MemberTagService $memberTagService
 */
class MemberTagController extends AdminController
{
    public function __construct(MemberTagService $memberTagService)
    {
        parent::__construct();
        $this->memberTagService = $memberTagService;
    }

    public function index()
    {
        $items = MemberTag::query()->orderByRaw(
            'CASE WHEN parent_id = 0 THEN id ELSE parent_id END, parent_id,id'
        )->get();
        $data = [
            'items' => $items,
        ];

        return view('admin.member_tag/index', $this->render($data));
    }

    public function create()
    {
        $data = [
            'dropdown' => $this->memberTagService->dropdown(),
            'college_department' => new MemberTag(),
        ];

        return view('admin.member_tag/form', $this->render($data));
    }

    public function store(Request $request)
    {
        $params = $request->all();
        if (!empty($params['_token'])) {
            $result = $this->memberTagService->create($params);
            if (empty($result['message'])) {
                $request->session()->flash('success', trans('common.add.success'));

                return redirect(admin_url('member-tags/create?parent_id=' . $result['parent_id']), 302);
            } else {
                $request->session()->flash('error', $result['message']);
            }
        }

        return back()->withInput();
    }

    public function show($id)
    {
        return redirect(admin_url('member-tags/' . $id . '/edit'), 302);
    }

    public function edit($id)
    {
        $data = [
            'dropdown' => $this->memberTagService->dropdown(),
            'member_tag' => MemberTag::query()->findOrFail($id),
        ];

        return view('admin.member_tag/form', $this->render($data));
    }

    public function update(Request $request, $id)
    {
        $params = $request->all();
        if (!empty($params['_token'])) {
            $result = $this->memberTagService->update($id, $params);

            if (empty($result['message'])) {
                $request->session()->flash('success', trans('common.edit.success'));

                return redirect(admin_url('member-tags'), 302);
            } else {
                $request->session()->flash('error', $result['message']);
            }
        }

        return back()->withInput();
    }

    public function destroy(Request $request, $id)
    {
        $myObject = MemberTag::query()->findOrFail($id);
        $countChild = MemberTag::query()->where(['parent_id' => $id])->count();
        if (!empty($myObject->id) && 0 == $countChild) {
            MemberTag::destroy($id);
        }

        if ($countChild > 0) {
            $request->session()->flash('error', trans('common.delete.exist.child'));
        } else {
            $request->session()->flash('success', trans('common.delete.success'));
        }

        return redirect(admin_url('member-tags'));
    }
}
