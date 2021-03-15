<div class="content-wrapper">
	<section class="content-header">
		<h1><i class="glyphicon glyphicon-cd"></i> Quản lý bài viết</h1>
		<div class="breadcrumb">
			<a class="btn btn-success btn-sm" href="<?php echo base_url()?>admin/content/insert" role="button" data-toggle="tooltip" data-placement="left" title="">
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
	                    <nav class="navbar-filter navbar navbar-default">
							<div class="container">
								<div class="row">
									<div class="navbar-form navbar-left">
										<div class="form-group">
											<select placeholder="select" class="filter form-control" id='category'>
												<option value="">[-- Chọn danh mục --]</option>
												<?php if(isset($infoCategory)) : ?>
													<option value="<?php echo $infoCategory['id'] ?>" selected><?php echo $infoCategory['name'] ?></option>
												<?php endif; ?>
												<?php echo($htmlCategory) ?>
											</select>
										</div>
										<div class="form-group">
								          	<div class="input-group" style="width: 200px;">
											    <input type="text" value="<?php if(isset($_GET['keyword'])) { echo $_GET['keyword'];} ?>" name="keyword" class="form-control" placeholder="Nhập tên bài viết">
											    <div class="input-group-addon icon-remove-keyword" style="cursor: pointer;">
											        <span class="fa fa-times"></span>
											    </div>
											</div>
								        </div>
									</div>
								</div>
							</div>
						</nav>
						<div class="row" style='padding:0px; margin:0px;' id="data">
							<!--ND-->
							<div class="table-responsive" >
								<table class="table table-hover table-bordered">
									<thead>
										<tr>
											<th class='active' style="width:100px">Hình đại diện</th>
											<th class='active'>Tiêu đề</th>
											<th class='active'>Danh mục</th>
											<th class='active'>Loại</th>
											<th class="active text-center" style="width:50px">Sửa</th>
											<th class="active text-center" style="width:50px">Xóa</th>
										</tr>
									</thead>
									<tbody>
									<?php foreach ($list as $val):?>
										<tr>
											<td>
												<img style="width:85px; margin: 0 auto" src=<?php  echo 'upload/contents/'.json_decode($val['images'])[0] ?> >
											</td>
											<td>
												<a href="<?php echo base_url() ?>admin/content/update/<?php echo $val['id']?>"><?php echo $val['title'] ?></a>
											</td>
											<td><?php echo $val['categoryObject'] ?></td>
											<td>
												<?php
													switch ($val['type']) {
														case 0:
															echo 'Bài viết thường';
															break;
														case 6:
															echo 'Bài viết video';
															break;
														default:
															# code...
															break;
													}
												?>
											</td>
											<td class="text-center">
												<a class="btn btn-success btn-xs" href="<?php echo base_url() ?>admin/content/update/<?php echo $val['id']?>" role = "button" data-toggle="tooltip" data-placement="top" title="Sửa">
													<span class="fa fa-edit"></span>
												</a>
											</td>
											<td class="text-center">
												<a class="btn btn-danger btn-xs" href="<?php echo base_url() ?>admin/content/delete/<?php echo $val['id']?>" role = "button" data-toggle="tooltip" data-placement="top" title="Xóa" onclick="return deletechecked();">
													<span class="fa fa-trash"></span>
												</a>
											</td>
										</tr>
									<?php endforeach; ?>
									</tbody>
								</table>
								<div class="row">
									<div class="col-md-12 text-center">
										<ul class="pagination">
											<?php echo $paginations ?>
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
<script type="text/javascript">
	function deletechecked(){
        if(confirm("Bạn thực sự muốn thực hiện thao tác này ?")){
            return true;
        }else{
            return false;  
        } 
   }
</script>