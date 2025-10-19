<?= $this->extend('include/front_header'); ?>
<?= $this->section('main_content'); ?>
<style>
    .ec_contact_info {
        max-width: none !important;
    }
    li.ec-contact-item + .ec-contact-item {
        margin-bottom: 9px;
    }
</style>
<div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row ec_breadcrumb_inner">
                    <div class="col-md-6 col-sm-12">
                        <h2 class="ec-breadcrumb-title">Contact Us</h2>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <!-- ec-breadcrumb-list start -->
                        <ul class="ec-breadcrumb-list">
                            <li class="ec-breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                            <li class="ec-breadcrumb-item active">Contact Us</li>
                        </ul>
                        <!-- ec-breadcrumb-list end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Ec Contact Us page -->
<section class="ec-page-content section-space-p">
    <div class="container">
        <div class="row">
            <div class="ec-common-wrapper">
                <div class="ec-contact-leftside">
                    <div class="ec-contact-container">
                        <div class="ec-contact-form">
                            <form action="<?php echo base_url('submit-inquiry'); ?>" method="POST" id="inquiry-form">
                                <?php echo csrf_field(); ?>
                                <input type="text" name="website" style="display:none;">
                                <span class="ec-contact-wrap">
                                    <label>First Name*</label>
                                    <input type="text" name="fname" id="fname" placeholder="Enter your first name" />
                                </span>
                                <span class="ec-contact-wrap">
                                    <label>Last Name*</label>
                                    <input type="text" name="lname" id="lname" placeholder="Enter your last name" />
                                </span>
                                <span class="ec-contact-wrap">
                                    <label>Email*</label>
                                    <input type="email" name="email" id="email" placeholder="Enter your email address" />
                                </span>
                                <span class="ec-contact-wrap">
                                    <label>Phone Number*</label>
                                    <input type="number" name="phone" id="phone" placeholder="Enter your phone number" />
                                </span>
                                <span class="ec-contact-wrap">
                                    <label>Comments/Questions*</label>
                                    <textarea name="comment" id="comment" placeholder="Please leave your comments here.."></textarea>
                                </span>
                                <span class="ec-contact-wrap">
                                    <div class="g-recaptcha" data-sitekey="6Ld5Je0rAAAAAF7roYnqGZuAR-AFqFHp-aX3ihkj"></div><br>
                                </span>
                                <span class="ec-contact-wrap ec-contact-btn">
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </span>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="ec-contact-rightside">
                    <div class="ec_contact_map">
                        <div class="ec_map_canvas">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2469.4378440589685!2d-0.44153342336469015!3d51.76160237187228!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4876412e3e9f7b51%3A0xd0abc8edf5d9ec36!2sBlue%20Box%20Storage!5e0!3m2!1sen!2sin!4v1760596296475!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                    <div class="ec_contact_info">
                        <h1 class="ec_contact_info_head">Contact us</h1>
                        <ul class="align-items-center">
                            <li class="ec-contact-item"><i class="ecicon eci-map-marker" aria-hidden="true"></i><span>Address :</span><?php echo APP_ADDRESS; ?></li>
                            <li class="ec-contact-item align-items-center">
                                <i class="ecicon eci-phone" aria-hidden="true"></i>
                                <span>Call Us :</span>
                                <a href="tel:+440123456789"><?php echo APP_PHONE; ?></a>
                            </li>
                            <li class="ec-contact-item align-items-center">
                                <i class="ecicon eci-envelope" aria-hidden="true"></i>
                                <span>Email :</span><a href="mailto:<?php echo APP_EMAIL; ?>"><?php echo APP_EMAIL; ?></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>
    $(document).ready(function(){
        $("#inquiry-form").submit(function(e){
            e.preventDefault();

            $.ajax({
                url: $("#inquiry-form").attr("action"),
                type: $("#inquiry-form").attr("method"),
                data: new FormData(this),
                contentType: false,
                processData: false,
                cache: false,
                beforeSend:function(){
                    $("#inquiry-form button[type=submit]").html('<div class="spinner-border spinner-border-sm text-primary" role="status"><span class="visually-hidden">Loading...</span></div>').attr("disabled",true);
                },
                success:function(response){
                    $("input[name=csrf_token]").val(response.csrf);
                    grecaptcha.reset();
                    if(response.status == "success") {
                        show_toast(response.message);
                        $("#fname,#lname,#email,#phone,#comment").val("");
                    } else {
                        show_error_toast(response.message);
                        $("#"+response.input).focus();
                    }
                    $("#inquiry-form button[type=submit]").html('SUBMIT').attr("disabled",false);
                },
                error: function(xhr, status, error) {  // Function to handle errors
                    const response = xhr.responseJSON;
                    if (response?.csrf) {
                        $("input[name=csrf_token]").val(response.csrf);
                    }
                    show_error_toast(error);
                    $("#inquiry-form button[type=submit]").html('SUBMIT').attr("disabled",false);
                },
            });
        });
    });
</script>
<?= $this->endSection(); ?>