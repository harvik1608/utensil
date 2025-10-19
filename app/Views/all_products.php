<?= $this->extend('include/front_header'); ?>
<?= $this->section('main_content'); ?>
<!-- Ec breadcrumb start -->
<div class="sticky-header-next-sec ec-breadcrumb section-space-mb">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row ec_breadcrumb_inner">
                    <div class="col-md-6 col-sm-12">
                        <h2 class="ec-breadcrumb-title">Products</h2>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <ul class="ec-breadcrumb-list">
                            <li class="ec-breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="ec-breadcrumb-item active">Products</li>
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
            <div class="ec-shop-rightside col-lg-12 col-md-12">
                <div class="ec-pro-list-top d-flex">
                    <div class="col-md-6 ec-grid-list">
                        <div class="ec-gl-btn">
                            <button class="btn sidebar-toggle-icon"><i class="fi-rr-filter"></i></button>
                            <!-- <button class="btn btn-grid-50 active"><i class="fi-rr-apps"></i></button>
                            <button class="btn btn-list-50"><i class="fi-rr-list"></i></button> -->
                        </div>
                    </div>
                    <div class="col-md-6 ec-sort-select">
                        <span class="sort-by">Sort by</span>
                        <div class="ec-select-inner">
                            <select name="ec-select" id="ec-select">
                                <option selected disabled>Position</option>
                                <option value="1">Name, A to Z</option>
                                <option value="2">Name, Z to A</option>
                                <option value="3">Price, low to high</option>
                                <option value="4">Price, high to low</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="shop-pro-content">
                	<div class="shop-pro-inner">
                		<div class="row" id="allProductListing">
                			
                		</div><br><br>
                        <center><button id="loadMoreBtn" type="button" class="btn btn-sm btn-primary">Load More</button></center>
               		</div>
               	</div>
          	</div>
          	<div class="filter-sidebar-overlay"></div>
            <div class="ec-shop-leftside filter-sidebar">
                <div class="ec-sidebar-heading">
                    <h1>Filter Products By</h1>
                    <a class="filter-cls-btn" href="javascript:void(0)">×</a>
                </div>
                <div class="ec-sidebar-wrap">
                    <div class="ec-sidebar-block">
                        <div class="ec-sb-title">
                            <h3 class="ec-sidebar-title">Category</h3>
                        </div>
                        <div class="ec-sb-block-content">
                            <ul id="product-category">
                                <?php
                                    if($categories) {
                                        foreach($categories as $key => $val) {
                                ?>
                                            <li>
                                                <div class="ec-sidebar-block-item">
                                                    <input type="checkbox" value="<?php echo $val['id']; ?>" <?php echo isset($category['id']) && $category['id'] == $val['id'] ? "checked" : ""; ?> /> <a href="#"><?php echo $val['name']; ?></a><span
                                                        class="checked"></span>
                                                </div>
                                            </li>
                                <?php
                                        }
                                    } 
                                ?>
                            </ul>
                        </div>
                    </div>
                    <div class="ec-sidebar-block">
                        <div class="ec-sb-title">
                            <h3 class="ec-sidebar-title">Brand</h3>
                        </div>
                        <div class="ec-sb-block-content">
                            <ul id="product-brand">
                                <?php
                                    if($brands) {
                                        foreach($brands as $key => $val) {
                                ?>
                                            <li>
                                                <div class="ec-sidebar-block-item">
                                                    <input type="checkbox" value="<?php echo $val['id']; ?>" <?php echo isset($brand['id']) && $brand['id'] == $val['id'] ? "checked" : ""; ?> /> <a href="#"><?php echo $val['name']; ?></a><span
                                                        class="checked"></span>
                                                </div>
                                            </li>
                                <?php
                                        }
                                    } 
                                ?>
                            </ul>
                        </div>
                    </div>
                    <div class="ec-sidebar-block">
                        <div class="ec-sb-title">
                            <h3 class="ec-sidebar-title">Price</h3>
                        </div>
                        <div class="ec-sb-block-content es-price-slider">
                            <div class="ec-price-filter">
                                <div id="ec-sliderPrice" class="filter__slider-price" data-min="<?php echo $min_price; ?>" data-max="<?php echo $max_price; ?>" data-step="10"></div>
                                <div class="ec-price-input">
                                    <label class="filter__label"><input type="text" class="filter__input" id="min"></label>
                                    <span class="ec-price-divider"></span>
                                    <label class="filter__label"><input type="text" class="filter__input" id="max"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       	</div>
   	</div>
</section>
<script>
	var load_url = "<?php echo base_url('load-all-products'); ?>";
    var search_text = "<?php echo isset($search_text) ? $search_text : ''; ?>";
</script>
<script src="<?php echo base_url('public/website/assets/js/custom.js'); ?>"></script>
<script>
    var currentPage = 0;
    var perPage = <?php echo $perPage; ?>;
    $(document).ready(function(){
        load_products();
        $("#product-category input").change(function(){
            load_products();
        });
        $("#product-brand input,#ec-select").change(function(){
            load_products();
        });
        $(".ec-price-input .filter__input").on("keyup", function() {
            load_products();
        });
        $(document).on("slide","#ec-sliderPrice",function(){
            alert("helllo");
        });
        $(document).on("click","#loadMoreBtn",function(){
            currentPage++;
            load_products(true);
        });
    });
    function load_products(loadMore = false)
    {
        if(!loadMore) {
            currentPage = 0;
        }

        var categories = new Array;
        $("#product-category input").each(function(){
            if($(this).prop("checked") == true) {
                categories.push($(this).val());
            }
        });
        var brands = new Array;
        $("#product-brand input").each(function(){
            if($(this).prop("checked") == true) {
                brands.push($(this).val());
            }
        });
        $.ajax({
            url: load_url,
            type: "GET",
            data:{
                page: currentPage,
                categories: categories,
                brands: brands,
                minPrice: $("#min").val(),
                maxPrice: $("#max").val(),
                sortBy: $("#ec-select").val(),
                search_text: search_text
            },
            beforeSend:function(){

            },
            success:function(response) {
                show_toast("Total "+response.total_count+" products found.");
                if(loadMore) {
                    $("#allProductListing").append(response.html);
                } else {
                    $("#allProductListing").html(response.html);
                }
                var totalLoaded = currentPage*perPage;
                // alert(totalLoaded+" | "+response.total_count);
                if(parseInt(totalLoaded) >= parseInt(response.total_count)) {
                    $("#loadMoreBtn").hide();
                } else {
                    $("#loadMoreBtn").show();
                }
            }
        });
    }
</script>
<?= $this->endSection(); ?>