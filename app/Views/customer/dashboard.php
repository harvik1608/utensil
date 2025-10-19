<?= $this->extend('include/front_header'); ?>
<?= $this->section('main_content'); ?>
<div class="sticky-header-next-sec ec-breadcrumb section-space-mb">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row ec_breadcrumb_inner">
                    <div class="col-md-6 col-sm-12">
                        <h2 class="ec-breadcrumb-title">My Profile</h2>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <ul class="ec-breadcrumb-list">
                            <li class="ec-breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                            <li class="ec-breadcrumb-item active">My Profile</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="ec-page-content ec-vendor-uploads ec-user-account section-space-p">
    <?php
        $session = session();
        if($session->getFlashData('message')) {
            echo '<span id="msg" hidden>'.$session->getFlashData('message').'</span>';
        }
    ?>
    <div class="container">
        <div class="row">
            <?= $this->include('include/sidebar'); ?>
            <div class="ec-shop-rightside col-lg-9 col-md-12">
                <div class="ec-vendor-dashboard-card ec-vendor-setting-card">
                    <div class="ec-vendor-card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="ec-vendor-block-profile">
                                    <div class="ec-vendor-block-img space-bottom-30">
                                        <div class="ec-vendor-block-bg">
                                            <a href="javascript:;" class="btn btn-lg btn-primary" onclick="edit_profile()">Edit</a>
                                        </div>
                                        <div class="ec-vendor-block-detail">
                                            <img class="v-img" src="<?php echo base_url('public/website/assets/images/user/1.jpg'); ?>" alt="vendor image">
                                            <h5 class="name"><?php echo $customer['fname'].' '.$customer['lname']; ?></h5>
                                            <p></p>
                                        </div>
                                        <p>Hello <span><?php echo $customer['fname'].' '.$customer['lname']; ?>!</span></p>
                                        <p>From your account you can easily view and track orders. You can manage and change your account information like address, contact information and history of orders.</p>
                                    </div>
                                    <h5>Change Password</h5>
                                    <div class="row">
                                        <form class="row g-3" method="post" action="<?php echo base_url('change-password'); ?>" id="change-password-form">
                                            <?php echo csrf_field(); ?>
                                            <div class="col-md-12 col-sm-12">
                                                <label class="form-label">Old Password*</label>
                                                <input type="password" class="form-control" name="old_password" id="old_password" placeholder="Your old password" />
                                            </div>
                                            <div class="col-md-12 col-sm-12 mt-4">
                                                <label class="form-label">New Password*</label>
                                                <input type="password" class="form-control" name="new_password" id="new_password" placeholder="Your new password" />
                                            </div>
                                            <div class="col-md-12 col-sm-12 mt-4">
                                                <label class="form-label">Confirm New Password*</label>
                                                <input type="password" class="form-control" name="confirm_new_password" id="confirm_new_password" placeholder="Your confirm new password" />
                                            </div>
                                            <div class="col-md-12 mt-3">
                                                <button type="submit" class="btn btn-primary">Change</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="customer_edit_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="ec-vendor-block-img space-bottom-30">
                        <div class="ec-vendor-upload-detail">
                            <form class="row g-3" method="post" action="<?php echo base_url('update-myprofile'); ?>" id="main-form">
                                <?php echo csrf_field(); ?>
                                <div class="col-md-6 space-t-15 mt-3">
                                    <label class="form-label">First Name*</label>
                                    <input type="text" class="form-control" name="fname" id="fname" placeholder="Your first name" value="<?php echo $customer['fname']; ?>" />
                                </div>
                                <div class="col-md-6 space-t-15 mt-3">
                                    <label class="form-label">Last Name*</label>
                                    <input type="text" class="form-control" name="lname" id="lname" placeholder="Your last name" value="<?php echo $customer['lname']; ?>" />
                                </div>
                                <div class="col-md-6 space-t-15 mt-3">
                                    <label class="form-label">Email*</label>
                                    <input type="text" class="form-control" name="email" id="email" placeholder="Your email" value="<?php echo $customer['email']; ?>" />
                                </div>
                                <div class="col-md-6 space-t-15 mt-3">
                                    <label class="form-label">Phone No.*</label>
                                    <input type="text" class="form-control" name="phone" id="phone" placeholder="Your phone no." value="<?php echo $customer['phone']; ?>" />
                                </div>
                                <div class="col-md-6 space-t-15 mt-3">
                                    <label class="form-label">Country</label>
                                    <input type="text" class="form-control" name="country" id="country" placeholder="Your country" value="UK" disabled />
                                </div>
                                <div class="col-md-6 space-t-15 mt-3">
                                    <label class="form-label">Region/State*</label>
                                    <input type="text" class="form-control" name="region" id="region" placeholder="Your region/state" value="<?php echo $customer['region']; ?>" />
                                </div>
                                <div class="col-md-6 space-t-15 mt-3">
                                    <label class="form-label">City*</label>
                                    <input type="text" class="form-control" name="city" id="city" placeholder="Your city" value="<?php echo $customer['city']; ?>" />
                                </div>
                                <div class="col-md-6 space-t-15 mt-3">
                                    <label class="form-label">Postal Code*</label>
                                    <input type="text" class="form-control" name="postalcode" id="postalcode" placeholder="Your postal code" value="<?php echo $customer['postalcode']; ?>" />
                                </div>
                                <div class="col-md-12 space-t-15 mt-3">
                                    <label class="form-label">Address*</label>
                                    <input type="text" class="form-control" name="address" id="address" placeholder="Your address" value="<?php echo $customer['address']; ?>" />
                                </div>
                                <div class="col-md-12 space-t-15 mt-3">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="#" class="btn btn-lg btn-secondary qty_close" data-bs-dismiss="modal" aria-label="Close">Close</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $("#change-password-form").submit(function(e){
            e.preventDefault();

            $.ajax({
                url: $("#change-password-form").attr("action"),
                type: $("#change-password-form").attr("method"),
                data: new FormData(this),
                contentType: false,
                processData: false,
                cache: false,
                beforeSend:function(){
                    $("#change-password-form button[type=submit]").html('<div class="spinner-border spinner-border-sm text-primary" role="status"><span class="visually-hidden">Loading...</span></div>').attr("disabled",true);
                },
                success:function(response){
                    if(response.status == "success") {
                        window.location.href = response.redirect_url;
                    } else {
                        $("#"+response.input).focus();
                        $("#change-password-form input[name=csrf_token]").val(response.csrf);
                        show_error_toast(response.message);
                        $("#change-password-form button[type=submit]").html('Change').attr("disabled",false);
                    }
                },
                error: function(xhr, status, error) {  // Function to handle errors
                    const response = xhr.responseJSON;
                    if (response?.csrf) {
                        $("#change-password-form input[name=csrf_token]").val(response.csrf);
                    }
                    show_error_toast(error);
                    $("#change-password-form button[type=submit]").html('Change').attr("disabled",false);
                },
            });
        });

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
                        $("#main-form input[name=csrf_token]").val(response.csrf);
                        show_error_toast(response.message);
                        $("#main-form button[type=submit]").html('SUBMIT').attr("disabled",false);
                    }
                },
                error: function(xhr, status, error) {  // Function to handle errors
                    const response = xhr.responseJSON;
                    if (response?.csrf) {
                        $("#main-form input[name=csrf_token]").val(response.csrf);
                    }
                    show_error_toast(error);
                    $("#main-form button[type=submit]").html('SUBMIT').attr("disabled",false);
                },
            });
        });     
    });
    function edit_profile()
    {
        $("#customer_edit_modal").modal("show");
    }
</script>
<?= $this->endSection(); ?>