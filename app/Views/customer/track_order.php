<?= $this->extend('include/front_header'); ?>
<?= $this->section('main_content'); ?>
<div class="sticky-header-next-sec ec-breadcrumb section-space-mb">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row ec_breadcrumb_inner">
                    <div class="col-md-6 col-sm-12">
                        <h2 class="ec-breadcrumb-title">Track Order</h2>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <ul class="ec-breadcrumb-list">
                            <li class="ec-breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                            <li class="ec-breadcrumb-item active">Track Order</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="ec-page-content section-space-p">
    <div class="container">
        <div class="ec-trackorder-content col-md-12">
            <div class="ec-trackorder-inner">
                <div class="ec-trackorder-top">
                    <h2 class="ec-order-id">order #6152</h2>
                    <div class="ec-order-detail">
                        <div>Expected arrival 14-02-2021-2022</div>
                        <div>Grasshoppers <span>v534hb</span></div>
                    </div>
                </div>
                <div class="ec-trackorder-bottom">
                    <div class="ec-progress-track">
                        <ul id="ec-progressbar">
                            <li class="step0 active">
                                <span class="ec-track-icon"> 
                                    <img src="<?php echo base_url('public/website/assets/images/icons/track_1.png'); ?>" alt="track_order">
                                </span>
                                <span class="ec-progressbar-track"></span>
                                <span class="ec-track-title">order<br>processed</span>
                            </li>
                            <li class="step0 active">
                                <span class="ec-track-icon"> 
                                    <img src="<?php echo base_url('public/website/assets/images/icons/track_2.png'); ?>" alt="track_order">
                                </span>
                                <span class="ec-progressbar-track"></span>
                                <span class="ec-track-title">order<br>designing</span>
                            </li>
                            <li class="step0 active">
                                <span class="ec-track-icon"> 
                                    <img src="<?php echo base_url('public/website/assets/images/icons/track_3.png'); ?>" alt="track_order">
                                </span>
                                <span class="ec-progressbar-track"></span>
                                <span class="ec-track-title">order<br>shipped</span>
                            </li>
                            <li class="step0 active">
                                <span class="ec-track-icon"> 
                                    <img src="<?php echo base_url('public/website/assets/images/icons/track_4.png'); ?>" alt="track_order">
                                </span>
                                <span class="ec-progressbar-track"></span>
                                <span class="ec-track-title">order<br>enroute</span>
                            </li>
                            <li class="step0 active">
                                <span class="ec-track-icon"> 
                                    <img src="<?php echo base_url('public/website/assets/images/icons/track_5.png'); ?>" alt="track_order">
                                </span>
                                <span class="ec-progressbar-track"></span>
                                <span class="ec-track-title">order<br>arrived</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function(){
        
    });
</script>
<?= $this->endSection(); ?>