<?php

namespace App\Models;

use CodeIgniter\Model;

class Visitor extends Model
{
    protected $table      = 'bd_visitors';
    protected $primaryKey = 'id';
    protected $allowedFields = ['product_id', 'ip', 'created_at'];
}
