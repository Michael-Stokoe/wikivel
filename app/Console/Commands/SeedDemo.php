<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class SeedDemo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wikivel:demo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Will force a fresh migration of the database with seeds for demo purposes';

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
        if ($this->confirm('This command will destroy all current data in the database')) {
            Artisan::call('migrate:fresh --force --seed');

            $this->info('Application is now ready for demonstration purposes!');
        }
    }
}
