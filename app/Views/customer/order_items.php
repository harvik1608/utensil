<p><b>Order No.: #<?php echo $order['order_no']; ?></b></p>
<div class="table-responsive">
	<table class="table ec-table table-bordered" id="order-item">
		<thead>
			<tr>
				<th width="15%">Image</th>
				<th>Product Name</th>
				<th>Quantity</th>
				<th>Price</th>
				<th align="right">Amount</th>
			</tr>
		</thead>
		<tbody>
			<?php 
				if($items) {
					$total = 0;
					foreach ($items as $key => $val) {
						$src = base_url("public/website/assets/images/product-image/1.jpg");
						if($val["avatar"] != "" && file_exists("public/uploads/product/".$val["avatar"])) {
							$src = base_url("public/uploads/product/".$val["avatar"]);
						}
						$price = $val['product_discount_amt'] > 0 ? $val['product_discount_amt'] : $val['product_amt'];
						$total = $total + ($val['quantity']*$price);
			?>
						<tr>
							<td><img class="ec-cart-pro-img mr-4" src="<?php echo $src; ?>" alt="<?php echo $val['name']; ?>" /></td>
							<td><?php echo $val['name']; ?></td>
							<td><?php echo $val['quantity']; ?></td>
							<td><?php echo $val['product_discount_amt'] > 0 ? $val['product_discount_amt'] : $val['product_amt']; ?></td>
							<td align="right"><?php echo currency().number_format($val['quantity']*$price,2); ?></td>
						</tr>
			<?php
					}
				}
			?>
			<tr>
				<td align="right" colspan="4">TOTAL</td>
				<td align="right"><?php echo currency().number_format($total,2); ?></td>
			</tr>
		</tbody>
	</table>
</div>
<div class="ec-vendor-block-img space-bottom-30">
    <div class="ec-vendor-upload-detail">
		<a href="javascript:;" class="btn btn-lg btn-secondary qty_close" onclick="close_modal('view_order_modal')">Close</a>
	</div>
</div>