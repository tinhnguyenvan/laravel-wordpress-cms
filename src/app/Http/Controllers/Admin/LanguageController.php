<?php
/**
 * @author: nguyentinh
 * @create: 11/18/19, 10:46 AM
 */

namespace App\Http\Controllers\Admin;

use App\Models\Language;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

/**
 * Class LanguageController.
 *
 */
class LanguageController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $items = Language::query()->get();
        if ($items->count() == 0) {
            Language::createDefault();
            return redirect(admin_url('languages'));
        }

        $data = [
            'items' => $items,
            'title' => trans('common.list'),
        ];
        return view('admin.language.index', $this->render($data));
    }

    public function create()
    {
        $data = [
            'language' => new Language(),
        ];

        return view('admin.language.form', $this->render($data));
    }

    public function store(Request $request)
    {
        $params = $request->only(['name', 'code', 'status']);
        $result = Language::query()->create($params);
        if (empty($result['message'])) {
            $request->session()->flash('success', trans('common.add.success'));
            Cache::put('language_content_system', []);
            return redirect(admin_url('languages'), 302);
        } else {
            $request->session()->flash('error', $result['message']);
        }

        return back()->withInput();
    }

    public function edit($id)
    {
        $data = [
            'language' => Language::query()->findOrFail($id),
        ];

        return view('admin.language.form', $this->render($data));
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

        if (Language::query()->where('id', $id)->update($params)) {
            $request->session()->flash('success', trans('common.edit.success'));
            Cache::put('language_content_system', []);
            return redirect(admin_url('languages'), 302);
        } else {
            $request->session()->flash('error', trans('common.edit.error'));
        }

        return back()->withInput();
    }

    public function destroy(Request $request, $id)
    {
        $myObject = Language::query()->findOrFail($id);
        if (!empty($myObject->id)) {
            Language::destroy($id);
            Cache::put('language_content_system', []);
            $request->session()->flash('success', trans('common.delete.success'));
        } else {
            $request->session()->flash('error', trans('common.delete.error'));
        }

        return redirect(admin_url('languages'));
    }
}
