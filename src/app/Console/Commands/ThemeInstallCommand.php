<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ThemeInstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'theme:install {--name=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install template frontend';

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

        $this->alert('START INSTALL ...');

        // asset
        $this->info('- START COPY FILE ASSET');
        $targetAsset = base_path('themes/' . $theme . '/public');
        $linkAsset = base_path('public/layout/' . $theme);

        $this->warn('- from: ' . $targetAsset);
        $this->warn('- to: ' . $linkAsset);

        if ($env != 'production') {
            if (is_dir($linkAsset)) {
                unlink($linkAsset);
            }
            symlink($targetAsset, $linkAsset);
        } else {
            File::copyDirectory($targetAsset, $linkAsset);
        }
        $this->info('- Completed copy file asset');

        // resource view
        $this->info('- START COPY RESOURCES VIEWS');
        $targetView = base_path('themes/' . $theme . '/views');
        $linkAsset = base_path('resources/views/layout/' . $theme);

        $this->warn('- from: ' . $targetView);
        $this->warn('- to: ' . $linkAsset);
        if ($env != 'production') {
            if (is_dir($linkAsset)) {
                unlink($linkAsset);
            }
            symlink($targetView, $linkAsset);
        } else {
            File::copyDirectory($targetView, $linkAsset);
        }
        $this->info('- COMPLETED COPY RESOURCES VIEWS');
        $this->info('|');

        // language
        $this->info('- START COPY LANGUAGE');
        foreach (config('app.languages') as $language) {
            $fileLanguage = 'layout_' . $theme . '.php';
            $targetLanguage = base_path('themes/' . $theme . '/lang/' . $language . '/' . $fileLanguage);
            $linkLanguage = base_path('resources/lang/' . $language . '/' . $fileLanguage);
            $this->warn('- from: ' . $targetLanguage);
            $this->warn('- to: ' . $linkLanguage);
            File::copy($targetLanguage, $linkLanguage);
        }
        $this->info('- COMPLETED COPY LANGUAGE');

        $this->info('- FINAL INSTALLED');
    }
}
