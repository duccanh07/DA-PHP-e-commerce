<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mconfig extends CI_Model {

	public function __construct(){
        parent::__construct();
        $this->table = $this->db->dbprefix('settings');
    }

    public function configDetailByCode($code){
        $this->db->where('code', $code);
        $query = $this->db->get($this->table);
        return $query->row_array();   
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