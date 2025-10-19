<?php

namespace App\Controllers;

use App\Models\Customer;

class Customers extends BaseController
{
    protected $session;
    protected $helpers = ["custom"];

    public function __construct()
    {
        $this->session = session();
    }

    public function index()
    {
        if(!check_permission('customer')) {
            return redirect('dashboard');
        }
        return view('admin/customer/list');
    }

    public function load()
    {
        $post = $this->request->getVar();
        $result = array("data" => array());

        $draw = $post['draw'];
        $start = (int) $post['start'];
        $length = (int) $post['length'];
        $searchValue = $post['search']['value'];
        $orderColumn = $post['order'][0]['column'];
        $orderDir = $post['order'][0]['dir'];
        
        $columns = ['id','name','email','phone',''];
        $orderBy = $columns[$orderColumn] ?? 'id';

        $db = db_connect();
        $builder = $db->table('bd_customers c');
        $builder->select("c.id,c.fname,c.lname,c.email,c.phone,c.created_at,c.is_active");
        $builder->where('c.deleted_by', 0);
        if (!empty($searchValue)) {
            $builder->groupStart()->like('c.fname', $searchValue)->orLike('c.lname', $searchValue)->orLike('c.email', $searchValue)->orLike('c.phone', $searchValue)->groupEnd();
        }
        $countBuilder = clone $builder;
        $totalRecords = $countBuilder->countAllResults(false);
        $builder->orderBy($orderBy, $orderDir);
        $builder->limit($length, $start);
        $results = $builder->get()->getResultArray();
        foreach ($results as $key => $val) {
            $_editUrl = base_url("customers/" . $val["id"] . "/edit");
            $trashUrl = base_url("customers/" . $val["id"]);

            switch($val['is_active']) {
                case 1:
                    $status = '<span class="badge bg-success">Active</span>';
                    break;

                default:
                    $status = '<span class="badge bg-danger">Inactive</span>';
                    break;
            }

            $buttons = "";
            $buttons .= '<a href="'.$_editUrl.'"><i class="icon-base bx bx-edit icon-sm"></i></a>&nbsp;';
            $buttons .= '<a href="javascript:;" onclick=remove_row("'.$trashUrl.'")><i class="icon-base bx bx-trash icon-sm"></i></a>';
            
            $result['data'][$key] = [
                ($key + 1),
                $val['fname']." ".$val["lname"] ,
                $val['email'],
                $val['phone'],
                format_date($val['created_at']),
                $status,
                $buttons
            ];
        }

        // Add response metadata
        $result["draw"] = intval($draw);
        $result["recordsTotal"] = $totalRecords;
        $result["recordsFiltered"] = $totalRecords;

        // Output JSON
        echo json_encode($result);
        exit;
    }

    public function new()
    {
        if(!check_permission('customer')) {
            return redirect('dashboard');
        }
        $data["customer"] = array();
        return view('admin/customer/add_edit',$data);
    }

    public function create()
    {
        try {
            $post = $this->request->getVar();
            
            $model = new Customer;
            $count = $model->where("email",$post["email"])->get()->getNumRows();
            if($count == 0) {
                $count = $model->where("phone",$post["phone"])->get()->getNumRows();
                if($count == 0) {
                    $userdata = $this->session->get("userdata");
                    $insert_data = [
                        "fname" => $post["fname"],
                        "lname" => $post["lname"],
                        "email" => $post["email"],
                        "phone" => $post["phone"],
                        "password" => md5(trim($post["password"])),
                        "state_id" => $post["state_id"],
                        "city" => $post["city"],
                        "avatar" => "",
                        "is_verified" => 1,
                        "is_active" => $post["is_active"],
                        "updated_by" => $userdata["id"],
                        "updated_at" => date("Y-m-d H:i:s")
                    ];
                    $model->insert($insert_data);

                    $post["app_name"] = general_setting('app_name');
                    $post["customer_name"] = $post["fname"]." ".$post["lname"];
                    $post["customer_email"] = $post["email"];
                    $post["customer_phone"] = $post["phone"];
                    $post["customer_password"] = $post["password"];
                    $post["support_email"] = general_setting('app_email');
                    $html = view("email/account_creation",$post);
                    send_admin_email($post["email"],"Customer Account Created",$html);

                    $this->session->setFlashData('success_message',"Customer added successfully.");
                    return $this->response->setJSON(['status' => 'success']);       
                } else {
                    return $this->response->setJSON([
                        'status' => 'error',
                        'message' => "Phone no. already used by other customer.",
                        'csrf' => csrf_hash()
                    ]);
                } 
            } else {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => "Email already used by other customer.",
                    'csrf' => csrf_hash()
                ]);
            }
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
        if(!check_permission('customer')) {
            return redirect('dashboard');
        }
        $model = new Customer;
        $data["customer"] = $model->where(["deleted_by" => 0,"id" => $id])->first();
        if(!$data["customer"]) {
            return redirect('customers');
        }
        return view('admin/customer/add_edit',$data);
    }

    public function update($id)
    {
        try {
            $post = $this->request->getVar();
            
            $model = new Customer;
            $count = $model->where("email",$post["email"])->where("id !=",$id)->get()->getNumRows();
            if($count == 0) {
                $count = $model->where("phone",$post["phone"])->where("id !=",$id)->get()->getNumRows();
                if($count == 0) {
                    $file = $this->request->getFile('avatar');
                    if ($file && $file->isValid() && !$file->hasMoved()) {
                        $avatar = $file->getRandomName();
                        $file->move(FCPATH . 'public/uploads/customer', $avatar);
                        remove_file($post["old_avatar"],"customer");
                    } else {
                        $avatar = $post["old_avatar"];
                    }
                    $userdata = $this->session->get("userdata");
                    $update_data = [
                        "fname" => $post["fname"],
                        "lname" => $post["lname"],
                        "email" => $post["email"],
                        "phone" => $post["phone"],
                        "state_id" => $post["state_id"],
                        "city" => $post["city"],
                        "avatar" => $avatar,
                        "is_active" => $post["is_active"],
                        "updated_by" => $userdata["id"],
                        "updated_at" => date("Y-m-d H:i:s")
                    ];
                    if(trim($post["password"]) != "") {
                        $update_data["password"] = md5(trim($post["password"]));
                    }
                    $model->update($id,$update_data);
                    $this->session->setFlashData('success_message',"Customer updated successfully.");
                    return $this->response->setJSON(['status' => 'success']);       
                } else {
                    return $this->response->setJSON([
                        'status' => 'error',
                        'message' => "Phone no. already used by other customer.",
                        'csrf' => csrf_hash()
                    ]);
                } 
            } else {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => "Email already used by other customer.",
                    'csrf' => csrf_hash()
                ]);
            }
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
            $model = new Customer;
            $model->update($id,$update_data);

            $this->session->setFlashData('success_message',"Customer deleted successfully.");
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
