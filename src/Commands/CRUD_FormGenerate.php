<?php

namespace Veve\Laracrud\Commands;

use Illuminate\Console\Command;

class CRUD_FormGenerate extends Command
{
    protected $model;

    protected $namespace="\App\\";

    protected $templatePath;

    protected $patters=[];

    protected $replacements=[];

    protected $storageDirectory;

    protected $fields;

    protected $textareas;

    protected $routename;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'form:create{model}';

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

        $this->storageDirectory=base_path('resources/views/');


    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */

    public function handle()
    {
        $this->setReplacement();
       
        $this->setSetting();

        if (! \File::isDirectory($this->getStorageDirectory())) {

            \File::makeDirectory($this->getStorageDirectory());

            $this->makeCrudForm();

        }


    }
 
    protected function setSetting()
    {
       $this->setModel($this->namespace.$this->argument('model'));

        $this->setStorageDirectory();

        $this->fields=$this->model->getFillable();

        $this->textareas=(property_exists($this->model, 'textareas')) ? $this->model->textareas : [];

        $this->routename=strtolower($this->argument('model')).'s';    
    }

    protected function makeCrudForm()
    {
        $this->makeCreateForm();

        $this->makeEditForm();

        $this->makeAllFile();

        $this->makeShowFile();
    }

    protected function setModel($model)
    {
        $this->model=new $model;
    }

    public function setStorageDirectory()
    {
        $this->storageDirectory=$this->storageDirectory.'crud_'.strtolower($this->argument('model'));
    }

    protected function getStorageDirectory()
    {
        return $this->storageDirectory;
    }

    protected function makeCreateForm()
    {
        $form=view()->file($this->templatePath.'formTemplate.blade.php')->with('model', $this->argument('model'))->with('data', '$data')->with('type', 'create')->with('routename', $this->routename.'.index')->with('fields', $this->fields)->with('textareas', $this->textareas)->render();

        \File::put($this->filePath('/create.blade.php'), $form);

        $this->transformMagic('/create.blade.php');
    }


    protected function makeEditForm()
    {
        $form=view()->file($this->templatePath.'formTemplate.blade.php')->with('model', $this->argument('model'))->with('data', '$data')->with('type', 'edit')->with('routename', $this->routename.'.store')->with('fields', $this->fields)->with('textareas', $this->textareas)->render();

        \File::put($this->filePath('/edit.blade.php'), $form);

        $this->transformMagic('/edit.blade.php');
    }

    protected function makeAllFile()
    {
        $form=view()->file($this->templatePath.'formTemplate.blade.php')->with('model', $this->argument('model'))->with('data', '$data')->with('type', 'all')->with('routename', $this->routename.'.store')->with('fields', $this->fields)->with('textareas', $this->textareas)->render();

        \File::put($this->filePath('/all.blade.php'), $form);

        $this->transformMagic('/all.blade.php');
    }

    protected function makeShowFile()
    {
        $form=view()->file($this->templatePath.'formTemplate.blade.php')->with('model', $this->argument('model'))->with('data', '$data')->with('type', 'show')->with('routename', $this->routename.'.store')->with('fields', $this->fields)->with('textareas', $this->textareas)->render();

        \File::put($this->filePath('/show.blade.php'), $form);

        $this->transformMagic('/show.blade.php');
    }

    protected function filePath($fileName)
    {
        return $this->getStorageDirectory().$fileName;
    }

    protected function transformMagic($fileName)
    {
        $file=\File::get($this->filePath($fileName));

        $result=preg_replace($this->patterns, $this->replacements, $file);

        \File::put($this->filePath($fileName), $result);
    }

    protected function setReplacement(){

        $this->patterns[0]='/:/';

        $this->patterns[1]='/#/';

        $this->patterns[2]='/!!!/';

        $this->patterns[3]='/=!!/';

        $this->patterns[4]='/,Master/';

        $this->patterns[5]='/Content/';

        $this->patterns[6]='/StopCon/';

        $this->replacements[0]='{{';

        $this->replacements[1]='}}';

        $this->replacements[2]='@foreach';

        $this->replacements[3]='@endforeach';

        $this->replacements[4]='@extends("master")';
        
        $this->replacements[5]='@section("content")';
        
        $this->replacements[6]='@stop';        
    }

}
