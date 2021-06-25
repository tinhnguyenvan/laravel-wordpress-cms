<?php

namespace App\Http\Middleware;

use App\Models\Config;
use Closure;
use Illuminate\Support\Facades\Log;

class ConfigMemberLoginMiddleware
{
    public function handle($request, Closure $next)
    {
        // load config from database
        $keyConfig = [
            'facebook_app_id',
            'facebook_app_secret',
            'facebook_app_callback_url',
            'google_app_id',
            'google_app_secret',
            'google_app_callback_url',
            'zalo_app_id',
            'zalo_app_secret',
            'zalo_app_callback_url',
        ];
        $loadConfig = Config::query()
            ->whereIn('name', $keyConfig)
            ->get(['name', 'value'])
            ->toArray();

        $config = !empty($loadConfig) ? array_column($loadConfig, 'value', 'name') : [];

        // facebook
        config(['services.facebook.client_id' => $config['facebook_app_id'] ?? '']);
        config(['services.facebook.client_secret' => $config['facebook_app_secret'] ?? '']);
        config(['services.facebook.redirect' => $config['facebook_app_callback_url'] ?? '']);

        // google
        config(['services.google.client_id' => $config['google_app_id'] ?? '']);
        config(['services.google.client_secret' => $config['google_app_secret'] ?? '']);
        config(['services.google.redirect' => $config['google_app_callback_url'] ?? '']);

        // zalo
        config(['services.zalo.client_id' => $config['zalo_app_id'] ?? '']);
        config(['services.zalo.client_secret' => $config['zalo_app_secret'] ?? '']);
        config(['services.zalo.redirect' => $config['zalo_app_callback_url'] ?? '']);

        return $next($request);
    }
}
