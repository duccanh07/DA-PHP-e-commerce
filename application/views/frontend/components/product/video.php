<div class="product-video-detail">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
				<div class="product-video-detail-left">
					<?php 
						if ($detailProduct['urlVideo'] != '') :
					?>
							<iframe width="100%" src="<?php echo $detailProduct['urlVideo'] ?>" frameborder="0" class="video"></iframe>
					<?php 
						endif;
					?>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 product-video-detail-right">
				<div class="lv1">
					<h1><?php echo $detailProduct['title'] ?></h1>
					<div>
		                <?php echo $detailProduct['short_description'] ?>
		            </div>
		            <div class="m row"> 
		            	<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                			<a href="javascript:void(0)" class="button-submit button-dh" title="Gọi tư vấn: <?php echo $configs['contactConfig']['value']->hotlineShop; ?>" alt="Gọi tư vấn: <?php echo $configs['contactConfig']['value']->hotlineShop; ?>">Gọi tư vấn: <?php echo $configs['contactConfig']['value']->hotlineShop; ?></a>
            			</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 detail-product-vd">
				<section class="box_doitac box-detail-product" style="margin-bottom: 50px;">
					<div class="">
						<div class="modcontent">
							<div class="header-title" style="position:relative">
								<h2 class="modtitle"><span>Thông tin công trình</span></h2>
								<!--<a href="/" class="pull-right moredoitac">Xem thêm</a>-->
								<div class="clearfix"></div>
							</div>
							<div class="content-video" style="padding: 10px">
								<?php echo $detailProduct['description'] ?>
							</div>
						</div>
					</div>
				</section>
				<div class="products-video-ref">
					<div class="container-2">
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="header-products-video umt box-xs-no-margin" style="width: 100%">
									<h3 class="l">Video liên quan</h3>
								</div>
								<div class="list-products-video-ref vdv box-margin-minus box-sm-plus-pixel box-md-plus-pixel">
									<?php for($i = 0; $i < count($listProductsRef); $i++) : ?>
										<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
											<div class="row-product-video-ref c">
												<a class="d" href="<?php echo base_url() ?>video/<?php echo $listProductsRef[$i]['alias'] ?>" alt="<?php echo $listProductsRef[$i]['alt_image'] ?>" title="<?php echo $listProductsRef[$i]['title_image'] ?>"></a>
												<span class="z"></span>
												<a href="<?php echo base_url() ?>video/<?php echo $listProductsRef[$i]['alias'] ?>" alt="<?php echo $listProductsRef[$i]['alt_image'] ?>" title="<?php echo $listProductsRef[$i]['title_image'] ?>">
													<img src="<?php echo base_url() ?>assets/images/d5.png" alt="Icon play" title="Play" class="img-play">
												</a>
												<img width="100%" src="<?php echo base_url() ?>upload/contents/<?php echo $listProductsRef[$i]['images'] ?>" class="attachment-custom600x400 size-custom600x400 wp-post-image" alt="<?php echo $listProductsRef[$i]['alt_image'] ?>" title="<?php echo $listProductsRef[$i]['title_image'] ?>">		
												<strong><a href="<?php echo base_url() ?>video/<?php echo $listProductsRef[$i]['alias'] ?>" alt="<?php echo $listProductsRef[$i]['alt_image'] ?>" title="<?php echo $listProductsRef[$i]['title_image'] ?>"><?php echo $listProductsRef[$i]['title'] ?></a></strong>
											</div>
										</div>
									<?php endfor; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 detail-product-vd">
				<section class="box_doitac box-detail-product" style="margin-bottom: 50px;">
					<div class="">
						<div class="modcontent box-product-comment">
							<div class="header-title" style="position:relative">
								<h2 class="modtitle"><span>Bình luận</span></h2>
								<!--<a href="/" class="pull-right moredoitac">Xem thêm</a>-->
								<div class="clearfix"></div>
							</div>
							<div class="comments-facebook">
								<div class="fb-comments" data-width="100%"></div>
							</div>
						</div>
					</div>
				</section>
			</div>
		</div>
	</div>
</div>

