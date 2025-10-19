<?php 
	if($items) {
		$total = 0;
		foreach($items as $key => $val) {
		    $price = $val['amount'];
		    $total = $total + ($val['approved_quantity']*$price);
?>
		 	<tr id="returned-order-item-<?php echo $val['id']; ?>">
		     	<td align="center" valign="middle"><?php echo $key+1; ?></td>
		      	<td align="center" valign="middle"><a href="<?php echo base_url('products/'.$val['product_id'].'/edit'); ?>" target="_blank"><?php echo $val['name']; ?></a></td>
		     	<td align="center" valign="middle" data-price="<?php echo $price; ?>" class="item_price"><?php echo currency().$price; ?></td>
		     	<td align="center" valign="middle"><?php echo $val['quantity']; ?></td>
		     	<td align="center" valign="middle"><?php echo $val['entered_quantity']; ?></td>
		     	<td><input type="number" value="<?php echo $val['approved_quantity']; ?>" min="0" max="<?php echo $val['entered_quantity']; ?>" class="form-control" onchange="update_item_quantity(<?php echo $val['id']; ?>,this.value)" /></td>
		   	</tr>
<?php
		}
	} 
?>
<tr>
    <th style="text-align: right;" colspan="5">total <small style="font-size: 10px !important;">(Price*Approved Qty)</small>:</th>
   	<td align="right"><?php echo currency().$total; ?></td>
</tr>