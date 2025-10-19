<?= $this->extend('include/front_header'); ?>
<?= $this->section('main_content'); ?>
<div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row ec_breadcrumb_inner">
                    <div class="col-md-6 col-sm-12">
                        <h2 class="ec-breadcrumb-title">All Categories</h2>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <!-- ec-breadcrumb-list start -->
                        <ul class="ec-breadcrumb-list">
                            <li class="ec-breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                            <li class="ec-breadcrumb-item active">All Categories</li>
                        </ul>
                        <!-- ec-breadcrumb-list end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="section ec-category-section ec-category-wrapper-5 section-space-p">
    <div class="container ec-category-wrapper-5">
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
<?= $this->endSection(); ?>