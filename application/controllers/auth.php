<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}
	public function index()
	{
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');
		if ($this->form_validation->run() == false) {
			$data['title'] = 'login page';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/login');
			$this->load->view('templates/auth_footer');
		} else {
			$this->_login();
		}
	}
	private function _login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$user = $this->db->get_where('user', ['email' => $email])->row_array();

		if ($user) {
			if ($user["is_active"] == 1) {
				if (password_verify($password, $user['password'])) {
					$data = [
						'email' => $user['email'],
						'role_id' => $user['role_id']
					];
					$this->session->set_userdata($data);
					if ($user['role_id'] == 1) {
						redirect('Admin');
					} else {
						redirect('user');
					}
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger " role="alert">wrong password!</div>');
					redirect('Auth');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger " role="alert">this email has not been activated</div>');
				redirect('Auth');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger " role="alert">email is not registerd!</div>');
			redirect('Auth');
		}
	}

	public function registrasion()
	{
		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
			'is_unique' => 'this email has already registered!'

		]);
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[4]|matches[password2]', [
			'matches' => 'password dont macth!',
			'min_length' => 'pasword too short!'
		]);
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

		if ($this->form_validation->run() == false) {
			$data['title'] = 'WPU user registrasion';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/registrasion');
			$this->load->view('templates/auth_footer');
		} else {
			$data =
				[
					'name'         => htmlspecialchars($this->input->post('name', true)),
					'email'        => htmlspecialchars($this->input->post('email', true)),
					'image'        => 'default.jpeg',
					'password'     => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
					'role_id'      => 2,
					'is_active'    => 1,
					'date_created' => time()

				];
			$this->db->insert('user', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success " role="alert">congtarulation! your account has been created. please login</div>');
			redirect('Auth');
		}
	}
	public function logout()
	{
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role_id');
		$this->session->set_flashdata('message', '<div class="alert alert-success " role="alert">
			your have been loget out!</div>');
		redirect('Auth');
	}
	public function blocked()
	{
		$data['title'] = 'blocked';

		$this->load->view('auth/blocked', $data);
	}
}
