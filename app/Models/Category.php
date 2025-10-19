<?php

namespace App\Models;

use CodeIgniter\Model;

class Category extends Model
{
    protected $table      = 'bd_product_categories';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['category_id','slug', 'name', 'avatar', 'orderBy', 'is_active', 'created_by', 'updated_by', 'deleted_by', 'created_at', 'updated_at', 'deleted_at'];
}