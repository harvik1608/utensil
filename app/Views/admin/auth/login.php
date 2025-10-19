<!DOCTYPE html>
<html lang="en" class="light-style layout-wide  customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free" data-style="light">
	<head>
		<meta charset="utf-8" />
    	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    	<meta name="csrf-token" content="<?= csrf_hash() ?>">
    	<title><?php echo general_setting('app_name'); ?></title>

    	<link rel="icon" type="image/x-icon" href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template-free/assets/img/favicon/favicon.ico" />
    	<link rel="stylesheet" href="<?php echo base_url('public/assets/vendor/fonts/boxicons.css'); ?>" />
    	<link rel="stylesheet" href="<?php echo base_url('public/assets/vendor/css/core.css'); ?>" class="template-customizer-core-css" />
	    <link rel="stylesheet" href="<?php echo base_url('public/assets/vendor/css/theme-default.css'); ?>" class="template-customizer-theme-css" />
	    <link rel="stylesheet" href="<?php echo base_url('public/assets/css/demo.css'); ?>" />
	    <link rel="stylesheet" href="<?php echo base_url('public/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css'); ?>" />
	    <link rel="stylesheet" href="<?php echo base_url('public/assets/vendor/css/pages/page-auth.css'); ?>">
	    <link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
		<style>
			body {
				font-family: "Nunito", serif !important;
				font-optical-sizing: auto;
				font-weight: 400;
				font-style: normal;
			}
			.app-brand-link {
				text-align: center;
			}
		</style>
	    <script src="<?php echo base_url('public/assets/vendor/js/helpers.js'); ?>"></script>
	    <script src="<?php echo base_url('public/assets/js/config.js'); ?>"></script>
	</head>
	<body>
		<div class="container-xxl">
			<div class="authentication-wrapper authentication-basic container-p-y">
				<div class="authentication-inner">
					<div class="card px-sm-6 px-0">
						<div class="card-body">
							<div class="app-brand justify-content-center">
								<a href="index-2.html" class="app-brand-link gap-2">
									<span class="app-brand-text demo text-heading fw-bold">Admin Panel <br><small>(<?php echo general_setting('app_name'); ?>)</small></span>
								</a>
							</div>
							<!-- <h4 class="mb-1">Sign In! 👋</h4> -->
							<!-- <p class="mb-6">Please sign-in to your account.</p> -->
							<form id="formAuthentication" class="mb-6" action="<?php echo base_url('submit-signin'); ?>" method="post">
								<?php echo csrf_field(); ?>
								<div class="mb-6">
									<label for="email" class="form-label">Email</label>
									<input type="text" class="form-control" id="email" name="email" placeholder="Enter your email" required autofocus />
								</div>
								<div class="mb-6 form-password-toggle">
									<label class="form-label" for="password">Password</label>
									<div class="input-group input-group-merge">
										<input type="password" id="password" class="form-control" name="password" placeholder="Enter your password" aria-describedby="password" required />
										<span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
									</div>
								</div>
								<!-- <div class="mb-8">
									<div class="d-flex justify-content-between mt-8">
										<div class="form-check mb-0 ms-2">
											<input class="form-check-input" type="checkbox" id="remember-me" />
											<label class="form-check-label" for="remember-me">Remember Me</label>
										</div>
										<a href="auth-forgot-password-basic.html"><span>Forgot Password?</span></a>
									</div>
								</div> -->
								<div class="mb-6">
									<button class="btn btn-primary d-grid w-100" type="submit">Sign In</button>
									<!-- <div class="spinner-border spinner-border-sm text-secondary" role="status">
										<span class="visually-hidden">Loading...</span>
							        </div> -->
								</div>
								<?php 
									$session = session();
									if($session->getFlashData('error')) {
								?>
										<div class="alert alert-danger alert-dismissible" role="alert">
											<?php echo $session->getFlashData('error'); ?>
											<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							        	</div>
								<?php
									}
								?>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script src="<?php echo base_url('public/assets/vendor/libs/jquery/jquery.js'); ?>"></script>
		<script src="<?php echo base_url('public/assets/vendor/libs/popper/popper.js'); ?>"></script>
		<script src="<?php echo base_url('public/assets/vendor/js/bootstrap.js'); ?>"></script>
		<script src="<?php echo base_url('public/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js'); ?>"></script>
		<script src="<?php echo base_url('public/assets/vendor/js/menu.js'); ?>"></script>
		<script src="<?php echo base_url('public/assets/js/main.js'); ?>"></script>
		<script async defer src="<?php echo base_url('public/assets/buttons.js'); ?>"></script>
	</body>
</html>