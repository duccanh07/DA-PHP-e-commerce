<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Content extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Mcategory');
		$this->load->model('Mcontent');
		$this->load->model('Muser');
		$this->load->model('Majaxupload');
		$this->load->library('upload');
		$this->load->library('image_lib');
    	$config['image_library'] = 'GD2';
		if(!$this->session->userdata(SESSION_SYSTEM_NAME)){
			redirect('admin/login','refresh');
		}
		$this->data['dataUser']=$this->session->userdata(SESSION_SYSTEM_NAME);
		$this->data['com']='content';
	}

	public function index(){
		$this->session->set_userdata('pathCurrent',uri_string());
		$this->session->set_userdata(SESSION_SAVE_LIST_IMAGES, array());
		$category_id = '';
		$keyword = '';
		if (isset($_GET['cat'])) {
			$category_id = (int)$_GET['cat'];
		}
		if (isset($_GET['keyword'])) {
			$keyword = $_GET['keyword'];
		}
		if ($category_id != null) {
			if ($this->Mcategory->category_check_field('id', $category_id) == FALSE) {
				echo '<script type="text/javascript">alert("Dữ liệu lọc không đúng, thử lại");</script>';
			} else {
				$this->data['infoCategory'] = $this->Mcategory->category_detail($category_id);
			}
		} 

		if (isset($_GET['page'])) {
			$firstPage = (int)$_GET['page'] * TOTAL_ITEM_PAGING;
			$pageCurrent = ((int)$_GET['page']) + 1;
		} else {
			$pageCurrent=$this->phantrang->PageCurrent();
			$firstPage=$this->phantrang->PageFirst(TOTAL_ITEM_PAGING, $pageCurrent);
		}
		$totalItem=$this->Mcontent->content_count(STATUS_ACTIVE, $_GET);
		$this->data['paginations']=$this->phantrang->PagePer($totalItem, $pageCurrent, TOTAL_ITEM_PAGING, $url='admin/content');
		$listData = $this->Mcontent->content_all(STATUS_ACTIVE, TOTAL_ITEM_PAGING, $firstPage, $_GET);
		$this->data['list'] = $listData;
		$this->session->set_userdata('pathCurrent',uri_string());
		$this->session->set_userdata('totalItemPageCurrent',count($listData));
		$this->data['view']='index';
		$this->data['htmlCategory'] = $this->get_list_categories(
			$html, 
			$this->Mcategory->category_all('all', STATUS_ACTIVE, '', '', true, TYPE_CATEGORY_CONTENT, TYPE_CATEGORY_DU_AN, TYPE_CATEGORY_CONTENT_ONE),
			DEFAULT_PARENT_ID,
			'',
			''
		);
		$this->data['title']='Quản lý bài viết - Hệ thống quản trị cơ sở dữ liệu';
		$this->load->view('backend/layout', $this->data);
	}

	public function get_list_categories(&$html, $listCategories, $parent_id = DEFAULT_PARENT_ID ,$name = '', $id_current = null) {
		foreach ($listCategories as $key =>$value) {
            if($value['parent_id'] == $parent_id){
            	$html.= "<option name='parent_id' data-type=".$value['type']."  value=".$value['id'].">".$name.$value['name']."</option>";
         		unset($listCategories[$key]);
            	$this->get_list_categories($html, $listCategories, $value['id'], $name.'---| ');
            }
            
        }
        return $html;
	}

	public function insert(){
		$d=getdate();
		$userCurrent=$this->session->userdata(SESSION_SYSTEM_NAME);
		$this->load->library('alias');
		$today=$d['year']."/".$d['mon']."/".$d['mday']." ".$d['hours'].":".$d['minutes'].":".$d['seconds'];
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'Tiêu đề bài viết', 'required|max_length[255]');
		$this->form_validation->set_rules('seo_title', 'SEO tiêu đề', 'required|max_length[70]');
		$this->form_validation->set_rules('seo_keywords', 'SEO từ khóa', 'required|max_length[255]');
		$this->form_validation->set_rules('seo_description', 'SEO mô tả', 'required|max_length[160]');
		$this->form_validation->set_rules('category_id', 'Danh mục bài viết', 'required');
		if ($this->form_validation->run() == TRUE){
			
			$mydata= array(
				'title' =>$_POST['title'], 
				'short_description' => $_POST['short_description'],
				'description' => $_POST['description'],
				'category_id' => $_POST['category_id'],
				'seo_google' => $_POST['seo_google'],
				'seo_facebook' => $_POST['seo_facebook'],
				'seo_title' => $_POST['seo_title'],
				'seo_keywords' => $_POST['seo_keywords'],
				'seo_description' => $_POST['seo_description'],
				'type' => $_POST['type'],
				'createdAt' => $today,
				'createdBy' => $userCurrent['id'],
				'updatedAt' => $today,
				'updatedBy' => $userCurrent['id'],
				'title_image' => $_POST['title_image'],
				'alt_image' => $_POST['alt_image'],
				'status' => STATUS_ACTIVE
			);

			if (isset($_POST['urlVideo'])) {
				$mydata['urlVideo'] = $_POST['urlVideo'];
			}

			if (strlen($_POST['alias']) > 0) {
				$mydata['alias'] = $_POST['alias'];
			} else {
				$mydata['alias'] = $this->alias->str_alias($_POST['title']);
			}

			$category_detail = $this->Mcategory->category_detail($_POST['category_id']);
			
			if(isset($_FILES['images']) && $_FILES['images']['name'][0] != null && $_FILES['images']['name'][0] != ''){
				//$config['upload_path'] = 'assets/upload/products';
				$config['upload_path'] = 'upload/contents';
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
		            
		            if ($category_detail['type'] != TYPE_CATEGORY_CONTENT_ONE) {
		            	$config['source_image'] = $file['tmp_name'][$i];
						$config['wm_type'] = 'overlay';
	                    $config['wm_overlay_path'] = 'assets/images/logo-w.png';
	                    $config['wm_x_transp'] = 4;
	                    $config['wm_y_transp'] = 4;
	                    $config['width'] = 100;
	                    $config['height'] = 100;
	                    $config['wm_vrt_alignment'] = 'middle';
	                    $config['wm_hor_alignment'] = 'center';
	                    $this->image_lib->initialize($config);
	                    $this->image_lib->watermark();
		            }

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

				$this->Mcontent->content_insert($mydata);
				$this->session->set_flashdata('success', 'Thêm bài viết thành công');
				redirect('admin/content','refresh');
			}else{
		    	$this->session->set_flashdata('error', 'Hình ảnh của bài viết là bắt buộc');
				redirect('admin/content/insert','refresh');
		    }
		}else{
			$this->data['htmlCategory'] = $this->get_list_categories(
				$html, 
				$this->Mcategory->category_all('all', STATUS_ACTIVE, '', '', true, TYPE_CATEGORY_CONTENT, TYPE_CATEGORY_DU_AN, TYPE_CATEGORY_CONTENT_ONE, TYPE_CATEGORY_VIDEO_CONG_TRINH),
				DEFAULT_PARENT_ID,
				'',
				''
			);
			$this->data['view']='insert';
			$this->data['title']='Thêm bài viết  mới - Hệ thống quản trị cơ sở dữ liệu';
			$this->load->view('backend/layout', $this->data);
		}
	}

	public function update($id){
		$userCurrent=$this->session->userdata(SESSION_SYSTEM_NAME);
		$contentDetail = $this->Mcontent->content_detail($id);
		$this->data['row'] = $contentDetail;
		$d=getdate();
		$today=$d['year']."/".$d['mon']."/".$d['mday']." ".$d['hours'].":".$d['minutes'].":".$d['seconds'];
		$this->load->library('alias');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'Tiêu đề bài viết', 'required|max_length[255]');
		$this->form_validation->set_rules('seo_title', 'SEO tiêu đề', 'required|max_length[70]');
		$this->form_validation->set_rules('seo_keywords', 'SEO từ khóa', 'required|max_length[255]');
		$this->form_validation->set_rules('seo_description', 'SEO mô tả', 'required|max_length[160]');
		$this->form_validation->set_rules('category_id', 'Danh mục bài viết', 'required');
		if ($this->form_validation->run() == TRUE){
			$mydata= array(
				'title' =>$_POST['title'], 
				'short_description' => $_POST['short_description'],
				'description' => $_POST['description'],
				'category_id' => $_POST['category_id'],
				'seo_google' => $_POST['seo_google'],
				'seo_facebook' => $_POST['seo_facebook'],
				'seo_title' => $_POST['seo_title'],
				'seo_keywords' => $_POST['seo_keywords'],
				'seo_description' => $_POST['seo_description'],
				'updatedAt' => $today,
				'updatedBy' => $userCurrent['id'],
				'title_image' => $_POST['title_image'],
				'alt_image' => $_POST['alt_image'],
				'type' => $_POST['type']
			);

			if (strlen($_POST['alias']) > 0) {
				$mydata['alias'] = $_POST['alias'];
			} else {
				$mydata['alias'] = $this->alias->str_alias($_POST['title']);
			}
			if (isset($_POST['urlVideo'])) {
				$mydata['urlVideo'] = $_POST['urlVideo'];
			}
			$category_detail = $this->Mcategory->category_detail($_POST['category_id']);
			if(isset($_FILES['images'])){
				$config['upload_path'] = 'upload/contents';
				$config['allowed_types'] = 'jpeg|jpg|png';
				$config['max_size'] = '10240';
				$this->upload->initialize($config);                                   
				$file  = $_FILES['images'];
		        $count = count($file['name']);
		        $images = json_decode($contentDetail['images']);
		        for($i = 0; $i < $count; $i++) 
		        {
	              	if ($file['name'][$i] != null && $file['name'][$i] != '') {
	              		$_FILES['images']['name']     = $file['name'][$i];  //khai báo tên của file thứ i
		              	$_FILES['images']['type']     = $file['type'][$i]; //khai báo kiểu của file thứ i
		              	$_FILES['images']['tmp_name'] = $file['tmp_name'][$i]; //khai báo đường dẫn tạm của file thứ i
		          		$_FILES['images']['error']    = $file['error'][$i]; //khai báo lỗi của file thứ i
		              	$_FILES['images']['size']     = $file['size'][$i]; //khai báo kích cỡ của file thứ i
		              	
		              	if ($category_detail['type'] != TYPE_CATEGORY_CONTENT_ONE) {
		              		$config['source_image'] = $file['tmp_name'][$i];
				            $config['wm_type'] = 'overlay';
		                    $config['wm_overlay_path'] = 'assets/images/logo-w.png';
		                    $config['wm_x_transp'] = 4;
		                    $config['wm_y_transp'] = 4;
		                    $config['width'] = 100;
		                    $config['height'] = 100;
		                    $config['wm_vrt_alignment'] = 'middle';
		                    $config['wm_hor_alignment'] = 'center';
				            $this->image_lib->initialize($config);
				            $this->image_lib->watermark();
			              //thực hiện upload từng file
		              	}
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


			$this->Mcontent->content_update_topicId($mydata, array($id));
			
			$this->session->set_flashdata('success', 'Cập nhật bài viết thành công');
			redirect('admin/content','refresh');
		}
		$this->data['view']='update';
		$this->data['htmlCategory'] = $this->get_list_categories(
				$html, 
				$this->Mcategory->category_all('all', STATUS_ACTIVE, '', '', true, TYPE_CATEGORY_CONTENT, TYPE_CATEGORY_DU_AN, TYPE_CATEGORY_CONTENT_ONE, TYPE_CATEGORY_VIDEO_CONG_TRINH),
				DEFAULT_PARENT_ID,
				'',
				''
			);
		$this->data['title']='Cập nhật danh mục bài viết - Hệ thống quản trị cơ sở dữ liệu';
		$this->load->view('backend/layout', $this->data);
	}

	public function delete($id){
		$d=getdate();
		$userCurrent=$this->session->userdata(SESSION_SYSTEM_NAME);
		$today=$d['year']."/".$d['mon']."/".$d['mday']." ".$d['hours'].":".$d['minutes'].":".$d['seconds'];
		$detailContent=$this->Mcontent->content_detail($id);
		$mydata= array('status' => STATUS_DELETE, 'updatedAt'=>$today, 'updatedBy'=>$userCurrent['id']);
		$this->Mcontent->content_update_topicId($mydata, array($id));
		$this->session->set_flashdata('success', 'Xóa bài viết thành công');
		$this->session->set_userdata('totalItemPageCurrent',$this->session->userdata('totalItemPageCurrent') - 1);
		$totalItemPageCurrent=$this->session->userdata('totalItemPageCurrent');
		$arrLinkBack=$this->session->userdata('pathCurrent');
		$linkF5=$this->render_data->redirectLink($totalItemPageCurrent, $arrLinkBack);
		redirect($linkF5,'refresh');
	}


	public function update_images_content() {
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			if ($this->Mcontent->content_check_field('id', $_POST['idContent']) == true) {
				$contentDetail = $this->Mcontent->content_detail($_POST['idContent']);
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
						$this->Mcontent->content_update_topicId(
							array(
								'images' => json_encode($images), 
								'title_image' => json_encode($title_image), 
								'alt_image' => json_encode($alt_image), 
								'updatedAt' => $today,
								'updatedBy' => $userCurrent['id']
							), 
							array($_POST['idContent'])
						);
						echo json_encode(
							array(
								'code' => RESPONSE_CODE_SUCCESS,
								'msg' => 'Update content success'
							)
						);
					}
				}

			} else {
				echo json_encode(
					array(
						'code' => RESPONSE_CODE_ERROR,
						'msg' => "Update fail, content don't exist or deleted"
					)
				);
			}
		} else {
			redirect('404','refresh');
		}
	}
}