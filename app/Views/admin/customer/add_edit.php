<?= $this->extend('include/header'); ?>
<?= $this->section('main_content'); ?>
<?php 
	$password = "";
	if(empty($customer)) {
		$module_name = "New Customer";
		$action = base_url("customers");

		$fname = "";
		$lname = "";
		$email = "";
		$phone = "";
		$state_id = "";
		$city = "";
		$avatar = "";
		$is_active = "";
	} else {
		$module_name = "Edit Customer";
		$action = base_url("customers/".$customer['id']);

		$fname = $customer['fname'];
		$lname = $customer['lname'];
		$email = $customer['email'];
		$phone = $customer['phone'];
		$state_id = $customer['region'];
		$city = $customer['city'];
		$avatar = $customer['avatar'];
		$is_active = $customer['is_active'];
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
								if($fname != "") {
									echo '<input type="hidden" name="_method" value="PUT" />';
									echo '<input type="hidden" name="old_avatar" value="'.$avatar.'" />';
								} 
							?>
							<div class="row">
								<div class="col-4 mb-4">
									<label class="form-label" for="basic-default-fullname">First name<small class='astrock'>*</small></label>
									<input type="text" class="form-control" id="fname" name="fname" placeholder="Enter first name" value="<?php echo $fname; ?>" autofocus />
								</div>
								<div class="col-4 mb-4">
									<label class="form-label" for="basic-default-fullname">Last name<small class='astrock'>*</small></label>
									<input type="text" class="form-control" id="lname" name="lname" placeholder="Enter last name" value="<?php echo $lname; ?>" />
								</div>
								<div class="col-4 mb-4">
									<label class="form-label" for="basic-default-fullname">Phone No.<small class='astrock'>*</small></label>
									<input type="text" class="form-control" id="phone" name="phone" placeholder="Enter phone no." value="<?php echo $phone; ?>" />
								</div>
								<div class="col-4 mb-4">
									<label class="form-label" for="basic-default-fullname">Email<small class='astrock'>*</small></label>
									<input type="text" class="form-control" id="email" name="email" placeholder="Enter email" value="<?php echo $email; ?>" />
								</div>
								<div class="col-4 mb-4">
									<label class="form-label" for="basic-default-fullname">Password<small class='astrock'>*</small></label>
									<input type="password" class="form-control" id="password" name="password" placeholder="Enter password" value="<?php echo $password; ?>" />
								</div>
								<div class="col-2 mb-4">
									<label class="form-label" for="basic-default-fullname">State</label>
									<input type="text" class="form-control" id="state_id" name="state_id" placeholder="Enter state" value="<?php echo $state_id; ?>" />
								</div>
								<div class="col-2 mb-4">
									<label class="form-label" for="basic-default-fullname">City</label>
									<input type="text" class="form-control" id="city" name="city" placeholder="Enter city" value="<?php echo $city; ?>" />
								</div>
								<div class="col-4 mb-4">
									<label class="form-label" for="basic-default-fullname">Status</label>
									<select class="form-control select2" id="is_active" name="is_active">
										<option value="1" <?php echo $is_active == 1 ? "selected" : ""; ?>>Active</option>
										<option value="0" <?php echo $is_active == 0 ? "selected" : ""; ?>>Inactive</option>
									</select>
								</div>
								<?php
									if($avatar != "" && file_exists("public/uploads/customer/".$avatar)) {
								?>
										<div class="col-12 mb-4">
											<img src="<?php echo base_url('public/uploads/customer/'.$avatar); ?>" class="img img-responsive img-thumbnail preview" />
										</div>
								<?php
									} 
								?>
							</div>
							<button type="submit" class="btn btn-primary btn-sm">SUBMIT</button>
							<a class="btn btn-danger btn-sm text-white" id="back-btn" href="<?php echo base_url('customers'); ?>">Back</a>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script type="text/javascript">
	var page_title = "Customers";
	var is_edit_page = "<?php echo $fname == '' ? 0 : 1; ?>";
	$(document).ready(function(){
		$("#main-form").validate({
			rules:{
				fname:{
					required: true
				},
				lname:{
					required: true
				},
				email:{
					required: true
				},
				password:{
					required: true
				},
				phone:{
					required: true
				}
			},
			messages:{
				fname:{
					required: "<b>First name is required.</b>"
				},
				lname:{
					required: "<b>Last name is required.</b>"
				},
				email:{
					required: "<b>Email is required.</b>"
				},
				password:{
					required: "<b>Password is required.</b>"
				},
				phone:{
					required: "<b>Phone no. is required.</b>"
				}
			}
		});
		if(parseInt(is_edit_page) === 1) {
			$("#main-form").validate().settings.rules.password.required = false;
			$("#main-form").validate().settings.messages.password = {};
		}

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