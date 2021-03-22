<?php

namespace App\Console\Commands;
use \App\Mail\SendMail;
use Illuminate\Console\Command;

class Notifier extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Notififier:test';

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

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $details = [
            'title' => 'Notification Shedulling',
            'body' => 'Je test automation des taches'
            
            
        ];
        \Mail::to('diattamohamet30@gmail.com')->send(new SendMail($details));
        \Mail::to('hildedokou@gmail.com')->send(new SendMail($details));
        \Mail::to('moussathiam80@gmail.com')->send(new SendMail($details));

        return 0;
    }
}
