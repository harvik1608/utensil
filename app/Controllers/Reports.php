<?php

namespace App\Controllers;

use App\Models\Order;

class Reports extends BaseController
{
    protected $session;
    protected $helpers = ["custom"];

    public function __construct()
    {
        $this->session = session();
    }

    public function index()
    {
        if(!check_permission('report')) {
            return redirect('dashboard');
        }
        return view('admin/report/list');
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
        $builder = $db->table('bd_orders o');
        $builder->select("o.id,o.order_no,c.fname,c.lname,c.phone,o.amount,o.order_date,o.status");
        $builder->join("bd_customers c","c.id=o.customer_id");
        $builder->where('o.deleted_by', 0);
        $builder->where('c.deleted_by', 0);
        $builder->where('c.is_active', 1);
        $builder->where('o.status', 5);
        if (!empty($post["order_no"])) {
            $builder->like('o.order_no',$post["order_no"]);
            // $builder->groupStart()->like('p.name', $searchValue)->orLike('p.price', $searchValue)->orLike('c.name', $searchValue)->groupEnd();
        }
        if (!empty($post["customer_name"])) {
            $builder->like('c.fname',$post["customer_name"]);
        }
        if (!empty($post["customer_phone"])) {
            $builder->like('c.phone',$post["customer_phone"]);
        }
        if (!empty($post["amount"])) {
            $builder->like('o.amount',$post["amount"]);
        }
        if (!empty($post["order_date"])) {
            $builder->like('o.order_date',$post["order_date"]);
        }
        if (!empty($post["status"])) {
            $builder->like('o.status',(int) $post["status"]);
        }
        $countBuilder = clone $builder;
        $totalRecords = $countBuilder->countAllResults(false);
        $builder->orderBy($orderBy, $orderDir);
        $builder->limit($length, $start);
        $results = $builder->get()->getResultArray();
        foreach ($results as $key => $val) {
            $_editUrl = base_url("orders/" . $val["id"] . "/edit");
            $trashUrl = base_url("orders/" . $val["id"]);

            $buttons = "";
            $buttons .= '<a href="'.$_editUrl.'"><i class="icon-base bx bx-edit icon-sm"></i></a>&nbsp;';
            $buttons .= '<a href="javascript:;" onclick=remove_row("'.$trashUrl.'")><i class="icon-base bx bx-trash icon-sm"></i></a>';
            
            $result['data'][$key] = [
                ($key + 1),
                "#".$val['order_no'],
                $val['fname']." ".$val["lname"],
                $val["phone"],
                currency()." ".$val['amount'],
                format_date($val["order_date"]),
                // $buttons
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
}
