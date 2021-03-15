<div class="content-wrapper">
	<form action="<?php echo base_url() ?>admin/setting/index" enctype="multipart/form-data" method="POST" accept-charset="utf-8">
		<section class="content-header">
			<h1><i class="glyphicon glyphicon-text-background"></i> Cập nhật cấu hình</h1>
			
		</section>
		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-md-12">
					<div class="box" id="view">
						<div class="box-body">
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
									<div class="form-group box-wrapper">
										<label>CẤU HÌNH SEO</label>
										<div class="form-group">
											<label>Tiêu đề Website <span class = "maudo">(*)</span></label>
											<input type="text" class="form-control" value="<?php echo $detailSetting['seo_title'] ?>" name="seo_title" placeholder="Nhập tiêu đề website" required>
											<?php if(form_error('seo_title')): ?>
												<div class="error" id="password_error" style="color: red"><?php echo form_error('seo_title')?></div>
											<?php endif; ?>
										</div>
										<div class="form-group">
											<label>Mô tả Website</label>
											<input type="text" class="form-control" value="<?php echo $detailSetting['seo_description'] ?>" name="seo_description" placeholder="Nhập mô tả website">
											<?php if(form_error('seo_description')): ?>
												<div class="error" id="password_error" style="color: red"><?php echo form_error('seo_description')?></div>
											<?php endif; ?>
										</div>
										<div class="form-group">
											<label>Từ khóa SEO</label>
											<input type="text" class="form-control" value="<?php echo $detailSetting['seo_keywords'] ?>" name="seo_keywords" placeholder="Nhập từ khóa">
											<?php if(form_error('seo_keywords')): ?>
												<div class="error" id="password_error" style="color: red"><?php echo form_error('seo_keywords')?></div>
											<?php endif; ?>
										</div>
									</div>
									<br />
									<div class="form-group box-wrapper">
										<label>CẤU HÌNH CỬA HÀNG</label>
										<div class="form-group">
											<label>Địa chỉ cửa hàng</label>
											<input type="text" class="form-control" value="<?php echo $detailSetting['address_shop'] ?>" name="address_shop" placeholder="Nhập địa chỉ cửa hàng">
											<?php if(form_error('address_shop')): ?>
												<div class="error" id="password_error" style="color: red"><?php echo form_error('address_shop')?></div>
											<?php endif; ?>
										</div>
										<div class="form-group">
											<label>Email cửa hàng</label>
											<input type="email" value="<?php echo $detailSetting['email_shop'] ?>" class="form-control" name="email_shop" placeholder="Nhập email cửa hàng">
											<?php if(form_error('email_shop')): ?>
												<div class="error" id="password_error" style="color: red"><?php echo form_error('email_shop')?></div>
											<?php endif; ?>
										</div>
										<div class="form-group">
											<label>Điện thoại cửa hàng (Hotline)</label>
											<input type="text" value="<?php echo $detailSetting['hotline_shop'] ?>" class="form-control" name="hotline_shop" placeholder="Nhập điện thoại hotline">
											<?php if(form_error('hotline_shop')): ?>
												<div class="error" id="password_error" style="color: red"><?php echo form_error('hotline_shop')?></div>
											<?php endif; ?>
										</div>
										<div class="form-group">
											<label>Điện thoại cửa hàng (ĐT Bàn)</label>
											<input type="text" value="<?php echo $detailSetting['phone_shop'] ?>" class="form-control" name="phone_shop" placeholder="Nhập điện thoại cửa hàng">
											<?php if(form_error('phone_shop')): ?>
												<div class="error" id="password_error" style="color: red"><?php echo form_error('phone_shop')?></div>
											<?php endif; ?>
										</div>
										<div class="form-group">
											<label>Thời gian mở cửa</label>
											<input type="text" value="<?php echo $detailSetting['time_open_shop'] ?>" class="form-control" name="time_open_shop" placeholder="Nhập thời gian mở cửa">
											<?php if(form_error('time_open_shop')): ?>
												<div class="error" id="password_error" style="color: red"><?php echo form_error('time_open_shop')?></div>
											<?php endif; ?>
										</div>
										<div class="form-group">
											<label title="Chỉ nên điền đúng định dạng số điện thoại, vì đây được dùng để liên lạc">Số điện thoại hỗ trợ <span class = "maudo">(*)</span></label>
											<input type="text" value="<?php echo $detailSetting['phone_support'] ?>" class="form-control" name="phone_support" placeholder="Nhập số điện thoại hỗ trợ khách hàng" required>
											<?php if(form_error('phone_support')): ?>
												<div class="error" id="password_error" style="color: red"><?php echo form_error('phone_support')?></div>
											<?php endif; ?>
										</div>
										<div class="form-group">
											<label>ID App Facebook <span class = "maudo">(*)</span></label>
											<textarea name="id_app_facebook" placeholder="Nhập id app facebook" id="detail" class="form-control" rows="5" cols="40" style="height: 82px;" required ><?php echo $detailSetting['id_app_facebook'] ?></textarea>
											<?php if(form_error('id_app_facebook')): ?>
												<div class="error" id="password_error" style="color: red"><?php echo form_error('id_app_facebook')?></div>
											<?php endif; ?>
										</div>
										
									</div>
								</div>	
								<div class="col-md-6">
									<div class="form-group box-wrapper">
										<label>CẤU HÌNH LIÊN HỆ</label>
										<div class="form-group">
											<label>Số điện thoại / Tên người dùng Zalo</label>
											<input type="text" class="form-control" name="zalo" value="<?php echo $detailSetting['zalo'] ?>" placeholder="Nhập số điện thoại hoặc tên người dùng zalo">
											<?php if(form_error('zalo')): ?>
												<div class="error" id="password_error" style="color: red"><?php echo form_error('zalo')?></div>
											<?php endif; ?>
										</div>
										<div class="form-group">
											<label>Đường dẫn Messenger</label>
											<input type="text" class="form-control" value="<?php echo $detailSetting['url_messenger_facebook'] ?>" name="url_messenger_facebook" placeholder="Nhập đường dẫn messenger" required>
											<?php if(form_error('url_messenger_facebook')): ?>
												<div class="error" id="password_error" style="color: red"><?php echo form_error('url_messenger_facebook')?></div>
											<?php endif; ?>
										</div>
										<div class="form-group">
											<label>Đường dẫn Google Maps</label>
											<input type="text" class="form-control" value="<?php echo $detailSetting['url_google_maps'] ?>" name="url_google_maps" placeholder="Nhập đường dẫn google maps">
											<?php if(form_error('url_google_maps')): ?>
												<div class="error" id="password_error" style="color: red"><?php echo form_error('url_google_maps')?></div>
											<?php endif; ?>
										</div>
										<div class="form-group">
											<label>Frame Subiz Chat <span class = "maudo">(*)</span></label>
											<textarea name="frame_subiz_chat" placeholder="Nhập subiz chat" id="detail" class="form-control" rows="5" cols="40" style="height: 50px;" ><?php echo $detailSetting['frame_subiz_chat'] ?></textarea>
											<?php if(form_error('frame_subiz_chat')): ?>
												<div class="error" id="frame_subiz_chat" style="color: red"><?php echo form_error('frame_subiz_chat')?></div>
											<?php endif; ?>
										</div>
									</div>
									<br />
									<div class="form-group box-wrapper">
										<label>CẤU HÌNH FOOTER</label>
										<div class="form-group">
											<label>Mô tả về chúng tôi</label>
											<input type="text" class="form-control" value="<?php echo $detailSetting['shop_desc'] ?>" name="shop_desc" placeholder="Nhập mô tả về chúng tôi ở footer">
											<?php if(form_error('shop_desc')): ?>
												<div class="error" id="password_error" style="color: red"><?php echo form_error('shop_desc')?></div>
											<?php endif; ?>
										</div>
										<div class="form-group">
											<label>Frame Google Maps <span class = "maudo">(*)</span></label>
											<textarea name="frame_google_maps" placeholder="Nhập frame google map" id="detail" class="form-control" rows="5" cols="40" style="height: 50px;" required ><?php echo $detailSetting['frame_google_maps'] ?></textarea>
											<?php if(form_error('frame_google_maps')): ?>
												<div class="error" id="password_error" style="color: red"><?php echo form_error('frame_google_maps')?></div>
											<?php endif; ?>
										</div>
										<div class="form-group">
											<label>Frame Facebook <span class = "maudo">(*)</span></label>
											<textarea name="frame_fanpage_facebook" placeholder="Nhập frame facebook" id="detail" class="form-control" rows="5" cols="40" style="height: 50px;" required ><?php echo $detailSetting['frame_fanpage_facebook'] ?></textarea>
											<?php if(form_error('frame_fanpage_facebook')): ?>
												<div class="error" id="password_error" style="color: red"><?php echo form_error('frame_fanpage_facebook')?></div>
											<?php endif; ?>
										</div>
										<!-- <div class="form-group">
											<label>Link Fanpage Facebook</label>
											<input type="text" class="form-control" value="<?php echo $detailSetting['fanpage_facebook'] ?>" name="fanpage_facebook" placeholder="Nhập đường dẫn fanpage facebook">
											<?php if(form_error('fanpage_facebook')): ?>
												<div class="error" id="password_error" style="color: red"><?php echo form_error('fanpage_facebook')?></div>
											<?php endif; ?>
										</div> -->
										<div class="form-group">
											<label>Tên công ty <span class = "maudo">(*)</span></label>
											<input type="text" class="form-control" value="<?php echo $detailSetting['company_name'] ?>" name="company_name" placeholder="Nhập tên công ty" required>
											<?php if(form_error('company_name')): ?>
												<div class="error" id="password_error" style="color: red"><?php echo form_error('company_name')?></div>
											<?php endif; ?>
										</div>
										<div class="form-group">
											<label>Số ĐKKD <span class = "maudo">(*)</span></label>
											<input type="text" value="<?php echo $detailSetting['business_registration_number'] ?>" class="form-control" name="business_registration_number" placeholder="Nhập số đăng ký kinh doanh" required>
											<?php if(form_error('business_registration_number')): ?>
												<div class="error" id="password_error" style="color: red"><?php echo form_error('business_registration_number')?></div>
											<?php endif; ?>
										</div>
										<div class="form-group">
											<label>Đơn vị cấp <span class = "maudo">(*)</span></label>
											<input type="text" value="<?php echo $detailSetting['issued_by'] ?>" class="form-control" name="issued_by" placeholder="Nhập tên đơn vị cấp" required>
											<?php if(form_error('issued_by')): ?>
												<div class="error" id="password_error" style="color: red"><?php echo form_error('issued_by')?></div>
											<?php endif; ?>
										</div>

									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group box-wrapper">
										<label>CẤU HÌNH EMAIL</label>
										<div class="form-group">
											<label>Email Norepy<span class = "maudo">(*)</span></label>
											<input type="email" value="<?php echo $detailSetting['mail_noreply'] ?>" required class="form-control" name="mail_noreply" placeholder="">
											<?php if(form_error('mail_noreply')): ?>
												<div class="error" id="password_error" style="color: red"><?php echo form_error('mail_noreply')?></div>
											<?php endif; ?>
										</div>
										<div class="form-group">
											<label>User Email SMTP<span class = "maudo">(*)</span></label>
											<input type="email" value="<?php echo $detailSetting['smtp_user'] ?>" required class="form-control" name="smtp_user" placeholder="">
											<?php if(form_error('smtp_user')): ?>
												<div class="error" id="password_error" style="color: red"><?php echo form_error('smtp_user')?></div>
											<?php endif; ?>
										</div>
										<div class="form-group">
											<label>Mật khẩu Email SMTP<span class = "maudo">(*)</span></label>
											<input type="text" value="<?php echo $detailSetting['smtp_pass'] ?>" required class="form-control" name="smtp_pass" placeholder="">
											<?php if(form_error('smtp_pass')): ?>
												<div class="error" id="password_error" style="color: red"><?php echo form_error('smtp_pass')?></div>
											<?php endif; ?>
										</div>
										<div class="form-group">
											<label>Email cửa hàng (Dùng để nhận thông báo khi có đơn hàng mới)<span class = "maudo">(*)</span></label>
											<input type="email" value="<?php echo $detailSetting['email_store'] ?>" required class="form-control" name="email_store" placeholder="">
											<?php if(form_error('email_store')): ?>
												<div class="error" id="password_error" style="color: red"><?php echo form_error('email_store')?></div>
											<?php endif; ?>
										</div>
									</div>
								</div>
								<div class="col-md-6" style="display: none;">
									<div class="form-group box-wrapper">
										<label>CẤU HÌNH MẠNG XÃ HỘI</label>
										<div class="form-group">
											<label>Đường dẫn kênh Youtube</label>
											<input type="text" value="<?php echo $detailSetting['url_chanel_youtube'] ?>" required class="form-control" name="url_chanel_youtube" placeholder="">
											<?php if(form_error('url_chanel_youtube')): ?>
												<div class="error" id="password_error" style="color: red"><?php echo form_error('url_chanel_youtube')?></div>
											<?php endif; ?>
										</div>
										<div class="form-group">
											<label>Đường dẫn Google Plus</label>
											<input type="text" value="<?php echo $detailSetting['url_google_plus'] ?>" required class="form-control" name="url_google_plus" placeholder="">
											<?php if(form_error('url_google_plus')): ?>
												<div class="error" id="password_error" style="color: red"><?php echo form_error('url_google_plus')?></div>
											<?php endif; ?>
										</div>
										<div class="form-group">
											<label>Đường dẫn Twitter</label>
											<input type="text" value="<?php echo $detailSetting['url_twitter'] ?>" required class="form-control" name="url_twitter" placeholder="">
											<?php if(form_error('url_twitter')): ?>
												<div class="error" id="password_error" style="color: red"><?php echo form_error('url_twitter')?></div>
											<?php endif; ?>
										</div>
										<div class="form-group">
											<label>Đường dẫn Linkedin</label>
											<input type="text" value="<?php echo $detailSetting['url_linkedin'] ?>" required class="form-control" name="url_linkedin" placeholder="">
											<?php if(form_error('url_linkedin')): ?>
												<div class="error" id="password_error" style="color: red"><?php echo form_error('url_linkedin')?></div>
											<?php endif; ?>
										</div>
										<div class="form-group">
											<label>Đường dẫn Instagram</label>
											<input type="text" value="<?php echo $detailSetting['url_instagram'] ?>" required class="form-control" name="url_instagram" placeholder="">
											<?php if(form_error('url_instagram')): ?>
												<div class="error" id="password_error" style="color: red"><?php echo form_error('url_instagram')?></div>
											<?php endif; ?>
										</div>
										<div class="form-group">
											<label>Đường dẫn Pinterest</label>
											<input type="text" value="<?php echo $detailSetting['url_pinterest'] ?>" required class="form-control" name="url_pinterest" placeholder="">
											<?php if(form_error('url_pinterest')): ?>
												<div class="error" id="password_error" style="color: red"><?php echo form_error('url_pinterest')?></div>
											<?php endif; ?>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<?php if (isset($errorForm)): ?>
                                    <div class="error" id="password_error"><?php echo $errorForm ?></div>
                                <?php endif; ?>
								<button type = "submit" class="btn btn-success btn-sm" role="button" data-toggle="tooltip" data-placement="top" title="">
									LƯU</button>
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
