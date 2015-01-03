<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Soa\Generators\SoaGenerator;

class soa extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'soa:generate';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create SOA in your app.';

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
	public function fire()
	{
            $generator = new SoaGenerator(new \Illuminate\Filesystem\Filesystem);
            $generator->make($this->argument('name'));
            $this->info('Success!');
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
            
		return array(
			array('name', InputArgument::REQUIRED, 'An example argument.'),
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
            
            
		return array(
			array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
		);
        
	}

}
