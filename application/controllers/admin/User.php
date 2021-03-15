<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct(){

		parent::__construct();

		$this->load->model('Muser');

		$this->load->library('validate');

		if(!$this->session->userdata(SESSION_SYSTEM_NAME)){

			redirect('admin/login','refresh');

		}

		$this->data['dataUser']=$this->session->userdata(SESSION_SYSTEM_NAME);

		$this->data['com']='user';

	}



	public function index(){

		$this->session->set_userdata(SESSION_SAVE_LIST_IMAGES, array());

		$this->load->library('custom_pagination');

		$pageCurrent=$this->custom_pagination->PageCurrent();

		$firstPage=$this->custom_pagination->PageFirst(TOTAL_ITEM_PAGING, $pageCurrent);

		$totalItem=$this->Muser->users_count(STATUS_ACTIVE, KIND_ADMIN);

		$this->data['strphantrang']=$this->custom_pagination->PagePer($totalItem, $pageCurrent, TOTAL_ITEM_PAGING, $url='admin/user');

		$this->data['list']=$this->Muser->users_all(TOTAL_ITEM_PAGING, $firstPage, STATUS_ACTIVE, KIND_ADMIN);

		$this->data['view']='index';

		$this->data['title']='Quản lý tài khoản - Hệ thống quản lý cơ sở dữ liệu';

		$this->load->view('backend/layout', $this->data);

	}



	public function insert(){

		$this->form_validation->set_rules('username', 'Tên đăng nhập', 'required|is_unique[db_user.username]|min_length[6]|max_length[50]');

		$this->form_validation->set_rules('fullname', 'Họ và tên', 'required|min_length[6]|max_length[50]');

		$this->form_validation->set_rules('password', 'Mật khẩu', 'required|min_length[6]|max_length[32]');

		if ($this->form_validation->run() == TRUE){

			$mydata= array(

				'username' => $_POST['username'], 

				'fullname' => $_POST['fullname'], 

				'password' => md5($_POST['password']), 

				'address' => $_POST['address'],

				'birthday' => $_POST['birthday'], 

				'kind' => KIND_ADMIN,

				'status' => STATUS_ACTIVE

			);

			$check = true;



			if ($_POST['email'] != '') {

				if ($this->validate->check_email_address($_POST['email'])) {

					if ($this->Muser->user_check_field($_POST['email'], 'email') == false) {

						$mydata['email'] = $_POST['email'];

					} else {

						$check = false;

						$this->data['errorForm'] = 'Email hoặc số điện thoại đã được sử dụng';

					}

				} else {

					$check = false;

					$this->data['errorForm'] = 'Email hoặc số điện thoại không hợp lệ';

				}

			}



			if ($_POST['phone'] != '') {

				if ($this->validate->check_phone_number($_POST['phone'])) {

					if ($this->Muser->user_check_field($_POST['phone'], 'phone') == false) {

						$mydata['phone'] = $_POST['phone'];

					} else {

						$check = false;

						$this->data['errorForm'] = 'Email hoặc số điện thoại đã được sử dụng';

					}

				} else {

					$check = false;

					$this->data['errorForm'] = 'Email hoặc số điện thoại không hợp lệ';

				}

			}



			if($check == true) {

				$this->Muser->user_insert($mydata);

				$this->session->set_flashdata('success', 'Thêm thành viên thành công');

				redirect('admin/user','refresh');

			} else {

				$this->data['view']='insert';

				$this->data['title']='Thêm tài khoản - Hệ thống quản lý cơ sở dữ liệu';

				$this->load->view('backend/layout', $this->data);

			}

		} else{

			$this->data['view']='insert';

			$this->data['title']='Thêm tài khoản - Hệ thống quản lý cơ sở dữ liệu';

			$this->load->view('backend/layout', $this->data);

		}

	}



	public function update($id){

		if ($this->Muser->user_check_id($id, KIND_ADMIN)) {

			$row=$this->Muser->user_detail_id($id);

			$this->data['row']=$row;

			$this->form_validation->set_rules('fullname', 'Họ và tên', 'required|min_length[6]|max_length[100]');

			if ($this->form_validation->run() == TRUE){

				$mydata= array(

					'fullname' =>$_POST['fullname'],

					'address'=>$_POST['address'],

					'birthday'=>$_POST['birthday']

				);

				if (isset($_POST['new_password']) && $_POST['new_password'] != '') {
					$mydata['password'] = md5($_POST['new_password']);
				}
				

				$this->Muser->user_update($mydata, $id);

				$this->session->set_flashdata('success', 'Cập nhật tài khoản thành công');

				redirect('admin/user','refresh');

			} 

			$this->data['view']='update';

			$this->data['title']='Cập nhật tài khoản - Hệ thống quản lý cơ sở dữ liệu';

			$this->load->view('backend/layout', $this->data);

		} else {

			redirect('404','refresh');

		}

	}



	public function delete($id){

		if ($this->Muser->user_check_id($id, KIND_ADMIN)) {

			$mydata= array('status' => STATUS_DELETE);

			$sessionUserAdmin = $this->session->userdata(SESSION_SYSTEM_NAME);

			if ($id == $sessionUserAdmin['id']) {

				$this->session->set_flashdata('error', 'Không thể xóa chính mình');

			} else {

				$this->Muser->user_update($mydata, $id);

				$this->session->set_flashdata('success', 'Xóa tài khoản thành công');

			}

			redirect('admin/user','refresh');

		} else {

			redirect('404','refresh');

		}

	}



	public function logout(){

        $array_items = array(SESSION_SYSTEM_NAME);

        $this->session->unset_userdata($array_items);

        redirect(base_url().'admin','refresh');

    }

}