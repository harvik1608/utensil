<?= $this->extend('include/header'); ?>
<?= $this->section('main_content'); ?>
<?php 
	if(empty($brand)) {
		$module_name = "New Brand";
		$action = base_url("brands");

		$name = "";
		$is_active = "";
	} else {
		$module_name = "Edit Brand";
		$action = base_url("brands/".$brand['id']);

		$name = $brand['name'];
		$is_active = $brand['is_active'];
	}
?>
<div class="content-wrapper">
	<div class="container-xxl flex-grow-1 container-p-y">
		<div class="row">
			<div class="col-xl">
				<div class="card mb-12">
					<div class="card-header d-flex justify-content-between align-items-center">
						<h5 class="mb-0"><?php echo $module_name; ?></h5> <small class="text-body float-end">(<small class='astrock'>*</small>) indicates required field.</small>
					</div>
					<div class="card-body">
						<form id="main-form" action="<?php echo $action; ?>" method="post">
							<?php
								echo csrf_field();
								if($name != "") {
									echo '<input type="hidden" name="_method" value="PUT" />';
								} 
							?>
							<div class="row">
								<div class="col-12 mb-4">
									<label class="form-label" for="basic-default-fullname">Brand Name<small class='astrock'>*</small></label>
									<input type="text" class="form-control" id="name" name="name" placeholder="Enter category name" value="<?php echo $name; ?>" autofocus />
								</div>
								<div class="col-12 mb-4">
									<label class="form-label" for="basic-default-fullname">Status</label>
									<select class="form-control select2" id="is_active" name="is_active">
										<option value="1" <?php echo $is_active == 1 ? "selected" : ""; ?>>Active</option>
										<option value="0" <?php echo $is_active == 0 ? "selected" : ""; ?>>Inactive</option>
									</select>
								</div>
							</div>
							<button type="submit" class="btn btn-primary btn-sm">SUBMIT</button>
							<a class="btn btn-danger btn-sm text-white" id="back-btn" href="<?php echo base_url('brands'); ?>">Back</a>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script type="text/javascript">
	var page_title = "Brands";
	$(document).ready(function(){
		$("#main-form").validate({
			rules:{
				name:{
					required: true
				}
			},
			messages:{
				name:{
					required: "<b>Brand name is required.</b>"
				}
			}
		});
		$("#main-form").submit(function(e){
			e.preventDefault();

			if($("#main-form").valid()) {
				$.ajax({
					url: $("#main-form").attr("action"),
					type: "post",
					data: new FormData(this),
					contentType: false,
					processData: false,
					cache: false,
					beforeSend:function(){
						$("#main-form button[type=submit]").html('<div class="spinner-border spinner-border-sm text-primary" role="status"><span class="visually-hidden">Loading...</span></div>').attr("disabled",true);
					},
					success:function(response){
						if(response.status == "success") {
							window.location.href = $("#back-btn").attr("href");
						} else {
							$("input[name=csrf_token]").val(response.csrf);
							show_toast(response.message);
							$("#main-form button[type=submit]").html('SUBMIT').attr("disabled",false);
						}
					},
					error: function(xhr, status, error) {  // Function to handle errors
						const response = xhr.responseJSON;
					    if (response?.csrf) {
					        $("input[name=csrf_token]").val(response.csrf);
					    }
					    show_toast(error);
					    $("#main-form button[type=submit]").html('SUBMIT').attr("disabled",false);
					},
				});
			}
		});
	});
</script>
<?= $this->endSection(); ?>