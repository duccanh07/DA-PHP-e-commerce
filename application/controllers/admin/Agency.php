<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Agency extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Mslider');
		$this->load->model('Majaxupload');
		$this->load->library('render_data');
		$this->load->library('upload');
		if(!$this->session->userdata(SESSION_SYSTEM_NAME)){
			redirect('admin/login','refresh');
		}
		$this->data['dataUser']=$this->session->userdata(SESSION_SYSTEM_NAME);
		$this->data['com']='agency';
	}

	public function index(){
		$this->session->set_userdata(SESSION_SAVE_LIST_IMAGES, array());
		$this->data['list']=$this->Mslider->slider_all(STATUS_ACTIVE, TYPE_LOGO_AGENCY);
		$this->data['view']='index';
		$this->data['title']='Quản lý đối tác - Hệ thống quản lý cơ sở dữ liệu';
		$this->load->view('backend/layout', $this->data);
	}

	public function insert(){
		$userCurrent=$this->session->userdata(SESSION_SYSTEM_NAME);
		$d=getdate();
		$today=$d['year']."/".$d['mon']."/".$d['mday']." ".$d['hours'].":".$d['minutes'].":".$d['seconds'];
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Tên', 'required');
		if ($this->form_validation->run() == TRUE){
			$mydata= array(
				'name' =>$_POST['name'], 
				'link_ads' =>$_POST['link_ads'], 
				'type' => TYPE_LOGO_AGENCY,
				'createdAt'=>$today,
				'createdBy'=>$userCurrent['id'],
				'updatedAt'=>$today,
				'updatedBy'=>$userCurrent['id']
			);
			if(isset($_FILES['images']) && $_FILES['images']['name'][0] != null && $_FILES['images']['name'][0] != ''){
				//$config['upload_path'] = 'assets/upload/products';
				$config['upload_path'] = 'upload/agencies';
				$config['allowed_types'] = 'jpeg|jpg|png';
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
		                  //nếu upload thành công thì lưu toàn bộ dữ liệu
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
				$mydata['images'] = json_encode($arrNameImgColors);
				if(isset($_POST['title_image'])) {
					$mydata['title_image'] = json_encode($_POST['title_image']);
				}
				if(isset($_POST['alt_image'])) {
					$mydata['alt_image'] = json_encode($_POST['alt_image']);
				}

				$this->Mslider->slider_insert($mydata);
				$this->session->set_flashdata('success', 'Thêm thành công');
				redirect('admin/agency','refresh');
			}else{
		    	$this->session->set_flashdata('error', 'Hình ảnh là bắt buộc');
				redirect('admin/agency/insert','refresh');
		    }
		} 
		else{
			$this->data['view']='insert';
			$this->data['title']='Thêm đối tác - Hệ thống quản lý cơ sở dữ liệu';
			$this->load->view('backend/layout', $this->data);
		}
	}

	public function update($id){
		if ($this->Mslider->slider_check_id($id)) {
			$sliderDetail=$this->Mslider->slider_detail_id($id);
			$this->data['row']=$sliderDetail;
			$d=getdate();
			$userCurrent=$this->session->userdata(SESSION_SYSTEM_NAME);
			$today=$d['year']."/".$d['mon']."/".$d['mday']." ".$d['hours'].":".$d['minutes'].":".$d['seconds'];
			$this->form_validation->set_rules('name', 'Tên', 'required');
			if ($this->form_validation->run() == TRUE){
				$mydata= array(
					'name' =>$_POST['name'], 
					'link_ads' =>$_POST['link_ads'], 
					'type' => TYPE_LOGO_AGENCY,
					'updatedAt'=>$today,
					'updatedBy'=>$userCurrent['id']
				);
				if(isset($_FILES['images'])){
					$config['upload_path'] = 'upload/agencies';
					$config['allowed_types'] = 'jpeg|jpg|png';
					$config['max_size'] = '10240';
					$this->upload->initialize($config);                                   
					$file  = $_FILES['images'];
			        $count = count($file['name']);
			        $images = json_decode($sliderDetail['images']);
			        for($i = 0; $i < $count; $i++) 
			        {
		              	if ($file['name'][$i] != null && $file['name'][$i] != '') {
		              		$_FILES['images']['name']     = $file['name'][$i];  //khai báo tên của file thứ i
			              	$_FILES['images']['type']     = $file['type'][$i]; //khai báo kiểu của file thứ i
			              	$_FILES['images']['tmp_name'] = $file['tmp_name'][$i]; //khai báo đường dẫn tạm của file thứ i
			          		$_FILES['images']['error']    = $file['error'][$i]; //khai báo lỗi của file thứ i
			              	$_FILES['images']['size']     = $file['size'][$i]; //khai báo kích cỡ của file thứ i
			              	
				              //thực hiện upload từng file
			              	if($this->upload->do_upload('images'))
			          		{
				                  //nếu upload thành công thì lưu toàn bộ dữ liệu
			                  	$data = $this->upload->data();
			             		$images[$i] = $data['file_name'];
			              	}  
		              	}
			        }
					$mydata['images'] = json_encode($images);
					if(isset($_POST['title_image'])) {
						$mydata['title_image'] = json_encode($_POST['title_image']);
					}
					if(isset($_POST['alt_image'])) {
						$mydata['alt_image'] = json_encode($_POST['alt_image']);
					}
				} else {
					$mydata['images'] = '[""]';
				}
				$this->Mslider->slider_update($mydata, $id);
				/* RESET DATA IN SESSION */
				$this->session->set_userdata(SESSION_SAVE_LIST_IMAGES, array());
				$this->session->set_flashdata('success', 'Cập nhật đối tác thành công');
				redirect('admin/agency','refresh');
			} else {
				$this->data['view']='update';
				$this->data['title']='Cập nhật đối tác - Hệ thống quản lý cơ sở dữ liệu';
				$this->load->view('backend/layout', $this->data);
			}
		} else {
			redirect('404','refresh');
		}
	}

	public function delete($id){
		$d=getdate();
		$userCurrent=$this->session->userdata(SESSION_SYSTEM_NAME);
		$today=$d['year']."/".$d['mon']."/".$d['mday']." ".$d['hours'].":".$d['minutes'].":".$d['seconds'];
		$detailSilder=$this->Mslider->slider_detail_id($id);
		$mydata= array('status' => STATUS_DELETE, 'updatedAt'=>$today, 'updatedBy'=>$userCurrent['id']);
		$this->Mslider->slider_update($mydata, $id);
		$this->session->set_flashdata('success', 'Xóa đối tác thành công');
		$listIdOfImages = json_decode($detailSilder['id_image']);
		unlink('upload/agencies/'.$listIdOfImages[0]);
		redirect('admin/agency','refresh');
	}


	public function update_images_agency() {
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			if ($this->Mslider->slider_check_id($_POST['idSlider']) == true) {
				$contentDetail = $this->Mslider->slider_detail_id($_POST['idSlider']);
				$images = json_decode($contentDetail['images']);
				$title_image = json_decode($contentDetail['title_image']);
				$alt_image = json_decode($contentDetail['alt_image']);
				if (sizeof($images) > 0) {
					if (isset($images[$_POST['positionImg']])) {
						$d=getdate();
						$userCurrent=$this->session->userdata(SESSION_SYSTEM_NAME);
						$today=$d['year']."/".$d['mon']."/".$d['mday']." ".$d['hours'].":".$d['minutes'].":".$d['seconds'];
						if ($_POST['type'] == 1) {
							$images[$_POST['positionImg']] = "";
							$title_image[$_POST['positionImg']] = "";
							$alt_image[$_POST['positionImg']] = "";
						} else {
							$newArrayImages = array();
							$newArrayTitleImages = array();
							$newArrayAltImages = array();
							for($i = 0; $i < sizeof($images); $i++) {
								if ($i != $_POST['positionImg']) {
									array_push($newArrayImages, $images[$i]);
								}
							}
							$images = $newArrayImages;
							for($i = 0; $i < sizeof($title_image); $i++) {
								if ($i != $_POST['positionImg']) {
									array_push($newArrayTitleImages, $title_image[$i]);
								}
							}
							$title_image = $newArrayTitleImages;
							for($i = 0; $i < sizeof($alt_image); $i++) {
								if ($i != $_POST['positionImg']) {
									array_push($newArrayAltImages, $alt_image[$i]);
								}
							}
							$alt_image = $newArrayAltImages;
						}
						$this->Mslider->slider_update(
							array(
								'images' => json_encode($images), 
								'title_image' => json_encode($title_image), 
								'alt_image' => json_encode($alt_image), 
								'updatedAt' => $today,
								'updatedBy' => $userCurrent['id']
							), 
							$_POST['idSlider']
						);
						echo json_encode(
							array(
								'code' => RESPONSE_CODE_SUCCESS,
								'msg' => 'Update agency success'
							)
						);
					}
				}

			} else {
				echo json_encode(
					array(
						'code' => RESPONSE_CODE_ERROR,
						'msg' => "Update fail, agency don't exist or deleted"
					)
				);
			}
		} else {
			redirect('404','refresh');
		}
	}
}