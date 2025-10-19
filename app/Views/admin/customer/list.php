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
			<h5 class="card-header">
				Customer List  <a href="<?php echo base_url('customers/new'); ?>" class="btn btn-primary btn-sm text-white" style="float: right;">New</a>
			</h5>
			<div class="container">
				<div class="table-responsive">
				<table class="table table-default" id="tblList">
					<thead>
						<tr>
          					<th width="5%">No</th>
          					<th width="20%">Name</th>
          					<th width="20%">Email</th>
          					<th width="10%">Phone</th>
          					<th width="15%">Added On</th>
          					<th width="15%">Status</th>
          					<th width="15%">Action</th>
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
	var page_title = "Customers";
	$(document).ready(function() {
        load_data(); 
    });
    function load_data()
    {
    	$('#tblList').DataTable().destroy();
    	$('#tblList').DataTable({
			"serverSide": true, // Enable server-side processing
	    	"processing": true,
	    	"pageLength": 25,
			"ajax":{
	            url: "<?php echo base_url('load-customers'); ?>",
	            type: "get",
	        },
	        "searching": true,
	        "columns": [
		        { "data": 0 },
		        { "data": 1 },
		        { "data": 2 },
		        { "data": 3 },
		        { "data": 4 },
		        { "data": 5 },
		        { "data": 6 }
		    ],
		    "order": [[0, "desc"]]
		});
    }
</script>
<?= $this->endSection(); ?>