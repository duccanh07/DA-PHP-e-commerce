<?php $this->load->view('frontend/module/slider'); ?>
<?php $this->load->view('frontend/module/avt'); ?>
<div class="section-about" style="border-top: solid 3px #ededed;">
	<div class="main-container-top">
	    <div class="container">
	        <div class="about-main">
	            <div class="row">
	                <div class="col-md-6 col-sm-6 col-xs-12" style="padding-top: 3px;">
	                    <h2 class="news_hot_title wow fadeInUp"><a href="/gioi-thieu">Về chúng tôi</a></h2>
	                    <div class="content-desc wow fadeInUp" data-wow-delay="0.5s">
	                        <p class="split-string">
	                        	<?php echo $detailIntroduction['short_description'] ?>
	                        </p>
	                    </div>
	                    <a href="<?php echo base_url() ?>bai-viet/gioi-thieu" class="tz-view-more pull-right wow fadeInUp" data-wow-delay="0.8s">
	                        <span>XEM CHI TIẾT</span>
	                    </a>
	                </div>
	                <div class="col-md-6 col-sm-6 col-xs-12">
	                	<?php 
	                		$img_intro = json_decode($detailIntroduction['images'])[0];
	                		$title_image_intro = json_decode($detailIntroduction['title_image'])[0];
	                		$alt_intro = json_decode($detailIntroduction['alt_image'])[0];
	                	?>
	                    <div class="about_video_main">
                            <img alt="<?php echo $alt_intro; ?>" title="<?php echo $title_image_intro; ?>" src="<?php echo base_url() ?>upload/contents/<?php echo $img_intro; ?>" class="img-responsive">
	                    </div>  
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
</div>
<?php 
	$listCategoriesVideo = $this->Mcategory->category_all_client(DEFAULT_PARENT_ID, TYPE_CATEGORY_VIDEO_CONG_TRINH);
	for ($i = 0; $i < sizeof($listCategoriesVideo); $i++) :
		$countListPostVideo = $this->Mcontent->content_count_video($listCategoriesVideo[$i]['id']);
		if ($countListPostVideo > 0) :
?>
			<div class="dvd">
				<ul>
					<li class="h-2" style="width: 100%; min-height: 1px; overflow: hidden; position: relative;">
						<div class="h">
							<?php echo $listCategoriesVideo[$i]['name']; ?>
						</div>
						<?php if($countListPostVideo > 5) : ?>
							<a href="<?php echo base_url() ?>videos" class="pull-right" style="position: absolute; top: 8px; right: 0" title="Xem tất cả" alt="Xem tất cả">
								Xem tất cả
								<i class="fa fa-chevron-circle-right pull-right" aria-hidden="true" style="margin-top: 1px; color: #fbc908; font-size: 18px;"></i>
							</a>
						<?php endif; ?>
					</li>
					<li class="b"></li>
					<?php 
						$listProductsVideo = $this->Mcontent->list_contents_video($listCategoriesVideo[$i]['id']);
						for($i = 0; $i < count($listProductsVideo); $i++) {
				            $listProductsVideo[$i]['images'] = json_decode($listProductsVideo[$i]['images'])[0];
				            $listProductsVideo[$i]['title_image'] = json_decode($listProductsVideo[$i]['title_image'])[0];
				            $listProductsVideo[$i]['alt_image'] = json_decode($listProductsVideo[$i]['alt_image'])[0];
				        }

					?>
			        <?php for($j = 0; $j < count($listProductsVideo); $j++): ?>
			        	<li class="
			        		<?php if($j == 0) {
			        			echo 'list-products-video c l0'; 
			        		} else {
			        			echo 'list-products-video r l'.$j;
			        		} ?>

			        		<?php if ($j == 0 || $j % 2 == 0) {
			        			echo ' mr1p';
			        		} else {
								echo ' ml1p';
			        		}?>
			    		"> 
			                <a class="d" href="<?php echo base_url() ?>video/<?php echo $listProductsVideo[$j]['alias'] ?>" title="Xem video" alt="Xem video">
			                	<em>Xem video</em>
			                </a>
			                <span class="f"></span>
			                <?php if ($j == 0) : ?>
			                	<span class="e"></span>
			            	<?php endif; ?>
			                <span class="z"></span>
			                <img src="<?php echo base_url() ?>upload/contents/<?php echo $listProductsVideo[$j]['images'] ?>" alt="<?php echo $listProductsVideo[$j]['alt_image'] ?>" title="<?php echo $listProductsVideo[$j]['title_image'] ?>">
			                <strong><a href="<?php echo base_url() ?>video/<?php echo $listProductsVideo[$j]['alias'] ?>" alt="<?php echo $listProductsVideo[$j]['title'] ?>" title="<?php echo $listProductsVideo[$j]['title'] ?>"><?php echo $listProductsVideo[$j]['title'] ?></a></strong>
			    		</li>
			    	<?php endfor; ?>
				</ul>
			</div>
<?php 
		endif;
	endfor;
?>

<div class="awe-section">
        <div class="section section-service">
          	<div class="container">
            	<div class="row">
              	<div class="section-title text-center w-100 pt-5 relative">
                	<h2 class="d-inline-block">
                  		<a href="">Quy trình đặt hàng</a>
                  		<hr>
                	</h2>
              	</div>
              	<div class="section-content w-100">
              		<img src="<?php echo base_url() ?>assets/images/qtdh.png" alt="Quy trình đặt hàng" title="Quy trình đặt hàng" style="width: 100%;">
      			</div>
  			</div>
		</div>
	</div>
</div>
<!-- CTTB -->

<?php for($i = 0; $i < count($listNews); $i++): 
	if(count($listNews[$i]['listPosts']) > 0) :
?>
	<div class="dkm">
		<ul>
			<li class="hh">
		        <a href="<?php echo base_url() ?>danh-muc-bai-viet/<?php echo $listNews[$i]['alias'] ?>" title="Xem tất cả" alt="Xem tất cả">Xem tất cả</a>
		        <h2><?php echo $listNews[$i]['name'] ?></h2>
		    </li>
		    <?php for($j = 0; $j < count($listNews[$i]['listPosts']); $j++) : ?>
		    	<li class="cc <?php echo 'i1'.$j; ?> post <?php if ($i == 0 || $i % 2 == 0) {
					echo 'mr1p';
				} else {
					echo 'ml1p';
				}?>">
		            <a href="<?php echo base_url() ?>bai-viet/<?php echo $listNews[$i]['listPosts'][$j]['alias'] ?>" title="<?php echo $listNews[$i]['listPosts'][$j]['title'] ?>" alt="<?php echo $listNews[$i]['listPosts'][$j]['title'] ?>">
						<img width="600" height="400" src="<?php echo base_url() ?>upload/contents/<?php echo $listNews[$i]['listPosts'][$j]['images'] ?>" class="attachment-custom600x400 size-custom600x400 wp-post-image" title="<?php echo $listNews[$i]['listPosts'][$j]['title_image'] ?>" alt="<?php echo $listNews[$i]['listPosts'][$j]['alt_image'] ?>" >                 
					</a>
		            <strong>
		                <a href="<?php echo base_url() ?>bai-viet/<?php echo $listNews[$i]['listPosts'][$j]['alias'] ?>" title="<?php echo $listNews[$i]['listPosts'][$j]['title'] ?>" alt="<?php echo $listNews[$i]['listPosts'][$j]['title'] ?>"><?php echo $listNews[$i]['listPosts'][$j]['title'] ?></a>
		            </strong>
		        </li>
			<?php endfor; ?>
	        <li class="cl"></li>
		</ul>
	</div>
	<?php endif; ?>
<?php endfor; ?>

<!-- END CTTB -->
<!-- PRODUCTS -->
<div class="products">
	<?php for($i = 0; $i < count($listCategories); $i++) :
		if ($listCategories[$i]['parent_id'] == DEFAULT_PARENT_ID && is_array($listCategories[$i]['childs'])) :
			for($j = 0; $j < count($listCategories[$i]['childs']); $j++) :
				$arrayIdOfCategories = array();
				array_push($arrayIdOfCategories, $listCategories[$i]['childs'][$j]['id']);
				for($t = 0; $t < count($listCategories[$i]['childs'][$j]['childs']); $t++) {
					array_push($arrayIdOfCategories, $listCategories[$i]['childs'][$j]['childs'][$t]['id']);
				}
				$listProductsByCategory=$this->Mproduct->productByArrayCatId($arrayIdOfCategories, LIMIT_PRODUCT_SHOW_HOME, '');
				$countProductByArrayIdCategory = $this->Mproduct->productCountByCategory($arrayIdOfCategories);

				for($ii = 0; $ii < count($listProductsByCategory); $ii++) {
					$listProductsByCategory[$ii]['images'] = json_decode($listProductsByCategory[$ii]['images']);
					$listProductsByCategory[$ii]['title_image'] = json_decode($listProductsByCategory[$ii]['title_image'])[0];
					$listProductsByCategory[$ii]['alt_image'] = json_decode($listProductsByCategory[$ii]['alt_image'])[0];
				}
	?>
		<?php if($countProductByArrayIdCategory > 0) : ?>
			<ul class="umt">
		        <li class="r dms">
		            <ul id="menu-tham-hoa-van" class="menuproduct">
		            	<?php for($k = 0; $k < count($listCategories[$i]['childs'][$j]['childs']); $k++):?>
		            		<li id="menu-item-809" class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-809">
			            		<a 
			            			href="<?php echo base_url() ?>danh-muc/<?php echo $listCategories[$i]['childs'][$j]['childs'][$k]['alias'] ?>" 
			            			title="<?php echo $listCategories[$i]['childs'][$j]['childs'][$k]['name'] ?>" 
			            			alt="<?php echo $listCategories[$i]['childs'][$j]['childs'][$k]['name'] ?>"
		            			>
		            				<?php echo $listCategories[$i]['childs'][$j]['childs'][$k]['name'] ?>	
	            				</a>
			            	</li>
	            		<?php endfor; ?>
					</ul>        
				</li>
		        <li class="l">
		        	<a 
		        		href="<?php echo base_url() ?>danh-muc/<?php echo $listCategories[$i]['childs'][$j]['alias'] ?>" 
		        		alt="<?php echo $listCategories[$i]['childs'][$j]['name'] ?>" 
		        		title="<?php echo $listCategories[$i]['childs'][$j]['name'] ?>"
		        	>
		        		<?php echo $listCategories[$i]['childs'][$j]['name'] ?>
		        	</a>
		        </li>
		    </ul>
		    <ul class="pul a">
				<?php for($t = 0; $t < count($listProductsByCategory); $t++) : ?>
					<li class="c i10">
				        <a 
				        	href="<?php echo base_url() ?>san-pham/<?php echo $listProductsByCategory[$t]['alias'] ?>" 
				        	title="<?php echo $listProductsByCategory[$t]['title_image'] ?>" 
				        	alt="<?php echo $listProductsByCategory[$t]['alt_image'] ?>" 
			        	>
			                <img 
			                	width="100%" 
			                	src="<?php echo base_url() ?>upload/products/<?php echo $listProductsByCategory[$t]['images'][0] ?>" 
			                	class="attachment-custom600x400 size-custom600x400 wp-post-image" 
			                	alt="<?php echo $listProductsByCategory[$t]['alt_image']?>" 
			                	title="<?php echo $listProductsByCategory[$t]['title_image']?>" 
			                >   
			            </a>
				        <strong>
				        	<a 
				        		href="<?php echo base_url() ?>san-pham/<?php echo $listProductsByCategory[$t]['alias'] ?>" 
				        		title="<?php echo $listProductsByCategory[$t]['title_image'] ?>" 
				        		alt="<?php echo $listProductsByCategory[$t]['alt_image'] ?>" 
				        	>
				        		<?php echo $listProductsByCategory[$t]['name'] ?>
			        		</a>
			        	</strong>
			        	<?php
							$item_prices = json_decode($listProductsByCategory[$t]['item_prices']);
							$items_price_sale = json_decode($listProductsByCategory[$t]['items_price_sale']);
						?>
			        	<p>
			        		<span>
			                    Giá: 
			                    <b>
			                    	<?php 
			                    		if(count($item_prices) > 0 && isset($item_prices[0]) && $item_prices[0] != null) :
			                    			if(count($items_price_sale) > 0 && isset($items_price_sale[0]) && $items_price_sale[0] != null) :
			                    	?>	
												<ins>
								        			<span class="woocommerce-Price-amount amount"><?php echo number_format($items_price_sale[0]).'đ'; ?>
								        				<span class="woocommerce-Price-currencySymbol"></span>
								        			</span>
								        		</ins><br />
								        		<del style="display: inline-block; color: #333; font-weight: 500">
							                    	<span class="woocommerce-Price-amount amount" style="color: #333;"><?php echo number_format($item_prices[0]).'đ' ?>
							                    		<span class="woocommerce-Price-currencySymbol"></span>
							                    	</span>
								        		</del> 
							        		<?php else: ?>
							        			<ins>
								        			<span class="woocommerce-Price-amount amount"><?php echo number_format($item_prices[0]).'đ'; ?>
								        				<span class="woocommerce-Price-currencySymbol"></span>
								        			</span>
								        		</ins> <br /> 
								        		<del style="display: inline-block; color: #333; font-weight: 500; opacity: 0">
							                    	<span class="woocommerce-Price-amount amount">0
							                    		<span class="woocommerce-Price-currencySymbol"></span>
							                    	</span>
								        		</del> 
						        			<?php endif; ?>
			                    	<?php else:?>
			                    		<ins>
						        			<span class="woocommerce-Price-amount amount">Liên hệ
						        				<span class="woocommerce-Price-currencySymbol"></span>
						        			</span>
						        		</ins> <br />
			                    		<del style="display: inline-block; color: #333; font-weight: 500; opacity: 0">
					                    	<span class="woocommerce-Price-amount amount">0
					                    		<span class="woocommerce-Price-currencySymbol"></span>
					                    	</span>
						        		</del> 	
					        		<?php endif; ?>
					        	</b>
					        </span>
			        	</p>
			        	<?php 
                    		if(count($item_prices) > 0 && isset($item_prices[0]) && $item_prices[0] != null) :
                    	?>
						        <button class="button-add-cart-modal button-add-cart-to-modal" data-url="<?php echo base_url() ?>" data-id="<?php echo $listProductsByCategory[$t]['id'] ?>">
						        	Đặt hàng
						        </button>
				        <?php else: ?>
				        		<button class="button-add-cart-modal" disabled>
						        	Liên hệ
						        </button>
			        	<?php endif; ?>
				    </li>
				<?php endfor; ?>
			    <li class="cl"></li>
			</ul>
		<?php endif; ?>
		<?php endfor; ?>
		<?php endif; ?>
	<?php endfor; ?>
</div>
<!-- END PRODUCTS -->
<section class="box_doitac" style="margin-bottom: 50px;">
	<div class="container">
		<div class="row modcontent">
			<div class="header-title" style="position:relative">
				<h2 class="modtitle"><span>Ý kiến khách hàng</span></h2>
				<!--<a href="/" class="pull-right moredoitac">Xem thêm</a>-->
				<div class="clearfix"></div>
			</div>
			<section id="ykkh">
				<div class="section-feedback">
					<div class="large-12 columns">
			            <div class="owl-carousel owl-theme owl-loaded owl-drag" data-lg-items="1" data-md-items="1" data-sm-items="1" data-xs-items="1" data-margin="0">
							<?php for($i = 0; $i < count($listCustomersFeedback); $i ++): ?>
								<div class="item">
									<div class="container">
										<div class="ykkh-item">
											<div class="" style="width: 100%; min-height: 1px; overflow: hidden; margin-bottom: 10px;">
												<div class="info-customer">
													<img src="<?php echo base_url() ?>upload/customers-feedback/<?php echo json_decode($listCustomersFeedback[$i]['images'])[0] ?>" alt="<?php echo json_decode($listCustomersFeedback[$i]['alt_image'])[0] ?>" title="<?php echo json_decode($listCustomersFeedback[$i]['title_image'])[0] ?>">
													<h4><?php echo $listCustomersFeedback[$i]['name_customer'] ?></h4>
												</div>
											</div>
											<p>
												<i>
													<?php echo $listCustomersFeedback[$i]['content'] ?>
												</i>
											</p>
										</div>
									</div>
								</div>
							<?php endfor; ?>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
</section>
<script>
    $('#ykkh .owl-carousel').owlCarousel({
	    stagePadding: 0,
	    items: 1,
	    loop:true,
	    margin:0,
	    autoplay: true,
	    singleItem:true,
	    nav:false,
	    dots:true
	});
</script>

<!-- TIN TUC -->
<?php 
	foreach ($listCategoriesTypeContent as $rowCategoriesTypeContent) :
?>
		<section class="box_doitac" style="margin-bottom: 50px;">
			<div class="container">
				<div class="row modcontent">
					<div class="header-title" style="position:relative; margin-bottom: 0; ">
						<h2 class="modtitle"><span><?php echo $rowCategoriesTypeContent['name'] ?></span></h2>
						<!--<a href="/" class="pull-right moredoitac">Xem thêm</a>-->
						<div class="clearfix"></div>
					</div>
					<div class="list-content-ref unf" style="width: 100%; min-height: 1px; overflow: hidden; height: auto; padding-top: 15px; border: solid 1px #e4e4e4; border-top: 0;">
						<?php foreach ($rowCategoriesTypeContent['listPosts'] as $rowPostRef) :?>
							<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 item-ref">
								<div class="a-ref">
					    			<a 
					    				href="<?php echo base_url() ?>bai-viet/<?php echo $rowPostRef['alias'] ?>" 
					    				alt="<?php echo $rowPostRef['alt_image'] ?>" title="<?php echo $rowPostRef['title_image'] ?>"

					    			>
					    				<img width="150" height="100" src="<?php echo base_url() ?>upload/contents/<?php echo $rowPostRef['images'] ?>" class="attachment-custom150x100 size-custom150x100 wp-post-image" alt="<?php echo $rowPostRef['alt_image'] ?>" title="<?php echo $rowPostRef['title_image'] ?>">    			
					    			</a> 
					                <strong>
					                    <a href="<?php echo base_url() ?>bai-viet/<?php echo $rowPostRef['alias'] ?>" title="<?php echo $rowPostRef['title'] ?>" 
					    				alt="<?php echo $rowPostRef['title'] ?>" ><?php echo $rowPostRef['title'] ?></a>
					                </strong>
					    			<figure><?php echo $rowPostRef['short_description'] ?></figure>
					    		</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</section>
<?php 
	endforeach; 
?>
<!-- END TIN TUC -->


<section class="box_doitac">
	<div class="container">
		<div class="row modcontent">
			<div class="header-title" style="position:relative">
				<h2 class="modtitle"><span>Đối tác</span></h2>
				<div class="clearfix"></div>
			</div>
			<section id="demos" style="margin-bottom: 30px;">
			    <div class="">
			        <div class="large-12 columns">
			            <div class="owl-carousel owl-theme owl-list-agencies">
			                <?php for($i = 0; $i< count($listAgencies); $i++): ?>
			                	<div class="item">
				                    <a 
				                    	href="<?php echo $listAgencies[$i]['link_ads'] ?>" 
				                    	target="_blank" 
				                    	alt="<?php echo json_decode($listAgencies[$i]['alt_image'])[0] ?>" 
										title="<?php echo json_decode($listAgencies[$i]['title_image'])[0] ?>" 
			                    	>
										<img 
											alt="<?php echo json_decode($listAgencies[$i]['alt_image'])[0] ?>" 
											title="<?php echo json_decode($listAgencies[$i]['title_image'])[0] ?>" 
											src="<?php echo base_url() ?>upload/agencies/<?php echo json_decode($listAgencies[$i]['images'])[0] ?>"
										>
									</a>
				                </div>
		                	<?php endfor; ?>
			            </div>
			            <script>
			                $(document).ready(function() {
			                  	var owl = $('.owl-list-agencies');
			                  	owl.owlCarousel({
			                    	margin: 10,
			                    	nav: false,
			                    	dots: true,
			                    	loop: true,
			                    	autoplay: true,
			                    	responsive: {
			                     		0: {
			                        		items: 1
			                      		},
			                      		600: {
			                        		items: 3
			                      		},
			                      		1000: {
			                        		items: 5
			                      		}
			                    	}
			                 	});
			                 	//$('.owl-next').text('>');
			                 	//$('.owl-prev').text('<');
			                })
			            </script>
			        </div>
			    </div>
			</section>
		</div>
	</div>
</section>

