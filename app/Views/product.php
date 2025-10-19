<?= $this->extend('include/front_header'); ?>
<?= $this->section('main_content'); ?>
<style>
    .product-video {
        float: right;
    }
</style>
<div class="sticky-header-next-sec ec-breadcrumb section-space-mb">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row ec_breadcrumb_inner">
                    <div class="col-md-6 col-sm-12">
                        <h2 class="ec-breadcrumb-title"><?php echo $product['name']; ?></h2>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <ul class="ec-breadcrumb-list">
                            <li class="ec-breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="ec-breadcrumb-item active"><?php echo $product['name']; ?></li>
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
            <div class="ec-pro-rightside ec-common-rightside col-lg-12 col-md-12">
                <div class="single-pro-block">
                    <div class="single-pro-inner">
                        <div class="row">
                            <div class="single-pro-img single-pro-img-no-sidebar">
                                <div class="single-product-scroll">
                                    <div class="single-product-cover">
                                        <?php
                                            $photos = json_decode($product["photos"],true);
                                            if($photos) {
                                                foreach($photos as $photo) {
                                                    if($photo["avatar"] != "" && file_exists("public/uploads/product/".$photo['avatar'])) {
                                        ?>
                                                        <div class="single-slide zoom-image-hover">
                                                            <img class="img-responsive zoom-hover" src="<?php echo base_url('public/uploads/product/'.$photo['avatar']); ?>" alt="">
                                                        </div>
                                        <?php
                                                    }
                                                }
                                            } 
                                        ?>
                                    </div>
                                    <div class="single-nav-thumb">
                                        <?php
                                            $photos = json_decode($product["photos"],true);
                                            if($photos) {
                                                foreach($photos as $photo) {
                                                    if($photo["avatar"] != "" && file_exists("public/uploads/product/".$photo['avatar'])) {
                                        ?>
                                                        <div class="single-slide">
                                                            <img class="img-responsive" src="<?php echo base_url('public/uploads/product/'.$photo['avatar']); ?>" alt="">
                                                        </div>
                                        <?php
                                                    }
                                                }
                                            } 
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="single-pro-desc single-pro-desc-no-sidebar">
                                <div class="single-pro-content">
                                    <h5 class="ec-single-title"><?php echo $product['name']; ?></h5>
                                    <!-- <div class="ec-single-desc"><?php echo $product['description']; ?></div> -->
                                    <div class="ec-single-price-stoke">
                                        <div class="ec-single-price">
                                            <span class="ec-single-ps-title">Price</span>
                                            <span class="old-price"><strike><?php echo currency().' '.$product['price']; ?></strike></span>
                                            <span class="new-price"><?php echo currency().' '.$product['discount_price']; ?></span>
                                        </div>
                                        <div class="ec-single-stoke">
                                            <span class="ec-single-ps-title"><?php echo $product['in_stock'] == 1 ? "IN STOCK" : "OUT OF STOCK"; ?></span>
                                            <span class="ec-single-sku">SKU#: <?php echo $product['sku']; ?></span>
                                        </div>
                                    </div>
                                    <div class="ec-single-qty">
                                        <div class="qty-plus-minus">
                                            <input class="qty-input" type="text" name="ec_qtybtn" id="ec_qtybtn" value="<?php echo $product['min_order']; ?>" />
                                        </div>
                                        <div class="ec-single-cart ">
                                            <button class="btn btn-primary" type="button" id="addtocart" onclick="add_to_cart('<?php echo $product['slug']; ?>',1)">Add To Cart</button>
                                        </div>
                                        <div class="ec-single-wishlist">
                                            <a class="ec-btn-group wishlist" title="Wishlist" href="javascript:;" onclick="add_to_favourite('<?php echo $product['slug']; ?>',<?php echo $product['id']; ?>)"><i class="fi-rr-heart"></i></a>
                                        </div>
                                        <?php if($product["video"] != "") { ?>
                                            <div class="ec-single-cart product-video">
                                                <button class="btn btn-primary" type="button" onclick="watch_video()">Watch Video</button>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ec-single-pro-tab">
                    <div class="ec-single-pro-tab-wrapper">
                        <div class="ec-single-pro-tab-nav">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" data-bs-target="#ec-spt-nav-info" role="tab" aria-controls="ec-spt-nav-info" aria-selected="false">More Information</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" data-bs-target="#ec-spt-nav-details" role="tab" aria-controls="ec-spt-nav-details" aria-selected="true">Detail</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content  ec-single-pro-tab-content">
                            <div id="ec-spt-nav-info" class="tab-pane fade show active">
                                <div class="ec-single-pro-tab-moreinfo">
                                    <ul>
                                        <li><span>Code</span> : <?php echo $product['code']; ?></li>
                                        <li><span>Category</span> : <?php echo $product['category']; ?></li>
                                        <li><span>Sub Category</span> : <?php echo $product['sub_category']; ?></li>
                                        <li><span>Brand</span> : <?php echo $product['brand']; ?></li>
                                        <li><span>Condition</span> : <?php echo $product['product_condition']; ?></li>
                                        <li><span>Barcode</span> : <?php echo $product['barcode']; ?></li>
                                        <li><span>Reference No.</span> : <?php echo $product['reference']; ?></li>
                                        <li><span>Min. Order</span> : <?php echo $product['min_order']; ?></li>
                                    </ul>
                                </div>
                            </div>
                            <div id="ec-spt-nav-details" class="tab-pane fade">
                                <div class="ec-single-pro-tab-desc">
                                    <?php echo $product['description']; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section ec-releted-product section-space-p">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="section-title">
                    <h2 class="ec-bg-title">Related products</h2>
                    <h2 class="ec-title">Related products</h2>
                    <p class="sub-title">Browse The Collection of Top Products</p>
                </div>
            </div>
        </div>
        <div class="row margin-minus-b-30">
            <?php
                if($other_products) {
                    foreach ($other_products as $key => $val) {
                        $src1 = base_url("public/website/assets/images/product-image/6_1.jpg");
                        if($val["avatar"] != "" && file_exists("public/uploads/product/".$val["avatar"])) {
                            $src1 = base_url("public/uploads/product/".$val["avatar"]);
                        }
            ?>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 mb-6 pro-gl-content">
                            <div class="ec-product-inner">
                                <div class="ec-pro-image-outer">
                                    <div class="ec-pro-image">
                                        <a href="product-left-sidebar.html" class="image">
                                            <img class="main-image" src="<?php echo $src1 ;?>" alt="Product" />
                                        </a>
                                        <a href="<?php echo base_url('product/'.$val['slug']); ?>" class="quickview" data-link-action="quickview" title="Quick view"><i class="fi-rr-eye"></i></a>
                                        <div class="ec-pro-actions">
                                            <button title="Add To Cart" class="add-to-cart"><i class="fi-rr-shopping-basket"></i> Add To Cart</button>
                                            <a class="ec-btn-group wishlist" title="Wishlist"><i class="fi-rr-heart"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="ec-pro-content">
                                    <h5 class="ec-pro-title">
                                        <a href="<?php echo base_url('product/'.$val['slug']); ?>"><?php echo $val['name']; ?></a>
                                    </h5>
                                    <span class="ec-price">
                                        <?php
                                            if($val["discount_price"] > 0) {
                                                echo '<span class="old-price">'.currency().' '.$val['price'].'</span>';
                                                echo '<span class="new-price">'.currency().' '.$val['discount_price'].'</span>';
                                            } else {
                                                echo '<span class="new-price">'.currency().' '.$val['price'].'</span>';
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
</section>
<div class="modal fade" id="product_video_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="ec-vendor-block-img space-bottom-30">
                        <div class="ec-vendor-upload-detail">
                            <center>
                                <video width="400" height="300" controls poster="<?php echo base_url('public/assets/img/video_preview.jpg'); ?>">
                                    <source src="<?php echo base_url('public/uploads/product/video/'.$product['video']); ?>" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video><br>
                                <button class="btn btn-primary" type="button" onclick="close_video()">Close</button>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function watch_video()
    {
        $("#product_video_modal").modal("show");
    }
    function close_video()
    {
        $("#product_video_modal").modal("hide");
    }
</script>
<?= $this->endSection(); ?>