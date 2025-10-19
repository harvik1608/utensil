<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
	   	<meta http-equiv="x-ua-compatible" content="ie=edge" />
	   	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

	   	<title><?php echo APP_NAME; ?></title>
	   	<meta name="keywords" content="" />
	   	<meta name="description" content="<?php echo APP_NAME; ?>">
	   	<meta name="author" content="">

	   	<!-- site Favicon -->
	    <link rel="icon" href="<?php echo base_url('public/website/assets/images/favicon/favicon-32x32.png'); ?>" sizes="32x32" />
	    <link rel="apple-touch-icon" href="<?php echo base_url('public/website/assets/images/favicon/favicon-32x32.png'); ?>" />
	    <meta name="msapplication-TileImage" content="<?php echo base_url('public/website/assets/images/favicon/favicon-32x32.png'); ?>" />

	    <!-- css Icon Font -->
	    <link rel="stylesheet" href="<?php echo base_url('public/website/assets/css/vendor/ecicons.min.css'); ?>" />

	    <!-- css All Plugins Files -->
	    <link rel="stylesheet" href="<?php echo base_url('public/website/assets/css/plugins/animate.css'); ?>" />
	    <link rel="stylesheet" href="<?php echo base_url('public/website/assets/css/plugins/swiper-bundle.min.css'); ?>" />
	    <link rel="stylesheet" href="<?php echo base_url('public/website/assets/css/plugins/jquery-ui.min.css'); ?>" />
	    <link rel="stylesheet" href="<?php echo base_url('public/website/assets/css/plugins/countdownTimer.css'); ?>" />
	    <link rel="stylesheet" href="<?php echo base_url('public/website/assets/css/plugins/slick.min.css'); ?>" />
	    <link rel="stylesheet" href="<?php echo base_url('public/website/assets/css/plugins/bootstrap.css'); ?>" />
	    <link rel="stylesheet" href="<?php echo base_url('public/website/assets/css/plugins/nouislider.css'); ?>" />

	    <!-- Main Style -->
	    <link rel="stylesheet" href="<?php echo base_url('public/website/assets/css/demo1.css'); ?>" />
	    <link rel="stylesheet" href="<?php echo base_url('public/website/assets/css/style.css'); ?>" />
	    <link rel="stylesheet" href="<?php echo base_url('public/website/assets/css/responsive.css'); ?>" />

	    <!-- Background css -->
    	<link rel="stylesheet" id="bg-switcher-css" href="<?php echo base_url('public/website/assets/css/backgrounds/bg-4.css'); ?>">
    	<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/assets/toast/jquery.toast.css'); ?>">
    	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css">

	    <link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
		<style>
			body, .ec-vendor-uploads .ec-vendor-dashboard-card .ec-vendor-card-header h5, .jq-toast-single, #myChart, .ec-main-menu ul li a, .ec-product-inner .ec-pro-content .ec-pro-title a, .ec-product-inner .ec-pro-content .ec-price span.new-price, .ec-category-section .ec-cat-tab-nav .cat-link .cat-desc span, .section-title .ec-title, .ec-service-desc h2, .ec-sidebar-heading h1, .ec-sidebar-wrap h3, .ec-breadcrumb .ec-breadcrumb-title, .single-pro-content .ec-single-title, .single-pro-content .ec-single-price span.new-price, .single-pro-content .ec-single-desc, .tab-pane p, #signInModal h3, .ec-footer .footer-top .ec-footer-widget .ec-footer-heading, .ec-vendor-setting-card .name, .ec-vendor-setting-card h5, .ec-vendor-uploads .ec-vendor-detail-block h6, .ec-trackorder-top .ec-order-id, .ec-sidebar-wrap .ec-sidebar-block .ec-sb-block-content li a, h4.ec-faq-title, .ec-test-section .ec-test-name, .ec-side-cart .ec-menu-title .menu_title, h4, .cat-detail-block h5, h1, h2, h3, h4, h5, h6 {
				font-family: "Nunito", serif !important;
				font-optical-sizing: auto;
				font-weight: 400;
				font-style: normal;
			}
			.dark-logo {
				display: none;
			}
			.list-view .ec-pro-list-desc {
				margin: 0 0 0 0 !important;
			}
			h5.ec-pro-title, .ec-pro-list-desc, .ec-price, .ec-sidebar-wrap .ec-sidebar-block .ec-sb-block-content li a, .ec-footer .footer-top .ec-footer-widget .ec-footer-links .ec-footer-link a, .ec-single-title {
				font-weight: bold !important;
			}
			.ec-sidebar-wrap .ec-sidebar-block .ec-sb-block-content li a {
				font-size: 13px;
			}
			.forget-password {
				float: right;
			}
			#signInModal h3 {
				margin-left: 20px;
			    margin-top: 3%;
			    text-transform: uppercase;
			}
			.sidebar-active {
				color: #3474d4 !important;
				font-weight: bold;
				font-size: 16px;
			}
			.jq-toast-single {
			    width: 300px !important; 
			    white-space: normal !important; /* Allow wrapping */
			}
			.tbl_th {
				text-align: center;
			}
			.ec-cart-pro-qty,.ec-cart-pro-name,.ec-cart-pro-price {
				text-align: center !important;
			}
			.ec-cart-pro-subtotal {
				text-align: right !important;
			}
			.cart-total-amount {
				font-size: 20px !important;
			}
			input[disabled="true"] {
				background-color: #efefef;
			}
			.empty-cart {
				height: 400px !important;
			}
			.ec-footer-logo,.section-space-mb {
				margin-bottom: 0px;
			}
			.amt-column {
				text-align: right;
			}
			.btn-primary,.main-slider-nav .swiper-buttons .swiper-button-prev,.main-slider-nav .swiper-buttons .swiper-button-next,.ec-main-menu > ul > li.active > a:before,.btn-secondary:hover,.single-pro-content .ec-single-qty .ec-btn-group:hover,.ec-single-pro-tab-nav .nav-tabs .nav-link.active,.ec-single-pro-tab-nav .nav-tabs .nav-link:hover,.bg-primary {
				background-color: <?php echo APP_THEME_COLOR; ?> !important;
			}
			.ec-breadcrumb-list li.active,.ec-breadcrumb-list .ec-breadcrumb-item.active::before,.ec-main-menu ul li.active > a,.ec-product-inner .ec-pro-content .ec-pro-title a:hover,.ec-main-menu ul li:hover > a,.ec-footer .footer-top .ec-footer-widget .ec-footer-links .ec-footer-link a:hover,.ec-trackorder-top .ec-order-detail span  {
				color: <?php echo APP_THEME_COLOR; ?> !important;
			}
			.header-search .form-control,.ec-gl-btn .btn:hover,.ec-sidebar-wrap .ec-sidebar-block .ec-sb-block-content li .ec-sidebar-block-item .checked:after,.ec-single-pro-tab-nav .nav-tabs .nav-link.active,.ec-single-pro-tab-nav .nav-tabs .nav-link:hover {
				border: 1px solid <?php echo APP_THEME_COLOR; ?> !important;
			}
			#ec-overlay .ec-ellipsis div:nth-child(1),#ec-overlay .ec-ellipsis div:nth-child(3),.ec-main-menu > ul > li:hover > a:before,.ec-gl-btn .btn:hover,.ec-sidebar-wrap .ec-sidebar-block .ec-sb-block-content li .ec-sidebar-block-item .checked:after {
				background: <?php echo APP_THEME_COLOR; ?> !important;
			}
			.noUi-horizontal .noUi-handle {
				border: 2px solid <?php echo APP_THEME_COLOR; ?> !important;
			}
			.btn-secondary:hover,.single-pro-content .ec-single-qty .ec-btn-group:hover,.single-nav-thumb .slick-slide.slick-current.slick-active img {
				border-color: <?php echo APP_THEME_COLOR; ?> !important;
			}
			@media only screen and (max-width: 575px) {
    			.header-logo {
    				margin-bottom: 0px;
    			}
    		}
    		@media only screen and (max-width: 575px) {
			    .ec-header-bottons .ec-header-btn:last-child {
			    	margin-top: 5px;
			    }
			}
			@media only screen and (max-width: 1499px) {
				.ec-main-menu ul li:not(:last-child) {
				    margin-right: 0px;
				}
			}
			@media only screen and (max-width: 1699px) {
				.ec-main-menu ul li:not(:last-child) {
					margin-right: 0px;
				}
			}
			/*@media only screen and (max-width: 1499px) {
				.ec-footer .footer-top .col-sm-12 {
					width: 25%;
				}
			}*/
		</style>
		<script src="<?php echo base_url('public/website/assets/js/vendor/jquery-3.5.1.min.js'); ?>"></script>
	</head>
	<body>
		<?php
			$search_text = isset($_GET["search_text"]) ? $_GET["search_text"] : "";
			$session = session();
			if($session->getFlashData('message')) {
	            echo '<span id="msg" hidden>'.$session->getFlashData('message').'</span>';
	        }
	        if($session->getFlashData('successMessage')) {
	            echo '<span id="msgSuccess" hidden>'.$session->getFlashData('successMessage').'</span>';
	        }
		?>
		<div id="ec-overlay">
	        <div class="ec-ellipsis">
	            <div></div>
	            <div></div>
	            <div></div>
	            <div></div>
	        </div>
	    </div>
	    <header class="ec-header">
	        <!--Ec Header Top Start -->
	        <div class="header-top">
	            <div class="container">
	                <div class="row align-items-center">
	                    <!-- Header Top social Start -->
	                    <div class="col text-left header-top-left d-none d-lg-block">
	                        <div class="header-top-social">
	                            <span class="social-text text-upper">Follow us on:</span>
	                            <ul class="mb-0">
	                            	<?php if(FACEBOOK_URL != "") { ?>
	                                <li class="list-inline-item"><a target="_blank" class="hdr-facebook" href="<?php echo FACEBOOK_URL; ?>"><i class="ecicon eci-facebook"></i></a></li>
	                            	<?php } ?>
	                                <?php if(INSTAGRAM_URL != "") { ?>
	                                	<li class="list-inline-item"><a target="_blank" class="hdr-instagram" href="<?php echo INSTAGRAM_URL; ?>"><i class="ecicon eci-instagram"></i></a></li>
	                                <?php } ?>
	                            </ul>
	                        </div>
	                    </div>
	                    <!-- Header Top social End -->
	                    <!-- Header Top Message Start -->
	                    <div class="col text-center header-top-center">
	                        <div class="header-top-message text-upper">
	                            <span>Free Shipping</span>Order Over - <?php echo currency()."".SHIPPING_CHARGE; ?>
	                        </div>
	                    </div>
	                    <!-- Header Top Message End -->
	                    <!-- Header Top Language Currency -->
	                    <div class="col header-top-right d-none d-lg-block">
	                        <div class="header-top-lan-curr d-flex justify-content-end">
	                            <?php 
	                            	if($session->get('customerdata')) {
	                            ?>
	                            		<div class="header-top-curr dropdown">
			                                <button class="dropdown-toggle text-upper" data-bs-toggle="dropdown" onclick="window.location.href='<?php echo base_url('my-dashboard'); ?>'">My Account</button>
			                            </div>
			                            <div class="header-top-lan dropdown">
			                                <button class="dropdown-toggle text-upper" data-bs-toggle="dropdown" onclick="window.location.href='<?php echo base_url('my-logout'); ?>'">Logout</button>
			                            </div>
	                            <?php
	                            	} else {
	                            ?>
	                            		<div class="header-top-curr dropdown">
			                                <button class="dropdown-toggle text-upper" data-bs-toggle="dropdown" onclick="window.location.href='<?php echo base_url('sign-in'); ?>'">Sign In</button>
			                            </div>
			                            <div class="header-top-lan dropdown">
			                                <button class="dropdown-toggle text-upper" data-bs-toggle="dropdown" onclick="window.location.href='<?php echo base_url('sign-up'); ?>'">Sign Up</button>
			                            </div>
	                            <?php
	                            	}
	                            ?>
	                        </div>
	                    </div>
	                    <!-- Header Top Language Currency -->
	                    <!-- Header Top responsive Action -->
	                    <div class="col d-lg-none ">
	                        <div class="ec-header-bottons">
	                            <!-- Header User Start -->
	                            <!-- <div class="ec-header-user dropdown">
	                                <button class="dropdown-toggle" data-bs-toggle="dropdown"><i class="fi-rr-user"></i></button>
	                                <ul class="dropdown-menu dropdown-menu-right">
	                                    <li><a class="dropdown-item" href="< ?php echo base_url('sign-up'); ?>">Register</a></li>
	                                    <li><a class="dropdown-item" href="< ?php echo base_url('checkout'); ?>">Checkout</a></li>
	                                    <li><a class="dropdown-item" href="< ?php echo base_url('sign-in'); ?>">Login</a></li>
	                                </ul>
	                            </div> -->
	                            <!-- Header User End -->
	                            <!-- Header Cart Start -->
	                            <a href="<?php echo base_url('my-wishlist') ?>" class="ec-header-btn ec-header-wishlist">
	                                <div class="header-icon"><i class="fi-rr-heart"></i></div>
	                                <span class="ec-header-count mywish_mob"><?php echo get_count('wishlist'); ?></span>
	                            </a>
	                            <!-- Header Cart End -->
	                            <!-- Header Cart Start -->
	                            <a href="<?php echo base_url('my-cart') ?>" class="ec-header-btn">
	                                <div class="header-icon"><i class="fi-rr-shopping-bag"></i></div>
	                                <span class="ec-header-count cart-count-lable mycart_mob"><?php echo get_count('cart'); ?></span>
	                            </a>
	                            <!-- Header Cart End -->
	                            <a href="<?php echo base_url('sign-in'); ?>" class="ec-header-btn ec-sidebar-toggle">
	                                <i class="fi fi-rr-user"></i>
	                            </a>
	                            <!-- Header menu Start -->
	                            <a href="#ec-mobile-menu" class="ec-header-btn ec-side-toggle d-lg-none">
	                                <i class="fi fi-rr-menu-burger"></i>
	                            </a>
	                            <!-- Header menu End -->
	                        </div>
	                    </div>
	                    <!-- Header Top responsive Action -->
	               	</div>
	           	</div>
	       	</div>
	       	<!-- Ec Header Top  End -->
	       	<!-- Ec Header Bottom  Start -->
	        <div class="ec-header-bottom d-none d-lg-block">
	            <div class="container position-relative">
	                <div class="row">
	                    <div class="ec-flex">
	                        <!-- Ec Header Logo Start -->
	                        <div class="align-self-center">
	                            <div class="header-logo">
	                                <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url('public/uploads/general/'.APP_LOGO); ?>" alt="Site Logo" /></a>
	                            </div>
	                        </div>
	                        <!-- Ec Header Logo End -->
	                        <div class="align-self-center">
	                            <div class="header-search">
	                                <form class="ec-btn-group-form" action="<?php echo base_url('all-products'); ?>">
	                                    <input class="form-control ec-search-bar" name="search_text" placeholder="Search products..." type="text" value="<?php echo $search_text; ?>" />
	                                    <button class="submit"><i class="fi-rr-search"></i></button>
	                                </form>
	                            </div>
	                        </div>
	                        <div class="align-self-center">
	                            <div class="ec-header-bottons">
	                                <!-- Header User Start -->
	                                <!-- <div class="ec-header-user dropdown">
	                                    <button class="dropdown-toggle" data-bs-toggle="dropdown"><i class="fi-rr-user"></i></button>
	                                    <ul class="dropdown-menu dropdown-menu-right">
	                                        <li><a class="dropdown-item" href="register.html">Register</a></li>
	                                        <li><a class="dropdown-item" href="checkout.html">Checkout</a></li>
	                                        <li><a class="dropdown-item" href="login.html">Login</a></li>
	                                    </ul>
	                                </div> -->
	                                <!-- Header User End -->
	                                <!-- Header wishlist Start -->
	                                <a href="<?php echo base_url('my-wishlist') ?>" class="ec-header-btn ec-header-wishlist">
	                                    <div class="header-icon"><i class="fi-rr-heart"></i></div>
	                                    <span class="ec-header-count mywish_web"><?php echo get_count('wishlist'); ?></span>
	                                </a>
	                                <!-- Header wishlist End -->
	                                <!-- Header Cart Start -->
	                                <a href="<?php echo base_url('my-cart') ?>" class="ec-header-btn">
	                                    <div class="header-icon"><i class="fi-rr-shopping-bag"></i></div>
	                                    <span class="ec-header-count cart-count-lable mycart_web"><?php echo get_count('cart'); ?></span>
	                                </a>
	                                <!-- Header Cart End -->
	                            </div>
	                        </div>
	                   	</div>
	               	</div>
	           	</div>
	       	</div>
	       	<!-- Ec Header Top  End -->
	       	<!-- Header responsive Bottom  Start -->
	        <div class="ec-header-bottom d-lg-none">
	            <div class="container position-relative">
	                <div class="row ">

	                    <!-- Ec Header Logo Start -->
	                    <div class="col">
	                        <div class="header-logo">
	                            <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url('public/uploads/general/'.APP_LOGO); ?>" alt="Site Logo" />
	                        </div>
	                    </div>
	                    <!-- Ec Header Logo End -->
	                </div>
	            </div>
	        </div>
	        <!-- Header responsive Bottom  End -->
	        <!-- EC Main Menu Start -->
	        <div id="ec-main-menu-desk" class="d-none d-lg-block sticky-nav">
	            <div class="container position-relative">
	                <div class="row">
	                    <div class="col-md-12 align-self-center">
	                        <div class="ec-main-menu">
	                            <a href="javascript:void(0)" class="ec-header-btn ec-sidebar-toggle"> <i class="fi fi-rr-apps"></i></a>
	                            <ul>
	                                <li><a href="<?php echo base_url(); ?>">Home</a></li>
	                                <li><a href="<?php echo base_url('about-us'); ?>">About us</a></li>
	                                <li class="dropdown position-static">
	                                	<a href="javascript:void(0)">Categories</a>
                                		<ul class="mega-menu d-block">
                                			<li class="d-flex">
			                                	<?php
			                                		$categories = fetch_categories(1);
			                                		if($categories) {
			                                			$no = 0;
			                                			foreach($categories as $category) {
			                                				$no++;
			                                				if($no <= 4) {
			                                					echo '<ul class="d-block">';
			                                						echo '<li class="menu_title"><a href="'.base_url('category/'.$category['slug']).'">'.$category['name'].'</a></li>';
			                                						if($category["products"]) {
			                                							$catProno = 0;
			                                							foreach($category["products"] as $catPro) {
			                                								$catProno++;
			                                								if($catProno <= 5) {
			                                									echo '<li><a href="'.base_url('product/'.$catPro['slug']).'">'.$catPro['name'].'</a></li>';
			                                								}
			                                							}
			                                						}
			                                					echo '</ul>';
			                                				}
			                                			}
			                                		}	 
			                                	?>
			                                	<a href="<?php echo base_url('all-categories'); ?>">All</a>
			                              	</li>
			                            </ul>
			                        </li>
			                        <li class="dropdown">
			                        	<a href="javascript:void(0)">Brands</a>
			                        	<ul class="sub-menu">
			                        		<?php
		                                		$brands = fetch_brands(1);
		                                		if($brands) {
		                                			$no = 0;
		                                			foreach($brands as $brand) {
		                                				echo '<li class="dropdown position-static">';
		                                				if(!empty($brand["products"])) {
		                                	?>
		                                					<a href="<?php echo base_url('brand/'.$brand['slug']); ?>"><?php echo $brand['name']; ?> <i class="ecicon eci-angle-right"></i></a>
		                                					<ul class="sub-menu sub-menu-child">
		                                						<?php
		                                							if($brand["products"]) {
		                                								foreach($brand["products"] as $braPro) {
		                                						?>
		                                									<li><a href="<?php echo base_url('product/'.$braPro['slug']); ?>"><?php echo $braPro['name']; ?></a></li>
		                                						<?php
		                                								}
		                                							} 
		                                						?>
		                                					</ul>
		                                	<?php
		                                				}
		                                				echo '</li>';
		                                			}
		                                		}	 
		                                	?>
			                        	</ul>
			                        </li>
			                        <li><a href="<?php echo base_url('all-products'); ?>">Products</a></li>
	                        		<li><a href="<?php echo base_url('contact-us'); ?>">Contact Us</a></li>
	                           	</ul>
	                       	</div>
	                  	</div>
	               	</div>
	           	</div>
	       	</div>
	       	<!-- Ec Main Menu End -->
	       	<!-- ekka Mobile Menu Start -->
	        <div id="ec-mobile-menu" class="ec-side-cart ec-mobile-menu">
	            <div class="ec-menu-title">
	                <span class="menu_title">Menu</span>
	                <button class="ec-close">×</button>
	            </div>
	            <div class="ec-menu-inner">
	                <div class="ec-menu-content">
	                    <ul>
	                        <li><a href="<?php echo base_url(); ?>">Home</a></li>
	                        <li><a href="<?php echo base_url('about-us'); ?>">About Us</a></li>
	                        <li>
	                        	<a href="javascript:void(0)">Categories</a>
	                        	<ul class="sub-menu">
			                        <?php
		                        		$categories = fetch_categories(1);
		                        		if($categories) {
		                        			$no = 0;
		                        			foreach($categories as $category) {
		                        				$no++;
		                        				if($no <= 4) {
		                        					echo '<li>';
		                        						echo '<a href="'.base_url('category/'.$category['slug']).'">'.$category['name'].'</a>';
	                        							echo '<ul class="sub-menu">';
			                        						if($category["products"]) {
			                        							foreach($category["products"] as $catPro) {
			                        								echo '<li><a href="'.base_url($catPro['slug']).'p">'.$catPro['name'].'</a></li>';
			                        							}
			                        						}
	                        							echo '</ul>';
		                        					echo '</li>';
		                        				}
		                        			}
		                        		}	 
		                        	?>
		                       	</ul>
	                       	</li>
	                       	<li>
	                        	<a href="javascript:void(0)">Brands</a>
	                        	<ul class="sub-menu">
			                        <?php
		                        		$brands = fetch_brands(1);
		                        		if($brands) {
		                        			$no = 0;
		                        			foreach($brands as $brand) {
		                        				$no++;
		                        				if($no <= 4) {
		                        					echo '<li>';
		                        						echo '<a href="'.base_url('brand/'.$brand['slug']).'">'.$brand['name'].'</a>';
	                        							echo '<ul class="sub-menu">';
			                        						if($brand["products"]) {
			                        							foreach($brand["products"] as $braPro) {
			                        								echo '<li><a href="'.base_url($braPro['slug']).'p">'.$braPro['name'].'</a></li>';
			                        							}
			                        						}
	                        							echo '</ul>';
		                        					echo '</li>';
		                        				}
		                        			}
		                        		}	 
		                        	?>
		                       	</ul>
	                        </li>
	                        <li><a href="<?php echo base_url('all-products'); ?>">Products</a></li>
	                        <li><a href="<?php echo base_url('return-policy'); ?>">Return Policy</a></li>
	                        <li><a href="<?php echo base_url('get-support'); ?>">Get Support</a></li>
	                   	</ul>
	               	</div>
	            </div>
	        </div>
	   	</header>
	   	<?= $this->renderSection('main_content'); ?>
	   	<footer class="ec-footer section-space-mt">
	        <div class="footer-container">
	            <div class="footer-top section-space-footer-p">
	                <div class="container">
	                    <div class="row">
	                        <div class="col-sm-12 col-lg-3 ec-footer-contact">
	                            <div class="ec-footer-widget">
	                                <div class="ec-footer-logo">
	                                	<a href="#">
	                                		<img src="<?php echo base_url('public/uploads/general/'.APP_LOGO); ?>" alt="">
	                                	</a>
	                                </div>
	                                <h4 class="ec-footer-heading">Contact us</h4>
	                                <div class="ec-footer-links">
	                                    <ul class="align-items-center">
	                                        <li class="ec-footer-link"><?php echo APP_ADDRESS; ?></li>
	                                        <li class="ec-footer-link"><span>Call Us:</span><a href="tel:<?php echo APP_PHONE; ?>"><?php echo APP_PHONE; ?></a></li>
	                                        <li class="ec-footer-link"><span>Email:</span><a href="mailto:<?php echo APP_EMAIL; ?>"><?php echo APP_EMAIL; ?></a></li>
	                                    </ul>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="col-sm-12 col-lg-2 ec-footer-info">
	                            <div class="ec-footer-widget">
	                                <h4 class="ec-footer-heading">Information</h4>
	                                <div class="ec-footer-links">
	                                    <ul class="align-items-center">
	                                        <li class="ec-footer-link"><a href="<?php echo base_url('about-us'); ?>">About us</a></li>
	                                        <li class="ec-footer-link"><a href="<?php echo base_url('all-faqs'); ?>">FAQ</a></li>
	                                        <li class="ec-footer-link"><a href="<?php echo base_url('term-conditions'); ?>">Terms & Conditions</a></li>
	                                    </ul>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="col-sm-12 col-lg-2 ec-footer-account">
	                            <div class="ec-footer-widget">
	                                <h4 class="ec-footer-heading">Account</h4>
	                                <div class="ec-footer-links">
	                                    <ul class="align-items-center">
	                                        <li class="ec-footer-link"><a href="<?php echo base_url('my-dashboard'); ?>">My Account</a></li>
	                                        <li class="ec-footer-link"><a href="<?php echo base_url('my-orders'); ?>">Order History</a></li>
	                                        <li class="ec-footer-link"><a href="<?php echo base_url('my-wishlist'); ?>">Wish List</a></li>
	                                    </ul>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="col-sm-12 col-lg-2 ec-footer-service">
	                            <div class="ec-footer-widget">
	                                <h4 class="ec-footer-heading">Policy</h4>
	                                <div class="ec-footer-links">
	                                    <ul class="align-items-center">
	                                        <li class="ec-footer-link"><a href="<?php echo base_url('shipping-policy'); ?>">Shipping Policy</a></li>
	                                        <li class="ec-footer-link"><a href="<?php echo base_url('privacy-policy'); ?>">Privacy & Policy</a></li>
	                                        <li class="ec-footer-link"><a href="<?php echo base_url('return-policy'); ?>">Return Policy</a></li>
	                                    </ul>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="col-sm-12 col-lg-3 ec-footer-news">
	                            <div class="ec-footer-widget">
	                                <h4 class="ec-footer-heading">Newsletter</h4>
	                                <div class="ec-footer-links">
	                                    <ul class="align-items-center">
	                                        <li class="ec-footer-link">Get instant updates about our new products and
	                                            special promos!</li>
	                                    </ul>
	                                    <div class="ec-subscribe-form">
	                                        <form id="ec-newsletter-form" name="ec-newsletter-form" method="post"
	                                            action="#">
	                                            <div id="ec_news_signup" class="ec-form">
	                                                <input class="ec-email" type="email" required="" placeholder="Enter your email here..." name="ec-email" value="" />
	                                                <button id="ec-news-btn" class="button btn-primary" type="submit" name="subscribe" value=""><i class="ecicon eci-paper-plane-o" aria-hidden="true"></i></button>
	                                            </div>
	                                        </form>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	            <div class="footer-bottom">
	                <div class="container">
	                    <div class="row align-items-center">
	                        <!-- Footer social Start -->
	                        <div class="col text-left footer-bottom-left">
	                            <div class="footer-bottom-social">
	                                <span class="social-text text-upper">Follow us on:</span>
	                                <ul class="mb-0">
	                                    <li class="list-inline-item"><a target="_blank" class="hdr-facebook" href="<?php echo FACEBOOK_URL; ?>"><i class="ecicon eci-facebook"></i></a></li>
	                                    <li class="list-inline-item"><a target="_blank" class="hdr-instagram" href="<?php echo INSTAGRAM_URL; ?>"><i class="ecicon eci-instagram"></i></a></li>
	                                </ul>
	                            </div>
	                        </div>
	                        <!-- Footer social End -->
	                        <!-- Footer Copyright Start -->
	                        <!-- <div class="col text-center footer-copy">
	                            <div class="footer-bottom-copy ">
	                                <div class="ec-copy">Designed & Developed by <a class="site-name text-upper" href="javascript:;">Henisha Infotech<span>.</span></a></div>
	                            </div>
	                        </div> -->
	                        <!-- Footer Copyright End -->
	                    </div>
	                </div>
	            </div>
	        </div>
	    </footer>
	    <div class="ec-nav-toolbar">
	        <div class="container">
	            <div class="ec-nav-panel">
	                <div class="ec-nav-panel-icons">
	                    <a href="#ec-mobile-menu" class="navbar-toggler-btn ec-header-btn ec-side-toggle"><i
	                            class="fi-rr-menu-burger"></i></a>
	                </div>
	                <div class="ec-nav-panel-icons">
	                    <a href="<?php echo base_url('my-cart') ?>" class="toggle-cart ec-header-btn">
	                    	<i class="fi-rr-shopping-bag"></i>
	                    	<span class="ec-cart-noti mycart_mob"><?php echo get_count('cart'); ?></span>
	                    </a>
	                </div>
	                <div class="ec-nav-panel-icons">
	                    <a href="<?php echo base_url(); ?>" class="ec-header-btn"><i class="fi-rr-home"></i></a>
	                </div>
	                <div class="ec-nav-panel-icons">
	                    <a href="<?php echo base_url('my-wishlist') ?>" class="ec-header-btn">
	                    	<i class="fi-rr-heart"></i>
	                    	<span class="ec-cart-noti mywish_mob"><?php echo get_count('wishlist'); ?></span>
	                    </a>
	                </div>
	                <div class="ec-nav-panel-icons">
	                    <a href="<?php echo base_url('sign-in'); ?>" class="ec-header-btn"><i class="fi-rr-user"></i></a>
	                </div>

	            </div>
	        </div>
	    </div>
	    <!-- Vendor JS -->
	    <script src="<?php echo base_url('public/website/assets/js/vendor/popper.min.js'); ?>"></script>
	    <script src="<?php echo base_url('public/website/assets/js/vendor/bootstrap.min.js'); ?>"></script>
	    <script src="<?php echo base_url('public/website/assets/js/vendor/jquery-migrate-3.3.0.min.js'); ?>"></script>
	    <script src="<?php echo base_url('public/website/assets/js/vendor/modernizr-3.11.2.min.js'); ?>"></script>

	    <!--Plugins JS-->
	    <script src="<?php echo base_url('public/website/assets/js/plugins/swiper-bundle.min.js'); ?>"></script>
	    <script src="<?php echo base_url('public/website/assets/js/plugins/countdownTimer.min.js'); ?>"></script>
	    <script src="<?php echo base_url('public/website/assets/js/plugins/scrollup.js'); ?>"></script>
	    <script src="<?php echo base_url('public/website/assets/js/plugins/jquery.zoom.min.js'); ?>"></script>
	    <script src="<?php echo base_url('public/website/assets/js/plugins/slick.min.js'); ?>"></script>
	    <script src="<?php echo base_url('public/website/assets/js/plugins/infiniteslidev2.js'); ?>"></script>
	    <script src="<?php echo base_url('public/website/assets/js/vendor/jquery.magnific-popup.min.js'); ?>"></script>
	    <script src="<?php echo base_url('public/website/assets/js/plugins/jquery.sticky-sidebar.js'); ?>"></script>
	    <script src="<?php echo base_url('public/website/assets/js/plugins/nouislider.js'); ?>"></script>

	    <!-- Main Js -->
	    <script src="<?php echo base_url('public/assets/toast/jquery.toast.js'); ?>"></script>
	    <script src="<?php echo base_url('public/website/assets/js/vendor/index.js'); ?>"></script>
	    <script src="<?php echo base_url('public/website/assets/js/main.js'); ?>"></script>
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js"></script>
	    <script>
	    	var baseURL = "<?php echo base_url(); ?>";
	    	var csrfName = '<?= csrf_token() ?>';  // usually 'csrf_test_name'
    		var csrfHash = '<?= csrf_hash() ?>';  // actual token
	    	$(document).ready(function(){
	    		$("li[role=presentation]").hide();
	    		if($("#msg").length) {
					show_toast($("#msg").text());
				}
				if($("#msgSuccess").length) {
					show_toast($("#msgSuccess").text());
				}
	    	});
	    	function add_to_cart(slug,min_order = 0)
	    	{
	    		var qty = 0;
	    		if(min_order > 0) {
	    			qty = $("#ec_qtybtn").val();
	    		}
	    		$.ajax({
	    			url: "<?php echo base_url('add-to-cart'); ?>",
	    			type: "POST",
	    			data: {
	    				slug: slug,
	    				min_order: qty,
	    				[csrfName]: csrfHash
	    			},
	    			beforeSend:function(){

	    			},
	    			success:function(response) {
	    				if (response.csrf) {
			                csrfHash = response.csrf;
			            }
	    				if(response.status == "success") {
	    					show_toast(response.message);
	    					$(".mycart_web,.mycart_mob").text(response.count);
	    				} else if(response.status == "need_login") {
	    					window.location.href = response.href;
	    				} else {
	    					show_error_toast(response.message);
	    				}
	    			}
	    		});
	    	}
	    	function add_to_favourite(slug,product_id)
	    	{
	    		$.ajax({
	    			url: "<?php echo base_url('add-to-favourite'); ?>",
	    			type: "POST",
	    			data: {
	    				slug: slug,
	    				product_id: product_id,
	    				[csrfName]: csrfHash
	    			},
	    			beforeSend:function(){

	    			},
	    			success:function(response) {
	    				if (response.csrf) {
			                csrfHash = response.csrf;
			            }
	    				if(response.status == "success") {
	    					show_toast(response.message);
	    					$(".mywish_web,.mywish_mob").text(response.count);
	    				} else if(response.status == "need_login") {
	    					window.location.href = response.href;
	    				} else {
	    					show_toast(response.message);
	    				}
	    			}
	    		});
	    	}
		    function remove_from_cart(cart_id)
		    {
		        $.confirm({
		            title: 'Confirm!',
		            content: 'Are you sure you want to delete this item from your cart?',
		            buttons: {
		                confirm: function () {
		                    $.ajax({
		                        url: "<?php echo base_url('remove-from-cart'); ?>",
		                        type: "POST",
		                        data:{
		                            cart_id: cart_id,
		                            [csrfName]: csrfHash
		                        },
		                        success:function(response) {
		                        	csrfHash = response.csrf;
		                            if(response.status == "success") {
		                            	show_toast(response.message);
		                            	my_cart(1);
		                            } else {
		                            	show_toast(response.message);
		                            }
		                        }
		                    });
		                },
		                cancel: function () {
		                    
		                }
		            }
		        });
		    }
		    function update_cart_quantity(quantity,cart_id)
		    {
		    	$.ajax({
		          	url: "<?php echo base_url('update-cart'); ?>",
		            type: "POST",
		          	data:{
		          		quantity: quantity,
		            	cart_id: cart_id,
		               	[csrfName]: csrfHash
		            },
		           	success:function(response) {
		              	csrfHash = response.csrf;
		               	if(response.status == "success") {
		               		show_toast(response.message);
		                    my_cart();
		                } else if(response.status == "min_order_required" || response.status == "out_of_stock") {
		                	show_error_toast(response.message);
		                	$("#cart-"+cart_id+" input[name=cartqtybutton]").val(response.min_qty);
		                } else {
		                	show_error_toast(response.message);
		                }
		           	}
		      	});
		    }
		    function cancel_order(order_no)
		    {
		    	$.confirm({
		            title: 'Confirm!',
		            content: 'Are you sure you want to cancel this order?',
		            buttons: {
		                confirm: function () {
		                    $.ajax({
		                        url: "<?php echo base_url('cancel-order'); ?>",
		                        type: "POST",
		                        data:{
		                            order_no: order_no,
		                            [csrfName]: csrfHash
		                        },
		                        success:function(response) {
		                        	csrfHash = response.csrf;
		                            if(response.status == "success") {
		                            	window.location.reload();
		                            } else {
		                            	show_toast(response.message);
		                            }
		                        }
		                    });
		                },
		                cancel: function () {
		                    
		                }
		            }
		        });
		    }
		    function view_order(order_no)
		    {
		    	$.ajax({
		           	url: "<?php echo base_url('view-order-items'); ?>",
		          	type: "POST",
		         	data:{
		              	order_no: order_no,
		               	[csrfName]: csrfHash
		           	},
		         	success:function(response) {
		              	csrfHash = response.csrf;
		            	if(response.status == "success") {
		            		$("#view_order_modal #view-order-div").html(response.html);
		            		$("#view_order_modal").modal("show");
		               	} else {
		                 	show_toast(response.message);
		               	}
		           	}
		      	});
		    }
		    function remove_from_favourite(slug)
		    {
		    	$.confirm({
		            title: 'Confirm!',
		            content: 'Are you sure to remove this product from your favourite list?',
		            buttons: {
		                confirm: function () {
		                    $.ajax({
		                        url: "<?php echo base_url('remove-from-favourite'); ?>",
		                        type: "POST",
		                        data:{
		                            slug: slug,
		                            [csrfName]: csrfHash
		                        },
		                        success:function(response) {
		                        	csrfHash = response.csrf;
		                            if(response.status == "success") {
		                            	window.location.reload();
		                            } else {
		                            	show_toast(response.message);
		                            }
		                        }
		                    });
		                },
		                cancel: function () {
		                    
		                }
		            }
		        });
		    }
		    function close_modal(element)
		    {
		    	$("#"+element).modal("hide");
		    }
	    	function show_toast(msg)
		    {
		    	$.toast({
				    heading: 'Success!',
				    text: msg,
				    showHideTransition: 'fade',
				    position: 'bottom-left',
				    icon: 'success',
				    position: 'top-center',
				});
		    }
		    function show_error_toast(msg)
		    {
		    	$.toast({
				    heading: 'Oops!',
				    text: msg,
				    showHideTransition: 'fade',
				    position: 'top-center',
				    icon: 'error',
				    // afterShown: function () {
				    // 	$('.jq-toast-single').css({
				    // 		'width': 'auto',
				    // 		'max-width': '90%',
				    // 		'white-space': 'normal',
				    // 		'display': 'inline-block'
				    // 	});
				    // }
				});
		    }
	    </script>
	</body>
</html>