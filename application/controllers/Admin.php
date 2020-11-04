<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('logged_in') !== null && $this->session->userdata('logged_in') == true && $this->session->userdata('username') != 'admin'){
			redirect('ScanQR', 'refresh');
		};
    }

    public function index()
    {
        $this->load->view('template/header_view');
		$this->load->view('admin_manager_view');
		$this->load->view('template/footer_view');
    }

    public function getUser()
    {
        $this->load->model('Usermanager_model');
        $user_data = $this->Usermanager_model->getUserModel();
        echo json_encode(['messages' => $user_data]);
    }

    public function delect_user()
    {
        $this->input->post('userid');
        $this->load->model('Usermanager_model');
        $user_data = $this->Usermanager_model->delete_user_model($this->input->post('userid'));
        echo json_encode(['messages' => true]);

    }

    public function register()
    {
        $this->load->model('Usermanager_model');
        $password_e = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
        $data = array(
            'username' => $this->input->post('username'),
            'password' => $password_e
        );
        $this->Usermanager_model->register($data);
        echo json_encode(['messages' => true]);
    }
}