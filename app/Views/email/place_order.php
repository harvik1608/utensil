<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title></title>
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
		<style>
			body {
				font-family: Nunito, serif !important;
				font-optical-sizing: auto;
				font-weight: 400;
				font-style: normal;
			}
		</style>
	</head>
	<body>
		<table width="100%">
			<tbody>
				<tr>
					<td>Hello Admin</td>
				</tr>
				<tr>
					<td colspan="2"><p>A new order has been placed on your website. Here are the details:</p></td>
				</tr>
				<tr>
					<td>Customer Name</td>
					<td>: <?php echo $customer_name; ?></td>
				</tr>
				<tr>
					<td>Customer Email</td>
					<td>: <?php echo $customer_email; ?></td>
				</tr>
				<tr>
					<td>Customer Phone</td>
					<td>: <?php echo $customer_phone; ?></td>
				</tr>
				<tr>
					<td>Order No</td>
					<td>: #<?php echo $order_id; ?></td>
				</tr>
				<tr>
					<td>Order Date</td>
					<td>: <?php echo $order_date; ?></td>
				</tr>
				<tr>
					<td>Total Amount</td>
					<td>: <?php echo $currency." ".number_format($amount,2); ?></td>
				</tr>
			</tbody>
		</table>
		<p>Order Details</p>
		<table width="100%;border: 1px solid #efefef;padding: 5px;">
			<thead>
				<tr>
					<th style="border: 1px solid #efefef;" align="left">Item</th>
					<th style="border: 1px solid #efefef;">Quantity</th>
					<th style="border: 1px solid #efefef;">Price</th>
					<th style="border: 1px solid #efefef;" align="right">Total</th>
				</tr>
			</thead>
			<tbody>
				<?php
					if($items) {
						$grand_total = 0;
						foreach($items as $item) {
							$price = $item["product_discount_amt"] > 0 ? $item["product_discount_amt"] : $item["product_amt"];
							$total = $price*$item["quantity"];
				?>
							<tr>
								<td style="border: 1px solid #efefef;font-size: 13px;" align="left"><?php echo $item['name']; ?></td>
								<td style="border: 1px solid #efefef;font-size: 13px;" align="center"><?php echo $item['quantity']; ?></td>
								<td style="border: 1px solid #efefef;font-size: 13px;" align="center"><?php echo $price; ?></td>
								<td style="border: 1px solid #efefef;font-size: 13px;" align="right"><?php echo $currency." ".number_format($total,2); ?></td>
							</tr>
				<?php
							$grand_total = $grand_total + $total;
						}
					}
				?>
						<tr>
							<td style="border: 1px solid #efefef;font-size: 13px;" colspan="3">Total</td>
							<td style="border: 1px solid #efefef;font-size: 13px;" align="right"><?php echo $currency." ".number_format($grand_total,2); ?></td>
						</tr>
						<tr>
							<td style="border: 1px solid #efefef;font-size: 13px;" colspan="3">Shipping Charge</td>
							<td style="border: 1px solid #efefef;font-size: 13px;" align="right"><?php echo $currency." ".number_format($shipping_charge,2); ?></td>
						</tr>
						<tr>
							<td style="border: 1px solid #efefef;font-size: 13px;" colspan="3">VAT Charge (<?php echo VAT_CHARGE; ?>%)</td>
							<td style="border: 1px solid #efefef;font-size: 13px;" align="right"><?php echo $currency." ".number_format($vat_charge,2); ?></td>
						</tr>
						<tr>
							<td style="border: 1px solid #efefef;font-size: 13px;" colspan="3">Total Amount</td>
							<td style="border: 1px solid #efefef;font-size: 13px;" align="right"><?php echo $currency." ".number_format($amount,2); ?></td>
						</tr>
				<?php
				?>
			</tbody>
		</table>
		<table>
			<tbody>
				<tr>
					<td>Please log in to your admin panel to process the order. <a href="<?php echo base_url('admin-panel'); ?>">Admin Login In</a></td>
				</tr>
			</tbody>
		</table>
	</body>
</html>