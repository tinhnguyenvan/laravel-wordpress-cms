<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class PluginInstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'plugin:install {--name=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install template frontend';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $name = $this->option('name');
        if (empty($name)) {
            $this->error('Required name theme');
            return null;
        }

        $this->alert('START INSTALL ...');

        // resource view
        $this->info('- START COPY RESOURCES VIEWS');
        $fromFolder = base_path('plugins/tinhphp/survey');
        $toFolder = base_path('packages/tinhphp/survey');

        $this->warn('- from: ' . $fromFolder);
        $this->warn('- to: ' . $toFolder);
        if (is_dir($toFolder)) {
            unlink($toFolder);
        }
        symlink($fromFolder, $toFolder);

        $this->info('- FINAL INSTALLED');
    }
}
