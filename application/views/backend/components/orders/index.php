<div class="content-wrapper">
	<section class="content-header">
		<h1><i class="glyphicon glyphicon-cd"></i> Quản lý đơn hàng</h1>
		<div class="breadcrumb">

		</div>
	</section>
	<?php $this->load->view('backend/modules/Loading'); ?>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box" id="view">
					<!-- /.box-header -->
					<div class="box-body">
						<?php  if($this->session->flashdata('success')):?>
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
	                    <nav class="navbar-filter navbar navbar-default">
							<div class="container">
								<div class="row">
									<div class="navbar-form navbar-left">
										<div class="form-group">
											<select placeholder="select" class="filter form-control" id='state'>
												<option value="-1" <?php if (!isset($state) || $state == null || $state == '' || $state == -1) echo 'selected'; ?>>[-- Chọn trạng thái --]</option>
												<option value="<?php echo STATE_ORDER_ORDERING ?>" <?php if ($state != null && $state == STATE_ORDER_ORDERING ) echo 'selected'; ?>>Đang đặt</option>
												<option value="<?php echo STATE_ORDER_PROCESSING ?>" <?php if ($state != null && $state == STATE_ORDER_PROCESSING) echo 'selected'; ?>>Đang xử lý</option>
												<option value="<?php echo STATE_ORDER_SHIPPING ?>" <?php if ($state != null && $state == STATE_ORDER_SHIPPING) echo 'selected'; ?>>Đang vận chuyển</option>
												<option value="<?php echo STATE_ORDER_COMPLETE ?>" <?php if ($state != null && $state == STATE_ORDER_COMPLETE) echo 'selected'; ?>>Hoàn tất</option>
												<option value="<?php echo STATE_ORDER_CANCEL ?>" <?php if ($state != null && $state == STATE_ORDER_CANCEL) echo 'selected'; ?>>Đã hủy</option>
											</select>
										</div>
										<div class="form-group">
								          	<div class="input-group date" id="dateFrom" style="width: 200px;" data-provide="datepicker">
											    <input type="text" value="<?php if(isset($_GET['from'])) { echo $_GET['from'];} ?>" name="dateFrom" class="form-control" placeholder="Ngày bắt đầu">
											    <div class="input-group-addon">
											        <span class="fa fa-calendar"></span>
											    </div>
											</div>
								        </div>
								        <div class="form-group">
								          	<div class='input-group date' id='dateTo' format='dd/mm/yyyy' style="width: 200px;">
								              	<input type='text' name="dateTo" value="<?php if(isset($_GET['to'])) { echo $_GET['to'];} ?>" class="form-control" placeholder="Ngày kết thúc" />
								              	<span class="input-group-addon">
								                  	<span class="fa fa-calendar"></span>
								              	</span>
								          	</div>
								        </div>
								        <div class="form-group">
								          	<div class="input-group" style="width: 200px;">
											    <input type="text" value="<?php if(isset($_GET['keyword'])) { echo $_GET['keyword'];} ?>" name="keyword" class="form-control" placeholder="Nhập mã đơn hàng">
											    <div class="input-group-addon icon-remove-keyword" style="cursor: pointer;">
											        <span class="fa fa-times"></span>
											    </div>
											</div>
								        </div>
									</div>
								</div>
							</div>
						</nav>
						<div class="row" style='padding:0px; margin:0px;' id='dataOrder'>
							<!--ND-->
							<div class="table-responsive">
								<table class="table table-hover table-bordered">
									<thead>
										<tr>
											<th class='active'>Mã đơn hàng</th>
											<th class='active'>Ngày đặt</th>
											<th class='active'>Khách hàng</th>
											<th class='active'>Tình trạng</th>
											<th class='active text-right'>Thành tiền</th>
											<th class="active text-center" style="width:80px">Thao tác</th>
										</tr>
									</thead>
									<tbody>
									<?php foreach ($list as $val):?>
										<tr 
											<?php switch ($val['state']) {
												case STATE_ORDER_ORDERING:
													echo 'style="background: #fff3cd"';
													break;
												case STATE_ORDER_PROCESSING:
													echo 'style="background: #cce5ff"';
													break;
												case STATE_ORDER_SHIPPING:
													echo 'style="background: #e2e3e5"';
													break;
												case STATE_ORDER_COMPLETE:
													echo 'style="background: #d4edda"';
													break;
												case STATE_ORDER_CANCEL:
													echo 'style="background: #d6d8d9"';
													break;
												default:
													break;
											} ?>
										>
											<td>
												<a href="<?php echo base_url() ?>admin/orders/view/<?php echo $val['orderCode'] ?>.html">
													<?php echo $val['orderCode'] ?>
												</a>
											</td>
											<td>
												<?php echo $val['createdAt'] ?>
											</td>
											<td>
												<?php echo $val['idUserOrder']['fullname'] ?>
											</td>
											<td>
												<?php switch ($val['state']) {
													case STATE_ORDER_ORDERING:
														echo 'Đang đặt';
														break;
													case STATE_ORDER_PROCESSING:
														echo 'Đang xử lý';
														break;
													case STATE_ORDER_SHIPPING:
														echo 'Đang vận chuyển';
														break;
													case STATE_ORDER_COMPLETE:
														echo 'Hoàn tất';
														break;
													case STATE_ORDER_CANCEL:
														echo 'Đã hủy';
														break;
													default:
														echo '';
														break;
												} ?>
											</td>
											<td class="text-right">
												<?php echo number_format($val['totalPrice']).CURRENTCY_UNIT; ?>
											</td>
											<td class="text-center">
												<a class="btn btn-success btn-xs" href="<?php echo base_url() ?>admin/orders/update/<?php echo $val['orderCode']?>.html" role = "button" title="Cập nhật đơn hàng">
													<span class="fa fa-edit"></span>
												</a>
											</td>
										</tr>
									<?php endforeach; ?>
									</tbody>
								</table>
								<div class="row">
									<div class="col-md-12 text-center">
										<ul class="pagination">
											<?php echo $strphantrang ?>
										</ul>
									</div>
								</div>
							</div>
							<!-- /.ND -->
						</div>
					</div><!-- ./box-body -->
				</div><!-- /.box -->
		</div>
		<!-- /.col -->
	  </div>
	  <!-- /.row -->
	</section>
<!-- /.content -->
</div><!-- /.content-wrapper -->
