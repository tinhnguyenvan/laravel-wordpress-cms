<?php

namespace App\Console;

use App\Console\Commands\TestCommand;
use App\Console\Commands\ThemeInstallCommand;
use App\Console\Commands\ThemeRemoveCommand;
use App\Jobs\SchedulerJob;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        TestCommand::class,
        ThemeInstallCommand::class,
        ThemeRemoveCommand::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        set_time_limit(0);

        // $schedule->job(new SchedulerJob(['command' => 'demo']))->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
