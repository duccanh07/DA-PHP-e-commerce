<div class="modal-content">
  <div class="modal-header" style="border-bottom: 0">
    <button type="button" style="margin-top: -10px" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4><?php print_r($detailProduct['name']) ?></h4>
  </div>
  <div class="modal-body" style="padding: 0px">
    <div class="section-collection" style="width: 100%">
		<div class="container mb10" style="width: 100%;">
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-5 col-lg-5 detail-product-image-left">
					<?php for($i = 0; $i < 1; $i++) : 
						$title_image = json_decode($detailProduct['title_image']);
						$alt_image = json_decode($detailProduct['alt_image']);
					?>
						<img src="<?php echo base_url() ?>upload/products/<?php echo $detailProduct['images'][$i] ?>" title="<?php echo $title_image[$i] ?>" alt="<?php echo $alt_image[$i] ?>">
					<?php endfor; ?>
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
		            		if (isset($item_sizes) && count($item_sizes) > 0 && ($item_sizes[0] != null || $item_sizes[0] != '')) :
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
		                    	<ins style="float: left;line-height: 37px;">
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
				        			<ins style="float: left;line-height: 37px;">
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
			                	<?php if(count($items_price_sale) > 0 && isset($items_price_sale[0]) && $items_price_sale[0] != null) : ?>
								<span style="color:#ea445c;margin-bottom:10px;display:block; clear: both;">
									Tiết kiệm: <span class="sale-of"><?php echo round(((($item_prices[0] - $items_price_sale[0]) / $item_prices[0]) * 100), 2).'%'; ?></span>
				            	</span>
			            	<?php else: ?>
			            		<span style="color:#ea445c;margin-bottom:10px;display:none; clear: both;">
									Tiết kiệm: <span class="sale-of"><?php echo round(((($item_prices[0] - $items_price_sale[0]) / $item_prices[0]) * 100), 2).'%'; ?></span>
				            	</span>
				        	<?php endif; ?>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-7 col-lg-7 form-order">
					<h3>Thông tin khách hàng</h3>
					<form action="<?php echo base_url() ?>cart/booking" enctype="multipart/form-data" method="POST" accept-charset="utf-8" style="background: #fff; margin-top: 10px;">
						<div class="box-body" style="padding-top: 15px; border-top: 1px solid #e1e1e1">
							<div class="col-md-6">
								<div class="form-group">
									<label>Họ và tên</label>
									<input type="text" class="form-control" name="fullname" required>
									<?php if(form_error('fullname')): ?>
										<div class="error" id="password_error" style="color: red"><?php echo form_error('fullname')?></div>
									<?php endif; ?>
								</div>
								<div class="form-group">
									<label>Địa chỉ email</label>
									<input type="email" class="form-control" name="email" required>
									<?php if(form_error('email')): ?>
										<div class="error" id="password_error" style="color: red"><?php echo form_error('email')?></div>
									<?php endif; ?>
								</div>
								<div class="form-group">
									<label>Số điện thoại</label>
									<input type="text" class="form-control" name="phone" required>
									<?php if(form_error('phone')): ?>
										<div class="error" id="password_error" style="color: red"><?php echo form_error('phone')?></div>
									<?php endif; ?>
								</div>
								<div class="form-group">
									<input type="text" class="form-control" disabled value="<?php echo $detailProduct['id'] ?>" style="opacity: 0" name="id" required>
								</div>
							</div>	
							<div class="col-md-6">
								<div class="form-group">
									<label>Địa chỉ</label>
									<textarea aria-invalid="false" required style="resize: none;" class="textarea-control form-control" rows="2" cols="40" name="address" ></textarea>
								</div>
								<div class="form-group">
									<label>Ghi chú</label>
									<textarea style="height: 88px; resize: none;" aria-invalid="false" class="textarea-control form-control" rows="4" cols="40" name="note" ></textarea>
								</div>
								<?php  if(isset($errorForm)):?>
                                    <div class="error new-css-error" style="margin-bottom: 10px; margin-top: -5px; color: red;" id="form_error"><?php echo $errorForm; ?></div>
                                <?php endif;?>
								<div class="form-group text-right">
									<button type = "submit" class="btn btn-success btn-sm" role="button" data-toggle="tooltip" data-placement="top" title="">
										ĐẶT HÀNG
									</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
  </div>
</div>