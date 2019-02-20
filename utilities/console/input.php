<?php

/**
* 
*/
namespace utilities\console;

class input
{
	
	function __construct()
	{
		$this->process();
	}

	public function getServerFeedback(){
		return ($_SERVER['argv']);
		
		//return the server arguments
	}

	public function  removeAnisifyExtension(){
		//removes the anisify extension
		$userInput=$this->getServerFeedback();
     if(in_array('anisify', $userInput)){
     	array_shift($userInput);
     }
    
        $this->userInput=$userInput;
        return $this;
	}

	public function extractCommand(){
		if(count($this->userInput) == 0){
			$this->command=null;
			return $this;
		}
        $this->command=$this->userInput[0];
        unset($this->userInput[0]);
        return $this;
	}

	public function  getCommand(){
		$this->getServerFeedback();
		$this->removeAnisifyExtension();
		$this->extractCommand();


		return $this->command;
	}
    public function process(){
    	$this->getServerFeedback();
		$this->removeAnisifyExtension();
		$this->extractCommand();

		$this->identifyUserInputOptions();
		$this->identifyUserInputArguments();
    }
	public function checkIfInputIsEmpty(){

	}

	public function identifyUserInputOptions(){
		$this->option=[];
           foreach ($this->userInput as $key => $value) {
           	//echo $value."<br>";
         //  var_dump(strpos($value,'=') > 0);
         if(strpos($value,'=') > 0)
         {
         	$option=explode('=', $value);
         	$this->option[$option[0]]=$option[1];
         }
       }


     //  dd($this->option);
	}

	public function identifyUserInputArguments(){
		$this->arg=[];
       foreach ($this->userInput as $key => $value) {
         if(strpos($value,'=' ) < 1){
         	$this->arg[]=$value;
         }
       }
	}

	public function countOptions(){

		return count($this->option);
	}
	public function countArg(){
		return count($this->arg);
	}

	public function getOptions(){
		return $this->option;
	}

	public function getInputArg(){
		return $this->arg;
	}

	public function getOption($name)
	{
		return $this->option['--'.$name];
	}


}

?>