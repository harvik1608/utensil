<?= $this->extend('include/front_header'); ?>
<?= $this->section('main_content'); ?>
<div class="sticky-header-next-sec ec-breadcrumb section-space-mb">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row ec_breadcrumb_inner">
                    <div class="col-md-6 col-sm-12">
                        <h2 class="ec-breadcrumb-title">Reset Password</h2>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <ul class="ec-breadcrumb-list">
                            <li class="ec-breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                            <li class="ec-breadcrumb-item active">Reset Password</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="ec-page-content section-space-p">
    <?php
        $session = session();
        if($session->getFlashData('message')) {
            echo '<span id="msg" hidden>'.$session->getFlashData('message').'</span>';
        }
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="section-title">
                    <h2 class="ec-bg-title">Reset Password</h2>
                    <h2 class="ec-title">Reset Password</h2>
                    <p class="sub-title mb-3">Best place to buy and sell digital products</p>
                </div>
            </div>
            <div class="ec-login-wrapper">
                <div class="ec-login-container">
                    <div class="ec-login-form">
                        <form action="<?php echo base_url('submit-reset-password?code='.$code); ?>" method="POST" id="main-form">
                            <?php echo csrf_field(); ?>
                            <span class="ec-login-wrap">
                                <label>Password*</label>
                                <input type="password" name="password" id="password" placeholder="Your password" />
                            </span>
                            <span class="ec-login-wrap">
                                <label>Confirm Password*</label>
                                <input type="password" name="confirm_password" id="confirm_password" placeholder="Your confirm password" />
                            </span>
                            <span class="ec-login-wrap ec-login-btn">
                                <button class="btn btn-primary" type="submit">Submit</button>
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
        if($("#msg").length) {
            show_toast($("#msg").text());
        }
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