<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mcustomer_feedback extends CI_Model {

	public function __construct(){
        parent::__construct();
        $this->table = $this->db->dbprefix('customers_feedback');
    }

    public function customers_feedback_count($status){
        $this->db->where('status', $status);
        $query = $this->db->get($this->table);
        return count($query->result_array());
    }

    public function customers_feedback_all($limit = null, $first = null){ 
        $this->db->where('status', STATUS_ACTIVE);
        $this->db->order_by('id', 'desc');
        $this->db->group_by('id');
        if($first != null && $limit != null){
            $this->db->limit($limit, $first);
        }
        $listResult = $this->db->get($this->table)->result_array();
        return $listResult;
    }

    public function customers_feedback_insert($mydata){
        $this->db->insert($this->table, $mydata);
        return $this->db->insert_id();
    }

    public function customers_feedback_update($mydata, $id){
        $this->db->where('id',$id);
        $this->db->update($this->table, $mydata);
    }

    public function customer_feedback_check_id($id){
        $this->db->where('id', $id);
        $query = $this->db->get($this->table);
        if(count($query->result_array()) > 0){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function customer_feedback_detail_id($id){
        $this->db->where('id', $id);
        $query = $this->db->get($this->table);
        return $query->row_array();   
    }

}

/* End of file muser.php */
/* Location: ./application/models/muser.php */