<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mpolicies extends CI_Model {

	public function __construct(){
        parent::__construct();
        $this->table = $this->db->dbprefix('policies');
    }

    public function policies_all($type = null){
        $this->db->where('status != ', STATUS_DELETE);
        if ($type != null) {
            $this->db->where('type', $type);
        }
        $this->db->order_by('type', 'asc');
        $this->db->order_by('ordering', 'asc');
        $this->db->group_by('id');
        $query = $this->db->get($this->table);
        return $query->result_array();
    }

    public function policies_check_id($id){
        $this->db->where('id', $id);
        $this->db->where('status !=', STATUS_DELETE);
        $query = $this->db->get($this->table);
        if(count($query->result_array()) > 0){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function policies_detail_id($id){
        $this->db->where('id', $id);
        $query = $this->db->get($this->table);
        return $query->row_array();   
    }

    public function policies_update($mydata, $id){
        $this->db->where('id',$id);
        $this->db->update($this->table, $mydata);
    }
}