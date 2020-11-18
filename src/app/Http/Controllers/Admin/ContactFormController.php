<?php
/**
 * @author: nguyentinh
 * @create: 06/20/20, 8:21 PM
 */

namespace App\Http\Controllers\Admin;

use App\Models\ContactForm;
use App\Models\RolePermission;
use App\Services\ContactFormService;
use Illuminate\Http\Request;

/**
 * Class ContactFormController.
 *
 * @property ContactFormService $contactFormService
 */
class ContactFormController extends AdminController
{
    public function __construct(ContactFormService $contactFormService)
    {
        parent::__construct();
        $this->middleware(['permission:' . RolePermission::SETTING_SHOW]);
        $this->contactFormService = $contactFormService;
    }

    public function index(Request $request)
    {
        return redirect(admin_url('contact_forms/' . config('constant.CONTACT_FORM_ID') . '/edit'));
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function show(ContactForm $contact)
    {
    }

    public function edit($id)
    {
        $myObject = ContactForm::query()->findOrFail($id);
        $contact_form = !empty($myObject->content) ? json_decode($myObject->content, true) : null;
        $contact_form['id'] = $id;

        $data = [
            'contact_form' => (object) $contact_form,
        ];

        return view('admin/contact_form/form', $this->render($data));
    }

    public function update(Request $request, $id)
    {
        $params = $request->all();
        unset($params['_token'], $params['_method']);

        $myObject = ContactForm::query()->findOrFail($id);

        $myObject->content = json_encode($params);
        $myObject->save();
        $request->session()->flash('success', trans('common.edit.success'));

        return redirect(admin_url('contact_forms/' . $id . '/edit'));
    }

    public function destroy(ContactForm $contact)
    {
    }
}
