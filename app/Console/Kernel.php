<?php

namespace App\Console;

use App\Models\Notification;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

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
        $schedule->command('inspire')->hourly();
        $schedule->command('queue:work --stop-when-empty')->everyMinute()->withoutOverlapping();
        $schedule->command('app:update-user-level')->daily();
        $schedule->command('app:update-user-membership-years-badge')->daily();
        $schedule->command('app:update-sitemap')->daily();
        $schedule->command('disposable:update')->weekly();
        // $schedule->command('db:prune', ['--model' => Notification::class])->daily();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
