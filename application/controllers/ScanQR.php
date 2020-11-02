<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ScanQR extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('logged_in') == null && $this->session->userdata('logged_in') == false){
			redirect(base_url(), 'refresh');
		};
	}

	public function index()
	{
		$this->load->view('template/header_view');
		$this->load->view('scanQR_view');
		$this->load->view('template/footer_view');
	}

	public function takephoto($carid_id = NULL , $size_small = null){
		$data_page = array(
			'carid_id' => $carid_id,
			'size_small' => $size_small
		);
		$this->load->view('template/header_view');
		$this->load->view('takephoto_view', $data_page);
		$this->load->view('template/footer_view');
	}

	public function process_image()
	{
		$option_resize = true;
		$temp_id = 'IMAT00000000215';
		$source_path = 'C:\test_franchise\bin\01SFXinput';
		$target_path_small = 'D:\Images\small';
		$target_path_large = 'D:\Images\large';
		$data_path = date("dmY");
		$files_name = [];
		while (sizeof($files_name) <= 7) {
			sleep(0.5);
            $files_name = array_diff(scandir($source_path, 1), array('..', '.'));
		}
		sleep(0.5);
		if(!is_dir($target_path_large."\\".$data_path)){
			mkdir($target_path_large."\\".$data_path);
		}

		if(!is_dir($target_path_large."\\".$data_path."\\".$temp_id)){
			mkdir($target_path_large."\\".$data_path."\\".$temp_id);
		}
		
		for ($i=0; $i < sizeof($files_name); $i++) { 
			sleep(0.5);
			// $file_explode_name = explode(".", $files_name[$i]);
			rename($source_path."\\".$files_name[$i], $target_path_large."\\".$data_path."\\".$temp_id."\\".$temp_id.'_'.$files_name[$i]);
		}

		// echo json_encode($files_name);
	}

	public function take_a_photo_udp()
    {
		$server = '127.0.0.1';
        $port = 16000;
        $msg = 'P';
        $len = strlen($msg);
        $sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
        socket_sendto($sock, $msg, $len, 0, $server, $port);
		socket_close($sock);
		echo json_encode(['mesagess' => true]);
	}

	public function Success()
	{
		$this->load->view('template/header_view');
		$this->load->view('Success_view');
		$this->load->view('template/footer_view');
	}
}
