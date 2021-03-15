<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mcategory extends CI_Model {

	public function __construct(){
        parent::__construct();
        $this->table = $this->db->dbprefix('category');
    }

    public function category_count($status, $parent_id = null){
        $this->db->where('status', $status);
        if ($parent_id != null) {
            $this->db->where('parent_id', $parent_id);
        }
        $query = $this->db->get($this->table);
        return count($query->result_array());
    }

    public function category_get_field($id, $field, $status = STATUS_ACTIVE){
        $this->db->where('id', $id);
        $this->db->where('status', $status);
        $this->db->limit(1);
        $query = $this->db->get($this->table);
        $row=$query->row_array();
        return $row[$field];
    }

    public function category_check_field($field, $value){
        $this->db->where($field, $value);
        $this->db->where('status !=', STATUS_DELETE);
        $query = $this->db->get($this->table);
        if(count($query->result_array()) > 0){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function category_all($parentId, $status, $limit = '', $first = '', $order = false, $type = null, $type_or = null, $type_or2 = null, $type_or3 = null){
        if ($parentId !='all') {
            $this->db->where('parent_id', $parentId);
        }
        $this->db->where('status', $status);
        //if ($order == true) {
        //    $this->db->order_by('id', 'asc');
        //} else {
            $this->db->order_by('parent_id', 'asc');
            $this->db->order_by('ordering', 'asc');
        //}
        if ($type != null) {
            $this->db->where('type', $type);
            if ($type_or != null) {
                $this->db->or_where('type', $type_or);
            }
            if ($type_or2 != null) {
                $this->db->or_where('type', $type_or2);
            }

            if ($type_or3 != null) {
                $this->db->or_where('type', $type_or3);
            }
        }
        if($first != '' && $limit != ''){
            $this->db->limit($limit, $first);
        }else{
            $this->db->limit($limit);
        }
        $query = $this->db->get($this->table);
        return $query->result_array();
    }

    public function category_all_fillter($parentId, $type, $limit = '', $first = ''){
        if ($parentId != -2 && $parentId != null) {
            $this->db->where('parent_id ', $parentId);
        }
        if ($type != -2 && $type != null) {
            $this->db->where('type ', $type);
        }
        $this->db->order_by('id', 'desc');
        $this->db->where('status !=', STATUS_DELETE);
        if($first != '' && $limit != ''){
            $this->db->limit($limit, $first);
        }
        return $this->db->get($this->table)->result_array();
    }

    public function category_count_fillter($parentId, $type, $status){
        if ($parentId != -2) {
            $this->db->where('parent_id ', $parentId);
        }
        if ($type != -2) {
            $this->db->where('type ', $type);
        }
        $query = $this->db->get($this->table);
        return count($query->result_array());
    }

    public function category_insert($mydata){
        $this->db->insert($this->table, $mydata);
        return $this->db->insert_id();
    }

    public function category_detail($id){
        $this->db->where('status !=', STATUS_DELETE);
        $this->db->where('id', $id);
        $query = $this->db->get($this->table);
        return $query->row_array();
    }

    public function category_update($mydata, $id){
        $this->db->where('id',$id);
        $this->db->update($this->table, $mydata);
    }

    public function category_all_client($parentId, $type){
        $this->db->where('parent_id ', $parentId);
        $this->db->where('type ', $type);
        $this->db->where('is_show_home ', CATEGORY_ALLOW_SHOW_IN_HOME);
        $this->db->order_by('parent_id', 'asc');
        $this->db->order_by('ordering', 'asc');
        $this->db->where('status !=', STATUS_DELETE);
        return $this->db->get($this->table)->result_array();
    }


    public function category_get_field_by_field($field_input, $value_input, $field_output){
        $this->db->where($field_input, $value_input);
        $this->db->where('status', STATUS_ACTIVE);
        $this->db->limit(1);
        $query = $this->db->get($this->table);
        $row=$query->row_array();
        return $row[$field_output];
    }

    public function category_all_content($parentId, $type = null, $limit = null){
        $this->db->where('is_show_menu', CATEGORY_ALLOW_SHOW_IN_MENU);
        $this->db->where('parent_id ', $parentId);
        if ($type != null)
        {
            $this->db->where('type ', $type);
        }
        
        if ($type != null)
        {
            $this->db->limit($limit);
        }
        $this->db->order_by('parent_id', 'asc');
        $this->db->order_by('ordering', 'asc');
        $this->db->where('status !=', STATUS_DELETE);
        return $this->db->get($this->table)->result_array();
    }

    public function count_categories($parentId, $type = null){
        $this->db->where('parent_id ', $parentId);
        if ($type != null)
        {
            $this->db->where('type ', $type);
        }
        $this->db->where('status !=', STATUS_DELETE);
        return count($this->db->get($this->table)->result_array());
    }
}

/* End of file muser.php */
/* Location: ./application/models/muser.php */