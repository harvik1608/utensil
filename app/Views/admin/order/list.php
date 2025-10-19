<?= $this->extend('include/header'); ?>
<?= $this->section('main_content'); ?>
<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css"> -->
<link rel="stylesheet" href="<?php echo base_url('public/assets/css/datatable/datatables.bootstrap5.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('public/assets/css/datatable/responsive.bootstrap5.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('public/assets/css/datatable/datatables.checkboxes.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('public/assets/css/datatable/buttons.bootstrap5.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('public/assets/css/datatable/rowgroup.bootstrap5.css'); ?>">
<div class="content-wrapper">
	<div class="container-xxl flex-grow-1 container-p-y">
		<div class="card">
			<h5 class="card-header"><?php echo $page_title; ?></h5>
			<div class="card-body">
				<form method="post">
					<div class="row">
						<div class="col-3 mb-4">
							<label class="form-label" for="basic-default-fullname">Order No.</label>
							<input type="text" class="form-control" id="order_no" placeholder="Search via order no." />
						</div>
						<div class="col-3 mb-4">
							<label class="form-label" for="basic-default-fullname">Customer Name</label>
							<input type="text" class="form-control" id="customer_name" placeholder="Search via customer name" />
						</div>
						<div class="col-3 mb-4">
							<label class="form-label" for="basic-default-fullname">Customer Phone</label>
							<input type="text" class="form-control" id="customer_phone" placeholder="Search via customer phone" />
						</div>
						<div class="col-3 mb-4">
							<label class="form-label" for="basic-default-fullname">Amount</label>
							<input type="text" class="form-control" id="amount" placeholder="Search via amount" />
						</div>
						<div class="col-3 mb-4">
							<label class="form-label" for="basic-default-fullname">Date</label>
							<input type="date" class="form-control" id="order_date" placeholder="Search via date" />
						</div>
						<div class="col-3 mb-4">
							<label class="form-label" for="basic-default-fullname">Status</label>
							<select class="form-control select2" id="status">
								<option value="">choose status</option>
								<option value="0">Order placed</option>
								<option value='1'>Order shipped</option>
								<option value='2'>On the way</option>
								<option value='3'>Order cancelled by customer</option>
								<option value='4'>Order cancelled by website</option>
								<option value='5'>Reached at your city</option>
								<option value='6'>Out of delivery</option>
								<option value='7'>Delivered</option>
								<option value='8'>Returned Order</option>
							</select>
						</div>
						<div class="col-3 mt-6">
							<a class="btn btn-sm btn-primary text-white" id="clearBtn">Clear All</a>
						</div>
					</div>
				</form>
				<div class="table-responsive">
					<table class="table table-default" id="tblList">
						<thead>
							<tr>
	          					<th width="5%">No</th>
	          					<th width="10%">Order No.</th>
	          					<th width="15%">Customer</th>
	          					<th width="15%">Phone No.</th>
	          					<th width="10%">Amount</th>
	          					<th width="15%">Date</th>
	          					<th width="15%">Status</th>
	          					<th width="10%">Action</th>
							</tr>
						</thead>
						<tbody>
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="<?php echo base_url('public/assets/css/datatable/datatables-bootstrap5.js'); ?>"></script>
<script type="text/javascript">
	var page_title = "<?php echo $page_title; ?>";
	var order_page_type = "<?php echo $order_page_type; ?>";
	$(document).ready(function() {
        load_data();
        $("#order_no,#customer_name,#customer_phone,#amount").keyup(function(){
        	load_data();
        });
        $("#order_date,#status").change(function(){
        	load_data();
        });
        $("#clearBtn").click(function(){
        	$("#order_no,#customer_name,#customer_phone,#amount,#order_date").val("");
        	load_data();
        });
    });
    function load_data()
    {

    	$('#tblList').DataTable().destroy();
    	$('#tblList').DataTable({
			"serverSide": true, // Enable server-side processing
	    	"processing": true,
	    	"pageLength": 25,
			"ajax":{
	            url: "<?php echo base_url('load-orders'); ?>",
	            type: "get",
	            data:{
	            	order_page_type: order_page_type,
	            	order_no: $("#order_no").val(),
	            	customer_name: $("#customer_name").val(),
	            	customer_phone: $("#customer_phone").val(),
	            	amount: $("#amount").val(),
	            	order_date: $("#order_date").val(),
	            	status: $("#status").val()
	            }
	        },
	        "searching": false,
	        "columns": [
		        { "data": 0 },
		        { "data": 1 },
		        { "data": 2 },
		        { "data": 3 },
		        { "data": 4 },
		        { "data": 5 },
		        { "data": 6 },
		        { "data": 7 }
		    ],
		    "order": [[0, "desc"]]
		});
    }
</script>
<?= $this->endSection(); ?>