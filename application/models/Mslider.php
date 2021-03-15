<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mslider extends CI_Model {

	public function __construct(){
        parent::__construct();
        $this->table = $this->db->dbprefix('banner_slider');
    }

    public function slider_all($status, $type){
        $this->db->where('type', $type);
        $this->db->where('status', $status);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get($this->table);
        return $query->result_array();
    }

    public function slider_check_id($id){
        $this->db->where('id', $id);
        $this->db->where('status !=', STATUS_DELETE);
        $query = $this->db->get($this->table);
        if(count($query->result_array()) > 0){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function slider_insert($mydata){
        $this->db->insert($this->table,$mydata);
        return $this->db->insert_id();
    }

    public function slider_detail_id($id){
        $this->db->where('id', $id);
        $query = $this->db->get($this->table);
        return $query->row_array();   
    }

    public function slider_update($mydata, $id){
        $this->db->where('id',$id);
        $this->db->update($this->table, $mydata);
    }
}