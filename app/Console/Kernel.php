<?php

namespace App\Console;

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
        // $schedule->command('inspire')->hourly();
        // $schedule->command('auto:test')->everyDay();
        $schedule->command('command:lagerungmailer')->dailyAt('10:00');
        $schedule->command('command:offertedateupdater')->dailyAt('01:00');
        $schedule->command('command:beforeoneweekoffermailer')->dailyAt('11:00');
        $schedule->command('command:monthlyoffermailer')->dailyAt('11:00');
        $schedule->command('command:twoweeksoffermailer')->dailyAt('11:00');
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
