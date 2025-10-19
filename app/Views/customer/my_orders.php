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
                        <h2 class="ec-breadcrumb-title">My Orders</h2>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <ul class="ec-breadcrumb-list">
                            <li class="ec-breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                            <li class="ec-breadcrumb-item active">My Orders</li>
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
                        <h5>My Orders</h5>
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
                                        <th scope="col">Order Date</th>
                                        <th scope="col">Order Amount</th>
                                        <th scope="col">Total Items</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        if($orders) {
                                            foreach($orders as $order) {
                                                $order_price = $order["amount"] + $order["shipping_cost"] + $order['vat_charge'];
                                    ?>
                                                <tr id="order-<?php echo $order['order_no']; ?>">
                                                    <td scope="row"><span>#<?php echo $order['order_no']; ?></span></td>
                                                    <td><span><?php echo format_date($order['order_date']); ?></span></td>
                                                    <td><span><?php echo currency().number_format($order_price,2); ?></span></td>
                                                    <td><span><a href="javascript:;" onclick="view_order('<?php echo $order['order_no']; ?>');"><?php echo $order['total_items']; ?></span></a></td>
                                                    <td><span><b><?php echo strtoupper(order_status($order['status'],1)); ?></b></span></td>
                                                    <td>
                                                        <span class="tbl-btn"><a href="<?php echo base_url('view-order/'.$order['order_no']); ?>">View</a>
                                                        <?php
                                                            if($order['status'] == 0) {
                                                                echo '| <a href="javascript:;" onclick=cancel_order("'.$order['order_no'].'")>Cancel Order</a>';
                                                            } else if($order['status'] == 7) {
                                                                echo '| <a href="javascript:;" onclick=return_order("'.$order['order_no'].'")>Return Order</a>';
                                                            }
                                                        ?>
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
    var filesArray = [];
    $(document).ready(function(){
        $(document).on("submit","#return-order-form",function(e){
            e.preventDefault();

            let formData = new FormData(this);
            filesArray.forEach(function(file){
                if(file) {
                    formData.append("images[]", file);
                } 
            });

            $.ajax({
                url: "<?php echo base_url('submit-return-order'); ?>", // backend
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                beforeSend:function(){
                    $("#return-order-form button[type=submit]").html('<div class="spinner-border spinner-border-sm text-primary" role="status"><span class="visually-hidden">Loading...</span></div>').attr("disabled",true);
                },
                success: function(response){
                    $("#return-order-form input[name=csrf_token]").val(response.csrf);
                    if(response.status == "success") {
                        window.location.href = response.href;
                    } else {
                        show_toast(response.message);
                        $("#return-order-form button[type=submit]").html('Submit').attr("disabled",false);
                    }
                },
                error: function(xhr, status, error) {  // Function to handle errors
                    const response = xhr.responseJSON;
                    if (response?.csrf) {
                        $("#return-order-form input[name=csrf_token]").val(response.csrf);
                    }
                    show_toast(error);
                    $("#return-order-form button[type=submit]").html('Submit').attr("disabled",false);
                },
            });
        });
    });
    function return_order(order_no)
    {
        $.ajax({
            url: "<?php echo base_url('return-order'); ?>",
            type: "POST",
            data:{
                order_no: order_no,
                [csrfName]: csrfHash
            },
            success:function(response) {
                csrfHash = response.csrf;
                if(response.status == "success") {
                    $("#view_order_modal #view-order-div").html(response.html);
                    $("#view_order_modal").modal("show");
                    drag_drop();
                } else {
                    show_toast(response.message);
                }
            }
        });
    }
    function drag_drop()
    {
        let dropzone = $("#dropzone");
        
        dropzone.on("click", function() {
            $("#fileInput").click();
        });

        $("#fileInput").on("change", function(e) {
            // handleFiles(e.target.files);
            addFiles(e.target.files);
        });

        dropzone.on("dragover", function(e) {
            e.preventDefault();
            dropzone.addClass("dragover");
        });

        dropzone.on("dragleave", function() {
            dropzone.removeClass("dragover");
        });

        dropzone.on("drop", function(e) {
            e.preventDefault();
            dropzone.removeClass("dragover");
            // handleFiles(e.originalEvent.dataTransfer.files);
            addFiles(e.originalEvent.dataTransfer.files);
        });
    }
    function addFiles(files) 
    {
        $.each(files, function(i, file) {
            if (!file.type.startsWith("image/")) 
                return;

            filesArray.push(file);

            let reader = new FileReader();
            reader.onload = function(e) {
                let index = filesArray.length - 1;
                let box = $(`<div class="img-box" data-index="${index}"><center><img src="${e.target.result}"><br><button type="button" class="delete-btn">&times;</button></center></div>`);
                $("#preview").append(box);

                box.find(".delete-btn").on("click", function(){
                    let idx = box.data("index");
                    filesArray[idx] = null; // mark as deleted
                    box.remove();
                });
            }
            reader.readAsDataURL(file);
        });
    }
</script>
<?= $this->endSection(); ?>