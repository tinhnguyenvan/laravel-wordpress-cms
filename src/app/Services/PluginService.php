<?php
/**
 * @author: nguyentinh
 * @create: 11/20/19, 8:21 PM
 */

namespace App\Services;

use App\Models\Plugin;

/**
 * Class PluginService.
 *
 * @property Plugin $model
 */
class PluginService extends BaseService
{
    public function __construct(Plugin $model)
    {
        parent::__construct();
        $this->model = $model;
    }
}
