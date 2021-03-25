<?php
/**
 * @author: nguyentinh
 * @time: 10/29/19 4:05 PM
 */

namespace App\Services;

use App\Mail\UserActive;
use App\Models\Config;
use App\Models\NavPosition;
use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

/**
 * Class UserService.
 *
 * @property User $model
 */
class UserService extends BaseService
{
    public function __construct(User $model)
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

        if (empty($params['id'])) {
            $validator = Validator::make(
                $params,
                [
                    'email' => 'required|min:5|max:255|unique:'.$this->model->getTable(),
                    'password' => 'required|min:1|max:255',
                ]
            );

            if ($validator->fails()) {
                static::convertErrorValidator($validator->errors()->toArray(), $error);
            }
        }

        return $error;
    }

    /**
     * @param $params
     *
     * @return array
     */
    public function auth($params)
    {
        $condition = [
            'email' => $params['email'],
            'password' => sha1($params['password']),
        ];

        $myObject = User::query()->where($condition)->first();

        if (!empty($myObject->id)) {
            $payload = [
                'iss' => env('APP_NAME'), // Issuer of the token
                'sub' => $data['id'] ?? time(), // Subject of the token
                'iat' => time(), // Time when JWT was issued.
                'exp' => time() + env('JWT_TOKEN_EXPIRED'), // Expiration time
                'data' => $myObject->toArray(),
            ];

            $token = JWT::encode($payload, env('JWT_SECRET'));

            return [
                'user_id' => $myObject->id,
                'fullname' => $myObject->name,
                'email' => $myObject->email,
                'token' => $token,
                'avatar' => '',
            ];
        }

        return [
            'message' => 'error_not_found_data',
        ];
    }

    public function beforeSave(&$formData = [], $isNews = false)
    {
        if (empty($formData['id']) && !empty($formData['password'])) {
            $formData['password'] = Hash::make($formData['password']);
        }
    }

    /**
     * @param $params
     *
     * @return User|array|int
     */
    public function create($params)
    {
        $validator = $this->validator($params);
        if (!empty($validator)) {
            return $this->responseValidator($validator);
        }

        $this->beforeSave($params);
        $myObject = new User($params);
        $params['status'] = User::STATUS_WAITING_ACTIVE;

        if ($myObject->save($params)) {
            $this->activeUser($myObject);

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
        $params['id'] = $id;
        $validator = $this->validator($params);
        if (!empty($validator)) {
            return $this->responseValidator($validator);
        }

        $this->beforeSave($params);

        return User::query()->findOrFail($id)->update($params);
    }

    /**
     * 1/ init menu website frontend.
     *
     * @param $template
     */
    public function initData($template = 'default')
    {
        // 1/ init menu website frontend
        $dataNav = @json_decode(file_get_contents(public_path('layout/'.$template.'/manifest.json')), true);
        if (!empty($dataNav['nav'])) {
            foreach ($dataNav['nav'] as $idNav => $value) {
                $myNavPosition = NavPosition::query()->where('theme', $template)->where('slug', $idNav)->first();

                if (empty($myNavPosition)) {
                    $myNavPosition = new NavPosition();
                }

                $myNavPosition->title = $value;
                $myNavPosition->theme = $template;
                $myNavPosition->slug = $idNav;
                $myNavPosition->save();
            }
        }
    }

    public function activeUser($myObject)
    {
        if (!empty($myObject->email_verified_at)) {
            return null;
        }

        $config = Config::query()->where('name', 'company_name')->first();
        Mail::send(
            new UserActive(
                [
                    'name' => $myObject->name,
                    'email' => $myObject->email,
                    'company_name' => $config->value ?? '',
                    'link_active' => $this->linkActive($myObject),
                ]
            )
        );
    }

    /**
     * @param $user
     *
     * @return string
     */
    public function linkActive($user)
    {
        return base_url('users/activemail?email='.$user->email.'&code='.sha1(base64_encode($user->id)));
    }
}
