<?php

namespace utilities\console;

use utilities\console\output;
use utilities\console\input;

/**
 * 
 */
class CreateConsoleFiles
{		


	

	function __construct()
	{
				
		 $this->ConsoleFilePath=dirname(__FILE__)."/Commands/systemcommands/console.stud";
		$this->whereToCopyFiles=dirname(__FILE__)."/Commands/systemcommands/";
		$this->input=new input();

		$this->moveFileContent();

	}

	private function getSampleFile()
	{
		if(file_exists($this->ConsoleFilePath))
		{ 

			return  str_replace("@name", $this->input->getInputArg()[0], file_get_contents($this->ConsoleFilePath));
			
		}
		exit("sample file not found");
	}

	private function moveFileContent()
	{
		return file_put_contents($this->whereToCopyFiles.$this->input->getInputArg()[0].".php", $this->getSampleFile());
	}


}


?>