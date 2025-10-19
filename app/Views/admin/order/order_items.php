<?php 
	if($items) {
		foreach($items as $key => $val) {
		    $price = $val['product_discount_amt'] > 0 ? $val['product_discount_amt'] : $val['product_amt'];
		    $total = $val['quantity']*$price;
?>
		 	<tr>
		     	<td><?php echo $key+1; ?></td>
		      	<td><a href="<?php echo base_url('products/'.$val['product_id'].'/edit'); ?>" target="_blank"><?php echo $val['name']; ?></a></td>
		     	<td><?php echo currency().$price; ?></td>
		     	<td><input type="number" value="<?php echo $val['quantity']; ?>" class="form-control" onchange="update_item_quantity(<?php echo $val['id']; ?>,this.value)" /></td>
		      	<td align="right"><?php echo currency().number_format($total,2); ?></td>
		   	</tr>
<?php
		}
	} 
?>
<tr>
    <th style="text-align: right;" colspan="4">Subtotal :</th>
   	<td align="right"><?php echo currency().$order['amount']; ?></td>
</tr>
<tr>
   	<th style="text-align: right;" colspan="4">SHIPPING CHARGE :</th>
   	<td align="right"><?php echo currency().$order['shipping_cost']; ?></td>
</tr>
<tr>
   	<th style="text-align: right;" colspan="4">VAT CHARGE :</th>
    <td align="right"><?php echo currency().$order['vat_charge']; ?></td>
</tr>
<tr>
   	<th style="text-align: right;" colspan="4">TOTAL :</th>
    <td align="right"><?php echo currency().number_format($order['amount']+$order['shipping_cost']+$order['vat_charge'],2); ?></td>
</tr>