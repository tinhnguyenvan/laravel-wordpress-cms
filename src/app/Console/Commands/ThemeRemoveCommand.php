<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ThemeRemoveCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'theme:remove {--name=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove template frontend';

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
        $theme = $this->option('name');
        $env = config('app.env');
        if (empty($theme)) {
            $this->error('Required name theme');
            return null;
        }

        $this->alert('START REMOVE ...');

        // asset
        $this->info('- START REMOVE FILE ASSET');
        $linkAsset = base_path('public/layout/' . $theme);

        $this->warn('- to: ' . $linkAsset);

        if ($env != 'production') {
            if (File::isDirectory($linkAsset)) {
                unlink($linkAsset);
            }
        } else {
            File::deleteDirectory($linkAsset);
        }
        $this->info('- Completed remove file asset');

        // resource view
        $this->info('- START REMOVE RESOURCES VIEWS');
        $linkView = base_path('resources/views/layout/' . $theme);

        $this->warn('- to: ' . $linkView);
        if ($env != 'production') {
            if (File::isDirectory($linkView)) {
                unlink($linkView);
            }
        } else {
            File::deleteDirectory($linkView);
        }
        $this->info('- COMPLETED REMOVE RESOURCES VIEWS');
        $this->info('|');

        // language
        $this->info('- START REMOVE LANGUAGE');
        foreach (config('app.languages') as $language) {
            $fileLanguage = 'layout_' . $theme . '.php';
            $linkLanguage = base_path('resources/lang/' . $language . '/' . $fileLanguage);
            $this->warn('- to: ' . $linkLanguage);
            if ($env != 'production') {
                if (File::isDirectory($linkLanguage)) {
                    unlink($linkLanguage);
                }
            } else {
                File::delete($linkLanguage);
            }
        }

        $this->info('- COMPLETED REMOVE LANGUAGE');

        $this->info('- FINAL REMOVED');
    }
}
