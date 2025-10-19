<?php

namespace App\Models;

use CodeIgniter\Model;

class Cart extends Model
{
    protected $table      = 'bd_carts';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['order_id', 'product_id', 'product_amt', 'product_discount_amt', 'quantity', 'customer_id', 'created_by', 'updated_by', 'deleted_by', 'created_at', 'updated_at', 'deleted_at'];
}