<?php
namespace utilities\console\Register;
use utilities\console\input;
use utilities\console\output;

class Register
{
	
	function __construct()
	{  
	 $this->input=new input;

		$this->command=[

        'make:console'=>'systemcommands\makeconsole',
        'make:another'=>'systemcommands\anis'
      

		];


		$this->run();
		exit();
	}


	public function run(){

		$class=$this->input->getCommand();
		if(array_key_exists($class, $this->command)){
			$class=$this->command[$class];
		}
			elseif ($this->checkIfIsKeyWord($class)) {
				$class_="\\utilities\\console\\keywords";
				$hh=new $class_;
				//dd($class);
				$method=$this->keyWords()[$class];
				//var_dump($method);
				$hh->$method($this->command);
				exit;
			}
		else{
			$output=new output;
			if($class==null){

				$output->stop("Simple stupid console by Prof Anis");
			}
 			
 			$output->stop("invalid command given");
		}

		//$class="\\utilities\\console\\commands\\".$class;
		$class="utilities\console\Commands\\".$class;

		
		$run=new $class;
		$run->configure();
		$run->execute();


	}

	public function keyWords()
	{
		return ['list'=>'getList','help'=>'getHelp','describe'=>'getDescribe'];
	}
	public function checkIfIsKeyWord($check)
	{	

		$keys=array_keys($this->keyWords());
		return in_array($check,$keys);
	}




}


?>