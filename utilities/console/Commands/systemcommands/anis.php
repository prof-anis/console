<?php

/**
* 
*/
namespace utilities\console\Commands\systemcommands;
use utilities\console\console;
use utilities\console\input;
use utilities\console\output;

class anis extends console
{
	
	

	public function configure($soft=null){
     $this

     ->setHelp('create a console page for you')

     ->setOptions([])

     ->setArgument(['name'])

     ->setDescribe('you really want to know?')

     ->prepare($soft);


	}

	public function execute(){
        
	       
       $this->output->info('welcome!!');
	}


}

?>