<?= $this->extend('include/header'); ?>
<?= $this->section('main_content'); ?>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs4.min.css" rel="stylesheet">
<div class="content-wrapper">
	<div class="container-xxl flex-grow-1 container-p-y">
		<div class="row">
			<div class="col-xl">
				<form id="main-form" action="<?php echo base_url('submit-page-settings'); ?>" method="post">
					<?php echo csrf_field(); ?>
					<input type="hidden" name="setting_key" value="<?php echo $setting_key; ?>" />
					<div class="card mb-12">
						<div class="card-header d-flex justify-content-between align-items-center">
							<h5 class="mb-0"><?php echo $page_title; ?></h5>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-12 mb-4">
									<textarea class="form-control summernote" id="content" name="content"><?php echo isset($content) ? $content : ''; ?></textarea>
								</div>
							</div>
							<button type="submit" class="btn btn-primary btn-sm">SUBMIT</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs4.min.js"></script>
<script type="text/javascript">
	var page_title = "<?php echo $page_title; ?>";
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
					$("input[name=csrf_token]").val(response.csrf);
					if(response.status == "success") {
						window.location.reload();
					} else {
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