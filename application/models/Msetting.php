<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Msetting extends CI_Model {

	public function __construct(){
        parent::__construct();
        $this->table = $this->db->dbprefix('configs');
    }

    public function setting_detail_id($id){
        $this->db->where('id', $id);
        $query = $this->db->get($this->table);
        return $query->row_array();   
    }

    public function setting_update($mydata, $id){
        $this->db->where('id',$id);
        $this->db->update($this->table, $mydata);
    }
}