<?= $this->extend('include/front_header'); ?>
<?= $this->section('main_content'); ?>
<style>
    input[type="checkbox"] {
        height: 15px !important;
        width: auto !important;
        margin-top: 5px;
    }
</style>
<div class="sticky-header-next-sec ec-breadcrumb section-space-mb">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row ec_breadcrumb_inner">
                    <div class="col-md-6 col-sm-12">
                        <h2 class="ec-breadcrumb-title">Checkout</h2>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <ul class="ec-breadcrumb-list">
                            <li class="ec-breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                            <li class="ec-breadcrumb-item active">Checkout</li>
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
            <form method="post" action="<?php echo base_url('place-order'); ?>" id="placeOrderForm">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <?php
                        if($products) { 
                    ?>
                            <div class="ec-cart-leftside col-lg-8 col-md-12">
                                <div class="ec-sidebar-wrap">
                                    <!-- Sidebar Summary Block -->
                                    <div class="ec-sidebar-block">
                                        <div class="ec-sb-title">
                                            <h3 class="ec-sidebar-title">Billing Details</h3>
                                        </div>
                                        <div class="ec-sb-block-content">
                                            <div class="ec-cart-form">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <span class="ec-bill-wrap ec-bill-half">
                                                                <label>First Name*</label>
                                                                <input type="text" name="fname" id="fname" placeholder="Enter your first name" value="<?php echo isset($customer['fname']) ? $customer['fname'] : ''; ?>" />
                                                            </span>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <span class="ec-bill-wrap ec-bill-half">
                                                                <label>Last Name*</label>
                                                                <input type="text" name="lname" id="lname" placeholder="Enter your last name" value="<?php echo isset($customer['lname']) ? $customer['lname'] : ''; ?>" />
                                                            </span>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <span class="ec-bill-wrap ec-bill-half">
                                                                <label>Country*</label>
                                                                <input type="text" name="country" id="country" placeholder="Enter your country" value="UK" disabled="true" />
                                                            </span>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <span class="ec-bill-wrap ec-bill-half">
                                                                <label>Region/State*</label>
                                                                <input type="text" name="region" id="region" placeholder="Enter your region/state" value="<?php echo isset($customer['region']) ? $customer['region'] : ''; ?>" />
                                                            </span>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <span class="ec-bill-wrap ec-bill-half">
                                                                <label>City*</label>
                                                                <input type="text" name="city" id="city" placeholder="Enter your city" value="<?php echo isset($customer['city']) ? $customer['city'] : ''; ?>" />
                                                            </span>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <span class="ec-bill-wrap ec-bill-half">
                                                                <label>Post Code*</label>
                                                                <input type="text" name="postcode" id="postcode" placeholder="Enter your post code" value="<?php echo isset($customer['postcode']) ? $customer['postcode'] : ''; ?>" />
                                                            </span>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <span class="ec-bill-wrap ec-bill-half">
                                                                <label>Address*</label>
                                                                <input type="text" name="address" id="address" placeholder="Enter your address" value="<?php echo isset($customer['address']) ? $customer['address'] : ''; ?>" />
                                                            </span>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="ec-sidebar-block">
                                        <div class="ec-sb-title">
                                            <h3 class="ec-sidebar-title">Shipping Details</h3>
                                        </div>
                                        <div class="ec-sb-block-content">
                                            <div class="ec-cart-form">
                                                <div class="row">
                                                    <p><input type="checkbox" id="same_address" /> <span><small>Same as billing address?</small></span></p>
                                                    <div class="col-lg-6">
                                                        <span class="ec-bill-wrap ec-bill-half">
                                                            <label>First Name*</label>
                                                            <input type="text" name="shipping_fname" id="shipping_fname" placeholder="Enter your first name" value="<?php echo isset($customer['shipping_fname']) ? $customer['shipping_fname'] : ''; ?>" />
                                                        </span>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <span class="ec-bill-wrap ec-bill-half">
                                                            <label>Last Name*</label>
                                                            <input type="text" name="shipping_lname" id="shipping_lname" placeholder="Enter your last name" value="<?php echo isset($customer['shipping_lname']) ? $customer['shipping_lname'] : ''; ?>" />
                                                        </span>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <span class="ec-bill-wrap ec-bill-half">
                                                            <label>Country*</label>
                                                            <input type="text" name="shipping_country" id="shipping_country" placeholder="Enter your country" value="UK" disabled="true" />
                                                        </span>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <span class="ec-bill-wrap ec-bill-half">
                                                            <label>Region/State*</label>
                                                            <input type="text" name="shipping_region" id="shipping_region" placeholder="Enter your region/state" value="<?php echo isset($customer['shipping_region']) ? $customer['shipping_region'] : ''; ?>" />
                                                        </span>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <span class="ec-bill-wrap ec-bill-half">
                                                            <label>City*</label>
                                                            <input type="text" name="shipping_city" id="shipping_city" placeholder="Enter your city" value="<?php echo isset($customer['shipping_city']) ? $customer['shipping_city'] : ''; ?>" />
                                                        </span>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <span class="ec-bill-wrap ec-bill-half">
                                                            <label>Post Code*</label>
                                                            <input type="text" name="shipping_postcode" id="shipping_postcode" placeholder="Enter your post code" value="<?php echo isset($customer['shipping_postcode']) ? $customer['shipping_postcode'] : ''; ?>" />
                                                        </span>
                                                    </div>
                                                    <div class="col-lg-9">
                                                        <span class="ec-bill-wrap ec-bill-half">
                                                            <label>Address*</label>
                                                            <input type="text" name="shipping_address" id="shipping_address" placeholder="Enter your address" value="<?php echo isset($customer['shipping_address']) ? $customer['shipping_address'] : ''; ?>" />
                                                        </span>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <span class="ec-bill-wrap ec-bill-half">
                                                            <label>Contact No.*</label>
                                                            <input type="text" name="shipping_phone" id="shipping_phone" placeholder="Enter your contact no." value="<?php echo isset($customer['shipping_phone']) ? $customer['shipping_phone'] : ''; ?>" />
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="ec-cart-rightside col-lg-4 col-md-12">
                                <div class="ec-sidebar-wrap">
                                    <div class="ec-sidebar-block">
                                        <div class="ec-sb-title">
                                            <h3 class="ec-sidebar-title">Order Summary</h3>
                                        </div>
                                        <div class="ec-sb-block-content">
                                            <table class="table ec-table">
                                                <tbody>
                                                    <?php
                                                        $grand_total = 0;
                                                        if($products) {
                                                            foreach ($products as $key => $val) {
                                                                $price = $val["discount_price"] > 0 ? $val["discount_price"] : $val["price"];
                                                                $total = ($price*$val["quantity"]);
                                                    ?>
                                                                <tr>
                                                                    <td><?php echo $val['name']; ?></td>
                                                                    <td align="right"><?php echo currency()." ".number_format($total,2); ?></td>
                                                                </tr>
                                                    <?php
                                                                $grand_total = $grand_total + $total;
                                                            }
                                                        }
                                                        $calc_charge = calc_charge($grand_total);
                                                        $shipping_charge = $calc_charge["shipping_charge"];
                                                        $vat_charge = $calc_charge["vat_charge"];
                                                        $total_amount = $grand_total + $shipping_charge + $vat_charge;
                                                    ?>
                                                    <tr>
                                                        <td><b>Total</b></td>
                                                        <td align="right"><?php echo currency()." ".number_format($grand_total,2); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Shipping Charge</b></td>
                                                        <td align="right"><?php echo currency()." ".number_format($shipping_charge,2); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>VAT Charge (<?php echo VAT_CHARGE; ?>%)</b></td>
                                                        <td align="right"><?php echo currency()." ".number_format($vat_charge,2); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Amount to Pay</b></td>
                                                        <td align="right"><?php echo currency()." ".number_format($total_amount,2); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2"><textarea name="note" id="note" placeholder="Your note..." class="form-control"></textarea></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2" align="center"><button type="submit" class="btn btn-primary">Place Order</button></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php 
                        } else {
                    ?>
                            <div class="row">
                                <div class="col-lg-12">
                                    <center>
                                        <img src="<?php echo base_url('public/assets/img/empty_cart.png'); ?>" class="img img-thumbnail img-responsive empty-cart" /><br>
                                        <button class="btn btn-primary" type="button" onclick="window.location.href='<?php echo base_url('all-products'); ?>'">Continue Shopping</button>
                                    </center>
                                </div>
                            </div>
                    <?php
                        }
                    ?>
                </div>
            </form>
        </div>
    </div>
</section>
<script>
    $(document).ready(function(){
        $("#placeOrderForm").submit(function(e){
            e.preventDefault();

            $.ajax({
                url: $("#placeOrderForm").attr("action"),
                type: $("#placeOrderForm").attr("method"),
                data: new FormData(this),
                contentType: false,
                processData: false,
                cache: false,
                beforeSend:function(){
                    $("#placeOrderForm button[type=submit]").html('<div class="spinner-border spinner-border-sm text-primary" role="status"><span class="visually-hidden">Loading...</span></div>').attr("disabled",true);
                },
                success:function(response){
                    if(response.status == "success") {
                        window.location.href = response.redirect_url;
                    } else {
                        $("#"+response.input).focus();
                        $("input[name=csrf_token]").val(response.csrf);
                        show_error_toast(response.message);
                        $("#placeOrderForm button[type=submit]").html('Place Order').attr("disabled",false);
                    }
                },
                error: function(xhr, status, error) {  // Function to handle errors
                    const response = xhr.responseJSON;
                    if (response?.csrf) {
                        $("input[name=csrf_token]").val(response.csrf);
                    }
                    show_error_toast(error);
                    $("#placeOrderForm button[type=submit]").html('Place Order').attr("disabled",false);
                },
            });
        });
        $("#postcode").blur(function(){
            fetch_address("postcode","address");
        });
        $("#shipping_postcode").blur(function(){
            fetch_address("shipping_postcode","shipping_address");
        });
        $("#same_address").click(function(){
            if($(this).prop("checked") == true) {
                $("#shipping_fname").val($("#fname").val());
                $("#shipping_lname").val($("#lname").val());
                $("#shipping_region").val($("#region").val());
                $("#shipping_city").val($("#city").val());
                $("#shipping_address").val($("#address").val());
                $("#shipping_postcode").val($("#postcode").val());
            } else {
                $("#shipping_fname").val("");
                $("#shipping_lname").val("");
                $("#shipping_region").val("");
                $("#shipping_city").val("");
                $("#shipping_address").val("");
                $("#shipping_postcode").val("");
            }
        });
    });
    function fetch_address(element1,element2)
    {
        var postcode = $("#"+element1).val().trim();
        if(postcode != "") {
            $.ajax({
                url: "https://api.postcodes.io/postcodes/" + postcode,
                method: "GET",
                success: function (data) {
                    if(data.status === 200) {
                        $("#"+element2).val(data.result.admin_district+", "+data.result.region+", "+data.result.country);
                    }
                }
            });
        }
    }
</script>
<?= $this->endSection(); ?>