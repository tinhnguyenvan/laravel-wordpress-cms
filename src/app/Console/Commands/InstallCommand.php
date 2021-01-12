<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {
        // clone plugin woocommerce default
        $this->pluginDefault();

        // clone theme default
        $this->themeDefault();

        // migration
        Artisan::call('migrate:fresh');
        Artisan::call('db:seed --class=UsersTableSeeder');
        Artisan::call('storage:link');
        Artisan::call('theme:install --name=default');
    }

    private function pluginDefault()
    {
        $pathPackageWoocommerce = base_path() . '/packages/tinhphp/woocommerce';
        if (!Storage::exists($pathPackageWoocommerce)) {
            $fileUrl = 'https://github.com/tinhnguyenvan/laravel-wordpress-cms-package-woocommerce.git';
            shell_exec('git clone ' . $fileUrl . ' ' . $pathPackageWoocommerce);
        } else {
            $this->error('- Folder plugin woocommerce exist: ' . $pathPackageWoocommerce);
        }
    }

    private function themeDefault()
    {
        $pathThemeDefault = base_path() . '/themes/default';
        if (!Storage::exists($pathThemeDefault)) {
            $fileUrl = 'https://github.com/tinhnguyenvan/laravel-wordpress-cms-theme-default.git';
            shell_exec('git clone ' . $fileUrl . ' ' . $pathThemeDefault);
        } else {
            $this->error('- Folder theme default exist: ' . $pathThemeDefault);
        }
    }
}
