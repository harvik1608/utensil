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
				Sub Categories <a href="<?php echo base_url('sub_categories/new'); ?>" class="btn btn-primary btn-sm text-white" style="float: right;">New</a>
			</h5>
			<div class="container">
				<div class="table-responsive">
				<table class="table table-default" id="tbl-list">
					<thead>
						<tr>
          					<th width="5%">No</th>
          					<th width="30%">Name</th>
          					<th width="30%">Main Category</th>
          					<th width="15%">Status</th>
          					<th width="15%">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
							if($categories) {
								foreach($categories as $key => $val) {
						?>
									<tr>
										<td><?php echo $key+1; ?></td>
										<td><?php echo $val['name']; ?></td>
										<td><?php echo $val['category']; ?></td>
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
											<a href="<?php echo base_url('sub_categories/'.$val['id'].'/edit'); ?>" title="Edit"><i class="icon-base bx bx-edit icon-sm"></i></a>
											<a href="javascript:;" onclick="remove_row('<?php echo base_url('sub_categories/'.$val['id']); ?>')" title="Delete"><i class="icon-base bx bx-trash icon-sm"></i></a>
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
	var page_title = "Sub Categories";
	$(document).ready(function() {
        $('#tbl-list').DataTable();
    });
</script>
<?= $this->endSection(); ?>