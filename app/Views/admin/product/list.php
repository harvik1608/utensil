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
				Products <a href="<?php echo base_url('products/new'); ?>" class="btn btn-primary btn-sm text-white" style="float: right;">New</a>
			</h5>
			<div class="container">
				<div class="table-responsive">
				<table class="table table-default" id="tblList">
					<thead>
						<tr>
          					<th width="5%">No</th>
          					<th width="25%">Name</th>
          					<th width="20%">Category</th>
          					<th width="10%">Price</th>
          					<th width="10%">Availability</th>
          					<th width="10%">Top Collection</th>
          					<th width="10%">Status</th>
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
	var page_title = "Products";
	$(document).ready(function() {
        load_data(); 
    });
    function load_data()
    {
    	$('#tblList').DataTable().destroy();
    	$('#tblList').DataTable({
			"serverSide": true, // Enable server-side processing
	    	"processing": true,
	    	"pageLength": 10,
			"ajax":{
	            url: "<?php echo base_url('load-products'); ?>",
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
		        { "data": 6 },
		        { "data": 7 }
		    ],
		    "order": [[0, "desc"]]
		});
    }
</script>
<?= $this->endSection(); ?>