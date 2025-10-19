<?php

namespace App\Controllers;

use App\Models\Banner;

class Banners extends BaseController
{
    protected $session;
    protected $helpers = ["custom"];

    public function __construct()
    {
        $this->session = session();
    }

    public function index()
    {
        if(!check_permission('banner')) {
            return redirect('dashboard');
        }
        $model = new Banner;
        $data["banners"] = $model->orderBy("id","desc")->get()->getResultArray();
        return view('admin/banner/list',$data);
    }

    public function new()
    {
        if(!check_permission('banner')) {
            return redirect('dashboard');
        }
        $data["banner"] = array();
        return view('admin/banner/add_edit',$data);
    }

    public function create()
    {
        try {
            $post = $this->request->getVar();
            $file = $this->request->getFile('avatar');
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $avatar = $file->getRandomName();
                $file->move(FCPATH . 'public/uploads/banner', $avatar);
            } else {
                $avatar = "";
            }
            $insert_data = [
                "avatar" => $avatar
            ];
            $model = new Banner;
            $model->insert($insert_data);

            $this->session->setFlashData('success_message',"Banner added successfully.");
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
            $_model = new Banner;
            $banner = $_model->where("id",$id)->first();
            if($banner["avatar"] && file_exists("public/uploads/banner/".$banner["avatar"])) {
                unlink("public/uploads/banner/".$banner["avatar"]);
            }
            $_model->delete($id);
            
            $this->session->setFlashData('success_message',"Banner deleted successfully.");
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
