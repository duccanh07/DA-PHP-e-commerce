<?php echo form_open_multipart('admin/category/insert'); ?>
<div class="content-wrapper">
	<form action="<?php echo base_url() ?>admin/category/insert.html" enctype="multipart/form-data" method="POST" accept-charset="utf-8">
		<section class="content-header">
			<h1><i class="glyphicon glyphicon-text-background"></i> Thêm danh mục mới</h1>
		</section>
		<!-- Main content -->
		<section class="content">
			<?php  if($this->session->flashdata('error')):?>
                <div class="row">
                    <div class="alert alert-error">
                        <?php echo $this->session->flashdata('error'); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>
                </div>
            <?php  endif;?>
			<div class="row">
				<div class="col-md-8">
					<div class="box" id="view">
						<div class="box-body">
							<div class="col-md-12">
								<div class="form-group">
									<label>Tên danh mục <span class = "maudo">(*)</span></label>
									<input type="text" class="form-control" name="name" required placeholder="Nhập tên danh mục">
									<?php if(form_error('name')): ?>
											<div class="error" id="password_error" style="color: red"><?php echo form_error('name')?></div>
										<?php endif; ?>
								</div>
								<div class="form-group">
									<label>Đường dẫn thân thiện <span class = "maudo">(*)</span></label>
									<input type="text" class="form-control" name="alias" placeholder="Nhập đường dẫn thân thiện">
									<?php if(form_error('alias')): ?>
											<div class="error" id="password_error" style="color: red"><?php echo form_error('alias')?></div>
										<?php endif; ?>
								</div>
								<div class="form-group">
									<label>Danh mục cha <span class = "maudo">(*)</span></label>
									<select name="parent_id" required class="form-control small-input">
										<option value="<?php echo DEFAULT_PARENT_ID ?>">Danh mục cấp cao nhất</option>
										<?php echo($htmlCategory) ?>
									</select>
								</div>
								<div class="form-group">
									<label>Loại danh mục <span class = "maudo">(*)</span></label>
									<select name="type" required class="form-control small-input">
										<option value="<?php echo TYPE_CATEGORY_HOME ?>">Trang chủ</option>
										<option value="<?php echo TYPE_CATEGORY_PRODUCT ?>">DS sản phẩm</option>
										<option value="<?php echo TYPE_CATEGORY_CONTENT ?>">DS bài viết</option>
										<option value="<?php echo TYPE_CATEGORY_PRODUCT_ONE ?>">Sản phẩm đơn</option>
										<option value="<?php echo TYPE_CATEGORY_CONTENT_ONE ?>">Bài viết đơn</option>
										<option value="<?php echo TYPE_CATEGORY_DU_AN ?>">DS bài viết dự án</option>
										<option value="<?php echo TYPE_CATEGORY_VIDEO_CONG_TRINH ?>">DS video công trình</option>
									</select>
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
								<div class="form-group">
									<label>Icon</label>
									<i>(Chọn icon tại: fontawesome.io, chỉ điền class vào. Ví dụ: fa fa-user)</i>
									<input type="text" class="form-control" name="fa_icons" placeholder="Nhập class fontawesome">
									<?php if(form_error('fa_icons')): ?>
										<div class="error" id="password_error" style="color: red"><?php echo form_error('fa_icons')?></div>
									<?php endif; ?>
								</div>
								<!-- <div class="form-group">
									<label>Icon danh mục</label>
									<input type="file" name="files" id="multiFiles"/>
									<div class="gallery banner-ads" id = "list-gallery"></div>
								</div>
								<div class="form-group">
									<label>Tiêu đề Icon <span class = "maudo">(*)</span></label>
									<input type="text" class="form-control" name="title_image" placeholder="Nhập tiêu đề hình ảnh">
									<?php if(form_error('title_image')): ?>
											<div class="error" id="password_error" style="color: red"><?php echo form_error('title_image')?></div>
										<?php endif; ?>
								</div>
								<div class="form-group">
									<label>Alt Icon <span class = "maudo">(*)</span></label>
									<input type="text" class="form-control" name="alt_image" placeholder="Nhập alt hình ảnh">
									<?php if(form_error('alt_image')): ?>
											<div class="error" id="password_error" style="color: red"><?php echo form_error('alt_image')?></div>
										<?php endif; ?>
								</div> -->
								<div class="form-group">
									<label>Sắp xếp <span class = "maudo">(*)</span></label>
									<input type="number" min="1" step="1" class="form-control small-input" name="ordering" placeholder="Nhập sắp xếp" required>
									<?php if(form_error('ordering')): ?>
										<div class="error" id="password_error" style="color: red"><?php echo form_error('ordering')?></div>
									<?php endif; ?>
								</div>
								<div class="form-group">
									<label>Mô tả danh mục</label>
									<textarea name="description" id="detail" class="form-control" ></textarea>
      								<script>CKEDITOR.replace('description');</script>
								</div>
								<div class="">
									<button type = "submit" class="btn btn-success btn-sm btn-exit" role="button" data-toggle="tooltip" data-placement="top" title="">
										Thêm</button>
									<a class="btn btn-default btn-sm" href="javascript:history.back();" role="button" data-toggle="tooltip" data-placement="top" title="">
										Thoát</span>
									</a>
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
</div><!-- /.content-wrapper -->