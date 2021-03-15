<?php echo form_open_multipart('admin/content/update/'.$row['id']); ?>
<div class="content-wrapper">
	<form action="<?php echo base_url() ?>admin/content/insert.html" enctype="multipart/form-data" method="POST" accept-charset="utf-8" class="button-submit-content form-update-content" data-content="<?php echo $row['id'] ?>">
		<section class="content-header">
			<h1><i class="glyphicon glyphicon-text-background"></i> Cập nhật bài viết</h1>
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
									<div class="col-md-6">
										<div class="form-group">
											<label>Tiêu đề <span class = "maudo">(*)</span></label>
											<input type="text" class="form-control" value="<?php echo $row['title'] ?>" name="title" required placeholder="Nhập tiêu đề">
											<?php if(form_error('title')): ?>
												<div class="error" id="password_error" style="color: red"><?php echo form_error('title')?></div>
											<?php endif; ?>
										</div>
										<div class="form-group">
											<label>Đường dẫn thân thiện <span class = "maudo">(*)</span></label>
											<input type="text" class="form-control" value="<?php echo $row['alias'] ?>" name="alias" placeholder="Nhập tiêu đề">
											<?php if(form_error('alias')): ?>
												<div class="error" id="password_error" style="color: red"><?php echo form_error('alias')?></div>
											<?php endif; ?>
										</div>
										<div class="form-group">
											<label>Danh mục bài viết <span class = "maudo">(*)</span></label>
											<select name="category_id" id="" required class="form-control small-input">
												<?php 
													$detailCategory = $this->Mcategory->category_detail($row['category_id']);
												?>
												<option value="<?php echo $detailCategory['id'] ?>" selected><?php echo $detailCategory['name'] ?></option>
												<?php echo($htmlCategory) ?>
											</select>
										</div>
										<div class="form-group">
											<label>Thẻ Remarketing Google</label>
											<input type="text" value="<?php echo $row['seo_google'] ?>" class="form-control" name="seo_google" placeholder="Nhập thẻ remareting google">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>SEO Tiêu đề<span class = "maudo">(*)</span></label>
											<input type="text" value="<?php echo $row['seo_title'] ?>" class="form-control" required name="seo_title" placeholder="Nhập seo tiêu đề">
											<?php if(form_error('seo_title')): ?>
												<div class="error" id="password_error" style="color: red"><?php echo form_error('seo_title')?></div>
											<?php endif; ?>
										</div>
										<div class="form-group">
											<label>SEO Từ khóa<span class = "maudo">(*)</span></label>
											<input type="text" value="<?php echo $row['seo_keywords'] ?>" class="form-control" required name="seo_keywords" placeholder="Nhập seo từ khóa">
											<?php if(form_error('seo_keywords')): ?>
												<div class="error" id="password_error" style="color: red"><?php echo form_error('seo_keywords')?></div>
											<?php endif; ?>
										</div>
										<div class="form-group">
											<label>SEO Mô tả<span class = "maudo">(*)</span></label>
											<input type="text" value="<?php echo $row['seo_description'] ?>" class="form-control" required name="seo_description" placeholder="Nhập seo mô tả">
											<?php if(form_error('seo_description')): ?>
												<div class="error" id="password_error" style="color: red"><?php echo form_error('seo_description')?></div>
											<?php endif; ?>
										</div>
										<div class="form-group">
											<label>Thẻ Pixel Facebook</label>
											<input type="text" class="form-control" value="<?php echo $row['seo_facebook'] ?>" name="seo_facebook" placeholder="Nhập thẻ pixel facebook">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Loại <span class = "maudo">(*)</span></label>
											<select name="type" id="category_id_post" required class="form-control ">
												<option value="0" <?php if ($row['type'] == 0) { echo 'selected'; }?>>Bài viết thường</option>
												<option value="6" data-type="6" <?php if ($row['type'] == 6) { echo 'selected'; }?>>Bài viết video</option>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Đường dẫn video</label><i> (Chỉ nhập đối với loại Công trình đã thực hiện)</i>
											<input type="text" <?php if ($row['type'] != 6) { echo 'disabled'; } ?> id="urlVideo" class="form-control" name="urlVideo" placeholder="Nhập đường dẫn video" value="<?php echo $row['urlVideo'] ?>">
										</div>
									</div>
								</div>
								<div class="">
									<div class="form-group" style="width: 100%; min-height: 1px; overflow: hidden;">
										<label>Ảnh đại diện <span class = "maudo">(*)</span></label>
										<div class="FileUpload image-product update-content-dp">
											<?php 
												$listImagesProduct = json_decode($row['images']);
												for($i = 0; $i < sizeof($listImagesProduct); $i++) :
											?>
													<div class="file-up-2" data-position-img="<?php echo $i; ?>" data-change-image-product="true">
														<div>
															<?php if (isset($listImagesProduct[$i]) && $listImagesProduct[$i] != null && $listImagesProduct[$i] != '') : ?>
																<img src="<?php echo base_url() ?>upload/contents/<?php echo $listImagesProduct[$i] ?>">
															<?php else: ?>
																<img src="<?php echo base_url() ?>assets/images/icon_add.png">
															<?php endif; ?>
															<input type="file" name="images[]" class="input-upload" accept="image/*">
															<?php if (isset($listImagesProduct[$i]) && $listImagesProduct[$i] != null && $listImagesProduct[$i] != '') : ?>
																<span class='fa fa-times-circle' data-content="<?php echo $row['id'] ?>"><span>
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
									
									<div class="form-group">
										<label>Mô tả ngắn</label>
										<textarea name="short_description" placeholder="" id="detail" class="form-control" rows="5" cols="40" style="height: 108px;" required ><?php echo $row['short_description'] ?></textarea>
									</div>
									<div class="form-group">
										<label>Chi tiết bài viết</label>
										<textarea name="description" id="detail" class="form-control" >
											<?php echo $row['description'] ?>
										</textarea>
	      								<script>CKEDITOR.replace('description');</script>
									</div>
									<button type = "submit" class="btn btn-success btn-sm btn-exit" role="button" data-toggle="tooltip" data-placement="top" title="">
										LƯU</button>
									<a class="btn btn-default btn-sm" href="javascript:history.back();" role="button" data-toggle="tooltip" data-placement="top" title="">
										THOÁT</span>
									</a>
									<br><br>
								</div>
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
</div>