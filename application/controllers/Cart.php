<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'controllers/Common.php'); 

class Cart extends CI_Controller {
    // Hàm khởi tạo
    function __construct() {
        parent::__construct();
        $this->load->model('Mcategory');
        $this->load->model('Mproduct');
        $this->load->model('Majaxupload');
        $this->load->model('Morders');
        $this->load->model('frontend/Mconfig');
        $this->load->model('Muser');
        $this->load->library('validate');
        $this->data['component']='cart';
        $this->Common = new Common();
        $arrIdCategoies = array();
        $listCategories = $this->Common->get_list_categories($arrIdCategoies, DEFAULT_PARENT_ID);
        $this->data['listCategories'] = $listCategories;
        $this->data['listSliders'] = $this->Common->listSliders();
        $this->data['seotitle'] = 'Giỏ hàng của bạn';
        $configs =  getConfigs();
        $this->data['configs'] = $configs;
    }

    public function addcart(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id=$_POST['id'];
            if ($this->Mproduct->product_check_id($id) == TRUE) {
                $productDetail = $this->Mproduct->productDetailJoinImage($id);
                $item_codes = json_decode($productDetail['sizes']);
                $product_code = '';
                if (isset($_POST['code']) && $_POST['code'] != '') {
                    $product_code = $item_codes[$_POST['code']];
                }
                if($this->session->userdata('sesstionCartClient')){
                    $cart=$this->session->userdata('sesstionCartClient');
                    if(array_key_exists($id, $cart)){
                        $cart[$id.'|#|'.$product_code]['quantity'] += $_POST['quantity'];
                    }else{
                        $cart[$id.'|#|'.$product_code] = array(
                            'id' => $id, 
                            'quantity' => $_POST['quantity'],
                            'positionCode' => $_POST['code'],
                            'product_code' => $product_code
                        );
                    }
                }else{
                    $cart[$id.'|#|'.$product_code] = array(
                        'id' => $id, 
                        'quantity' => $_POST['quantity'],
                        'positionCode' => $_POST['code'],
                        'product_code' => $product_code
                    );
                }
                $this->session->set_userdata('sesstionCartClient',$cart);
                echo json_encode($cart);
            } else {
                redirect(URL_404,'refresh');
            }
        } else {
            redirect(URL_404,'refresh');
        }
    }

    public function list_cart(){

        $d=getdate();

        $today=$d['year']."/".$d['mon']."/".$d['mday']." ".$d['hours'].":".$d['minutes'].":".$d['seconds'];

        $this->load->helper('string');

        $this->form_validation->set_rules('email', 'Địa chỉ email', 'required|valid_email');

        $this->form_validation->set_rules('fullname', 'Họ và tên', 'required|min_length[6]|max_length[50]');

        $this->form_validation->set_rules('phone', 'Số điện thoại', 'required|min_length[10]|max_length[11]');

        $this->form_validation->set_rules('address', 'Địa chỉ', 'required');

        if ($this->form_validation->run() ==TRUE){

            $cart = $this->session->userdata('sesstionCartClient');

            if ($cart && count($cart) > 0) {

                if($this->validate->check_phone_number($_POST['phone'])) {

                    //$user = $this->Muser->user_check_email_customer($_POST['email']);
                    $user = $this->Muser->user_check_email($_POST['email']);

                    $idUserOrder;

                    if (count($user) > 0) {

                        $idUserOrder = $user[0]['id'];
                        $mydata = array(
                            'fullname' => $_POST['fullname'],
                            'phone' => $_POST['phone'], 
                            'address' => $_POST['address']
                        );
                        $this->Muser->user_update($mydata, $idUserOrder);

                    } else {

                        $mydata= array(

                            'username' => $_POST['fullname'], 

                            'fullname' => $_POST['fullname'], 

                            'email' => $_POST['email'], 

                            'phone' => $_POST['phone'], 

                            'password' => md5('thamlotsan.vn'), 

                            'address' => $_POST['address'],

                            'kind' => KIND_CUSTOMER,

                            'status' => STATUS_ACTIVE

                        );

                        $idUserOrder = $this->Muser->user_insert($mydata);

                    }

                    $orderCode = random_string('alnum', 6);

                    $listProductInCart = $this->get_list_product_in_cart();

                    $dataOrder = array(

                        'orderCode' => strtoupper($orderCode),

                        'idUserOrder' => $idUserOrder,

                        'idProducts' => json_encode($listProductInCart['product']),

                        'totalPrice' => $listProductInCart['totalPrice'],

                        'createdAt'=> $today,

                        'createdBy'=> $idUserOrder,

                        'updatedAt'=> $today,

                        'updatedBy'=> $idUserOrder,

                        'status' => STATUS_ACTIVE,

                        'state' => STATE_ORDER_ORDERING

                    );

                    $idOrder = $this->Morders->orders_insert($dataOrder);

                    $this->session->set_userdata('sessionIdOrderSuccess', $idOrder);

                    $arraySesstionDelete = array('sesstionCartClient'); 

                    $configSystem = getConfigByCode(CONFIG_CODE_MAIL_SMTP);
                    $configs = getConfigs();

                    $this->load->library('email');

                    $this->load->library('parser');

                    $this->email->clear();

                    $config['protocol']    = 'smtp';

                    $config['smtp_host']    = $configSystem['value']->mailHost;
                    $config['smtp_port']    = $configSystem['value']->mailPort;
                    $config['smtp_timeout'] = '7';
                    $config['smtp_user']    = $configSystem['value']->mailSMTPUser;
                    $config['smtp_pass']    = $configSystem['value']->mailSMTPPass;

                    $config['charset']    = 'utf-8';

                    $config['newline']    = "\r\n";

                    $config['wordwrap'] = TRUE;

                    $config['mailtype'] = 'html'; // or html

                    $config['validation'] = TRUE; // bool whether to validate email or not      

                    $this->email->initialize($config);

                    $this->email->set_newline("\r\n");

                    $this->email->from($configSystem['value']->mailNoReply, 'Ghế Lười Hạt Xốp Night');

                    $this->email->to($configs['emailConfig']['value']->emailStore);

                    $this->email->subject('Đơn hàng mới');

                    $this->email->message('Hệ thống vừa nhận được đơn hàng mới, đăng nhập quản trị để xem chi tiết !');

                    if ($this->email->send()) {

                        

                    } else {

                        $error = $this->email->print_debugger(array('headers'));

                        //echo json_encode($error);

                    }

                    $this->session->unset_userdata($arraySesstionDelete);

                    redirect(base_url().'dat-hang-thanh-cong','refresh');

                } else {

                    $this->data['errorForm'] = 'Email hoặc số điện thoại không hợp lệ, thử lại';

                }

            } else {

                $this->data['errorForm'] = 'Giỏ hàng không có sản phẩm nào, thử lại';

            }

        }

        $this->data['listProduct'] = $this->get_list_product_in_cart();

        $this->data['view']='index';

        $this->load->view('frontend/layout',$this->data);

    }

    public function booking() {

        $d=getdate();

        $today=$d['year']."/".$d['mon']."/".$d['mday']." ".$d['hours'].":".$d['minutes'].":".$d['seconds'];

        $this->load->helper('string');

        $this->form_validation->set_rules('email', 'Địa chỉ email', 'required');

        $this->form_validation->set_rules('fullname', 'Họ và tên', 'required');

        $this->form_validation->set_rules('phone', 'Số điện thoại', 'required');

        $this->form_validation->set_rules('address', 'Địa chỉ', 'required');

        if ($this->form_validation->run() ==TRUE){

            $product_code = ''; $id = $this->session->userdata('idProductOrder');

            $cart[$id.'|#|'.$product_code] = array(

                'id' => $id, 

                'quantity' => 1,

                'positionCode' => 0,

                'product_code' => $product_code

            );

            $this->session->set_userdata('sesstionCartClient',$cart);

            if ($cart && count($cart) > 0) {

                if($this->validate->check_phone_number($_POST['phone'])) {

                    //$user = $this->Muser->user_check_email_customer($_POST['email']);
                    $user = $this->Muser->user_check_email($_POST['email']);

                    $idUserOrder;

                    if (count($user) > 0) {

                        $idUserOrder = $user[0]['id'];
                        $mydata = array(
                            'fullname' => $_POST['fullname'],
                            'phone' => $_POST['phone'], 
                            'address' => $_POST['address']
                        );
                        $this->Muser->user_update($mydata, $idUserOrder);

                    } else {

                        $mydata= array(

                            'username' => $_POST['fullname'], 

                            'fullname' => $_POST['fullname'], 

                            'email' => $_POST['email'], 

                            'phone' => $_POST['phone'], 

                            'password' => md5('thamlotsan.vn'), 

                            'address' => $_POST['address'],

                            'kind' => KIND_CUSTOMER,

                            'status' => STATUS_ACTIVE

                        );

                        $idUserOrder = $this->Muser->user_insert($mydata);

                    }

                    $orderCode = random_string('alnum', 6);

                    $listProductInCart = $this->get_list_product_in_cart();

                    $dataOrder = array(

                        'orderCode' => strtoupper($orderCode),

                        'idUserOrder' => $idUserOrder,

                        'idProducts' => json_encode($listProductInCart['product']),

                        'totalPrice' => $listProductInCart['totalPrice'],

                        'createdAt'=> $today,

                        'createdBy'=> $idUserOrder,

                        'updatedAt'=> $today,

                        'updatedBy'=> $idUserOrder,

                        'status' => STATUS_ACTIVE,

                        'state' => STATE_ORDER_ORDERING

                    );

                    $idOrder = $this->Morders->orders_insert($dataOrder);

                    $this->session->set_userdata('sessionIdOrderSuccess', $idOrder);

                    $arraySesstionDelete = array('sesstionCartClient'); 

                    $configSystem = getConfigByCode(CONFIG_CODE_MAIL_SMTP);
                    $configs = getConfigs();

                    $this->load->library('email');

                    $this->load->library('parser');

                    $this->email->clear();

                    $config['protocol']    = 'smtp';

                    $config['smtp_host']    = $configSystem['value']->mailHost;
                    $config['smtp_port']    = $configSystem['value']->mailPort;
                    $config['smtp_timeout'] = '7';
                    $config['smtp_user']    = $configSystem['value']->mailSMTPUser;
                    $config['smtp_pass']    = $configSystem['value']->mailSMTPPass;
                    //$config['smtp_pass']    = 'irlbjlbbbjhfaori';

                    $config['charset']    = 'utf-8';

                    $config['newline']    = "\r\n";

                    $config['wordwrap'] = TRUE;

                    $config['mailtype'] = 'html'; // or html

                    $config['validation'] = TRUE; // bool whether to validate email or not      

                    $this->email->initialize($config);

                    $this->email->set_newline("\r\n");

                    $this->email->from($configSystem['value']->mailNoReply, 'Ghế Lười Hạt Xốp Night');

                    $this->email->to($configs['emailConfig']['value']->emailStore);
                      // $this->email->to('thongtinkhachhang.co@gmail.com');

                    $this->email->subject('Đơn hàng mới');

                    $this->email->message('Hệ thống vừa nhận được đơn hàng mới, đăng nhập quản trị để xem chi tiết !');

                    if ($this->email->send()) {

                        

                    } else {

                        $error = $this->email->print_debugger(array('headers'));

                        echo json_encode($error);

                    }

                    $this->session->unset_userdata($arraySesstionDelete);

                    redirect(base_url().'dat-hang-thanh-cong','refresh');

                } else {

                    $this->data['errorForm'] = 'Email hoặc số điện thoại không hợp lệ, thử lại';

                }

            } else {

                $this->data['errorForm'] = 'Giỏ hàng không có sản phẩm nào, thử lại';

            }

        } else {

            echo validation_errors();

        }

    }

    public function get_list_product_in_cart() {
        $listIdProduct = array();
        if($this->session->userdata('sesstionCartClient')) {
            $listIdProduct = $this->session->userdata('sesstionCartClient');
        }
        $listProduct = array();
        $totalPrice = 0;
        if(count($listIdProduct) > 0) {
            foreach ($listIdProduct as $rowProductInCart) {
                $detaiProduct = $this->Mproduct->productDetailJoinImage($rowProductInCart['id']);
                $positionCode = 0;
                if (isset($rowProductInCart['positionCode']) && $rowProductInCart['positionCode'] != '' && $rowProductInCart['positionCode'] != null) {
                    $positionCode = $rowProductInCart['positionCode'];
                }
                $price_product = json_decode($detaiProduct['price'])[$positionCode];
                $sale_of = json_decode($detaiProduct['items_price_sale']);
                if (isset($sale_of) && is_array($sale_of) && count($sale_of) > 0 && $sale_of[$positionCode] != null && $sale_of[$positionCode] != '') {
                    $price_product = $sale_of[$positionCode];
                }
                $detaiProduct['price'] = $price_product;
                $detaiProduct['position_size'] = $rowProductInCart['positionCode'];
                $priceProductQuantity = $price_product * $rowProductInCart['quantity'];
                $totalPrice += $priceProductQuantity;
                array_push(
                    $listProduct, 
                    array(
                        'quantity' => $rowProductInCart['quantity'],
                        'id' => $rowProductInCart['id'],
                        'infoProduct' => $detaiProduct,
                        'priceProductQuantity' => $priceProductQuantity,
                    )
                );
            }
        }
        return array('product' => $listProduct, 'totalPrice' => $totalPrice);
    }

    public function update(){
        $id=$_POST['id'];
        $code=$_POST['code'];
        if($this->session->userdata('sesstionCartClient')){
            $cart=$this->session->userdata('sesstionCartClient');
            $key = $id.'|#|'.$code;
            $check = false;
            if(array_key_exists($key, $cart)){
                $cart[$id.'|#|'.$code]['quantity']=(int)($_POST['sl']);
                $check = true;
            }
        }
        $this->session->set_userdata('sesstionCartClient',$cart);
        echo json_encode(array('code' => 1, 'msg' => 'Update cart success !'));
    }

    public function remove(){
        $id=$_POST['id'];
        $code=$_POST['code'];
        if($this->session->userdata('sesstionCartClient')){
            $cart=$this->session->userdata('sesstionCartClient');
            if($cart[$id.'|#|'.$code]){
                unset($cart[$id.'|#|'.$code]);
            }
        }
        $this->session->set_userdata('sesstionCartClient',$cart);
        echo json_encode( $cart );
    }

    public function booking_success() {
        if($this->session->userdata('sessionIdOrderSuccess')) {
            $infoOrder = $this->Morders->orders_detail($this->session->userdata('sessionIdOrderSuccess'));
            $configSystem = $this->Msetting->setting_detail_id(1);
            $this->load->library('email');
            $this->load->library('parser');
            $this->email->clear();
            $config['protocol']    = 'smtp';
            $config['smtp_host']    = $configSystem['mail_host'];
            $config['smtp_port']    = $configSystem['mail_port'];
            $config['smtp_timeout'] = '7';
            $config['smtp_user']    = $configSystem['smtp_user'];
            $config['smtp_pass']    = $configSystem['smtp_pass'];
            //$config['smtp_user']    = 'thongtinkhachhang.co@gmail.com';
            //$config['smtp_pass']    = 'irlbjlbbbjhfaori';
            $config['charset']    = 'utf-8';
            $config['newline']    = "\r\n";
            $config['wordwrap'] = TRUE;
            $config['mailtype'] = 'html'; // or html
            $config['validation'] = TRUE; // bool whether to validate email or not      
            $this->email->initialize($config);
            $this->email->set_newline("\r\n");
            $this->email->from($configSystem['smtp_user'], 'Ghế Lười Hạt Xốp Night');
            //$this->email->from('thongtinkhachhang.co@gmail.com', 'www.bangoiluoi.com');
            $this->email->to($infoOrder['idUserOrder']['email']);
            $this->email->subject('Đặt hàng thành công');
            $data['infoOrder'] = $infoOrder;
            $message = $this->load->view('frontend/template_email',$data,true);
            $this->email->message($message);
            $this->email->send();
            $this->data['infoOrder'] = $infoOrder;
        } else {
            redirect(base_url().'/gio-hang','refresh');
        }
        $this->data['seo_title']='Đặt hàng thành công';
        $this->data['view']='booking_success';
        $this->load->view('frontend/layout',$this->data);
    }
}