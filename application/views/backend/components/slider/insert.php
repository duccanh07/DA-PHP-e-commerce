<?php echo form_open_multipart('admin/slider/insert'); ?>
<div class="content-wrapper">
	<form action="<?php echo base_url() ?>admin/slider/insert.html" enctype="multipart/form-data" method="POST" accept-charset="utf-8">
		<section class="content-header">
			<h1><i class="glyphicon glyphicon-text-background"></i> Thêm slider mới</h1>
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
								<div class="row">
									<div class="col-xs-12 col-md-6">
										<div class="form-group">
											<label>Tên<span class = "maudo">(*)</span></label>
											<input type="text" class="form-control" name="name" required placeholder="Nhập tên">
											<?php if(form_error('name')): ?>
												<div class="error" id="password_error" style="color: red"><?php echo form_error('name')?></div>
											<?php endif; ?>
										</div>
									</div>
									<div class="col-xs-12 col-md-6">
										<div class="form-group">
											<label>Đường dẫn trỏ đến</label>
											<input type="text" class="form-control" name="link_ads" placeholder="Nhập đường dẫn trỏ đến">
											<?php if(form_error('link_ads')): ?>
												<div class="error" id="password_error" style="color: red"><?php echo form_error('link_ads')?></div>
											<?php endif; ?>
										</div>
									</div>
								</div>
								<div class="form-group" style="width: 100%; min-height: 1px; overflow: hidden;">
									<label>Hình ảnh <span class = "maudo">(*)</span></label>
									<i> (Kích thước: 1366px x 555px)</i>
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
								
								<div class="">
									<button type = "submit" class="btn btn-success btn-sm btn-exit" role="button" data-toggle="tooltip" data-placement="top">
										Thêm</button>
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