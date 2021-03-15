<div class="content-wrapper">
	<section class="content-header">
		<h1><i class="glyphicon glyphicon-cd"></i> Danh sách khách hàng</h1>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box" id="view">
					<!-- /.box-header -->
					<div class="box-body">
						<?php  if($this->session->flashdata('success')):?>
	                        <div class="row">
	                            <div class="alert alert-success">
	                                <?php echo $this->session->flashdata('success'); ?>
	                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                            </div>
	                        </div>
	                    <?php  endif;?>
	                    <?php  if($this->session->flashdata('error')):?>
	                        <div class="row">
	                            <div class="alert alert-error">
	                                <?php echo $this->session->flashdata('error'); ?>
	                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                            </div>
	                        </div>
	                    <?php  endif;?>
						<div class="row" style='padding:0px; margin:0px;' id="data">
							<!--ND-->
							<div class="table-responsive" >
								<table class="table table-hover table-bordered">
									<thead>
										<tr>
											<th class="text-center active" style="width:20px">ID</th>
											<th class="active">Họ và tên</th>
											<th class="active">Email</th>
											<th class="active">Phone</th>
											<th class="text-center active" style="width:50px">Xóa</th>
										</tr>
									</thead>
									<tbody>
									<?php foreach ($list as $val):?>
										<tr>
											<td class="text-center"><?php echo $val['id'] ?></td>
											<td>
												<p><?php echo $val['fullname'] ?></p>	
											</td>
											<td><?php echo $val['email'] ?></td>
											<td><?php echo $val['phone'] ?></td>
											<td class="text-center">
												<a class="btn btn-danger btn-xs" href="<?php echo base_url() ?>admin/customer/delete/<?php echo $val['id']?>" role = "button" data-toggle="tooltip" data-placement="top" title="Xóa" onclick="return deletechecked();">
													<span class="fa fa-trash"></span>
												</a>
											</td>
										</tr>
									<?php endforeach; ?>
									</tbody>
								</table>
							</div>
							<div class="row">
								<div class="col-md-12 text-center">
									<ul class="pagination">
										<?php echo $strphantrang ?>
									</ul>
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
<script type="text/javascript">
	function deletechecked(){
        if(confirm("Bạn thực sự muốn thực hiện thao tác này ?")){
            return true;
        }else{
            return false;  
        } 
   }
</script>