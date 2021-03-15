<?php echo form_open_multipart('admin/policies/update/'.$row['id']); ?>
<div class="content-wrapper">
	<form action="<?php echo base_url() ?>admin/policies/update/<?php echo $row['id']; ?>" enctype="multipart/form-data" method="POST" accept-charset="utf-8">
		<section class="content-header">
			<h1><i class="glyphicon glyphicon-text-background"></i> Cập nhật chính sách</h1>
		</section>
		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-md-12">
					<div class="box" id="view-policies">
						<div class="box-body">
							<?php //echo validation_errors(); ?>
							<div class="col-md-9">
								<div class="form-group">
									<label>Tiêu đề <span class = "maudo">(*)</span></label>
									<input type="text" class="form-control" required name="name" placeholder="Nhập tiêu đề" value="<?php echo $row['name'] ?>">
									<?php if(form_error('name')): ?>
										<div class="error" id="password_error" style="color: red"><?php echo form_error('name')?></div>
									<?php endif; ?>
								</div>
								<div class="form-group">
									<label>Nội dung</label>
									<input type="text" value="<?php echo $row['description'] ?>" class="form-control" name="description" placeholder="Nhập mô tả hình ảnh">
									<?php if(form_error('description')): ?>
										<div class="error" id="password_error" style="color: red"><?php echo form_error('description')?></div>
									<?php endif; ?>
								</div>
								<div class="form-group">
									<label>Sắp xếp</label>
									<input type="number" min="1" step="1" value="<?php echo $row['ordering'] ?>" class="form-control small-input" name="ordering" placeholder="Nhập sắp xếp">
									<?php if(form_error('ordering')): ?>
										<div class="error" id="password_error" style="color: red"><?php echo form_error('ordering')?></div>
									<?php endif; ?>
								</div>
								<div class="form-group" style="width: 100%; min-height: 1px; overflow: hidden;">
									<label>Hình ảnh <span class = "maudo">(*)</span></label>
									<i> (Kích thước: 65px x 65px)</i>
									<div class="FileUpload image-product update-policies-dp">
										<?php 
											$listImagesProduct = json_decode($row['images']);
											for($i = 0; $i < sizeof($listImagesProduct); $i++) :
										?>
												<div class="file-up-2" data-position-img="<?php echo $i; ?>" data-change-image-product="true">
													<div>
														<?php if (isset($listImagesProduct[$i]) && $listImagesProduct[$i] != null && $listImagesProduct[$i] != '') : ?>
															<img src="<?php echo base_url() ?>upload/policies/<?php echo $listImagesProduct[$i] ?>">
														<?php else: ?>
															<img src="<?php echo base_url() ?>assets/images/icon_add.png">
														<?php endif; ?>
														<input type="file" name="images[]" class="input-upload" accept="image/*">
														<?php if (isset($listImagesProduct[$i]) && $listImagesProduct[$i] != null && $listImagesProduct[$i] != '') : ?>
															<span class='fa fa-times-circle' data-slider="<?php echo $row['id'] ?>"><span>
														<?php endif; ?>
													</div>
													
												</div>
										<?php 
											endfor;
										?>
									</div>
								</div>

								<div id="title-alt" class="form-group" style="clear: both; margin-top: 10px;">
									
									<?php 
										$title_image = json_decode($row['title_image']);
										$alt_image = json_decode($row['alt_image']);
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
									<label>Loại</label>
									<select name="type" class="form-control small-input" disabled>
										<option value="<?php echo POLICIES_TYPE_HOME_PAGE ?>" <?php if($row['type'] == POLICIES_TYPE_HOME_PAGE) {echo 'selected';}?> >Trang chủ</option>
										<option value="<?php echo POLICIES_TYPE_ORTHER ?>" <?php if($row['type'] == POLICIES_TYPE_ORTHER) {echo 'selected';}?>>Khác</option>
									</select>
								</div>
								<div class="">
									<button type = "submit" class="btn btn-success btn-sm btn-exit" role="button" data-toggle="tooltip" data-placement="top">
										Lưu</button>
									<a class="btn btn-default btn-sm" href="javascript:history.back();" role="button" data-toggle="tooltip" data-placement="top">
										Hủy
									</a>
								</div>
								<br/>
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