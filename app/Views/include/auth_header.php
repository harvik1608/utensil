<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">
		<meta name="theme-color" content="#2196f3">
		<meta name="author" content="DexignZone" /> 
	    <meta name="keywords" content="" /> 
	    <meta name="robots" content="" /> 
		<meta name="description" content=""/>
		<meta property="og:title" content="" />
		<meta property="og:description" content="" />
		<meta property="og:image" content="social-image.png"/>
		<meta name="format-detection" content="telephone=no">
		<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('public/assets/images/favicon.png'); ?>" />
		<title><?php echo APP_NAME; ?></title>
	    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/assets/vendor/swiper/swiper-bundle.min.css'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/assets/jquery.toast.css'); ?>">
	    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/assets/css/style.css'); ?>">
	    <link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
		<style>
			body, .jq-toast-single {
				font-family: "Nunito", serif !important;
	            font-optical-sizing: auto;
	            font-weight: 400;
	            font-style: normal;
			}
			.text-underline {
				text-decoration: none !important;
			}
			.btn-primary {
			    background-color: #<?php echo THEME_COLOR; ?> !important;
                border-color: #<?php echo THEME_COLOR; ?> !important;
			}
			.swiper-pagination.style-1 .swiper-pagination-bullet-active {
                background: #<?php echo THEME_COLOR; ?> !important;
			}
			.welcome-area .join-area .started {
			    margin-bottom: 0px !important;
			}
		</style>
		<script src="<?php echo base_url('public/assets/js/jquery.js'); ?>"></script>
	</head>   
	<body class="gradiant-bg">
		<div class="page-wraper">
			<!-- <div id="preloader">
				<div class="spinner"></div>
			</div> -->
			<div class="content-body">
				<div class="container vh-100">
					<div class="welcome-area">
						<?= $this->renderSection('content'); ?>
					</div>
				</div>
			</div>
		</div>
		<script src="<?php echo base_url('public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
		<script src="<?php echo base_url('public/assets/vendor/wow/dist/wow.min.js'); ?>"></script>
		<script src="<?php echo base_url('public/assets/vendor/swiper/swiper-bundle.min.js'); ?>"></script>
		<script src="<?php echo base_url('public/assets/js/dz.carousel.js'); ?>"></script>
		<script src="<?php echo base_url('public/assets/js/settings.js'); ?>"></script>
		<script src="<?php echo base_url('public/assets/jquery.toast.js'); ?>"></script>
		<script src="<?php echo base_url('public/assets/js/custom.js'); ?>"></script>
		<script>
		    new WOW().init();
		    
		    var wow = new WOW(
		    {
		      boxClass:     'wow',      // animated element css class (default is wow)
		      animateClass: 'animated', // animation css class (default is animated)
		      offset:       50,          // distance to the element when triggering the animation (default is 0)
		      mobile:       false       // trigger animations on mobile devices (true is default)
		    });
		    wow.init();	

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