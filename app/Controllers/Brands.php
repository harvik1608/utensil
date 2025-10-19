<?php

namespace App\Controllers;

use App\Models\Brand;
use App\Models\Product;

class Brands extends BaseController
{
    protected $session;
    protected $helpers = ["custom"];

    public function __construct()
    {
        $this->session = session();
    }

    public function index()
    {
        if(!check_permission('brand')) {
            return redirect('dashboard');
        }
        $model = new Brand;
        $data["brands"] = $model->where(["deleted_by" => 0])->orderBy("id","desc")->get()->getResultArray();
        if($data["brands"]) {
            $model = new Product;
            foreach ($data["brands"] as $key => $val) {
                $data["brands"][$key]["items"] = $model->where(["brand_id" => $val["id"],"deleted_by" => 0,"deleted_at" => null])->get()->getNumRows(); 
            }
        }
        return view('admin/brand/list',$data);
    }

    public function new()
    {
        if(!check_permission('brand')) {
            return redirect('dashboard');
        }
        $data["brand"] = array();
        return view('admin/brand/add_edit',$data);
    }

    public function create()
    {
        try {
            $userdata = $this->session->get("userdata");

            $post = $this->request->getVar();
            $insert_data = [
                "name" => $post["name"],
                "slug" => slug($post["name"]),
                "is_active" => $post["is_active"],
                "created_by" => $userdata["id"],
                "created_at" => date("Y-m-d H:i:s")
            ];
            $model = new Brand;
            $model->insert($insert_data);

            $this->session->setFlashData('success_message',"Brand added successfully.");
            return $this->response->setJSON(['status' => 'success']);
        } catch(\Throwable $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $e->getMessage(),
                'csrf' => csrf_hash()
            ]);
        }
    }

    public function edit($id)
    {
        if(!check_permission('brand')) {
            return redirect('dashboard');
        }
        $model = new Brand;
        $data["brand"] = $model->where(["deleted_by" => 0,"id" => $id])->first();
        if(!$data["brand"]) {
            return redirect('brands');
        }
        return view('admin/brand/add_edit',$data);
    }

    public function update($id)
    {
        try {
            $userdata = $this->session->get("userdata");

            $post = $this->request->getVar();
            $update_data = [
                "slug" => slug($post["name"]),
                "name" => $post["name"],
                "is_active" => $post["is_active"],
                "updated_by" => $userdata["id"],
                "updated_at" => date("Y-m-d H:i:s")
            ];
            $model = new Brand;
            $model->update($id,$update_data);

            $this->session->setFlashData('success_message',"Brand updated successfully.");
            return $this->response->setJSON(['status' => 'success']);
        } catch(\Throwable $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $e->getMessage(),
                'csrf' => csrf_hash()
            ]);
        }
    }

    public function show($id)
    {
        try {
            $userdata = $this->session->get("userdata");
            $update_data = [
                "deleted_by" => $userdata["id"],
                "deleted_at" => date("Y-m-d H:i:s")
            ];
            $model = new Brand;
            $model->update($id,$update_data);

            $this->session->setFlashData('success_message',"Brand deleted successfully.");
            return $this->response->setJSON(['status' => 'success']);
        } catch(\Throwable $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $e->getMessage(),
                'csrf' => csrf_hash()
            ]);
        }
    }
}
