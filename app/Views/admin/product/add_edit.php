<?= $this->extend('include/header'); ?>
<?= $this->section('main_content'); ?>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs4.min.css" rel="stylesheet">
<?php 
	$photos = array();
	if(empty($product)) {
		$module_name = "New Product";
		$action = base_url("products");

		$product_id = 0;
		$name = "";
		$code = "";
		$category_id = "";
		$sub_category_id = "";
		$brand_id = "";
		$reference = "";
		$product_condition = "";
		$barcode = "";
		$min_order = 1;
		$sku = "";
		$price = "";
		$discount_price = "";
		$in_stock = "";
		$is_top_collection = "";
		$is_active = "";
		$description = "";
		$video = "";
		$stock = "0";
		$sold_stock = "0";
	} else {
		$module_name = "Edit Product";
		$action = base_url("products/".$product['id']);

		$product_id = $product["id"];
		$name = $product['name'];
		$code = $product['code'];
		$category_id = $product['category_id'];
		$sub_category_id = $product['sub_category_id'];
		$brand_id = $product['brand_id'];
		$reference = $product['reference'];
		$product_condition = $product['product_condition'];
		$barcode = $product['barcode'];
		$min_order = $product['min_order'];
		$sku = $product['sku'];
		$price = $product['price'];
		$discount_price = $product['discount_price'];
		$in_stock = $product['in_stock'];
		$is_top_collection = $product['is_top_collection'];
		$is_active = $product['is_active'];
		$description = $product['description'];
		if(!empty($product["photos"])) {
			$photos = json_decode($product["photos"],true);
		}
		$video = $product['video'];
		$stock = $product['stock'];
		$sold_stock = productStock($product['id']);
	}
?>
<div class="content-wrapper">
	<div class="container-xxl flex-grow-1 container-p-y">
		<div class="row">
			<div class="col-xl">
				<div class="card mb-12">
					<div class="card-header d-flex justify-content-between align-items-center">
						<h5 class="mb-0"><?php echo $module_name; ?></h5> <small class="text-body float-end">(<small class='astrock'>*</small>) indicates required field.</small>
					</div>
					<div class="card-body">
						<form id="main-form" action="<?php echo $action; ?>" method="post">
							<?php
								echo csrf_field();
								if($name != "") {
									echo '<input type="hidden" name="_method" value="PUT" />';
								} 
							?>
							<input type="hidden" name="old_video" value="<?php echo $video; ?>" />
							<div class="row">
								<div class="col-4 mb-4">
									<label class="form-label" for="basic-default-fullname">Product Name<small class='astrock'>*</small></label>
									<input type="text" class="form-control" id="name" name="name" placeholder="Enter product name" value="<?php echo $name; ?>" autofocus />
								</div>
								<div class="col-4 mb-4">
									<label class="form-label" for="basic-default-fullname">Product Code<small class='astrock'>*</small></label>
									<input type="text" class="form-control" id="code" name="code" placeholder="Enter product code" value="<?php echo $code; ?>" />
								</div>
								<div class="col-4 mb-4">
									<label class="form-label" for="basic-default-fullname">Product SKU</label>
									<input type="text" class="form-control" id="sku" name="sku" placeholder="Enter Product SKU" value="<?php echo $sku; ?>" />
								</div>
								<div class="col-4 mb-4">
									<label class="form-label" for="basic-default-fullname">Category<small class='astrock'>*</small></label>
									<select class="form-control select2" id="category_id" name="category_id">
										<option value="">Choose category</option>
										<?php
											if($categories) {
												foreach($categories as $key => $val) {
										?>
													<option value="<?php echo $val['id']; ?>" <?php echo $category_id == $val["id"] ? "selected" : ""; ?>><?php echo $val['name']; ?></option>
										<?php
												}
											} 
										?>
									</select>
									<label id="category_id-error" class="error" for="category_id"></label>
								</div>
								<div class="col-4 mb-4">
									<label class="form-label" for="basic-default-fullname">Sub Category<small class='astrock'>*</small></label>
									<select class="form-control select2" id="sub_category_id" name="sub_category_id">
										<option value="">Choose sub category</option>
									</select>
									<label id="sub_category_id-error" class="error" for="sub_category_id"></label>
								</div>
								<div class="col-2 mb-4">
									<label class="form-label" for="basic-default-fullname">Brand<small class='astrock'>*</small></label>
									<select class="form-control select2" id="brand_id" name="brand_id">
										<option value="">Choose brand</option>
										<?php
											if($brands) {
												foreach($brands as $key => $val) {
										?>
													<option value="<?php echo $val['id']; ?>" <?php echo $brand_id == $val["id"] ? "selected" : ""; ?>><?php echo $val['name']; ?></option>
										<?php
												}
											} 
										?>
									</select>
									<label id="brand_id-error" class="error" for="brand_id"></label>
								</div>
								<div class="col-2 mb-4">
									<label class="form-label" for="basic-default-fullname">Price<small class='astrock'>*</small></label>
									<input type="number" class="form-control" id="price" name="price" min="0" placeholder="Enter Product price" value="<?php echo $price; ?>" />
								</div>
								<div class="col-2 mb-4">
									<label class="form-label" for="basic-default-fullname">Discount Price</label>
									<input type="number" class="form-control" id="discount_price" name="discount_price" min="0" placeholder="Enter discount price" value="<?php echo $discount_price; ?>" />
								</div>
								
								<div class="col-2 mb-4">
									<label class="form-label" for="basic-default-fullname">Reference No.</label>
									<input type="text" class="form-control" id="reference" name="reference" placeholder="Enter reference no." value="<?php echo $reference; ?>" />
								</div>
								<div class="col-2 mb-4">
									<label class="form-label" for="basic-default-fullname">Condition</label>
									<input type="text" class="form-control" id="product_condition" name="product_condition" placeholder="Enter condition" value="<?php echo $product_condition; ?>" />
								</div>
								<div class="col-2 mb-4">
									<label class="form-label" for="basic-default-fullname">Barcode</label>
									<input type="text" class="form-control" id="barcode" name="barcode" placeholder="Enter barcode" value="<?php echo $barcode; ?>" />
								</div>
								<div class="col-2 mb-4">
									<label class="form-label" for="basic-default-fullname">Min. Order</label>
									<input type="number" class="form-control" id="min_order" name="min_order" placeholder="Enter min. order" min="1" value="<?php echo $min_order; ?>" />
								</div>
								<div class="col-2 mb-4">
									<label class="form-label" for="basic-default-fullname">Availability</label>
									<select class="form-control select2" id="in_stock" name="in_stock">
										<option value="1" <?php echo $in_stock == 1 ? "selected" : ""; ?>>In Stock</option>
										<option value="0" <?php echo $in_stock == 0 ? "selected" : ""; ?>>Out of Stock</option>
									</select>
								</div>
								<div class="col-2 mb-4">
									<label class="form-label" for="basic-default-fullname">Is this your top collection?</label>
									<select class="form-control select2" id="is_top_collection" name="is_top_collection">
										<option value="1" <?php echo $is_top_collection == 1 ? "selected" : ""; ?>>Yes</option>
										<option value="0" <?php echo $is_top_collection == 0 ? "selected" : ""; ?>>No</option>
									</select>
								</div>
								<div class="col-2 mb-4">
									<label class="form-label" for="basic-default-fullname">Min. Order</label>
									<input type="number" class="form-control" id="min_order" name="min_order" placeholder="Enter min. order" min="1" value="<?php echo $min_order; ?>" />
								</div>
								<div class="col-4 mb-4">
									<label class="form-label" for="basic-default-fullname">Status</label>
									<select class="form-control select2" id="is_active" name="is_active">
										<option value="1" <?php echo $is_active == 1 ? "selected" : ""; ?>>Active</option>
										<option value="0" <?php echo $is_active == 0 ? "selected" : ""; ?>>Inactive</option>
									</select>
								</div>
								<div class="col-2 mb-4">
									<label class="form-label" for="basic-default-fullname">Total Stock</label>
									<input type="number" class="form-control" id="stock" name="stock" placeholder="Enter stock" min="1" value="<?php echo $stock; ?>" />
								</div>
								<div class="col-2 mb-4">
									<label class="form-label" for="basic-default-fullname">Available Stock</label>
									<input type="number" class="form-control" id="stock" value="<?php echo $sold_stock; ?>" disabled />
								</div>
								<div class="col-12 mb-4">
									<label class="form-label" for="basic-default-fullname">Description</label>
									<textarea class="form-control summernote" id="description" name="description"><?php echo $description; ?></textarea>
								</div>
								<div class="col-12 mb-4">
									<label class="form-label" for="basic-default-fullname">Video <small>(Only one video you can upload.)</small></label>
									<input type="file" class="form-control" id="video" name="video" />
									<?php if($video != "") { ?><a href="<?php echo base_url('public/uploads/product/video/'.$video); ?>" target="_blank">Watch Video</a> <?php } ?>
								</div>
								<div class="col-12 mb-4">
									<label class="form-label" for="basic-default-fullname">Photos <small>(You can select multiple photos. size: 800x700)</small></label>
									<input type="file" class="form-control" id="photos" name="photos[]" multiple />
								</div>
								<?php
									if(!empty($photos)) {
										foreach($photos as $photo) {
											if($photo["avatar"] != "" && file_exists("public/uploads/product/".$photo["avatar"])) {
								?>
												<div class="col-4 mb-4">
													<center>
														<img src="<?php echo base_url('public/uploads/product/'.$photo["avatar"]); ?>" class="img img-responsive img-thumbnail preview" style="text-align: center;" /><br>
														<?php
															if($photo["is_default"] == 0) {
																echo '<a href="'.base_url("set-product-photo/".$photo["no"]."/".$product_id).'"><small>Set Default Photo</small></a><br>';
																echo '<a href="'.base_url("remove-product-photo/".$photo["no"]."/".$product_id).'" onclick=return confirm("Are you sure to remove this photo?")><i class="icon-base bx bx-trash icon-sm"></i></a>';
															} 
														?>
													</center>
												</div>
								<?php
											}
										}
										echo '<br><br><br>';
									} 
								?>
							</div>
							<button type="submit" class="btn btn-primary btn-sm">SUBMIT</button>
							<a class="btn btn-danger btn-sm text-white" id="back-btn" href="<?php echo base_url('products'); ?>">Back</a>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs4.min.js"></script>
<script type="text/javascript">
	var page_title = "Products";
	var is_edit_page = "<?php echo $name == '' ? 0 : 1; ?>";
	var category_id = "<?php echo $category_id; ?>";
	var sub_category_id = "<?php echo $sub_category_id; ?>";
	$(document).ready(function(){
		if(is_edit_page == 1) {
			fetch_sub_categories(category_id,sub_category_id);
		}
		$("#main-form").validate({
			rules:{
				name:{
					required: true
				},
				code:{
					required: true
				},
				category_id:{
					required: true
				},
				sub_category_id:{
					required: true
				},
				brand_id:{
					required: true
				},
				price:{
					required: true
				}
			},
			messages:{
				name:{
					required: "<b>Product name is required.</b>"
				},
				code:{
					required: "<b>Product code is required.</b>"
				},
				category_id:{
					required: "<b>Categroy is required.</b>"
				},
				sub_category_id:{
					required: "<b>Sub Categroy is required.</b>"
				},
				brand_id:{
					required: "<b>Brand is required.</b>"
				},
				price:{
					required: "<b>Product price is required.</b>"
				}

			}
		});
		// if(parseInt(is_edit_page) === 1) {
		// 	$("#main-form").validate().settings.rules.avatar.required = false;
		// 	$("#main-form").validate().settings.messages.avatar = {};
		// }

		$("#main-form").submit(function(e){
			e.preventDefault();

			if($("#main-form").valid()) {
				$.ajax({
					url: $("#main-form").attr("action"),
					type: "post",
					data: new FormData(this),
					contentType: false,
					processData: false,
					cache: false,
					beforeSend:function(){
						$("#main-form button[type=submit]").html('<div class="spinner-border spinner-border-sm text-primary" role="status"><span class="visually-hidden">Loading...</span></div>').attr("disabled",true);
					},
					success:function(response){
						if(response.status == "success") {
							// window.location.href = $("#back-btn").attr("href");
							window.location.reload();
						} else {
							$("input[name=csrf_token]").val(response.csrf);
							show_toast(response.message);
							$("#main-form button[type=submit]").html('SUBMIT').attr("disabled",false);
						}
					},
					error: function(xhr, status, error) {  // Function to handle errors
						const response = xhr.responseJSON;
					    if (response?.csrf) {
					        $("input[name=csrf_token]").val(response.csrf);
					    }
					    show_toast(error);
					    $("#main-form button[type=submit]").html('SUBMIT').attr("disabled",false);
					},
				});
			}
		});

		$("#category_id").change(function(){
			fetch_sub_categories($(this).val());
		});
	});
	function fetch_sub_categories(category_id,sub_category_id = 0)
	{
		$.ajax({
			url: "<?php echo base_url('fetch-sub-categories'); ?>",
			type: "GET",
			data:{
				category_id: category_id
			},
			dataType: "json",
			success:function(response){
				var html = '';
				html += '<option value="">Choose sub category</option>';
				if(response.count > 0) {
					for(var i = 0; i < response.data.length; i ++) {
						if(sub_category_id == response.data[i].id) {
							html += '<option value="'+response.data[i].id+'" selected>'+response.data[i].name+'</option>';
						} else {
							html += '<option value="'+response.data[i].id+'">'+response.data[i].name+'</option>';
						}
					}
				}
				$("#sub_category_id").html(html);
				$("#sub_category_id").trigger("change");
			}
		});
	}
</script>
<?= $this->endSection(); ?>