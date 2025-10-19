<?= $this->extend('include/front_header'); ?>
<?= $this->section('main_content'); ?>
<style>
    .ec-slide-1, .ec-slide-2 {
        /*background-image: url(<?php echo base_url('public/uploads/banner/1.webp') ?>);*/
    }
</style>
<div class="ec-side-cart-overlay"></div>
<!-- Main Slider Start -->
<div class="sticky-header-next-sec ec-main-slider section section-space-pb">
    <div class="ec-slider swiper-container main-slider-nav main-slider-dot">
        <!-- Main slider -->
        <div class="swiper-wrapper">
            <?php
                if($banners) {
                    foreach($banners as $banner) {
            ?>
                        <div class="ec-slide-item swiper-slide d-flex ec-slide-1" style="background-image: url(<?php echo base_url('public/uploads/banner/'.$banner['avatar']); ?>)">
                            <div class="container align-self-center">
                                <div class="row">
                                    <div class="col-xl-6 col-lg-7 col-md-7 col-sm-7 align-self-center">
                                        <div class="ec-slide-content slider-animation">
                                            <!-- <h1 class="ec-slide-title"></h1> -->
                                            <h2 class="ec-slide-stitle"></h2>
                                            <p></p>
                                            <!-- <a href="<?php echo base_url('all-products'); ?>" class="btn btn-lg btn-secondary">Browse Products</a> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
            <?php
                    }
                } 
            ?>
        </div>
        <div class="swiper-pagination swiper-pagination-white"></div>
        <div class="swiper-buttons">
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</div>
<!-- Main Slider End -->
<!--  Category Section Start -->
<section class="section ec-category-section ec-category-wrapper-5 section-space-p">
    <div class="container ec-category-wrapper-5">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="section-title">
                    <h2 class="ec-bg-title">Categories</h2>
                    <h2 class="ec-title">Categories</h2>
                    <p class="sub-title">Browse The Collection of Top Categories</p>
                </div>
            </div>
        </div>
        <div class="row cat-space-2 margin-minus-tb-15">
            <?php
                $categories = fetch_categories(1);
                if($categories) {
                    foreach($categories as $key => $val) {
                        $src = base_url("public/website/assets/images/cat-banner/11.jpg");
                        if($val["avatar"] != "" && file_exists("public/uploads/category/".$val["avatar"])) {
                            $src = base_url("public/uploads/category/".$val["avatar"]);
                        }
            ?>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="cat-card">
                                <img class="cat-icon" src="<?php echo $src; ?>" alt="cat-icon">
                                <a class="btn-primary btn-primary-1" href="<?php echo base_url('category/'.$val['slug']); ?>">shop now</a>
                                <div class="cat-detail">
                                    <div class="cat-detail-block">
                                        <h4><?php echo $val['name']; ?></h4>
                                        <h5><?php echo count($val['products']); ?> Products</h5>
                                        <a class="btn-primary" href="<?php echo base_url('category/'.$val['slug']); ?>">shop now</a>
                                    </div>
                                </div>
                            </div>
                        </div>                     
            <?php
                    }
                } 
            ?>
        </div>
    </div>
</section>
<!--  services Section Start -->
<!-- Product tab Area Start -->
<section class="section ec-product-tab section-space-p" id="collection">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="section-title">
                    <h2 class="ec-bg-title">Our Top Collection</h2>
                    <h2 class="ec-title">Our Top Collection</h2>
                    <p class="sub-title">Browse The Collection of Top Products</p>
                </div>
            </div>
            <!-- Tab Start -->
            <!-- <div class="col-md-12 text-center">
                <ul class="ec-pro-tab-nav nav justify-content-center">
                    <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#tab-pro-for-all">All</a></li>
                </ul>
            </div> -->
            <!-- Tab End -->
        </div>
        <div class="row">
            <div class="col">
                <div class="tab-content">
                    <!-- 1st Product tab start -->
                    <div class="tab-pane fade show active" id="tab-pro-for-all">
                        <div class="row">
                        	<?php
                        		if($products) {
                        			foreach($products as $product) {
                        				$src = base_url('public/website/assets/images/product-image/6_1.jpg');
                        				if($product["avatar"] != "" && file_exists("public/uploads/product/".$product["avatar"])) {
                        					$src = base_url("public/uploads/product/".$product["avatar"]);
                        				}
                        	?>
                        				<!-- Product Content -->
			                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 mb-6  ec-product-content" data-animation="fadeIn" id="favourite-<?php echo $product['slug']; ?>">
			                                <div class="ec-product-inner">
			                                    <div class="ec-pro-image-outer">
			                                        <div class="ec-pro-image">
			                                            <a href="<?php echo base_url($product['slug']); ?>p" class="image">
			                                                <img class="main-image" src="<?php echo $src; ?>" alt="Product" />
			                                            </a>
			                                            <div class="ec-pro-actions">
			                                            	<button title="Add To Cart" type="button" class="add-to-cart ec-com-add-cart" onclick="add_to_cart('<?php echo $product['slug']; ?>')"><i class="fi-rr-shopping-basket"></i> Add To Cart</button>
			                                            	<a class="ec-btn-group wishlist" title="Wishlist" onclick="add_to_favourite('<?php echo $product['slug']; ?>',<?php echo $product['id']; ?>)" id="product-<?php echo $product['id']; ?>"><i class="fi-rr-heart"></i></a>
                                                            <a href="<?php echo base_url('product/'.$product['slug']); ?>" class="quickview"><i class="fi-rr-eye"></i></a>
			                                            </div>
			                                       </div>
			                                   	</div>
			                                    <div class="ec-pro-content">
			                                        <h5 class="ec-pro-title"><a href="<?php echo base_url('product/'.$product['slug']); ?>"><?php echo $product['name']; ?></a></h5>
                                                    <span class="old-price">Brand : <?php echo $product['brand']; ?></span>
                                                    <span class="old-price">Category : <?php echo $product['category']; ?></span>
			                                        <span class="ec-price">
			                                        	<?php
			                                        		if($product["discount_price"] > 0) {
			                                        			echo '<span class="old-price">'.currency().$product['price'].'</span>';		
			                                        			echo '<span class="new-price">'.currency().$product['discount_price'].'</span>';		
			                                        		} else {
			                                        			echo '<span class="new-price">'.currency().$product['price'].'</span>';		
			                                        		}
			                                        	?>
			                                        </span>
			                                    </div>
			                                </div>
			                            </div>
                        	<?php
                        			}
                        		} 
                        	?>
                      	</div>
                   	</div>
               	</div>
           	</div>
       	</div>
   	</div>
</section>
<section class="section ec-services-section section-space-p" id="services">
    <h2 class="d-none">Services</h2>
    <div class="container">
        <div class="row">
            <div class="ec_ser_content ec_ser_content_1 col-sm-12 col-md-6 col-lg-3" data-animation="zoomIn">
                <div class="ec_ser_inner">
                    <div class="ec-service-image">
                        <i class="fi fi-ts-truck-moving"></i>
                    </div>
                    <div class="ec-service-desc">
                        <h2>Free Shipping</h2>
                        <p>Free shipping on order above <?php echo currency().SHIPPING_CHARGE; ?></p>
                    </div>
                </div>
            </div>
            <div class="ec_ser_content ec_ser_content_2 col-sm-12 col-md-6 col-lg-3" data-animation="zoomIn">
                <div class="ec_ser_inner">
                    <div class="ec-service-image">
                        <i class="fi fi-ts-hand-holding-seeding"></i>
                    </div>
                    <div class="ec-service-desc">
                        <h2>24X7 Support</h2>
                        <p>Contact us 24 hours a day, 7 days a week</p>
                    </div>
                </div>
            </div>
            <div class="ec_ser_content ec_ser_content_3 col-sm-12 col-md-6 col-lg-3" data-animation="zoomIn">
                <div class="ec_ser_inner">
                    <div class="ec-service-image">
                        <i class="fi fi-ts-badge-percent"></i>
                    </div>
                    <div class="ec-service-desc">
                        <h2>30 Days Return</h2>
                        <p>Simply return it within 30 days for an exchange</p>
                    </div>
                </div>
            </div>
            <div class="ec_ser_content ec_ser_content_4 col-sm-12 col-md-6 col-lg-3" data-animation="zoomIn">
                <div class="ec_ser_inner">
                    <div class="ec-service-image">
                        <i class="fi fi-ts-donate"></i>
                    </div>
                    <div class="ec-service-desc">
                        <h2>Payment Secure</h2>
                        <p>Contact us 24 hours a day, 7 days a week</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Product tab Area End -->
<!--services Section End -->
<!-- ec testmonial Start -->
<section class="section ec-test-section section-space-ptb-100 section-space-m" id="reviews">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="section-title mb-0">
                    <h2 class="ec-bg-title">Testimonial</h2>
                    <h2 class="ec-title">Client Review</h2>
                    <p class="sub-title mb-3">What say client about us</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="ec-test-outer">
                <ul id="ec-testimonial-slider">
                    <li class="ec-test-item">
                        <i class="fi-rr-quote-right top"></i>
                        <div class="ec-test-inner">
                            <!-- <div class="ec-test-img">
                                <img alt="testimonial" title="testimonial" src="assets/images/testimonial/1.jpg" />
                            </div> -->
                            <div class="ec-test-content">
                                <div class="ec-test-desc">Lorem Ipsum is simply dummy text of the printing and
                                    typesetting industry. Lorem Ipsum has been the industry's standard dummy text
                                    ever since the 1500s, when an unknown printer took a galley of type and
                                    scrambled it to make a type specimen</div>
                                <div class="ec-test-name">John Doe</div>
                                <div class="ec-test-designation">General Manager</div>
                                <div class="ec-test-rating">
                                    <i class="ecicon eci-star fill"></i>
                                    <i class="ecicon eci-star fill"></i>
                                    <i class="ecicon eci-star fill"></i>
                                    <i class="ecicon eci-star fill"></i>
                                    <i class="ecicon eci-star fill"></i>
                                </div>
                            </div>
                        </div>
                        <i class="fi-rr-quote-right bottom"></i>
                    </li>
                    <li class="ec-test-item ">
                        <i class="fi-rr-quote-right top"></i>
                        <div class="ec-test-inner">
                            <!-- <div class="ec-test-img"><img alt="testimonial" title="testimonial"
                                    src="assets/images/testimonial/2.jpg" /></div> -->
                            <div class="ec-test-content">
                                <div class="ec-test-desc">Lorem Ipsum is simply dummy text of the printing and
                                    typesetting industry. Lorem Ipsum has been the industry's standard dummy text
                                    ever since the 1500s, when an unknown printer took a galley of type and
                                    scrambled it to make a type specimen</div>
                                <div class="ec-test-name">John Doe</div>
                                <div class="ec-test-designation">General Manager</div>
                                <div class="ec-test-rating">
                                    <i class="ecicon eci-star fill"></i>
                                    <i class="ecicon eci-star fill"></i>
                                    <i class="ecicon eci-star fill"></i>
                                    <i class="ecicon eci-star fill"></i>
                                    <i class="ecicon eci-star fill"></i>
                                </div>
                            </div>
                        </div>
                        <i class="fi-rr-quote-right bottom"></i>
                    </li>
                    <li class="ec-test-item">
                        <i class="fi-rr-quote-right top"></i>
                        <div class="ec-test-inner">
                            <!-- <div class="ec-test-img"><img alt="testimonial" title="testimonial"
                                    src="assets/images/testimonial/3.jpg" /></div> -->
                            <div class="ec-test-content">
                                <div class="ec-test-desc">Lorem Ipsum is simply dummy text of the printing and
                                    typesetting industry. Lorem Ipsum has been the industry's standard dummy text
                                    ever since the 1500s, when an unknown printer took a galley of type and
                                    scrambled it to make a type specimen</div>
                                <div class="ec-test-name">John Doe</div>
                                <div class="ec-test-designation">General Manager</div>
                                <div class="ec-test-rating">
                                    <i class="ecicon eci-star fill"></i>
                                    <i class="ecicon eci-star fill"></i>
                                    <i class="ecicon eci-star fill"></i>
                                    <i class="ecicon eci-star fill"></i>
                                    <i class="ecicon eci-star fill"></i>
                                </div>
                            </div>
                        </div>
                        <i class="fi-rr-quote-right bottom"></i>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- ec testmonial end -->
<?= $this->endSection(); ?>