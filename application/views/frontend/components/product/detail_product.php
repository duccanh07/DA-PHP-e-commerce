<div class="detail-product-image">
	<div class="container">
		<div class="row">
			<div class="upd">
				<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 detail-product-image-left">
					<div class="sp-wrap">
						<?php for($i = 0; $i < count($detailProduct['images']); $i++) : 
							$title_image = json_decode($detailProduct['title_image']);
							$alt_image = json_decode($detailProduct['alt_image']);
						?>
							<a href="<?php echo base_url() ?>upload/products/<?php echo $detailProduct['images'][$i] ?>" data-position="<?php echo $i; ?>" title="<?php echo $title_image[$i] ?>" alt="<?php echo $alt_image[$i] ?>">
								<img src="<?php echo base_url() ?>upload/products/<?php echo $detailProduct['images'][$i] ?>" title="<?php echo $title_image[$i] ?>" alt="<?php echo $alt_image[$i] ?>">
							</a>
						<?php endfor; ?>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 detail-product-image-right padding-15" style="padding: 15px 0 0 0;">
					<div>
						<?php 
							$item_codes = json_decode($detailProduct['item_codes']);
							$item_title_image_color = json_decode($detailProduct['item_title_image_color']);
							$item_alt_image_color = json_decode($detailProduct['item_alt_image_color']);
							$item_colors = json_decode($detailProduct['item_colors']);
							$max = max(
								sizeof($item_codes),
								sizeof($item_title_image_color),
								sizeof($item_alt_image_color),
								sizeof($item_colors)
							);
							for($i = 0; $i < $max; $i++) :
						?>
								<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 info-item-product text-center <?php if ($i == 0) { echo 'info-item-product-active';} ?>" <?php if($i == 0) { echo "style='border-left: 1px solid #eee'";} ?> data-position-div="<?php echo $i; ?>" data-code="<?php if (isset($item_codes[$i])) { echo $item_codes[$i]; } ?>">
									<div class="item-img">
										<?php if(isset($item_colors[$i]) && $item_colors[$i] != '') : ?>
											<img src="<?php echo base_url() ?>upload/colors/<?php echo $item_colors[$i] ?>" <?php if (isset($item_alt_image_color[$i])) { echo "alt='".$item_alt_image_color[$i]."'"; } ?>  <?php if (isset($item_title_image_color[$i])) { echo "title='".$item_title_image_color[$i]."'"; } ?>>
										<?php else: ?>
											<img src="<?php echo base_url() ?>assets/images/no_image.png" alt="No image color" title="No image color">
										<?php endif; ?>
									</div>
									<div class="item-product-content">
									 	<?php if (isset($item_codes[$i]) && $item_codes[$i] != '') : ?>
									 		<p href="javascript:void(0)" title="Mã sản phẩm: <?php echo $item_codes[$i] ?>"><?php echo $item_codes[$i] ?></p>
								 		<?php else : ?>
								 			<p href="javascript:void(0)" title="Mã sản phẩm hiện đang cập nhật" style="height: 17px;"><i>Đang cập nhật</i></p>
								 		<?php endif; ?>
										<button class="btn button-zoom btn-danger fa fa-search-plus" title="Phóng lớn" data-url="<?php echo base_url() ?>" data-product="<?php echo $detailProduct['id'] ?>" data-image="<?php if(isset($item_colors[$i]) && $item_colors[$i] != '') {
											echo base_url()."upload/colors/".$item_colors[$i];
										} else { echo base_url()."assets/images/no_image.png"; } ?>" data-code="<?php if (isset($item_codes[$i]) && $item_codes[$i] != '') { echo 'Mã sản phẩm: '.$item_codes[$i]; } else { echo 'Mã sản phẩm hiện đang cập nhật'; } ?>"></button>
									</div>
								</div>
						<?php 
							endfor;
						?>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 form-order">
					<div class="cc">
						<h1 class="product_title entry-title"><?php echo $detailProduct['name'] ?></h1>
						<div itemprop="description" class="sort-description">
							<?php echo $detailProduct['short_description'] ?>
					    </div>
						<ul class="list-options">
							<?php 
			            		$item_codes = json_decode($detailProduct['item_codes']); 
			            		if (count($item_codes) > 0 && ($item_codes[0] != null || $item_codes[0] != '')) :
			            	?>	
			                	<li>
			            			<span class="code-select">Mã sản phẩm: <b><?php echo $item_codes[0]; ?></b></span>
				                </li>
			            	<?php else : ?>
								<li>
			             			<span class="code-select"></span>
				                </li>
			        		<?php endif; ?>
							<?php 
			            		$item_sizes = json_decode($detailProduct['item_sizes']); 
			            		if (count($item_sizes) > 0 && ($item_sizes[0] != null || $item_sizes[0] != '')) :
			            	?>	
			                	<li>
			            			<span class="size-select">Kích thước: <b><?php echo $item_sizes[0]; ?></b></span>
				                </li>
			            	<?php else : ?>
								<li>
			             			<span class="size-select"></span>
				                </li>
			        		<?php endif; ?>

			        		<?php 
			            		$item_weights = json_decode($detailProduct['item_weights']); 
			            		if (count($item_weights) > 0 && ($item_weights[0] != null || $item_weights[0] != '')) :
			            	?>	
			                	<li>
			            			<span class="weight-select">Khối lượng: <b><?php echo $item_weights[0]; ?></b></span>
				                </li>
			            	<?php else : ?>
								<li>
			             			<span class="weight-select"></span>
				                </li>
			        		<?php endif; ?>
						</ul>
			    		<?php
							$item_prices = json_decode($detailProduct['item_prices']);
							$items_price_sale = json_decode($detailProduct['items_price_sale']);
						?>
						<div class="price-c" style="display: block; width: 100%; min-height: 1px; overflow: hidden;">
							<div class="a" style="display: block; float: left;font-weight: unset; padding-top: 0">
								<?php if(count($items_price_sale) > 0 && isset($items_price_sale[0]) && $items_price_sale[0] != null) : ?>
									<span class="pull-left" style="color: #404042; font-size: 14px; padding-top: 9px">Giá sản phẩm:&nbsp;</span>
			                    	<ins style="float: left;">
					        			<b><span class="woocommerce-Price-amount amount price-sale"><?php echo number_format($items_price_sale[0]).'đ'; ?>
					        				<span class="woocommerce-Price-currencySymbol"></span>
					        			</span></b>
					        		</ins>
					        		<del style="display: block; float: left;    margin-left: 10px;color: #999;font-size: 16px;line-height: 37px;">
				                    	<span class="woocommerce-Price-amount amount price-default"><?php echo number_format($item_prices[0]).'đ'; ?>
				                    		<span class="woocommerce-Price-currencySymbol"></span>
				                    	</span>
					        		</del> 
				        		<?php else: ?>
				        			<?php if(count($item_prices) > 0 && isset($item_prices[0]) && $item_prices[0] != null) : ?>
				        				<span class="pull-left" style="color: #404042; font-size: 14px; padding-top: 9px">Giá sản phẩm:&nbsp;</span>
					        			<ins style="float: left;">
						        			<b><span class="woocommerce-Price-amount amount price-sale"><?php echo number_format($item_prices[0]).'đ'; ?>
						        				<span class="woocommerce-Price-currencySymbol"></span>
						        			</span></b>
						        		</ins> 
						        		<del style="display: block; float: left;margin-left: 10px;color: #999;font-size: 16px;line-height: 37px;">
				                    	<span class="woocommerce-Price-amount amount price-default">
				                    		<span class="woocommerce-Price-currencySymbol"></span>
				                    	</span>
					        		</del> 
			                		<?php else: echo 'Liên hệ'; ?>
			                		<?php endif; ?>
			                		
			                	<?php endif; ?>
							</div>
						</div>
						

						<?php if(count($items_price_sale) > 0 && isset($items_price_sale[0]) && $items_price_sale[0] != null) : ?>
							<span style="color:#ea445c;margin-bottom:10px;display:block; clear: both;">
								Tiết kiệm: <span class="sale-of"><?php echo round(((($item_prices[0] - $items_price_sale[0]) / $item_prices[0]) * 100), 2).'%'; ?></span>
			            	</span>
		            	<?php else: ?>
		            		<span style="color:#ea445c;margin-bottom:10px;display:none; clear: both;">
								Tiết kiệm: <span class="sale-of"><?php echo round(((($item_prices[0] - $items_price_sale[0]) / $item_prices[0]) * 100), 2).'%'; ?></span>
			            	</span>
			        	<?php endif; ?>

					    <br>
					    <div class="m row" style="clear: both; margin-top: 10px;"> 
					    	<div class="col-md-12 col-lg-12">
			                	<?php 
		                    		if(count($item_prices) > 0 && isset($item_prices[0]) && $item_prices[0] != null) :
		                    	?>
								        <button class="button-add-cart-modal button-add-cart-to-modal" data-url="<?php echo base_url() ?>" data-id="<?php echo $detailProduct['id'] ?>" style="    cursor: pointer;
    float: left;
    width: 100%;
    line-height: 38px;
    text-align: center;
    color: #333;
    border-radius: 3px;
    font-weight: 700;
    border: 0;
    text-decoration: none;
    font-size: 14px;     background: #f9d026;
    margin-bottom: 10px;">
								        	Đặt hàng nhanh
								        </button>
					        	<?php endif; ?>
			                </div>
			                <div class="col-md-12 col-lg-12">
			                	<a href="javascript:void(0)" <?php if(count($item_prices) > 0 && isset($item_prices[0]) && $item_prices[0] != null) { echo "style='display:block'"; } else {echo "style='display:none'";} ?> class="button-submit button-dh button-add-cart" data-url="<?php echo base_url() ?>" data-id="<?php echo $detailProduct['id'] ?>" title="Đặt hàng" alt="Đặt hàng">Thêm vào giỏ hàng</a>
			        			<a href="javascript:void(0)" <?php if(count($item_prices) > 0 && isset($item_prices[0]) && $item_prices[0] != null) { echo "style='display:none'"; } else {echo "style='display:block'";} ?> class="button-submit button-dh button-none" data-hotline="<?php echo $configs['contactConfig']['value']->hotlineShop; ?>" alt="Gọi tư vấn" title="Gọi tư vấn">Gọi tư vấn: <?php echo $configs['contactConfig']['value']->hotlineShop; ?></a>
			                </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- <?php $this->load->view('frontend/module/tpt_ck'); ?> -->
<div class="detail-product-img">
	<div class="container">
		<div class="row detail-product-vd">
			<?php if($detailProduct['description'] != '') : ?>
				<section class="box_doitac" style="margin-bottom: 50px;">
					<div class="container">
						<div class="row modcontent">
							<div class="header-title" style="position:relative">
								<h2 class="modtitle"><span>Mô tả sản phẩm</span></h2>
								<div class="clearfix"></div>
							</div>
							<div class="content-video" style="padding: 10px">
								<?php echo $detailProduct['description'] ?>
							</div>
						</div>
					</div>
				</section>
			<?php endif; ?>
			<div class="products-video-ref products-ref">
				<div class="container-2" >
					<div class="row-2">
						<div class="header-products-video umt">
							<h3 class="l">Sản phẩm cùng loại</h3>
						</div>
						<ul class="pul a list-product-ref">
							<?php for($t = 0; $t < count($listProductsRef); $t++) : ?>
								<li class="c i10">
							        <a href="<?php echo base_url() ?>san-pham/<?php echo $listProductsRef[$t]['alias'] ?>" alt="<?php echo $listProductsRef[$t]['alt_image'] ?>" title="<?php echo $listProductsRef[$t]['title_image'] ?>">
						                <img width="100%" src="<?php echo base_url() ?>upload/products/<?php echo $listProductsRef[$t]['images'] ?>" class="attachment-custom600x400 size-custom600x400 wp-post-image" alt="<?php echo $listProductsRef[$t]['alt_image'] ?>" title="<?php echo $listProductsRef[$t]['title_image'] ?>">   
						            </a>
							        <strong>
							        	<a href="<?php echo base_url() ?>san-pham/<?php echo $listProductsRef[$t]['alias'] ?>">
							        		<?php echo $listProductsRef[$t]['name'] ?>
						        		</a>
						        	</strong>
						        	<?php
										$item_prices = json_decode($listProductsRef[$t]['item_prices']);
										$items_price_sale = json_decode($listProductsRef[$t]['items_price_sale']);
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
									        <button class="button-add-cart-modal button-add-cart-to-modal" data-url="<?php echo base_url() ?>" data-id="<?php echo $listProductsRef[$t]['id'] ?>">
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
					</div>
				</div>
			</div>
			<div class="container-2">
				<div class="row-2">
					<div class="dshd">
					  	<div class="fb-like" data-href="<?php echo current_url() ?>" data-layout="button_count" data-action="like" data-size="small" data-show-faces="false" data-share="false"></div>
					  	<div class="fb-share-button" data-href="<?php echo current_url() ?>" data-layout="button_count" data-size="small" data-mobile-iframe="false"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>
						<div class="g-plusone" data-size="tall" ... style="margin-top: 10px" ></div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 detail-product-vd">
				<section class="box_doitac box-detail-product" style="margin-bottom: 50px;">
					<div class="row">
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


