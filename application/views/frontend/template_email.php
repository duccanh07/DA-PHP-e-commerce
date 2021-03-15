<div>
   <h3>
     Thông Tin Đơn Hàng
  </h3>

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