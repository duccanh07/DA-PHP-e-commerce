<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata(SESSION_SYSTEM_NAME)){
			redirect('admin/login','refresh');
		}
		$this->load->model('Morders', 'Morder');
		$this->load->model('Mproduct');
		$this->load->model('Mcontent');
		$this->load->model('Muser');
		$this->load->model('Majaxupload');
		$this->data['dataUser']=$this->session->userdata(SESSION_SYSTEM_NAME);
		$this->data['com']='dashboard';
	}

	public function index(){
		$this->data['countUser'] = $this->Muser->users_count(STATUS_ACTIVE, KIND_CUSTOMER);
		$this->data['countOrder'] = $this->Morder->order_count(STATUS_ACTIVE, null);
		$this->data['countProduct'] = $this->Mproduct->product_count(STATUS_ACTIVE);
		$this->data['countContent'] = $this->Mcontent->content_count(STATUS_ACTIVE);
		$this->data['view']='index';
		$this->data['title']='Hệ thống quản lý cơ sở dữ liệu';
		$this->load->view('backend/layout', $this->data);
	}

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */