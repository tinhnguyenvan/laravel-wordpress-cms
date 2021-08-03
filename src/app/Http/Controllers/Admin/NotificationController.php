<?php
/**
 * @author: nguyentinh
 * @create: 2021-08-03, 10:46 AM
 */

namespace App\Http\Controllers\Admin;

use App\Models\Notification;
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
        $items = Notification::query()->paginate();

        $data = [
            'items' => $items,
            'title' => trans('common.list'),
        ];
        return view('admin.notification.index', $this->render($data));
    }

    public function create()
    {
        $data = [
            'notification' => new Notification(),
        ];

        return view('admin.notification.form', $this->render($data));
    }

    public function store(Request $request)
    {
        $params = $request->only(['name', 'code', 'status']);
        $result = Notification::query()->create($params);
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
            'notification' => Notification::query()->findOrFail($id),
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
        $params = $request->only(['name', 'code', 'status']);

        if (Notification::query()->where('id', $id)->update($params)) {
            $request->session()->flash('success', trans('common.edit.success'));
            return redirect(admin_url('notifications'), 302);
        } else {
            $request->session()->flash('error', trans('common.edit.error'));
        }

        return back()->withInput();
    }

    public function destroy(Request $request, $id)
    {
        $myObject = Notification::query()->findOrFail($id);
        if (!empty($myObject->id)) {
            Notification::destroy($id);
            $request->session()->flash('success', trans('common.delete.success'));
        } else {
            $request->session()->flash('error', trans('common.delete.error'));
        }

        return redirect(admin_url('notifications'));
    }
}
