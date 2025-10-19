<?php

namespace App\Models;

use CodeIgniter\Model;

class Bd_email extends Model
{
    protected $table      = 'bd_emails';
    protected $primaryKey = 'id';
    protected $allowedFields = ['email','message','is_sent','created_at'];
}
