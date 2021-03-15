<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mproduct extends CI_Model {

	public function __construct(){
        parent::__construct();
        $this->table = $this->db->dbprefix('products');
    }

    public function product_count($status, $arrayOptionFiller = array()){
        $this->db->where('status', $status);
        if (count($arrayOptionFiller) > 0) {
            foreach ($arrayOptionFiller as $key => $value) {
                if ($key == 'cat') {
                    $this->db->where('category_id', $value);
                }
                if ($key == 'option') {
                    switch ($value) {
                        case OPTION_FILLTER_NO_PRICE:
                            $this->db->where('item_prices', '[""]');
                            break;
                        case OPTION_FILLTER_PRICE:
                            $this->db->where('item_prices !=', '[""]');
                            break;
                        case OPTION_FILLTER_HOT_SALE:
                            $this->db->where('is_hot_sale', PRODUCT_IS_HOT_SALE);
                            break;
                        case OPTION_FILLTER_HOT:
                            $this->db->where('is_hot', PRODUCT_IS_HOT);
                            break;
                        case OPTION_FILLTER_NEW:
                            $this->db->where('is_new', PRODUCT_IS_NEW);
                            break;
                        case OPTION_FILLTER_PRODUCT_VIDEO:
                            $this->db->where('is_product_video', PRODUCT_IS_PRODUCT_VIDEO);
                            $this->db->where('link_video != ', '');
                            break;
                        default:
                            break;
                    }
                }
                if ($key == 'keyword') {
                    $this->db->like('name', $value);
                }
            }
        }
        $query = $this->db->get($this->table);
        return count($query->result_array());
    }

    public function product_all($limit, $first, $arrayOptionFiller = array()){
        $this->db->from($this->table . ' product'); 
        $this->db->where('status !=', STATUS_DELETE);
        if (count($arrayOptionFiller) > 0) {
            foreach ($arrayOptionFiller as $key => $value) {
                if ($key == 'cat') {
                    $this->db->where('category_id', $value);
                }
                if ($key == 'option') {
                    switch ($value) {
                        case OPTION_FILLTER_NO_PRICE:
                            $this->db->where('item_prices', '[""]');
                            break;
                        case OPTION_FILLTER_PRICE:
                            $this->db->where('item_prices !=', '[""]');
                            break;
                        case OPTION_FILLTER_HOT_SALE:
                            $this->db->where('is_hot_sale', PRODUCT_IS_HOT_SALE);
                            break;
                        case OPTION_FILLTER_HOT:
                            $this->db->where('is_hot', PRODUCT_IS_HOT);
                            break;
                        case OPTION_FILLTER_NEW:
                            $this->db->where('is_new', PRODUCT_IS_NEW);
                            break;
                        case OPTION_FILLTER_PRODUCT_VIDEO:
                            $this->db->where('is_product_video', PRODUCT_IS_PRODUCT_VIDEO);
                            $this->db->where('link_video != ', '');
                            break;
                        default:
                            break;
                    }
                }
                if ($key == 'keyword') {
                    $this->db->like('name', $value);
                }
            }
        }
        $this->db->order_by('product.category_id', 'desc');
        $this->db->order_by('product.ordering', 'desc');
        if($first != '' && $limit != ''){
            $this->db->limit($limit, $first);
        }else{
            $this->db->limit($limit);
        }
        $listResult = $this->db->get()->result_array();
        $listResultReturn = [];
        $CI =& get_instance();
        $CI->load->model('Majaxupload');
        foreach( $listResult as $row){
            $row['category_id'] = $CI->Mcategory->category_get_field($row['category_id'], 'name');
            array_push($listResultReturn, $row);
        }
        return $listResultReturn;
    }

    public function product_insert($mydata){
        $this->db->insert($this->table, $mydata);
        return $this->db->insert_id();
    }

    public function product_update($mydata, $id){
        $this->db->where('id',$id);
        $this->db->update($this->table, $mydata);
    }

    public function product_check_id($id){
        $this->db->where('id', $id);
        $this->db->where('status !=', STATUS_DELETE);
        $query = $this->db->get($this->table);
        if(count($query->result_array()) > 0){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function product_detail($id){
        $this->db->where('status !=', STATUS_DELETE);
        $this->db->where('id', $id);
        $query = $this->db->get($this->table);
        $CI =& get_instance();
        $CI->load->model('Majaxupload');
        $detailProduct = $query->row_array();
        /*$arrayImages = array();
        foreach( json_decode($detailProduct['images']) as $row){
            array_push(
                $arrayImages, 
                $CI->Majaxupload->image_get_field(
                    'name', 
                    $row, 
                    $detailProduct['status']
                )
            );
        }
        $detailProduct['images'] = json_encode();*/
        return $detailProduct;
    }

    public function product_detail_no_join($id){
        $this->db->where('status !=', STATUS_DELETE);
        $this->db->where('id', $id);
        $query = $this->db->get($this->table);
        $CI =& get_instance();
        $CI->load->model('Majaxupload');
        $detailProduct = $query->row_array();
        return $detailProduct;
    }

    public function products_video() {
        $this->db->where('is_product_video', PRODUCT_IS_PRODUCT_VIDEO);
        $this->db->where('link_video != ', '');
        $this->db->where('status !=', STATUS_DELETE);
        $this->db->order_by('id', 'desc');
        $this->db->limit(5);
        return $this->db->get($this->table)->result_array();
    }

    public function count_products_video() {
        $this->db->where('is_product_video', PRODUCT_IS_PRODUCT_VIDEO);
        $this->db->where('link_video != ', '');
        $this->db->where('status !=', STATUS_DELETE);
        $this->db->order_by('id', 'desc');
        return $this->db->get($this->table)->num_rows();
    }

    public function productByArrayCatId($listcat,$limit, $first){
        $this->db->where('status', STATUS_ACTIVE);
        if($listcat != ''){
            $this->db->group_start();
            foreach ($listcat as $value) {
                $this->db->or_where('category_id', $value);
            }
            $this->db->group_end();
        }
        $this->db->where('is_product_video', PRODUCT_IS_NOT_PRODUCT_VIDEO);
        $this->db->order_by('category_id', 'desc');
        $this->db->order_by('ordering', 'desc');
        if($first != ''){
            $this->db->limit($limit, $first);
        }else{
            $this->db->limit($limit);
        }
        $query = $this->db->get($this->table);
        return $query->result_array();
    }

    public function productCountByCategory($listcat){
        $this->db->where('status', STATUS_ACTIVE);
        if($listcat != ''){
            $d=0;
            foreach ($listcat as $value){
                if($d==0) {
                    $this->db->where('category_id', $value);
                    $this->db->where('is_product_video', PRODUCT_IS_NOT_PRODUCT_VIDEO); 
                } else {
                    $this->db->or_where('category_id', $value); 
                    $this->db->where('is_product_video', PRODUCT_IS_NOT_PRODUCT_VIDEO); 
                }
                $d++;
            }
        }
        $query = $this->db->get($this->table);
        return count($query->result_array());
    }


    public function product_check_alias($alias){
        $this->db->where('alias', $alias);
        $this->db->where('status !=', STATUS_DELETE);
        $query = $this->db->get($this->table);
        if(count($query->result_array()) > 0){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function product_video_ref($id){
        $this->db->where('id != ', $id);
        $this->db->where('status', STATUS_ACTIVE);
        $this->db->where('link_video != ', '');
        $this->db->where('is_product_video', PRODUCT_IS_PRODUCT_VIDEO);
        $this->db->limit(4);
        return $this->db->get($this->table)->result_array();
    }

    public function product_list_videos($limit, $first){
        $this->db->where('status', STATUS_ACTIVE);
        $this->db->where('link_video != ', '');
        $this->db->where('is_product_video', PRODUCT_IS_PRODUCT_VIDEO);
        $this->db->limit($limit, $first);
        return $this->db->get($this->table)->result_array();
    }


    public function product_detail_no_join_alias($alias){
        $this->db->where('status', STATUS_ACTIVE);
        $this->db->where('alias', $alias);
        $query = $this->db->get($this->table);
        $detailProduct = $query->row_array();
        return $detailProduct;
    }

    public function products_ref($id, $category_id){
        $this->db->where('id != ', $id);
        $this->db->where('status', STATUS_ACTIVE);
        $this->db->where('category_id', $category_id);
        $this->db->limit(4);
        return $this->db->get($this->table)->result_array();
    }

    public function productDetailJoinImage($id){
        $this->db->select('
            product.id, 
            product.name,
            product.alias,
            product.images as images,
            category.name as category,
            product.item_prices as price,
            product.item_codes as sizes,
            product.items_price_sale as items_price_sale,
            product.title_image as title_image,
            product.alt_image as alt_image,
            product.item_sale_of as sale_of'
        );
        $this->db->from($this->table . ' product'); 
       $this->db->where('product.id', $id);
        $this->db->where('product.status', STATUS_ACTIVE);
        $this->db->join('db_category category', 'category.id = product.category_id');
        $listResult = $this->db->get($this->table)->row_array();
        /*$CI =& get_instance();
        $CI->load->model('Majaxupload');
        $listResult['images'] = $CI->Majaxupload->image_get_field('name', json_decode($listResult['images'])[0],STATUS_ACTIVE);*/
        return $listResult;
    }

    public function product_search($name, $limit, $first){
        $this->db->like('name', $name);
        $this->db->where('status', STATUS_ACTIVE);
        $this->db->order_by('createdAt', 'desc');
        $this->db->order_by('ordering', 'desc');
        return $this->db->get($this->table,$limit,$first)->result_array();
    }

    public function product_search_count($name){
        $this->db->like('name', $name);
        $this->db->where('status', STATUS_ACTIVE);
        $query = $this->db->get($this->table);
        return count($query->result_array());
    }

}

/* End of file muser.php */
/* Location: ./application/models/muser.php */