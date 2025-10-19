<?= $this->extend('include/front_header'); ?>
<?= $this->section('main_content'); ?>
<style>
    .ec-vendor-card-table .ec-table thead th, .ec-vendor-card-table .ec-table tbody td {
        /*text-align: center;*/
    }
    #view-order-div .ec-cart-pro-img {
        width: 100%;
    }
    #refund-tbl thead tr th:last, #refund-tbl tbody tr td:last {
        text-align: right !important;
    }
    #view_order_modal .qty_close {
        float: right;
    }
</style>
<div class="sticky-header-next-sec ec-breadcrumb section-space-mb">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row ec_breadcrumb_inner">
                    <div class="col-md-6 col-sm-12">
                        <h2 class="ec-breadcrumb-title">My Refunds</h2>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <ul class="ec-breadcrumb-list">
                            <li class="ec-breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                            <li class="ec-breadcrumb-item active">My Refunds</li>
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
                        <h5>My Refunds</h5>
                        <div class="ec-header-btn">
                            <a class="btn btn-lg btn-primary" href="<?php echo base_url('all-products'); ?>">Shop Now</a>
                        </div>
                    </div>
                    <div class="ec-vendor-card-body">
                        <div class="ec-vendor-card-table">
                            <table class="table ec-table" id="refund-tbl">
                                <thead>
                                    <tr>
                                        <th scope="col">Order No</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Raised On</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        if($refunds) {
                                            foreach($refunds as $refund) {
                                    ?>
                                                <tr id="refund-<?php echo $refund['id']; ?>">
                                                    <td scope="row"><span>#<?php echo $refund['order_no']; ?><span hidden><?php echo $refund['note']; ?></span></span></td>
                                                    <td><span><?php echo currency().number_format($refund['amount'],2); ?></span></td>
                                                    <td><span><?php echo $refund['status'] == 0 ? "Pending" : ($refund['status'] == 1 ? "Received" : "Failed"); ?></span></td>
                                                    <td><span><?php echo format_date($refund['created_at']); ?></span></td>
                                                    <td><span class="tbl-btn"><a href="javascript:;" onclick="view_refund_note(<?php echo $refund['id']; ?>)">View</a></span></td>
                                                <tr>
                                    <?php
                                            }
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
<div class="modal fade" id="view_order_refund_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function view_refund_note(refund_id)
    {
        $("#view_order_refund_modal .modal-body div").html("<p>"+$("#refund-"+refund_id+" td:eq(0) span:eq(1)").text()+"</p>");
        $("#view_order_refund_modal").modal("show");
    }
</script>
<?= $this->endSection(); ?>