<?php

namespace App\Http\Controllers\Site;

use App\Jobs\ContactJob;
use App\Models\Contact;
use App\Services\ContactFormService;
use App\Services\ContactService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * Class ContactController.
 *
 * @property ContactService     $contactService
 * @property ContactFormService $contactFormService
 */
final class ContactController extends SiteController
{
    public function __construct(ContactService $contactService, ContactFormService $contactFormService)
    {
        parent::__construct();
        $this->contactService = $contactService;
        $this->contactFormService = $contactFormService;
    }

    /**
     * @description
     *  - dang ky nhan mail
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function registerEmail(Request $request)
    {
        $params = $request->only('email');
        if (!empty($params['email'])) {
            $myObject = Contact::query()->where('email', $params['email'])->first();

            if (!empty($myObject->id)) {
                $request->session()->flash('error', trans('contact.error.add.exist'));
            } else {
                $params['fullname'] = trans('contact.fullname_register_email');
                $result = $this->contactService->create($params);
                if (empty($result['message'])) {
                    // push queue send mail
                    ContactJob::dispatch(['action' => ContactJob::ACTION_REGISTER, 'email' => $params['email']]);
                    $request->session()->flash('success', trans('contact.add.success'));
                } else {
                    $request->session()->flash('error', $result['message']);
                }
            }
        } else {
            $request->session()->flash('error', trans('contact.error.email_is_required'));
        }

        return back()->withInput();
    }

    /**
     * @description
     *  - form contact.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function addContact(Request $request)
    {
        $params = $request->all();
        if (!empty($params['form_email'])) {
            $insertData['fullname'] = $params['form_fullname'] ?? '';
            $insertData['phone'] = $params['form_phone'] ?? '';
            $insertData['email'] = $params['form_email'] ?? '';
            $insertData['request_title'] = $params['form_title'] ?? '';
            $insertData['request_content_form'] = $params['form_content'] ?? '';
            $insertData['contact_form_id'] = 1;

            $result = $this->contactService->create($insertData);

            if (empty($result['message'])) {
                // push queue send mail
                ContactJob::dispatch(['action' => ContactJob::ACTION_FORM, 'params' => $result->toArray()]);
                $request->session()->flash('success', trans('contact.add.success'));

                return back();
            } else {
                $request->session()->flash('error', $result['message']);
            }
        } else {
            $request->session()->flash('error', trans('contact.error.email_is_required'));
        }

        return back()->withInput();
    }
    /**
     * @description
     *  - form contact.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function addContactAjax(Request $request)
    {
        $params = $request->all();
        if (!empty($params['form_email'])) {
            $insertData['fullname'] = $params['form_fullname'] ?? '';
            $insertData['phone'] = $params['form_phone'] ?? '';
            $insertData['email'] = $params['form_email'] ?? '';
            $insertData['request_title'] = $params['form_title'] ?? '';
            $insertData['request_content_form'] = $params['form_content'] ?? '';
            $insertData['contact_form_id'] = 1;

            $result = $this->contactService->create($insertData);

            if (empty($result['message'])) {
                // push queue send mail
                ContactJob::dispatch(['action' => ContactJob::ACTION_FORM, 'params' => $result->toArray()]);
                $message = trans('contact.add.success');

            } else {
                $message =  $result['message'];
            }
        } else {
            $message = trans('contact.error.email_is_required');
        }

        return $message;
    }
}
