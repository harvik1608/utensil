<?php

namespace App\Controllers;

use App\Models\General_setting;
use App\Models\Page_setting;
use App\Models\Category;

class CommonController extends BaseController
{
    public function __construct()
    {
        $model = new General_setting;
        $_rows = $model->get()->getResultArray();
        if(!empty($_rows)) {
            foreach ($_rows as $row) {
                if(!defined(strtoupper($row["setting_key"]))) {
                    define(strtoupper($row["setting_key"]),$row["setting_val"]);
                }
            }
        }

        $model = new Page_setting;
        $_rows = $model->get()->getResultArray();
        if(!empty($_rows)) {
            foreach ($_rows as $row) {
                if(!defined(strtoupper($row["setting_key"]))) {
                    define(strtoupper($row["setting_key"]),$row["setting_val"]);
                }
            }
        }
    }

    public function fetch_sub_categories()
    {
        $where = array("is_active" => 1,"deleted_by" => 0,"category_id" => $this->request->getVar('category_id'));
        $_model = new Category;
        $result = $_model->select("id,name")->where($where)->orderBy("name","asc")->get()->getResultArray();
        echo json_encode(["count" => count($result),"data" => $result]);
        exit;
    }
}
