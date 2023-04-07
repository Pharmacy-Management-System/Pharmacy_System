<?php

namespace App\Console;

use App\Jobs\AssignNewOrder;
use App\Jobs\ChangeOrderStatusJob;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Jobs\RemoveOldBans;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('send:inactive-users-notification')->dailyAt('8:00');
        $schedule->job(new AssignNewOrder)->everyMinute();
        $schedule->job(new RemoveOldBans)->daily();
        $schedule->job(new ChangeOrderStatusJob())->everyMinute();
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
