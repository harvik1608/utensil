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
                        <h2 class="ec-breadcrumb-title">My Payment Requests</h2>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <ul class="ec-breadcrumb-list">
                            <li class="ec-breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                            <li class="ec-breadcrumb-item active">My Payment Requests</li>
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
                        <h5>My Payment Requests</h5>
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
                                        if($payment_requests) {
                                            foreach($payment_requests as $payment_request) {
                                    ?>
                                                <tr id="payment_request-<?php echo $payment_request['id']; ?>">
                                                    <td scope="row"><span>#<?php echo $payment_request['order_no']; ?><span hidden><?php echo $payment_request['note']; ?></span></span></td>
                                                    <td><span><?php echo currency().number_format($payment_request['amount'],2); ?></span></td>
                                                    <td><span><?php echo $payment_request['status'] == 0 ? "Pending" : ($payment_request['status'] == 1 ? "Paid" : "Failed"); ?></span></td>
                                                    <td><span><?php echo format_date($payment_request['created_at']); ?></span></td>
                                                    <td>
                                                        <span class="tbl-btn">
                                                            <?php
                                                                if($payment_request['status'] == 0) {
                                                                    echo '<a href="'.base_url('pay-payment-requests/'.$payment_request['id']).'">Pay</a> | ';
                                                                } 
                                                            ?>
                                                            <a href="javascript:;" onclick="view_refund_note(<?php echo $payment_request['id']; ?>)">View</a>
                                                        </span>
                                                    </td>
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
    function view_refund_note(payment_request_id)
    {
        $("#view_order_refund_modal .modal-body div").html("<p>"+$("#payment_request-"+payment_request_id+" td:eq(0) span:eq(1)").text()+"</p>");
        $("#view_order_refund_modal").modal("show");
    }
</script>
<?= $this->endSection(); ?>