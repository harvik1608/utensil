<?= $this->extend('include/front_header'); ?>
<?= $this->section('main_content'); ?>
<!-- Ec breadcrumb start -->
<div class="sticky-header-next-sec ec-breadcrumb section-space-mb">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row ec_breadcrumb_inner">
                    <div class="col-md-6 col-sm-12">
                        <h2 class="ec-breadcrumb-title">Recently Visited</h2>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <ul class="ec-breadcrumb-list">
                            <li class="ec-breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="ec-breadcrumb-item active">Recently Visited</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="ec-page-content section-space-p">
    <div class="container">
        <div class="row">
            <div class="ec-shop-rightside col-lg-12 col-md-12">
                <div class="shop-pro-content">
                	<div class="shop-pro-inner">
                		<div class="row">
                			<?php
                                if($products) {
                                    foreach($products as $product) {
                                        $src = base_url('public/website/assets/images/product-image/6_1.jpg');
                                        if($product["avatar"] != "" && file_exists("public/uploads/product/".$product["avatar"])) {
                                            $src = base_url("public/uploads/product/".$product["avatar"]);
                                        }
                            ?>
                                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 mb-6 pro-gl-content">
                                            <div class="ec-product-inner">
                                                <div class="ec-pro-image-outer">
                                                    <div class="ec-pro-image">
                                                        <a href="<?php echo base_url('product/'.$product['slug']); ?>" class="image">
                                                            <img class="main-image" src="<?php echo $src; ?>" alt="Product" />
                                                        </a>
                                                        <!-- <span class="percentage">20%</span> -->
                                                        <div class="ec-pro-actions">
                                                            <!-- <a href="compare.html" class="ec-btn-group compare" title="Compare"><i class="fi fi-rr-arrows-repeat"></i></a> -->
                                                            <button title="Add To Cart" class="add-to-cart" onclick="add_to_cart('<?php echo $product['slug']; ?>')"><i class="fi-rr-shopping-basket"></i> Add To Cart</button>
                                                            <a class="ec-btn-group wishlist" title="Wishlist" onclick="add_to_favourite('<?php echo $product['slug']; ?>',<?php echo $product['id']; ?>)"><i class="fi-rr-heart"></i></a>
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
                                                                echo '<span class="old-price">'.currency().' '.$product['price'].'</span>';
                                                                echo '<span class="new-price">'.currency().' '.$product['discount_price'].'</span>';
                                                            } else {
                                                                echo '<span class="new-price">'.currency().' '.$product['price'].'</span>';
                                                            }
                                                        ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                            <?php
                                    }
                                } else {
                            ?>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-6 pro-gl-content">
                                        <div class='alert alert-info'>You haven't viewed any products recently.</div>
                                    </div>
                            <?php
                                }
                            ?>
                		</div>
               		</div>
               	</div>
          	</div>
       	</div>
   	</div>
</section>
<script>
	var load_url = "<?php echo base_url('load-all-products'); ?>";
</script>
<script src="<?php echo base_url('public/website/assets/js/custom.js'); ?>"></script>
<script>
    $(document).ready(function(){
        
    });
</script>
<?= $this->endSection(); ?>