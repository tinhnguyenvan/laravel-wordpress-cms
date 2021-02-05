<?php
/**
 * @author: nguyentinh
 * @create: 11/18/19, 10:46 AM
 */

namespace App\Http\Controllers\Admin;

use App\Models\Ads;
use App\Models\Media;
use App\Services\AdsPositionService;
use App\Services\AdsService;
use App\Services\MediaService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

/**
 * Class AdsController.
 *
 * @property AdsService $adsService
 * @property AdsPositionService $adsPositionService
 * @property MediaService $mediaService
 */
class AdsController extends AdminController
{
    public function __construct(
        AdsService $adsService,
        AdsPositionService $adsPositionService,
        MediaService $mediaService
    ) {
        parent::__construct();
        $this->mediaService = $mediaService;
        $this->adsService = $adsService;
        $this->adsPositionService = $adsPositionService;
    }

    public function index(Request $request)
    {
        $this->adsService->buildCondition($request->all(), $condition, $sortBy, $sortType);
        $items = Ads::query()->where($condition)->orderBy($sortBy, $sortType)->paginate($this->page_number);

        $filter = $this->adsService->filter($request->all());
        $data = [
            'filter' => $filter,
            'items' => $items,
            'title' => trans('common.nav.ads'),
        ];

        return view('admin/ads.index', $this->render($data));
    }

    public function create()
    {
        $data = [
            'dropdownPosition' => $this->adsPositionService->dropdown($this->data['theme']),
            'ads' => new Ads(),
        ];

        return view('admin/ads.form', $this->render($data));
    }

    public function store(Request $request)
    {
        $params = $request->all();
        if (!empty($params['_token'])) {
            $result = $this->adsService->create($params);
            if (empty($result['message'])) {
                $this->mediaService->uploadModule(
                    [
                        'file' => $request->file('file'),
                        'object_type' => Media::OBJECT_TYPE_ADS,
                        'object_id' => $result['id'],
                        'is_full' => 1
                    ]
                );

                $request->session()->flash('success', trans('common.add.success'));

                return redirect(admin_url('ads'), 302);
            } else {
                $request->session()->flash('error', $result['message']);
            }
        }

        return back()->withInput();
    }

    public function show($id)
    {
        return redirect(admin_url('ads/' . $id . '/edit'), 302);
    }

    public function edit($id)
    {
        $data = [
            'dropdownPosition' => $this->adsPositionService->dropdown($this->data['theme']),
            'ads' => Ads::query()->findOrFail($id),
        ];

        return view('admin/ads.form', $this->render($data));
    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request, $id)
    {
        $params = $request->all();
        if (!empty($params['_token'])) {
            // remove image
            if (!empty($params['file_remove'])) {
                $params['image_id'] = 0;
                $params['image_url'] = '';
            }

            $result = $this->adsService->update($id, $params);

            if (empty($result['message'])) {
                $this->mediaService->uploadModule(
                    [
                        'file' => $request->file('file'),
                        'object_type' => Media::OBJECT_TYPE_ADS,
                        'object_id' => $id,
                        'is_full' => 1
                    ]
                );

                $request->session()->flash('success', trans('common.edit.success'));

                return redirect(admin_url('ads'));
            } else {
                $request->session()->flash('error', $result['message']);
            }
        }

        return back()->withInput();
    }

    public function destroy(Request $request, $id)
    {
        $myObject = Ads::query()->findOrFail($id);

        if (!empty($myObject->id)) {
            Ads::destroy($id);
        }

        $request->session()->flash('success', trans('common.delete.success'));

        return redirect(admin_url('ads'));
    }
}
