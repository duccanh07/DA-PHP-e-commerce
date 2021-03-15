<div class="table-responsive" >
	<table class="table table-hover table-bordered">
		<thead>
			<tr>
				<th class='active'>Tên danh mục</th>
				<th class='active'>Danh mục cha</th>
				<th class='active'>Loại danh mục</th>
				<th class='active text-center'>Hiển thị ở trang chủ</th>
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
								echo 'Sản phẩm';
								break;
							case TYPE_CATEGORY_CONTENT:
								echo 'Bài viết';
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
						}
					?>
				</td>
				<td style="text-align:center;">
					<?php if ($val['is_show_home'] == CATEGORY_ALLOW_SHOW_IN_HOME) : ?>
						<a href="<?php echo base_url() ?>admin/category/update_show/<?php echo $val['id']?>" title="Cho phép hiển thị ở trang chủ" onclick="return deletechecked();" class="fa fa-toggle-on" id="add" style="color:#0acc22; font-size: 20px;"></a> 
					<?php else: ?>
						<a href="<?php echo base_url() ?>admin/category/update_show/<?php echo $val['id']?>" title="Không cho phép hiển thị ở trang chủ" onclick="return deletechecked();" class="fa fa-toggle-off" id="add" style="color:#ccc; font-size: 20px;"></a> 
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
<script type="text/javascript">
	function deletechecked(){
        if(confirm("Bạn thực sự muốn thực hiện thao tác này ?")){
            return true;
        }else{
            return false;  
        } 
   	}
</script>