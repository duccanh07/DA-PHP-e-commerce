<div class="content-wrapper">
	<section class="content-header">
		<h1><i class="glyphicon glyphicon-cd"></i> Danh sách đối tác</h1>
		<?php  ?>
		<div class="breadcrumb">
			<a class="btn btn-success btn-sm" href="<?php echo base_url()?>admin/agency/insert.html" role="button" data-toggle="tooltip" data-placement="left">
				Thêm <span class="fa fa-plus"></span>
			</a>
		</div>
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
											<th class='active' style="width:60px">Logo</th>
											<th class='active'>Tên đối tác</th>
											<th class='active'>Đường dẫn trỏ đến</th>
											<th class='active'>Tiêu đề hình ảnh</th>
											<th class='active'>Mô tả hình ảnh</th>
											<th class="active text-center" style="width:50px">Sửa</th>
											<th class="active text-center" style="width:50px">Xóa</th>
										</tr>
									</thead>
									<tbody>
									<?php foreach ($list as $val):?>
										<tr>
											<td>
												<img style="width:60px" src=<?php  echo 'upload/agencies/'.json_decode($val['images'])[0] ?> >
											</td>
											<td>
												<a href="<?php echo base_url() ?>admin/agency/update/<?php echo $val['id']?>"><?php echo $val['name'] ?></a>
											</td>
											<td>
												<?php echo $val['link_ads']  ?>
											</td>
											<td>
												<?php echo json_decode($val['title_image'])[0]  ?>
											</td>
											<td>
												<?php echo json_decode($val['alt_image'])[0]  ?>
											</td>
											<td class="text-center">
												<a class="btn btn-success btn-xs" href="<?php echo base_url() ?>admin/agency/update/<?php echo $val['id']?>" role = "button" data-toggle="tooltip" data-placement="top" title="Sửa">
													<span class="fa fa-edit"></span>
												</a>
											</td>
											<td class="text-center">
												<a class="btn btn-danger btn-xs" href="<?php echo base_url() ?>admin/agency/delete/<?php echo $val['id']?>" role = "button" data-toggle="tooltip" data-placement="top" title="Xóa" onclick="return deletechecked();">
													<span class="fa fa-trash"></span>
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