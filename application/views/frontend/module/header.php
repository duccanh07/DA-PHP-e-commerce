<!-- HEADER -->
<div class="header hidden-xs hidden-sm">
	<div class="container">
		<div class="row">
			<div class="col-md-5 col-lg-5 header-right pull-left" style="background: unset;">
				<?php 
				    $value = $configs['logoConfig']['value'];
				    $titleImage = getFirstFromJsonString($value->titleImages);
				    $altImage = getFirstFromJsonString($value->altImages);
				    $image = getFirstFromJsonString($value->images);
				?>
				<a href="<?php echo base_url() ?>" title="<?php echo $titleImage; ?>" alt="<?php echo $altImage; ?>">
				    <img src="<?php echo base_url() ?>upload/<?php echo $image; ?>" title="<?php echo $titleImage; ?>" alt="<?php echo $altImage; ?>">
				</a>
			</div>
			<div class="col-md-2 col-lg-2"></div>
			<div class="col-md-4 col-lg-4 header-search form-search" style="margin-top: 38px;">
				<form action="<?php echo base_url() ?>search">
                    <input type="text" name="keywords" style="font-size: 13px" placeholder="Nhập từ khóa để tìm kiếm" class="pull-left primary-border w80">
                    <button type="submit" class="pull-left primary-bg primary-border primary-color pointer fontWeight600 w10 fa fa-search" style="width: 10%;">
                        <!-- <span class="fa fa-search"></span> -->
                    </button>
                </form>
			</div>
			<!-- <div class="col-md-1 col-lg-1"></div> -->
			<!-- <div class="col-md-1 col-lg-1 header-left">
				Đặt hàng nhanh
				<strong><?php echo $dataSetting['phone_support'] ?></strong>
			</div> -->
			<div class="col-md-1 col-lg-1 box-shopping-cart pull-right">
                <a href="<?php echo base_url() ?>gio-hang" title="Giỏ hàng" alt="Giỏ hàng">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    <span class="badge total-product-cart">
                    	<?php  
                            if($this->session->userdata('sesstionCartClient')){
                                echo count($this->session->userdata('sesstionCartClient'));
                            }else{
                                echo 0;
                            }
                        ?>
                    </span>
                </a>
			</div>
		</div>
	</div>
</div>
<!-- END HEADER -->