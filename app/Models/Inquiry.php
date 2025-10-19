<?php

namespace App\Models;

use CodeIgniter\Model;

class Inquiry extends Model
{
    protected $table      = 'bd_inquiries';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['name','email','phone','comment','created_at','ip_address'];
}