<?php 

    $pathImg=PATH_IMAGES.'default.png';

    $aurl = explode('/', uri_string());

?>

<aside class="main-sidebar">

    <section class="sidebar">

        <div class="user-panel">

            <div class="pull-left image">

                <img src="<?php echo $pathImg; ?>" class="img-circle" alt="User Image">

            </div>

            <div class="pull-left info">

                <p><?php echo $dataUser['fullname']; ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Trực tuyến</a>

            </div>

        </div>

        <ul class="sidebar-menu">

            <li class="header txt-tf-up">Quản lý cửa hàng</li>

            <li class="<?php if(count($aurl)>1) if($aurl[1]=='orders') echo 'active';?>">

                <a href="<?php echo base_url() ?>admin/orders.html">

                    <i class="fa fa-shopping-cart"></i> Đơn hàng

                </a>

            </li>

            <li class="<?php if(count($aurl)>1) if($aurl[1]=='category' || $aurl[1] == 'category-child') echo 'active';?>">

                <a href="<?php echo base_url() ?>admin/category">

                    <i class="fa fa-indent"></i> Danh mục

                </a>

            </li>

            <li class="<?php if(count($aurl)>1) if($aurl[1]=='product') echo 'active';?>">

                <a href="<?php echo base_url() ?>admin/product">

                    <i class="fa fa-cubes"></i> Sản phẩm

                </a>

            </li>

            <li class="<?php if(count($aurl)>1) if($aurl[1]=='content') echo 'active';?>">

                <a href="<?php echo base_url() ?>admin/content">

                    <i class="fa fa-newspaper-o"></i> Bài viết

                </a>

            </li>

            <li class="<?php if(count($aurl)>1) if($aurl[1]=='slider') echo 'active';?>">

                <a href="<?php echo base_url() ?>admin/slider.html">

                    <i class="fa fa-picture-o"></i> Slider

                </a>

            </li>

            <li class="<?php if(count($aurl)>1) if($aurl[1]=='agency') echo 'active';?>">

                <a href="<?php echo base_url() ?>admin/agency.html">

                    <i class="fa fa-users"></i> Đối tác

                </a>

            </li>

            <li class="<?php if(count($aurl)>1) if($aurl[1]=='customer-feedback') echo 'active';?>">

                <a href="<?php echo base_url() ?>admin/customer-feedback.html">

                    <i class="fa fa-comments"></i> Ý kiến khách hàng

                </a>

            </li>

            <li class="header txt-tf-up">Quản lý tài khoản</li>

            <li class="<?php if(count($aurl)>1) if($aurl[1]=='user') echo 'active';?>">

                <a href="<?php echo base_url() ?>admin/user">

                    <i class="fa fa-user-secret"></i> Tài khoản quản trị

                </a>

            </li>

            <li class="<?php if(count($aurl)>1) if($aurl[1]=='customer') echo 'active';?>">

                <a href="<?php echo base_url() ?>admin/customer">

                    <i class="fa fa-users"></i> Tài khoản khách hàng

                </a>

            </li>

            <li class="header txt-tf-up">Cấu hình</li>

            <!-- <li class="<?php if(count($aurl)>1) if($aurl[1]=='setting') echo 'active';?>">

                <a href="<?php echo base_url() ?>admin/setting.html">

                    <i class="fa fa-cogs"></i> Website

                </a>

            </li> -->
            <li class="<?php if(count($aurl)>1) if($aurl[1]=='configs' || $aurl[1]=='config') echo 'active';?>">
                <a href="<?php echo base_url() ?>admin/configs">
                    <i class="fa fa-cog"></i> Cấu hình hệ thống
                </a>
            </li>

            <li class="<?php if(count($aurl)>1) if($aurl[1]=='policies') echo 'active';?>">

                <a href="<?php echo base_url() ?>admin/policies.html">

                    <i class="fa fa-cog"></i> Giao diện

                </a>

            </li>

            <li><a href="admin/user/logout.html"><i class="fa fa-sign-out text-red"></i> <span>Thoát</span></a></li>

        </ul>

        

    </section>

    <!-- /.sidebar -->

</aside>