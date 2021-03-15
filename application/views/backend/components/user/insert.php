<?php echo form_open_multipart('admin/user/insert'); ?>
<div class="content-wrapper">
    <form action="<?php echo base_url() ?>admin/user/insert.html" enctype="multipart/form-data" method="POST" accept-charset="utf-8">
        <section class="content-header">
            <h1><i class="fa fa-user-plus"></i> Thêm tài khoản</h1>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-8">
                    <div class="box" id="view">
                        <div class="box-body">
                            <div class="col-md-12" style="padding-left: 0px">
                                <div class="form-group">
                                    <label>Tên đăng nhập <span class = "maudo">(*)</span></label>
                                    <input type="text" class="form-control" required name="username" style="width:100%">
                                    <?php if (form_error('username')): ?>
                                        <div class="error" id="password_error"><?php echo form_error('username')?></div>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label>Họ và tên <span class = "maudo">(*)</span></label>
                                    <input type="text" class="form-control" required name="fullname" style="width:100%">
                                    <?php if (form_error('fullname')): ?>
                                        <div class="error" id="password_error"><?php echo form_error('fullname')?></div>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label>Điện thoại</label>
                                    <input type="text" class="form-control" name="phone" style="width:100%">
                                    <?php if (form_error('phone')): ?>
                                        <div class="error" id="password_error"><?php echo form_error('phone')?></div>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email" style="width:100%">
                                    <?php if (form_error('email')): ?>
                                        <div class="error" id="password_error"><?php echo form_error('email')?></div>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label>Mật khẩu <span class = "maudo">(*)</span></label>
                                    <input type="password" class="form-control" required name="password" style="width:100%">
                                    <?php if (form_error('password')): ?>
                                        <div class="error" id="password_error"><?php echo form_error('password')?></div>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label>Địa chỉ</label>
                                    <textarea name="address" class="form-control" ></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Ngày sinh</label>
                                    <div class='input-group date' id='datetimepicker1' format='dd/mm/yyyy'>
                                        <input type='text' name="birthday" class="form-control" placeholder=""/>
                                        <span class="input-group-addon">
                                            <span class="fa fa-calendar"></span>
                                        </span>
                                    </div>
                                    <div class="error error-birthday" style="margin-bottom: 10px;display: none;" id="password_error">Ngày sinh không hợp lệ, vượt quá ngày hiện tại hoặc nhỏ hơn 10 tuổi</div>
                                </div>
                                <?php if (isset($errorForm)): ?>
                                    <div class="error" id="password_error"><?php echo $errorForm ?></div>
                                <?php endif; ?>
                                <div class="">
                                    <button type = "submit" id="submit-form-update" class="btn btn-success btn-sm btn-exit" role="button" data-toggle="tooltip" data-placement="top">
                                        Thêm</button>
                                    <a class="btn btn-default btn-sm" href="<?php echo base_url() ?>admin/user.html" role="button" data-toggle="tooltip" data-placement="top">
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