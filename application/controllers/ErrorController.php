<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH.'controllers/Common.php'); 

class ErrorController extends CI_Controller {
        public function __construct(){
                parent::__construct();
                $this->data['component']='errors';
                $this->load->model('Mcategory');

                $this->load->model('Mproduct');
                $this->load->model('frontend/Mconfig');
                $this->load->model('Mcontent');
                $this->Common = new Common();
                $arrIdCategoies = array();
                $listCategories = $this->Common->get_list_categories($arrIdCategoies, DEFAULT_PARENT_ID);
                $this->data['listCategories'] = $listCategories;
                $this->data['listSliders'] = $this->Common->listSliders();
                $configs =  getConfigs();
        $this->data['configs'] = $configs;
                $this->data['seoTitle'] = 'Sorry, page not found !';
                $this->data['seo_keywords'] = '';
                $this->data['seo_description'] = '';
        }

        public function error_404(){
                $this->data['view']='Error404';
        $this->load->view('frontend/layout',$this->data);
        }

}