<?php

namespace App\Jobs;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class SchedulerJob extends Job
{
    private $data;

    /**
     * SchedulerJob constructor.
     *
     * @param array $data
     */
    public function __construct($data = [])
    {
        parent::__construct();
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        set_time_limit(0);
        $command = $this->data['command'];
        $text = '- php artisan ' . $command;
        echo $text . PHP_EOL;
        Log::info($text);

        Artisan::call($command);
    }
}
