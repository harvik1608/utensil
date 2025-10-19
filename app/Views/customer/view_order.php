<?= $this->extend('include/front_header'); ?>
<?= $this->section('main_content'); ?>
<div class="sticky-header-next-sec ec-breadcrumb section-space-mb">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row ec_breadcrumb_inner">
                    <div class="col-md-6 col-sm-12">
                        <h2 class="ec-breadcrumb-title">View Order</h2>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <ul class="ec-breadcrumb-list">
                            <li class="ec-breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                            <li class="ec-breadcrumb-item active">View Order</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="ec-page-content section-space-p">
    <div class="container">
        <a href="<?php echo base_url('download-invoice/'.$order['id']); ?>" class="btn btn-lg btn-primary pull-right">Download Invoice</a><br><br>
        <div class="ec-trackorder-content col-md-12">
            <div class="ec-trackorder-inner">
                <div class="ec-trackorder-top">
                    <h2 class="ec-order-id">order #<?php echo $order['order_no']; ?></h2>
                    <div class="ec-order-detail">
                        <div>Order placed on <?php echo format_date($order['order_date']); ?></div>
                        <div>Status : <span><?php echo order_status($order['status'],1); ?></span></div>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-6">
                        <div class="table-responsive">
                            <table class="table ec-table">
                                <tbody>
                                    <tr>
                                        <td colspan="2"><b>BILLING ADDRESS</b></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo $customer['fname']." ".$customer['lname']; ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo $customer['address']; ?>,</td>
                                    </tr>
                                    <tr>
                                        <td><?php echo $customer['city'].", ".$customer['region'].", ".$customer['postcode']; ?>,</td>
                                    </tr>
                                    <tr>
                                        <td><?php echo $customer['country']; ?>.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="table-responsive">
                            <table class="table ec-table">
                                <tbody>
                                    <tr>
                                        <td colspan="2" align="right"><b>SHIPPING ADDRESS</b></td>
                                    </tr>
                                    <tr>
                                        <td align="right"><?php echo $customer['shipping_fname']." ".$customer['shipping_lname']; ?> <small>(<?php echo $customer['shipping_phone']; ?>)</small></td>
                                    </tr>
                                    <tr>
                                        <td align="right"><?php echo $customer['shipping_address']; ?>,</td>
                                    </tr>
                                    <tr>
                                        <td align="right"><?php echo $customer['shipping_city'].", ".$customer['shipping_region'].", ".$customer['shipping_postcode']; ?>,</td>
                                    </tr>
                                    <tr>
                                        <td align="right"><?php echo $customer['shipping_country']; ?>.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <h5>Order Items</h5>
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table ec-table table-bordered">
                                <thead>
                                    <tr>
                                        <th width="15%">Image</th>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th align="right" class="amt-column">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        if($items) {
                                            $total = 0;
                                            foreach ($items as $key => $val) {
                                                $src = base_url("public/website/assets/images/product-image/1.jpg");
                                                if($val["avatar"] != "" && file_exists("public/uploads/product/".$val["avatar"])) {
                                                    $src = base_url("public/uploads/product/".$val["avatar"]);
                                                }
                                                $price = $val['product_discount_amt'] > 0 ? $val['product_discount_amt'] : $val['product_amt'];
                                                $total = $total + ($val['quantity']*$price);
                                    ?>
                                                <tr>
                                                    <td><img class="ec-cart-pro-img mr-4" src="<?php echo $src; ?>" alt="<?php echo $val['name']; ?>" /></td>
                                                    <td><?php echo $val['name']; ?></td>
                                                    <td><?php echo $val['quantity']; ?></td>
                                                    <td><?php echo currency().$price; ?></td>
                                                    <td align="right"><?php echo currency().number_format($val['quantity']*$price,2); ?></td>
                                                </tr>
                                    <?php
                                            }
                                        }
                                    ?>
                                    <tr>
                                        <td align="right" colspan="4">SUBTOTAL</td>
                                        <td align="right"><?php echo currency().number_format($total,2); ?></td>
                                    </tr>
                                    <tr>
                                        <td align="right" colspan="4">SHIPPING CHARGE </td>
                                        <td align="right"><?php echo currency().$order['shipping_cost']; ?></td>
                                    </tr>
                                    <tr>
                                        <td align="right" colspan="4">VAT </td>
                                        <td align="right"><?php echo currency().$order['vat_charge']; ?></td>
                                    </tr>
                                    <tr>
                                        <td align="right" colspan="4"><b>TOTAL</b></td>
                                        <td align="right"><b><?php echo currency().number_format(($total+$order['shipping_cost']+$order['vat_charge']),2); ?></b></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- <div class="col-md-4">
                        <div class="table-responsive">
                            <table class="table ec-table table-bordered">
                                <tbody>
                                    <tr>
                                        <td>Name </td>
                                        <td><?php echo $customer['fname']." ".$customer['lname']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Placed on </td>
                                        <td><?php echo format_date($order['order_date']); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Status </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Amount Paid</td>
                                        <td><b><?php echo currency().number_format(($order['amount']+$order['shipping_cost']+$order['vat_charge']),2); ?></b></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                     -->
                </div>
                <div class="ec-vendor-block-img space-bottom-30">
                    <div class="ec-vendor-upload-detail">
                        <a href="<?php echo base_url('my-orders'); ?>" class="btn btn-lg btn-secondary qty_close">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>