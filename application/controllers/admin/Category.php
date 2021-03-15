<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Mcategory');
		$this->load->model('Muser');
		$this->load->model('Majaxupload');
		$this->load->library('render_data');
		$this->load->library('custom_pagination');
		if(!$this->session->userdata(SESSION_SYSTEM_NAME)){
			redirect('admin/login','refresh');
		}
		$this->data['dataUser']=$this->session->userdata(SESSION_SYSTEM_NAME);
		$this->data['com']='category';
	}
	public function index(){
		$pageCurrent=$this->custom_pagination->PageCurrent();
		$firstPage=$this->custom_pagination->PageFirst(TOTAL_ITEM_PAGING, $pageCurrent);
		$totalItem=$this->Mcategory->category_count(STATUS_ACTIVE);
		$this->data['paginations']=$this->custom_pagination->PagePer($totalItem, $pageCurrent, TOTAL_ITEM_PAGING, $url='admin/category');
		$listData = $this->Mcategory->category_all('all', STATUS_ACTIVE, TOTAL_ITEM_PAGING, $firstPage);
		$this->session->set_userdata('pathCurrent',uri_string());
		$this->session->set_userdata('totalItemPageCurrent',count($listData));
		$this->session->set_userdata(SESSION_SAVE_LIST_IMAGES, array());
		$this->data['list'] = $listData;
		$this->data['view']='index';
		$this->data['title']='Danh sách danh mục - Hệ thống quản trị cơ sở dữ liệu';
		$this->load->view('backend/layout', $this->data);
	}

	public function insert() {
		$this->session->unset_userdata(array('parentCategoryFillter', 'typeCategoryFillter'));
		$this->load->library('alias');
		$userCurrent=$this->session->userdata(SESSION_SYSTEM_NAME);
		$d=getdate();
		$today=$d['year']."/".$d['mon']."/".$d['mday']." ".$d['hours'].":".$d['minutes'].":".$d['seconds'];
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Tên danh mục ', 'required|min_length[5]|max_length[255]');
		$this->form_validation->set_rules('ordering', 'Sắp xếp ', 'required|greater_than[0]');
		if ($this->form_validation->run() == TRUE){
			$mydata = array(
				'parent_id' => $_POST['parent_id'],
				'name' => $_POST['name'],
				'type' => $_POST['type'],
				'ordering' => $_POST['ordering'],
				'description' => $_POST['description'],
				'seo_google' => $_POST['seo_google'],
				'seo_facebook' => $_POST['seo_facebook'],
				'fa_icons' => $_POST['fa_icons'],
				'createdAt' => $today,
				'createdBy' => $userCurrent['id'],
				'updatedAt' => $today,
				'updatedBy' => $userCurrent['id'],
				'status' => STATUS_ACTIVE
			);
			if ($_POST['alias'] != '') {
				$mydata['alias'] = $_POST['alias'];
			} else {
				$mydata['alias'] = $this->alias->str_alias($mydata['name']);
			}

			if ($this->Mcategory->category_check_field('alias', $mydata['alias'])) {
				$this->session->set_flashdata('error', 'Đường dẫn thân thiện đã được sử dụng, thử lại');
				redirect('admin/category/insert','refresh');
			}

			$listFileUpload = $this->session->userdata(SESSION_SAVE_LIST_IMAGES);
			/*if(count($listFileUpload) > 0){
				if (strlen($_POST['title_image']) == 0 || strlen($_POST['alt_image']) == 0) {
					$this->session->set_flashdata('error', 'Tiêu đề hoặc Alt hình ảnh không được để trống');
					redirect('admin/category/insert','refresh');
				}
				$mydata['images'] = json_encode($listFileUpload[0]['id']);
				$mydata['title_image'] = $_POST['title_image'];
				$mydata['alt_image'] = $_POST['alt_image'];
				$idCategory = $this->Mcategory->category_insert($mydata);
				$data = array(
					'idRef' => $idCategory,
					'state' => 1,
					'kind' => KIND_ICON_CATEGORY,
					'updatedAt'=>$today,
					'updatedBy'=>$userCurrent['id']
				);
				$this->Majaxupload->images_update($data, $listFileUpload[0]['id']);
				$this->session->set_userdata(SESSION_SAVE_LIST_IMAGES, array());
				$this->session->set_flashdata('success', 'Thêm danh mục thành công');
				redirect('admin/category','refresh');
			} else {*/
				$this->Mcategory->category_insert($mydata);
				$this->session->set_userdata(SESSION_SAVE_LIST_IMAGES, array());
				$this->session->set_flashdata('success', 'Thêm danh mục thành công');
				redirect('admin/category','refresh');
			//}
		} else {
			$this->data['view']='insert';
			$this->data['htmlCategory'] = $this->get_list_categories(
				$html, 
				$this->Mcategory->category_all('all', STATUS_ACTIVE, '', '', true),
				DEFAULT_PARENT_ID,
				'',
				''
			);
			$this->data['title']='Thêm danh mục mới - Hệ thống quản lý cơ sở dữ liệu';
			$this->load->view('backend/layout', $this->data);
		}
	}

	public function update($id) {
		$this->session->unset_userdata(array('parentCategoryFillter', 'typeCategoryFillter'));
		if ($this->Mcategory->category_check_field('id', $id)) {
			$detailCategory = $this->Mcategory->category_detail($id);
			$this->load->library('alias');
			$userCurrent=$this->session->userdata(SESSION_SYSTEM_NAME);
			$d=getdate();
			$today=$d['year']."/".$d['mon']."/".$d['mday']." ".$d['hours'].":".$d['minutes'].":".$d['seconds'];
			$this->load->library('form_validation');
			$this->form_validation->set_rules('name', 'Tên danh mục ', 'required|min_length[5]|max_length[255]');
			$this->form_validation->set_rules('ordering', 'Sắp xếp ', 'required|greater_than[0]');
			if ($this->form_validation->run() == TRUE){
				/*if ($detailCategory['images'] != '' && $detailCategory['images'] != null) {
					if (strlen($_POST['title_image']) == 0 || strlen($_POST['alt_image']) == 0) {
						$this->session->set_flashdata('error', 'Tiêu đề hoặc Alt hình ảnh không được để trống');
						redirect('admin/category/update/'.$detailCategory['id'],'refresh');
					}
				}*/
				$mydata = array(
					'parent_id' => $_POST['parent_id'],
					'name' => $_POST['name'],
					'type' => $_POST['type'],
					'ordering' => $_POST['ordering'],
					'description' => $_POST['description'],
					'seo_google' => $_POST['seo_google'],
					'seo_facebook' => $_POST['seo_facebook'],
					'fa_icons' => $_POST['fa_icons'],
					'updatedAt' => $today,
					'updatedBy' => $userCurrent['id']
				);
				/*$mydata['title_image'] = $_POST['title_image'];
				$mydata['alt_image'] = $_POST['alt_image'];*/
				$isChangeAlias = false;
				if (strlen($_POST['alias']) > 0) {
					if ($_POST['alias'] != $detailCategory['alias']) {
						$mydata['alias'] = $_POST['alias'];
						$isChangeAlias = true;
					}
				} else {
					$mydata['alias'] = $this->alias->str_alias($mydata['name']);
					$isChangeAlias = true;
				}
				if ($isChangeAlias == true) {
					if ($this->Mcategory->category_check_field('alias', $mydata['alias'])) {
						$this->session->set_flashdata('error', 'Đường dẫn thân thiện đã được sử dụng, thử lại');
						redirect('admin/category/insert','refresh');
					}
				}

				/*$listFileUpload = $this->session->userdata(SESSION_SAVE_LIST_IMAGES);
				if(count($listFileUpload) > 0){
					$mydata['images'] = json_encode($listFileUpload[0]['id']);
					$idCategory = $this->Mcategory->category_insert($mydata);
					$data = array(
						'idRef' => $idCategory,
						'state' => 1,
						'kind' => KIND_ICON_CATEGORY,
						'updatedAt'=>$today,
						'updatedBy'=>$userCurrent['id']
					);
					$this->Majaxupload->images_update($data, $listFileUpload[0]['id']);
					$this->session->set_userdata(SESSION_SAVE_LIST_IMAGES, array());
				}*/
				$this->Mcategory->category_update($mydata, $id);
				$this->session->set_userdata(SESSION_SAVE_LIST_IMAGES, array());
				$this->session->set_flashdata('success', 'Cập nhật danh mục thành công');
				redirect('admin/category','refresh');
			} else {
				$this->data['view']='update';
				$this->data['htmlCategory'] = $this->get_list_categories(
					$html, 
					$this->Mcategory->category_all('all', STATUS_ACTIVE, '', '', true),
					DEFAULT_PARENT_ID,
					'',
					$detailCategory['id']
				);
				$this->data['row'] = $detailCategory;
				$this->data['title']='Cập nhật danh mục - Hệ thống quản lý cơ sở dữ liệu';
				$this->load->view('backend/layout', $this->data);
			}
		} else {
			redirect('404','refresh');
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

	public function delete($id){
		$this->session->unset_userdata(array('parentCategoryFillter', 'typeCategoryFillter'));
		if ($this->Mcategory->category_check_field('id', $id)) {
			$userCurrent=$this->session->userdata(SESSION_SYSTEM_NAME);
			$d=getdate();
			$today=$d['year']."/".$d['mon']."/".$d['mday']." ".$d['hours'].":".$d['minutes'].":".$d['seconds'];
			$detail=$this->Mcategory->category_detail($id);
			$countChild=$this->Mcategory->category_count(STATUS_ACTIVE, $detail['id']);
			if($countChild > 0){
				$this->session->set_flashdata('error', 'Thao tác thất bại, còn danh mục con bên trong');
			}else{
				$mydata= array('status' => STATUS_DELETE, 'updatedAt'=>$today, 'updatedBy'=>$userCurrent['id']);
				$this->Mcategory->category_update($mydata, $id);
				$this->session->set_flashdata('success', 'Xóa danh mục thành công');
			}
			$totalItemPageCurrent=$this->session->userdata('totalItemPageCurrent');
			$arrLinkBack=$this->session->userdata('pathCurrent');
			$linkF5=$this->render_data->redirectLink($totalItemPageCurrent, $arrLinkBack);
			redirect($linkF5,'refresh');
		} else {
			redirect('404','refresh');
		}
	}

	public function fillter() {
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			if (isset($_POST['typeCategory']) || isset($_POST['parentCategory'])) {
				$typeCategory = -2;
				if ($_POST['typeCategory'] != -2) {
					$typeCategory = $_POST['typeCategory'];
					$this->session->set_userdata('typeCategoryFillter', $typeCategory);
				} else {
					$this->session->unset_userdata(array('typeCategoryFillter'));
				}
				$parentCategory = -2;
				if ($_POST['parentCategory'] != -2) {
					$parentCategory = $_POST['parentCategory'];
					$this->session->set_userdata('parentCategoryFillter', $parentCategory);
				} else {
					$this->session->unset_userdata(array('parentCategoryFillter'));
				}
				$pageCurrent=$this->phantrang->PageCurrent();
				$firstPage=$this->phantrang->PageFirst(TOTAL_ITEM_PAGING, $pageCurrent);
				$totalItem=$this->Mcategory->category_count_fillter($parentCategory, $typeCategory, STATUS_ACTIVE);
				$this->data['paginations']=$this->phantrang->PagePer($totalItem, $pageCurrent, TOTAL_ITEM_PAGING, $url='admin/category');
				$listCategories = $this->Mcategory->category_all_fillter($parentCategory, $typeCategory, TOTAL_ITEM_PAGING, $firstPage);
				$this->data['list'] = $listCategories;
				$this->data['view']='index';
				$this->data['title']='Danh sách danh mục - Hệ thống quản trị cơ sở dữ liệu';
				$this->data['htmlCategory'] = $this->Mcategory->category_all(DEFAULT_PARENT_ID, STATUS_ACTIVE, '', '', true);
	            $result=$this->load->view('backend/components/category/filler', $this->data, true);
	            echo json_encode($result);
			}
		} else {
			redirect('404', 'refresh');
		}
	}

	public function update_show($id) {
		if ($this->Mcategory->category_check_field('id', $id)) {
			$detailCategory = $this->Mcategory->category_detail($id);
			$is_show_home = CATEGORY_ALLOW_SHOW_IN_HOME;
			if ($detailCategory['is_show_home'] == CATEGORY_ALLOW_SHOW_IN_HOME) {
				$is_show_home = CATEGORY_NOT_ALLOW_SHOW_IN_HOME;
			}
			$userCurrent=$this->session->userdata(SESSION_SYSTEM_NAME);
			$d=getdate();
			$today=$d['year']."/".$d['mon']."/".$d['mday']." ".$d['hours'].":".$d['minutes'].":".$d['seconds'];
			$mydata= array('is_show_home' => $is_show_home, 'updatedAt'=>$today, 'updatedBy'=>$userCurrent['id']);
			$this->Mcategory->category_update($mydata, $id);
			$this->session->set_flashdata('success', 'Cập nhật danh mục thành công');
			$totalItemPageCurrent=$this->session->userdata('totalItemPageCurrent');
			$arrLinkBack=$this->session->userdata('pathCurrent');
			$linkF5=$this->render_data->redirectLink($totalItemPageCurrent, $arrLinkBack);
			redirect($linkF5,'refresh');
		} else {
			redirect('404', 'refresh');
		}
	}

	public function update_show_menu($id) {
		if ($this->Mcategory->category_check_field('id', $id)) {
			$detailCategory = $this->Mcategory->category_detail($id);
			$is_show_home = CATEGORY_ALLOW_SHOW_IN_MENU;
			if ($detailCategory['is_show_menu'] == CATEGORY_ALLOW_SHOW_IN_MENU) {
				$is_show_home = CATEGORY_NOT_ALLOW_SHOW_IN_MENU;
			}
			$userCurrent=$this->session->userdata(SESSION_SYSTEM_NAME);
			$d=getdate();
			$today=$d['year']."/".$d['mon']."/".$d['mday']." ".$d['hours'].":".$d['minutes'].":".$d['seconds'];
			$mydata= array('is_show_menu' => $is_show_home, 'updatedAt'=>$today, 'updatedBy'=>$userCurrent['id']);
			$this->Mcategory->category_update($mydata, $id);
			$this->session->set_flashdata('success', 'Cập nhật danh mục thành công');
			$totalItemPageCurrent=$this->session->userdata('totalItemPageCurrent');
			$arrLinkBack=$this->session->userdata('pathCurrent');
			$linkF5=$this->render_data->redirectLink($totalItemPageCurrent, $arrLinkBack);
			redirect($linkF5,'refresh');
		} else {
			redirect('404', 'refresh');
		}
	}
}