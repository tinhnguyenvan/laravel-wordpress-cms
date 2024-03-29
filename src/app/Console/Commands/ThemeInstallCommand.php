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

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $theme = $this->option('name');
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

        if (is_dir($linkAsset)) {
            unlink($linkAsset);
        } else {
            File::makeDirectory(base_path('public/layout/'), $mode = 0777, true, true);
        }

        symlink($targetAsset, $linkAsset);

        $this->info('- Completed copy file asset');

        // resource view
        $this->info('- START COPY RESOURCES VIEWS');
        $targetView = base_path('themes/' . $theme . '/views');
        $linkAsset = base_path('resources/views/layout/' . $theme);

        $this->warn('- from: ' . $targetView);
        $this->warn('- to: ' . $linkAsset);
        if (is_dir($linkAsset)) {
            unlink($linkAsset);
        }else {
            File::makeDirectory(base_path('resources/views/layout/'), $mode = 0777, true, true);
        }

        symlink($targetView, $linkAsset);

        $this->info('- COMPLETED COPY RESOURCES VIEWS');
        $this->info('|');

        // language
        $this->info('- START COPY LANGUAGE');
        foreach (config('app.languages') as $language) {
            $fileLanguage = 'layout_' . $theme . '.php';
            $targetLanguage = base_path('themes/' . $theme . '/lang/' . $language . '/' . $fileLanguage);
            $linkLanguage = base_path('resources/lang/' . $language . '/' . $fileLanguage);
            if (is_dir(base_path($targetLanguage))) {
                $this->warn('- from: ' . $targetLanguage);
                $this->warn('- to: ' . $linkLanguage);
                File::copy($targetLanguage, $linkLanguage);
            }
        }
        $this->info('- COMPLETED COPY LANGUAGE');

        $this->info('- FINAL INSTALLED');
    }
}
