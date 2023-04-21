<?php

namespace App\Console;

use App\Console\Commands\DatabaseBackUp;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Backup;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        'App\Console\Commands\DatabaseBackUp'
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $backup = Backup::all()->last();
        if ($backup != null) {
            if ($backup['auto'] == config('constants.BACKUP_DAILY'))
                $schedule->command('database:backup')->daily();
            else if ($backup['auto'] == config('constants.BACKUP_WEEKILY'))
                $schedule->command('database:backup')->weekly();
            else if ($backup['auto'] == config('constants.BACKUP_BIWEEKLY'))
                $schedule->command('database:backup')->twiceMonthly(1, 16, '00:00');
            else if ($backup['auto'] == config('constants.BACKUP_MONTHLY'))
                $schedule->command('database:backup')->monthly();
        }
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