<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Services\ConfigService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;

/**
 * Class SiteController.
 */
class SiteController extends Controller
{
    protected $data;

    public $theme;
    public $layout;
    public $page_number;

    public function __construct()
    {
        $this->data['config'] = ConfigService::getConfig();
        $this->theme = $this->data['config']['theme_active'] ?? 'default';
        $this->layout = 'layout/' . $this->theme . '/';

        // check basic auth
        $this->isBasicAuth($this->data['config']);

        // check maintenance
        $this->isMaintenance($this->data['config']);

        $this->data['title'] = $this->data['config']['seo_title'] ?? 'Home';
        $this->data['description'] = $this->data['config']['seo_description'] ?? 'Home';
        $this->data['keyword'] = $this->data['config']['seo_keyword'] ?? 'Home';
        $this->data['og_image'] = $this->data['config']['logo'] ?? '';
        $manifest = @json_decode(file_get_contents(public_path('layout/' . $this->theme . '/manifest.json')), true);
        $this->data['manifest'] = $manifest;
        $this->page_number = config('constant.PAGE_NUMBER');
    }

    public function render($data)
    {
        $this->data['success'] = session('success');
        $this->data['error'] = session('error');
        $this->data['theme'] = $this->theme;

        return array_merge($this->data, $data);
    }

    private function isMaintenance($config)
    {
        if (!empty($config['config_maintenance_website'])
            && 'on' == $config['config_maintenance_website']
            && 'maintenance' != Request::segment(1)
        ) {
            Redirect::to(base_url('maintenance'))->send();
        }
    }

    private function isBasicAuth($config)
    {
        if (!empty($config['config_basic_auth']) && 'on' == $config['config_basic_auth']) {
            Auth::onceBasic();
        }
    }

    public function seo($object, &$data = []) {
        $data['title'] = $object->seo_title ?: $data['config']['seo_title'];
        $data['description'] = $object->seo_description ?: $data['config']['seo_description'];
        $data['keyword'] = $object->tags ?: $data['config']['seo_keyword'];
        $data['og_image'] = $object->full_image_url ?: $data['config']['logo'];
    }
}
