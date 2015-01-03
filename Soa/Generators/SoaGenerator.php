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
    protected $defaultDirectories = ['Services', 'Repositories'];
    
    /**
     *
     * @var string package
     */
    protected $package;
    
    /**
     * Create a new controller generator instance.
     * 
     * @param Illuminate\Filesystem\Filesystem $files
     * @return void
     */
    public function __construct(Filesystem $files, $package)
    {
        $this->files = $files; 
        $this->package = $package;
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
        $this->writeFile($this->getStub('facade.stub', $name, 'Services'), "{$name}Facade", $this->getPath()."/Services/{$name}");
        $this->writeFile($this->getStub('interface.stub', $name, 'Repositories'), "{$name}Interface", $this->getPath()."/Repositories/{$name}");
        $this->writeFile($this->getStub('repository.stub', $name, 'Repositories'), "{$name}Repository", $this->getPath()."/Repositories/{$name}");
        $this->writeFile($this->getStub('repositoryserviceprovider.stub', $name, 'Repositories'), "{$name}RepositoryServiceProvider", $this->getPath()."/Repositories/{$name}");
        $this->writeFile($this->getStub('service.stub', $name, 'Services'), "{$name}Service", $this->getPath()."/Services/{$name}");
        $this->writeFile($this->getStub('serviceserviceprovider.stub', $name, 'Services'), "{$name}ServiceServiceProvider", $this->getPath()."/Services/{$name}");

    }
    /**
     * Get the stub with replacement {{name}}
     * 
     * @param string $stub
     * @param string $name
     * @return string
     */
    protected function getStub($stub, $name, $namespace)
    {
        $stub = $this->files->get(__DIR__.'/stubs/'.$stub);
        $namespace = "$namespace\\$name";
        $stub = $this->replaceNamespaces($namespace, $stub);
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
            $this->makeDirectory($this->getPath()."/{$dir}/{$name}");
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
    
    protected function replaceNamespaces($namespace, $stub)
    {
        $upperPackage = explode('/', $this->package);
        return str_replace('{{namespace}}', " namespace ".ucfirst($upperPackage[0])."\\".  ucfirst($upperPackage[1])."\\".$namespace.";", $stub);
    }
    /**
     * Get path.
     * 
     * @return string
     */
    public function getPath()
    {
        if($this->package)
        {
            $upperPackage = explode('/', $this->package);
            $this->path = "workbench/".$this->package."/src/".ucfirst($upperPackage[0])."/".ucfirst($upperPackage[1]);
        }
        else
        {
            $this->path = $this->getPath()."/";
        }
        return $this->path;
    }

}
