<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class ErrorController extends CI_Controller {
	public function __construct(){
		parent::__construct();
	}

	public function error_404(){
		$this->load->view('backend/components/errors/Error404');
	}

}