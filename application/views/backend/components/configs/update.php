<?php echo form_open_multipart('admin/config/update/'.$detailSetting['id']); ?>
<div class="content-wrapper">
	<form action="<?php echo base_url() ?>admin/config/update/<?php echo $detailSetting['id']; ?>" enctype="multipart/form-data" method="POST" accept-charset="utf-8" class="update-product">
		<section class="content-header">
			<h1><i class="glyphicon glyphicon-text-background"></i> Cập nhật cấu hình</h1>
		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-md-12">
					<div class="box" id="view">
						<div class="box-body">
							<div class="col-md-12">
								<div class="form-group">
									<label>Tên cấu hình <span class = "maudo">(*)</span></label>
									<input type="text" class="form-control" value="<?php echo $detailSetting['name'] ?>" name="name" required placeholder="Nhập tên cấu hình">
									<?php if(form_error('name')): ?>
										<div class="error" id="password_error" style="color: red"><?php echo form_error('name')?></div>
									<?php endif; ?>
								</div>
								<?php 
									if ($detailSetting['code'] == CONFIG_CODE_SEO_WEB) :
								?>	
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Tiêu đề Website <span class = "maudo">(*)</span></label>
													<input type="text" class="form-control" value="<?php echo $detailSetting['value']->seoTitle; ?>" name="seoTitle" placeholder="Nhập tiêu đề website" required maxlength="70">
													<?php if(form_error('seoTitle')): ?>
														<div class="alert alert-danger">
					                                        <?php echo form_error('seoTitle'); ?>
					                                    </div>
													<?php endif; ?>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Từ khóa SEO <span class = "maudo">(*)</span></label>
													<input type="text" class="form-control" value="<?php echo $detailSetting['value']->seoKeywords; ?>" name="seoKeywords" placeholder="Nhập từ khóa" maxlength="160">
													<?php if(form_error('seoKeywords')): ?>
														<div class="alert alert-danger">
					                                        <?php echo form_error('seoKeywords'); ?>
					                                    </div>
													<?php endif; ?>
												</div>
												
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label>Mô tả Website<span class = "maudo">(*)</span></label>
													<textarea name="seoDescription" class="form-control" placeholder="Nhập mô tả website" maxlength="255" required style="height: 100px;"><?php echo $detailSetting['value']->seoDescription; ?></textarea>
													<?php if(form_error('seoDescription')): ?>
														<div class="alert alert-danger">
					                                        <?php echo form_error('seoDescription'); ?>
					                                    </div>
													<?php endif; ?>
												</div>
											</div>
										</div>
								<?php elseif($detailSetting['code'] == CONFIG_CODE_CONTACT_SHOP) : ?>
									<div class="form-group">
										<label>Địa chỉ cửa hàng<span class = "maudo">(*)</span></label>
										<input type="text" class="form-control" value="<?php echo $detailSetting['value']->addressShop; ?>" name="addressShop" placeholder="Nhập địa chỉ cửa hàng">
									</div>
									<div class="form-group">
										<label>Email cửa hàng<span class = "maudo">(*)</span></label>
										<input type="email" value="<?php echo $detailSetting['value']->emailShop; ?>" class="form-control" name="emailShop" placeholder="Nhập email cửa hàng">
									</div>
									<div class="form-group">
										<label>Điện thoại cửa hàng (Di động)<span class = "maudo">(*)</span></label>
										<input type="text" value="<?php echo $detailSetting['value']->hotlineShop ?>" class="form-control" name="hotlineShop" placeholder="Nhập điện thoại hotline">
									</div>
									<div class="form-group">
										<label>Điện thoại cửa hàng (Cố định)<span class = "maudo">(*)</span></label>
										<input type="text" value="<?php echo $detailSetting['value']->phoneShop; ?>" class="form-control" name="phoneShop" placeholder="Nhập điện thoại cửa hàng">
									</div>
									<div class="form-group">
										<label>Thời gian mở cửa<span class = "maudo">(*)</span></label>
										<input type="text" value="<?php echo $detailSetting['value']->timeOpenShop; ?>" class="form-control" name="timeOpenShop" placeholder="Nhập thời gian mở cửa">
									</div>
									<div class="form-group">
										<label>Số điện thoại hỗ trợ<span class = "maudo">(*)</span></label>
										<input type="text" value="<?php echo $detailSetting['value']->phoneSupport; ?>" class="form-control" name="phoneSupport" placeholder="Nhập số điện thoại hỗ trợ">
									</div>
								<?php elseif($detailSetting['code'] == CONFIG_CODE_LOGO || $detailSetting['code'] == CONFIG_CODE_LOGO_FOOTER) : ?>
									<div class="form-group" style="width: 100%; min-height: 1px; overflow: hidden;">
										<label>Logo <span class = "maudo">(*)</span></label>
										<div class="FileUpload image-product update-slider-dp">
											<?php 
												$listImagesProduct = json_decode($detailSetting['value']->images);
												for($i = 0; $i < sizeof($listImagesProduct); $i++) :
											?>
													<div class="file-up-2" data-position-img="<?php echo $i; ?>" data-change-image-product="true">
														<div>
															<?php if (isset($listImagesProduct[$i]) && $listImagesProduct[$i] != null && $listImagesProduct[$i] != '') : ?>
																<img src="<?php echo base_url() ?>upload/<?php echo $listImagesProduct[$i] ?>">
																<input type="file" name="images[]" class="input-upload" accept="image/*">
															<?php else: ?>
																<img src="<?php echo base_url() ?>assets/images/icon_add.png">
																<input type="file" name="images[]" class="input-upload" accept="image/*" required>
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
											$title_image = json_decode($detailSetting['value']->titleImages);
											$alt_image = json_decode($detailSetting['value']->altImages);
											$max = max(sizeof($title_image), sizeof($alt_image));
											for($i = 0; $i < $max; $i++) :
										?>
											<div class='row' data-position-alt-img="<?php echo $i; ?>">
								                <div class='form-group col-md-6'>
								                    <label>Tiêu đề hình ảnh<span class = 'maudo'>(*)</span></label> 
								                    <input type='text' value="<?php echo $title_image[$i] ?>" class='form-control' name='titleImages[]' placeholder='Nhập tiêu đề hình ảnh' required>
								                </div> 
								                <div class='form-group col-md-6'> 
								                    <label>Mô tả hình ảnh<span class = 'maudo'>(*)</span></label>
								                    <input type='text' value="<?php echo $alt_image[$i] ?>" class='form-control' name='altImages[]' placeholder='Nhập mô tả hình ảnh' required>
								                </div>
								            </div>
										<?php 
											endfor; 
										?>
										
									</div>
								<?php elseif($detailSetting['code'] == CONFIG_CODE_ICONS_CONTACT) : ?>
									<div class="form-group">
										<label>ID App Facebook <span class = 'maudo'>(*)</span></label>
										<input type="text" value="<?php echo $detailSetting['value']->idAppFacebook; ?>" required class="form-control" name="idAppFacebook" placeholder="Nhập id app facebook">
									</div>
									<div class="form-group">
										<label>Số điện thoại / Tên người dùng Zalo</label>
										<input type="text" value="<?php echo $detailSetting['value']->zalo; ?>" required class="form-control" name="zalo">
									</div>
									<div class="form-group">
										<label>Đường dẫn Messenger</label>
										<input type="text" value="<?php echo $detailSetting['value']->urlMessengerFacebook; ?>" required class="form-control" name="urlMessengerFacebook">
									</div>
									<div class="form-group">
										<label>Đường dẫn Google Maps</label>
										<input type="text" value="<?php echo $detailSetting['value']->urlGoogleMaps; ?>" required class="form-control" name="urlGoogleMaps">
									</div>
									<div class="form-group">
										<label>Frame Subiz Chat</label>
										<textarea name="frameSubizChat" class="form-control" style="height: 100px;"><?php echo $detailSetting['value']->frameSubizChat; ?></textarea>
									</div>
								<?php 
									elseif ($detailSetting['code'] == CONFIG_CODE_MAIL_SMTP) :
								?>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Email Host<span class = "maudo">(*)</span></label>
													<input type="text" class="form-control" value="<?php echo $detailSetting['value']->mailHost; ?>" name="mailHost" placeholder="Nhập email host" required>
													<?php if(form_error('mailHost')): ?>
														<div class="alert alert-danger">
					                                        <?php echo form_error('mailHost'); ?>
					                                    </div>
													<?php endif; ?>
												</div>
												<div class="form-group">
													<label>Email NoReply<span class = "maudo">(*)</span></label>
													<input type="email" class="form-control" value="<?php echo $detailSetting['value']->mailNoReply; ?>" name="mailNoReply" placeholder="Nhập email no reply" required>
													<?php if(form_error('mailNoReply')): ?>
														<div class="alert alert-danger">
					                                        <?php echo form_error('mailNoReply'); ?>
					                                    </div>
													<?php endif; ?>
												</div>
												<div class="form-group">
													<label>Email SMTP Password<span class = "maudo">(*)</span></label>
													<input type="text" class="form-control" value="<?php echo $detailSetting['value']->mailSMTPPass; ?>" name="mailSMTPPass" placeholder="Nhập mật khẩu email smtp" required>
													<?php if(form_error('mailSMTPPass')): ?>
														<div class="alert alert-danger">
					                                        <?php echo form_error('mailSMTPPass'); ?>
					                                    </div>
													<?php endif; ?>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Email Port<span class = "maudo">(*)</span></label>
													<input type="text" class="form-control" value="<?php echo $detailSetting['value']->mailPort; ?>" name="mailPort" placeholder="Nhập email port" required>
													<?php if(form_error('mailPort')): ?>
														<div class="alert alert-danger">
					                                        <?php echo form_error('mailPort'); ?>
					                                    </div>
													<?php endif; ?>
												</div>
												<div class="form-group">
													<label>Email SMTP User<span class = "maudo">(*)</span></label>
													<input type="email" class="form-control" value="<?php echo $detailSetting['value']->mailSMTPUser; ?>" name="mailSMTPUser" placeholder="Nhập email SMTP user" required>
													<?php if(form_error('mailSMTPUser')): ?>
														<div class="alert alert-danger">
					                                        <?php echo form_error('mailSMTPUser'); ?>
					                                    </div>
													<?php endif; ?>
												</div>
												<div class="form-group">
													<label>Email cửa hàng <b>(Dùng để nhận thông báo khi có đơn hàng mới)</b><span class = "maudo">(*)</span></label>
													<input type="email" class="form-control" value="<?php echo $detailSetting['value']->emailStore; ?>" name="emailStore" placeholder="Nhập email cửa hàng" required>
													<?php if(form_error('emailStore')): ?>
														<div class="alert alert-danger">
					                                        <?php echo form_error('emailStore'); ?>
					                                    </div>
													<?php endif; ?>
												</div>
											</div>
										</div>
								<?php 
									else:
								?>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Mô tả về chúng tôi</label>
												<textarea class="form-control" name="shopDesc" placeholder="" maxlength="500" require style="height: 50px;" required><?php echo $detailSetting['value']->shopDesc; ?></textarea>
											</div>
											<div class="form-group">
												<label>Frame Facebook</label>
												<textarea class="form-control" name="frameFanpageFacebook" placeholder="" maxlength="500" require style="height: 50px;" required><?php echo $detailSetting['value']->frameFanpageFacebook; ?></textarea>
											</div>
											<div class="form-group">
												<label>Số ĐKKD</label>
												<input type="text" class="form-control" value="<?php echo $detailSetting['value']->businessRegistrationNumber; ?>" name="businessRegistrationNumber" placeholder="Nhập số đăng ký kinh doanh" required>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Frame Google Maps</label>
												<textarea class="form-control" name="frameGoogleMaps" placeholder="" maxlength="500" require style="height: 50px;" required><?php echo $detailSetting['value']->frameGoogleMaps; ?></textarea>
											</div>
											<div class="form-group">
												<label>Tên công ty</label>
												<input type="text" class="form-control" value="<?php echo $detailSetting['value']->companyName; ?>" name="companyName" placeholder="Nhập tên công ty" required style="height: 50px;">
											</div>
											<div class="form-group">
												<label>Cấp bởi</label>
												<input type="text" class="form-control" value="<?php echo $detailSetting['value']->issuedBy; ?>" name="issuedBy" placeholder="Nhập tên đơn vị cấp giấy đăng ký kinh doanh" required>
											</div>
										</div>
									</div>
								<?php 
									endif;
								?>
								<div class="">
									<button type = "submit" class="btn btn-success btn-sm btn-exit" role="button" data-toggle="tooltip" data-placement="top">
										LƯU</button>
									<a class="btn btn-default btn-sm" href="admin/configs.html" role="button" data-toggle="tooltip" data-placement="top">
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