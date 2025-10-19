<?= $this->extend('include/header'); ?>
<?= $this->section('main_content'); ?>
<style>
	h5 {
		color: #fff;
	}
    .order-card { 
    	border-radius: 12px; 
    	box-shadow: 0 4px 10px rgba(0,0,0,0.08); 
    }
    .order-header { 
    	background: #696cff; 
    	color: #fff; 
    	border-radius: 12px 12px 0 0; 
    	padding: 20px; 
    }
    .table th { 
    	background-color: #f1f1f1; 
    }
    .logo { 
    	font-size: 22px; 
    	font-weight: bold; 
    	color: #fff; 
    }
    .shipping {
    	text-align: right;
    }
  </style>
<div class="content-wrapper">
	<div class="container-xxl flex-grow-1 container-p-y">
		<div class="row">
			<div class="col-xl">
				<div class="card mb-12">
					<div class="order-card bg-white">
   						<div class="order-header d-flex justify-content-between align-items-center">
      						<div class="logo">SuperMetPlast</div>
      						<div>
        						<h5 class="mb-0">Order #<?php echo $order['order_no']; ?></h5>
        						<small>Placed on: <?php echo format_date($order['order_date']); ?></small>
      						</div>
    					</div>
    					<!-- Order Info -->
    					<div class="p-4">
      						<div class="row mb-4">
        						<div class="col-md-6">
          							<h6>Customer Information</h6>
          							<p class="mb-1"><strong>Name &nbsp;:</strong> <?php echo $customer['fname'].' '.$customer['lname']; ?></p>
          							<p class="mb-1"><strong>Email &nbsp;:</strong> <?php echo $customer['email']; ?></p>
          							<p class="mb-1"><strong>Phone :</strong> <?php echo $customer['phone']; ?></p>
        						</div>
        						<div class="col-md-6 shipping">
          							<h6>Shipping Address</h6>
          							<p class="mb-1"><?php echo $order_shipping['address']; ?></p>
          							<p class="mb-1"><?php echo $order_shipping['city'].' '.$order_shipping['region'].' '.$order_shipping['postcode']; ?></p>
          							<p class="mb-1"><?php echo $order_shipping['country']; ?></p>
          							<p class="mb-1">Contact No: <?php echo $order_shipping['shipping_phone']; ?></p>
        						</div>
      						</div>
      						<!-- Product Table -->
      						<h6 class="mb-3">Order Items</h6>
  							<div class="table-responsive">
    							<table class="table table-bordered align-middle">
      								<thead>
        								<tr>
          									<th>#</th>
          									<th>Product</th>
          									<th>Qty</th>
          									<th>Unit Price</th>
          									<th style="text-align: right;">Total</th>
        								</tr>
      								</thead>
      								<tbody>
      									<?php
      										if($items) {
      											foreach($items as $key => $val) {
      												$price = $val['product_discount_amt'] > 0 ? $val['product_discount_amt'] : $val['product_amt'];
      												$total = $val['quantity']*$price;
      									?>
      												<tr>
      													<td><?php echo $key+1; ?></td>
      													<td><?php echo $val['name']; ?></td>
      													<td><?php echo $val['quantity']; ?></td>
      													<td><?php echo currency().$price; ?></td>
      													<td align="right"><?php echo currency().number_format($total,2); ?></td>
      												</tr>
      									<?php
      											}
      										} 
      									?>
      									<tr>
          									<th style="text-align: right;" colspan="4">Subtotal:</th>
          									<td align="right"><?php echo currency().$order['amount']; ?></td>
        								</tr>
        								<tr>
          									<th style="text-align: right;" colspan="4">SHIPPING CHARGE:</th>
          									<td align="right"><?php echo currency().$order['shipping_cost']; ?></td>
        								</tr>
        								<tr>
          									<th style="text-align: right;" colspan="4">VAT CHARGE:</th>
          									<td align="right"><?php echo currency().$order['vat_charge']; ?></td>
        								</tr>
        								<tr>
          									<th style="text-align: right;" colspan="4">TOTAL:</th>
          									<td align="right"><?php echo currency().number_format($order['amount']+$order['shipping_cost']+$order['vat_charge'],2); ?></td>
        								</tr>
      								</tbody>
    							</table>
  							</div>
  							<!-- Footer -->
  							<div class="text-center mt-4">
    							<p class="text-muted mb-1">Thank you for shopping with <?php echo general_setting('app_name'); ?>!</p>
    							<small>If you have any questions, contact us at <?php echo general_setting('app_email'); ?></small>
    							<br><br>
    							<a href="<?php echo base_url('download-invoice/'.$order['id']); ?>" class="btn btn-sm btn-info">Download Invoice</a>
    							<a href="<?php echo base_url('orders'); ?>" class="btn btn-sm btn-primary">Back</a>
  							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	var page_title = "Orders";
</script>
<?= $this->endSection(); ?>