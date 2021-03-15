<div class="content-wrapper">
	<section class="content-header">
		<h1><i class="glyphicon glyphicon-cd"></i> Quản lý sản phẩm</h1>
		<div class="breadcrumb">
			<a class="btn btn-success btn-sm" href="<?php echo base_url()?>admin/product/insert" role="button" data-toggle="tooltip" data-placement="left" title="">
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
	                    <nav class="navbar-filter navbar navbar-default">
							<div class="container">
								<div class="row">
									<div class="navbar-form navbar-left">
										<div class="form-group">
											<select placeholder="select" class="filter form-control" id='category'>
												<option value="">[-- Chọn danh mục --]</option>
												<?php if($category_id != 0) : ?>
													<option value="<?php echo $infoCategory['id'] ?>" selected><?php echo $infoCategory['name'] ?></option>
												<?php endif; ?>
												<?php echo($htmlCategory) ?>
											</select>
										</div>
										<div class="form-group">
											<select placeholder="select" class="filter form-control" id='option'>
												<option value="" <?php if ($option == 0) echo 'selected'; ?>>[-- Lựa chọn --]</option>
												<option value="<?php echo OPTION_FILLTER_NO_PRICE ?>" <?php if ($option != null && $option == OPTION_FILLTER_NO_PRICE) echo 'selected'; ?>>Chưa nhập giá</option>
												<option value="<?php echo OPTION_FILLTER_PRICE ?>" <?php if ($option != null && $option == OPTION_FILLTER_PRICE) echo 'selected'; ?>>Đã nhập giá</option>
												<option value="<?php echo OPTION_FILLTER_HOT_SALE ?>" <?php if ($option != null && $option == OPTION_FILLTER_HOT_SALE) echo 'selected'; ?>>Bán chạy</option>
											</select>
										</div>
										<div class="form-group">
								          	<div class="input-group" style="width: 200px;">
											    <input type="text" value="<?php if(isset($_GET['keyword'])) { echo $_GET['keyword'];} ?>" name="keyword" class="form-control" placeholder="Nhập tên sản phẩm">
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
											<th class='active' style="width:60px">Hình</th>
											<th class='active'>Tên</th>
											<th class='active'>Danh mục</th>
											<th class='active text-center'>Mã - Giá gốc- Giá KM - Kích thước - Màu sắc - Khối lượng</th>
											<th class="active text-center">Sửa</th>
											<th class="active text-center">Xóa</th>
										</tr>
									</thead>
									<tbody>
									<?php foreach ($list as $val):?>
										<tr>
											<td>
												<?php 
													$images = json_decode($val['images']);
													if (isset($images[0]) && $images[0] != '') :
												?>
													<img style="width:60px" src=<?php  echo 'upload/products/'.$images[0]?> >
												<?php else : ?>
													<img style="width:60px" src=<?php  echo base_url().'assets/images/no_image.png'?>>
												<?php endif; ?>
											</td>
											<td>
												<a href="<?php echo base_url() ?>admin/product/update/<?php echo $val['id']?>"><?php echo $val['name'] ?></a>
											</td>
											<td>
												<?php 
													echo $val['category_id'];
												?>
											</td>
											<td class="text-center">
												<?php
													$item_codes = json_decode($val['item_codes']);
													$item_prices = json_decode($val['item_prices']);
													$item_sizes = json_decode($val['item_sizes']);
													$item_colors = json_decode($val['item_colors']);
													$items_price_sale = json_decode($val['items_price_sale']);
													$item_weights = json_decode($val['item_weights']);
													$array_items = array(
														count($item_codes),
														count($item_prices),
														count($item_sizes),
														count($item_colors),
														count($items_price_sale),
														count($item_weights)
													);
													$max_length = max($array_items);
													$i = 0;
													for( $i; $i < $max_length; $i++) {
														$html = '';
														if (count($item_codes) <= 0 || !isset($item_codes[$i]) || $item_codes[$i] == null || $item_codes[$i] == '') {
															$html .= 'Trống';
														} else {
															$html .= $item_codes[$i];
														}
														$html .= ' - ';
														if (count($item_prices) <= 0 || !isset($item_prices[$i]) || $item_prices[$i] == null || $item_prices[$i] == '') {
															$html .= 'Trống';
														} else {
															$html .= number_format($item_prices[$i]);
														}
														$html .= ' - ';
														if (count($items_price_sale) <= 0 || !isset($items_price_sale[$i]) || $items_price_sale[$i] == null || $items_price_sale[$i] == '') {
															$html .= 'Trống';
														} else {
															$html .= number_format($items_price_sale[$i]);
														}
														$html .= ' - ';
														if (count($item_sizes) <= 0 || !isset($item_sizes[$i]) || $item_sizes[$i] == null || $item_sizes[$i] == '') {
															$html .= 'Trống';
														} else {
															$html .= $item_sizes[$i];
														}
														$html .= ' - ';
														if (count($item_colors) <= 0 || !isset($item_colors[$i]) || $item_colors[$i] == null || $item_colors[$i] == '') {
															$html .= 'Trống';
														} else {
															$html .= $item_colors[$i];
														}
														$html .= ' - ';
														if (count($item_weights) <= 0 || !isset($item_weights[$i]) || $item_weights[$i] == null || $item_weights[$i] == '') {
															$html .= 'Trống';
														} else {
															$html .= $item_weights[$i];
														}
														$html .= "<br />";
														echo $html;
													}
												?>
											</td>
											<!-- <td style="text-align:center" class="transaction">
												<?php if ($val['is_hot_sale'] == PRODUCT_IS_HOT_SALE) : ?>
													<a href="javascript:void(0)" data-id="<?php echo $val['id'] ?>" class="fa fa-toggle-on option" name="is_hot_sale" style="color:#0acc22; font-size: 20px;"></a> 
												<?php else: ?>
													<a href="javascript:void(0)" data-id="<?php echo $val['id'] ?>" class="fa fa-toggle-off option" name="is_hot_sale" style="color:#ccc; font-size: 20px;"></a> 
												<?php endif; ?>
											</td>
											<td style="text-align:center" class="transaction">
												<?php if ($val['is_hot'] == PRODUCT_IS_HOT) : ?>
													<a href="javascript:void(0)" data-id="<?php echo $val['id'] ?>" class="fa fa-toggle-on option" name="is_hot" style="color:#0acc22; font-size: 20px;"></a> 
												<?php else: ?>
													<a href="javascript:void(0)" data-id="<?php echo $val['id'] ?>" class="fa fa-toggle-off option" name="is_hot" style="color:#ccc; font-size: 20px;"></a> 
												<?php endif; ?>
											</td> -->
											<!-- <td style="text-align:center" class="transaction">
												<?php if ($val['is_sale'] == PRODUCT_IS_SALE) : ?>
													<a href="javascript:void(0)" data-id="<?php echo $val['id'] ?>" name="is_sale" class="option fa fa-toggle-on" style="color:#0acc22; font-size: 20px;"></a> 
												<?php else: ?>
													<a href="javascript:void(0)" data-id="<?php echo $val['id'] ?>" name="is_sale" class="fa fa-toggle-off option" style="color:#ccc; font-size: 20px;"></a> 
												<?php endif; ?>
											</td> -->
											<!-- <td style="text-align:center" class="transaction">
												<?php if ($val['is_new'] == PRODUCT_IS_NEW) : ?>
													<a href="javascript:void(0)" data-id="<?php echo $val['id'] ?>" name="is_new" class="option fa fa-toggle-on" style="color:#0acc22; font-size: 20px;"></a> 
												<?php else: ?>
													<a href="javascript:void(0)" data-id="<?php echo $val['id'] ?>" name="is_new" class="option fa fa-toggle-off" style="color:#ccc; font-size: 20px;"></a> 
												<?php endif; ?>
											</td> -->
											<td class="text-center">
												<a class="btn btn-success btn-xs" href="<?php echo base_url() ?>admin/product/update/<?php echo $val['id']?>" role = "button" data-toggle="tooltip" data-placement="top" title="">
													<span class="fa fa-edit"></span>
												</a>
											</td>
											<td class="text-center">
												<a class="btn btn-danger btn-xs" href="<?php echo base_url() ?>admin/product/delete/<?php echo $val['id']?>" role = "button" data-toggle="tooltip" data-placement="top" title="" onclick="return deletechecked();">
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