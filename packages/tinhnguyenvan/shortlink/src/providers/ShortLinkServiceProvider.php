<?php

namespace TinhNguyenVan\ShortLink\Providers;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\ServiceProvider;

class ShortLinkServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @throws BindingResolutionException
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('TinhNguyenVan\ShortLink\Controllers\ShortLinkController');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $dir = dirname(__DIR__, 1);
        $this->loadRoutesFrom($dir.'/routers/routes.php');
        $this->loadMigrationsFrom($dir.'/database/migrations');
        $this->loadViewsFrom($dir.'/resources/views', 'views');
        $this->publishes([
            $dir.'/views' => base_path('resources/views/admin/short_link/views'),
        ]);
    }
}
