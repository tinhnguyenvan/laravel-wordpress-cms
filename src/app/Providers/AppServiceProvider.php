<?php

namespace App\Providers;

use App\Services\ConfigService;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        try {
            $config = ConfigService::getConfig();

            Config::set('mail.host', $config['config_email_smtp_host']);
            Config::set('mail.port', $config['config_email_smtp_port']);
            Config::set('mail.from.address', $config['config_email_from']);
            Config::set('mail.from.name', $config['config_email_from_name']);
            Config::set('mail.encryption', $config['config_email_smtp_secure']);
            Config::set('mail.username', $config['config_email_username']);
            Config::set('mail.password', $config['config_email_password']);
        } catch (\Exception $e) {
        }

        // tich hop google recaptcha
        if(config('services.recaptcha.enable')) {
            Validator::extend('recaptcha', 'App\Validators\ReCaptcha@validate');
        }
    }
}
