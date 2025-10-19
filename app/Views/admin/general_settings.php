<?= $this->extend('include/header'); ?>
<?= $this->section('main_content'); ?>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs4.min.css" rel="stylesheet">
<div class="content-wrapper">
	<div class="container-xxl flex-grow-1 container-p-y">
		<div class="row">
			<div class="col-xl">
				<form id="main-form" action="<?php echo base_url('submit-general-settings'); ?>" method="post">
					<?php echo csrf_field(); ?>
					<div class="card mb-12">
						<div class="card-header d-flex justify-content-between align-items-center">
							<h5 class="mb-0">General Settings</h5> <small class="text-body float-end">(<small class='astrock'>*</small>) indicates required field.</small>
						</div>
						<div class="card-body">
							<input type="hidden" name="old_app_logo" value="<?php echo isset($app_logo) && $app_logo != "" && file_exists("public/uploads/general/".$app_logo) ? $app_logo : ''; ?>" />
							<div class="row">
								<div class="col-lg-3 col-sm-12 mb-4">
									<label class="form-label" for="basic-default-fullname">Website Title</label>
									<input type="text" class="form-control" id="app_name" name="app_name" placeholder="Enter website title" value="<?php echo isset($app_name) ? $app_name : ''; ?>" />
								</div>
								<div class="col-lg-3 col-sm-12 mb-4">
									<label class="form-label" for="basic-default-fullname">Website Email</label>
									<input type="text" class="form-control" id="app_email" name="app_email" placeholder="Enter website email" value="<?php echo isset($app_email) ? $app_email : ''; ?>" />
								</div>
								<div class="col-lg-3 col-sm-12 mb-4">
									<label class="form-label" for="basic-default-fullname">Website Phone</label>
									<input type="text" class="form-control" id="app_phone" name="app_phone" placeholder="Enter website phone" value="<?php echo isset($app_phone) ? $app_phone : ''; ?>" />
								</div>
								<div class="col-lg-3 col-sm-12 mb-4">
									<label class="form-label" for="basic-default-fullname">Website Theme Color</label>
									<input type="text" class="form-control" id="app_theme_color" name="app_theme_color" placeholder="Enter website theme color" value="<?php echo isset($app_theme_color) ? $app_theme_color : ''; ?>" />
								</div>
								<div class="col-lg-12 col-sm-12 mb-4">
									<label class="form-label" for="basic-default-fullname">Website Address</label>
									<input type="text" class="form-control" id="app_address" name="app_address" placeholder="Enter website address" value="<?php echo isset($app_address) ? $app_address : ''; ?>" />
								</div>
								<div class="col-lg-12 col-sm-12 mb-4" hidden>
									<label class="form-label" for="basic-default-fullname">Website Theme Color</label>
									<input type="text" class="form-control" id="app_theme_color" name="app_theme_color" placeholder="Enter website theme color" value="<?php echo isset($app_theme_color) ? $app_theme_color : ''; ?>" />
								</div>
								<div class="col-lg-12 col-sm-12 mb-4">
									<label class="form-label" for="basic-default-fullname">Facebook Page URL</label>
									<input type="text" class="form-control" id="facebook_url" name="facebook_url" placeholder="Enter facebook URL" value="<?php echo isset($facebook_url) ? $facebook_url : ''; ?>" />
								</div>
								<div class="col-lg-12 col-sm-12 mb-4">
									<label class="form-label" for="basic-default-fullname">Instagram Page URL</label>
									<input type="text" class="form-control" id="instagram_url" name="instagram_url" placeholder="Enter instagram URL" value="<?php echo isset($instagram_url) ? $instagram_url : ''; ?>" />
								</div>
								<div class="col-lg-4 col-sm-4 mb-4">
									<label class="form-label" for="basic-default-fullname">Per Page Products</label>
									<input type="text" class="form-control" id="per_page" name="per_page" placeholder="Enter per page products" value="<?php echo isset($per_page) ? $per_page : ''; ?>" />
								</div>
								<div class="col-lg-12 col-sm-12 mb-4">
									<label class="form-label" for="basic-default-fullname">Website Logo <small>(166x50)</small></label>
									<input type="file" class="form-control" name="app_logo" />
									<?php
										if(isset($app_logo) && $app_logo != "" && file_exists("public/uploads/general/".$app_logo)) {
									?>
											<div class="col-12 mb-4">
												<br><br><img src="<?php echo base_url('public/uploads/general/'.$app_logo); ?>" class="img img-responsive img-thumbnail preview" />
											</div>
									<?php
										} 
									?>
								</div>
							</div>
						</div>
					</div>
					<div class="card mb-12">
						<div class="card-header d-flex justify-content-between align-items-center">
							<h5 class="mb-0">Invoice Settings</h5>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-lg-3 col-sm-12 mb-4">
									<label class="form-label" for="basic-default-fullname">Bank Name</label>
									<input type="text" class="form-control" id="bank_name" name="bank_name" placeholder="Enter bank name" value="<?php echo isset($bank_name) ? $bank_name : ''; ?>" />
								</div>
								<div class="col-lg-3 col-sm-12 mb-4">
									<label class="form-label" for="basic-default-fullname">Bank Code</label>
									<input type="text" class="form-control" id="bank_code" name="bank_code" placeholder="Enter bank code" value="<?php echo isset($bank_code) ? $bank_code : ''; ?>" />
								</div>
								<div class="col-lg-3 col-sm-12 mb-4">
									<label class="form-label" for="basic-default-fullname">Account No.</label>
									<input type="text" class="form-control" id="bank_account_no" name="bank_account_no" placeholder="Enter bank account no." value="<?php echo isset($bank_account_no) ? $bank_account_no : ''; ?>" />
								</div>
								<div class="col-lg-3 col-sm-12 mb-4">
									<label class="form-label" for="basic-default-fullname">BIC</label>
									<input type="text" class="form-control" id="bank_bic" name="bank_bic" placeholder="Enter bank BCI no." value="<?php echo isset($bank_bic) ? $bank_bic : ''; ?>" />
								</div>
								<div class="col-lg-3 col-sm-12 mb-4">
									<label class="form-label" for="basic-default-fullname">IBAN</label>
									<input type="text" class="form-control" id="bank_iban" name="bank_iban" placeholder="Enter bank IBAN no." value="<?php echo isset($bank_iban) ? $bank_iban : ''; ?>" />
								</div>
								<div class="col-lg-3 col-sm-12 mb-4">
									<label class="form-label" for="basic-default-fullname">Company Registration Number</label>
									<input type="text" class="form-control" id="company_registration_number" name="company_registration_number" placeholder="Enter company registration number" value="<?php echo isset($company_registration_number) ? $company_registration_number : ''; ?>" />
								</div>
								<div class="col-lg-3 col-sm-12 mb-4">
									<label class="form-label" for="basic-default-fullname">VAT Registration Number</label>
									<input type="text" class="form-control" id="vat_registration_number" name="vat_registration_number" placeholder="Enter vat registration number" value="<?php echo isset($vat_registration_number) ? $vat_registration_number : ''; ?>" />
								</div>
							</div>
						</div>
					</div>					
					<div class="card mb-12">
						<div class="card-header d-flex justify-content-between align-items-center">
							<h5 class="mb-0">Charge Settings</h5>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-lg-6 col-sm-12 mb-4">
									<label class="form-label" for="basic-default-fullname">Shipping Charge</label>
									<input type="text" class="form-control" id="shipping_charge" name="shipping_charge" placeholder="Enter shipping charge" value="<?php echo isset($shipping_charge) ? $shipping_charge : ''; ?>" />
								</div>
								<div class="col-lg-6 col-sm-12 mb-4">
									<label class="form-label" for="basic-default-fullname">VAT Charge (%)</label>
									<input type="text" class="form-control" id="vat_charge" name="vat_charge" placeholder="Enter VAT charge" value="<?php echo isset($vat_charge) ? $vat_charge : ''; ?>" />
								</div>
							</div>
						</div>
					</div>
					<div class="card mb-12">
						<div class="card-header d-flex justify-content-between align-items-center">
							<h5 class="mb-0">Paypal Settings</h5>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-lg-6 col-sm-12 mb-4">
									<label class="form-label" for="basic-default-fullname">Live Client ID</label>
									<input type="text" class="form-control" id="paypal_client_id" name="paypal_client_id" placeholder="Enter Paypal Client ID" value="<?php echo isset($paypal_client_id) ? $paypal_client_id : ''; ?>" style="font-size: 11px !important;" />
								</div>
								<div class="col-lg-6 col-sm-12 mb-4">
									<label class="form-label" for="basic-default-fullname">Live Client Secret Key</label>
									<input type="text" class="form-control" id="paypal_client_secret_key" name="paypal_client_secret_key" placeholder="Enter Client Secret Key" value="<?php echo isset($paypal_client_secret_key) ? $paypal_client_secret_key : ''; ?>" style="font-size: 11px !important;" />
								</div>
								<div class="col-lg-12 col-sm-12 mb-4">
									<label class="form-label" for="basic-default-fullname">Live Paypal Base URL</label>
									<input type="text" class="form-control" id="paypal_live_base_url" name="paypal_live_base_url" placeholder="Enter Live Base URL" value="<?php echo isset($paypal_live_base_url) ? $paypal_live_base_url : ''; ?>" />
								</div>
								<div class="col-lg-6 col-sm-12 mb-4">
									<label class="form-label" for="basic-default-fullname">Test Client ID</label>
									<input type="text" class="form-control" id="paypal_test_client_id" name="paypal_test_client_id" placeholder="Enter Paypal Client ID" value="<?php echo isset($paypal_test_client_id) ? $paypal_test_client_id : ''; ?>" style="font-size: 11px !important;" />
								</div>
								<div class="col-lg-6 col-sm-12 mb-4">
									<label class="form-label" for="basic-default-fullname">Test Client Secret Key</label>
									<input type="text" class="form-control" id="paypal_test_client_secret_key" name="paypal_test_client_secret_key" placeholder="Enter Client Secret Key" value="<?php echo isset($paypal_test_client_secret_key) ? $paypal_test_client_secret_key : ''; ?>" style="font-size: 11px !important;" />
								</div>
								<div class="col-lg-12 col-sm-12 mb-4">
									<label class="form-label" for="basic-default-fullname">Test Paypal Base URL</label>
									<input type="text" class="form-control" id="paypal_test_base_url" name="paypal_test_base_url" placeholder="Enter Test Base URL" value="<?php echo isset($paypal_test_base_url) ? $paypal_test_base_url : ''; ?>" />
								</div>
							</div>
						</div>
					</div>
					<div class="card mb-12">
						<div class="card-header d-flex justify-content-between align-items-center">
							<h5 class="mb-0">SMTP Settings</h5>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-lg-3 col-sm-12 mb-4">
									<label class="form-label" for="basic-default-fullname">SMTP HOST</label>
									<input type="text" class="form-control" id="smtp_host" name="smtp_host" placeholder="Enter smtp host" value="<?php echo isset($smtp_host) ? $smtp_host : ''; ?>" />
								</div>
								<div class="col-lg-3 col-sm-12 mb-4">
									<label class="form-label" for="basic-default-fullname">SMTP From Email</label>
									<input type="text" class="form-control" id="smtp_from_email" name="smtp_from_email" placeholder="Enter smtp from email" value="<?php echo isset($smtp_from_email) ? $smtp_from_email : ''; ?>" />
								</div>
								<div class="col-lg-3 col-sm-12 mb-4">
									<label class="form-label" for="basic-default-fullname">SMTP Password</label>
									<input type="text" class="form-control" id="smtp_password" name="smtp_password" placeholder="Enter smtp password" value="<?php echo isset($smtp_password) ? $smtp_password : ''; ?>" />
								</div>
								<div class="col-lg-3 col-sm-12 mb-4">
									<label class="form-label" for="basic-default-fullname">SMTP From Name</label>
									<input type="text" class="form-control" id="smtp_from_name" name="smtp_from_name" placeholder="Enter smtp from name" value="<?php echo isset($smtp_from_name) ? $smtp_from_name : ''; ?>" />
								</div>
							</div>
						</div>
					</div>
					<center><button type="submit" class="btn btn-primary btn-sm">SUBMIT</button></center>
				</form>
			</div>
		</div>
	</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script type="text/javascript">
	var page_title = "General Settings";
	$(document).ready(function(){
		$("#main-form").submit(function(e){
			e.preventDefault();

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
						window.location.reload();
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
		});
	});
</script>
<?= $this->endSection(); ?>