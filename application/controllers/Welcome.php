<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$this->load->view('template/header_view');
		$this->load->view('welcome');
		$this->load->view('template/footer_view');
	}
}