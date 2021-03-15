<?php echo form_open_multipart('admin/agency/update/'.$row['id']); ?>
<div class="content-wrapper">
	<form action="<?php echo base_url() ?>admin/agency/update/<?php echo $row['id']; ?>" enctype="multipart/form-data" method="POST" accept-charset="utf-8">
		<section class="content-header">
			<h1><i class="glyphicon glyphicon-text-background"></i> Cập nhật đối tác</h1>
		</section>
		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-md-12">
					<div class="box" id="view">
						<div class="box-body">
							<?php //echo validation_errors(); ?>
							<div class="col-md-12">
								<div class="row">
									<div class="col-sm-12 col-md-6">
										<div class="form-group">
											<label>Tên đối tác<span class = "maudo">(*)</span></label>
											<input type="text" class="form-control" value="<?php echo $row['name'] ?>" name="name" required placeholder="Nhập tên">
											<?php if(form_error('name')): ?>
												<div class="error" id="password_error" style="color: red"><?php echo form_error('name')?></div>
											<?php endif; ?>
										</div>
									</div>
									<div class="col-sm-12 col-md-6">
										<div class="form-group">
											<label>Đường dẫn trỏ đến</label>
											<input type="text" value="<?php echo $row['link_ads'] ?>" class="form-control" name="link_ads" placeholder="Nhập đường dẫn trỏ đến">
											<?php if(form_error('link_ads')): ?>
												<div class="error" id="password_error" style="color: red"><?php echo form_error('link_ads')?></div>
											<?php endif; ?>
										</div>
									</div>
								</div>
								<div class="form-group" style="width: 100%; min-height: 1px; overflow: hidden;">
									<label>Hình ảnh <span class = "maudo">(*)</span></label>
									<div class="FileUpload image-product update-agency-dp">
										<?php 
											$listImagesProduct = json_decode($row['images']);
											for($i = 0; $i < sizeof($listImagesProduct); $i++) :
										?>
												<div class="file-up-2" data-position-img="<?php echo $i; ?>" data-change-image-product="true">
													<div>
														<?php if (isset($listImagesProduct[$i]) && $listImagesProduct[$i] != null && $listImagesProduct[$i] != '') : ?>
															<img src="<?php echo base_url() ?>upload/agencies/<?php echo $listImagesProduct[$i] ?>">
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