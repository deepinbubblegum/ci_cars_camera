<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('logged_in') !== null && $this->session->userdata('logged_in') == true){
			redirect('ScanQR', 'refresh');
		};
	}

	public function index()
	{

		$this->load->view('template/header_view');
		$this->load->view('welcome');
		$this->load->view('template/footer_view');
	}

	public function sign_in()
	{
		error_reporting(E_ERROR | E_PARSE);
		$this->load->model('Signin_model');
		$User_data = array(
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password')
		);
		$result = $this->Signin_model->user_sign_in($User_data['username']);
		$getPassword = $result[0]->password;
		if (password_verify($User_data['password'], $getPassword)) {
			$newdata = array(
				'username'  => $User_data['username'],
				'logged_in' => true
			);
			$this->session->set_userdata($newdata);
			echo json_encode(['message' => true]);
		} else {
			$newdata = array(
				'logged_in' => false
			);
			$this->session->set_userdata($newdata);
			echo json_encode(['message' => false]);
		}
	}
}
