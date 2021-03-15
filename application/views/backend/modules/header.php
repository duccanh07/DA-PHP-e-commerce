<?php 
  $pathImg=PATH_IMAGES.'default.png';
?>
<header class="main-header">
    <a href="<?php echo base_url()?>admin" class="logo">
        <span class="logo-lg"><strong>AZ9sdotCom</strong></span>
    </a>
    <nav class="navbar navbar-static-top">	
      <!-- Sidebar toggle button-->
      <!-- <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a> -->

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo $pathImg; ?>" class="user-image" alt="User Image">
              <span class="hidden-xs">
                    <?php 
                        if($dataUser){
                            if($dataUser['fullname']){
                                echo $dataUser['fullname'];
                            }else{
                                echo 'Khách';
                            }
                        }else{
                            echo 'Khách';
                        }
                    ?>
              </span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo $pathImg; ?>" class="img-circle" alt="User Image">
                <p><?php echo $dataUser['fullname'].' - '.$dataUser['phone'];?></p>
                
              </li>
              <!-- Menu Body -->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo base_url() ?>admin/user/update/<?php echo $dataUser['id'] ?>" class="btn btn-default btn-flat">Thông tin</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo base_url() ?>admin/user/logout.html" class="btn btn-default btn-flat">Đăng xuất</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
        </ul>
      </div>
    </nav>
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

</header>