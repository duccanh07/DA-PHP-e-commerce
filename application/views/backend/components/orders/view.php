<?php 
	if($isUpdate == 1) {
		echo form_open_multipart('admin/orders/update/'.$infoOrder['orderCode']);
	}
?>
<div class="content-wrapper">
	<section class="content-header col-xs-8">
		<h1><i class="glyphicon glyphicon-cd"></i> Chi tiết đơn hàng</h1>
	</section>
	<!-- Main content -->
	<section class="content" style="clear: both;">
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
						<div class="row" style='padding:0px; margin:0px;' id="data">
							<!--ND-->
							<div class="col-xs-12">
						        <form class="">
				                    <div class="form-group"><label class="control-label">Mã đơn hàng</label><input type="text" name="orderCode" value="<?php echo $infoOrder['orderCode'] ?>" disabled="" class="form-control"></div>
				                    <div class="form-group"><label class="control-label">Tên khách hàng</label><input type="text" name="idUser" value="<?php echo $infoOrder['idUserOrder']['fullname'] ?>" disabled="" class="form-control"></div>
				                    <div class="form-group"><label class="control-label">Sản phẩm</label>
				                        <div>
				                            <table disabled class="table table-bordered table">
				                                <tbody>
				                                    <tr style="background: rgb(220, 220, 220);">
				                                        <th>Sản phẩm</th>
				                                        <th>Mã sản phẩm</th>
		                                                <th>Đơn giá</th>
		                                                <th class="text-center">SL</th>
		                                                <th>Thành tiền</th>
				                                    </tr>
				                                    <tr style="background: rgb(238, 238, 238);">
				                                         <?php foreach (json_decode(json_encode($infoOrder['idProducts']),true) as $infoProduct):?>
		                                                    <tr>
		                                                        <td style="background: rgb(238, 238, 238);">
		                                                            <?php echo $infoProduct['infoProduct']['name'] ?>
		                                                        </td>
		                                                        <td style="background: rgb(238, 238, 238);">
		                                                        	<?php 
		                                                        		$sizes = json_decode($infoProduct['infoProduct']['sizes']);
																		if ($infoProduct['infoProduct']['position_size'] != '') {
																			if ($sizes[$infoProduct['infoProduct']['position_size']] != '') {
																				echo $sizes[$infoProduct['infoProduct']['position_size']];
																			}
																		}
	                                                        		?>
		                                                        </td>
		                                                        <td style="background: rgb(238, 238, 238);">
		                                                            <span class="amount text-right">
		                                                                <?php echo (number_format($infoProduct['infoProduct']['price'])).CURRENTCY_UNIT; ?>
		                                                            </span>
		                                                        </td>
		                                                        <td style="background: rgb(238, 238, 238);">
		                                                            <div class="quantity text-center clearfix">
		                                                                <span><?php echo $infoProduct['quantity'] ?></span>
		                                                            </div>
		                                                        </td>
		                                                        <td style="background: rgb(238, 238, 238);">
		                                                            <span class="amount">
		                                                                <?php 
		                                                                    echo (number_format($infoProduct['priceProductQuantity'])).CURRENTCY_UNIT;
		                                                                    
		                                                                ?>
		                                                            </span>
		                                                        </td>
		                                                    </tr>
		                                                <?php endforeach; ?>
				                                    </tr>
				                                </tbody>
				                            </table>
				                        </div>
				                    </div>
				                    <div class="form-group"><label class="control-label">Tổng tiền</label><input type="text" name="totalMoney" value="<?php echo number_format($infoOrder['totalPrice']).CURRENTCY_UNIT; ?>" disabled="" class="form-control"></div>
				                   
				                    <div id="PrintDiv">
				                        <div class="form-group"><label class="control-label">Thông tin giao hàng</label>
				                            <div>
				                                <table disabled class="table table-bordered table" style="background: rgb(238, 238, 238);">
				                                    <tbody>
				                                        <tr style="background: rgb(220, 220, 220);">
				                                            <th style="width: 150px;">Người nhận</th>
				                                            <th class="text-center">Điện thoại</th>
				                                            <th>Địa chỉ</th>
				                                        </tr>
				                                        <tr>
				                                            <td><?php echo $infoOrder['idUserOrder']['fullname'] ?></td>
				                                            <td class="text-center"><?php echo $infoOrder['idUserOrder']['phone'] ?></td>
				                                            <td><?php echo $infoOrder['idUserOrder']['address']?></td>
				                                        </tr>
				                                    </tbody>
				                                </table>
				                            </div>
				                        </div>
				                    </div>
				                    <div class="form-group"><label class="control-label">Ngày đặt hàng</label><input type="text" name="createdAt" value="<?php echo $infoOrder['createdAt'] ?>" disabled="" class="form-control"></div><!-- 
				                    			                    	<div class="form-group">
				                    	<a type='button' class="btn btn-success button-print-order" onclick="onPrintOrder()">IN ĐƠN HÀNG</a>
				                    </div> -->
				                    <div class="form-group">
										<label>Trạng thái đơn hàng<span class = "maudo">(*)</span></label>
										<select name="state" required class="form-control small-input">
											<?php if($infoOrder['state'] == STATE_ORDER_ORDERING): ?>
												<option value="<?php echo STATE_ORDER_ORDERING ?>" <?php if($infoOrder['state'] == STATE_ORDER_ORDERING) {echo 'selected';}?>>Đang đặt</option>
												<option value="<?php echo STATE_ORDER_PROCESSING ?>" <?php if($infoOrder['state'] == STATE_ORDER_PROCESSING) {echo 'selected';}?>>Đang xử lý</option>
												<option value="<?php echo STATE_ORDER_SHIPPING ?>" <?php if($infoOrder['state'] == STATE_ORDER_SHIPPING) {echo 'selected';}?>>Đang vận chuyển</option>
												<option value="<?php echo STATE_ORDER_COMPLETE ?>" <?php if($infoOrder['state'] == STATE_ORDER_COMPLETE) {echo 'selected';}?>>Hoàn tất</option>
											<?php elseif ($infoOrder['state'] == STATE_ORDER_PROCESSING) :?>
												<option value="<?php echo STATE_ORDER_PROCESSING ?>" <?php if($infoOrder['state'] == STATE_ORDER_PROCESSING) {echo 'selected';}?>>Đang xử lý</option>
												<option value="<?php echo STATE_ORDER_SHIPPING ?>" <?php if($infoOrder['state'] == STATE_ORDER_SHIPPING) {echo 'selected';}?>>Đang vận chuyển</option>
												<option value="<?php echo STATE_ORDER_COMPLETE ?>" <?php if($infoOrder['state'] == STATE_ORDER_COMPLETE) {echo 'selected';}?>>Hoàn tất</option>
											<?php elseif ($infoOrder['state'] != STATE_ORDER_CANCEL) :?>
												<option value="<?php echo STATE_ORDER_SHIPPING ?>" <?php if($infoOrder['state'] == STATE_ORDER_SHIPPING) {echo 'selected';}?>>Đang vận chuyển</option>
												<option value="<?php echo STATE_ORDER_COMPLETE ?>" <?php if($infoOrder['state'] == STATE_ORDER_COMPLETE) {echo 'selected';}?>>Hoàn tất</option>
											<?php endif; ?>
										</select>
									</div>
									<div class="">
										<button type = "submit" class="btn btn-success btn-sm btn-exit" role="button" data-toggle="tooltip" data-placement="top">
											Lưu</button>
										<a class="btn btn-default btn-sm" href="<?php echo base_url() ?>admin/orders.html" role="button" data-toggle="tooltip" data-placement="top">
											Hủy
										</a>
									</div>
									<br/>
				                </form>
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
	function onPrintOrder() {
		var contents = 
            "<div style='width: 1100px;float: left;clear: both;'>"+
              "<div style='width: 1024px;margin: 0 auto;'>"+
                "<div style='margin-top: 20px'>"+
                  "<div style='margin-bottom: 20px;width: 100%;min-height: 1px;overflow: hidden;position: relative;'>"+
                    //"<img src=" + Constants.linkServerImage + 'ic_launcher.png' + " style='width: 100px;float: left;'>"+
                    "<div style=' width: calc(100% - 100px); position: absolute; bottom: -6px;left: 110px;'>"+
                      "<h1 style='margin-top: -14px;text-transform: uppercase;color: #fd4196;font-family: arial; float: left;'>photosmart</h1><span style='text-transform: uppercase; color: #888686;font-family: arial;font-size: 14px;font-weight: 600;'>.vn</span><span>, Cảm ơn quý khách đã sử dụng dịch vụ.</span><br/>"+
                    "</div>"+
                  "</div>"+
                "</div>"+
                "<div>"+
                  "<div>"+
                    "<h1 style='margin-top: 40px'>BIÊN NHẬN BÁN HÀNG</h1>"+
                    "<table style='width: 100%;>"+
                      "<tbody>"+
                        "<tr class='theader-info' style='background: rgb(220, 220, 220);'>"+
                          "<td style='padding: 5px;'>Mã số đơn hàng: <?php echo $infoOrder['orderCode'] ?></td>"+
                          "<td style='padding: 5px;'>Ngày đặt hàng: <?php echo $infoOrder['createdAt'] ?></td>"+
                        "</tr>"+
                        "<tr>"+
                          "<td style='padding: 5px;text-align: left;'>"+
                            "Người nhận hàng: <?php echo $infoOrder['idUserOrder']['fullname'] ?>" +
                          "</td>"+
                          "<td style='padding: 5px;text-align: left;'>"+
                            "Số điện thoại: <?php echo $infoOrder['idUserOrder']['phone'] ?>" +
                          "</td>"+
                        "</tr>"+
                        "<tr>"+
                          "<td style='padding: 5px;text-align: left;' colspan='3'>"+
                            "Địa chỉ giao hàng: <?php echo $infoOrder['idUserOrder']['address']?>" +
                          "</td>"+
                        "</tr>"+
                      "</tbody>"+
                    "</table>"+
                  "</div>"+
                  "<div style='margin-top: 40px'>"+
                    "<div>"+
                      "<div style='margin-bottom: 10px'>"+
                        //"<img src=" + Constants.linkServerImage + 'cart.png' + " style='width: 70px;margin-bottom: -1px'>"+
                      "Sau đây là thông tin chi tiết về đơn hàng: "+
                      "</div>"+
                      "<table disabled class='table table-bordered table' style='width: 100%'>"+
                        "<tbody>"+
                        	"<?php foreach (json_decode(json_encode($infoOrder['idProducts']),true) as $key => $infoProduct):?>" +

                        	"<tr>"+
				            "<td style='padding: 5px;'>" + <?php echo $key + 1 ?> + ".</td>"+
				            "<td style='padding: 5px;'><?php echo $infoProduct['infoProduct']['name'] ?></td>"+
				            "<td style='padding: 5px;'><?php echo (number_format($infoProduct['infoProduct']['price'])).CURRENTCY_UNIT; ?></td>"+
				            "<td style='padding: 5px;'>"+
                            	"<?php 
                                    if ($infoProduct['color'] != '' && $infoProduct['size'] != '') {
                                        echo 'Màu '.$infoProduct['color']['name'].', Size '.$infoProduct['size']['size'];
                                    }
                                ?>"+
                            "</td>"+
				            "<td style='padding: 5px;'><?php echo $infoProduct['quantity'] ?></td>"+
				            "<td style='padding: 5px;text-align: right;'><?php 
                                echo (number_format($infoProduct['priceProductQuantity'])).CURRENTCY_UNIT;
                                
                            ?></td>"+
				          "</tr>" +
				          "<?php endforeach; ?>" +
                          "<tr>"+
                            "<td style='padding: 5px;text-align: right;' colspan='5'>"+
                              "Cộng: <?php echo (number_format($infoOrder['totalPrice'] - $infoOrder['shipPrice'])).CURRENTCY_UNIT; ?>"+
                            "</td>"+
                          "</tr>"+
                          "<tr>"+
                            "<td style='padding: 5px;text-align: right;' colspan='5'>"+
                              "<p>Phí vận chuyển: <?php echo (number_format($infoOrder['shipPrice'])).CURRENTCY_UNIT; ?></p>"+
                              "<p><strong>Tổng tiền thanh toán: <?php echo (number_format($infoOrder['totalPrice'])).CURRENTCY_UNIT; ?></strong></p>"+
                            "</td>"+
                          "</tr>"+
                        "</tbody>"+
                      "</table>"+
                    "</div>"+
                  "</div>"+
                "</div>"+
              "</div>"+
            "</div>";
          var frame1 = document.createElement('iframe');
          frame1.name = "frame1";
          frame1.style.position = "absolute";
          frame1.style.top = "-1000000px";
          document.body.appendChild(frame1);
          var frameDoc = frame1.contentWindow ? frame1.contentWindow : frame1.contentDocument.document ? frame1.contentDocument.document : frame1.contentDocument;
          frameDoc.document.open();
          frameDoc.document.write('<html><head><title>In đơn hàng</title>');
          frameDoc.document.write('</head><body>');
          frameDoc.document.write(contents);
          frameDoc.document.write('</body></html>');
          frameDoc.document.close();
          setTimeout(function () {
              window.frames["frame1"].focus();
              window.frames["frame1"].print();
              document.body.removeChild(frame1);
          }, 500);
          return false;
	}
</script>