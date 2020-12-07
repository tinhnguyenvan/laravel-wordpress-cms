<?php
/**
 * @author: nguyentinh
 * @create: 06/20/20, 8:21 PM
 */

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
use App\Services\ContactService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * Class ContactController.
 *
 * @property ContactService $contactService
 */
class ContactController extends AdminController
{
    public function __construct(ContactService $contactService)
    {
        parent::__construct();
        $this->contactService = $contactService;
    }

    public function index(Request $request)
    {
        $this->contactService->buildCondition($request->all(), $condition, $sortBy, $sortType);
        $items = Contact::query()->where($condition)->orderBy($sortBy, $sortType)->paginate($this->page_number);

        $data = [
            'items' => $items,
        ];

        return view('admin/contact/index', $this->render($data));
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function show($id)
    {
        $myObject = Contact::query()->findOrFail($id);

        $data = [
            'contact' => $myObject,
        ];

        return view('admin/contact/show', $this->render($data));
    }

    public function edit(Contact $contact)
    {
    }

    public function update(Request $request, Contact $contact)
    {
    }

    public function destroy(Contact $contact)
    {
    }

    /**
     * delete multi.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function destroyMulti(Request $request): RedirectResponse
    {
        $params = $request->all();

        if (!empty($params['ids'])) {
            $items = Contact::query()->whereIn('id', $params['ids'])->get();
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
