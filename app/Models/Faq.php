<?php

namespace App\Models;

use CodeIgniter\Model;

class Faq extends Model
{
    protected $table      = 'bd_faqs';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['query', 'answer', 'is_active', 'created_by', 'updated_by', 'deleted_by', 'created_at', 'updated_at', 'deleted_at'];
}