<?= $this->extend('include/front_header'); ?>
<?= $this->section('main_content'); ?>
<div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row ec_breadcrumb_inner">
                    <div class="col-md-6 col-sm-12">
                        <h2 class="ec-breadcrumb-title">FAQ</h2>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <!-- ec-breadcrumb-list start -->
                        <ul class="ec-breadcrumb-list">
                            <li class="ec-breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                            <li class="ec-breadcrumb-item active">FAQ</li>
                        </ul>
                        <!-- ec-breadcrumb-list end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="ec-page-content section-space-p">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="section-title">
                    <h2 class="ec-bg-title">FAQ</h2>
                    <h2 class="ec-title">FAQ</h2>
                    <p class="sub-title mb-3">Customer service management</p>
                </div>
            </div>
            <div class="ec-faq-wrapper">
                <div class="ec-faq-container">
                    <!-- <h2 class="ec-faq-heading">What is ekka services?</h2> -->
                    <div id="ec-faq">
                        <?php
                            if($faqs) {
                                foreach($faqs as $faq) {
                        ?>
                                    <div class="col-sm-12 ec-faq-block">
                                        <h4 class="ec-faq-title"><b><?php echo $faq['query']; ?></b></h4>
                                        <div class="ec-faq-content">
                                            <p><?php echo $faq['answer']; ?></p>
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
</section>
<?= $this->endSection(); ?>