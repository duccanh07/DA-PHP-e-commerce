<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mcontent extends CI_Model {

    public function __construct(){
        parent::__construct();
        $this->table = $this->db->dbprefix('posts');
    }

    public function content_count($status, $arrayOptionFiller = array()){
        $this->db->where('status !=', STATUS_DELETE);
        if (count($arrayOptionFiller) > 0) {
            foreach ($arrayOptionFiller as $key => $value) {
                if ($key == 'cat') {
                    $this->db->where('category_id', $value);
                }
                if ($key == 'keyword') {
                    $this->db->like('title', $value);
                }
            }
        }
        $query = $this->db->get($this->table);
        return count($query->result_array());
    }

    public function content_get_field($id, $field, $status){
        $this->db->where('id', $id);
        $this->db->where('status', $status);
        $this->db->limit(1);
        $query = $this->db->get($this->table);
        $row=$query->row_array();
        return $row[$field];
    }

    public function content_by_category_id($category_id, $status){
        $this->db->where('category_id', $category_id);
        $this->db->where('status', $status);
        $query = $this->db->get($this->table);
        return $query->result_array();
    }

    public function content_count_video($category_id){
        $this->db->where('urlVideo !=', '');
        $this->db->where('category_id', $category_id);
        $this->db->where('status', STATUS_ACTIVE);
        return $this->db->get($this->table)->num_rows();
    }

    public function list_contents_video($category_id){
        $this->db->where('urlVideo !=', '');
        $this->db->where('category_id', $category_id);
        $this->db->limit(5);
        $this->db->order_by('createdAt', 'desc');   
        $this->db->where('status', STATUS_ACTIVE);
        return $this->db->get($this->table)->result_array();
    }

    public function content_count_type_video(){
        $this->db->where('urlVideo !=', '');
        $this->db->where('type', 6);
        $this->db->where('status', STATUS_ACTIVE);
        return $this->db->get($this->table)->num_rows();
    }

    public function list_contents_type_video($limit, $first){
        $this->db->where('urlVideo !=', '');
        $this->db->where('type', 6);   
        $this->db->where('status', STATUS_ACTIVE);
        if($first != ''){
            $this->db->limit($limit, $first);
        }else{
            $this->db->limit($limit);
        }
        $this->db->order_by('createdAt', 'desc');
        return $this->db->get($this->table)->result_array();
    }

    public function content_all($status, $limit, $first, $arrayOptionFiller = array()){
        $this->db->select('
            content.id, 
            content.title,
            content.type,
            category.name as categoryObject,
            content.images,
            content.status');
        $this->db->from($this->table . ' content'); 
        $this->db->where('content.status', STATUS_ACTIVE);
        if (count($arrayOptionFiller) > 0) {
            foreach ($arrayOptionFiller as $key => $value) {
                if ($key == 'cat') {
                    $this->db->where('content.category_id', $value);
                }
                if ($key == 'keyword') {
                    $this->db->like('content.title', $value);
                }
            }
        }
        $this->db->order_by('content.id', 'desc');
        //$this->db->join('db_images images', 'images.id = content.images');
        $this->db->join('db_category category', 'category.id = content.category_id');
        $this->db->group_by('content.id');
        if($first != ''){
            $this->db->limit($limit, $first);
        }else{
            $this->db->limit($limit);
        }
        $query = $this->db->get($this->table);
        return $query->result_array();
    }

    public function content_insert($mydata){
        $this->db->insert($this->table, $mydata);
        return $this->db->insert_id();
    }

    public function content_detail($id){
        $this->db->where('status !=', STATUS_DELETE);
        $this->db->where('id', $id);
        $query = $this->db->get($this->table);
        return $query->row_array();
    }

    public function content_detail_alias($alias){
        $this->db->where('status !=', STATUS_DELETE);
        $this->db->where('alias', $alias);
        $query = $this->db->get($this->table);
        return $query->row_array();
    }

    public function content_update_topicId($mydata, $listcat){
        if($listcat != ''){
            $this->db->group_start();
            foreach ($listcat as $value) {
                $this->db->or_where('id', $value);
            }
            $this->db->group_end();
        }
        $this->db->update($this->table, $mydata);
    }

    public function contentsByArrayCategories($listcat, $type = null, $limit = null, $first = null, $not = FALSE, $id_not = null){
        $this->db->where('status', STATUS_ACTIVE);
        if($listcat != '' && count($listcat) > 0){
            $this->db->group_start();
            foreach ($listcat as $value) {
                $this->db->or_where('category_id', $value);
            }
            $this->db->group_end();
        }
        if ($not == TRUE) {
            $this->db->where('id != ', $id_not);
        }
        $this->db->order_by('createdAt', 'desc');   
        if ($type == null) {
            $this->db->limit(LIMIT_POSTS_SHOW_HOME);
        } elseif ($type = 'listRef') {
            $this->db->limit(6);
        } else {
            $this->db->limit($limit, $first);
        }
        $query = $this->db->get($this->table);
        return $query->result_array();
    }

    public function contentsByArrayCategoriesList($listcat, $limit = null, $first = null){
        $this->db->where('status', STATUS_ACTIVE);
        if($listcat != '' && count($listcat) > 0){
            $this->db->group_start();
            foreach ($listcat as $value) {
                $this->db->or_where('category_id', $value);
            }
            $this->db->group_end();
        }
        
        $this->db->order_by('createdAt', 'desc');   
        $this->db->limit($limit, $first);
        $query = $this->db->get($this->table);
        return $query->result_array();
    }
    public function contentsCountByCategory($listcat){
        $this->db->where('status', STATUS_ACTIVE);
        if($listcat != ''){
            $d=0;
            foreach ($listcat as $value){
                if($d==0) {
                    $this->db->where('category_id', $value);
                } else {
                    $this->db->or_where('category_id', $value);
                }
                $d++;
            }
        }
        $query = $this->db->get($this->table);
        return count($query->result_array());
    }

    public function content_check_field($field, $value){
        $this->db->where($field, $value);
        $query = $this->db->get($this->table);
        if(count($query->result_array()) > 0){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function content_get_field_by_field($field_input, $value_input, $field_output){
        $this->db->where($field_input, $value_input);
        $this->db->where('status', STATUS_ACTIVE);
        $this->db->limit(1);
        $query = $this->db->get($this->table);
        $row=$query->row_array();
        return $row[$field_output];
    }

    public function content_video_ref($id){
        $this->db->where('id != ', $id);
        $this->db->where('status', STATUS_ACTIVE);
        $this->db->where('type', 6);
        $this->db->limit(4);
        return $this->db->get($this->table)->result_array();
    }


    public function content_get_post_introduction(){
        $this->db->where('type !=', 6);
        $this->db->where('status', STATUS_ACTIVE);
        $this->db->like('alias', 'gioi-thieu');
        $this->db->limit(1);
        return $this->db->get($this->table)->row_array();
    }

}

/* End of file muser.php */
/* Location: ./application/models/muser.php */