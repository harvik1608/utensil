<?php

namespace App\Models;

use CodeIgniter\Model;

class Brand extends Model
{
    protected $table      = 'bd_brands';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['slug','name','orderBy','is_active', 'created_by', 'updated_by', 'deleted_by', 'created_at', 'updated_at', 'deleted_at'];
}