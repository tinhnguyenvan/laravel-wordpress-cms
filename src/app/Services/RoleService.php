<?php
/**
 * @author: nguyentinh
 * @time: 10/29/19 4:05 PM
 */

namespace App\Services;

use App\Models\Role;

/**
 * Class RoleService.
 *
 * @property Role $model
 */
class RoleService extends BaseService
{
    public function __construct(Role $model)
    {
        parent::__construct();
        $this->model = $model;
    }

    /**
     * @param array $params
     *
     * @return array
     */
    public function validator($params = [])
    {
        $error = [];

        return $error;
    }

    /**
     * @return array
     */
    public function dropdown()
    {
        $data = Role::all();
        $html = [];
        if ($data->count() > 0) {
            foreach ($data as $key => $myRole) {
                /** @var mixed $myRole */
                $html[$myRole->id] = $myRole->description . ' [' . $myRole->name . ']';
            }
        }

        return $html;
    }
}
