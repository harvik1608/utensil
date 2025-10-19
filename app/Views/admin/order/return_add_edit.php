<?= $this->extend('include/header'); ?>
<?= $this->section('main_content'); ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css" />
<style>
	#raisepaymentlist td {
		font-size: 12px !important;
	}
	.centered_txt {
		text-align: center !important;
	}
</style>
<?php 
	$module_name = "Returned Order";
	$action = base_url("orders/".$returned_order['id']);
?>
<div class="content-wrapper">
	<div class="container-xxl flex-grow-1 container-p-y">
		<div class="row">
			<div class="col-lg-12">
				<div class="card mb-12">
					<div class="card-header d-flex justify-content-between align-items-center">
						<h5 class="mb-0"><?php echo $module_name; ?></h5>
					</div>
					<div class="card-body">
						<form id="main-form" action="<?php echo $action; ?>" method="post">
							<?php
								echo csrf_field();
								if($order['order_no'] != "") {
									echo '<input type="hidden" name="_method" value="PUT" />';
								}
								echo '<input type="hidden" name="order_status" value="8" />'; 
							?>
							<div class="row">
								<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 mb-4">
									<label class="form-label" for="basic-default-fullname">Order No.</label>
									<input type="text" class="form-control" value="<?php echo $returned_order['order_no']; ?>" disabled />
								</div>
								<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 mb-4">
									<label class="form-label" for="basic-default-fullname">Order Returned On</label>
									<input type="text" class="form-control" value="<?php echo format_date($returned_order['created_at']); ?>" disabled />
								</div>
								<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 mb-4">
									<label class="form-label" for="basic-default-fullname">Refund Amount</label>
									<input type="text" class="form-control" value="<?php echo currency().$returned_order['amount']; ?>" disabled />
								</div>
								<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 mb-4">
									<label class="form-label" for="basic-default-fullname">Approved Amount</label>
									<input type="text" class="form-control" value="<?php echo currency().$returned_order['approved_amount']; ?>" id="approved_amount" disabled />
								</div>
								<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 mb-4">
									<label class="form-label" for="basic-default-fullname">Customer Name</label>
									<input type="text" class="form-control" value="<?php echo $returned_order['fname']; ?>" disabled />
								</div>
								<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 mb-4">
									<label class="form-label" for="basic-default-fullname">Customer Mobile No.</label>
									<input type="text" class="form-control" value="<?php echo $returned_order['phone']; ?>" disabled />
								</div>
								<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 mb-4">
									<label class="form-label" for="basic-default-fullname">Customer Email</label>
									<input type="text" class="form-control" value="<?php echo $returned_order['email']; ?>" disabled />
								</div>
								<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 mb-4">
									<label class="form-label" for="basic-default-fullname">Status</label>
									<select class="form-control select2" id="status" name="status">
										<option value="">Choose status</option>
										<option value="0" <?php echo $returned_order['status'] == 0 ? "selected" : ""; ?>>Pending</option>
										<option value='1' <?php echo $returned_order['status'] == 1 ? "selected" : ""; ?>>Accepted</option>
										<option value='2' <?php echo $returned_order['status'] == 2 ? "selected" : ""; ?>>Rejected</option>
									</select>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 mb-4">
									<label class="form-label" for="basic-default-fullname">Customer Note</label>
									<textarea class="form-control" disabled><?php echo $returned_order['note']; ?></textarea>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 mb-4">
									<label class="form-label" for="basic-default-fullname">Comment</label>
									<textarea class="form-control" name="comment" id="comment"><?php echo $returned_order['comment']; ?></textarea>
								</div>
								<?php
									if($returned_order['images'] != "") {
										$images = json_decode($returned_order['images'],true);
										if(!empty($images)) {
											echo '<div class="row">';
											foreach($images as $image) {
								?>
												<div class="col-lg-3 col-md-12 col-sm-12 col-xs-12 mb-4">
													<center><div class="avatar">
			        									<a data-fancybox="gallery" href="<?php echo base_url('public/uploads/returned_order/'.$image['avatar']); ?>">
			        										<img src="<?php echo base_url('public/uploads/returned_order/'.$image['avatar']); ?>" alt="" class="w-px-40 h-auto rounded-circle">
			        									</a>
			      									</div></center>
			      								</div>
								<?php
											}
											echo '</div>';
										}
									} 
								?>
							</div>
							<h6 class="mb-3">Returned Order Items</h6>
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<table class="table table-bordered align-middle" id="returned-order-items-tbl">
	      								<thead>
	        								<tr>
	          									<th width="5%" class="centered_txt">#</th>
	          									<th width="30%" class="centered_txt"><small>Product</small></th>
	          									<th width="10%" class="centered_txt">Price</th>
	          									<th width="10%" class="centered_txt">Qty</th>
	          									<th width="10%" class="centered_txt">Returned Qty</th>
	          									<th width="10%" class="centered_txt">Approved Qty</th>
	          									<!-- <th width="10%"style="text-align: right;">Total</th> -->
	        								</tr>
	      								</thead>
	      								<tbody>
	      									
	      								</tbody>
	    							</table>
								</div>
							</div><br>
							<button type="submit" class="btn btn-primary btn-sm">SUBMIT</button>
							<a class="btn btn-danger btn-sm text-white" id="back-btn" href="<?php echo base_url('returned-orders'); ?>">Back</a>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.umd.js"></script>
<script type="text/javascript">
	var page_title = "Returned Orders";
	var returned_order_id = "<?php echo $returned_order['id']; ?>";
	var currency = "<?php echo currency(); ?>";
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
	});
	function raise_payment_request()
	{
		$("#raise_payment_request_modal").modal("show");
	}
	function get_order_items()
	{
		$.ajax({
			url: "<?php echo base_url('get-returned-order-items'); ?>",
			type: "GET",
			data: {
				returned_order_id: returned_order_id
			},
			success:function(response){
				if(response.status == "success") {
					$("#returned-order-items-tbl tbody").html(response.html);
				} else {
					show_toast(response.message);
				}
			}
		});
	}
	function update_item_quantity(item_id,new_qty)
	{
		var approved_amount = 0;
		$("#returned-order-items-tbl tbody tr[id*=returned-order-item-]").each(function(){
			var qty = $(this).find(".item_price").attr("data-price");
			var amt = $(this).find("input").val();
			approved_amount = approved_amount + (qty*amt);
		});
		$.ajax({
			url: "<?php echo base_url('update-returned-order-item-quantity'); ?>",
			type: "GET",
			data: {
				item_id: item_id,
				new_qty: new_qty,
				approved_amount: approved_amount
			},
			success:function(response){
				show_toast(response.message);
				if(response.status == "success") {
					let formatted = approved_amount.toFixed(2); 
					$("#approved_amount").val(currency+""+formatted);
					get_order_items();
				} else {
					$("#returned-order-item-"+item_id+" input").val(0);
				}
			}
		});
	}
</script>
<?= $this->endSection(); ?>