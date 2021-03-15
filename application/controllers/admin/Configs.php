<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Configs extends CI_Controller {

	public $infoUserLogin;

	public function __construct(){
		parent::__construct();
		$this->load->model('backend/Mconfig');
		$this->load->model('Msetting');
		if(!$this->session->userdata(SESSION_SYSTEM_NAME)){
			redirect('admin/login','refresh');
		}
		$this->load->library('upload');
		$this->data['dataUser']=$this->session->userdata(SESSION_SYSTEM_NAME);
		$this->data['com']='configs';
		$this->infoUserLogin = getInfoUserHelper();
	}

	public function index(){
		$this->data['list']=$this->Mconfig->configsAll();
		$this->data['view']='index';
		$this->data['title']='Quản lý cấu hình - Hệ thống quản lý cơ sở dữ liệu';
		$this->load->view('backend/layout', $this->data);
	}

	public function update($id) {
		if ($this->Mconfig->configCheckField('id', $id)) {
			$detailConfig = $this->Mconfig->configDetailId($id);
			switch ($detailConfig['code']) {
				case CONFIG_CODE_SEO_WEB:
					$this->form_validation->set_rules('seoTitle', 'Tiêu đề website', 'required|max_length[70]');
					$this->form_validation->set_rules('seoKeywords', 'Từ khóa website', 'max_length[255]');
					$this->form_validation->set_rules('seoDescription', 'Mô tả website', 'max_length[160]');
					break;
				case CONFIG_CODE_LOGO: case CONFIG_CODE_LOGO_FOOTER: case CONFIG_CODE_HOME_ICONS: case CONFIG_CODE_ICONS_CONTACT: case CONFIG_CODE_FOOTER: case CONFIG_CODE_CONTACT_SHOP:
					$this->form_validation->set_rules('name', 'Tên cấu hình', 'required');
					break;
				case CONFIG_CODE_MAIL_SMTP:
					$this->form_validation->set_rules('mailHost', 'Địa chỉ host email', 'required');
					$this->form_validation->set_rules('mailPort', 'Cổng kết nối email', 'required');
					$this->form_validation->set_rules('mailNoReply', 'Email gửi', 'required');
					$this->form_validation->set_rules('mailSMTPUser', 'Email SMTP', 'required');
					$this->form_validation->set_rules('mailSMTPPass', 'Mật khẩu SMTP', 'required');
					break;
				default:
					redirect('404', 'refresh');
			}
			if ($this->form_validation->run() == TRUE) {

				$mydata = array();
                                $dataEmail = array();

				if (isset($_POST['name'])) {
					$mydata['name'] = $_POST['name'];
				}

				switch ($detailConfig['code']) {
					case CONFIG_CODE_SEO_WEB:
						$value = array();
						if (isset($_POST['seoTitle'])) {
							$value['seoTitle'] = $_POST['seoTitle'];
						} else {
							$value['seoTitle'] = '';
						}

						if (isset($_POST['seoDescription'])) {
							$value['seoDescription'] = $_POST['seoDescription'];
						} else {
							$value['seoDescription'] = '';
						}

						if (isset($_POST['seoKeywords'])) {
							$value['seoKeywords'] = $_POST['seoKeywords'];
						} else {
							$value['seoKeywords'] = '';
						}

						$mydata['value'] = json_encode($value);
						break;
					case CONFIG_CODE_CONTACT_SHOP:
						$value = array();
						if (isset($_POST['addressShop'])) {
							$value['addressShop'] = $_POST['addressShop'];
						} else {
							$value['addressShop'] = '';
						}

						if (isset($_POST['emailShop'])) {
							$value['emailShop'] = $_POST['emailShop'];
						} else {
							$value['emailShop'] = '';
						}

						if (isset($_POST['hotlineShop'])) {
							$value['hotlineShop'] = $_POST['hotlineShop'];
						} else {
							$value['hotlineShop'] = '';
						}

						if (isset($_POST['phoneShop'])) {
							$value['phoneShop'] = $_POST['phoneShop'];
						} else {
							$value['phoneShop'] = '';
						}

						if (isset($_POST['timeOpenShop'])) {
							$value['timeOpenShop'] = $_POST['timeOpenShop'];
						} else {
							$value['timeOpenShop'] = '';
						}

						if (isset($_POST['phoneSupport'])) {
							$value['phoneSupport'] = $_POST['phoneSupport'];
						} else {
							$value['phoneSupport'] = '';
						}

						$mydata['value'] = json_encode($value);
						break;
					case CONFIG_CODE_FOOTER:
						$value = array();
						if (isset($_POST['shopDesc'])) {
							$value['shopDesc'] = $_POST['shopDesc'];
						} else {
							$value['shopDesc'] = '';
						}

						if (isset($_POST['frameGoogleMaps'])) {
							$value['frameGoogleMaps'] = $_POST['frameGoogleMaps'];
						} else {
							$value['frameGoogleMaps'] = '';
						}

						if (isset($_POST['frameFanpageFacebook'])) {
							$value['frameFanpageFacebook'] = $_POST['frameFanpageFacebook'];
						} else {
							$value['frameFanpageFacebook'] = '';
						}

						if (isset($_POST['businessRegistrationNumber'])) {
							$value['businessRegistrationNumber'] = $_POST['businessRegistrationNumber'];
						} else {
							$value['businessRegistrationNumber'] = '';
						}

						if (isset($_POST['companyName'])) {
							$value['companyName'] = $_POST['companyName'];
						} else {
							$value['companyName'] = '';
						}

						if (isset($_POST['issuedBy'])) {
							$value['issuedBy'] = $_POST['issuedBy'];
						} else {
							$value['issuedBy'] = '';
						}

						$mydata['value'] = json_encode($value);
						break;
					case CONFIG_CODE_LOGO: case CONFIG_CODE_LOGO_FOOTER:
						$detailConfig['value'] = json_decode($detailConfig['value']);
						$value = array(
							'images' => '[""]',
							'titleImages' => '[""]',
							'altImages' => '[""]'
						);

						if ($detailConfig['value']->images != '' && $detailConfig['value']->images != '[""]') {
							$value['images'] = $detailConfig['value']->images;
						}

						if ($detailConfig['value']->altImages != '' && $detailConfig['value']->altImages != '[""]') {
							$value['altImages'] = $detailConfig['value']->altImages;
						}

						if ($detailConfig['value']->titleImages != '' && $detailConfig['value']->titleImages != '[""]') {
							$value['titleImages'] = $detailConfig['value']->titleImages;
						}

						if(isset($_FILES['images']) && $_FILES['images']['name'][0] != null && $_FILES['images']['name'][0] != ''){
							$config['upload_path'] = 'upload';
							$config['allowed_types'] = '*';
							$config['max_size'] = '10240';
							$this->upload->initialize($config);                                   
							$file  = $_FILES['images'];
					        $count = count($file['name']);
					        $img = "";
					        for($i=0; $i<=$count-1; $i++) 
					        {
				              	$_FILES['images']['name']     = $file['name'][$i];  //khai báo tên của file thứ i
				              	$_FILES['images']['type']     = $file['type'][$i]; //khai báo kiểu của file thứ i
				              	$_FILES['images']['tmp_name'] = $file['tmp_name'][$i]; //khai báo đường dẫn tạm của file thứ i
				          		$_FILES['images']['error']    = $file['error'][$i]; //khai báo lỗi của file thứ i
				              	$_FILES['images']['size']     = $file['size'][$i]; //khai báo kích cỡ của file thứ i

				              	if($this->upload->do_upload('images'))
				          		{
				                  	$data = $this->upload->data();
				             		$img .= $data['file_name'].'#';
				              	} 
					        }
					        $arrNameImgColors = explode('#', $img);
					        for($i = 0; $i < sizeof($arrNameImgColors); $i++) {
					        	if ($arrNameImgColors[$i] == "") {
					        		unset($arrNameImgColors[$i]);
					        	}
					        }

							$value['images'] = json_encode($arrNameImgColors);

						}

						if(isset($_POST['titleImages'])) {
							$value['titleImages'] = json_encode($_POST['titleImages']);
						}

						if(isset($_POST['altImages'])) {
							$value['altImages'] = json_encode($_POST['altImages']);
						}

						$mydata['value'] = json_encode($value);

						break;
					case CONFIG_CODE_MAIL_SMTP:

						$value = (array)json_decode($detailConfig['value']);
						if (isset($_POST['mailHost'])) {
							$value['mailHost'] = $_POST['mailHost'];
						} else {
							$value['mailHost'] = '';
						}
						if (isset($_POST['mailPort'])) {
							$value['mailPort'] = $_POST['mailPort'];
						} else {
							$value['mailPort'] = '';
						}
						if (isset($_POST['mailNoReply'])) {
							$value['mailNoReply'] = $_POST['mailNoReply'];
                                                        $dataEmail['mail_noreply'] = $_POST['mailNoReply'];
						} else {
							$value['mailNoReply'] = '';
						}
						if (isset($_POST['mailSMTPUser'])) {
							$value['mailSMTPUser'] = $_POST['mailSMTPUser'];
                                                        $dataEmail['smtp_user'] = $_POST['mailSMTPUser'];
						} else {
							$value['mailSMTPUser'] = '';
						}
						if (isset($_POST['mailSMTPPass'])) {
							$value['mailSMTPPass'] = $_POST['mailSMTPPass'];
							$dataEmail['smtp_pass'] = $_POST['mailSMTPPass'];
						} else {
							$value['mailSMTPPass'] = '';
						}
						if (isset($_POST['emailStore'])) {
							$value['emailStore'] = $_POST['emailStore'];
						} else {
							$value['emailStore'] = '';
						}
						$mydata['value'] = json_encode($value);
                                                 
			                        $this->Msetting->setting_update($dataEmail, 1);
						break;
					case CONFIG_CODE_ICONS_CONTACT:
						$value = array();
						if (isset($_POST['zalo'])) {
							$value['zalo'] = $_POST['zalo'];
						} else {
							$value['zalo'] = '';
						}

						if (isset($_POST['urlMessengerFacebook'])) {
							$value['urlMessengerFacebook'] = $_POST['urlMessengerFacebook'];
						} else {
							$value['urlMessengerFacebook'] = '';
						}

						if (isset($_POST['urlGoogleMaps'])) {
							$value['urlGoogleMaps'] = $_POST['urlGoogleMaps'];
						} else {
							$value['urlGoogleMaps'] = '';
						}

						if (isset($_POST['frameSubizChat'])) {
							$value['frameSubizChat'] = $_POST['frameSubizChat'];
						} else {
							$value['frameSubizChat'] = '';
						}
						
						if (isset($_POST['idAppFacebook'])) {
							$value['idAppFacebook'] = $_POST['idAppFacebook'];
						} else {
							$value['idAppFacebook'] = '';
						}

						$mydata['value'] = json_encode($value);
						break;
					default:
						break;
				}

				$this->Mconfig->configUpdate($mydata, $id);

				$this->session->set_flashdata('success', 'Cập nhật cấu hình thành công');
				redirect('admin/configs','refresh');
			}
			$detailSetting = $this->Mconfig->configDetailId($id);
			$detailSetting['value'] = json_decode($detailSetting['value']);
			$this->data['detailSetting'] = $detailSetting;
			$this->data['view']='update';
			$this->data['title']='Cập nhật cấu hình - Hệ thống quản lý cơ sở dữ liệu';
			$this->load->view('backend/layout', $this->data);
		} else {
			redirect('404', 'refresh');
		}
	}

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */