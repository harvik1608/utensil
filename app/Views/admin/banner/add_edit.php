<?= $this->extend('include/header'); ?>
<?= $this->section('main_content'); ?>
<?php 
	if(empty($banner)) {
		$module_name = "New Banner";
		$action = base_url("banners");
		$avatar = "";
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
							?>
							<div class="row">
								<div class="col-12 mb-4">
									<label class="form-label" for="basic-default-fullname">Photo</label>
									<input type="file" class="form-control" id="avatar" name="avatar" required />
								</div>
								<?php
									if($avatar != "" && file_exists("public/uploads/banner/".$avatar)) {
								?>
										<div class="col-12 mb-4">
											<img src="<?php echo base_url('public/uploads/banner/'.$avatar); ?>" class="img img-responsive img-thumbnail preview" />
										</div>
								<?php
									} 
								?>
							</div>
							<button type="submit" class="btn btn-primary btn-sm">SUBMIT</button>
							<a class="btn btn-danger btn-sm text-white" id="back-btn" href="<?php echo base_url('banners'); ?>">Back</a>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script type="text/javascript">
	var page_title = "Banners";
	$(document).ready(function(){
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