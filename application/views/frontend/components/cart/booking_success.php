<div class="container">
	<div class="row">
		<div class="checkout-content">
		    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-login-checkout" style="margin-bottom: 20px; padding: 0">
		        <div style="border-bottom: 1px solid #dcdcdc;" class="wrap-overflow">
		            <p class="text-center pull-left">Kết quả đặt hàng</p>
		        </div>
		        <div id="checkout-success-content" class="l-pageWrapper">
		            <div class="heading_success wrap-overflow">
		                <i class="fa fa-check-circle-o" aria-hidden="true"></i> 
		                <span class="heading_success_content">
		                    Xin chúc mừng, đơn hàng của bạn đã được đặt thành công !                    
		                </span>
		            </div>
		        </div>
		        <div class="wrap-info-order-success">
		            <h4>Sau đây là thông tin đơn hàng:</h4>
		            <div class="no-margin-table col-xs-6 col-sm-6 col-md-6 col-lg-6 pull-left">
		                <table class="table" style="color: #333">
		                    <tbody>
		                        <tr>
		                            <td class="table-order-success" colspan="4" style="font-weight: 600;">Thông tin giao hàng</td>
		                        </tr>
		                        <tr>
		                            <td colspan="4">
		                                <p><b>Người nhận: </b><?php echo $infoOrder['idUserOrder']['fullname'] ?></p>
		                                <p><b>Địa chỉ giao hàng: </b><?php echo $infoOrder['idUserOrder']['address']?></p>
		                                <p><b>Số điện thoại: </b><?php echo $infoOrder['idUserOrder']['phone'] ?></p>
		                            </td>
		                        </tr>
		                    </tbody>
		                </table>
		            </div>
		            <div class="no-margin-table col-xs-6 col-sm-6 col-md-6 col-lg-6 pull-left">
		                <table class="table" style="color: #333">
		                    <tbody>
		                        <tr>
		                            <td class="table-order-success" colspan="4" style="font-weight: 600;">Thông tin đơn hàng</td>
		                        </tr>
		                        <tr style="background: #fafafa; color: #333;" class="text-transform font-weight-600">
		                            <th>Sản phẩm</th>
		                            <th class="text-center">Đơn giá</th>
		                            <th class="text-center">SL</th>
		                            <th class="text-center">Thành tiền</th>
		                        </tr>
		                        <?php foreach (json_decode(json_encode($infoOrder['idProducts']),true) as $infoProduct):?>
		                            <tr>
		                                <td style="width: 50%;">
		                                    <?php echo $infoProduct['infoProduct']['name'] ?>
		                                </td>
		                                <td>
		                                    <span class="amount text-right">
		                                        <?php echo (number_format($infoProduct['infoProduct']['price'])).CURRENTCY_UNIT; ?>
		                                    </span>
		                                </td>
		                                <td>
		                                    <div class="quantity text-center clearfix">
		                                        <span><?php echo $infoProduct['quantity'] ?></span>
		                                    </div>
		                                </td>
		                                <td class="text-right">
		                                    <span class="amount">
		                                        <?php 
		                                            echo (number_format($infoProduct['priceProductQuantity'])).CURRENTCY_UNIT;
		                                            
		                                        ?>
		                                    </span>
		                                </td>
		                            </tr>
		                        <?php endforeach; ?>
		                        <tr style="background: #fafafa">
		                            <td colspan="3">Tạm tính</td>
		                            <td class="text-right"><?php echo (number_format($infoOrder['totalPrice'])).CURRENTCY_UNIT; ?></td>
		                        </tr>
		                        <tr style="background: #fafafa">
		                            <td colspan="3" class="font-weight-600">Thành tiền<br/><span style="font-weight: 100; font-style: italic;">(Tổng số tiền thanh toán)</span></td>
		                            <td class="text-right"><strong><?php echo (number_format($infoOrder['totalPrice'])).CURRENTCY_UNIT; ?></strong></td>
		                        </tr>
		                    </tbody>
		                </table>
		            </div>
		        </div>
		        <div class="tab-common tab ch-container" id="tab-common">
		            <div id="place_order_default" class="place_order_default">
		                <div class="action_btn">
		                    <div class="row thankyou-buttons" style="margin: 0; margin-left: 15px;">
		                        <a class="btn btn-success" title="Tiếp tục mua hàng" alt="Tiếp tục mua hàng" href="<?php echo base_url() ?>" style="opacity: 1; cursor: pointer;">
		                            Tiếp tục mua hàng
		                        </a>
		                    </div>
		                </div></div>
		        </div>
		    </div>
		</div>
	</div>
</div>