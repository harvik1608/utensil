<?php

namespace App\Models;

use CodeIgniter\Model;

class Returned_order extends Model
{
    protected $table      = 'bd_returned_orders';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['order_id', 'customer_id', 'amount', 'approved_amount', 'note', 'images', 'status', 'comment', 'payment_status', 'created_at', 'updated_at'];
}