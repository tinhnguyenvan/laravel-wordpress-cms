<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
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

    /**
     * cmd: php artisan install
     */
    public function handle()
    {
        $this->pluginDefault();


        // migration
        Artisan::call('migrate');
        Artisan::call('db:seed --class=UsersTableSeeder');
        Artisan::call('storage:link');
    }

    private function pluginDefault()
    {
        $listPackage = [
            'woocommerce' => 'https://github.com/tinhnguyenvan/laravel-wordpress-cms-package-woocommerce.git',
            'tool' => 'https://github.com/tinhnguyenvan/laravel-wordpress-cms-package-tool.git',
        ];

        foreach ($listPackage as $name => $urlGit) {
            try {
                // clone plugin woocommerce default
                $pathPackage = base_path().'/packages/tinhphp/'.$name;
                if (!Storage::exists($pathPackage)) {
                    shell_exec('git clone '.$urlGit.' '.$pathPackage);
                    Artisan::call('package_'.$name.':install');
                } else {
                    $this->error('- Folder plugin woocommerce exist: '.$pathPackage);
                }
            } catch (\Exception $e) {
                $this->error($e->getMessage());
            }
        }
    }
}
