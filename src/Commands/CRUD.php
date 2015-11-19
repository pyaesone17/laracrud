<?php namespace Veve\Laracrud\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;

class CRUD extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:create{model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'CRUD generator.';

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
        $this->call('route:create', [
            
            'model' => $this->argument('model')
        
        ]);


        $this->comment(PHP_EOL.'CRUDED IT'.PHP_EOL);
    }
}
