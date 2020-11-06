<?php
defined('BASEPATH') or exit('No direct script access allowed');

class GMC_Controller extends CI_Controller{

    public function __construct()
	{
		parent::__construct();

		$this->identifying();

    }
    
    private function identifying()
	{
		error_reporting(E_ERROR | E_PARSE);
        $salt = "";
        $id_verify = "624035a167870f98165cdb552e784412";
		if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
			$temp = sys_get_temp_dir().DIRECTORY_SEPARATOR."diskpartscript.txt";
			if(!file_exists($temp) && !is_file($temp)) file_put_contents($temp, "select disk 0\ndetail disk");
			$output = shell_exec("diskpart /s ".$temp);
			$lines = explode("\n",$output);
			$result = array_filter($lines,function($line) {
				return stripos($line,"ID:")!==false;
			});
			if(count($result)>0) {
				$result = array_shift(array_values($result));
				$result = explode(":",$result);
				$result = trim(end($result));       
			} else $result = $output;       
		} else {
			$result = shell_exec("blkid -o value -s UUID");  
			if(stripos($result,"blkid")!==false) {
				$result = $_SERVER['HTTP_HOST'];
			}
        }
        
        if(md5($salt.md5($result)) != $id_verify){
            show_404();
        }
	}
}