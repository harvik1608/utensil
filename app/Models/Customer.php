<?php

namespace App\Models;

use CodeIgniter\Model;

class Customer extends Model
{
    protected $table      = 'bd_customers';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['fname','lname','email','phone','country','region','city','address','postalcode','is_phone_verified','password', 'avatar', 'is_verified', 'is_active', 'code','ip_address','created_by', 'updated_by', 'deleted_by', 'created_at', 'updated_at', 'deleted_at',''];
}