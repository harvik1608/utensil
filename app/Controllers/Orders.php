<?php
namespace App\Controllers;

require_once APPPATH . 'Libraries/dompdf/autoload.inc.php';

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Cart;
use App\Models\Order_Delivery;
use App\Models\Payment_request;
use App\Models\Returned_order;
use App\Models\Returned_order_item;

class Orders extends BaseController
{
    protected $session;
    protected $helpers = ["custom"];

    public function __construct()
    {
        $this->session = session();
    }

    public function index()
    {
        if(!check_permission('order')) {
            return redirect('dashboard');
        }
        $data["order_page_type"] = 1;
        $data["page_title"] = "All Orders";
        return view('admin/order/list',$data);
    }

    public function new_orders()
    {
        if(!check_permission('order')) {
            return redirect('dashboard');
        }
        $data["order_page_type"] = 2;
        $data["page_title"] = "New Orders";
        return view('admin/order/list',$data);
    }

    public function returned_orders()
    {
        if(!check_permission('order')) {
            return redirect('dashboard');
        }
        $data["order_page_type"] = 3;
        $data["page_title"] = "Returned Orders";
        return view('admin/order/list',$data);
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
        $builder->select("o.id,o.order_no,c.fname,c.lname,c.phone,o.amount,o.shipping_cost,o.vat_charge,o.order_date,o.status");
        $builder->join("bd_customers c","c.id=o.customer_id");
        $builder->where('o.deleted_by', 0);
        $builder->where('c.deleted_by', 0);
        $builder->where('c.is_active', 1);
        if($post["order_page_type"] == 2) {
            $builder->where('o.status', 0);
        }
        if($post["order_page_type"] == 3) {
            $builder->where('o.status', 8);
        }
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
        if ($post["status"] != "") {
            $builder->where('o.status',(int) $post["status"]);
        }
        $countBuilder = clone $builder;
        $totalRecords = $countBuilder->countAllResults(false);
        $builder->orderBy($orderBy, $orderDir);
        $builder->limit($length, $start);
        $results = $builder->get()->getResultArray();
        foreach ($results as $key => $val) {
            $_editUrl = base_url("orders/" . $val["id"] . "/edit");
            $_viewUrl = base_url("orders/" . $val["id"]);
            $trashUrl = base_url("orders/" . $val["id"]);

            switch($val['status']) {
                case 0:
                    $status = '<span class="badge bg-primary">Order Placed</span>';
                    break;

                case 1:
                    $status = '<span class="badge bg-info">Order Shipped</span>';
                    break;

                case 2:
                    $status = '<span class="badge bg-info">On The Way</span>';
                    break;

                case 3:
                    $status = '<span class="badge bg-danger">Cancelled By Customer</span>';
                    break;

                case 4:
                    $status = '<span class="badge bg-danger">Cancelled By Us</span>';
                    break;

                case 5:
                    $status = '<span class="badge bg-warning">Reached at Your City</span>';
                    break;

                case 6:
                    $status = '<span class="badge bg-secondary">Out of Delivery</span>';
                    break;

                case 7:
                    $status = '<span class="badge bg-success">Delivered</span>';
                    break;

                case 8:
                    $status = '<span class="badge bg-danger">Returned Order</span>';
                    break;
            }
            $_amount = $val['amount']+$val["shipping_cost"]+$val["vat_charge"];
            $buttons = "";
            $buttons .= '<a href="'.$_viewUrl.'"><small>View</small></a>&nbsp;|&nbsp;';
            $buttons .= '<a href="'.$_editUrl.'"><small>Edit</small></a>';
            // $buttons .= '<a href="javascript:;" onclick=remove_row("'.$trashUrl.'")><i class="icon-base bx bx-trash icon-sm"></i></a>'; 
            $result['data'][$key] = [
                ($key + 1),
                "#".$val['order_no'],
                $val['fname']." ".$val["lname"],
                $val["phone"],
                currency()." ".number_format($_amount,2),
                format_date($val["order_date"]),
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

    public function show($order_id)
    {
        if(!check_permission('order')) {
            return redirect('dashboard');
        }
        $model = new Order;
        $data["order"] = $model->where("id",$order_id)->first();
        if($data["order"]) {
            $model = new Customer;
            $data["customer"] = $model->select("fname,lname,email,phone")->where("id",$data["order"]["customer_id"])->first();

            $model = new Order_Delivery;
            $data["order_shipping"] = $model->select("*")->where("order_id",$data["order"]["id"])->first();

            $model = db_connect();
            $items = $model->table("bd_carts c");
            $items = $items->join("bd_products p","p.id=c.product_id");
            $items = $items->select("c.id,c.product_amt,c.product_discount_amt,c.quantity,p.name,p.avatar");
            $items = $items->where(["c.order_id" => $data["order"]["id"]]);
            $items = $items->orderBy("c.id","desc");
            $data["items"] = $items->get()->getResultArray();
            return view('admin/order/view',$data);
        } else {
            return redirect()->to("orders");
        }
    }

    public function edit($order_id)
    {
        if(!check_permission('order')) {
            return redirect('dashboard');
        }
        $model = new Order;
        $data["order"] = $model->where("id",$order_id)->first();
        if($data["order"]) {
            $model = new Payment_request;
            $data["order_payment_requests"] = $model->where("order_id",$order_id)->get()->getResultArray();
            if($data["order"]["status"] == 8) {
                $model = db_connect();
                $items = $model->table("bd_returned_orders ro");
                $items = $items->join("bd_orders o","o.id=ro.order_id");
                $items = $items->join("bd_customers c","c.id=ro.customer_id");
                $items = $items->select("ro.*,o.order_no,c.id as customer_id,c.fname,c.lname,c.phone,c.email");
                $items = $items->where(["ro.order_id" => $order_id]);
                $data["returned_order"] = $items->get()->getRowArray();

                return view('admin/order/return_add_edit',$data);
            } else {
                $model = new Customer;
                $data["customer"] = $model->select("id,fname,lname,email,phone")->where("id",$data["order"]["customer_id"])->first();

                $model = new Order_Delivery;
                $data["order_shipping"] = $model->select("*")->where("order_id",$order_id)->first();
                
                return view('admin/order/add_edit',$data);
            }
        } else {
            return redirect()->to("orders");
        }
    }

    public function update($order_id)
    {
        try {
            $post = $this->request->getVar();
            $userdata = $this->session->get("userdata");

            if(isset($post["order_status"]) && $post["order_status"] == 8) {
                $update_data = [
                    "status" => $post["status"],
                    "comment" => $post["comment"], 
                    "updated_at" => date("Y-m-d H:i:s")
                ];
                $model = new Returned_order;
                $model->update($order_id,$update_data);

                $this->session->setFlashData('success_message',"Order updated successfully.");
            } else {
                $update_data = [
                    "status" => $post["status"],
                    "updated_by" => $userdata["id"],
                    "updated_at" => date("Y-m-d H:i:s")
                ];
                $update_data["delivered_at"] = $post["status"] == 7 ? date("Y-m-d H:i:s") : null;
                
                $model = new Order;
                $model->update($order_id,$update_data);

                $model = db_connect();
                $order = $model->table("bd_orders o");
                $order = $order->join("bd_customers c","c.id=o.customer_id");
                $order = $order->select("o.order_no,o.status,c.fname,c.lname,c.email");
                $order = $order->where("o.id",$order_id);
                $data["order"] = $order->get()->getRowArray();
                if($data["order"]) {
                    $order_status = str_replace("Order","",order_status($data["order"]["status"],1));
                    $emaildata["customer_name"] = $data["order"]["fname"]." ".$data["order"]["lname"];
                    $emaildata["order_no"] = $data["order"]["order_no"];
                    $emaildata["order_status"] = $order_status;
                    $emailhtml = view("email/order_update",$emaildata);
                    send_admin_email($data["order"]["email"],"Order Status Updated",$emailhtml);
                }

                $this->session->setFlashData('success_message',"Order updated successfully.");
            }
            return $this->response->setJSON(['status' => 'success']);
        } catch(\Throwable $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $e->getMessage(),
                'csrf' => csrf_hash()
            ]);
        }
    }

    public function get_order_items()
    {
        try {
            $post = $this->request->getVar();

            $model = new Order;
            $data["order"] = $model->select("amount,shipping_cost,vat_charge")->where("id",$post["order_id"])->first();
            if($data["order"]) {
                $model = db_connect();
                $items = $model->table("bd_carts c");
                $items = $items->join("bd_products p","p.id=c.product_id");
                $items = $items->select("c.id,c.product_amt,c.product_discount_amt,c.quantity,p.name,p.avatar,c.product_id");
                $items = $items->where(["c.order_id" => $post["order_id"]]);
                $items = $items->orderBy("c.id","desc");
                $data["items"] = $items->get()->getResultArray();
                $html = view('admin/order/order_items',$data);

                return $this->response->setJSON(['status' => 'success','html' => $html]);
            }
        } catch(\Throwable $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function get_returned_order_items()
    {
        try {
            $post = $this->request->getVar();

            $model = new Returned_order;
            $data["returned_order"] = $model->where("id",$post["returned_order_id"])->first();
            if($data["returned_order"]) {
                $model = db_connect();
                $items = $model->table("bd_returned_order_items roi");
                $items = $items->join("bd_products p","p.id=roi.product_id");
                $items = $items->select("roi.*,p.name,p.avatar");
                $items = $items->where(["roi.returned_order_id" => $post["returned_order_id"]]);
                $items = $items->orderBy("roi.id","asc");
                $data["items"] = $items->get()->getResultArray();
                $html = view('admin/order/returned_order_items',$data);

                return $this->response->setJSON(['status' => 'success','html' => $html]);
            }
        } catch(\Throwable $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function update_order_item_quantity()
    {
        try {
            $post = $this->request->getVar();

            $model = new Cart;
            if($model->update($post["item_id"],["quantity" => $post["new_qty"]])){
                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => "Quantity updated successfully.",
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

    public function update_returned_order_item_quantity()
    {
        try {
            $post = $this->request->getVar();

            $model = new Returned_order_item;
            $_item = $model->select("returned_order_id,entered_quantity")->where("id",$post["item_id"])->first();
            if($_item) {
                if($post["new_qty"] <= $_item["entered_quantity"]) {
                    if($model->update($post["item_id"],["approved_quantity" => $post["new_qty"]])){
                        $model = new Returned_order;
                        $model->update($_item["returned_order_id"],["approved_amount" => $post["approved_amount"]]);

                        return $this->response->setJSON([
                            'status' => 'success',
                            'message' => "Quantity updated successfully.",
                            'csrf' => csrf_hash()
                        ]);
                    }
                } else {
                    return $this->response->setJSON([
                        'status' => 'max_excceed',
                        'message' => "Maximum allowed quantity is ".$_item["entered_quantity"].".",
                        'csrf' => csrf_hash()
                    ]);
                }
            }
        } catch(\Throwable $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $e->getMessage(),
                'csrf' => csrf_hash()
            ]);
        }
    }

    public function raise_payment_request()
    {
        try {
            $post = $this->request->getVar();

            if(trim($post["amount"]) == "" || $post["amount"] == "0") {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => "Enter valid amount.",
                    'csrf' => csrf_hash()
                ]);
            } else if(trim($post["request_type"]) == "") {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => "Choose request type",
                    'csrf' => csrf_hash()
                ]);
            } else {
                $post["status"] = 0;
                $post["created_at"] = date("Y-m-d H:i:s");
                
                $model = new Payment_request;
                if($model->insert($post)) {
                    $this->session->setFlashData('success_message',"Payment request raised successfully.");
                    return $this->response->setJSON([
                        'status' => 'success',
                        'message' => "",
                        'csrf' => csrf_hash()
                    ]);
                } else {
                    return $this->response->setJSON([
                        'status' => 'error',
                        'message' => "Error occured while adding record.",
                        'csrf' => csrf_hash()
                    ]);
                }
            }
        } catch(\Throwable $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $e->getMessage(),
                'csrf' => csrf_hash()
            ]);
        }
    }

    public function download_invoice($order_id)
    {
        $model = new Order;
        $order = $model->where("id",$order_id)->first();
        
        $model = new Order_Delivery;
        $order_shipping = $model->select("*")->where("order_id",$order_id)->first();
        
        $model = db_connect();
        $items = $model->table("bd_carts c");
        $items = $items->join("bd_products p","p.id=c.product_id");
        $items = $items->select("c.id,c.product_amt,c.product_discount_amt,c.quantity,p.name,p.avatar,c.product_id");
        $items = $items->where(["c.order_id" => $order_id]);
        $items = $items->orderBy("c.id","desc");
        $order_items = $items->get()->getResultArray();
        
        $html = view('admin/order/invoice', [
            "title" => "INV-".$order["id"],
            "app_logo" => base_url('public/uploads/general/'.general_setting('app_logo')),
            "app_name" => general_setting('app_name'),
            "app_address" => general_setting('app_address'),
            "bank_name" => general_setting('bank_name'),
            "bank_code" => general_setting('bank_code'),
            "bank_account_no" => general_setting('bank_account_no'),
            "bank_iban" => general_setting('bank_iban'),
            "bank_bic" => general_setting('bank_bic'),
            "company_registration_number" => general_setting('company_registration_number'),
            "vat_registration_number" => general_setting('vat_registration_number'),
            "order" => $order,
            "order_shipping" => $order_shipping,
            "order_items" => $order_items
        ]);
        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("INV-".$order_id.".pdf");
    }
}
