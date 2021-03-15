<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'controllers/Common.php'); 

class Posts extends CI_Controller {
	// Hàm khởi tạo
    function __construct() {
        parent::__construct();
        $this->load->model('Mcategory');
        $this->load->model('Mproduct');
        $this->load->model('Majaxupload');
        $this->load->model('Mcontent');
        $this->load->library('custom_pagination');
        $this->load->model('frontend/Mconfig');
        $this->Common = new Common();
        $this->data['component']='posts';
        $arrIdCategoies = array();
        $listCategories = $this->Common->get_list_categories($arrIdCategoies, DEFAULT_PARENT_ID);
        $this->data['listCategories'] = $listCategories;
        $this->data['listSliders'] = $this->Common->listSliders();
        $this->data['listPoliciesOrther'] = $this->Common->listPoliciesOrther();
        $configs =  getConfigs();
        $this->data['configs'] = $configs;
    }

    public function listPost($alias) {
        if ($this->Mcategory->category_check_field('alias', $alias)) {
            $idCategory = $this->Mcategory->category_get_field_by_field('alias', $alias, 'id');
            $detailCategory = $this->Mcategory->category_detail($idCategory);
            $arrIdCategoies = array($detailCategory['id']);
            $this->get_list_categories($arrIdCategoies, $detailCategory['id'], TYPE_CATEGORY_CONTENT);
            $pageCurrent=$this->custom_pagination->PageCurrent();
            $totalItem=$this->Mcontent->contentsCountByCategory($arrIdCategoies);
            $firstPage=$this->custom_pagination->PageFirst(LIMIT_CONTENT_LIST, $pageCurrent);
            $this->data['strphantrang']=$this->custom_pagination->PagePer($totalItem, $pageCurrent, LIMIT_CONTENT_LIST, $url= base_url().'danh-muc-bai-viet/'.$alias);
            $listContentsByArrayId = $this->Mcontent->contentsByArrayCategoriesList($arrIdCategoies, LIMIT_CONTENT_LIST, $firstPage);
            for($i = 0; $i < count($listContentsByArrayId); $i++) {
                $listContentsByArrayId[$i]['images'] = json_decode($listContentsByArrayId[$i]['images'])[0];
                $listContentsByArrayId[$i]['title_image'] = json_decode($listContentsByArrayId[$i]['title_image'])[0];
                $listContentsByArrayId[$i]['alt_image'] = json_decode($listContentsByArrayId[$i]['alt_image'])[0];
            }
            $this->data['listCategoriesChild'] = $this->Mcategory->category_all_content($detailCategory['id'], TYPE_CATEGORY_CONTENT, 'all');
            $this->data['listContentsByArrayId'] = $listContentsByArrayId;
            $this->data['detailCategory'] = $detailCategory;
            $this->data['arrayCategories'] = $this->get_list_categories($arrIdCategoies, DEFAULT_PARENT_ID, TYPE_CATEGORY_CONTENT);
            $this->data['view']='list';
            $this->data['seoTitle']=$detailCategory['name'];
            $this->data['seo_google']=$detailCategory['seo_google'];
            $this->data['seo_facebook']=$detailCategory['seo_facebook'];
            $this->load->view('frontend/layout',$this->data);
        } else {
            redirect(URL_404,'refresh');
        }
    }

    public function detail_post($alias) {
        if ($this->Mcontent->content_check_field('alias', $alias)) {
            $id_content = $this->Mcontent->content_get_field_by_field('alias', $alias, 'id');
            $detail_content = $this->Mcontent->content_detail($id_content);
            $detailCategory = $this->Mcategory->category_detail($detail_content['category_id']);
            $arrIdCategoies = array($detail_content['category_id']);
            $this->get_list_categories($arrIdCategoies, $detail_content['category_id'], $detailCategory['type']);
            $listPostsRef = $this->Mcontent->contentsByArrayCategories($arrIdCategoies, 'listRef', null, null, TRUE, $detail_content['id']);
            for($i = 0; $i < count($listPostsRef); $i++) {
                $listPostsRef[$i]['images'] = json_decode($listPostsRef[$i]['images'])[0];
                $listPostsRef[$i]['title_image'] = json_decode($listPostsRef[$i]['title_image'])[0];
                $listPostsRef[$i]['alt_image'] = json_decode($listPostsRef[$i]['alt_image'])[0];
            }
            $this->data['view']='detail_post';
            $this->data['listPostsRef']=$listPostsRef;
            $this->data['detail_content']=$detail_content;
            $this->data['seoTitle']=$detail_content['title'];
            $this->data['seoKeywords'] = $detail_content['seo_keywords'];
            $this->data['seoDescription'] = $detail_content['seo_description'];
            $this->data['seo_google'] = $detail_content['seo_google'];
            $this->data['seo_facebook'] = $detail_content['seo_facebook'];
            $this->load->view('frontend/layout',$this->data);
        } else {
            redirect(URL_404,'refresh');
        }
    }

    public function get_list_categories(&$arrIdCategoies, $parent_id, $type) {
        $count = $this->Mcategory->count_categories($parent_id, $type);
        $arrayCategories = array();
        if ($count > 0) {
            $arrayCategories = $this->Mcategory->category_all_content($parent_id, $type);
            for($i = 0; $i < $count; $i++) {
                array_push($arrIdCategoies, $arrayCategories[$i]['id']);
                $list_childs = $this->get_list_categories($arrIdCategoies, $arrayCategories[$i]['id'], $arrayCategories[$i]['type']);
                $arrayCategories[$i]['count_childs'] = count($list_childs);
                $arrayCategories[$i]['childs'] = $list_childs;
            }
        }
        return $arrayCategories;
    }
}