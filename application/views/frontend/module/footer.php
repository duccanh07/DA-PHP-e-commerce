<!-- END PRODUCTS -->
<footer class="dft">
	<div class="container">
		<div class="row">
			<div class="">
				<div class="uft">
					<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
						<div class="lfl" style="padding: 0; padding-top: 30px;">
							<strong class="tt">Về chúng tôi</strong>
								<?php 
				                    if ( isset($configs['footerConfig']['value']->shopDesc) && $configs['footerConfig']['value']->shopDesc != '') :
				                ?>
									<span style="font-size: 13px;"><?php echo $configs['footerConfig']['value']->shopDesc; ?></span>
								<?php 
									endif;
								?>
							<br />
							<br />
							<?php 
				                $value = $configs['logoFooterConfig']['value'];
				                $titleImage = getFirstFromJsonString($value->titleImages);
				                $altImage = getFirstFromJsonString($value->altImages);
				                $image = getFirstFromJsonString($value->images);
				            ?>
				            <a href="<?php echo base_url() ?>" title="<?php echo $titleImage; ?>" alt="<?php echo $altImage; ?>" class="custom-logo-link" rel="home">
				                <img src="<?php echo base_url() ?>upload/<?php echo $image; ?>" title="<?php echo $titleImage; ?>" alt="<?php echo $altImage; ?>">
				            </a>
	            		</div>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
						<div class="lfr" style="padding: 0; padding-top: 30px;"> <strong class="tt">Địa chỉ</strong>
		                	<ul>
			                  	<?php 
				                    if ( isset($configs['contactConfig']['value']->addressShop) && $configs['contactConfig']['value']->addressShop != '') :
			                  	?>
				                      	<li class="pd-5-0 pt-0">
				                        	<span class="fa fa-map-marker"></span>&nbsp;&nbsp;Địa chỉ: <?php echo $configs['contactConfig']['value']->addressShop; ?>
				                      	</li>
			                  	<?php 
				                    endif;
			                  	?>

			                  	<?php 
				                    if ( isset($configs['contactConfig']['value']->emailShop) && $configs['contactConfig']['value']->emailShop != '') :
			                  	?>
				                      	<li class="pd-5-0 pt-0">
				                        	<span class="fa fa-envelope"></span>&nbsp;&nbsp;Email: <?php echo $configs['contactConfig']['value']->emailShop; ?>
				                      	</li>
			                  	<?php 
				                    endif;
			                  	?>

			                  	<?php 
				                    if ( isset($configs['contactConfig']['value']->hotlineShop) && $configs['contactConfig']['value']->hotlineShop != '') :
			                  	?>
				                      	<li class="pd-5-0 pt-0">
				                        	<span class="fa fa-phone"></span>&nbsp;&nbsp;Hotline: <?php echo $configs['contactConfig']['value']->hotlineShop; ?>
				                      	</li>
			                  	<?php 
				                    endif;
			                  	?>
				        					
			                  	<?php 
				                    if ( isset($configs['contactConfig']['value']->phoneShop) && $configs['contactConfig']['value']->phoneShop != '') :
			                  	?>
				                      	<li class="pd-5-0 pt-0">
				                        	<span class="fa fa-mobile"></span>&nbsp;&nbsp;Điện thoại: <?php echo $configs['contactConfig']['value']->phoneShop; ?>
				                      	</li>
			                  	<?php 
				                    endif;
			                  	?>

			                  	<?php 
				                    if ( isset($configs['contactConfig']['value']->timeOpenShop) && $configs['contactConfig']['value']->timeOpenShop != '') :
			                  	?>
				                      	<li class="pd-5-0 pt-0">
				                        	<span class="fa fa-clock-o"></span>&nbsp;&nbsp;<?php echo $configs['contactConfig']['value']->timeOpenShop; ?>
				                      	</li>
			                  	<?php 
				                    endif;
			                  	?>
		      				</ul>
			            </div>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
						<div class="lfc" style="padding: 0; padding-top: 30px;"> 
							<strong class="tt">FACEBOOK</strong>
			                <div class="footer-item-content">
				              <?php 
				                if ( isset($configs['footerConfig']['value']->frameFanpageFacebook) && $configs['footerConfig']['value']->frameFanpageFacebook != '') {
				                  echo $configs['footerConfig']['value']->frameFanpageFacebook;
				                }
				              ?>
		    				</div>
			            </div>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
						<div class="lfc" style="padding: 0; padding-top: 30px;"> 
							<strong class="tt">BẢN ĐỒ</strong>
							<div class="footer-item-content">
				              <?php 
				                if ( isset($configs['footerConfig']['value']->frameGoogleMaps) && $configs['footerConfig']['value']->frameGoogleMaps != '') {
				                  echo $configs['footerConfig']['value']->frameGoogleMaps;
				                }
				              ?>
		    				</div>
			            </div>
					</div>
				</div>
			</div>

		</div>
	</div>
</footer>
<div class="df2 box-height-auto-padding-10 box-width-50-percent">
    <ul>
        <li class="r box-unset-line-height">
        	<?php 
                if ( isset($configs['footerConfig']['value']->businessRegistrationNumber) && $configs['footerConfig']['value']->businessRegistrationNumber != '') {
                  	echo 'Số ĐKKD : '.$configs['footerConfig']['value']->businessRegistrationNumber;
                }
          	?>
          	<?php 
                if ( isset($configs['footerConfig']['value']->issuedBy) && $configs['footerConfig']['value']->issuedBy != '') {
                  	echo '– Cấp bởi: '.$configs['footerConfig']['value']->issuedBy;
                }
          	?>		
        </li>
        <?php 
	        if ( isset($configs['footerConfig']['value']->companyName) && $configs['footerConfig']['value']->companyName != '') :
	  	?>
        	<li class="l box-unset-line-height"><?php echo $configs['footerConfig']['value']->companyName; ?></li>
    	<?php 
    		endif;
    	?>
    </ul>
</div>
<!-- END FOOTER -->