<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Common
{
    public $CI;
    public function __construct()
    {
        if (!isset($this->CI))
        {
            $this->CI =& get_instance();
        }
        $this->CI->load->model('Mcategory');
        $this->CI->load->model('Mslider');
        $this->CI->load->model('Msetting');
        $this->CI->load->model('Mpolicies');
    }

    public function listCategories($parentIdDefault = DEFAULT_PARENT_ID) {
        $arrayCategories = $this->CI->Mcategory->category_all_client($parentIdDefault, TYPE_CATEGORY_PRODUCT);
        for($i = 0; $i < count($arrayCategories); $i++) {
            $arrayCategories[$i]['category_childs'] = $this->CI->Mcategory->category_all_client($arrayCategories[$i]['id'], TYPE_CATEGORY_PRODUCT);
        }
        return $arrayCategories;
    }

    public function get_list_categories(&$arrIdCategoies, $parent_id) {
        $count = $this->CI->Mcategory->count_categories($parent_id);
        $arrayCategories = array();
        if ($count > 0) {
            $arrayCategories = $this->CI->Mcategory->category_all_content($parent_id);
            for($i = 0; $i < $count; $i++) {
                if (isset($arrayCategories[$i])) {
                    array_push($arrIdCategoies, $arrayCategories[$i]['id']);
                    $list_childs = $this->get_list_categories($arrIdCategoies, $arrayCategories[$i]['id']);
                    $arrayCategories[$i]['count_childs'] = count($list_childs);
                    $arrayCategories[$i]['childs'] = $list_childs;
                }
            }
        }
        return $arrayCategories;
    }

    public function listSliders() {
        return $this->CI->Mslider->slider_all(STATUS_ACTIVE, TYPE_SLIDER);
    }

    public function getSetting() {
        return $this->CI->Msetting->setting_detail_id(1);
    }

    public function listPoliciesOrther() {
        return $this->CI->Mpolicies->policies_all(POLICIES_TYPE_ORTHER);
    }
}