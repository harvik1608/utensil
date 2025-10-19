<?php

namespace App\Models;

use CodeIgniter\Model;

class Payment_request extends Model
{
    protected $table      = 'bd_payment_requests';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['pg_id','order_id','customer_id','amount','request_type','jsondata','note', 'status', 'created_at', 'updated_at'];
}