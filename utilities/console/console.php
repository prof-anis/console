<?php

namespace utilities\console;
use utilities\console\input;
use utilities\console\output;
/**
* 
*/
class Console  
{
	
	function __construct()
	{
		
		$this->input=new input;
		$this->output=new output;

		//var_dump($this->input->getOptions());
		//exit($this->input);
	}

		public function setOptions(array $options){
/* options must be of the form 
  $option=['option name'=>'parameters such as is required,optional,any other thing']
*/    
  	$this->options=$options;
  	return $this;

       
	}

     	public function setArgument(array $arg){
     $this->arg=$arg;
     return $this;
	}

	    public  function setHelp($help){
     $this->help=$help;
     return $this;
	}
	    public function setDescribe($describe){
	 $this->describe=$describe;
     return $this;
	}

	public function getDescribe()
	{
		return $this->describe;
	}

	  public function loadCommands(){
	  	require dirname(__FILE__).'/register.php';
	  }

	  public function getHelp(){
	  	return $this->help;
	  }

	  public function getOptions(){
	  	return $this->options;
	  }
	  public function getArg(){
	  	return $this->arg;
	  }

	  public function prepare($soft=null){

	  	if($soft !== null)
	  	{
	  		return true;
	  	}
	  
   if($this->ifIsKeyWord()){
     	$method=$this->keywords()[$this->input->getInputArg()[0]];
     	//dd($this->getHelp());
       $this->output->write($this->$method());
     	exit();
      
}
     $this->checkArgumentComplete();
     $this->checkCompulsoryOptionsGiven();
	  }

	

	  public function checkArgumentComplete(){
   $actualArg=$this->input->getInputArg();
   $expectedArg=$this->getArg();

   if(count($actualArg)!==count($expectedArg)){
   	$expectedValues='';
   	foreach ($expectedArg as $key => $value) {
   			$expectedValues.=" ".$value." ";

   	}

   	
   
   	  $this->output->stop("Too few argument given, expecting $expectedValues but just ". count($actualArg)." argument was supplied given");
   }
	  }

	  public  function checkCompulsoryOptionsGiven(){
	  		$actualOptions=$this->input->getOptions();

	     	$expectedOptions=$this->getOptions();
	     	//dd($expectedOptions);
            if(count($this->getCompulsoryOptions())<1){
            
            	return true;
            }
            $counter=0;
           
	     	foreach ($this->getCompulsoryOptions() as $key => $value) {
	     		//echo $key;
	     		if(!in_array($key, $actualOptions)){
	     			$counter++;
	     		}
	     	}

	     	if($counter==0){
	     		return true;
	     	}

	     	else{
	     		$this->output->stop("Some compulsory options were not supplied!");
	     	}


	  }

	  public function getCompulsoryOptions(){
	  	$compulsory=[];
	  	//dd($this->getOptions());
	  	foreach ($this->getOptions() as $key => $value) {
	  		$parameters=explode('|', $value);
	  		if(in_array('required', $parameters)){
             $compulsory[]=$key;
	  		}
	  	}

	  	return $compulsory;
	  }

	  public function keywords(){
	  	return 
	  	['help'=>'getHelp','describe','list'];
	  }

	  public function ifIsKeyWord(){
	  //	dd($this->keywords());
	  	//dd(in_array($this->input->getInputArg()[0],$this->keywords()));
	  	if($this->input->countArg()==1 && array_key_exists($this->input->getInputArg()[0],$this->keywords())){
	  		return true;
	  	}
	  }




}

?>