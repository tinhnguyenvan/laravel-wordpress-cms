<?php
/**
 * @author: nguyentinh
 * @create: 2021-08-03, 10:46 AM
 */

namespace App\Http\Controllers\Admin;

use App\Models\NotificationSubject;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class NotificationController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $items = NotificationSubject::query()->paginate();

        $data = [
            'items' => $items,
            'title' => trans('common.list'),
        ];
        return view('admin.notification.index', $this->render($data));
    }

    public function create()
    {
        $data = [
            'notification' => new NotificationSubject(),
        ];

        return view('admin.notification.form', $this->render($data));
    }

    public function store(Request $request)
    {
        $params = $request->only(['title', 'content', 'status']);
        $result = NotificationSubject::query()->create($params);
        if (empty($result['message'])) {
            $request->session()->flash('success', trans('common.add.success'));
            return redirect(admin_url('notifications'), 302);
        } else {
            $request->session()->flash('error', $result['message']);
        }

        return back()->withInput();
    }

    public function edit($id)
    {
        $data = [
            'object' => NotificationSubject::query()->findOrFail($id),
        ];

        return view('admin.notification.form', $this->render($data));
    }

    /**
     * @param  Request  $request
     * @param $id
     *
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $params = $request->only(['title', 'content', 'status']);

        if (NotificationSubject::query()->where('id', $id)->update($params)) {
            $request->session()->flash('success', trans('common.edit.success'));
            return redirect(admin_url('notifications'), 302);
        } else {
            $request->session()->flash('error', trans('common.edit.error'));
        }

        return back()->withInput();
    }

    public function destroy(Request $request, $id)
    {
        $myObject = NotificationSubject::query()->findOrFail($id);
        if (!empty($myObject->id)) {
            NotificationSubject::destroy($id);
            $request->session()->flash('success', trans('common.delete.success'));
        } else {
            $request->session()->flash('error', trans('common.delete.error'));
        }

        return redirect(admin_url('notifications'));
    }
}
