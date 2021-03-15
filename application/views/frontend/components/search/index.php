<?php $this->load->view('frontend/module/slider'); ?>
<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="dpr">
				<h1 class="h1p">KẾT QUẢ TÌM KIẾM</h1>
				<div class="dit" style="padding: 0"> 
			    <?php if(count($listProduct) > 0) : ?>
				    <ul class="pul a">
						<?php for($t = 0; $t < count($listProduct); $t++) : ?>
							<li class="c i10">
						        <a href="<?php echo base_url() ?>san-pham/<?php echo $listProduct[$t]['alias'] ?>" title="<?php echo json_decode($listProduct[$t]['title_image'])[0] ?>" alt="<?php echo json_decode($listProduct[$t]['alt_image'])[0] ?>">
					                <img width="100%" src="<?php echo base_url() ?>upload/products/<?php echo json_decode($listProduct[$t]['images'])[0] ?>" class="attachment-custom600x400 size-custom600x400 wp-post-image" title="<?php echo json_decode($listProduct[$t]['title_image'])[0] ?>" alt="<?php echo json_decode($listProduct[$t]['alt_image'])[0] ?>">   
					            </a>
						        <strong>
						        	<a href="<?php echo base_url() ?>san-pham/<?php echo $listProduct[$t]['alias'] ?>" title="<?php echo $listProduct[$t]['name'] ?>" alt="<?php echo $listProduct[$t]['name'] ?>">
						        		<?php echo $listProduct[$t]['name'] ?>
					        		</a>
					        	</strong>
					        	<?php
									$item_prices = json_decode($listProduct[$t]['item_prices']);
									$items_price_sale = json_decode($listProduct[$t]['items_price_sale']);
								?>
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
						    </li>
						<?php endfor; ?>
					    <li class="cl"></li>
					</ul>
					<?php if ( $totalItem > LIMIT_PRODUCT_SHOW_CATEGORY) :?>
						<div class="col-md-12 text-center">
							<ul class="pagination">
								<?php echo $strphantrang ?>
							</ul>
						</div>
					<?php endif; ?>
				<?php else:  ?>
					<div class="no-product text-center">
						<p>Không có sản phẩm</p>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
</div>