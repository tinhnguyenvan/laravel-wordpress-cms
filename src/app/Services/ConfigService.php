<?php
/**
 * @author: nguyentinh
 * @create: 11/20/19, 8:21 PM
 */

namespace App\Services;

use App\Models\Config;
use Illuminate\Support\Facades\Validator;

/**
 * Class ConfigService.
 *
 * @property Config $model
 */
class ConfigService extends BaseService
{
    public function __construct(Config $model)
    {
        parent::__construct();
        $this->model = $model;
    }

    /**
     * @param $params
     *
     * @return array
     */
    public function validator($params)
    {
        $error = [];

        $validator = Validator::make($params, [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            static::convertErrorValidator($validator->errors()->toArray(), $error);
        }

        return $error;
    }

    public function beforeSave(&$formData = [], $isNews = false)
    {
        $auth = session('auth');
        $formData['user_id'] = $auth['id'] ?? 0;
    }

    /**
     * @param $params
     *
     * @return object|array|bool
     */
    public function create($params)
    {
        $validator = $this->validator($params);
        if (!empty($validator)) {
            return $this->responseValidator($validator);
        }

        $this->beforeSave($params);
        $myObject = new Config($params);

        if ($myObject->save($params)) {
            return $myObject;
        }

        return 0;
    }

    /**
     * @param $id
     * @param $params
     *
     * @return array|bool
     */
    public function update($id, $params)
    {
        $validator = $this->validator($params);
        if (!empty($validator)) {
            return $this->responseValidator($validator);
        }

        $this->beforeSave($params);

        return Config::query()->findOrFail($id)->update($params);
    }

    public static function getValue($name)
    {
        $myConfig = Config::query()->where('name', $name)->first('value');

        return $myConfig->value ?? '';
    }

    public static function getConfig()
    {
        $items = Config::all()->sortByDesc('id');

        $config = [];
        if (!empty($items)) {
            $items = $items->toArray();
            $config = array_column($items, 'value', 'name');
        }

        return $config;
    }
}
