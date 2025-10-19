<?php 
	if($products) {
		$grand_total = 0;
		foreach($products as $product) {
			$src = base_url("public/website/assets/images/product-image/1.jpg");
			if($product["avatar"] != "" && file_exists("public/uploads/product/".$product["avatar"])) {
				$src = base_url("public/uploads/product/".$product["avatar"]);
			}
			$price = $product["discount_price"] > 0 ? $product["discount_price"] : $product["price"];
			$total = $price*$product["quantity"];
			$grand_total = $grand_total + $total;
?>
			<tr id="cart-<?php echo $product['cart_id']; ?>">
				<td data-label="Remove" class="ec-cart-pro-remove ec-cart-pro-qty">
                    <a href="javascript:;" onclick="remove_from_cart('cart-<?php echo $product['cart_id']; ?>')"><i class="ecicon eci-trash-o"></i></a>
                </td>
				<td data-label="Product" class="ec-cart-pro-name">
					<a href="<?php echo base_url('product/'.$product['slug']); ?>">
						<img class="ec-cart-pro-img mr-4" src="<?php echo $src; ?>" alt="<?php echo $product['name']; ?>" /><?php echo $product['name']; ?>
					</a>
				</td>
				<td data-label="Price" class="ec-cart-pro-price">
					<span class="amount"><?php echo currency()." ".$price; ?></span>
				</td>
				<td data-label="Price" class="ec-cart-pro-price">
					<span class="amount"><?php echo $product['min_order']; ?></span>
				</td>
				<td data-label="Quantity" class="ec-cart-pro-qty">
					<div class="cart-qty-plus-minus">
                        <input class="cart-plus-minus" type="text" name="cartqtybutton" value="<?php echo (float) $product['quantity']; ?>" onchange="update_cart_quantity(this.value,<?php echo $product['cart_id']; ?>)" />
                   	</div>
               	</td>
               	<td data-label="Total" class="ec-cart-pro-subtotal"><?php echo currency()." ".number_format($total,2); ?></td>
			</tr>
<?php
		}
		$calc_charge = calc_charge($grand_total);
		$shipping_charge = $calc_charge["shipping_charge"];
		$vat_charge = $calc_charge["vat_charge"];
		$total_amount = $grand_total + $shipping_charge + $vat_charge;
?>
		<tr>
			<td colspan="5" class="ec-cart-pro-subtotal">Sub Total</td>
			<td class="ec-cart-pro-subtotal"><b><?php echo currency()." ".number_format($grand_total,2); ?></b></td>
		</tr>
		<tr>
			<td colspan="5" class="ec-cart-pro-subtotal">Shipping Charge</td>
			<td class="ec-cart-pro-subtotal"><b><?php echo currency()." ".number_format($shipping_charge,2); ?></b></td>
		</tr>
		<tr>
			<td colspan="5" class="ec-cart-pro-subtotal">VAT Charge (<?php echo VAT_CHARGE; ?>%)</td>
			<td class="ec-cart-pro-subtotal"><b><?php echo currency()." ".number_format($vat_charge,2); ?></b></td>
		</tr>
		<tr>
			<td colspan="5" class="ec-cart-pro-subtotal">Total Amount</td>
			<td class="ec-cart-pro-subtotal cart-total-amount"><b><?php echo currency()." ".number_format($total_amount,2); ?></b></td>
		</tr>
<?php
	}
?>