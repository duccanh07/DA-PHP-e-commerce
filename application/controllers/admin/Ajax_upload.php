<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	class Ajax_upload extends CI_Controller {
	    function __construct() {
	        parent::__construct();
	        $this->load->model('Majaxupload','',TRUE);
	        $this->load->model('Mproduct','',TRUE);
	    }
	    function upload_files() {
	    	$this->load->helper('string');
	    	$d=getdate();
			$userCurrent=$this->session->userdata(SESSION_SYSTEM_NAME);
			$today=$d['year']."/".$d['mon']."/".$d['mday']." ".$d['hours'].":".$d['minutes'].":".$d['seconds'];
			$fileExit = false;
	        if (isset($_FILES['files']) && !empty($_FILES['files'])) {
	            $lengthFile = count($_FILES["files"]['name']);
	            $location  = 'upload/';
	            $indexedOnly = array();
	            $listImagesUpload = array();
	            if($this->session->userdata(SESSION_SAVE_LIST_IMAGES)){
					$listImagesUpload = $this->session->userdata(SESSION_SAVE_LIST_IMAGES);
				}
	            $mydata = array(
	            	'name' => '',
	            	'tmp_name' => '',
	            	'type' => '',
	            	'size' => '',
	            	'state' => 0,
	            	'status' => STATUS_ACTIVE,
	            	'createdAt'=>$today,
					'createdBy'=>$userCurrent['id'],
					'updatedAt'=>$today,
					'updatedBy'=>$userCurrent['id'],
            	);
	            for ($i = 0; $i < $lengthFile; $i++) {
	                if($_FILES["files"]["error"][$i] <= 0) {
	                	$newName = random_string('alnum',8);
                    	$fileExtention = explode('/', $_FILES["files"]["type"][$i])[1];
                    	$_FILES['files']['name'][$i] = $newName . '.' . $fileExtention;
                    	$file = $_FILES['files']['name'][$i];
	                    if(!file_exists($location . $_FILES["files"]["name"][$i])){
	                        if(move_uploaded_file($_FILES["files"]["tmp_name"][$i], $location.$file)){
	                        	$ImagePath = $location.$file;
						        $imagedata = file_get_contents($ImagePath);
						        $ret       = base64_encode($imagedata);
						        /*insert to db*/
						       	$mydata['name'] = $_FILES["files"]["name"][$i];
						       	$mydata['tmp_name'] = $_FILES["files"]["tmp_name"][$i];
						       	$mydata['type'] = $_FILES["files"]["type"][$i];
						       	$mydata['size'] = $_FILES["files"]["size"][$i];
						       	$idImages = $this->Majaxupload->images_insert($mydata);
						       	$arrResult = array(
						       		'id' => $idImages,
						       		'image' => $_FILES["files"]["name"][$i]
					       		);
					        	/* Return data to view */
								array_push($indexedOnly, $arrResult);
								/* Save to session, inser to product */
								array_push($listImagesUpload, $arrResult);
					        	$this->session->set_userdata(SESSION_SAVE_LIST_IMAGES, /*array()*/ $listImagesUpload);
	                    	}
	                    }else{
							
	                    }
	                }
	            }
	           	echo json_encode($indexedOnly);
	        }
	    }

	    function upload_files_item_color() {
	    	$this->load->helper('string');
	    	$d=getdate();
			$userCurrent=$this->session->userdata(SESSION_SYSTEM_NAME);
			$today=$d['year']."/".$d['mon']."/".$d['mday']." ".$d['hours'].":".$d['minutes'].":".$d['seconds'];
			$fileExit = false;
	        if (isset($_FILES['files']) && !empty($_FILES['files'])) {
	            $lengthFile = count($_FILES["files"]['name']);
	            $location  = 'upload/';
	            $indexedOnly = array();
	            $listImagesUpload = array();
	            if($this->session->userdata(SESSION_LIST_IMAGES_ITEM_COLOR)){
					$listImagesUpload = $this->session->userdata(SESSION_LIST_IMAGES_ITEM_COLOR);
				}
	            $mydata = array(
	            	'name' => '',
	            	'tmp_name' => '',
	            	'type' => '',
	            	'size' => '',
	            	'state' => 0,
	            	'status' => STATUS_ACTIVE,
	            	'createdAt'=>$today,
					'createdBy'=>$userCurrent['id'],
					'updatedAt'=>$today,
					'updatedBy'=>$userCurrent['id'],
            	);
	            for ($i = 0; $i < $lengthFile; $i++) {
	                if($_FILES["files"]["error"][$i] <= 0) {
	                	$newName = random_string('alnum',8);
                    	$fileExtention = explode('/', $_FILES["files"]["type"][$i])[1];
                    	$_FILES['files']['name'][$i] = $newName . '.' . $fileExtention;
                    	$file = $_FILES['files']['name'][$i];
	                    if(!file_exists($location . $_FILES["files"]["name"][$i])){
	                        if(move_uploaded_file($_FILES["files"]["tmp_name"][$i], $location.$file)){
	                        	$ImagePath = $location.$file;
						        $imagedata = file_get_contents($ImagePath);
						        $ret       = base64_encode($imagedata);
						        /*insert to db*/
						       	$mydata['name'] = $_FILES["files"]["name"][$i];
						       	$mydata['tmp_name'] = $_FILES["files"]["tmp_name"][$i];
						       	$mydata['type'] = $_FILES["files"]["type"][$i];
						       	$mydata['size'] = $_FILES["files"]["size"][$i];
						       	$idImages = $this->Majaxupload->images_insert($mydata);
						       	$arrResult = array(
						       		'id' => $idImages,
						       		'image' => $_FILES["files"]["name"][$i]
					       		);
					        	/* Return data to view */
								array_push($indexedOnly, $arrResult);
								/* Save to session, inser to product */
								array_push($listImagesUpload, $arrResult);
					        	$this->session->set_userdata(SESSION_LIST_IMAGES_ITEM_COLOR, /*array()*/ $listImagesUpload);
	                    	}
	                    }else{
							
	                    }
	                }
	            }
	           	echo json_encode($indexedOnly);
	        }
	    }

	    function delete_file(){
	    	$d=getdate();
			$userCurrent=$this->session->userdata(SESSION_SYSTEM_NAME);
			$today=$d['year']."/".$d['mon']."/".$d['mday']." ".$d['hours'].":".$d['minutes'].":".$d['seconds'];
	    	if(isset($_POST['img']) && !empty($_POST['img'])) {
	    		$mydata = array(
	            	'status' => STATUS_DELETE,
					'updatedAt'=>$today,
					'updatedBy'=>$userCurrent['id'],
            	);
	    		$this->Majaxupload->images_update_by_name($mydata, $_POST['img']);
	    		$listImagesUpload = $this->session->userdata(SESSION_SAVE_LIST_IMAGES);
	    		$arr = array();
	    		for($i = 0; $i < count($listImagesUpload); $i++){
					if($listImagesUpload[$i]['image'] != $_POST['img']){
						array_push($arr, $listImagesUpload[$i]);
					}
	    		}
	    		$this->session->set_userdata(SESSION_SAVE_LIST_IMAGES,$arr);
	    		unlink('upload/'.$_POST['img']);
		        echo json_encode($arr);
		    }
	    }

	    function delete_file_item_color(){
	    	$d=getdate();
			$userCurrent=$this->session->userdata(SESSION_SYSTEM_NAME);
			$today=$d['year']."/".$d['mon']."/".$d['mday']." ".$d['hours'].":".$d['minutes'].":".$d['seconds'];
	    	if(isset($_POST['img']) && !empty($_POST['img'])) {
	    		$mydata = array(
	            	'status' => STATUS_DELETE,
					'updatedAt'=>$today,
					'updatedBy'=>$userCurrent['id'],
            	);
	    		$this->Majaxupload->images_update_by_name($mydata, $_POST['img']);
	    		$listImagesUpload = $this->session->userdata(SESSION_LIST_IMAGES_ITEM_COLOR);
	    		$arr = array();
	    		for($i = 0; $i < count($listImagesUpload); $i++){
					if($listImagesUpload[$i]['image'] != $_POST['img']){
						array_push($arr, $listImagesUpload[$i]);
					}
	    		}
	    		$this->session->set_userdata(SESSION_LIST_IMAGES_ITEM_COLOR,$arr);
	    		unlink('upload/'.$_POST['img']);
		        echo json_encode($arr);
		    }
	    }

	    function delete_image_product(){
	    	$d=getdate();
			$userCurrent=$this->session->userdata(SESSION_SYSTEM_NAME);
			$today=$d['year']."/".$d['mon']."/".$d['mday']." ".$d['hours'].":".$d['minutes'].":".$d['seconds'];
	    	if(isset($_POST['img']) && !empty($_POST['img'])) {
	    		if(isset($_POST['idProduct']) && !empty($_POST['idProduct'])) {
	    			$nameImage = $_POST['img'];
		    		$mydata = array(
		            	'status' => STATUS_DELETE,
						'updatedAt'=>$today,
						'updatedBy'=>$userCurrent['id'],
	            	);
		    		$this->Majaxupload->images_update_by_name($mydata, $nameImage);
		    		$idUpdated = $this->Majaxupload->image_get_field_ajax($nameImage, 'id');
		    		$productDetail = $this->Mproduct->product_detail_no_join($_POST['idProduct']);
		    		$listImages = json_decode($productDetail['images']);
		    		$title_image = json_decode($productDetail['title_image']);
		    		$alt_image = json_decode($productDetail['alt_image']);
		    		for( $i = 0; $i < count($listImages); $i ++) {
		    			if ($listImages[$i] == $idUpdated) {
		    				array_splice($listImages, $i, 1);
		    				array_splice($title_image, $i, 1);
		    				array_splice($alt_image, $i, 1);
		    			}
		    		}
		    		$this->Mproduct->product_update(
		    			array(
		    				'images' => json_encode($listImages),
		    				'title_image' => json_encode($title_image),
		    				'alt_image' => json_encode($alt_image),
		    				'updatedAt' => $today,
							'updatedBy' => $userCurrent['id'],
		    			),
		    			$_POST['idProduct']
		    		);
			        echo json_encode(
			        	array(
			        		'code' => 1
			        	)
			        );
		        }
		    } 
	    }

}
