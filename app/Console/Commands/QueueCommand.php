<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Artisan;
class QueueCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:jobs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will run queue:work fot getting the jobs done';

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
     * @return mixed
     */
    public function handle()
    {
       Artisan::call('queue:work');
       Artisan::call('down');
    }
}
