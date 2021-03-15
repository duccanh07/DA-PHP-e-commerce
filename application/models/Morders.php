<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Morders extends CI_Model {

	public function __construct(){
        parent::__construct();
        $this->table = $this->db->dbprefix('orders');
    }

    public function orders_insert($mydata){
        $this->db->insert($this->table,$mydata);
        return $this->db->insert_id();
    }

    public function orders_detail($id){
        $this->db->where('status', STATUS_ACTIVE);
        $this->db->where('id', $id);
        $result = $this->db->get($this->table)->row_array();
        $idUser = $result['idUserOrder'];
        $result['idUserOrder'] = $this->db->query("SELECT * FROM db_user WHERE id = ".$idUser)->row_array();
        $result['idProducts'] = json_decode($result['idProducts']);
        return $result;
    }

    public function orders_detail_order_code($orderCode){
        $this->db->where('status', STATUS_ACTIVE);
        $this->db->where('orderCode', $orderCode);
        $result = $this->db->get($this->table)->row_array();
        $idUser = $result['idUserOrder'];
        $result['idUserOrder'] = $this->db->query("SELECT * FROM db_user WHERE id = ".$idUser)->row_array();
        $result['idProducts'] = json_decode($result['idProducts']);
        return $result;
    }

     public function order_count($status, $state, $from = null, $to = null, $orderCode = null){
        $this->db->where('status', $status);
        if (isset($state)) {
            $this->db->where('state', $state);
        }
        if (isset($from) && $from != null && isset($to) && $to != null) {
            $this->db->where('createdAt >=', $from);
            $this->db->where('createdAt <=', $to);
        }
        if (isset($orderCode) && $orderCode != null) {
            $this->db->like('orderCode', $orderCode);
        }
        $query = $this->db->get($this->table);
        return count($query->result_array());
    }

    public function order_all($limit, $first, $status, $state, $from = null, $to = null, $orderCode = null){
        $this->db->from($this->table . ' order'); 
        $this->db->where('order.status', $status);
        if (isset($state)) {
            $this->db->where('order.state', $state);
        }
        if (isset($from) && $from != null && isset($to) && $to != null) {
            $this->db->where('createdAt >=', $from);
            $this->db->where('createdAt <=', $to);
        }
        if (isset($orderCode) && $orderCode != null) {
            $this->db->like('orderCode', $orderCode);
        }
        $this->db->order_by('order.id', 'desc');
        if($first != ''){
            $this->db->limit($limit, $first);
        }else{
            $this->db->limit($limit);
        }
        $listResult = $this->db->get()->result_array();
        for( $i = 0; $i < count($listResult); $i++){
            $listResult[$i]['idUserOrder'] = $this->db->query("SELECT * FROM db_user WHERE id = ".$listResult[$i]['idUserOrder'])->row_array();
        }
        return $listResult;
    }

    public function order_check_orderCode($orderCode){
        $this->db->where('orderCode', $orderCode);
        $this->db->where('status !=', STATUS_DELETE);
        $query = $this->db->get($this->table);
        if(count($query->result_array())==1){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    /*public function orders_detail_order_code($orderCode){
        $this->db->where('status', STATUS_ACTIVE);
        $this->db->where('orderCode', $orderCode);
        $result = $this->db->get($this->table)->row_array();
        $idUser = $result['idUserOrder'];
        $shippingAddressId =$result['shippingAddress'];
        $result['idUserOrder'] = $this->db->query("SELECT * FROM db_user WHERE id = ".$idUser)->row_array();
        $result['idProducts'] = json_decode($result['idProducts']);
        $result['shippingAddress'] = $this->db->query("SELECT * FROM db_shipping WHERE id = ".$shippingAddressId)->row_array();
        $result['shippingAddress']['provinceID'] = $this->db->query("SELECT * FROM db_province WHERE id = ".$result['shippingAddress']['provinceID'])->row_array();
        $result['shippingAddress']['districtID'] = $this->db->query("SELECT * FROM db_district WHERE id = ".$result['shippingAddress']['districtID'])->row_array();
        $result['shippingAddress']['wardID'] = $this->db->query("SELECT * FROM db_ward WHERE id = ".$result['shippingAddress']['wardID'])->row_array();
        return $result;
    }*/

    public function order_update($mydata, $orderCode){
        $this->db->where('orderCode',$orderCode);
        $this->db->update($this->table, $mydata);
    }

}

/* End of file muser.php */
/* Location: ./application/models/muser.php */