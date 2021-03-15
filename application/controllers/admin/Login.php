<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Muser');
		$this->load->library('validate');
		if($this->session->userdata(SESSION_SYSTEM_NAME)){
			redirect('admin','refresh');
		}
	}

	public function login(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Tên đăng nhập', 'required|min_length[6]|max_length[32]');
		$this->form_validation->set_rules('password', 'Mật khẩu', 'required|min_length[6]|max_length[32]');
        if ($this->form_validation->run() ==TRUE){
        	$username = $_POST['username'];
        	$password = md5($_POST['password']);
    		if($this->Muser->user_check_field($username, 'username')==1||$this->Muser->user_check_field($username, 'username')==TRUE){
				if($this->Muser->user_login($username, $password)!=FALSE){
	        		$dataUser = $this->Muser->user_login($username, $password);
	        		$this->session->set_userdata(SESSION_SYSTEM_NAME,$dataUser);
	        		redirect('admin','refresh');
	        	}else{
		        	$data['error']='Sai thông tin đăng nhập, thử lại';
		        	$this->load->view('backend/components/user/login', $data);
		        }
    		}else{
	        	$data['error']='Sai thông tin đăng nhập, thử lại';
	        	$this->load->view('backend/components/user/login', $data);
	        }
        }else{
        	$this->load->view('backend/components/user/login');
        }
	}

	public function logout(){
		$array_items = array(SESSION_SYSTEM_NAME);
        $this->session->unset_userdata($array_items);
		redirect('admin','refresh');
	}
}

/* End of file User.php */
/* Location: ./application/controllers/User.php */