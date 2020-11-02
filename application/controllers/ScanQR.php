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

	public function Success()
	{
		$this->load->view('template/header_view');
		$this->load->view('Success_view');
		$this->load->view('template/footer_view');
	}
}
