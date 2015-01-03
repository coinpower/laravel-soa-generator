<?php namespace Soa\Generators;

use Illuminate\Filesystem\Filesystem;

class SoaGenerator
{
    /**
     * The file system instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;
    
    /**
     * The defaults directories
     * 
     * @var array
     */
    protected $defaultDirectories = ['Services', 'Providers', 'Repositories'];
    
    /**
     * Create a new controller generator instance.
     * 
     * @param Illuminate\Filesystem\Filesystem $files
     * @return void
     */
    public function __construct(Filesystem $files)
    {
        $this->files = $files; 
    }
    
    /**
     * Create a directory architecture
     * 
     * @param string $name
     * @return void
     */
    public function make($name)
    {
        $this->makeDirectories($name);
        $this->writeFiles($name);
    }
    
    /**
     * 
     */
    protected function writeFiles($name)
    {
        $this->writeFile($this->getStub('facade.stub', $name), "{$name}Facade", "app/Services/{$name}");
        $this->writeFile($this->getStub('interface.stub', $name), "{$name}Interface", "app/Repositories/{$name}");
        $this->writeFile($this->getStub('repository.stub', $name), "{$name}Repository", "app/Repositories/{$name}");
        $this->writeFile($this->getStub('repositoryserviceprovider.stub', $name), "{$name}RepositoryServiceProvider", "app/Repositories/{$name}");
        $this->writeFile($this->getStub('service.stub', $name), "{$name}Service", "app/Services/{$name}");
        $this->writeFile($this->getStub('serviceserviceprovider.stub', $name), "{$name}ServiceServiceProvider", "app/Services/{$name}");

    }
    /**
     * Get the stub with replacement {{name}}
     * 
     * @param string $stub
     * @param string $name
     * @return string
     */
    protected function getStub($stub, $name)
    {
        $stub = $this->files->get(__DIR__.'/stubs/'.$stub);
        return $this->replaceNames($name, $stub);
    }
    /**
     * Generate directories
     * 
     * @return void
     */
    protected function makeDirectories($name)
    {
        foreach($this->defaultDirectories as $dir)
        {
            $this->makeDirectory("app/{$dir}/{$name}");
        }
    }
    /**
     * Write the completed stub to disk.
     * 
     * @param string $stub
     * @param type $name
     * @param string $path
     * @return void
     */
    protected function writeFile($stub, $name, $path)
    {
        
            $name = str_replace('\\', DIRECTORY_SEPARATOR, $name);

            if ( ! $this->files->exists($fullPath = $path."/{$name}.php"))
            {
                    return $this->files->put($fullPath, $stub);
            }
    }

    /**
     * Create the directory for the controller.
     *
     * @param  string  $controller
     * @param  string  $path
     * @return void
     */
    protected function makeDirectory($path)
    {

            if ( ! $this->files->isDirectory($path))
            {
                    $this->files->makeDirectory($path, 0777, true);
            }
    }
    
    /** Replace the names on the files
     * 
     * @param string $name
     * @param string $stub
     * @return string
     */
    
    protected function replaceNames($name, $stub)
    {
        $replacement = ['[name]', '{{name}}'];
        $toReplacement = [lcfirst($name), $name];
        return str_replace($replacement, $toReplacement, $stub);
    }

}
