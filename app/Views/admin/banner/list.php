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
				Banners <a href="<?php echo base_url('banners/new'); ?>" class="btn btn-primary btn-sm text-white" style="float: right;">New</a>
			</h5>
			<div class="container">
				<div class="table-responsive">
				<table class="table table-default" id="tbl-list">
					<thead>
						<tr>
          					<th width="5%">No</th>
          					<th width="60%">Banner</th>
          					<th width="10%">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
							if($banners) {
								foreach($banners as $key => $val) {
						?>
									<tr>
										<td><?php echo $key+1; ?></td>
										<td><img src="<?php echo base_url('public/uploads/banner/'.$val['avatar']); ?>" style="width: 15%;" /></td>
										<td>
											<a href="javascript:;" onclick="remove_row('<?php echo base_url('banners/'.$val['id']); ?>')" title="Delete"><i class="icon-base bx bx-trash icon-sm"></i></a>
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
	var page_title = "Banners";
	$(document).ready(function() {
        $('#tbl-list').DataTable();
    });
</script>
<?= $this->endSection(); ?>