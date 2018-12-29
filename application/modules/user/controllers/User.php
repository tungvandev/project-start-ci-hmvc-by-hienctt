<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller{
	
	public function __construct(){
		parent::__construct();

		$this->load->model('user_model');
        $this->load->helper('url');
        $this->load->library('session');
	}
	
	public function index(){
		$users = $this->user_model->get_list_users();
		$data['users'] = $users->result();

		$this->load->view('user-template', $data);
	}

	public function edit($id) {
		
		$this->load->helper('form');
		  
		$user = $this->user_model->find_user_by_id($id);
		if(!$user) {
			// error
			$users = $this->user_model->get_list_users();
			$data['users'] = $users->result();

			$this->load->view('user-template', $data);
		}
 
		$data['user'] = $user;
 
		$this->load->view("edit-user", $data);
	}

	// When user submit data on view page, Then this function store data in array.
	public function create() {

		if( !$this->input->post('username') || $this->input->post('username') == NULL) {
			$response = array('code' => 0 , 'msg' => 'Username không được để trống');
			return $this->output->set_status_header(500)->set_content_type('application/json')->set_output(json_encode($response));
		}

		if($this->input->post('email') == '' || !$this->input->post('email') || $this->input->post('email') == NULL) {

			$response = array('code' => 0 , 'msg' => 'Email không được để trống');
			return $this->output->set_status_header(500)->set_content_type('application/json')->set_output(json_encode($response));
		}
		if($this->input->post('re_pw') == '' || !$this->input->post('re_pw') ||$this->input->post('re_pw') == NULL ||
			$this->input->post('password') == ''  || !$this->input->post('password') || $this->input->post('password') == NULL
			|| $this->input->post('password') != $this->input->post('re_pw')) {

			$response = array('code' => 0 , 'msg' => 'Mật khẩu sai');
			return $this->output->set_status_header(500)->set_content_type('application/json')->set_output(json_encode($response));
		}

		$data = array(
			'username' => $this->input->post('username'),
			'email' => $this->input->post('email'),
			'password' => $this->input->post('password')
		);

		$user = $this->user_model->create($data);

		if(!$user) {
			$response = array('code' => 0, 'msg' => 'Đã có lỗi xảy ra. Vui lòng thử lại');
			return $this->output->set_status_header(500)->set_content_type('application/json')->set_output(json_encode($response));
		}
		$response = array('code' => 1, 'msg' => 'Thêm thành công', 'data' => $user);
		return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($response));
	}

	// When user submit data on view page, Then this function store data in array.
	public function update() {
		$this->load->helper('form');

		$id = $this->input->post('id');
		if($id == '' || !$id || $id == NULL) {
			// flash: có lỗi xảy ra
			// $user = $this->user_model->find_user_by_id($id);
			// $data['user'] = $user;
			// $this->load->view("edit-user", $data);
			redirect('user');
		}

		$data = array(
			'username' => $this->input->post('username'),
			'email' => $this->input->post('email')
		);

		if($data['username'] == '' || !$data['username'] || $data['username'] == NULL) {
			$this->session->set_flashdata('err_username', 'Không được để trống User name');

			redirect('user/edit/'.$id);
		}

		if($data['email'] == '' || !$data['email'] || $data['email'] == NULL) {
			$this->session->set_flashdata('err_email', 'Không được để trống email');

			redirect('user/edit/'.$id);
		}

		$user = $this->user_model->update($data, $id);

		if(!$user) {
			 // flass error
 			$user = $this->user_model->find_user_by_id($id);
			$data['user'] = $user;
			$this->load->view("edit-user", $data);
		}


		$users = $this->user_model->get_list_users();
		$data['users'] = $users->result();
		redirect('user');
	}

	public function delete()
	{
		$id = $this->input->post('id');
		if($id == '' || !$id || $id == NULL) {

			$response = array('code' => 0 , 'msg' => 'Xảy ra lỗi trong quá trình xóa1');
			return $this->output->set_status_header(500)->set_content_type('application/json')->set_output(json_encode($response));
		}
		$user = $this->user_model->delete($id);

		if(!$user) {
			$response = array('code' => 0 , 'msg' => 'Xảy ra lỗi trong quá trình xóa2');
			return $this->output->set_status_header(500)->set_content_type('application/json')->set_output(json_encode($response));
		}

		$response = array('code' => 1 , 'msg' => 'Xóa thành công');
		return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($response));
	}


	public function user(){
		$data['sz_Hmvc'] = "Cài đặt mô hình HMVC trên CodeIgniter !";
		$this->load->view('user-template', $data);

		$this->home_model->update('hien');
	}
	
}
