<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ScanQR extends CI_Controller {
    
	public function index()
	{
		$this->load->view('template/header_view');
		$this->load->view('scanQR_view');
		$this->load->view('template/footer_view');
	}
}
