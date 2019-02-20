<?php


namespace utilities\console;

/**
* 
*/
class output
{
	
	function __construct()
	{
	$this->channel=STDOUT;
	$this->esc="\033";
	
	}

	public function write($string){
		//fopen($this->channel,'r');
		//fwrite($this->channel,$string.);
		//fclose($this->channel);
	}

	public function info($string)
	{
		//dd($string);
		
		//define("ESC", "\033");
		 $fg_color = 37;
 		$bg_color = 42;
  		//fwrite($this->channel, $this->esc."[${fg_color}m"); 
 	 	//fwrite($this->channel, $this->esc."[${bg_color}m");
       fwrite($this->channel,$string."\n");
      // fclose($this->channel);
	}

	public function stop($string){
      // fopen($this->channel,'r');
       //fwrite($this->channel, "");

		//define("ESC", "\033");
		 $fg_color = 37;//rand(30,37);
 		$bg_color = 42;//rand(40,47);
  		fwrite(STDOUT, $this->esc."[${fg_color}m"); # \033[$32m sets green foreground
 		//fwrite(STDOUT, ESC."[${bg_color}m"); 
      // fwrite(STDOUT, $this->esc."[$32m"); 
       fwrite($this->channel,$string."\n");
       fclose($this->channel);
       exit();

	}

	function table($data) {
 
    // Find longest string in each column
    $columns = [];
    foreach ($data as $row_key => $row) {
        foreach ($row as $cell_key => $cell) {
            $length = strlen($cell);
            if (empty($columns[$cell_key]) || $columns[$cell_key] < $length) {
                $columns[$cell_key] = $length;
            }
        }
    }
 
    // Output table, padding columns
    $table = '';
    foreach ($data as $row_key => $row) {
        foreach ($row as $cell_key => $cell)
            $table .= str_pad($cell, $columns[$cell_key]) . '   ';
        $table .= PHP_EOL;
    }
    return $table;
 
}

}

?>