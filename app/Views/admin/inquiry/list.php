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
			<h5 class="card-header">Inquiries</h5>
			<div class="container">
				<div class="table-responsive">
				<table class="table table-default" id="tblList">
					<thead>
						<tr>
          					<th width="5%">No</th>
          					<th width="20%">Name</th>
          					<th width="20%">Email</th>
          					<th width="10%">Phone</th>
          					<th width="10%">Date</th>
          					<th width="35%">Comment</th>
						</tr>
					</thead>
					<tbody>
						<?php
							if($inquiries) {
								foreach($inquiries as $key => $val) {
						?>
									<tr>
										<td><?php echo $key+1; ?></td>
										<td><?php echo $val['name']; ?></td>
										<td><?php echo $val['email']; ?></td>
										<td><?php echo $val['phone']; ?></td>
										<td><?php echo format_date($val['created_at']); ?></td>
										<td><?php echo $val['comment']; ?></td>
									</tr>
						<?php
								}
							} 
						?>
					</tbody>
				</table>
			</div>
			</div>
		</div>
	</div>
</div>
<script src="<?php echo base_url('public/assets/css/datatable/datatables-bootstrap5.js'); ?>"></script>
<script type="text/javascript">
	var page_title = "Inquiries";
	$(document).ready(function() {
        $('#tblList').DataTable();
    });
</script>
<?= $this->endSection(); ?>