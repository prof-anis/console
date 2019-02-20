<?php

namespace utilities\console;
use utilities\console\output;
use utilities\console\input;
/**
 * 
 */
class keywords
{
	
	function __construct()
	{
		//echo "jje";
		$this->output=new output();
		$this->input=new input();

		
	}

	public function getHelp($command)
	{	
		$this->output->info("Command "."                      "."help");


		if(isset($this->input->getInputArg()[0]))
		{
			if(array_key_exists($this->input->getInputArg()[0], $command))
			{
				$class="utilities\console\Commands\\".$command[$this->input->getInputArg()[0]];

				$class=new $class;
				$class->configure();

				
				$this->output->info($this->input->getInputArg()[0]."                        ".$class->getHelp());

			}

			exit();
		}




		foreach ($command as $key => $value) {
			
			$class="utilities\console\Commands\\".$value;
			$class=new $class;
			$class->configure("soft");
		//	var_dump($class);
			$this->output->info($key."              ".$class->getHelp()."        ");

			
		}
	}


	public function getDescribe($command)
	{	
		$this->output->info("Command "."                      "."description");
		if(isset($this->input->getInputArg()[0]))
		{
			if(array_key_exists($this->input->getInputArg()[0], $command))
			{
				$class="utilities\console\Commands\\".$command[$this->input->getInputArg()[0]];

				$class=new $class;
				$class->configure();

				
				$this->output->info($this->input->getInputArg()[0]."                        ".$class->getDescribe());

			}

			exit();
		}
		foreach ($command as $key => $value) {
			
			$class="utilities\console\Commands\\".$value;
			$class=new $class;
			$class->configure("soft");
		//	var_dump($class);
			$this->output->info($key."              ".$class->getDescribe()."        ");

			
		}
	}

	


}



?>