<?php

namespace App\Models;

use CodeIgniter\Model;

class Banner extends Model
{
    protected $table      = 'bd_banners';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['avatar'];
}