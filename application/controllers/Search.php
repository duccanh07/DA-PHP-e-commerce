<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH.'controllers/Common.php'); 

class Search extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('Mcategory');
        $this->load->model('Mproduct');
        $this->load->model('Majaxupload');
        $this->load->model('Mcontent');
        $this->load->model('frontend/Mconfig');
        $this->load->library('custom_pagination');
        $this->data['component']='search';
        $this->Common = new Common();
        $arrIdCategoies = array();
        $listCategories = $this->Common->get_list_categories($arrIdCategoies, DEFAULT_PARENT_ID);
        $this->data['listCategories'] = $listCategories;
        $this->data['listSliders'] = $this->Common->listSliders();
        $this->data['listPoliciesOrther'] = $this->Common->listPoliciesOrther();
        $this->data['seoTitle'] = 'Kết quả tìm kiếm';
    }
    
	public function index()
	{
		$this->load->library('phantrang');
		$key = $_GET['keywords'];
		$limit=LIMIT_PRODUCT_SHOW_CATEGORY;
		if (isset($_GET['page'])) {
			$firstPage = (int)$_GET['page'] * LIMIT_PRODUCT_SHOW_CATEGORY;
			$pageCurrent = ((int)$_GET['page']) + 1;
		} else {
			$pageCurrent=$this->phantrang->PageCurrent();
			$firstPage=$this->phantrang->PageFirst(LIMIT_PRODUCT_SHOW_CATEGORY, $pageCurrent);
		}
		$totalItem = $this->Mproduct->product_search_count($key);
		$this->data['strphantrang']=$this->phantrang->PagePer($totalItem, $pageCurrent, LIMIT_PRODUCT_SHOW_CATEGORY, $url='search?keywords');
		$this->data['listProduct'] = $this->Mproduct->product_search($key,$limit,$firstPage);
		$this->data['totalItem']=$totalItem;
		$configs =  getConfigs();
        $this->data['configs'] = $configs;
		$this->data['view']='index';
		$this->load->view('frontend/layout',$this->data);
	}
	
}