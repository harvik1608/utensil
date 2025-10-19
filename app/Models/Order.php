<?php

namespace App\Models;

use CodeIgniter\Model;

class Order extends Model
{
    protected $table      = ' bd_orders';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['order_no','transaction_id','customer_id','amount','shipping_cost','vat_charge','order_date','status','customer_note','created_by','updated_by','deleted_by','created_at','updated_at','deleted_at','cancelled_at','shipping_method','delivered_at','payment_status','jsondata','paymentOrderId'];
}