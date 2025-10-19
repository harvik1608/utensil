<?php

namespace App\Controllers;

use App\Models\General_setting;
use App\Models\Page_setting;
use App\Models\Order;
use App\Models\Inquiry;

class Dashboard extends BaseController
{
    protected $session;
    protected $helpers = ["custom"];

    public function __construct()
    {
        $this->session = session();
    }

    public function index()
    {
        return view('admin/dashboard');
    }

    public function load_revenue()
    {
        $labels = $data = [];
        $months = [1,2,3,4,5,6,7,8,9,10,11,12];
        $_model = new Order; 
        foreach($months as $month) {
            $labels[] = date("M", mktime(0, 0, 0, $month, 1));
            $atten = $_model->selectSum("amount")->where("YEAR(order_date)",date("Y"))->where("MONTH(order_date)",$month)->where("status",5)->get()->getRowArray();
            if($atten) {
                $data[] = (!empty($atten) && !is_null($atten["amount"])) ? floatval($atten["amount"]) : 0;
            }
        }
        echo json_encode(array("labels" => $labels,"data" => $data));
        exit;

    }

    public function about_us()
    {
        $data["content"] = page_setting("about_us");
        $data["page_title"] = "About Us";
        $data["setting_key"] = "about_us";
        return view('admin/page_settings',$data);
    }

    public function tc()
    {
        $data["content"] = page_setting("terms_and_conditions");
        $data["page_title"] = "Terms and Conditions";
        $data["setting_key"] = "terms_and_conditions";
        return view('admin/page_settings',$data);
    }

    public function privacy_policy()
    {
        $data["content"] = page_setting("privacy_policy");
        $data["page_title"] = "Privacy Policy";
        $data["setting_key"] = "privacy_policy";
        return view('admin/page_settings',$data);
    }

    public function return_policy()
    {
        $data["content"] = page_setting("return_policy");
        $data["page_title"] = "Return Policy";
        $data["setting_key"] = "return_policy";
        return view('admin/page_settings',$data);
    }

    public function shipping_policy()
    {
        $data["content"] = page_setting("shipping_policy");
        $data["page_title"] = "Shipping Policy";
        $data["setting_key"] = "shipping_policy";
        return view('admin/page_settings',$data);
    }

    public function submit_page_settings()
    {
        try {
            $post = $this->request->getVar();

            $model = new Page_setting;
            $model->set(["setting_val" => $post["content"]])->where("setting_key",$post["setting_key"])->update();

            $this->session->setFlashData('success_message',"Content updated successfully.");
            return $this->response->setJSON(['status' => 'success']);
        } catch(\Throwable $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $e->getMessage(),
                'csrf' => csrf_hash()
            ]);
        }        
    }

    public function general_settings()
    {
        $model = new General_setting;
        $settings = $model->get()->getResultArray();
        $data = [];
        if(!empty($settings)) {
            foreach($settings as $key => $val) {
                $data[$val["setting_key"]] = $val["setting_val"]; 
            }
        }
        return view('admin/general_settings',$data);
    }

    public function submit_general_settings()
    {
        try {
            $post = $this->request->getVar();
            $old_logo = $post["old_app_logo"];

            $model = new General_setting;
            $model->truncate();

            unset($post["csrf_token"]);
            unset($post["old_app_logo"]);
            foreach($post as $key => $val) {
                $model->insert(["setting_key" => $key,"setting_val" => $val]);
            }
            $file = $this->request->getFile('app_logo');
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $app_logo = $file->getRandomName();
                $file->move(FCPATH . 'public/uploads/general', $app_logo);
                remove_file($old_logo,"general");
            } else {
                $app_logo = $old_logo;
            }
            $model->insert(["setting_key" => "app_logo","setting_val" => $app_logo]);

            $this->session->setFlashData('success_message',"General settings updated successfully.");
            return $this->response->setJSON(['status' => 'success']);
        } catch(\Throwable $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $e->getMessage(),
                'csrf' => csrf_hash()
            ]);
        }        
    }

    public function inquiries()
    {
        if(!check_permission('inquiry')) {
            return redirect('dashboard');
        }
        $model = new Inquiry;
        $data["inquiries"] = $model->orderBy("id","desc")->get()->getResultArray();
        return view('admin/inquiry/list',$data);
    }
}
