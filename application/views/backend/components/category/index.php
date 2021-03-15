<div class="content-wrapper">
	<section class="content-header">
		<h1><i class="glyphicon glyphicon-cd"></i> Danh sách danh mục</h1>
		<div class="breadcrumb">
			<a class="btn btn-success btn-sm" href="<?php echo base_url()?>admin/category/insert" role="button" data-toggle="tooltip" data-placement="left" title="">
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
						<!-- <nav class="navbar-filter navbar navbar-default">
							<div class="container">
								<div class="row">
									<div class="navbar-form navbar-left">
										<div class="form-group">
											<select placeholder="select" class="filter form-control" id='typeCategory'>
												<option value="">[-- Chọn loại danh mục --]</option>
												<option value="<?php echo TYPE_CATEGORY_HOME ?>">Trang chủ</option>
												<option value="<?php echo TYPE_CATEGORY_PRODUCT ?>">DS sản phẩm</option>
												<option value="<?php echo TYPE_CATEGORY_CONTENT ?>">DS bài viết</option>
												<option value="<?php echo TYPE_CATEGORY_PRODUCT_ONE ?>">Sản phẩm đơn</option>
												<option value="<?php echo TYPE_CATEGORY_CONTENT_ONE ?>">Bài viết đơn</option>
												<option value="<?php echo TYPE_CATEGORY_DU_AN ?>">DS bài viết dự án</option>
											</select>
										</div>
										<div class="form-group">
											<select placeholder="select" class="filter form-control" id='parentCategory'>
												<option value="">[-- Chọn danh mục cha --]</option>
												<option value="<?php echo DEFAULT_PARENT_ID; ?>">Danh mục cấp cao nhất</option>
												<?php echo($htmlCategory) ?>
											</select>
										</div>
									</div>
								</div>
							</div>
						</nav> -->
						<?php  if($this->session->flashdata('success')):?>
	                        <div class="row">
	                            <!-- <div class="alert alert-success">
	                                <?php echo $this->session->flashdata('success'); ?>
	                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                            </div> -->
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
						<div class="row" style='padding:0px; margin:0px;' id="dataCategories">
							<!--ND-->
							<div class="table-responsive" >
								<table class="table table-hover table-bordered">
									<thead>
										<tr>
											<th class='active'>Tên danh mục</th>
											<th class='active'>Danh mục cha</th>
											<th class='active'>Loại</th>
											<th class='active text-center'>Icon</th>
											<th class='active text-center'>Hiển thị ở trang chủ</th>
											<th class='active text-center'>Hiển thị ở menu</th>
											<th class="active text-center" style="width:50px">Sửa</th>
											<th class="active text-center" style="width:50px">Xóa</th>
										</tr>
									</thead>
									<tbody>
									<?php foreach ($list as $val):?>
										<tr>
											<td>
												<p><a href="<?php echo base_url() ?>admin/category/update/<?php echo $val['id'] ?>"><?php echo $val['name'] ?></a></p>	
											</td>

											<td class=''>
												<?php 
													if($val['parent_id'] == DEFAULT_PARENT_ID) {
														echo '-';
													} else {
														echo $this->Mcategory->category_get_field($val['parent_id'], 'name', STATUS_ACTIVE);
													}
												?>
											</td>
											<td class=''>
												<?php 
													switch ($val['type']) {
														case TYPE_CATEGORY_PRODUCT:
															echo 'Danh sách sản phẩm';
															break;
														case TYPE_CATEGORY_CONTENT:
															echo 'Danh sách bài viết';
															break;
														case TYPE_CATEGORY_PRODUCT_ONE:
															echo 'Sản phẩm đơn';
															break;
														case TYPE_CATEGORY_CONTENT_ONE:
															echo 'Bài viết đơn';
															break;
														case TYPE_CATEGORY_HOME:
															echo 'Trang chủ';
															break;
														case TYPE_CATEGORY_DU_AN:
															echo 'DS bài viết dự án';
															break;
														case TYPE_CATEGORY_VIDEO_CONG_TRINH:
															echo 'DS video công trình';
															break;
													}
												?>
											</td>
											<td class="text-center">
												<?php if(isset($val['fa_icons'])) : ?>
													<span class="<?php echo $val['fa_icons'] ?>"></span>
												<?php endif; ?>
											</td>
											<td style="text-align:center">
												<?php if ($val['is_show_home'] == CATEGORY_ALLOW_SHOW_IN_HOME) : ?>
													<a href="<?php echo base_url() ?>admin/category/update_show/<?php echo $val['id']?>" onclick="return deletechecked();" title="Cho phép hiển thị ở trang chủ" class="fa fa-toggle-on" id="add" style="color:#0acc22; font-size: 20px;"></a> 
												<?php else: ?>
													<a href="<?php echo base_url() ?>admin/category/update_show/<?php echo $val['id']?>" onclick="return deletechecked();" title="Không cho phép hiển thị ở trang chủ" class="fa fa-toggle-off" id="add" style="color:#ccc; font-size: 20px;"></a> 
												<?php endif; ?>
											</td>
											<td style="text-align:center">
												<?php if ($val['is_show_menu'] == CATEGORY_ALLOW_SHOW_IN_MENU) : ?>
													<a href="<?php echo base_url() ?>admin/category/update_show_menu/<?php echo $val['id']?>" onclick="return deletechecked();" title="Cho phép hiển thị ở menu" class="fa fa-toggle-on" id="add" style="color:#0acc22; font-size: 20px;"></a> 
												<?php else: ?>
													<a href="<?php echo base_url() ?>admin/category/update_show_menu/<?php echo $val['id']?>" onclick="return deletechecked();" title="Không cho phép hiển thị ở menu" class="fa fa-toggle-off" id="add" style="color:#ccc; font-size: 20px;"></a> 
												<?php endif; ?>
											</td>
											<td class="text-center">
												<a class="btn btn-success btn-xs" href="<?php echo base_url() ?>admin/category/update/<?php echo $val['id']?>" role = "button" data-toggle="tooltip" data-placement="top" title="">
													<span class="fa fa-edit"></span>
												</a>
											</td>
											<td class="text-center">
												<a class="btn btn-danger btn-xs" href="<?php echo base_url() ?>admin/category/delete/<?php echo $val['id']?>" role = "button" data-toggle="tooltip" data-placement="top" title="" onclick="return deletechecked();">
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