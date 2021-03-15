<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Policies extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Mpolicies');
		$this->load->model('Majaxupload');
		$this->load->library('render_data');
		$this->load->library('upload');
		if(!$this->session->userdata(SESSION_SYSTEM_NAME)){
			redirect('admin/login','refresh');
		}
		$this->data['dataUser']=$this->session->userdata(SESSION_SYSTEM_NAME);
		$this->data['com']='policies';
	}

	public function index(){
		$this->session->set_userdata(SESSION_SAVE_LIST_IMAGES, array());
		$this->data['list']=$this->Mpolicies->policies_all();
		$this->data['view']='index';
		$this->data['title']='Quản lý chính sách - Hệ thống quản lý cơ sở dữ liệu';
		$this->load->view('backend/layout', $this->data);
	}

	public function update($id){
		if ($this->Mpolicies->policies_check_id($id)) {
			$policiesDetail=$this->Mpolicies->policies_detail_id($id);
			$this->data['row']=$policiesDetail;
			$d=getdate();
			$userCurrent=$this->session->userdata(SESSION_SYSTEM_NAME);
			$today=$d['year']."/".$d['mon']."/".$d['mday']." ".$d['hours'].":".$d['minutes'].":".$d['seconds'];
			$this->form_validation->set_rules('name', 'Tên ', 'required');
			$this->form_validation->set_rules('description', 'Nội dung ', 'required');
			$this->form_validation->set_rules('ordering', 'Sắp xếp ', 'required|greater_than[0]');
			if ($this->form_validation->run() == TRUE){
				$mydata= array(
					'description' =>$_POST['description'], 
					'name' =>$_POST['name'],
					'ordering' =>$_POST['ordering'],
					'updatedAt'=>$today,
					'updatedBy'=>$userCurrent['id']
				);
				if(isset($_FILES['images'])){
					$config['upload_path'] = 'upload/policies';
					$config['allowed_types'] = 'jpeg|jpg|png';
					$config['max_size'] = '10240';
					$this->upload->initialize($config);                                   
					$file  = $_FILES['images'];
			        $count = count($file['name']);
			        $images = json_decode($policiesDetail['images']);
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
				$this->Mpolicies->policies_update($mydata, $id);
				/* RESET DATA IN SESSION */
				$this->session->set_userdata(SESSION_SAVE_LIST_IMAGES, array());
				$this->session->set_flashdata('success', 'Cập nhật chính sách thành công');
				redirect('admin/policies','refresh');
			} else {
				$this->data['view']='update';
				$this->data['title']='Cập nhật chính sách - Hệ thống quản lý cơ sở dữ liệu';
				$this->load->view('backend/layout', $this->data);
			}
		} else {
			redirect('404','refresh');
		}
	}

	public function update_images_policie() {
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			if ($this->Mpolicies->policies_check_id($_POST['idSlider']) == true) {
				$contentDetail = $this->Mpolicies->policies_detail_id($_POST['idSlider']);
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
						$this->Mpolicies->policies_update(
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
								'msg' => 'Update policies success'
							)
						);
					}
				}

			} else {
				echo json_encode(
					array(
						'code' => RESPONSE_CODE_ERROR,
						'msg' => "Update fail, policies don't exist or deleted"
					)
				);
			}
		} else {
			redirect('404','refresh');
		}
	}
}