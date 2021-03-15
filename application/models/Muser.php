<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Muser extends CI_Model {

	public function __construct(){
        parent::__construct();
        $this->table = $this->db->dbprefix('user');
    }
    /*Hàm login và lấy thông tin của user login*/
    function user_login($username, $password){
    	$this->db->where('username', $username);
    	$this->db->where('password', $password);
        $this->db->where('kind', KIND_ADMIN);
        $this->db->where('status', STATUS_ACTIVE);
    	$query = $this->db->get($this->table);
        if(count($query->result_array())==1){
        	return $query->row_array();
        }else{
        	return FALSE;
        }	
    }
    /*Hàm kiểm tra username có tồn tại hay không ? */
    function user_check_field($username, $field){
        $this->db->where('username', $username);
        $this->db->where('status !=', STATUS_DELETE);
        $query = $this->db->get($this->table);
        if(count($query->result_array()) > 0){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    function user_check_id($id, $kind){
        $this->db->where('id', $id);
        $this->db->where('kind', $kind);
        $this->db->where('status !=', STATUS_DELETE);
        $query = $this->db->get($this->table);
        if(count($query->result_array()) > 0){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    /*Đếm số lượng user theo điều kiện đưa vào: $status ||$kind */
    public function users_count($status, $kind){
        $this->db->where('status', $status);
        $this->db->where('kind', $kind);
        $query = $this->db->get($this->table);
        return count($query->result_array());
    }

    public function users_all($limit, $first, $status, $kind){
        $this->db->where('status', $status);
        $this->db->where('kind', $kind);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get($this->table, $limit, $first);
        return $query->result_array();
    }

    public function user_insert($mydata){
        $this->db->insert($this->table,$mydata);
        return $this->db->insert_id();
    }

    public function user_detail_id($id){
        $this->db->where('status !=', STATUS_DELETE);
        $this->db->where('id', $id);
        $query = $this->db->get($this->table);
        return $query->row_array();   
    }

    public function user_update($mydata, $id){
        $this->db->where('id',$id);
        $this->db->update($this->table, $mydata);
    }

    function user_check_email($email){
        $this->db->where('email', $email);
        $this->db->where('status != ', STATUS_DELETE);
        $this->db->limit(1);
        $query = $this->db->get($this->table);
        return $query->result_array();
    }

}

/* End of file muser.php */
/* Location: ./application/models/muser.php */