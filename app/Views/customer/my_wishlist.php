<?= $this->extend('include/front_header'); ?>
<?= $this->section('main_content'); ?>
<div class="sticky-header-next-sec ec-breadcrumb section-space-mb">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row ec_breadcrumb_inner">
                    <div class="col-md-6 col-sm-12">
                        <h2 class="ec-breadcrumb-title">My Wishlist</h2>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <ul class="ec-breadcrumb-list">
                            <li class="ec-breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                            <li class="ec-breadcrumb-item active">My Wishlist</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="ec-page-content ec-vendor-uploads ec-user-account section-space-p">
    <div class="container">
        <div class="row">
            <?= $this->include('include/sidebar'); ?>
            <div class="ec-shop-rightside col-lg-9 col-md-12">
                <div class="ec-vendor-dashboard-card">
                    <div class="ec-vendor-card-header">
                        <h5>My Wishlist</h5>
                        <div class="ec-header-btn">
                            <a class="btn btn-lg btn-primary" href="<?php echo base_url('all-products'); ?>">Shop Now</a>
                        </div>
                    </div>
                    <div class="ec-vendor-card-body">
                        <div class="ec-vendor-card-table">
                            <table class="table ec-table table-bordered" id="favourite-tbl-list">
                                <thead>
                                    <tr>
                                        <th scope="col" class="tbl_th">No</th>
                                        <th scope="col" class="tbl_th">Image</th>
                                        <th scope="col" class="tbl_th">Name</th>
                                        <th scope="col" class="tbl_th">Price</th>
                                        <th scope="col" class="tbl_th">Min. Order</th>
                                        <th scope="col" class="tbl_th">Availability</th>
                                        <th scope="col" class="tbl_th">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if($products) {
                                            $no = 0;
                                            foreach($products as $product) {
                                                $no++;
                                                $src = base_url('public/website/assets/images/product-image/1.jpg');
                                                if($product["avatar"] != "" && file_exists("public/uploads/product/".$product["avatar"])) {
                                                    $src = base_url("public/uploads/product/".$product["avatar"]);
                                                }
                                    ?>  
                                                <tr id="favourite-<?php echo $product['slug']; ?>">
                                                    <td scope="row" align="center"><span><?php echo $no; ?></span></td>
                                                    <td align="center"><img class="prod-img" src="<?php echo $src; ?>" alt="product image"></td>
                                                    <td align="center"><span class="avl"><?php echo $product['name']; ?></span></td>
                                                    <td align="center"><span class="out"><?php echo $product['discount_price'] != 0 ? currency()." ".$product['discount_price'] : currency()." ".$product['price']; ?></span></td>
                                                    <td align="center"><span class="avl"><?php echo $product['min_order']; ?></span></td>
                                                    <td align="center"><span class="out"><?php echo $product['in_stock'] == 1 ? "<b>In stock</b>" : "Out of stock"; ?></span></td>
                                                    <td align="center"><span class="tbl-btn">
                                                        <a class="btn btn-lg btn-primary ec-com-add-cart" href="javascript:void(0)" title="Add To Cart" onclick="add_to_cart('<?php echo $product['slug']; ?>')">
                                                            <i class="fi-rr-shopping-basket"></i>
                                                        </a>
                                                        <a class="btn btn-lg btn-primary ec-com-remove ec-remove-wish" href="javascript:;" title="Remove From List" onclick="remove_from_favourite('<?php echo $product['slug']; ?>')"><i class="fi-rr-trash"></i></a></span>
                                                    </td>
                                                </tr>
                                    <?php
                                            }
                                        } else {
                                            echo '<tr><td colspan="6">You haven’t added any favourites yet.</td></tr>';
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>