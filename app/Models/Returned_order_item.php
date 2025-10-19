<?php

namespace App\Models;

use CodeIgniter\Model;

class Returned_order_item extends Model
{
    protected $table      = 'bd_returned_order_items';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['returned_order_id', 'product_id', 'quantity', 'entered_quantity', 'approved_quantity', 'amount'];
}