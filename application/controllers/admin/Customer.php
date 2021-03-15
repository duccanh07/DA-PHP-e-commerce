<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Customer extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Muser');
		$this->load->library('validate');
		if(!$this->session->userdata('sessionUserAdmin')){
			redirect('admin/login','refresh');
		}
		$this->data['dataUser']=$this->session->userdata('sessionUserAdmin');
		$this->data['com']='customer';
	}

	public function index(){
		$this->session->set_userdata(SESSION_SAVE_LIST_IMAGES, array());
		$this->load->library('custom_pagination');
		$pageCurrent=$this->custom_pagination->PageCurrent();
		$firstPage=$this->custom_pagination->PageFirst(TOTAL_ITEM_PAGING, $pageCurrent);
		$totalItem=$this->Muser->users_count(STATUS_ACTIVE, KIND_CUSTOMER);
		$this->data['strphantrang']=$this->custom_pagination->PagePer($totalItem, $pageCurrent, TOTAL_ITEM_PAGING, $url='admin/customer');
		$listData = $this->Muser->users_all(TOTAL_ITEM_PAGING, $firstPage, STATUS_ACTIVE, KIND_CUSTOMER);
		$this->data['list']=$listData;
		$this->data['countBlock']=$this->Muser->users_count(STATUS_BLOCK, KIND_CUSTOMER);
		$this->data['countPending']=$this->Muser->users_count(STATUS_PENDING, KIND_CUSTOMER);
		$this->data['view']='index';
		$this->session->set_userdata('pathCurrent',uri_string());
		$this->session->set_userdata('totalItemPageCurrent',count($listData));
		$this->data['title']='Quản lý khách hàng - Hệ thống quản lý cơ sở dữ liệu';
		$this->load->view('backend/layout', $this->data);
	}
	
	public function delete($id){
		$mydata= array('status' => STATUS_DELETE);
		$this->Muser->user_update($mydata, $id);
		$this->session->set_flashdata('success', 'Xóa khách hàng thành công');
		redirect('admin/customer','refresh');
	}
}