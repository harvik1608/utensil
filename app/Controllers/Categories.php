<?php

namespace App\Controllers;

use App\Models\Category;
use App\Models\Product;

class Categories extends BaseController
{
    protected $session;
    protected $helpers = ["custom"];

    public function __construct()
    {
        $this->session = session();
    }

    public function index()
    {
        if(!check_permission('category')) {
            return redirect('dashboard');
        }
        $model = new Category;
        $data["categories"] = $model->where(["deleted_by" => 0,"category_id" => 0])->orderBy("id","desc")->get()->getResultArray();
        if($data["categories"]) {
            $model = new Product;
            foreach ($data["categories"] as $key => $val) {
                $data["categories"][$key]["items"] = $model->where(["category_id" => $val["id"],"deleted_by" => 0,"deleted_at" => null])->get()->getNumRows(); 
            }
        }
        return view('admin/category/list',$data);
    }

    public function new()
    {
        if(!check_permission('category')) {
            return redirect('dashboard');
        }
        $data["category"] = array();
        return view('admin/category/add_edit',$data);
    }

    public function create()
    {
        try {
            $post = $this->request->getVar();
            $file = $this->request->getFile('avatar');
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $avatar = $file->getRandomName();
                $file->move(FCPATH . 'public/uploads/category', $avatar);
            } else {
                $avatar = "";
            }
            
            $userdata = $this->session->get("userdata");
            $insert_data = [
                "slug" => slug($post["name"]),
                "name" => $post["name"],
                "avatar" => $avatar,
                "is_active" => $post["is_active"],
                "created_by" => $userdata["id"],
                "created_at" => date("Y-m-d H:i:s")
            ];
            $model = new Category;
            $model->insert($insert_data);

            $this->session->setFlashData('success_message',"Category added successfully.");
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
        if(!check_permission('category')) {
            return redirect('dashboard');
        }
        $model = new Category;
        $data["category"] = $model->where(["deleted_by" => 0,"id" => $id])->first();
        if(!$data["category"]) {
            return redirect('categories');
        }
        return view('admin/category/add_edit',$data);
    }

    public function update($id)
    {
        try {
            $post = $this->request->getVar();
            $file = $this->request->getFile('avatar');
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $avatar = $file->getRandomName();
                $file->move(FCPATH . 'public/uploads/category', $avatar);
                remove_file($post["old_avatar"],"category");
            } else {
                $avatar = $post["old_avatar"];
            }
            
            $userdata = $this->session->get("userdata");
            $update_data = [
                "slug" => slug($post["name"]),
                "name" => $post["name"],
                "avatar" => $avatar,
                "is_active" => $post["is_active"],
                "updated_by" => $userdata["id"],
                "updated_at" => date("Y-m-d H:i:s")
            ];
            $model = new Category;
            $model->update($id,$update_data);

            $this->session->setFlashData('success_message',"Category updated successfully.");
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
            $model = new Category;
            $model->update($id,$update_data);

            $this->session->setFlashData('success_message',"Category deleted successfully.");
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
