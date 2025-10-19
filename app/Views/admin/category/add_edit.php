<?= $this->extend('include/header'); ?>
<?= $this->section('main_content'); ?>
<?php 
	if(empty($category)) {
		$module_name = "New Category";
		$action = base_url("categories");

		$name = "";
		$avatar = "";
		$is_active = "";
	} else {
		$module_name = "Edit Category";
		$action = base_url("categories/".$category['id']);

		$name = $category['name'];
		$avatar = $category['avatar'];
		$is_active = $category['is_active'];
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
									echo '<input type="hidden" name="old_avatar" value="'.$avatar.'" />';
								} 
							?>
							<div class="row">
								<div class="col-6 mb-4">
									<label class="form-label" for="basic-default-fullname">Category Name<small class='astrock'>*</small></label>
									<input type="text" class="form-control" id="name" name="name" placeholder="Enter category name" value="<?php echo $name; ?>" autofocus />
								</div>
								<div class="col-6 mb-4">
									<label class="form-label" for="basic-default-fullname">Status</label>
									<select class="form-control select2" id="is_active" name="is_active">
										<option value="1" <?php echo $is_active == 1 ? "selected" : ""; ?>>Active</option>
										<option value="0" <?php echo $is_active == 0 ? "selected" : ""; ?>>Inactive</option>
									</select>
								</div>
								<div class="col-12 mb-4">
									<label class="form-label" for="basic-default-fullname">Photo <small>(1020x350)</small></label>
									<input type="file" class="form-control" id="avatar" name="avatar" />
								</div>
								<?php
									if($avatar != "" && file_exists("public/uploads/category/".$avatar)) {
								?>
										<div class="col-12 mb-4">
											<img src="<?php echo base_url('public/uploads/category/'.$avatar); ?>" class="img img-responsive img-thumbnail preview" />
										</div>
								<?php
									} 
								?>
							</div>
							<button type="submit" class="btn btn-primary btn-sm">SUBMIT</button>
							<a class="btn btn-danger btn-sm text-white" id="back-btn" href="<?php echo base_url('categories'); ?>">Back</a>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script type="text/javascript">
	var page_title = "Categories";
	// var is_edit_page = "<?php echo $name == '' ? 0 : 1; ?>";
	$(document).ready(function(){
		$("#main-form").validate({
			rules:{
				name:{
					required: true
				}
			},
			messages:{
				name:{
					required: "<b>Category name is required.</b>"
				}
			}
		});
		// if(parseInt(is_edit_page) === 1) {
		// 	$("#main-form").validate().settings.rules.avatar.required = false;
		// 	$("#main-form").validate().settings.messages.avatar = {};
		// }

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