<p><b>Order No.: #<?php echo $order['order_no']; ?></b></p>
<form class="row g-3" method="post" action="<?php echo base_url('update-myprofile'); ?>" id="return-order-form">
	<?php echo csrf_field(); ?>
	<input type="hidden" name="order_id" value="<?php echo $order['id']; ?>" />
	<div class="table-responsive">
		<table class="table ec-table table-bordered" id="return-order-item">
			<thead>
				<tr>
					<th width="15%">Image</th>
					<th width="30%">Product Name</th>
					<th width="15%">Quantity</th>
					<th width="10%">Price</th>
					<th width="20%">Return Quantity</th>
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
				?>
							<tr>
								<td>
									<img class="ec-cart-pro-img mr-4" src="<?php echo $src; ?>" alt="<?php echo $val['name']; ?>" />
									<input type="hidden" name="quantity[]" value="<?php echo $val['quantity']; ?>" />
									<input type="hidden" name="price[]" value="<?php echo $price; ?>" />
									<input type="hidden" name="product_id[]" value="<?php echo $val['product_id']; ?>" />
								</td>
								<td align="center" valign="middle"><?php echo $val['name']; ?></td>
								<td align="center" valign="middle">
									<input type="text" min="0" max="<?php echo $val['quantity']; ?>" value="<?php echo $val['quantity']; ?>" class="form-control" disabled />
								</td>
								<td align="center" valign="middle"><?php echo currency().$price; ?></td>
								<td align="center" valign="middle">
									<input type="text" min="0" max="<?php echo $val['quantity']; ?>" class="form-control" name="entered_quantity[]" placeholder="Enter quantity" />
								</td>
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
       	<textarea class="form-control" name="note" id="note" placeholder="Your note"></textarea>
   	</div>
   	<div id="dropzone">Drop image here or click to select</div>
   	<input type="file" id="fileInput" accept="image/*" multiple hidden>
	<div id="preview"></div>
	<div class="col-md-12 space-t-15">
		<button class="btn btn-sm btn-primary" type="submit">Submit</button>
		<a href="javascript:;" class="btn btn-lg btn-secondary" onclick="close_modal('view_order_modal')">Close</a>
	</div>
</form>