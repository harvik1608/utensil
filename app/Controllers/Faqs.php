<?php
namespace App\Controllers;

use App\Models\Faq;

class Faqs extends BaseController
{
    protected $session;
    protected $helpers = ["custom"];

    public function __construct()
    {
        $this->session = session();
    }

    public function index()
    {
        if(!check_permission('faq')) {
            return redirect('dashboard');
        }
        $model = new Faq;
        $data["faqs"] = $model->where(["deleted_by" => 0])->orderBy("id","desc")->get()->getResultArray();
        return view('admin/faq/list',$data);
    }

    public function new()
    {
        if(!check_permission('faq')) {
            return redirect('dashboard');
        }
        $data["faq"] = array();
        return view('admin/faq/add_edit',$data);
    }

    public function create()
    {
        try {
            $userdata = $this->session->get("userdata");

            $post = $this->request->getVar();
            $insert_data = [
                "query" => $post["query"],
                "answer" => $post["answer"],
                "is_active" => $post["is_active"],
                "created_by" => $userdata["id"],
                "created_at" => date("Y-m-d H:i:s")
            ];
            $model = new Faq;
            $model->insert($insert_data);

            $this->session->setFlashData('success_message',"FAQ added successfully.");
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
        if(!check_permission('faq')) {
            return redirect('dashboard');
        }
        $model = new Faq;
        $data["faq"] = $model->where(["deleted_by" => 0,"id" => $id])->first();
        if(!$data["faq"]) {
            return redirect('faqs');
        }
        return view('admin/faq/add_edit',$data);
    }

    public function update($id)
    {
        try {
            $userdata = $this->session->get("userdata");

            $post = $this->request->getVar();
            $update_data = [
                "query" => $post["query"],
                "answer" => $post["answer"],
                "is_active" => $post["is_active"],
                "updated_by" => $userdata["id"],
                "updated_at" => date("Y-m-d H:i:s")
            ];
            $model = new Faq;
            $model->update($id,$update_data);

            $this->session->setFlashData('success_message',"FAQ updated successfully.");
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
            $model = new Faq;
            $model->update($id,$update_data);

            $this->session->setFlashData('success_message',"FAQ deleted successfully.");
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
