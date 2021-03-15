<?php echo form_open_multipart('admin/customer-feedback/insert'); ?>
<div class="content-wrapper">
	<form action="<?php echo base_url() ?>admin/customer-feedback/insert.html" enctype="multipart/form-data" method="POST" accept-charset="utf-8">
		<section class="content-header">
			<h1><i class="glyphicon glyphicon-text-background"></i> Thêm ý kiến khách hàng mới</h1>
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
				<div class="col-md-12">
					<div class="box" id="view">
						<div class="box-body">
							<?php //echo validation_errors(); ?>
							<div class="col-md-12">
								<div class="form-group">
									<label>Tên khách hàng<span class = "maudo">(*)</span></label>
									<input type="text" class="form-control" name="name_customer" required placeholder="Nhập tên khách hàng">
									<?php if(form_error('name_customer')): ?>
										<div class="error" id="password_error" style="color: red"><?php echo form_error('name_customer')?></div>
									<?php endif; ?>
								</div>
								<div class="form-group" style="width: 100%; min-height: 1px; overflow: hidden;">
									<label>Hình ảnh đại diện <span class = "maudo">(*)</span></label>
									<i> (Kích thước: 100px x 100px)</i>
									<div class="FileUpload image-product">
										<div class="file-up-2" data-position-img="0">
											<div>
												<img src="<?php echo base_url() ?>assets/images/icon_add.png">
												<input type="file" name="images[]" class="input-upload" accept="image/*" required>
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class='form-group col-md-6'>
					                    <label>Tiêu đề hình ảnh<span class = 'maudo'>(*)</span></label> 
					                    <input type='text' class='form-control' name='title_image[]' placeholder='Nhập tiêu đề hình ảnh' required>
					                    <?php if(form_error('title_image')): ?>
											<div class="error" id="password_error" style="color: red"><?php echo form_error('title_image')?></div>
										<?php endif; ?>
					                </div> 
					                <div class='form-group col-md-6'> 
					                    <label>Mô tả hình ảnh<span class = 'maudo'>(*)</span></label>
					                    <input type='text' class='form-control' name='alt_image[]' placeholder='Nhập mô tả hình ảnh' required>
					                    <?php if(form_error('alt_image')): ?>
											<div class="error" id="password_error" style="color: red"><?php echo form_error('alt_image')?></div>
										<?php endif; ?>
					                </div>
								</div>
								<div class="form-group">
									<label>Nội dung phải hồi</label>
									<textarea name="content" id="detail" class="form-control" ></textarea>
									<?php if(form_error('content')): ?>
										<div class="error" id="password_error" style="color: red"><?php echo form_error('content')?></div>
									<?php endif; ?>
								</div>
								
								<div class="">
									<button type = "submit" class="btn btn-success btn-sm btn-exit" role="button" data-toggle="tooltip" data-placement="top">
										THÊM</button>
									<a class="btn btn-default btn-sm" href="javascript:history.back();" role="button" data-toggle="tooltip" data-placement="top">
										THOÁT
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