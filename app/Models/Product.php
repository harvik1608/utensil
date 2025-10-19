<?php

namespace App\Models;

use CodeIgniter\Model;

class Product extends Model
{
    protected $table      = 'bd_products';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['slug','name','code','reference','product_condition','barcode','category_id','sub_category_id','brand_id','price','discount_price','sku','description','in_stock','min_order','stock','avatar','video','photos','is_top_collection','is_active','created_by','updated_by','deleted_by','created_at','updated_at','deleted_at'];
}