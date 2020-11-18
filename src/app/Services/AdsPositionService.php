<?php
/**
 * @author: nguyentinh
 * @create: 11/20/19, 8:21 PM
 */

namespace App\Services;

/**
 * Class AdsPositionService.
 */
class AdsPositionService extends BaseService
{
    public function __construct()
    {
        parent::__construct();
    }

    public function dropdown($template = 'default')
    {
        $html = [];
        $dataNav = json_decode(file_get_contents(public_path('layout/' . $template . '/manifest.json')), true);
        if (!empty($dataNav['banner_position'])) {
            foreach ($dataNav['banner_position'] as $code => $value) {
                $html[$code] = $value;
            }
        }

        return $html;
    }
}
