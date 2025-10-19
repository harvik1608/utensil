<?php

namespace App\Models;

use CodeIgniter\Model;

class Order_Delivery extends Model
{
    protected $table      = 'bd_order_deliveries';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['order_id','customer_id','fname','lname','country','region','city','postcode','address','shipping_fname','shipping_lname','shipping_country','shipping_region','shipping_city','shipping_postcode','shipping_address','shipping_phone'];
}