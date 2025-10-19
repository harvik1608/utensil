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
				Brands <a href="<?php echo base_url('brands/new'); ?>" class="btn btn-primary btn-sm text-white" style="float: right;">New</a>
			</h5>
			<div class="container">
				<div class="table-responsive">
				<table class="table table-default" id="tblList">
					<thead>
						<tr>
          					<th width="5%">No</th>
          					<th width="60%">Name</th>
          					<th width="15%">Total Products</th>
          					<th width="10%">Status</th>
          					<th width="10%">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
							if($brands) {
								foreach($brands as $key => $val) {
						?>
									<tr>
										<td><?php echo $key+1; ?></td>
										<td><?php echo $val['name']; ?></td>
										<td><?php echo $val['items']; ?></td>
										<td>
											<?php
												switch($val['is_active']) {
													case 1:
														echo '<span class="badge bg-success">Active</span>';
														break;

													default:
														echo '<span class="badge bg-danger">Inactive</span>';
														break;
												} 
											?>
										</td>
										<td>
											<a href="<?php echo base_url('brands/'.$val['id'].'/edit'); ?>" title="Edit"><i class="icon-base bx bx-edit icon-sm"></i></a>
											<a href="javascript:;" onclick="remove_row('<?php echo base_url('brands/'.$val['id']); ?>')" title="Delete"><i class="icon-base bx bx-trash icon-sm"></i></a>
										</td>
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
	var page_title = "Brands";
	$(document).ready(function() {
        $('#tblList').DataTable();
    });
</script>
<?= $this->endSection(); ?>