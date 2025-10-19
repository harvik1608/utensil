<?= $this->extend('include/front_header'); ?>
<?= $this->section('main_content'); ?>
<style>
    .ec-vendor-card-table .ec-table thead th, .ec-vendor-card-table .ec-table tbody td {
        text-align: center;
    }
    #view-order-div .ec-cart-pro-img {
        width: 100%;
    }
    #order-item thead tr th:last {
        text-align: right !important;
    }
    #view_order_modal .qty_close {
        float: right;
    }
    #dropzone {
        border: 2px dashed #999;
        padding: 40px;
        text-align: center;
        color: #666;
        width: 300px;
        margin: 50px auto;
    }
    #dropzone.dragover {
        border-color: #333;
        background: #f0f0f0;
    }
    #preview {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        margin-top: 15px;
    }
    #preview img {
        max-width: 100px;
        margin: 5px;
        border: 1px solid #ccc;
        border-radius: 4px;
        padding: 3px;
        background: #fff;
    }
    #return-order-item input {
        padding: 0px !important;
        text-align: center;
    }
</style>
<div class="sticky-header-next-sec ec-breadcrumb section-space-mb">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row ec_breadcrumb_inner">
                    <div class="col-md-6 col-sm-12">
                        <h2 class="ec-breadcrumb-title">My Returned Orders</h2>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <ul class="ec-breadcrumb-list">
                            <li class="ec-breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                            <li class="ec-breadcrumb-item active">My Returned Orders</li>
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
                        <h5>My Returned Orders</h5>
                        <div class="ec-header-btn">
                            <a class="btn btn-lg btn-primary" href="<?php echo base_url('all-products'); ?>">Shop Now</a>
                        </div>
                    </div>
                    <div class="ec-vendor-card-body">
                        <div class="ec-vendor-card-table">
                            <table class="table ec-table">
                                <thead>
                                    <tr>
                                        <th scope="col">Order No</th>
                                        <th scope="col">Returned Date</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Approved Amount</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Payment Status</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        if($returned_orders) {
                                            foreach($returned_orders as $order) {
                                    ?>
                                                <tr id="order-<?php echo $order['order_no']; ?>">
                                                    <td scope="row"><span>#<?php echo $order['order_no']; ?></span></td>
                                                    <td><span><?php echo format_date($order['created_at']); ?></span></td>
                                                    <td><span><?php echo currency().$order['amount']; ?></span></td>
                                                    <td><span><?php echo currency().$order['approved_amount']; ?></span></td>
                                                    <td><span>
                                                        <?php 
                                                            switch($order['status']) {
                                                                case 0:
                                                                    echo "PENDING";
                                                                    break;

                                                                case 1:
                                                                    echo "APPROVED";
                                                                    break;

                                                                case 2:
                                                                    echo "REJECTED";
                                                                    break;
                                                            }
                                                        ?></span>
                                                    </td>
                                                    <td><span>
                                                        <?php 
                                                            switch($order['payment_status']) {
                                                                case 0:
                                                                    echo "PENDING";
                                                                    break;

                                                                case 1:
                                                                    echo "RECEIVED";
                                                                    break;

                                                                case 2:
                                                                    echo "FAILED";
                                                                    break;
                                                            }
                                                        ?></span>
                                                    </td>
                                                    <td><span class="tbl-btn"><a href="javascript:;" onclick="view_returned_order_items('<?php echo $order['id']; ?>')">View Items</a></td>
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
<div class="modal fade" id="view_order_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row" id="view-order-div">
                    
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function view_returned_order_items(return_order_id)
    {
        $.ajax({
            url: "<?php echo base_url('view-returned-order-items'); ?>",
            type: "GET",
            data:{
                return_order_id: return_order_id
            },
            success:function(response) {
                if(response.status == "success") {
                    $("#view_order_modal #view-order-div").html(response.html);
                    $("#view_order_modal").modal("show");
                } else {
                    show_toast(response.message);
                }
            }
        });
    }
</script>
<?= $this->endSection(); ?>