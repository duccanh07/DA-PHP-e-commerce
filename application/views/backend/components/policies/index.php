<div class="content-wrapper">
	<section class="content-header">
		<h1><i class="glyphicon glyphicon-cd"></i> Danh sách chính sách</h1>
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
											<th class='active' style="width:60px">Hình</th>
											<th class='active'>Tên</th>
											<th class='active'>Mô tả</th>
											<th class='active'>Loại</th>
											<th class="active text-center" style="width:50px">Sửa</th>
										</tr>
									</thead>
									<tbody>
									<?php foreach ($list as $val):?>
										<tr>
											<td>
												<img style="width:60px" src=<?php  echo 'upload/policies/'.json_decode($val['images'])[0] ?> >
											</td>
											<td>
												<a href="<?php echo base_url() ?>admin/policies/update/<?php echo $val['id']?>"><?php echo $val['name'] ?></a>
											</td>
											<td>
												<?php echo $val['description']  ?>
											</td>
											<td>
												<?php 
													if($val['type'] == POLICIES_TYPE_HOME_PAGE)
													{
														echo 'Trang chủ';
													}
													else 
													{
														echo "Khác";
													}
												?>
											</td>
											<td class="text-center">
												<a class="btn btn-success btn-xs" href="<?php echo base_url() ?>admin/policies/update/<?php echo $val['id']?>" role = "button" data-toggle="tooltip" data-placement="top" title="Sửa">
													<span class="fa fa-edit"></span>
												</a>
											</td>
										</tr>
									<?php endforeach; ?>
									</tbody>
								</table>
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