<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mconfig extends CI_Model {

	public function __construct(){
        parent::__construct();
        $this->table = $this->db->dbprefix('settings');
    }

    public function configsAll(){
        $this->db->where('status', STATUS_ACTIVE);
        return $this->db->get($this->table)->result_array();
    }

    public function configDetailId($id){
        $this->db->where('id', $id);
        $query = $this->db->get($this->table);
        return $query->row_array();   
    }

    public function configUpdate($mydata, $id){
        $this->db->where('id',$id);
        $this->db->update($this->table, $mydata);
    }

    public function configCheckField($field, $value){
        $this->db->where($field, $value);
        $this->db->where('status !=', STATUS_DELETE);
        $query = $this->db->get($this->table);
        if(count($query->result_array()) > 0){
            return TRUE;
        }else{
            return FALSE;
        }
    }
}