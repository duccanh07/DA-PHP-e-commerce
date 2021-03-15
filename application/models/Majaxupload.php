<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    class Majaxupload extends CI_Model {
    	public function __construct(){
            parent::__construct();
            $this->table = $this->db->dbprefix('images');
        }
        public function image_get_field($field, $id, $status){
            $this->db->where('id', $id);
            if($status != ''){
                $this->db->where('status', $status);
            }
            $this->db->limit(1);
            $query = $this->db->get($this->table);
            return $query->row_array()[$field];
        }

         public function image_get_field_ajax($name, $field){
            $this->db->where('name', $name);
            $this->db->limit(1);
            $query = $this->db->get($this->table);
            $row=$query->row_array();
            return $row[$field];
        }

        public function images_insert($mydata){
            $this->db->insert($this->table, $mydata);
            return $this->db->insert_id();
        }

        public function images_update($mydata, $id){
	        $this->db->where('id',$id);
	        $this->db->update($this->table, $mydata);
	    }
        public function images_update_by_name($mydata, $name){
            $this->db->where('name',$name);
            $this->db->update($this->table, $mydata);
        }
    }
?>