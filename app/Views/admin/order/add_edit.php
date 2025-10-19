<?= $this->extend('include/header'); ?>
<?= $this->section('main_content'); ?>
<style>
	#raisepaymentlist td {
		font-size: 12px !important;
	}
</style>
<?php 
	$module_name = "Edit Order";
	$action = base_url("orders/".$order['id']);
?>
<div class="content-wrapper">
	<div class="container-xxl flex-grow-1 container-p-y">
		<div class="row">
			<div class="col-lg-8">
				<div class="card mb-12">
					<div class="card-header d-flex justify-content-between align-items-center">
						<h5 class="mb-0">
							<?php echo $module_name; ?>
							<!-- <a class="btn btn-sm btn-danger text-white">Cancel Order</a> -->
						</h5>
					</div>
					<div class="card-body">
						<form id="main-form" action="<?php echo $action; ?>" method="post">
							<?php
								echo csrf_field();
								if($order['order_no'] != "") {
									echo '<input type="hidden" name="_method" value="PUT" />';
								} 
							?>
							<div class="row">
								<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-4">
									<label class="form-label" for="basic-default-fullname">Order No.</label>
									<input type="text" class="form-control" value="<?php echo $order['order_no']; ?>" disabled />
								</div>
								<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-4">
									<label class="form-label" for="basic-default-fullname">Order Placed On</label>
									<input type="text" class="form-control" value="<?php echo format_date($order['order_date']); ?>" disabled />
								</div>
								<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-4">
									<label class="form-label" for="basic-default-fullname">Order Status</label>
									<select class="form-control select2" id="status" name="status">
										<option value="">choose status</option>
										<option value="0" <?php echo $order['status'] == 0 ? "selected" : ""; ?>>Order placed</option>
										<option value='1' <?php echo $order['status'] == 1 ? "selected" : ""; ?>>Order shipped</option>
										<option value='2' <?php echo $order['status'] == 2 ? "selected" : ""; ?>>On the way</option>
										<!-- <option value='3' <?php echo $order['status'] == 3 ? "selected" : ""; ?>>Order cancelled by customer</option> -->
										<!-- <option value='4' < ?php echo $order['status'] == 4 ? "selected" : ""; ?>>Order cancelled by website</option> -->
										<option value='5' <?php echo $order['status'] == 5 ? "selected" : ""; ?>>Reached at your city</option>
										<option value='6' <?php echo $order['status'] == 6 ? "selected" : ""; ?>>Out of delivery</option>
										<option value='7' <?php echo $order['status'] == 7 ? "selected" : ""; ?>>Delivered</option>
										<!-- <option value='8' <?php echo $order['status'] == 8 ? "selected" : ""; ?>>Returned Order</option> -->
									</select>
								</div>
								<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-4">
									<label class="form-label" for="basic-default-fullname">Customer Name</label>
									<input type="text" class="form-control" value="<?php echo $customer['fname']; ?>" disabled />
								</div>
								<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-4">
									<label class="form-label" for="basic-default-fullname">Customer Email</label>
									<input type="text" class="form-control" value="<?php echo $customer['email']; ?>" disabled />
								</div>
								<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-4">
									<label class="form-label" for="basic-default-fullname">Customer Mobile No.</label>
									<input type="text" class="form-control" value="<?php echo $customer['phone']; ?>" disabled />
								</div>
								<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-4">
									<label class="form-label" for="basic-default-fullname">Order Amount</label>
									<input type="text" class="form-control" value="<?php echo currency().$order['amount']; ?>" disabled />
								</div>
								<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-4">
									<label class="form-label" for="basic-default-fullname">Shipping Charge</label>
									<input type="text" class="form-control" value="<?php echo currency().$order['shipping_cost']; ?>" disabled />
								</div>
								<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-4">
									<label class="form-label" for="basic-default-fullname">VAT Charge</label>
									<input type="text" class="form-control" value="<?php echo currency().$order['vat_charge']; ?>" disabled />
								</div>
							</div>
							<h6 class="mb-3">Order Items <a href="javascript:raise_payment_request();" class="raise_payment" >Raise payment request</a></h6>
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<table class="table table-bordered align-middle" id="order-items-tbl">
	      								<thead>
	        								<tr>
	          									<th width="5%">#</th>
	          									<th width="50%"><small>Product</small></th>
	          									<th width="20%">Unit Price</th>
	          									<th width="20%">Qty</th>
	          									<th width="10%"style="text-align: right;">Total</th>
	        								</tr>
	      								</thead>
	      								<tbody>
	      									
	      								</tbody>
	    							</table>
								</div>
							</div><br>
							<button type="submit" class="btn btn-primary btn-sm">SUBMIT</button>
							<a class="btn btn-danger btn-sm text-white" id="back-btn" href="<?php echo base_url('orders'); ?>">Back</a>
						</form>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="card mb-12">
					<div class="card-header d-flex justify-content-between align-items-center">
						<h5 class="mb-0">Order Payment Requests</h5>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<?php
	      							if($order_payment_requests) {
	      						?>
										<table class="table table-bordered align-middle" id="raisepaymentlist">
		      								<thead>
		        								<tr>
		          									<th width="10%">Type</th>
			          								<th width="15%">Raised On</th>
			          								<th width="10%">Status</th>
			          								<th width="10%" style="text-align: right;">Amount</th>
			        							</tr>
			      							</thead>
		      								<tbody>
		      									<?php
		      										foreach($order_payment_requests as $key => $val) {
		      									?>
		      											<tr>
		      												<td><?php echo $val['request_type'] == 1 ? "Credit" : "Debit"; ?></td>
		      												<td><?php echo format_date($val['created_at']); ?></td>
		      												<td>
		      													<?php
		      														switch($val["status"]) {
		      															case 0:
		      																echo "PENDING";
		      																break;

		      															case 1:
		      																echo "PAID";
		      																break;

		      															case 2:
		      																echo "FAILED";
		      																break;
		      														} 
		      													?>
		      												</td>
		      												<td align="right"><?php echo currency().$val['amount']; ?></td>
		      											</tr>
		      									<?php
		      										} 
		      									?>
		      								</tbody>
		    							</table>
	    						<?php 
	    							} else {
	    								echo '<p>No any payment request raised yet.</p>';
	    							}
	    						?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="raise_payment_request_modal" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<form method="POST" action="<?php echo base_url('raise-payment-request'); ?>" id="raisePaymentRequestForm">
				<?php echo csrf_field(); ?>
				<input type="hidden" name="order_id" value="<?php echo $order['id']; ?>" />
				<input type="hidden" name="customer_id" value="<?php echo $customer['id']; ?>" />
				<div class="modal-header">
					<h5 class="modal-title" id="modalCenterTitle">Raise Payment Request</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close_raise_payment_request_modal"></button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col col-lg-6 col-md-12 col-sm-12 col-xs-12 mb-6">
							<label for="nameWithTitle" class="form-label">Order No.</label>
							<input type="text" class="form-control" value="<?php echo $order['order_no']; ?>" disabled />
						</div>
						<div class="col col-lg-6 col-md-12 col-sm-12 col-xs-12 mb-6">
							<label for="nameWithTitle" class="form-label">Customer Name</label>
							<input type="text" class="form-control" value="<?php echo $customer['fname']." ".$customer['lname']; ?>" disabled />
						</div>
						<div class="col col-lg-6 col-md-12 col-sm-12 col-xs-12 mb-6">
							<label for="nameWithTitle" class="form-label">Amount</label>
							<input type="number" id="amount" min="0" class="form-control" placeholder="Enter amount" name="amount" />
						</div>
						<div class="col col-lg-6 col-md-12 col-sm-12 col-xs-12 mb-6">
							<label for="nameWithTitle" class="form-label">Request Type</label>
							<select class="form-control" name="request_type" id="request_type">
								<option value="">Choose option</option>
								<option value="1">Credit</option>
								<option value="2">Debit</option>
							</select>
						</div>
						<div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-6">
							<label for="nameWithTitle" class="form-label">Comment</label>
							<textarea class="form-control" name="note" id="note" placeholder="Enter comment here..."></textarea>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script type="text/javascript">
	var csrfName = '<?= csrf_token() ?>';  // usually 'csrf_test_name'
   	var csrfHash = '<?= csrf_hash() ?>';  // actual token
	var page_title = "All Orders";
	var order_id = "<?php echo $order['id']; ?>";
	$(document).ready(function(){
		get_order_items();
		$("#main-form").submit(function(e){
			e.preventDefault();

			$.ajax({
				url: $("#main-form").attr("action"),
				type: $("#main-form").attr("method"),
				data: new FormData(this),
				contentType: false,
				processData: false,
				cache: false,
				beforeSend:function(){
					$("#main-form button[type=submit]").html('<div class="spinner-border spinner-border-sm text-primary" role="status"><span class="visually-hidden">Loading...</span></div>').attr("disabled",true);
				},
				success:function(response){
					$("input[name=csrf_token]").val(response.csrf);
					if(response.status == "success") {
						window.location.href = $("#back-btn").attr("href");
					} else {
						show_toast(response.message);
						$("#main-form button[type=submit]").html('Submit').attr("disabled",false);
					}
				},
				error: function(xhr, status, error) {  // Function to handle errors
					const response = xhr.responseJSON;
					if (response?.csrf) {
					   	$("input[name=csrf_token]").val(response.csrf);
					}
					show_toast(error);
					$("#main-form button[type=submit]").html('Submit').attr("disabled",false);
				},
			});
		});
		// raise payment request form
		$("#raisePaymentRequestForm").submit(function(e){
			e.preventDefault();

			if($("#raisePaymentRequestForm").valid()) {
				$.ajax({
					url: $("#raisePaymentRequestForm").attr("action"),
					type: $("#raisePaymentRequestForm").attr("method"),
					data: new FormData(this),
					contentType: false,
					processData: false,
					cache: false,
					beforeSend:function(){
						$("#raisePaymentRequestForm button[type=submit]").html('<div class="spinner-border spinner-border-sm text-primary" role="status"><span class="visually-hidden">Loading...</span></div>').attr("disabled",true);
					},
					success:function(response){
						$("input[name=csrf_token]").val(response.csrf);
						if(response.status == "success") {
							window.location.reload();
						} else {
							show_toast(response.message);
							$("#raisePaymentRequestForm button[type=submit]").html('Submit').attr("disabled",false);
						}
					},
					error: function(xhr, status, error) {  // Function to handle errors
						const response = xhr.responseJSON;
					    if (response?.csrf) {
					        $("input[name=csrf_token]").val(response.csrf);
					    }
					    show_toast(error);
					    $("#raisePaymentRequestForm button[type=submit]").html('Submit').attr("disabled",false);
					},
				});
			}
		});
	});
	function raise_payment_request()
	{
		$("#raise_payment_request_modal").modal("show");
	}
	function get_order_items()
	{
		$.ajax({
			url: "<?php echo base_url('get-order-items'); ?>",
			type: "GET",
			data: {
				order_id: order_id
			},
			success:function(response){
				if(response.status == "success") {
					$("#order-items-tbl tbody").html(response.html);
				} else {
					show_toast(response.message);
				}
			}
		});
	}
	function update_item_quantity(item_id,new_qty)
	{
		$.ajax({
			url: "<?php echo base_url('update-order-item-quantity'); ?>",
			type: "POST",
			data: {
				item_id: item_id,
				new_qty: new_qty,
				[csrfName]: csrfHash
			},
			success:function(response){
				if (response.csrf) {
				  	csrfHash = response.csrf;
				}
				show_toast(response.message);
				if(response.status == "success") {
					get_order_items();
				}
			}
		});
	}
</script>
<?= $this->endSection(); ?>