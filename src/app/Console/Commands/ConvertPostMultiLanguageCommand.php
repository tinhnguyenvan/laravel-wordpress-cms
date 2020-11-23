<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

class ConvertPostMultiLanguageCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'language:post';

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
        $this->comment('welcome convert post');
        App::setLocale('en');
        $posts = Post::query()->get();
        if ($posts->count() > 0) {
            foreach ($posts as $post) {
                //print_r($post->toArray());
                $this->info($post->title);
                $this->info('- slug:' . $post->title);
                $title = $post->title;
                $slug = Str::slug($post->title);
                $summary = $post->summary;
                $detail = $post->detail;

                // save data
                $post->title = $title;
                $post->summary = $summary;
                $post->detail = $detail;
                $post->slug = $slug;
                $post->save();
            }
        }
    }
}
