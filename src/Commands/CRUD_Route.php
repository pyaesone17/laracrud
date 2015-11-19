<?php

namespace Veve\Laracrud\Commands;

use Illuminate\Console\Command;

class CRUD_Route extends Command
{
    protected $routerPath;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'route:create{model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->routerPath=app_path('Http/routes.php');
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $content=$this->routeGenreate();

        \File::append($this->routerPath, $content);

        $this->call('controller:create', [
            
            'model' =>  $this->argument('model')

        ]);
    }

    protected function routeGenreate()
    {
        $routeName=$this->routeName();

        $controllerName=$this->controllerName();

        return "\n Route::resource('$routeName','$controllerName');";
    }

    protected function routeName()
    {
        return strtolower($this->argument('model')).'s';
    }

    protected function controllerName()
    {
        return $this->argument('model').'Controller';
    }
}
