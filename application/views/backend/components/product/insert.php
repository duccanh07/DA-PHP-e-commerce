<div class="content-wrapper">
	<form action="<?php echo base_url() ?>admin/product/insert.html" enctype="multipart/form-data" method="POST" accept-charset="utf-8" class="button-submit-product">
		<section class="content-header">
			<h1><i class="glyphicon glyphicon-text-background"></i> Thêm sản phẩm mới</h1>
			
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
										<input type="text" class="form-control" name="name" placeholder="Nhập tên sản phẩm" required>
										<?php if(form_error('name')): ?>
											<div class="error" id="password_error" style="color: red"><?php echo form_error('name')?></div>
										<?php endif; ?>
									</div>
									<div class="form-group">
										<label>Đường dẫn thân thiện <span class = "maudo">(*)</span></label>
										<i>(Hệ thống sẽ tự khởi tạo khi để trống)</i>
										<input type="text" class="form-control" name="alias" placeholder="Nhập đường dẫn thân thiện">
										<?php if(form_error('alias')): ?>
											<div class="error" id="password_error" style="color: red"><?php echo form_error('alias')?></div>
										<?php endif; ?>
									</div>
									<div class="form-group">
										<label>Thẻ tiếp thị Remarketing</label>
										<input type="text" class="form-control" name="seo_google" placeholder="Nhập tiếp thị Goole">
										<?php if(form_error('seo_google')): ?>
											<div class="error" id="password_error" style="color: red"><?php echo form_error('seo_google')?></div>
										<?php endif; ?>
									</div>
									<div class="form-group">
										<label>Thẻ Pixel Facebook</label>
										<input type="text" class="form-control" name="seo_facebook" placeholder="Nhập tiếp thị Goole">
										<?php if(form_error('seo_facebook')): ?>
											<div class="error" id="password_error" style="color: red"><?php echo form_error('seo_facebook')?></div>
										<?php endif; ?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Danh mục sản phẩm <span class = "maudo">(*)</span></label>
										<select name="category_id" required class="form-control small-input">
											<option value="<?php echo DEFAULT_PARENT_ID ?>">[-- Chọn danh mục --]</option>
											<?php echo($htmlCategory) ?>
										</select>
									</div>
									
									<div class="form-group">
										<label>SEO tiêu đề <span class = "maudo">(*)</span></label>
										<input type="text" class="form-control" name="seo_title" placeholder="Nhập tiếp thị Goole" required>
										<?php if(form_error('seo_title')): ?>
											<div class="error" id="password_error" style="color: red"><?php echo form_error('seo_title')?></div>
										<?php endif; ?>
									</div>
									<div class="form-group">
										<label>SEO từ khóa <span class = "maudo">(*)</span></label>
										<input type="text" class="form-control" name="seo_keywords" placeholder="Nhập tiếp thị Goole" required>
										<?php if(form_error('seo_keywords')): ?>
											<div class="error" id="password_error" style="color: red"><?php echo form_error('seo_keywords')?></div>
										<?php endif; ?>
									</div>
									<div class="form-group">
										<label>SEO mô tả <span class = "maudo">(*)</span></label>
										<input type="text" class="form-control" name="seo_description" placeholder="Nhập tiếp thị Goole" required>
										<?php if(form_error('seo_description')): ?>
											<div class="error" id="password_error" style="color: red"><?php echo form_error('seo_description')?></div>
										<?php endif; ?>
									</div>
								</div>
							</div>
							
							<div class="col-md-12">
								<div class="form-group">
									<label>Sắp xếp <span class = "maudo">(*)</span></label>
									<input type="number" min="1" step="1" class="form-control small-input" name="ordering" placeholder="Nhập sắp xếp" required>
									<?php if(form_error('ordering')): ?>
										<div class="error" id="password_error" style="color: red"><?php echo form_error('ordering')?></div>
									<?php endif; ?>
								</div>
								<div class="form-group" style="width: 100%; min-height: 1px; overflow: hidden;">
									<label>Hình ảnh sản phẩm <span class = "maudo">(*)</span></label>
									<i> (Kích thước chuẩn: 446px x 298px)</i>
									<div class="FileUpload image-product">
										<div class="file-up-2" data-position-img="0">
											<div>
												<img src="<?php echo base_url() ?>assets/images/icon_add.png">
												<input type="file" name="images[]" class="input-upload" accept="image/*" required>
											</div>
											<a class="fa fa-trash button-remove-div-upload-image" data-position-icon-remove-div="0" href="javascript:void(0)" title="Xóa ảnh này" style="opacity: 0; cursor: unset;	" disabled> Xóa</a>
										</div>
										<a class="fa fa-plus-circle button-add-elm" href="javascript:void(0)" title="Thêm ảnh" data-url="<?php echo base_url() ?>"> Thêm</a>
									</div>
								</div>

								<div id="title-alt" class="form-group box-wrapper" style="clear: both;">
									<label>Hình ảnh sản phẩm</label>
									<div class='row' data-position-alt-img="0">
						                <div class='form-group col-md-6'>
						                    <label>Tiêu đề hình ảnh<span class = 'maudo'>(*)</span></label> 
						                    <input type='text' class='form-control' name='title_image[]' placeholder='Nhập tiêu đề hình ảnh' required>
						                </div> 
						                <div class='form-group col-md-6'> 
						                    <label>Mô tả hình ảnh<span class = 'maudo'>(*)</span></label>
						                    <input type='text' class='form-control' name='alt_image[]' placeholder='Nhập mô tả hình ảnh' required>
						                </div>
						            </div>
								</div>
								<div class="form-group" style="clear: both;">
									<label>Tùy chọn</label>
									<i> (Kích thước chuẩn: 588px x 588px)</i>
									<table class="button-mores table table-bordered table-options" style="margin-bottom: 10px">
										<thead>
											<tr>
												<th class="text-center">Mã </th>
												<th class="text-center">Giá gốc</th>
												<th class="text-center">Giá khuyến mãi</th>
												<th class="text-center">Kích thước</th>
												<th class="text-center" style="width: 90px;">Màu sắc</th>
												<th class="text-center">Khối lượng</th>
												<th class="text-center">Xóa</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td class="text-center">
													<input type="text" class="form-control" name="item_codes[]" placeholder="Nhập mã sản phẩm">
												</td>
												<td class="text-center">
													<input type="number" min="1000" step="500" class="form-control" name="item_prices[]" placeholder="Nhập giá sản phẩm">
												</td>
												<td class="text-center">
													<input type="number" id="items_price_sale" min="1000" step="500" class="form-control" name="items_price_sale[]" placeholder="Nhập giá khuyến mãi">
												</td>
												<td class="text-center">
													<input type="text" class="form-control" name="item_sizes[]" placeholder="Nhập kích thước">
												</td>
												<td class="text-center" style="width: 90px;">
													<div class="FileUpload">
														<div class="file-up" data-position-img-color="0">
															<img src="<?php echo base_url() ?>assets/images/icon_add.png">
															<input type="file" name="item_colors[]" class="input-upload" accept="image/*" required>
														</div>
													</div>
												</td>
												<td class="text-center">
													<input type="text" class="form-control" name="item_weights[]" placeholder="Nhập khối lượng sản phẩm">
												</td>
												<td>
													<span class="fa fa-trash icon-remove-div" style="cursor: pointer; opacity: 0"></span>
												</td>
											</tr>
										</tbody>
									</table>
									<div class="form-group ovf">
										<a class="btn btn-info btn-sm pull-right button-add-option" href="javascript:void(0);" role="button" data-toggle="tooltip" data-placement="top" data-url="<?php echo base_url() ?>" title="">
											Thêm tùy chọn
										</a>
									</div>
								</div>
								<div id="title-alt-img-color" class="form-group box-wrapper">
									<label>Hình ảnh màu sắc</label>
									<div class='row' data-position-alt-img-color="0">
						                <div class='form-group col-md-6'>
						                    <label>Tiêu đề hình ảnh 1<span class = 'maudo'>(*)</span></label> 
						                    <input type='text' class='form-control' name='item_title_image_color[]' placeholder='Nhập tiêu đề hình ảnh'>
						                </div> 
						                <div class='form-group col-md-6'> 
						                    <label>Mô tả hình ảnh 1<span class = 'maudo'>(*)</span></label>
						                    <input type='text' class='form-control' name='item_alt_image_color[]' placeholder='Nhập mô tả hình ảnh'>
						                </div>
						            </div>
								</div>
								<div class="form-group">
										<label>Mô tả ngắn</label>
										<textarea name="short_description" id="detail" class="form-control" ></textarea>
      								<script>CKEDITOR.replace('short_description');</script>
								</div>
								<div class="form-group">
									<label>Chi tiết sản phẩm</label>
									<textarea name="description" id="detail" class="form-control" ></textarea>
      								<script>CKEDITOR.replace('description');</script>
								</div>
								<?php if (isset($errorForm)): ?>
                                    <div class="error" id="password_error"><?php echo $errorForm ?></div>
                                <?php endif; ?>
								<button type = "submit" class="btn btn-success btn-sm" role="button" data-toggle="tooltip" data-placement="top" title="">
									THÊM</button>
								<a class="btn btn-default btn-sm" href="javascript:history.back();" role="button" data-toggle="tooltip" data-placement="top" title="">
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
