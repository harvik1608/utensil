<?php

namespace App\Models;

use CodeIgniter\Model;

class Favourite extends Model
{
    protected $table      = 'bd_product_favourites';
    protected $primaryKey = 'id';
    protected $allowedFields = ['product_id', 'customer_id', 'created_at'];
}
