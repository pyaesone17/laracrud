<?php namespace Veve\Laracrud\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;

class CRUD_Repository extends Command
{
   

    protected $patters=[];

    protected $replacements=[];
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:repo{model}';

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

        $this->templatePath=__DIR__.'/stubs/';

        $this->storageDirectory=app_path('Repositories/');
       
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    { 
        $this->setReplacement();
        
        if (! \File::isDirectory($this->storageDirectory)) {
            \File::makeDirectory($this->storageDirectory);
        }        

        $this->makeBaseRepo();

        $this->makeModelRepo();

        $this->comment(PHP_EOL.'CRUDED IT'.PHP_EOL);
    }

    protected function makeBaseRepo()
    {
        $basefile=\File::get($this->templatePath.'/BaseRepository.php');

        \File::put($this->filePath(), $basefile);  
    }

    protected function makeModelRepo()
    {
        $file=\File::get($this->templatePath.'/TemplateRepository.php');
        
        $result=preg_replace($this->patterns, $this->replacements, $file);
           
        \File::put($this->filePath($this->argument('model')), $result); 
    }

    protected function filePath($filename='Base')
    {
        return $this->storageDirectory.$filename.'Repository.php';
    }

    protected function setReplacement()
    {
        $this->patterns[0]='/ModelRepository/';

        $this->patterns[1]='/Model/';

        $this->patterns[2]='/varmodel/';

        $this->replacements[0]=$this->argument('model').'Repository';

        $this->replacements[1]=$this->argument('model');

        $this->replacements[2]=strtolower($this->argument('model'));
    }    

}
