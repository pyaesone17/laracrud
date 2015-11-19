<?php

namespace Veve\Laracrud\Commands;

use Illuminate\Console\Command;

class CRUD_Controller extends Command
{
    protected $patterns=[];

    protected $replacements=[];

    protected $templatePath;

    protected $storageDirectory;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'controller:create{model}';

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

        $this->templatePath=__DIR__.'/stubs/';

        $this->storageDirectory=app_path('Http/Controllers/');

    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->setReplacement();
     
        if ($this->confirm('Do you want to include repo? [y|N]')) {
        
            $result=$this->generateControllerWithRepo();
        
        } else {
        
            $result=$this->generateControllerWithoutRepo();
        }

        \File::put($this->filePath(), $result);

        $this->generateFormAndMigration();
    }

    protected function generateFormAndMigration()
    {
        
        $migrationName=$this->transformToMigration($this->argument('model'));

        $this->call('make:migration', [
            
            'name' => $migrationName, '--create' => strtolower($this->argument('model')).'s'
        
        ]);

        $this->call('form:create', [
            
            'model' => $this->argument('model')
        
        ]);        
    }

    protected function generateControllerWithRepo()
    {
        $file=\File::get($this->templatePath.'/controllerTemplateWithRepo.php');

        $result=preg_replace($this->patterns, $this->replacements, $file);
       
        $this->call('crud:repo', [
            
            'model' => $this->argument('model')
        
        ]);

        return $result;
    }

    protected function generateControllerWithoutRepo()
    {
        $file=\File::get($this->templatePath.'/controllerTemplate.php');

        $result=preg_replace($this->patterns, $this->replacements, $file);

        return $result;
    }

    protected function filePath()
    {
        return $this->storageDirectory.$this->argument('model').'Controller.php';
    }

    protected function setReplacement()
    {
        $this->patterns[0]='/controller/';

        $this->patterns[1]='/Model/';

        $this->patterns[2]='/folder/';

        $this->patterns[3]='/routename/';

        $this->replacements[0]=$this->argument('model').'Controller';

        $this->replacements[1]=$this->argument('model');

        $this->replacements[2]='crud_'.strtolower($this->argument('model'));

        $this->replacements[3]=strtolower($this->argument('model')).'s';
    }


    protected function transformToMigration($name)
    {
        return 'create_'.strtolower($name).'_table';
    }
}
