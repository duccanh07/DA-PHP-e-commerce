<?php 
	//echo form_open_multipart('admin/product/update/'.$productDetail['id']); 
?>
<div class="content-wrapper">
	<form action="<?php echo base_url() ?>admin/product/update/<?php echo $productDetail['id'] ?>" enctype="multipart/form-data" method="POST" accept-charset="utf-8" class="button-submit-product form-update-product" data-product="<?php echo $productDetail['id'] ?>">
		<section class="content-header">
			<h1><i class="glyphicon glyphicon-text-background"></i> Cập nhật sản phẩm</h1>
			
		</section>
		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-md-12">
					<div class="box" id="view">
						<div class="box-body add-update-product" data-type='product'>
							<?php  if($this->session->flashdata('success')):?>
		                        <div class="row">
		                            <div class="alert alert-success alert-dismissable fade in">
								    	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								    	<?php echo $this->session->flashdata('success'); ?>
								  	</div>
		                        </div>
		                    <?php  endif;?>
		                    <?php  if($this->session->flashdata('error')):?>
		                        <div class="row">
		                            <div class="alert alert-danger alert-dismissable">
									    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
									    <?php echo $this->session->flashdata('error'); ?>
									  </div>
		                        </div>
		                    <?php  endif;?>
							<div class="ovf">
								<div class="col-md-6">
									<div class="form-group">
										<label>Tên sản phẩm <span class = "maudo">(*)</span></label>
										<input type="text" value="<?php echo $productDetail['name'] ?>" class="form-control" name="name" placeholder="Nhập tên sản phẩm" required>
										<?php if(form_error('name')): ?>
											<div class="error" id="password_error" style="color: red"><?php echo form_error('name')?></div>
										<?php endif; ?>
									</div>
									<div class="form-group">
										<label>Đường dẫn thân thiện <span class = "maudo">(*)</span></label>
										<i>(Hệ thống sẽ tự khởi tạo khi để trống)</i>
										<input type="text" value="<?php echo $productDetail['alias'] ?>" class="form-control" name="alias" placeholder="Nhập đường dẫn thân thiện">
										<?php if(form_error('alias')): ?>
											<div class="error" id="password_error" style="color: red"><?php echo form_error('alias')?></div>
										<?php endif; ?>
									</div>
									<div class="form-group">
										<label>Thẻ tiếp thị Remarketing</label>
										<input type="text" value="<?php echo $productDetail['seo_google'] ?>" class="form-control" name="seo_google" placeholder="Nhập tiếp thị Goole">
										<?php if(form_error('seo_google')): ?>
											<div class="error" id="password_error" style="color: red"><?php echo form_error('seo_google')?></div>
										<?php endif; ?>
									</div>
									<div class="form-group">
										<label>Thẻ Pixel Facebook</label>
										<input type="text" value="<?php echo $productDetail['seo_facebook'] ?>" class="form-control" name="seo_facebook" placeholder="Nhập tiếp thị facebook">
										<?php if(form_error('seo_facebook')): ?>
											<div class="error" id="password_error" style="color: red"><?php echo form_error('seo_facebook')?></div>
										<?php endif; ?>
									</div>
									<!-- <div class="form-group">
										<label>Mở rộng</label>
										<table class="button-mores table table-bordered">
											<thead>
												<tr>
													<th class="text-center">Nổi bật</th>
													<th class="text-center">Bán chạy</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td class="text-center">
														<label class="switch">
														  	<input type="checkbox" class="form-control" <?php if($productDetail['is_hot'] == PRODUCT_IS_HOT) echo 'checked'; ?> name="is_hot">
														  	<span class="slider round"></span>
														</label>
													</td>
													<td class="text-center">
														<label class="switch">
														  	<input type="checkbox" class="form-control" <?php if($productDetail['is_hot_sale'] == PRODUCT_IS_HOT_SALE) echo 'checked'; ?> name="is_hot_sale">
														  	<span class="slider round"></span>
														</label>
													</td>
												</tr>
											</tbody>
										</table>
									</div> -->
									
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Danh mục sản phẩm <span class = "maudo">(*)</span></label>
										<select name="category_id" required class="form-control small-input">
											<?php 
												$detailCategory = $this->Mcategory->category_detail($productDetail['category_id']);
											?>
											<option value="<?php echo $detailCategory['id'] ?>" selected><?php echo $detailCategory['name'] ?></option>
											<?php echo($htmlCategory) ?>
										</select>
									</div>
									
									<div class="form-group">
										<label>SEO tiêu đề <span class = "maudo">(*)</span></label>
										<input type="text" class="form-control" value="<?php echo $productDetail['seo_title'] ?>" name="seo_title" placeholder="Nhập tiếp thị Goole" required>
										<?php if(form_error('seo_title')): ?>
											<div class="error" id="password_error" style="color: red"><?php echo form_error('seo_title')?></div>
										<?php endif; ?>
									</div>
									<div class="form-group">
										<label>SEO từ khóa <span class = "maudo">(*)</span></label>
										<input type="text" value="<?php echo $productDetail['seo_keywords'] ?>" class="form-control" name="seo_keywords" placeholder="Nhập tiếp thị Goole" required>
										<?php if(form_error('seo_keywords')): ?>
											<div class="error" id="password_error" style="color: red"><?php echo form_error('seo_keywords')?></div>
										<?php endif; ?>
									</div>
									<div class="form-group">
										<label>SEO mô tả <span class = "maudo">(*)</span></label>
										<input type="text" class="form-control" value="<?php echo $productDetail['seo_description'] ?>" name="seo_description" placeholder="Nhập tiếp thị Goole" required>
										<?php if(form_error('seo_description')): ?>
											<div class="error" id="password_error" style="color: red"><?php echo form_error('seo_description')?></div>
										<?php endif; ?>
									</div>
								</div>
							</div>
							
							<div class="col-md-12">
								<div class="form-group">
									<label>Sắp xếp <span class = "maudo">(*)</span></label>
									<input type="number" min="1" step="1" value="<?php echo $productDetail['ordering'] ?>" class="form-control small-input" name="ordering" required placeholder="Nhập sắp xếp">
									<?php if(form_error('ordering')): ?>
										<div class="error" id="password_error" style="color: red"><?php echo form_error('ordering')?></div>
									<?php endif; ?>
								</div>
								<div class="form-group" style="width: 100%; min-height: 1px; overflow: hidden;">
									<label>Hình ảnh sản phẩm <span class = "maudo">(*)</span></label>
									<i> (Kích thước chuẩn: 446px x 298px)</i>
									<div class="FileUpload image-product update-product-dp">
										<?php 
											$listImagesProduct = json_decode($productDetail['images']);
											for($i = 0; $i < sizeof($listImagesProduct); $i++) :
										?>
												<div class="file-up-2" data-position-img="<?php echo $i; ?>" data-change-image-product="true">
													<div>
														<?php if (isset($listImagesProduct[$i]) && $listImagesProduct[$i] != null && $listImagesProduct[$i] != '') : ?>
															<img src="<?php echo base_url() ?>upload/products/<?php echo $listImagesProduct[$i] ?>">
														<?php else: ?>
															<img src="<?php echo base_url() ?>assets/images/icon_add.png">
														<?php endif; ?>
														<input type="file" name="images[]" class="input-upload" accept="image/*">
														<?php if (isset($listImagesProduct[$i]) && $listImagesProduct[$i] != null && $listImagesProduct[$i] != '') : ?>
															<span class='fa fa-times-circle'><span>
														<?php endif; ?>
													</div>
													<?php 
														if($i > 0) :
													?>
															<a class="fa fa-trash button-remove-div-upload-image" data-position-icon-remove-div="<?php echo $i; ?>" href="javascript:void(0)" title="Xóa ảnh này" style="cursor: unset;"> Xóa ô</a>
													<?php else:  ?>
															<a class="fa fa-trash button-remove-div-upload-image" data-position-icon-remove-div="<?php echo $i; ?>" href="javascript:void(0)" title="Xóa ảnh này" style="opacity: 0; cursor: unset;" data-disabled="true"> Xóa ô</a>
													<?php 
														endif;
													?>
												</div>
										<?php 
											endfor;
										?>
										<a class="fa fa-plus-circle button-add-elm" href="javascript:void(0)" title="Thêm ảnh" data-url="<?php echo base_url() ?>"> Thêm</a>
									</div>

								<div id="title-alt" class="form-group box-wrapper" style="clear: both; margin-top: 10px;">
									<label>Hình ảnh sản phẩm</label>
									<?php 
										$title_image = json_decode($productDetail['title_image']);
										$alt_image = json_decode($productDetail['alt_image']);
										$max = max(sizeof($title_image), sizeof($alt_image));
										for($i = 0; $i < $max; $i++) :
									?>
										<div class='row' data-position-alt-img="<?php echo $i; ?>">
							                <div class='form-group col-md-6'>
							                    <label>Tiêu đề hình ảnh<span class = 'maudo'>(*)</span></label> 
							                    <input type='text' value="<?php echo $title_image[$i] ?>" class='form-control' name='title_image[]' placeholder='Nhập tiêu đề hình ảnh' required>
							                </div> 
							                <div class='form-group col-md-6'> 
							                    <label>Mô tả hình ảnh<span class = 'maudo'>(*)</span></label>
							                    <input type='text' value="<?php echo $alt_image[$i] ?>" class='form-control' name='alt_image[]' placeholder='Nhập mô tả hình ảnh' required>
							                </div>
							            </div>
									<?php 
										endfor; 
									?>
								</div>
								<div class="form-group">
									<label>Tùy chọn <span class = "maudo">(*)</span></label>
									<i> (Kích thước chuẩn: 588px x 588px)</i>
									<table class="button-mores table table-bordered table-options" style="margin-bottom: 10px">
										<thead>
											<tr>
												<th class="text-center">Mã</th>
												<th class="text-center">Giá gốc</th>
												<th class="text-center">Giá khuyến mãi</th>
												<th class="text-center">Kích thước</th>
												<th class="text-center" style="width: 90px;">Màu sắc</th>
												<th class="text-center">Khối lượng</th>
												<th class="text-center">Xóa</th>
											</tr>
										</thead>
										<tbody>
											<?php 
												$item_codes = json_decode($productDetail['item_codes']);
												$item_prices = json_decode($productDetail['item_prices']);
												$item_sizes = json_decode($productDetail['item_sizes']);
												$item_colors = json_decode($productDetail['item_colors']);
												$items_price_sale = json_decode($productDetail['items_price_sale']);
												$item_weights = json_decode($productDetail['item_weights']);
												$array_items = array(
													count($item_codes),
													count($item_prices),
													count($item_sizes),
													count($item_colors),
													count($items_price_sale),
													count($item_weights)
												);
												$max_length = max($array_items);
												$i = 0;
												for( $i; $i < $max_length; $i++) :
											?>
												<tr>
													<td class="text-center">
														<input type="text" value="<?php if (isset($item_codes[$i])) echo $item_codes[$i] ?>" class="form-control" name="item_codes[]" placeholder="Nhập mã sản phẩm">
													</td>
													<td class="text-center">
														<input type="number" value="<?php if (isset($item_prices[$i])) echo $item_prices[$i] ?>" min="0" step="500" class="form-control" name="item_prices[]" placeholder="Nhập giá sản phẩm" >
													</td>
													<td class="text-center">
														<input type="number" min="1000" step="500" value="<?php if (isset($items_price_sale[$i])) echo $items_price_sale[$i] ?>" id="item_sale_of" class="form-control" name="items_price_sale[]" placeholder="Nhập giá khuyến mãi">
													</td>
													<td class="text-center">
														<input type="text" value="<?php if (isset($item_sizes[$i])) echo $item_sizes[$i] ?>" class="form-control" name="item_sizes[]" placeholder="Nhập kích thước">
													</td>
													<td class="text-center" style="width: 90px;">
														<div class="FileUpload">
															<div class="file-up" data-position-img-color="<?php echo $i; ?>" data-change-image="true">
																<?php if (isset($item_colors[$i]) && $item_colors[$i] != null && $item_colors[$i] != '') : ?>
																	<img src="<?php echo base_url() ?>upload/colors/<?php echo $item_colors[$i] ?>">
																<?php else: ?>
																	<img src="<?php echo base_url() ?>assets/images/icon_add.png">
																<?php endif; ?>
																<input type="file" name="item_colors[]" class="input-upload" accept="image/*">
																<?php if (isset($item_colors[$i]) && $item_colors[$i] != null && $item_colors[$i] != '') : ?>
																	<span class='fa fa-times-circle'><span>
																<?php endif; ?>
															</div>
														</div>
													</td>
													<td class="text-center">
														<input type="text" value="<?php if (isset($item_weights[$i])) echo $item_weights[$i] ?>" class="form-control" name="item_weights[]" placeholder="Nhập khối lượng sản phẩm">
													</td>
													<td>
														<span class="fa fa-trash icon-remove-div" style="cursor: pointer; opacity: 0"></span>
													</td>
												</tr>
											<?php endfor; ?>
										</tbody>
									</table>
									<div class="form-group ovf">
										<a class="btn btn-info btn-sm pull-right button-add-option" href="javascript:void(0);" role="button" data-toggle="tooltip" data-placement="top" title="" data-url="<?php echo base_url() ?>">
											Thêm tùy chọn
										</a>
									</div>
								</div>
								<div id="title-alt-img-color">
									<?php 
										$item_title_image_color = json_decode($productDetail['item_title_image_color']);
										$item_alt_image_color = json_decode($productDetail['item_alt_image_color']);
										$max = max(
											sizeof($item_title_image_color),
											sizeof($item_alt_image_color),
											sizeof($item_colors)
										);
										for($j = 0; $j < $max; $j++) : 
									?>
										<div class='row' data-position-alt-img-color="<?php echo $j ?>">
							                <div class='form-group col-md-6'>
							                    <label>Tiêu đề hình ảnh <?php echo $j + 1 ?><span class = 'maudo'>(*)</span></label> 
							                    <input type='text' class='form-control' name='item_title_image_color[]' value="<?php echo $item_title_image_color[$j] ?>" placeholder='Nhập tiêu đề hình ảnh'>
							                </div> 
							                <div class='form-group col-md-6'> 
							                    <label>Mô tả hình ảnh <?php echo $j + 1 ?><span class = 'maudo'>(*)</span></label>
							                    <input type='text' class='form-control' name='item_alt_image_color[]' value="<?php echo $item_alt_image_color[$j] ?>" placeholder='Nhập mô tả hình ảnh'>
							                </div>
							            </div>
									<?php endfor; ?>
								</div>
								<div class="form-group">
										<label>Mô tả ngắn</label>
										<textarea name="short_description" id="detail" class="form-control" ><?php echo $productDetail['short_description'] ?></textarea>
      								<script>CKEDITOR.replace('short_description');</script>
								</div>
								<div class="form-group">
									<label>Chi tiết sản phẩm</label>
									<textarea name="description" id="detail" class="form-control" ><?php echo $productDetail['description'] ?></textarea>
      								<script>CKEDITOR.replace('description');</script>
								</div>
								<?php if (isset($errorFormCategory)): ?>
                                    <div class="error" id="password_error"><?php echo $errorFormCategory ?></div>
                                <?php endif; ?>
								<button type = "submit" class="btn btn-success btn-sm" role="button" data-toggle="tooltip" data-placement="top" title="">
									LƯU</button>
								<a class="btn btn-default btn-sm" href="<?php echo base_url() ?>admin/product" role="button" data-toggle="tooltip" data-placement="top" title="">
									THOÁT
								</a>
								<br><br>
							</div>
						</div>
					</div><!-- /.box -->
				</div>
			<!-- /.col -->
		  </div>
		  <!-- /.row -->
		</section>
	</form>
<!-- /.content -->
</div><!-- /.content-wrapper -->
