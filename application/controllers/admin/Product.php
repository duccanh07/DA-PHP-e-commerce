<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Mproduct');
		$this->load->model('Mcategory');
		$this->load->model('Majaxupload');
		$this->load->library('alias');
		$this->load->library('upload');
		$this->load->library('image_lib');
    	$config['image_library'] = 'GD2';
		$this->load->library('phantrang');
		$this->load->library('render_data');
		if(!$this->session->userdata(SESSION_SYSTEM_NAME)){
			redirect('admin/login','refresh');
		}
		$this->data['dataUser']=$this->session->userdata(SESSION_SYSTEM_NAME);
		$this->data['com']='product';
	}

	public function index(){
		$this->session->set_userdata(SESSION_SAVE_LIST_IMAGES, array());
		$this->session->set_userdata(SESSION_LIST_IMAGES_ITEM_COLOR, array());
		$category_id = 0;
		$option = 0;
		$keyword = '';
		if (isset($_GET['cat'])) {
			$category_id = (int)$_GET['cat'];
		}
		if (isset($_GET['option'])) {
			$option = $_GET['option'];
		}
		if (isset($_GET['keyword'])) {
			$keyword = $_GET['keyword'];
		}
		if ($category_id != 0) {
			if ($this->Mcategory->category_check_field('id', $category_id) == FALSE) {
				echo '<script type="text/javascript">alert("Dữ liệu lọc không đúng, thử lại");</script>';
			} else {
				$this->data['infoCategory'] = $this->Mcategory->category_detail($category_id);
			}
		} elseif( isset($_GET['cat'])) {
			echo '<script type="text/javascript">alert("Dữ liệu lọc không đúng, thử lại");</script>';
		}
		if ($option != '') {
			switch ($option) {
				case OPTION_FILLTER_NO_PRICE: case OPTION_FILLTER_PRICE: case OPTION_FILLTER_HOT_SALE: case OPTION_FILLTER_HOT: case OPTION_FILLTER_NEW: case OPTION_FILLTER_PRODUCT_VIDEO:
					break;
				default:
					echo '<script type="text/javascript">alert("Dữ liệu lọc không đúng, thử lại");</script>';
					break;
			}
		}

		if (isset($_GET['page'])) {
			$firstPage = (int)$_GET['page'] * TOTAL_ITEM_PAGING;
			$pageCurrent = ((int)$_GET['page']) + 1;
		} else {
			$pageCurrent=$this->phantrang->PageCurrent();
			$firstPage=$this->phantrang->PageFirst(TOTAL_ITEM_PAGING, $pageCurrent);
		}
		$totalItem=$this->Mproduct->product_count(STATUS_ACTIVE, $_GET);
		$this->data['paginations']=$this->phantrang->PagePer($totalItem, $pageCurrent, TOTAL_ITEM_PAGING, $url='admin/product');
		$listData=$this->Mproduct->product_all(TOTAL_ITEM_PAGING, $firstPage, $_GET);
		$this->data['category_id']=$category_id;
		$this->data['option']=$option;
		$this->data['keyword']=$keyword;
		$this->data['list']=$listData;
		$this->data['view']='index';
		$this->data['htmlCategory'] = $this->get_list_categories(
			$html, 
			$this->Mcategory->category_all('all', STATUS_ACTIVE, '', '', true, TYPE_CATEGORY_PRODUCT),
			DEFAULT_PARENT_ID,
			'',
			''
		);
		$this->data['title']='Quản lý sản phẩm - Hệ quản trị cơ sở dữ liệu';
		$this->session->set_userdata('pathCurrent',uri_string());
		$this->session->set_userdata('totalItemPageCurrent',count($listData));
		$this->load->view('backend/layout', $this->data);
	}
	public function insert(){
		$d=getdate();
		$this->load->helper(array('form', 'url', 'string'));
		$this->load->library('upload'); 
		$userCurrent=$this->session->userdata(SESSION_SYSTEM_NAME);
		$today=$d['year']."/".$d['mon']."/".$d['mday']." ".$d['hours'].":".$d['minutes'].":".$d['seconds'];
		$this->form_validation->set_rules('name', 'Tên sản phẩm', 'required|max_length[255]');
		$this->form_validation->set_rules('category_id', 'Danh mục sản phẩm', 'required');
		$this->form_validation->set_rules('seo_title', 'SEO tiêu đề', 'required|max_length[70]');
		$this->form_validation->set_rules('seo_keywords', 'SEO từ khóa', 'required|max_length[255]');
		$this->form_validation->set_rules('seo_description', 'SEO mô tả', 'required|max_length[160]');
		if ($this->form_validation->run() == TRUE){
			if ($_POST['category_id'] == DEFAULT_PARENT_ID) {
				$this->data['errorForm'] = 'Vui lòng chọn danh mục sản phẩm';
				redirect('admin/product/insert','refresh');			
			}

			if (isset($_POST['is_product_video'])) {
				if (strlen($_POST['link_video']) <= 0) {
					$this->data['errorForm'] = 'Vui lòng nhập đường dẫn video';
					redirect('admin/product/insert','refresh');			
				}
			}

			$mydata= array(
				'name' => $_POST['name'],
				'category_id' => $_POST['category_id'],
				'ordering' => $_POST['ordering'],
				'short_description' => $_POST['short_description'],
				'description' => $_POST['description'],
				'seo_google' => $_POST['seo_google'],
				'seo_facebook' => $_POST['seo_facebook'],
				'seo_title' => $_POST['seo_title'],
				'seo_keywords' => $_POST['seo_keywords'],
				'seo_description' => $_POST['seo_description'],
				'title_image' => json_encode($_POST['title_image']),
				'alt_image' => json_encode($_POST['alt_image']),
				'createdAt' => $today,
				'createdBy' => $userCurrent['id'],
				'updatedAt' => $today,
				'updatedBy' => $userCurrent['id'],
				'status' => STATUS_ACTIVE,
				'is_new' => PRODUCT_IS_NEW
			);

			if (strlen($_POST['alias']) > 0) {
				$mydata['alias'] = $_POST['alias'];
			} else {
				$mydata['alias'] = $this->alias->str_alias($_POST['name']);
			}

			if (isset($_POST['is_hot'])) {
				$mydata['is_hot'] = PRODUCT_IS_HOT;
			}

			if (isset($_POST['is_hot_sale'])) {
				$mydata['is_hot_sale'] = PRODUCT_IS_HOT_SALE;
			}

			if (isset($_POST['is_product_video'])) {
				$mydata['is_product_video'] = PRODUCT_IS_PRODUCT_VIDEO;
				$mydata['link_video'] = $_POST['link_video'];
			} else {
				$mydata['is_product_video'] = PRODUCT_IS_NOT_PRODUCT_VIDEO;
			}

			if (isset($_POST['item_codes']) && count($_POST['item_codes']) > 0) {
				$mydata['item_codes'] = json_encode($_POST['item_codes']);
			} else {
				$mydata['item_codes'] = json_encode(array());
			}

			if (isset($_POST['item_prices']) && count($_POST['item_prices']) > 0) {
				$mydata['item_prices'] = json_encode($_POST['item_prices']);
			} else {
				$mydata['item_prices'] = json_encode(array());
			}

			if (isset($_POST['item_sizes']) && count($_POST['item_sizes']) > 0) {
				$mydata['item_sizes'] = json_encode($_POST['item_sizes']);
			} else {
				$mydata['item_sizes'] = json_encode(array());
			}

			if (isset($_POST['item_weights']) && count($_POST['item_weights']) > 0) {
				$mydata['item_weights'] = json_encode($_POST['item_weights']);
			} else {
				$mydata['item_weights'] = json_encode(array());
			}

			if (isset($_POST['items_price_sale']) && count($_POST['items_price_sale']) > 0) {
				$mydata['items_price_sale'] = json_encode($_POST['items_price_sale']);
			} else {
				$mydata['items_price_sale'] = json_encode(array());
			}

			if(isset($_FILES['item_colors']) && $_FILES['item_colors']['name'][0] != null && $_FILES['item_colors']['name'][0] != ''){
				//$config['upload_path'] = 'assets/upload/colors';
				$config['upload_path'] = 'upload/colors';
				$config['allowed_types'] = 'jpeg|jpg|png';
				$config['max_size'] = '10240';
				$this->upload->initialize($config);                                   
				$file  = $_FILES['item_colors'];
		        $count = count($file['name']);
		        $img = "";
		        for($i=0; $i<=$count-1; $i++) 
		        {
	              	$_FILES['item_colors']['name']     = $file['name'][$i];  //khai báo tên của file thứ i
	              	$_FILES['item_colors']['type']     = $file['type'][$i]; //khai báo kiểu của file thứ i
	              	$_FILES['item_colors']['tmp_name'] = $file['tmp_name'][$i]; //khai báo đường dẫn tạm của file thứ i
	          		$_FILES['item_colors']['error']    = $file['error'][$i]; //khai báo lỗi của file thứ i
	              	$_FILES['item_colors']['size']     = $file['size'][$i]; //khai báo kích cỡ của file thứ i
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
	              	if($this->upload->do_upload('item_colors'))
	          		{
		                  //nếu upload thành công thì lưu toàn bộ dữ liệu
	                  	$data = $this->upload->data();
		                  //in cấu trúc dữ liệu của các file

	             		$img .= $data['file_name'].'#';
	              	} 
		        }
		        $arrNameImgColors = explode('#', $img);
		        for($i = 0; $i < sizeof($arrNameImgColors); $i++) {
		        	if ($arrNameImgColors[$i] == "") {
		        		unset($arrNameImgColors[$i]);
		        	}
		        }
				$mydata['item_colors'] = json_encode($arrNameImgColors);
				if(isset($_POST['item_title_image_color'])) {
					$mydata['item_title_image_color'] = json_encode($_POST['item_title_image_color']);
				}
				if(isset($_POST['item_alt_image_color'])) {
					$mydata['item_alt_image_color'] = json_encode($_POST['item_alt_image_color']);
				}
			} else {
				$mydata['item_colors'] = '[""]';
			}

			if(isset($_FILES['images']) && $_FILES['images']['name'][0] != null && $_FILES['images']['name'][0] != ''){
				//$config['upload_path'] = 'assets/upload/products';
				$config['upload_path'] = 'upload/products';
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

				$idProduct = $this->Mproduct->product_insert($mydata);
				$this->session->set_flashdata('success', 'Thêm sản phẩm thành công');
				redirect('admin/product','refresh');
			}else{
		    	$this->session->set_flashdata('error', 'Hình ảnh của sản phẩm là bắt buộc');
				redirect('admin/product/insert','refresh');
		    }
	
		}else{
			$this->data['view']='insert';
			$this->data['htmlCategory'] = $this->get_list_categories(
				$html, 
				$this->Mcategory->category_all('all', STATUS_ACTIVE, '', '', true, TYPE_CATEGORY_PRODUCT),
				DEFAULT_PARENT_ID,
				'',
				''
			);
			$this->data['title']='Thêm sản phẩm mới - Hệ thống quản trị cơ sở dữ liệu';
			$this->load->view('backend/layout', $this->data);
		}
	}

	public function get_list_categories(&$html, $listCategories, $parent_id = DEFAULT_PARENT_ID ,$name = '', $id_current = null) {
		foreach ($listCategories as $key =>$value) {
            if($value['parent_id'] == $parent_id){
            	$html.= "<option name='parent_id'  value=".$value['id'].">".$name.$value['name']."</option>";
         		unset($listCategories[$key]);
            	$this->get_list_categories($html, $listCategories, $value['id'], $name.'---| ');
            }
            
        }
        return $html;
	}

	public function update($id){
		if ($this->Mproduct->product_check_id($id) == true) {
			$d=getdate();
			$this->load->helper(array('form', 'url', 'string'));
			$this->load->library('upload'); 
			$userCurrent=$this->session->userdata(SESSION_SYSTEM_NAME);
			$productDetail = $this->Mproduct->product_detail($id); 
			$today=$d['year']."/".$d['mon']."/".$d['mday']." ".$d['hours'].":".$d['minutes'].":".$d['seconds'];
			$this->form_validation->set_rules('name', 'Tên sản phẩm', 'required|max_length[255]');
			$this->form_validation->set_rules('category_id', 'Danh mục sản phẩm', 'required');
			$this->form_validation->set_rules('seo_title', 'SEO tiêu đề', 'required|max_length[70]');
			$this->form_validation->set_rules('seo_keywords', 'SEO từ khóa', 'required|max_length[255]');
			$this->form_validation->set_rules('seo_description', 'SEO mô tả', 'required|max_length[160]');
			
			if ($this->form_validation->run() == TRUE){
			    if ($_POST['category_id'] == DEFAULT_PARENT_ID) {
					echo '<script type="text/javascript">alert("Vui lòng chọn danh mục sản phẩm");</script>';
					redirect('admin/product/update/'.$id,'refresh');			
				}

				if (isset($_POST['is_product_video'])) {
					if (strlen($_POST['link_video']) <= 0) {
						echo '<script type="text/javascript">alert("Vui lòng nhập đường dẫn video");</script>';
						redirect('admin/product/update/'.$id,'refresh');			
					}
				}
				$mydata= array(
					'name' => $_POST['name'],
					'category_id' => $_POST['category_id'],
					'ordering' => $_POST['ordering'],
					'short_description' => $_POST['short_description'],
					'description' => $_POST['description'],
					'seo_google' => $_POST['seo_google'],
					'seo_facebook' => $_POST['seo_facebook'],
					'seo_title' => $_POST['seo_title'],
					'seo_keywords' => $_POST['seo_keywords'],
					'seo_description' => $_POST['seo_description'],
					'title_image' => json_encode($_POST['title_image']),
					'alt_image' => json_encode($_POST['alt_image']),
					'updatedAt' => $today,
					'updatedBy' => $userCurrent['id']
				);

				if (strlen($_POST['alias']) > 0) {
					$mydata['alias'] = $_POST['alias'];
				} else {
					$mydata['alias'] = $this->alias->str_alias($_POST['name']);
				}

				if (isset($_POST['item_sale_of']) && count($_POST['item_sale_of']) > 0) {
					$mydata['item_sale_of'] = json_encode($_POST['item_sale_of']);
				} else {
					$mydata['item_sale_of'] = json_encode(array());
				}

				if (isset($_POST['is_hot'])) {
					$mydata['is_hot'] = PRODUCT_IS_HOT;
				} else {
					$mydata['is_hot'] = PRODUCT_IS_NOT_HOT;
				}

				if (isset($_POST['is_hot_sale'])) {
					$mydata['is_hot_sale'] = PRODUCT_IS_HOT_SALE;
				} else {
					$mydata['is_hot_sale'] = PRODUCT_IS_NOT_HOT_SALE;
				}

				if (isset($_POST['is_product_video'])) {
					$mydata['is_product_video'] = PRODUCT_IS_PRODUCT_VIDEO;
					$mydata['link_video'] = $_POST['link_video'];
				} else {
					$mydata['is_product_video'] = PRODUCT_IS_NOT_PRODUCT_VIDEO;
				}

				if (isset($_POST['item_codes']) && count($_POST['item_codes']) > 0) {
					$mydata['item_codes'] = json_encode($_POST['item_codes']);
				} else {
					$mydata['item_codes'] = json_encode(array());
				}

				if (isset($_POST['item_prices']) && count($_POST['item_prices']) > 0) {
					$mydata['item_prices'] = json_encode($_POST['item_prices']);
				} else {
					$mydata['item_prices'] = json_encode(array());
				}

				if (isset($_POST['item_sizes']) && count($_POST['item_sizes']) > 0) {
					$mydata['item_sizes'] = json_encode($_POST['item_sizes']);
				} else {
					$mydata['item_sizes'] = json_encode(array());
				}

				/*if (isset($_POST['item_colors']) && count($_POST['item_colors']) > 0) {
					$mydata['item_colors'] = json_encode($_POST['item_colors']);
				} else {
					$mydata['item_colors'] = json_encode(array());
				}*/

				if (isset($_POST['item_weights']) && count($_POST['item_weights']) > 0) {
					$mydata['item_weights'] = json_encode($_POST['item_weights']);
				} else {
					$mydata['item_weights'] = json_encode(array());
				}

				if (isset($_POST['items_price_sale']) && count($_POST['items_price_sale']) > 0) {
					$mydata['items_price_sale'] = json_encode($_POST['items_price_sale']);
				} else {
					$mydata['items_price_sale'] = json_encode(array());
				}

				if(isset($_FILES['item_colors'])){
					$config['upload_path'] = 'upload/colors';
					$config['allowed_types'] = 'jpeg|jpg|png';
					$config['max_size'] = '10240';
					$this->upload->initialize($config);                                   
					$file  = $_FILES['item_colors'];
			        $count = count($file['name']);
			        $item_colors = json_decode($productDetail['item_colors']);
			        for($i = 0; $i < $count; $i++) 
			        {
		              	if ($file['name'][$i] != null && $file['name'][$i] != '') {
		              		$_FILES['item_colors']['name']     = $file['name'][$i];  //khai báo tên của file thứ i
			              	$_FILES['item_colors']['type']     = $file['type'][$i]; //khai báo kiểu của file thứ i
			              	$_FILES['item_colors']['tmp_name'] = $file['tmp_name'][$i]; //khai báo đường dẫn tạm của file thứ i
			          		$_FILES['item_colors']['error']    = $file['error'][$i]; //khai báo lỗi của file thứ i
			              	$_FILES['item_colors']['size']     = $file['size'][$i]; //khai báo kích cỡ của file thứ i
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
			              	if($this->upload->do_upload('item_colors'))
			          		{
				                  //nếu upload thành công thì lưu toàn bộ dữ liệu
			                  	$data = $this->upload->data();
			             		$item_colors[$i] = $data['file_name'];
			              	}  
		              	}
			        }
					$mydata['item_colors'] = json_encode($item_colors);
					if(isset($_POST['item_title_image_color'])) {
						$mydata['item_title_image_color'] = json_encode($_POST['item_title_image_color']);
					}
					if(isset($_POST['item_alt_image_color'])) {
						$mydata['item_alt_image_color'] = json_encode($_POST['item_alt_image_color']);
					}
				} else {
					$mydata['item_colors'] = '[""]';
				}
			    if(isset($_FILES['images'])){
					$config['upload_path'] = 'upload/products';
					$config['allowed_types'] = 'jpeg|jpg|png';
					$config['max_size'] = '10240';
					$this->upload->initialize($config);                                   
					$file  = $_FILES['images'];
			        $count = count($file['name']);
			        $images = json_decode($productDetail['images']);
			        for($i = 0; $i < $count; $i++) 
			        {
		              	if ($file['name'][$i] != null && $file['name'][$i] != '') {
		              		$_FILES['images']['name']     = $file['name'][$i];  //khai báo tên của file thứ i
			              	$_FILES['images']['type']     = $file['type'][$i]; //khai báo kiểu của file thứ i
			              	$_FILES['images']['tmp_name'] = $file['tmp_name'][$i]; //khai báo đường dẫn tạm của file thứ i
			          		$_FILES['images']['error']    = $file['error'][$i]; //khai báo lỗi của file thứ i
			              	$_FILES['images']['size']     = $file['size'][$i]; //khai báo kích cỡ của file thứ i
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

			    $this->Mproduct->product_update($mydata, $id);
			    $this->session->set_flashdata('success', 'Cập nhật sản phẩm thành công');
				redirect('admin/product','refresh');
			}else{
				$this->data['view']='update';
				$this->data['productDetail'] = $productDetail;
				$this->data['arrayImages'] = $productDetail['images'];
				$this->data['htmlCategory'] = $this->get_list_categories(
					$html, 
					$this->Mcategory->category_all('all', STATUS_ACTIVE, '', '', true, TYPE_CATEGORY_PRODUCT),
					DEFAULT_PARENT_ID,
					'',
					''
				);
				$this->data['title']='Cập nhật sản phẩm - Hệ thống quản trị cơ sở dữ liệu';
				$this->load->view('backend/layout', $this->data);
			}
		} else {
			redirect('404','refresh');
		}
	}

	public function delete($id){
		if ($this->Mproduct->product_check_id($id)) {
			$d=getdate();
			$userCurrent=$this->session->userdata(SESSION_SYSTEM_NAME);
			$today=$d['year']."/".$d['mon']."/".$d['mday']." ".$d['hours'].":".$d['minutes'].":".$d['seconds'];
			$detailProduct=$this->Mproduct->product_detail($id);
			$mydata= array('status' => STATUS_DELETE, 'updatedAt'=>$today, 'updatedBy'=>$userCurrent['id']);
			$this->Mproduct->product_update($mydata, $id);
			$this->session->set_flashdata('success', 'Xóa sản phẩm thành công');
			$this->session->set_userdata('totalItemPageCurrent',$this->session->userdata('totalItemPageCurrent') - 1);
			$totalItemPageCurrent=$this->session->userdata('totalItemPageCurrent');
			$arrLinkBack=$this->session->userdata('pathCurrent');
			$linkF5=$this->render_data->redirectLink($totalItemPageCurrent, $arrLinkBack);
			$listIdOfImages = json_decode($detailProduct['images']);
			foreach ($listIdOfImages as $nameImage) {
				unlink('upload/products/'.$nameImage);
			}
			redirect($linkF5,'refresh');
		} else {
			redirect('404','refresh');
		}
	}

	public function update_option() {
		$idProduct = $_POST['idProduct'];
		$optionName = $_POST['optionName'];
		if (!isset($idProduct) || !isset($optionName)) {
			echo json_encode(
				array(
					'code' => RESPONSE_CODE_ERROR,
					'msg' => 'Required params idProduct, optionName'
				)
			);
		} else {
			if ($this->Mproduct->product_check_id($idProduct)) {
				$detailProduct = $this->Mproduct->product_detail($idProduct);
				$d=getdate();
				$userCurrent=$this->session->userdata(SESSION_SYSTEM_NAME);
				$today=$d['year']."/".$d['mon']."/".$d['mday']." ".$d['hours'].":".$d['minutes'].":".$d['seconds'];
				$mydata = array(
					'updatedAt' => $today,
					'updatedBy' => $userCurrent['id']
				);
				if ($detailProduct[$optionName] == PRODUCT_ON) {
					$mydata[$optionName] = PRODUCT_OFF;
				} else {
					$mydata[$optionName] = PRODUCT_ON;
				}
				$this->Mproduct->product_update($mydata, $idProduct);
				$this->session->set_flashdata('success', 'Cập nhật sản phẩm thành công');
				echo json_encode(
					array(
						'code' => RESPONSE_CODE_SUCCESS,
						'msg' => 'Update success'
					)
				);
			} else {
				echo json_encode(
					array(
						'code' => RESPONSE_CODE_ERROR,
						'msg' => 'Product is not exist'
					)
				);
			}
		}
	}

	public function update_color() {
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			if ($this->Mproduct->product_check_id($_POST['idProduct']) == true) {
				$productDetail = $this->Mproduct->product_detail($_POST['idProduct']);
				$item_colors = json_decode($productDetail['item_colors']);
				if (sizeof($item_colors) > 0) {
					if (isset($item_colors[$_POST['positionImgColor']])) {
						$d=getdate();
						$userCurrent=$this->session->userdata(SESSION_SYSTEM_NAME);
						$today=$d['year']."/".$d['mon']."/".$d['mday']." ".$d['hours'].":".$d['minutes'].":".$d['seconds'];
						unlink("assets/upload/colors/".$item_colors[$_POST['positionImgColor']]);
						$item_colors[$_POST['positionImgColor']] = "";
						$this->Mproduct->product_update(
							array(
								'item_colors' => json_encode($item_colors),
								'updatedAt' => $today,
								'updatedBy' => $userCurrent['id']
							), 
							$_POST['idProduct']
						);
						echo json_encode(
							array(
								'code' => RESPONSE_CODE_SUCCESS,
								'msg' => 'Update product success'
							)
						);
					}
				}

			} else {
				echo json_encode(
					array(
						'code' => RESPONSE_CODE_ERROR,
						'msg' => "Update fail, product don't exist or deleted"
					)
				);
			}
		} else {
			redirect('404','refresh');
		}
	}

	public function update_images_product() {
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			if ($this->Mproduct->product_check_id($_POST['idProduct']) == true) {
				$productDetail = $this->Mproduct->product_detail($_POST['idProduct']);
				$images = json_decode($productDetail['images']);
				$title_image = json_decode($productDetail['title_image']);
				$alt_image = json_decode($productDetail['alt_image']);
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
						$this->Mproduct->product_update(
							array(
								'images' => json_encode($images), 
								'title_image' => json_encode($title_image), 
								'alt_image' => json_encode($alt_image), 
								'updatedAt' => $today,
								'updatedBy' => $userCurrent['id']
							), 
							$_POST['idProduct']
						);
						echo json_encode(
							array(
								'code' => RESPONSE_CODE_SUCCESS,
								'msg' => 'Update product success'
							)
						);
					}
				}

			} else {
				echo json_encode(
					array(
						'code' => RESPONSE_CODE_ERROR,
						'msg' => "Update fail, product don't exist or deleted"
					)
				);
			}
		} else {
			redirect('404','refresh');
		}
	}

}