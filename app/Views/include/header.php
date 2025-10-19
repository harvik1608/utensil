<!DOCTYPE html>
<html lang="en" class="light-style layout-wide  customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free" data-style="light">
	<head>
		<meta charset="utf-8" />
    	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    	<title><?php echo general_setting('app_name'); ?></title>

    	<link rel="icon" type="image/x-icon" href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template-free/assets/img/favicon/favicon.ico" />
    	<link rel="stylesheet" href="<?php echo base_url('public/assets/vendor/fonts/boxicons.css'); ?>" />
    	<link rel="stylesheet" href="<?php echo base_url('public/assets/vendor/css/core.css'); ?>" class="template-customizer-core-css" />
	    <link rel="stylesheet" href="<?php echo base_url('public/assets/vendor/css/theme-default.css'); ?>" class="template-customizer-theme-css" />
	    <link rel="stylesheet" href="<?php echo base_url('public/assets/css/demo.css'); ?>" />
	    <link rel="stylesheet" href="<?php echo base_url('public/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css'); ?>" />
	    <link rel="stylesheet" href="<?php echo base_url('public/assets/vendor/css/pages/page-auth.css'); ?>">
	    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/assets/toast/jquery.toast.css'); ?>">
	    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
	    <link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
		<style>
			body, .jq-toast-single, #myChart {
				font-family: "Nunito", serif !important;
				font-optical-sizing: auto;
				font-weight: 400;
				font-style: normal;
			}
			.astrock {
				color: #FF0000;
			}
			.text-primary {
				color: #fff !important;
			}
			.dataTables_wrapper .dataTables_paginate .paginate_button.current {
				background-color: #696cff !important;
				color: #ffffff !important;
				border: 1px solid #ffffff !important;
			}
			table tbody tr th, table tbody tr td, .form-control:disabled, .form-label {
				color: #000 !important;
			}
			span.select2-selection {
				height: 37px !important;
				border: 1px solid #ced1d5 !important;
				border-radius: 0.375rem !important;
			}
			.select2-container--default .select2-selection--single .select2-selection__rendered {
				padding-top: 4px !important;
			}
			.select2-container--default .select2-selection--single .select2-selection__arrow {
				top: 7px !important;
    			right: 5px !important;
			}
			table.dataTable thead>tr>th.sorting, table.dataTable thead>tr>th.sorting_asc {
				font-size: 10px !important;
				font-weight: bold;
			}
			img.preview {
				width: 20%;
				height: 100%;
			}
			#tblList tbody td  {
				font-size: 13px !important;
			}
			label[id$="-error"] {
				display: none;
			}
			.raise_payment {
				float: right;
			}
		</style>
	    <script src="<?php echo base_url('public/assets/vendor/js/helpers.js'); ?>"></script>
	    <script src="<?php echo base_url('public/assets/js/config.js'); ?>"></script>
	    <script src="<?php echo base_url('public/assets/vendor/libs/jquery/jquery.js'); ?>"></script>
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
	</head>
	<body>
		<?php 
			$session = session();
			$userdata = $session->get('userdata');
			if($session->get('success_message')) {
				echo "<span id='success-msg' hidden>".$session->getFlashData('success_message')."</span>";
			}
			if($session->get('error_message')) {
				echo "<span id='error-msg' hidden>".$session->getFlashData('error_message')."</span>";
			}
		?>
		<div class="layout-wrapper layout-content-navbar">
			<div class="layout-container">
				<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
					<div class="app-brand demo ">
						<a href="<?php echo base_url('dashboard'); ?>" class="app-brand-link">
							<span class="app-brand-logo demo">
								<svg width="25" viewBox="0 0 25 42" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
									<defs>
								    	<path d="M13.7918663,0.358365126 L3.39788168,7.44174259 C0.566865006,9.69408886 -0.379795268,12.4788597 0.557900856,15.7960551 C0.68998853,16.2305145 1.09562888,17.7872135 3.12357076,19.2293357 C3.8146334,19.7207684 5.32369333,20.3834223 7.65075054,21.2172976 L7.59773219,21.2525164 L2.63468769,24.5493413 C0.445452254,26.3002124 0.0884951797,28.5083815 1.56381646,31.1738486 C2.83770406,32.8170431 5.20850219,33.2640127 7.09180128,32.5391577 C8.347334,32.0559211 11.4559176,30.0011079 16.4175519,26.3747182 C18.0338572,24.4997857 18.6973423,22.4544883 18.4080071,20.2388261 C17.963753,17.5346866 16.1776345,15.5799961 13.0496516,14.3747546 L10.9194936,13.4715819 L18.6192054,7.984237 L13.7918663,0.358365126 Z" id="path-1"></path>
								    	<path d="M5.47320593,6.00457225 C4.05321814,8.216144 4.36334763,10.0722806 6.40359441,11.5729822 C8.61520715,12.571656 10.0999176,13.2171421 10.8577257,13.5094407 L15.5088241,14.433041 L18.6192054,7.984237 C15.5364148,3.11535317 13.9273018,0.573395879 13.7918663,0.358365126 C13.5790555,0.511491653 10.8061687,2.3935607 5.47320593,6.00457225 Z" id="path-3"></path>
								    	<path d="M7.50063644,21.2294429 L12.3234468,23.3159332 C14.1688022,24.7579751 14.397098,26.4880487 13.008334,28.506154 C11.6195701,30.5242593 10.3099883,31.790241 9.07958868,32.3040991 C5.78142938,33.4346997 4.13234973,34 4.13234973,34 C4.13234973,34 2.75489982,33.0538207 2.37032616e-14,31.1614621 C-0.55822714,27.8186216 -0.55822714,26.0572515 -4.05231404e-15,25.8773518 C0.83734071,25.6075023 2.77988457,22.8248993 3.3049379,22.52991 C3.65497346,22.3332504 5.05353963,21.8997614 7.50063644,21.2294429 Z" id="path-4"></path>
								    	<path d="M20.6,7.13333333 L25.6,13.8 C26.2627417,14.6836556 26.0836556,15.9372583 25.2,16.6 C24.8538077,16.8596443 24.4327404,17 24,17 L14,17 C12.8954305,17 12,16.1045695 12,15 C12,14.5672596 12.1403557,14.1461923 12.4,13.8 L17.4,7.13333333 C18.0627417,6.24967773 19.3163444,6.07059163 20.2,6.73333333 C20.3516113,6.84704183 20.4862915,6.981722 20.6,7.13333333 Z" id="path-5"></path>
								  	</defs>
								  	<g id="g-app-brand" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								  		<g id="Brand-Logo" transform="translate(-27.000000, -15.000000)">
								  			<g id="Icon" transform="translate(27.000000, 15.000000)">
								  				<g id="Mask" transform="translate(0.000000, 8.000000)">
								  					<mask id="mask-2" fill="white">
								  						<use xlink:href="#path-1"></use>
								  					</mask>
								  					<use fill="#696cff" xlink:href="#path-1"></use>
								  					<g id="Path-3" mask="url(#mask-2)">
								  						<use fill="#696cff" xlink:href="#path-3"></use>
											            <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-3"></use>
											       	</g>
											       	<g id="Path-4" mask="url(#mask-2)">
											            <use fill="#696cff" xlink:href="#path-4"></use>
											            <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-4"></use>
											       	</g>
											 	</g>
											 	<g id="Triangle" transform="translate(19.000000, 11.000000) rotate(-300.000000) translate(-19.000000, -11.000000) ">
											 		<use fill="#696cff" xlink:href="#path-5"></use>
											 		<use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-5"></use>
											  	</g>
											</g>
										</g>
									</g>
								</svg>
							</span>
							<span class="app-brand-text demo menu-text fw-bold ms-2">Admin Panel</span>
						</a>
						<a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
							<i class="bx bx-chevron-left bx-sm d-flex align-items-center justify-content-center"></i>
    					</a>
					</div>
					<div class="menu-inner-shadow"></div>
					<ul class="menu-inner py-1" id="main-menu">
						<li class="menu-item">
							<a href="<?php echo base_url('dashboard'); ?>" class="menu-link">
								<i class="menu-icon tf-icons bx bx-crown"></i>
								<div class="text-truncate" data-i18n="Boxicons">Dashboard</div>
							</a>
						</li>
						<li class="menu-item" data-module="banner" data-title="Banners">
							<a href="<?php echo base_url('banners'); ?>" class="menu-link">
								<i class="menu-icon tf-icons bx bx-crown"></i>
								<div class="text-truncate" data-i18n="Boxicons">Banners</div>
							</a>
						</li>
						<?php
							if(check_permission('faq')) {
						?>
								<li class="menu-item" data-module="faq" data-title="FAQs">
									<a href="<?php echo base_url('faqs'); ?>" class="menu-link">
										<i class="menu-icon tf-icons bx bx-crown"></i>
										<div class="text-truncate" data-i18n="Boxicons">FAQs</div>
									</a>
								</li>
						<?php
							}
							if(check_permission('order')) {
						?>
								<li class="menu-item" data-module="order" data-title="Orders">
									<a href="javascript:void(0);" class="menu-link menu-toggle">
										<i class="menu-icon tf-icons bx bx-crown"></i>
										<div class="text-truncate" data-i18n="Authentications">Orders</div>
									</a>
									<ul class="menu-sub">
										<li class="menu-item"><a href="<?php echo base_url('orders'); ?>" class="menu-link">All Orders</a></li>
										<!-- <li class="menu-item"><a href="<?php echo base_url('new-orders'); ?>" class="menu-link">New Orders</a></li> -->
										<li class="menu-item"><a href="<?php echo base_url('returned-orders'); ?>" class="menu-link">Returned Orders</a></li>
									</ul>
								</li>
						<?php 
							}
							if(check_permission('brand')) {
						?>
								<li class="menu-item" data-module="brand" data-title="Brands">
									<a href="<?php echo base_url('brands'); ?>" class="menu-link">
										<i class="menu-icon tf-icons bx bx-crown"></i>
										<div class="text-truncate" data-i18n="Boxicons">Brands</div>
									</a>
								</li>
						<?php 
							}
							
							if(check_permission('report')) {
						?>
								<li class="menu-item" data-module="report" data-title="Reports">
									<a href="<?php echo base_url('reports'); ?>" class="menu-link">
										<i class="menu-icon tf-icons bx bx-crown"></i>
										<div class="text-truncate" data-i18n="Boxicons">Reports</div>
									</a>
								</li>
						<?php 
							}
							if(check_permission('inquiry')) {
						?>
								<li class="menu-item" data-module="inquiry" data-title="Inquiries">
									<a href="<?php echo base_url('inquiries'); ?>" class="menu-link">
										<i class="menu-icon tf-icons bx bx-crown"></i>
										<div class="text-truncate" data-i18n="Boxicons">Inquiries</div>
									</a>
								</li>
						<?php 
							}
							if(check_permission('product')) {
						?>
								<li class="menu-item" data-module="product" data-title="Products">
									<a href="<?php echo base_url('products'); ?>" class="menu-link">
										<i class="menu-icon tf-icons bx bx-crown"></i>
										<div class="text-truncate" data-i18n="Boxicons">Products</div>
									</a>
								</li>
						<?php
							}
							if(check_permission('customer')) {
						?>
								<li class="menu-item" data-module="customer" data-title="Customers">
									<a href="<?php echo base_url('customers'); ?>" class="menu-link">
										<i class="menu-icon tf-icons bx bx-crown"></i>
										<div class="text-truncate" data-i18n="Boxicons">Customers</div>
									</a>
								</li>
						<?php 
							}
							if(check_permission('category')) {
						?>
								<li class="menu-item" data-module="category" data-title="Categories">
									<a href="<?php echo base_url('categories'); ?>" class="menu-link">
										<i class="menu-icon tf-icons bx bx-crown"></i>
										<div class="text-truncate" data-i18n="Boxicons">Categories</div>
									</a>
								</li>
						<?php 
							}
							if(check_permission('sub_category')) {
						?>
								<li class="menu-item" data-module="sub_category" data-title="Sub Categories">
									<a href="<?php echo base_url('sub_categories'); ?>" class="menu-link">
										<i class="menu-icon tf-icons bx bx-crown"></i>
										<div class="text-truncate" data-i18n="Boxicons">Sub Categories</div>
									</a>
								</li>
						<?php
							}
							if(check_permission('general_setting')) {
						?>
								<li class="menu-item" data-module="general_setting" data-title="General Settings">
									<a href="<?php echo base_url('general-settings'); ?>" class="menu-link">
										<i class="menu-icon tf-icons bx bx-crown"></i>
										<div class="text-truncate" data-i18n="Boxicons">General Settings</div>
									</a>
								</li>
						<?php 
							}
						?>
						<li class="menu-item" data-module="page_setting" data-title="Page Settings">
							<a href="javascript:void(0);" class="menu-link menu-toggle">
								<i class="menu-icon tf-icons bx bx-crown"></i>
								<div class="text-truncate" data-i18n="Authentications">Page Settings</div>
							</a>
							<ul class="menu-sub">
								<li class="menu-item">
									<a href="<?php echo base_url('about-us-content'); ?>" class="menu-link">About Us</a>
								</li>
								<li class="menu-item">
									<a href="<?php echo base_url('tc-content'); ?>" class="menu-link">Terms and Conditions</a>
								</li>
								<li class="menu-item">
									<a href="<?php echo base_url('privacy-policy-content'); ?>" class="menu-link">Privacy Policy</a>
								</li>
								<li class="menu-item">
									<a href="<?php echo base_url('return-policy-content'); ?>" class="menu-link">Return Policy</a>
								</li>
								<li class="menu-item">
									<a href="<?php echo base_url('shipping-policy-content'); ?>" class="menu-link">Shipping Policy</a>
								</li>
							</ul>
						</li>
					</ul>
				</aside>
				<div class="layout-page">
					<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
						<div class="layout-menu-toggle navbar-nav align-items-xl-center me-4 me-xl-0   d-xl-none ">
							<a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)"><i class="bx bx-menu bx-md"></i></a>
						</div>
						<div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
							<!-- <div class="navbar-nav align-items-center">
								<div class="nav-item d-flex align-items-center">
									<i class="bx bx-search bx-md"></i>
									<input type="text" class="form-control border-0 shadow-none ps-1 ps-sm-2" placeholder="Search..." aria-label="Search...">
								</div>
							</div> -->
							<ul class="navbar-nav flex-row align-items-center ms-auto">
								<!-- <li class="nav-item lh-1 me-4">
									<a class="github-button" href="https://github.com/themeselection/sneat-html-admin-template-free" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star themeselection/sneat-html-admin-template-free on GitHub">Star</a>
								</li> -->
								<li class="nav-item navbar-dropdown dropdown-user dropdown">
									<a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);" data-bs-toggle="dropdown">
										<div class="avatar avatar-online">
											<img src="<?php echo base_url('public/assets/img/avatars/1.png'); ?>" alt class="w-px-40 h-auto rounded-circle" />
										</div>
									</a>
									<ul class="dropdown-menu dropdown-menu-end">
										<li>
											<a class="dropdown-item" href="#">
												<div class="d-flex">
													<div class="flex-shrink-0 me-3">
														<div class="avatar avatar-online">
															<img src="<?php echo base_url('public/assets/img/avatars/1.png'); ?>" alt class="w-px-40 h-auto rounded-circle" />
														</div>
													</div>
													<div class="flex-grow-1">
														<h6 class="mb-0"><?php echo $userdata['name']; ?></h6>
														<small class="text-muted">Super Admin</small>
													</div>
												</div>
											</a>
										</li>
										<li>
											<div class="dropdown-divider my-1"></div>
										</li>
										<li><a class="dropdown-item" href="<?php echo base_url('profile'); ?>"><i class="bx bx-user bx-md me-3"></i><span>My Profile</span></a></li>
										<!-- <li><a class="dropdown-item" href="#"><i class="bx bx-cog bx-md me-3"></i><span>Settings</span></a></li> -->
										<li><a class="dropdown-item" href="<?php echo base_url('logout'); ?>"><i class="bx bx-power-off bx-md me-3"></i><span>Log Out</span></a></li>
									</ul>
								</li>
							</ul>
						</div>
					</nav>
					<?= $this->renderSection('main_content'); ?>
				</div>
			</div>
		</div>
		<!-- Full-page loader -->
		<!-- <div id="page-loader" class="position-fixed top-0 start-0 w-100 h-100 bg-light bg-opacity-75 d-flex justify-content-center align-items-center" style="z-index: 1050;">
  			<div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
    			<span class="visually-hidden">Loading...</span>
  			</div>
		</div> -->
		<script src="<?php echo base_url('public/assets/vendor/libs/popper/popper.js'); ?>"></script>
		<script src="<?php echo base_url('public/assets/vendor/js/bootstrap.js'); ?>"></script>
		<script src="<?php echo base_url('public/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js'); ?>"></script>
		<script src="<?php echo base_url('public/assets/vendor/js/menu.js'); ?>"></script>
		<script src="<?php echo base_url('public/assets/js/main.js'); ?>"></script>
		<script async defer src="<?php echo base_url('public/assets/buttons.js'); ?>"></script>
		<script src="<?php echo base_url('public/assets/toast/jquery.toast.js'); ?>"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#main-menu li").each(function(){
					if($(this).find("ul").length > 0) {
						var parent = $(this);
						$(this).find("ul li").each(function(){
							if($.trim($(this).text()) == page_title) {
								parent.addClass("active open");
							}
						})
					} else {
						if($.trim($(this).find("a").text()) == page_title) {
							$(this).addClass("active open");
						}
					}
				});
				if($('.summernote').length > 0) {
					$('.summernote').summernote({
			      		placeholder: 'Type here...',
			      		tabsize: 2,
			      		height: "auto"
			    	});
				}
				$('.select2').select2();
				if($("#success-msg").length) {
					show_toast($("#success-msg").text());
				}
				if($("#error-msg").length) {
					show_toast($("#error-msg").text());
				}
			});
			function remove_row(url)
			{
				if(confirm("Are you sure to remove this row?")){
					$.ajax({
						url: url,
						type: "get",
						data:{
							"_method": "DELETE"
						},
						success:function(response){
							if(response.status == "success") {
								window.location.reload();
							}
						},
						error: function(xhr, status, error) {  // Function to handle errors
							const response = xhr.responseJSON;
						    if (response?.csrf) {
						        $("input[name=csrf_token]").val(response.csrf);
						    }
						    alert(error);						    
						},
					});
				}
			}
			function show_toast(msg,second = 3000)
		    {
		    	$.toast({
				    text: msg,
				    showHideTransition: 'fade',
				    position: 'bottom-center',
				    hideAfter: second
				})
		    }
		</script>
	</body>
</html>