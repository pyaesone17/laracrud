<?php namespace Veve\Laracrud;

use Illuminate\Support\ServiceProvider;


class LaracrudServiceProvider extends ServiceProvider {

   /**
    * Bootstrap the application services.
    *
    * @return void
    */
  public function boot()
  {
    $this->publishes([
      __DIR__.'/config/laracrud.php' => config_path('laracrud.php'),
    ]);
  }

   /**
    * Register the application services.
    *
    * @return void
    */
  public function register()
  {
    $this->commands(
        'Veve\Laracrud\Commands\CRUD',
        'Veve\Laracrud\Commands\CRUD_Controller',
        'Veve\Laracrud\Commands\CRUD_FormGenerate',
        'Veve\Laracrud\Commands\CRUD_Route',
        'Veve\Laracrud\Commands\CRUD_Repository'    
    );
  }

}