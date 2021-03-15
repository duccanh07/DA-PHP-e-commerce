<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class CustomerFeedback extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Mcustomer_feedback');
		$this->load->model('Majaxupload');
		$this->load->library('upload');
		if(!$this->session->userdata(SESSION_SYSTEM_NAME)){
			redirect('admin/login','refresh');
		}
		$this->data['dataUser']=$this->session->userdata(SESSION_SYSTEM_NAME);
		$this->data['com']='customer_feedback';
	}

	public function index(){
		$this->session->set_userdata(SESSION_SAVE_LIST_IMAGES, array());
		$pageCurrent=$this->phantrang->PageCurrent();
		$firstPage=$this->phantrang->PageFirst(TOTAL_ITEM_PAGING, $pageCurrent);
		$totalItem=$this->Mcustomer_feedback->customers_feedback_count(STATUS_ACTIVE);
		$this->data['paginations']=$this->phantrang->PagePer($totalItem, $pageCurrent, TOTAL_ITEM_PAGING, $url='admin/customer-feedback');
		$listData=$this->Mcustomer_feedback->customers_feedback_all(TOTAL_ITEM_PAGING, $firstPage);
		$this->data['list']=$listData;
		$this->session->set_userdata('pathCurrent',uri_string());
		$this->session->set_userdata('totalItemPageCurrent',count($listData));
		$this->data['view']='index';
		$this->data['title']='Quản lý ý kiến khách hàng - Hệ thống quản lý cơ sở dữ liệu';
		$this->load->view('backend/layout', $this->data);
	}

	public function insert() {
		$userCurrent=$this->session->userdata(SESSION_SYSTEM_NAME);
		$d=getdate();
		$today=$d['year']."/".$d['mon']."/".$d['mday']." ".$d['hours'].":".$d['minutes'].":".$d['seconds'];
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name_customer', 'Tên khách hàng', 'required');
		$this->form_validation->set_rules('content', 'Nội dung phải hồi', 'required');
		if ($this->form_validation->run() == TRUE){
			$mydata= array(
				'name_customer' =>$_POST['name_customer'], 
				'content' =>$_POST['content'],
				'createdAt'=>$today,
				'createdBy'=>$userCurrent['id'],
				'updatedAt'=>$today,
				'updatedBy'=>$userCurrent['id'],
				'status' => STATUS_ACTIVE
			);
			if(isset($_FILES['images']) && $_FILES['images']['name'][0] != null && $_FILES['images']['name'][0] != ''){
				//$config['upload_path'] = 'assets/upload/products';
				$config['upload_path'] = 'upload/customers-feedback';
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

				$this->Mcustomer_feedback->customers_feedback_insert($mydata);
				$this->session->set_flashdata('success', 'Thêm thành công');
				redirect('admin/customer-feedback','refresh');
			}else{
		    	$this->session->set_flashdata('error', 'Hình ảnh là bắt buộc');
				redirect('admin/customer-feedback/insert','refresh');
		    }
		}else{
			$this->data['view']='insert';
			$this->data['title']='Thêm ý kiến khách hàng - Hệ thống quản lý cơ sở dữ liệu';
			$this->load->view('backend/layout', $this->data);
		}
	}

	public function update($id){
		if ($this->Mcustomer_feedback->customer_feedback_check_id($id)) {
			$customer_feedbackDetail=$this->Mcustomer_feedback->customer_feedback_detail_id($id);
			$this->data['row']=$customer_feedbackDetail;
			$d=getdate();
			$userCurrent=$this->session->userdata(SESSION_SYSTEM_NAME);
			$today=$d['year']."/".$d['mon']."/".$d['mday']." ".$d['hours'].":".$d['minutes'].":".$d['seconds'];
			$this->form_validation->set_rules('name_customer', 'Tên khách hàng', 'required');
			$this->form_validation->set_rules('content', 'Nội dung phải hồi', 'required');
			if ($this->form_validation->run() == TRUE){
				$mydata= array(
					'name_customer' =>$_POST['name_customer'], 
					'title_image' =>$_POST['title_image'], 
					'alt_image' =>$_POST['alt_image'], 
					'content' =>$_POST['content'],
					'updatedAt'=>$today,
					'updatedBy'=>$userCurrent['id']
				);
				if(isset($_FILES['images'])){
					$config['upload_path'] = 'upload/customers-feedback';
					$config['allowed_types'] = 'jpeg|jpg|png';
					$config['max_size'] = '10240';
					$this->upload->initialize($config);                                   
					$file  = $_FILES['images'];
			        $count = count($file['name']);
			        $images = json_decode($customer_feedbackDetail['images']);
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
				$this->Mcustomer_feedback->customers_feedback_update($mydata, $id);
				/* RESET DATA IN SESSION */
				$this->session->set_userdata(SESSION_SAVE_LIST_IMAGES, array());
				$this->session->set_flashdata('success', 'Cập nhật ý kiến khách hàng thành công');
				redirect('admin/customer-feedback','refresh');
			} else {
				$this->data['view']='update';
				$this->data['title']='Cập nhật ý kiến khách hàng - Hệ thống quản lý cơ sở dữ liệu';
				$this->load->view('backend/layout', $this->data);
			}
		} else {
			redirect('404','refresh');
		}
	}

	public function delete($id){
		if ($this->Mcustomer_feedback->customer_feedback_check_id($id)) {
			$d=getdate();
			$userCurrent=$this->session->userdata(SESSION_SYSTEM_NAME);
			$today=$d['year']."/".$d['mon']."/".$d['mday']." ".$d['hours'].":".$d['minutes'].":".$d['seconds'];
			$mydata= array(
				'updatedAt'=>$today,
				'updatedBy'=>$userCurrent['id'],
				'status' => STATUS_DELETE
			);
			$this->Mcustomer_feedback->customers_feedback_update($mydata, $id);
			$this->session->set_flashdata('success', 'Xóa ý kiến khách hàng thành công');
			redirect('admin/customer-feedback','refresh');
		} else {
			redirect('404','refresh');
		}
	}

	public function update_images_customer_feedback() {
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			if ($this->Mcustomer_feedback->customer_feedback_check_id($_POST['idSlider']) == true) {
				$contentDetail = $this->Mcustomer_feedback->customer_feedback_detail_id($_POST['idSlider']);
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
						$this->Mcustomer_feedback->customers_feedback_update(
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
								'msg' => 'Update customer feedback success'
							)
						);
					}
				}

			} else {
				echo json_encode(
					array(
						'code' => RESPONSE_CODE_ERROR,
						'msg' => "Update fail, customer feedback don't exist or deleted"
					)
				);
			}
		} else {
			redirect('404','refresh');
		}
	}

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */