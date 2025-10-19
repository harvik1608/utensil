<?= $this->extend('include/front_header'); ?>
<?= $this->section('main_content'); ?>
<div class="sticky-header-next-sec ec-breadcrumb section-space-mb">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row ec_breadcrumb_inner">
                    <div class="col-md-6 col-sm-12">
                        <h2 class="ec-breadcrumb-title">My Cart</h2>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <ul class="ec-breadcrumb-list">
                            <li class="ec-breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                            <li class="ec-breadcrumb-item active">My Cart</li>
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
            <div class="ec-shop-leftside col-lg-12 col-md-12">
                <div class="ec-cart-content">
                    <div class="ec-cart-inner">
                        <div class="row">
                            <?php
                                if($count > 0) { 
                            ?>
                                    <form action="#">
                                        <div class="table-content cart-table-content">
                                            <table id="my-cart-tbl" class="table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th class="ec-cart-pro-qty">Product</th>
                                                        <th class="ec-cart-pro-qty">Price</th>
                                                        <th class="ec-cart-pro-qty">Min. Quantity</th>
                                                        <th class="ec-cart-pro-qty">Quantity</th>
                                                        <th class="ec-cart-pro-subtotal">Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="ec-cart-update-bottom">
                                                    <a href="<?php echo base_url('all-products'); ?>">Continue Shopping</a>
                                                    <button class="btn btn-primary" type="button" onclick="window.location.href='<?php echo base_url('checkout'); ?>'">Check Out</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                            <?php 
                                } else {
                            ?>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <center><img src="<?php echo base_url('public/assets/img/empty_cart.png'); ?>" class="img img-thumbnail img-responsive empty-cart" /><br><button class="btn btn-primary" type="button" onclick="window.location.href='<?php echo base_url('all-products'); ?>'">Continue Shopping</button></center>
                                        </div>
                                    </div>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function(){
        my_cart();
    });
    function my_cart(flag = 0)
    {
        $.ajax({
            url: "<?php echo base_url('my-cart-items'); ?>",
            type: "GET",
            success:function(response) {
                $("#my-cart-tbl tbody").html(response.html);
                if(flag == 1 && $("#my-cart-tbl tbody tr[id*=cart-]").length == 0) {
                    window.location.reload();
                }
            }
        });
    }
</script>
<?= $this->endSection(); ?>