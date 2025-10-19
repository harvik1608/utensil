<?php

namespace App\Controllers;

use App\Models\Category;

class Sub_categories extends BaseController
{
    protected $session;
    protected $helpers = ["custom"];

    public function __construct()
    {
        $this->session = session();
    }

    public function index()
    {
        if(!check_permission('sub_category')) {
            return redirect('dashboard');
        }
        // $model = new Category;
        // $data["categories"] = $model->where(["deleted_by" => 0,"category_id >" => 0])->orderBy("id","desc")->get()->getResultArray();

        $_model = db_connect();
        $result = $_model->table("bd_product_categories pc1");
        $result = $result->join("bd_product_categories pc2","pc2.id=pc1.category_id");
        $result = $result->select("pc1.id,pc1.name,pc2.name as category,pc1.is_active");
        $result = $result->where("pc1.deleted_by",0);
        $result = $result->where("pc2.deleted_by",0);
        $result = $result->orderBy("pc1.id","desc");
        $data["categories"] = $result->get()->getResultArray();
        return view('admin/sub_category/list',$data);
    }

    public function new()
    {
        if(!check_permission('sub_category')) {
            return redirect('dashboard');
        }
        $model = new Category;
        $data["categories"] = $model->where(["deleted_by" => 0,"is_active" => 1,"category_id " => 0])->orderBy("name","asc")->get()->getResultArray();
        $data["sub_category"] = array();
        return view('admin/sub_category/add_edit',$data);
    }

    public function create()
    {
        try {
            $post = $this->request->getVar();
            $avatar = "";
            
            $userdata = $this->session->get("userdata");
            $insert_data = [
                "category_id" => $post["category_id"],
                "slug" => slug($post["name"]),
                "name" => $post["name"],
                "avatar" => $avatar,
                "is_active" => $post["is_active"],
                "created_by" => $userdata["id"],
                "created_at" => date("Y-m-d H:i:s")
            ];
            $model = new Category;
            $model->insert($insert_data);

            $this->session->setFlashData('success_message',"Sub Category added successfully.");
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
        if(!check_permission('sub_category')) {
            return redirect('dashboard');
        }
        $model = new Category;
        $data["sub_category"] = $model->where(["deleted_by" => 0,"id" => $id])->first();
        if(!$data["sub_category"]) {
            return redirect('sub_categories');
        }
        $data["categories"] = $model->where(["deleted_by" => 0,"is_active" => 1,"category_id " => 0])->orderBy("name","asc")->get()->getResultArray();
        return view('admin/sub_category/add_edit',$data);
    }

    public function update($id)
    {
        try {
            $post = $this->request->getVar();
            $avatar = "";
            
            $userdata = $this->session->get("userdata");
            $update_data = [
                "category_id" => $post["category_id"],
                "slug" => slug($post["name"]),
                "name" => $post["name"],
                "avatar" => $avatar,
                "is_active" => $post["is_active"],
                "updated_by" => $userdata["id"],
                "updated_at" => date("Y-m-d H:i:s")
            ];
            $model = new Category;
            $model->update($id,$update_data);

            $this->session->setFlashData('success_message',"Sub Category updated successfully.");
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

            $this->session->setFlashData('success_message',"Sub Category deleted successfully.");
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
