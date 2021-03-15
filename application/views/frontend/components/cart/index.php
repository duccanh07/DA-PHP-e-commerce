<div class="row content-cart" >
	<div class="container">
		<div class="row">
			<div class="cart-index">
				<div class="tbody">
					<div class="col-xs-12 col-sm-12 col-md-12">
						<div class="header-title" style="position:relative;">
							<div class="title-post" >
								<h1 class="h1p" style="background: #fff;">Giỏ hàng</h1>
							</div>
							<div class="clearfix"></div>
						</div>
						<table class="table table-list-product" style="background: #fff;">
							<thead>
								<tr>
									<th style="border-bottom-width: 1px">Hình ảnh</th>
									<th style="border-bottom-width: 1px">Tên sản phẩm</th>
									<th style="border-bottom-width: 1px">Mã sản phẩm</th>
									<th class="text-right" style="border-bottom-width: 1px">Đơn giá</th>
									<th class="text-right" style="border-bottom-width: 1px">Số lượng</th>
									<th class="text-right" style="border-bottom-width: 1px">Thành tiền</th>
									<th class="text-center" style="border-bottom-width: 1px">Xóa</th>
								</tr>
							</thead>
							<tbody>
								<?php for ($i = 0; $i < sizeof($listProduct['product']); $i++):
									$infoProduct = $listProduct['product'][$i];
									$listProductsCode = json_decode($infoProduct['infoProduct']['sizes']);
									$position_size = $infoProduct['infoProduct']['position_size'];
									$code = '';
									if (isset($position_size) && isset($listProductsCode[$position_size])) {
										$code = $listProductsCode[$position_size];
									}
									$images = json_decode($infoProduct['infoProduct']['images']);
									$title_image = json_decode($infoProduct['infoProduct']['title_image']);
									$alt_image = json_decode($infoProduct['infoProduct']['alt_image']);
								?>
									<tr>
										<td class="img-product-cart">
											<a 
												href="<?php echo base_url() ?>san-pham/<?php echo $infoProduct['infoProduct']['alias']?>" 
												title="<?php echo $title_image[0] ?>" 
												alt="<?php echo $alt_image[0] ?>" 
											>
												<img 
													src="<?php echo base_url() ?>upload/products/<?php echo $images[0]; ?>" 
													title="<?php echo $title_image[0] ?>" 
													alt="<?php echo $alt_image[0] ?>" 
												>
											</a>
										</td>
										<td>
											<a 
												href="<?php echo base_url() ?>san-pham/<?php echo $infoProduct['infoProduct']['alias']?>" 
												class="pull-left" 
												title="<?php echo $infoProduct['infoProduct']['name'] ?>" 
												alt="<?php echo $infoProduct['infoProduct']['name'] ?>"
											>
											<?php echo $infoProduct['infoProduct']['name'] ?>
												
											</a>
										</td>
										<td>
											<?php
												$sizes = json_decode($infoProduct['infoProduct']['sizes']);
												if ($infoProduct['infoProduct']['position_size'] != '') {
													if ($sizes[$infoProduct['infoProduct']['position_size']] != '') {
														echo $sizes[$infoProduct['infoProduct']['position_size']];
													}
												}
											?>
										</td>
										<td class="text-right">
											<span class="amount">
												<?php echo (number_format($infoProduct['infoProduct']['price'])).CURRENTCY_UNIT; ?>
											</span>
										</td>
										<td class="text-right">
											<div class="quantity clearfix">
												<input name="quantity" style="width: 100px; float: right;" id="<?php echo $infoProduct['infoProduct']['id'] ?>" class="form-control text-right quantity" type="number" value="<?php echo $infoProduct['quantity'] ?>" min="1" max="100" data-id="<?php echo $infoProduct['infoProduct']['id'] ?>" data-url="<?php echo base_url() ?>" data-code="<?php echo $code; ?>">
											</div>
										</td>
										<td class="text-right">
											<span class="amount">
												<strong>
													<?php 
														echo (number_format($infoProduct['priceProductQuantity'])).CURRENTCY_UNIT;
														
													?>
												</strong>
											</span>
										</td>
										<td>
											<a class="remove" title="Xóa" alt="Xóa" data-id="<?php echo $infoProduct['infoProduct']['id'] ?>" data-url="<?php echo base_url() ?>" data-code="<?php echo $code; ?>"><i class="fa fa-trash"></i></a>
										</td>
									</tr>
								<?php endfor; ?>
								<tr>
									<td colspan="7" class="text-right">
										Tổng cộng: 
										<strong><?php echo (number_format($listProduct['totalPrice'])).CURRENTCY_UNIT; ?></strong>
									</td>
								</tr>
							</tbody>
						</table>
						<div class="info-payment">
							<br />
							<div class="header-title" style="position:relative; margin-bottom: 0;">
								<div class="title-post">
									<h1 class="h1p" style="background: #fff;">Đặt hàng</h1>
								</div>
								<div class="clearfix"></div>
							</div>
							<form action="<?php echo base_url() ?>cart/list_cart" enctype="multipart/form-data" method="POST" accept-charset="utf-8" style="background: #fff; margin-top: 10px;">
								<div class="box-body">
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
</div>