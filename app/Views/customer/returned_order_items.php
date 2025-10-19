<p><b>Order No.: #<?php echo $order['order_no']; ?></b></p>
<div class="table-responsive">
	<table class="table ec-table table-bordered" id="return-order-item">
		<thead>
			<tr>
				<th width="15%">Image</th>
				<th width="30%">Product Name</th>
				<th width="15%">Price</th>
				<th width="10%">Qty</th>
				<th width="10%">Returned Qty</th>
				<th width="10%">Approved Qty</th>
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
				?>
						<tr>
							<td>
								<img class="ec-cart-pro-img mr-4" src="<?php echo $src; ?>" alt="<?php echo $val['name']; ?>" />
							</td>
							<td align="center" valign="middle"><?php echo $val['name']; ?></td>
							<td align="center" valign="middle"><?php echo currency().$val['amount']; ?></td>
							<td align="center" valign="middle"><?php echo $val['quantity']; ?></td>
							<td align="center" valign="middle"><?php echo $val['entered_quantity']; ?></td>
							<td align="center" valign="middle"><?php echo $val['approved_quantity']; ?></td>
						</tr>
			<?php
					}
				}
			?>
			</tbody>
		</table>
	</div>
	<div class="col-md-12 space-t-15">
       	<label class="form-label">Note</label>
       	<textarea class="form-control"placeholder="Your note" disabled><?php echo $order['note']; ?></textarea>
   	</div>
   	<?php 
   		if(!is_null($order['comment']) && $order['comment'] != "") { 
   	?>
   			<div class="col-md-12 mt-2 space-t-15">
       			<label class="form-label">Comment</label>
       			<textarea class="form-control" placeholder="Your note" disabled><?php echo $order['comment']; ?></textarea>
   			</div>
   	<?php 
   		} 
   	?>
	<div id="preview"></div>
	<div class="col-md-12 space-t-15">
		<a href="javascript:;" class="btn btn-lg btn-secondary" onclick="close_modal('view_order_modal')">Close</a>
	</div>