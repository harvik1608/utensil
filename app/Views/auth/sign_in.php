<?= $this->extend('include/front_header'); ?>
<?= $this->section('main_content'); ?>
<div class="sticky-header-next-sec ec-breadcrumb section-space-mb">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row ec_breadcrumb_inner">
                    <div class="col-md-6 col-sm-12">
                        <h2 class="ec-breadcrumb-title">Sign In</h2>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <ul class="ec-breadcrumb-list">
                            <li class="ec-breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                            <li class="ec-breadcrumb-item active">Sign In</li>
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
            <div class="col-md-12 text-center">
                <div class="section-title">
                    <h2 class="ec-bg-title">Sign In</h2>
                    <h2 class="ec-title">Sign In</h2>
                    <p class="sub-title mb-3">Best place to buy and sell digital products</p>
                </div>
            </div>
            <div class="ec-login-wrapper">
                <div class="ec-login-container">
                    <div class="ec-login-form">
                        <form action="<?php echo base_url('submit-customer-signin'); ?>" method="POST" id="main-form">
                            <?php echo csrf_field(); ?>
                            <span class="ec-login-wrap">
                                <label>Email*</label>
                                <input type="text" name="email" id="email" placeholder="Your email" />
                            </span>
                            <span class="ec-login-wrap">
                                <label>Password*</label>
                                <input type="password" name="password" id="password" placeholder="Your password" />
                            </span>
                            <span class="ec-login-wrap ec-login-fp">
                                <label><a href="<?php echo base_url('forgot-password'); ?>">Forgot Password?</a></label>
                            </span>
                            <span class="ec-login-wrap ec-login-btn">
                                <button class="btn btn-primary" type="submit">Login</button>
                                <a href="<?php echo base_url('sign-up'); ?>" class="btn btn-secondary">Register</a>
                            </span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url('public/website/assets/js/jquery.validate.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('public/website/assets/js/additional_methods.js'); ?>"></script>
<script>
    $(document).ready(function(){
        $("#main-form").submit(function(e){
            e.preventDefault();

            $.ajax({
                url: $("#main-form").attr("action"),
                type: $("#main-form").attr("method"),
                data: new FormData(this),
                contentType: false,
                processData: false,
                cache: false,
                beforeSend:function(){
                    $("#main-form button[type=submit]").html('<div class="spinner-border spinner-border-sm text-primary" role="status"><span class="visually-hidden">Loading...</span></div>').attr("disabled",true);
                },
                success:function(response){
                    if(response.status == "success") {
                        window.location.href = response.redirect_url;
                    } else {
                        $("#"+response.input).focus();
                        $("input[name=csrf_token]").val(response.csrf);
                        show_error_toast(response.message);
                        $("#main-form button[type=submit]").html('SUBMIT').attr("disabled",false);
                    }
                },
                error: function(xhr, status, error) {  // Function to handle errors
                    const response = xhr.responseJSON;
                    if (response?.csrf) {
                        $("input[name=csrf_token]").val(response.csrf);
                    }
                    show_error_toast(error);
                    $("#main-form button[type=submit]").html('SUBMIT').attr("disabled",false);
                },
            });
        });
    });
</script>
<?= $this->endSection(); ?>