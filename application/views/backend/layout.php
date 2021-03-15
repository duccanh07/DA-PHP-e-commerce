<!DOCTYPE html>
<html>
<head>
	<base href="<?php echo base_url(); ?>"></base>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title ?></title>
  <script src="<?php echo base_url() ?>assets/js/jquery-2.2.3.min.js"></script>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/ionicons.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/_all-skins.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/admin.css?v=1.0.4">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/datepicker.css">
  <script src="<?php echo base_url() ?>public/admin/plugins/ckeditor/ckeditor.js"></script>
  <script src="<?php echo base_url() ?>assets/js/moment.js"></script>
  <script src="<?php echo base_url() ?>assets/js/datepicker.js"></script>
  <script src="<?php echo base_url() ?>assets/js/validate.js?v=1.0.4"></script>
  <script src="<?php echo base_url() ?>assets/js/ajax.js?v=1.0.4"></script>
  <style>
    .content-header h1, th, label{
      color: #333;
    }
    label{font-weight: 600 !important;}
    .maudo{color: red}
  </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <!-- Vung Header -->
        	<?php $this->load->view('backend/modules/header'); ?>


        <!-- ./Vung Header -->
        	<?php $this->load->view('backend/modules/menu'); ?>
  		<!-- Content Wrapper. Contains page content -->
  		<?php 
  			if(isset($com, $view))
  			{
  				$this->load->view('backend/components/'.$com.'/'.$view);
  			}

  		?>
      <footer class="main-footer">
       <div class="pull-right hidden-xs"><b>Version</b> 1.0.0</div>
       <p class="text-center"><strong>Copyright &copy; 2019 <a href="https://az9s.com" target="_blank">Az9s.com</a>. All rights reserved.</strong>
      </footer>
	    <?php $this->load->view('backend/modules/Loading'); ?>
    </div><!-- ./wrapper -->
	<!-- jQuery 2.2.3 -->
	<!-- jQuery UI 1.11.4 -->
	<!-- Bootstrap 3.3.6 -->
	<script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
	<!-- AdminLTE App -->
	<script src="<?php echo base_url() ?>assets/js/app.min.js"></script>
  <script src="<?php echo base_url() ?>assets/js/uploadajax.js?v=1.0.4"></script>
  <script src="<?php echo base_url() ?>assets/js/jquery.toaster.js"></script>
<!-- Google Code dành cho Thẻ tiếp thị lại -->
<!--------------------------------------------------
Không thể liên kết thẻ tiếp thị lại với thông tin nhận dạng cá nhân hay đặt thẻ tiếp thị lại trên các trang có liên quan đến danh mục nhạy cảm. Xem thêm thông tin và hướng dẫn về cách thiết lập thẻ trên: http://google.com/ads/remarketingsetup
--------------------------------------------------->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 809110375;
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/809110375/?guid=ON&amp;script=0"/>
</div>
</noscript>

</body>
</html>
