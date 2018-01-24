<?php

namespace App\Console;

use App\Models\Backup\backupschedule;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Mail;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        '\App\Console\Commands\Backupdbschedule',
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();

        if(\Schema::hasTable('backupschedules')){
            $backup  = backupschedule::first();
            if(isset($backup->intervaldays)){
                $days =  $backup->intervaldays?$backup->intervaldays:1;
                $schedule->command('email:backupschedule')
                    ->cron('*/'.$days.' * * * * *');
            }
        }



//        $schedule->call(function()
//        {
//            Mail::send('emails.reminder',[], function ($m){
//                $m->from('rayhan.uits@gmail.com', 'Your Application');
//                $m->to('rayhan0421@gmail.com', 'test schedule mail')->subject('Your Reminder!');
//            });
//
//        })->everyMinute();
        //$schedule->exec('/path/to/some/command')->daily();
       // $schedule->exec('php -d register_argc_argv=On /home/sundarba/schedule.sundarbanairtravels.com/artisan email:backupschedule')->everyMinute();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
