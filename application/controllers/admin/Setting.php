<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Setting extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Msetting');
		if(!$this->session->userdata(SESSION_SYSTEM_NAME)){
			redirect('admin/login','refresh');
		}
		$this->data['dataUser']=$this->session->userdata(SESSION_SYSTEM_NAME);
		$this->data['com']='setting';
	}

	public function index(){
                print_r($mydata);
		$this->form_validation->set_rules('seo_title', 'Tiêu đề website', 'required|max_length[70]');
		$this->form_validation->set_rules('seo_keywords', 'Từ khóa website', 'max_length[255]');
		$this->form_validation->set_rules('seo_description', 'Mô tả website', 'max_length[160]');
		$this->form_validation->set_rules('id_app_facebook', 'Frame Facebook', 'required');
		$this->form_validation->set_rules('frame_google_maps', 'Frame Google Maps', 'required');
		$this->form_validation->set_rules('company_name', 'Tên công ty', 'required');
		$this->form_validation->set_rules('business_registration_number', 'Số ĐKKD', 'required');
		$this->form_validation->set_rules('issued_by', 'Đơn vị cấp', 'required');
		$this->form_validation->set_rules('phone_support', 'Số điện thoại hỗ trợ khách hảng', 'required');
		$this->form_validation->set_rules('mail_noreply', 'Email SMTP', 'required|valid_email');
		$this->form_validation->set_rules('smtp_pass', 'Mật khẩu Email SMTP', 'required');
		$this->form_validation->set_rules('smtp_user', 'Email SMTP', 'required');
		$this->form_validation->set_rules('email_store', 'Email cửa hàng', 'required');
		if ($this->form_validation->run() == TRUE) {
			$mydata = array(
				'seo_title' => $_POST['seo_title'],
				'seo_keywords' => $_POST['seo_keywords'],
				'seo_description' => $_POST['seo_description'],
				'seo_keywords' => $_POST['seo_keywords'],
				'address_shop' => $_POST['address_shop'],
				'email_shop' => $_POST['email_shop'],
				'phone_shop' => $_POST['phone_shop'],
				'time_open_shop' => $_POST['time_open_shop'],
				'id_app_facebook' => $_POST['id_app_facebook'],
				'frame_google_maps' => $_POST['frame_google_maps'],
				'zalo' => $_POST['zalo'],
				'company_name' => $_POST['company_name'],
				'business_registration_number' => $_POST['business_registration_number'],
				'issued_by' => $_POST['issued_by'],
				'phone_support' => $_POST['phone_support'],
				'url_messenger_facebook' => $_POST['url_messenger_facebook'],
				'url_google_maps' => $_POST['url_google_maps'],
				'mail_noreply' => $_POST['mail_noreply'],
				'smtp_user' => $_POST['smtp_user'],
				'smtp_pass' => $_POST['smtp_pass'],
				'email_store' => $_POST['email_store'],
				'hotline_shop' => $_POST['hotline_shop'],
				'url_chanel_youtube' => $_POST['url_chanel_youtube'],
				'url_google_plus' => $_POST['url_google_plus'],
				'url_twitter' => $_POST['url_twitter'],
				'url_linkedin' => $_POST['url_linkedin'],
				'url_instagram' => $_POST['url_instagram'],
				'url_pinterest' => $_POST['url_pinterest'],
				'shop_desc' => $_POST['shop_desc'],
				'frame_fanpage_facebook' => $_POST['frame_fanpage_facebook'],
				'frame_subiz_chat' => $_POST['frame_subiz_chat']
			);
			$this->Msetting->setting_update($mydata, 1);
                        // data insert config

		}
		$this->data['detailSetting'] = $this->Msetting->setting_detail_id(1);
		$this->data['view']='index';
		$this->data['title']='Cấu hình hệ thống - Hệ thống quản lý cơ sở dữ liệu';
		$this->load->view('backend/layout', $this->data);
	}

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */