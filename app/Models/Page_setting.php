<?php

namespace App\Models;

use CodeIgniter\Model;

class Page_setting extends Model
{
    protected $table      = 'bd_page_settings';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['setting_key', 'setting_val'];
}