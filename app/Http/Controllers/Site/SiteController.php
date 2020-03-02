<?php

namespace App\Http\Controllers\Site;

use App\Services\ConfigService;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;

/**
 * Class SiteController.
 */
class SiteController
{
    protected $data;

    public $theme;
    public $layout;
    public $page_number;

    public function __construct()
    {
        $this->data['config'] = ConfigService::getConfig();
        $this->theme = $this->data['config']['theme_active'];
        $this->layout = 'layout/'.$this->theme.'/';

        // check maintenance
        $this->isMaintenance($this->data['config']);

        $this->data['title'] = $this->data['config']['seo_title'] ?? 'Home';
        $this->data['description'] = $this->data['config']['seo_description'] ?? 'Home';
        $this->data['keyword'] = $this->data['config']['seo_keyword'] ?? 'Home';

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
        if (! empty($config['config_maintenance_website'])
            && 'on' == $config['config_maintenance_website']
            && 'maintenance' != Request::segment(1)
        ) {
            Redirect::to(base_url('maintenance'))->send();
        }
    }
}
