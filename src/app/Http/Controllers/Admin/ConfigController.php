<?php
/**
 * @author: nguyentinh
 * @create: 11/18/19, 10:46 AM
 */

namespace App\Http\Controllers\Admin;

use App\Mail\ConfigMail;
use App\Models\Config;
use App\Models\RolePermission;
use App\Services\ConfigService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

/**
 * Class ConfigController.
 *
 * @property ConfigService $configService
 */
class ConfigController extends AdminController
{
    public function __construct(ConfigService $configService)
    {
        parent::__construct();
        $this->middleware(['permission:' . RolePermission::SETTING_SHOW]);
        $this->configService = $configService;
    }

    public function index(Request $request)
    {
        $config = $this->configService->getConfig();
        $tabs = [
            'general',
            'integrate',
            'mail',
            'seo',
            'system'
        ];
        $data = [
            'tabActive' => $request->get('tab', 'general'),
            'tabs' => $tabs,
            'config' => $config,
        ];

        return view('admin/config.index', $this->render($data));
    }

    public function save(Request $request)
    {
        $params = $request->all();
        $theme = 'default';
        if (!empty($params['_token'])) {
            if (empty($params['config_email_smtp_authentication'])) {
                $params['config_email_smtp_authentication'] = 'off';
            }

            if (empty($params['config_maintenance_website'])) {
                $params['config_maintenance_website'] = 'off';
            }

            if (empty($params['config_basic_auth'])) {
                $params['config_basic_auth'] = 'off';
            }

            foreach ($params as $key => $item) {
                if ('_token' == $key) {
                    continue;
                }

                if ('theme_active' == $key) {
                    $theme = $item;
                }

                $myConfig = Config::query()->where('name', $key)->first();
                if (empty($myConfig)) {
                    $myConfig = new Config();
                    $myConfig->creator_id = Auth::id();
                }

                $myConfig->editor_id = Auth::id();
                $myConfig->name = $key;
                $myConfig->value = $item;
                $myConfig->save();
            }

            $request->session()->flash('success', trans('common.edit.success'));
        }

        return back()->withInput()->withCookie('theme', $theme, config('constant.COOKIE_EXPIRED'), '/');
    }

    public function test(Request $request)
    {
        $params = $request->all();
        try {
            $message = null;

            if (empty($message) && empty($params['config_email_test_to'])) {
                $message = trans('config.test.config_email_test_to_is_required');
            }

            if (empty($message) && empty($params['config_email_test_subject'])) {
                $message = trans('config.test.config_email_test_subject_is_required');
            }

            if (empty($message) && empty($params['config_email_test_message'])) {
                $message = trans('config.test.config_email_test_message_is_required');
            }

            if (empty($message)) {
                Mail::send(new ConfigMail($params));
                $message = trans('config.test.sendmail_success');
            }
        } catch (Exception $e) {
            $message = $e->getMessage();
        }

        return response()->json(['message' => $message]);
    }
}
