<?php

namespace App\Console\Commands;

use App\Models\Backup\backup;
use App\Models\Backup\backupschedule;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use App\Lib\Schedulebackup;
use ZipArchive;

class Backupdbschedule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:backupschedule';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command dababase Backup send to email';
    protected $backuptime = null;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(backupschedule $backupschedule)
    {
        parent::__construct();
        $this->backuptime = $backupschedule;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {



        Mail::send('emails.reminder',[], function ($m){
            $file = new Schedulebackup();
            $file->EXPORT_TABLES('localhost',config::get('database.connections.mysql.username'),config::get('database.connections.mysql.password'),config::get('database.connections.mysql.database'),$tables=false,$backup_name=false,$filename);

            $pathToFile = storage_path('db/'.$filename);

            $zipname = explode('.',$filename)[0].'.zip';
            $zip = new ZipArchive;
            $zip->open(storage_path('db/'.$zipname), ZipArchive::CREATE);
            $zip->addFile($pathToFile,basename($pathToFile));
            $zip->close();
            $m->from('rayhan.uits@gmail.com', 'Your Application');
            $m->to('rayhan0421@gmail.com', 'test schedule mail')->subject('Your Reminder!');
            $m->attach($zipname, []);
        });
    }
}
