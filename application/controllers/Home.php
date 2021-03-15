<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'controllers/Common.php'); 

class Home extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('Mcategory');
        $this->load->model('Mproduct');
        $this->load->model('Majaxupload');
        $this->load->model('Mcontent');
        $this->load->model('Mcustomer_feedback');
        $this->load->model('Mpolicies');
        $this->load->model('frontend/Mconfig');
        $this->Common = new Common();
        $this->data['component']='home';
    }

	public function index(){
        $this->data['listNews']=$this->listNewsInHome();
        $arrIdCategoies = array();
        $listCategories = $this->Common->get_list_categories($arrIdCategoies, DEFAULT_PARENT_ID);
        $this->data['listCategories'] = $listCategories;
        /*$this->data['listProductsVideo'] = $this->listProductsVideo();
        $this->data['countVideos'] = $this->Mcontent->contents_video();*/
        $this->data['listCategoriesTypeContent'] = $this->listCategoriesTypeContent();
        $this->data['listSliders'] = $this->Common->listSliders();
        $this->data['listPolicies'] = $this->Mpolicies->policies_all(POLICIES_TYPE_HOME_PAGE);
        $this->data['listAgencies'] = $this->Mslider->slider_all(STATUS_ACTIVE, TYPE_LOGO_AGENCY);
        $this->data['listCustomersFeedback'] = $this->Mcustomer_feedback->customers_feedback_all();
        $this->data['detailIntroduction'] = $this->Mcontent->content_get_post_introduction();
        $configs =  getConfigs();
        $this->data['configs'] = $configs;
        $this->data['seoTitle'] = $configs['seoConfig']['value']->seoTitle;
        $this->data['seoKeywords'] = $configs['seoConfig']['value']->seoKeywords;
        $this->data['seoDescription'] = $configs['seoConfig']['value']->seoDescription;
        $this->data['view']='index';
        $this->load->view('frontend/layout',$this->data);
    }
    
    public function listNewsInHome(){
        $arrayTopicId = $this->Mcategory->category_all_client(DEFAULT_PARENT_ID, TYPE_CATEGORY_DU_AN);
        for($i = 0; $i < count($arrayTopicId); $i++) {
            $arrayTopicIds = array();
            array_push($arrayTopicIds, $arrayTopicId[$i]['id']);
            $arrayTopicId[$i]['listPosts'] = $this->Mcontent->contentsByArrayCategories($arrayTopicIds);
            for($j = 0; $j < count($arrayTopicId[$i]['listPosts']); $j++) {
                $arrayTopicId[$i]['listPosts'][$j]['images'] = json_decode($arrayTopicId[$i]['listPosts'][$j]['images'])[0];
                $arrayTopicId[$i]['listPosts'][$j]['title_image'] = json_decode($arrayTopicId[$i]['listPosts'][$j]['title_image'])[0];
                $arrayTopicId[$i]['listPosts'][$j]['alt_image'] = json_decode($arrayTopicId[$i]['listPosts'][$j]['alt_image'])[0];
            }
        }
        return $arrayTopicId;
    }


    public function listCategoriesTypeContent() {
        $arrayCategoriesId = $this->Mcategory->category_all_client(DEFAULT_PARENT_ID, TYPE_CATEGORY_CONTENT);
        for ($i = 0; $i < sizeof($arrayCategoriesId); $i++) {
            $arrayTopicIds = array();
            array_push($arrayTopicIds, $arrayCategoriesId[$i]['id']);
            $arrayCategoriesId[$i]['listPosts'] = $this->Mcontent->contentsByArrayCategories($arrayTopicIds, 'listRef');
            for($j = 0; $j < count($arrayCategoriesId[$i]['listPosts']); $j++) {
                $arrayCategoriesId[$i]['listPosts'][$j]['images'] = json_decode($arrayCategoriesId[$i]['listPosts'][$j]['images'])[0];
                $arrayCategoriesId[$i]['listPosts'][$j]['title_image'] = json_decode($arrayCategoriesId[$i]['listPosts'][$j]['title_image'])[0];
                $arrayCategoriesId[$i]['listPosts'][$j]['alt_image'] = json_decode($arrayCategoriesId[$i]['listPosts'][$j]['alt_image'])[0];
            }
        }
        return $arrayCategoriesId;
    }

    /*public function listProductsVideo() {
        $listProductsVideo = $this->Mproduct->products_video();
        for($i = 0; $i < count($listProductsVideo); $i++) {
            $listProductsVideo[$i]['images'] = $this->Majaxupload->image_get_field('name', json_decode($listProductsVideo[$i]['images'])[0], STATUS_ACTIVE);
        }
        return $listProductsVideo;
    }*/
}