<?php echo form_open_multipart('admin/user/update/'.$row['id']); ?>

<div class="content-wrapper">

    <form action="<?php echo base_url() ?>admin/user/update/<?php echo $row['id']; ?>" enctype="multipart/form-data" method="POST" accept-charset="utf-8">

        <section class="content-header">

            <h1><i class="fa fa-user-plus"></i> Sửa tài khoản</h1>

        </section>

        <!-- Main content -->

        <section class="content">

            <div class="row">

                <div class="col-md-8">

                    <div class="box" id="view">

                        <div class="box-body">

                            <div class="form-group">

                                <label>Tên đăng nhập <span class = "maudo">(*)</span></label>

                                <input type="text" class="form-control" name="username" style="width:100%" value="<?php echo $row['username'] ?>" disabled>

                            </div>

                            <div class="form-group">

                                <label>Họ và tên <span class = "maudo">(*)</span></label>

                                <input type="text" class="form-control" required name="fullname" style="width:100%" value="<?php echo $row['fullname'] ?>">

                                <?php if (form_error('fullname')): ?>

                                    <div class="error" id="password_error"><?php echo form_error('fullname')?></div>

                                <?php endif; ?>

                            </div>

                            <div class="form-group">

                                <label>Điện thoại <span class = "maudo">(*)</span></label>

                                <input type="text" class="form-control" name="phone" style="width:100%" value="<?php echo $row['phone'] ?>" disabled>

                            </div>

                            <div class="form-group">

                                <label>Email <span class = "maudo">(*)</span></label>

                                <input type="email" class="form-control" name="email" style="width:100%" value="<?php echo $row['email'] ?>" disabled>

                            </div>

                            <div class="form-group">

                                <label>Địa chỉ</label>

                                <textarea name="address" class="form-control"><?php echo $row['address'] ?></textarea>

                            </div>

                            <div class="form-group">

                                <label>Ngày sinh</label>

                                <div class='input-group date' id='datetimepicker1' format='dd/mm/yyyy'>

                                    <input type='text' name="birthday" value="<?php echo $row['birthday'] ?>" class="form-control" placeholder=""/>

                                    <span class="input-group-addon">

                                        <span class="fa fa-calendar"></span>

                                    </span>

                                </div>

                                <div class="error error-birthday" style="margin-bottom: 10px;display: none;" id="password_error">Ngày sinh không hợp lệ, vượt quá ngày hiện tại hoặc nhỏ hơn 10 tuổi</div>

                            </div>
                            <div class="form-group">

                                <label>Mật khẩu mới</label>

                                <input type="text" class="form-control" name="new_password" style="width:100%">

                            </div>

                            <?php  if(isset($error)):?>

                               <div class="error2 marginTop10" style="font-size: 13px" id="password_error"><?php echo $error;?></div>

                            <?php endif;?>

                            <div class="">

                                <button type = "submit" class="btn btn-success btn-sm btn-exit" id='submit-form-update' role="button" data-toggle="tooltip" data-placement="top">

                                    Lưu</button>

                                <a class="btn btn-default btn-sm" href="<?php echo base_url() ?>admin/user.html" role="button" data-toggle="tooltip" data-placement="top">

                                    Hủy

                                </a>

                            </div>

                            <br/>

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