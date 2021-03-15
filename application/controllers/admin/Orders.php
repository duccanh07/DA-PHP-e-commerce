<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Orders extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Morders', 'Morder');
		$this->load->model('Mproduct');
		if(!$this->session->userdata('sessionUserAdmin')){
			redirect('admin/login','refresh');
		}
		$this->data['dataUser']=$this->session->userdata('sessionUserAdmin');
		$this->data['com']='orders';
	}

	public function index(){
		$state = null;
		if (isset($_GET['state'])) {
			if ($_GET['state'] != '-1') {
				$state = $_GET['state'];
			}
		}
		if ($state != null) {
			switch ($state) {
				case STATE_ORDER_ORDERING: case STATE_ORDER_PROCESSING: case STATE_ORDER_SHIPPING: case STATE_ORDER_COMPLETE: case STATE_ORDER_CANCEL:
					break;
				default:
					redirect('404', 'refresh');
					break;
			}
		}
		$from = null;
		$to = null;
		$orderCode = null;
		if (isset($_GET['from'])) {
			$from = $_GET['from'];
		}
		if (isset($_GET['to'])) {
			$to = $_GET['to'];
		}
		if ($from != null && $to != null && $from == $to) {
			$from .= ' 00:00:00';
			$to .= ' 23:59:59';
		} else {
			$to .= ' 23:59:59';
		}
		if (isset($_GET['keyword'])) {
			$orderCode = $_GET['keyword'];
		}
		$this->load->library('phantrang');
		if (isset($_GET['page'])) {
			$firstPage = (int)$_GET['page'] * TOTAL_ITEM_PAGING;
			$pageCurrent = ((int)$_GET['page']) + 1;
		} else {
			$pageCurrent=$this->phantrang->PageCurrent();
			$firstPage=$this->phantrang->PageFirst(TOTAL_ITEM_PAGING, $pageCurrent);
		}
		$totalItem=$this->Morder->order_count(STATUS_ACTIVE, $state, $from, $to, $orderCode);
		$this->data['strphantrang']=$this->phantrang->PagePer($totalItem, $pageCurrent, TOTAL_ITEM_PAGING, $url='admin/orders');
		$listData=$this->Morder->order_all(TOTAL_ITEM_PAGING, $firstPage, STATUS_ACTIVE, $state, $from, $to, $orderCode);
		$this->data['list']=$listData;
		$this->data['view']='index';
		$this->data['state']=$state;
		$this->data['title']='Quản lý đơn hàng - Hệ quản trị cơ sở dữ liệu';
		$this->session->set_userdata('pathCurrent',uri_string());
		$this->session->set_userdata('totalItemPageCurrent',count($listData));
		$this->load->view('backend/layout', $this->data);
	}

	public function viewAndEditOrder($orderCode) {
		if(isset($orderCode) && $this->Morder->order_check_orderCode($orderCode) == TRUE) {
			$infoOrder = $this->Morder->orders_detail_order_code($orderCode);
    		$arrUrl = explode('/', uri_string());
    		$isUpdate = 0;
    		if ($arrUrl[2] == 'update') {
    			$isUpdate = 1;
    		}
    		$this->load->library('form_validation');
			$this->form_validation->set_rules('state', 'Trạng thái đơn hàng', 'required');
	        if ($this->form_validation->run() ==TRUE){
	        	$userCurrent=$this->session->userdata('sessionUserAdmin');
	        	$d=getdate();
	        	$today=$d['year']."/".$d['mon']."/".$d['mday']." ".$d['hours'].":".$d['minutes'].":".$d['seconds'];
	        	$mydata= array(
					'state' => $_POST['state'],
					'updatedAt'=>$today,
					'updatedBy'=>$userCurrent['id']
				);
				$this->Morder->order_update($mydata, $orderCode);
				$this->session->set_flashdata('success', 'Cập nhật đơn hàng thành công');
				redirect('admin/orders', 'refresh');
	        }
			$this->data['infoOrder'] = $infoOrder;
			$this->data['isUpdate'] = $isUpdate;
			$this->data['view']='view';
			$this->data['title']='Chi tiết đơn hàng - Hệ quản trị cơ sở dữ liệu';
			$this->load->view('backend/layout', $this->data);
		} else {
			redirect('404_override', 'refresh');
		}
	}
}