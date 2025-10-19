<?php

namespace App\Controllers;

use App\Models\General_setting;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Favourite;
use App\Models\Cart;
use App\Models\Order_Delivery;
use App\Models\Order;
use App\Models\Payment_request;
use App\Models\Returned_order;
use App\Models\Returned_order_item;
use App\Models\Visitor;
use App\Controllers\CommonController;

class CustomerDashboard extends CommonController
{
    protected $helpers = ["custom"];

    public function index()
    {
        $_session = session();
        $userdata = $_session->get('customerdata'); 

        $model = new Customer;
        $data["customer"] = $model->where(["id" => $userdata["id"],"deleted_by" => 0])->first();
        if($data["customer"]) {
            return view('customer/dashboard',$data);
        } else {
            $_session->setFlashData("message","Account not found");
            return redirect("sign-in");
        }
    }

    public function update_myprofile()
    {
        $post = $this->request->getVar();
        try {
            $_session = session();
            $userdata = $_session->get('customerdata');
            if(trim($post["fname"]) == "") {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => "First name is required.",
                    'input' => "fname",
                    'csrf' => csrf_hash()
                ]);
            } else if(trim($post["lname"]) == "") {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => "Last name is required.",
                    'input' => "lname",
                    'csrf' => csrf_hash()
                ]);
            } else if(trim($post["email"]) == "") {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => "Email is required.",
                    'input' => "email",
                    'csrf' => csrf_hash()
                ]);
            } else if(trim($post["phone"]) == "") {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => "Phone no. is required.",
                    'input' => "phone",
                    'csrf' => csrf_hash()
                ]);
            } else if(trim($post["region"]) == "") {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => "Region/State is required.",
                    'input' => "region",
                    'csrf' => csrf_hash()
                ]);
            } else if(trim($post["city"]) == "") {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => "City is required.",
                    'input' => "city",
                    'csrf' => csrf_hash()
                ]);
            } else if(trim($post["postalcode"]) == "") {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => "Postal Code is required",
                    'input' => "postalcode",
                    'csrf' => csrf_hash()
                ]);
            } else if(trim($post["address"]) == "") {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => "Address is required.",
                    'input' => "address",
                    'csrf' => csrf_hash()
                ]);
            } else {
                $model = new Customer;
                $count = $model->where("email",$post["email"])->where("id !=",$userdata["id"])->get()->getNumRows();
                if($count == 0) {
                    $count = $model->where("phone",$post["phone"])->where("id !=",$userdata["id"])->get()->getNumRows();
                    if($count == 0) {
                        $update_data = array(
                            "fname" => $post["fname"],
                            "lname" => $post["lname"],
                            "email" => $post["email"],
                            "phone" => $post["phone"],
                            "region" => $post["region"],
                            "city" => $post["city"],
                            "postalcode" => $post["postalcode"],
                            "address" => $post["address"],
                            "updated_by" => $userdata["id"],
                            "updated_at" => date("Y-m-d H:i:s")
                        );
                        $model->update($userdata["id"],$update_data);

                        $session = session();
                        $session->setFlashData("message","Profile updated successfully.");
                        return $this->response->setJSON(['status' => 'success',"redirect_url" => base_url("my-dashboard")]);
                    } else {
                        return $this->response->setJSON([
                            'status' => 'error',
                            'message' => "Phone no. is already used by other.",
                            'input' => "phone",
                            'csrf' => csrf_hash()
                        ]);
                    }
                } else {
                    return $this->response->setJSON([
                        'status' => 'error',
                        'message' => "Email is already used by other.",
                        'input' => "email",
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

    public function my_orders()
    {
        $_session = session();
        $session_data = $_session->get('customerdata');

        $model = db_connect();
        $orders = $model->table("bd_orders o");
        $orders = $orders->join("bd_customers c","c.id=o.customer_id");
        $orders = $orders->select("o.id,o.order_no,o.order_date,o.amount,o.shipping_cost,o.vat_charge,o.status,o.created_at");
        $orders = $orders->where(["o.customer_id" => $session_data["id"],"o.deleted_by" => 0,'o.payment_status' => 1]);
        $orders = $orders->orderBy("o.id","desc");
        $data["orders"] = $orders->get()->getResultArray();
        if($data["orders"]) {
            $model = new Cart;
            foreach($data["orders"] as $key => $val) {
                $data["orders"][$key]["total_items"] = $model->where("order_id",$val['id'])->get()->getNumRows();
            }
        }
        return view('customer/my_orders',$data);
    }

    public function my_wishlist()
    {
        $_session = session();
        $customerdata = $_session->get('customerdata'); 

        $model = db_connect();
        $products = $model->table("bd_product_favourites pf");
        $products = $products->join("bd_products p","p.id=pf.product_id");
        $products = $products->join("bd_brands b","b.id=p.brand_id");
        $products = $products->join("bd_product_categories pc","pc.id=p.category_id");
        $products = $products->select("p.id,p.slug,p.name,p.avatar,p.price,p.discount_price,p.in_stock,p.min_order");
        $products = $products->where(["p.is_active" => 1,"p.deleted_by" => 0,"b.is_active" => 1,"b.deleted_by" => 0,"pc.is_active" => 1,"pc.deleted_by" => 0,"pf.customer_id" => $customerdata["id"]]);
        $products = $products->orderBy("pf.id","desc");
        $data["products"] = $products->get()->getResultArray();
        return view('customer/my_wishlist',$data);
    }

    public function checkout()
    {
        $customer = customer_info();
        if(isset($customer["id"])) {
            $model = db_connect();
            $products = $model->table("bd_carts c");
            $products = $products->join("bd_products p","p.id=c.product_id");
            $products = $products->join("bd_brands b","b.id=p.brand_id");
            $products = $products->join("bd_product_categories pc","pc.id=p.category_id");
            $products = $products->select("p.id,p.slug,p.name,p.avatar,p.price,p.discount_price,p.in_stock,p.min_order,c.quantity,c.id as cart_id");
            $products = $products->where(["p.is_active" => 1,"p.deleted_by" => 0,"b.is_active" => 1,"b.deleted_by" => 0,"pc.is_active" => 1,"pc.deleted_by" => 0,"c.order_id" => 0,"c.customer_id" => $customer["id"]]);
            $products = $products->orderBy("c.id","desc");
            $data["products"] = $products->get()->getResultArray();

            $model = new Order_Delivery;
            $data["customer"] = $model->where("customer_id",$customer["id"])->orderBy("id","desc")->first();
        
            return view('customer/checkout',$data);
        }
    }

    public function track_order()
    {
        return view('customer/track_order');
    }

    public function change_password()
    {
        $post = $this->request->getVar();
        try {
            $_session = session();
            $userdata = $_session->get('customerdata');
            if(trim($post["old_password"]) == "") {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => "Old password is required.",
                    'input' => "old_password",
                    'csrf' => csrf_hash()
                ]);
            } else if(trim($post["new_password"]) == "") {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => "New password is required.",
                    'input' => "lname",
                    'csrf' => csrf_hash()
                ]);
            } else if(trim($post["confirm_new_password"]) == "") {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => "Confirm new password is required.",
                    'input' => "email",
                    'csrf' => csrf_hash()
                ]);
            } else if(strlen(trim($post["new_password"])) < 6) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => "The new password must be at least 6 characters long.",
                    'input' => "phone",
                    'csrf' => csrf_hash()
                ]);
            } else if(trim($post["new_password"]) != trim($post["confirm_new_password"])) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => "Password and Confirm Password must match.",
                    'input' => "confirm_new_password",
                    'csrf' => csrf_hash()
                ]);
            } else {
                $model = new Customer;
                $customer = $model->select("id,password")->where("id",$userdata["id"])->first();
                if($customer) {
                    if($customer["password"] == md5($post["old_password"])) {
                        $model->update($customer["id"],["password" => md5($post["new_password"])]);

                        $session = session();
                        $session->setFlashData("message","Password changed successfully.");
                        return $this->response->setJSON(['status' => 'success',"redirect_url" => base_url("my-dashboard")]);
                    } else {
                        return $this->response->setJSON([
                            'status' => 'error',
                            'message' => "Old password is wrong.",
                            'csrf' => csrf_hash()
                        ]);
                    }
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

    public function add_to_favourite()
    {
        try {
            $post = $this->request->getVar();
            $session = session();

            $model = new Product;
            $product = $model->select("id")->where(["slug" => $post["slug"],"is_active" => 1,"deleted_by" => 0])->first();
            if($session->get("customerdata")) {
                if($product) {
                    $customerdata = $session->get("customerdata");
                        
                    $model = new Favourite;
                    $count = $model->where(["product_id" => $product["id"],"customer_id" => $customerdata["id"]])->get()->getNumRows();
                    if($count == 0) {
                        $model->insert(["product_id" => $product["id"],"customer_id" => $customerdata["id"],"created_at" => date("Y-m-d H:i:s")]);
                    }
                }
                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => "Product successfully added to your favourites.",
                    'count' => get_count('wishlist'),
                    'csrf' => csrf_hash()
                ]);
            } else {
                if($product) {
                    $model = new Visitor;
                    $count = $model->where(["product_id" => $product["id"],"ip" => $this->request->getIPAddress()])->get()->getNumRows();
                    if($count == 0) {
                        $model->insert(["product_id" => $product["id"],"ip" => $this->request->getIPAddress(),"created_at" => date("Y-m-d H:i:s")]);
                    }
                }
                $session->setFlashData("message","Please sign in to add to favourites.");
                return $this->response->setJSON([
                    'status' => 'need_login',
                    'message' => "",
                    'href' => base_url('sign-in')
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

    public function remove_from_favourite()
    {
        $post = $this->request->getVar();
        try {
            $_session = session();
            $customerdata = $_session->get('customerdata');
            
            $model = new Product;
            $product = $model->select("id")->where("slug",$post["slug"])->first();
            if($product) {
                $model = new Favourite;
                if($model->where(["product_id" => $product["id"],"customer_id" => $customerdata["id"]])->delete()) {
                    $_session->setFlashData("message","Product removed from your favourite list.");
                    return $this->response->setJSON([
                        'status' => 'success',
                        'message' => "",
                        "count" => get_count('wishlist'),
                        'csrf' => csrf_hash()
                    ]);
                } else {
                    return $this->response->setJSON([
                        'status' => 'error',
                        'message' => "Error occuring while remove.",
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

    public function remove_from_cart()
    {
        try {
            $post = $this->request->getVar();
            $cart = explode("-",$post["cart_id"]);

            $model = new Cart;
            if($model->where("id",$cart[1])->delete()) {
                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => "Item deleted from cart.",
                    'count' => get_count('cart'),
                    'csrf' => csrf_hash()
                ]);
            } else {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => "Error occuring while deleting",
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

    public function cancel_order()
    {
        try {
            $post = $this->request->getVar();

            $model = new Order;
            $order = $model->select("id,customer_id,amount")->where("order_no",$post["order_no"])->first();
            if($model->set(["status" => 3,"cancelled_at" => date("Y-m-d H:i:s")])->where("order_no",$post["order_no"])->update()) {
                $model = new Payment_request;
                $insert_data = [
                    "order_id" => $order["id"],
                    "customer_id" => $order["customer_id"],
                    "amount" => $order["amount"],
                    "request_type" => 1,
                    "note" => "Order cancelled by customer",
                    "status" => 0,
                    "created_at" => date("Y-m-d H:i:s")
                ];
                $model->insert($insert_data);

                $_session = session();
                $_session->setFlashData("message","Order cancelled successfully.");
                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => "",
                    'csrf' => csrf_hash()
                ]);
            } else {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => "Error occuring while deleting",
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

    public function view_order_items()
    {
        try {
            $post = $this->request->getVar();

            $model = new Order;
            $data["order"] = $model->select("id,order_no")->where("order_no",$post["order_no"])->first();
            if($data["order"]) {
                $model = db_connect();
                $items = $model->table("bd_carts c");
                $items = $items->join("bd_products p","p.id=c.product_id");
                $items = $items->select("c.id,c.product_amt,c.product_discount_amt,c.quantity,p.name,p.avatar");
                $items = $items->where(["c.order_id" => $data["order"]["id"]]);
                $items = $items->orderBy("c.id","desc");
                $data["items"] = $items->get()->getResultArray();
                $html = view('customer/order_items',$data);

                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => "",
                    'html' => $html,
                    'csrf' => csrf_hash()
                ]);
            } else {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => "Error occuring while deleting",
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

    public function view_order($order_no)
    {
        $model = new Order;
        $data["order"] = $model->select("*")->where("order_no",$order_no)->first();
        if($data["order"]) {
            $_session = session();
            $customer = $_session->get('customerdata');

            $model = new Order_Delivery;
            $data["customer"] = $model->select("*")->where(["order_id" => $data["order"]["id"],"customer_id" => $customer["id"]])->first();

            $model = db_connect();
            $items = $model->table("bd_carts c");
            $items = $items->join("bd_products p","p.id=c.product_id");
            $items = $items->select("c.id,c.product_amt,c.product_discount_amt,c.quantity,p.name,p.avatar");
            $items = $items->where(["c.order_id" => $data["order"]["id"]]);
            $items = $items->orderBy("c.id","desc");
            $data["items"] = $items->get()->getResultArray();
            return view('customer/view_order',$data);
        } else {
            return redirect("my-orders");
        }
    }

    public function add_to_cart()
    {
        $post = $this->request->getVar();
        try {
            $model = new Product;
            $product = $model->select("id,price,discount_price,min_order,in_stock")->where(["slug" => $post["slug"],"deleted_by" => 0,"deleted_at" => null])->first();

            $_session = session();
            if($_session->get("customerdata")) {
                $customer = $_session->get('customerdata');
                if($product) {
                    $available_stock = productStock($product['id']);
                    $_quantity_stock = $available_stock; 

                    $min_order_excceed = 1;
                    $min_order = $product["min_order"];
                    if($post["min_order"] > 0) {
                        if($post["min_order"] < $product["min_order"]) {
                            $min_order_excceed = 0;
                        }
                        $min_order = $post["min_order"];
                    }
                    $where = ["order_id" => 0,"product_id" => $product["id"],"customer_id" => $customer["id"]];
                    $model = new Cart;
                    $_cart = $model->select("id,quantity")->where($where)->first();
                    if($_cart) {
                        $cart_stock = $_cart["quantity"]+$min_order;
                        $_quantity_stock = $available_stock - $_cart["quantity"];
                    } else {
                        $cart_stock = $min_order;
                    }
                    if($product["in_stock"] == 1 && $available_stock >= $cart_stock) {
                        $where = ["order_id" => 0,"product_id" => $product["id"],"customer_id" => $customer["id"]];
                        $model = new Cart;
                        $_cart = $model->select("id,quantity")->where($where)->first();
                        if($_cart) {
                            $model->update($_cart["id"],[
                                "quantity" => $_cart["quantity"]+$min_order,
                                "updated_by" => $customer["id"],
                                "updated_at" => date("Y-m-d H:i:s")
                            ]);
                            return $this->response->setJSON(['status' => 'success','message' => "Product added in your cart.","count" => get_count('cart'),'csrf' => csrf_hash()]);
                        } else {
                            if($min_order_excceed == 1) {
                                $model->insert([
                                    "product_id" => $product["id"],
                                    "product_amt" => $product["price"],
                                    "product_discount_amt" => $product["discount_price"],
                                    "quantity" => $min_order,
                                    "customer_id" => $customer["id"],
                                    "created_by" => $customer["id"],
                                    "created_at" => date("Y-m-d H:i:s")
                                ]);
                                return $this->response->setJSON([
                                    'status' => 'success',
                                    'message' => "Product added in your cart.",
                                    "count" => get_count('cart'),
                                    'csrf' => csrf_hash()
                                ]);
                            } else {
                                return $this->response->setJSON([
                                    'status' => 'error',
                                    'message' => "You need at least ".$product['min_order']." items to your cart to proceed.",
                                    'csrf' => csrf_hash()
                                ]);
                            }
                        }
                    } else {
                        return $this->response->setJSON([
                            'status' => 'error',
                            'message' => "Only ".$_quantity_stock." quantity is in stock.",
                            'csrf' => csrf_hash()
                        ]);
                    }
                }
            } else {
                if($product) {
                    $model = new Visitor;
                    $count = $model->where(["product_id" => $product["id"],"ip" => $this->request->getIPAddress()])->get()->getNumRows();
                    if($count == 0) {
                        $model->insert(["product_id" => $product["id"],"ip" => $this->request->getIPAddress(),"created_at" => date("Y-m-d H:i:s")]);
                    }
                }
                $_session->setFlashData("message","Please sign in to add to cart.");
                return $this->response->setJSON([
                    'status' => 'need_login',
                    'message' => "",
                    'href' => base_url('sign-in')
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

    public function my_cart()
    {
        $customer = customer_info();

        $model = db_connect();
        $products = $model->table("bd_carts c");
        $products = $products->join("bd_products p","p.id=c.product_id");
        $products = $products->join("bd_brands b","b.id=p.brand_id");
        $products = $products->join("bd_product_categories pc","pc.id=p.category_id");
        $products = $products->select("p.id,p.slug,p.name,p.avatar,p.price,p.discount_price,p.in_stock,p.min_order,c.quantity,c.id as cart_id");
        $products = $products->where(["p.is_active" => 1,"p.deleted_by" => 0,"b.is_active" => 1,"b.deleted_by" => 0,"pc.is_active" => 1,"pc.deleted_by" => 0,"c.order_id" => 0,"c.customer_id" => $customer["id"]]);
        $products = $products->orderBy("c.id","desc");
        $data["count"] = $products->get()->getNumRows();
        return view('customer/my_cart',$data);
    }

    public function my_cart_item()
    {
        try {
            $customer = customer_info();
            if(isset($customer["id"])) {
                $model = db_connect();
                $products = $model->table("bd_carts c");
                $products = $products->join("bd_products p","p.id=c.product_id");
                $products = $products->join("bd_brands b","b.id=p.brand_id");
                $products = $products->join("bd_product_categories pc","pc.id=p.category_id");
                $products = $products->select("p.id,p.slug,p.name,p.avatar,p.price,p.discount_price,p.in_stock,p.min_order,c.quantity,c.id as cart_id");
                $products = $products->where(["p.is_active" => 1,"p.deleted_by" => 0,"b.is_active" => 1,"b.deleted_by" => 0,"pc.is_active" => 1,"pc.deleted_by" => 0,"c.order_id" => 0,"c.customer_id" => $customer["id"]]);
                $products = $products->orderBy("c.id","desc");
                $data["products"] = $products->get()->getResultArray();
                
                $html = view("ajax/my_cart",$data);
                return $this->response->setJSON([
                    'status' => 'success',
                    'html' => $html
                ]);
            } else {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => $e->getMessage()
                ]);
            }
        } catch(\Throwable $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function update_cart()
    {
        try {
            $post = $this->request->getVar();

            $model = new Cart;
            $_cart = $model->select("id,product_id,quantity")->where("id",$post["cart_id"])->first();
            if($_cart) {
                $where = ["id" => $_cart["product_id"],"is_active" => 1,"deleted_by" => 0];
                $model = new Product;
                $product = $model->select("id,name,in_stock,min_order")->where($where)->first();
                if($product) {
                    $available_stock = productStock($product['id']);
                    $cart_stock = $post["quantity"];
                    $_quantity_stock = $available_stock;

                    if($product["in_stock"] == 1 && $available_stock >= $cart_stock) {
                        if((float) $post["quantity"] >= (float) $product["min_order"]) {
                            $model = new Cart;
                            if($model->update($post["cart_id"],["quantity" => $post["quantity"]])) {
                                return $this->response->setJSON([
                                    'status' => 'success',
                                    'message' => "Cart updated successfully.",
                                    'csrf' => csrf_hash()
                                ]);
                            } else {
                                return $this->response->setJSON([
                                    'status' => 'error',
                                    'message' => "Error while updating cart.",
                                    'csrf' => csrf_hash()
                                ]);
                            }
                        } else {
                            return $this->response->setJSON([
                                'status' => 'min_order_required',
                                'message' => "Min. quantity ".$product["min_order"]." is required.",
                                'min_qty' => $product["min_order"],
                                'csrf' => csrf_hash()
                            ]);
                        }    
                    } else {
                        return $this->response->setJSON([
                            'status' => 'out_of_stock',
                            'message' => "Only ".$_quantity_stock." quantity is in stock of ".$product['name'].".",
                            'min_qty' => $_cart["quantity"],
                            'csrf' => csrf_hash()
                        ]);
                    }
                } else {
                    return $this->response->setJSON([
                        'status' => 'not_found',
                        'message' => "Product not found.",
                        'csrf' => csrf_hash()
                    ]);    
                }
            } else {
                return $this->response->setJSON([
                    'status' => 'not_found',
                    'message' => "Item not found.",
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

    public function place_order()
    {
        try {
            $post = $this->request->getVar();
            if(trim($post["fname"]) == "") {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => "First Name is required.",
                    'input' => "fname",
                    'csrf' => csrf_hash()
                ]);
            } else if(trim($post["lname"]) == "") {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => "Last Name is required.",
                    'input' => "lname",
                    'csrf' => csrf_hash()
                ]);
            } else if(trim($post["region"]) == "") {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => "Region/state is required.",
                    'input' => "region",
                    'csrf' => csrf_hash()
                ]);
            } else if(trim($post["city"]) == "") {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => "City is required.",
                    'input' => "city",
                    'csrf' => csrf_hash()
                ]);
            } else if(trim($post["postcode"]) == "") {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => "Post Code is required.",
                    'input' => "postcode",
                    'csrf' => csrf_hash()
                ]);
            } else if(!validateUKPostcode(trim($post["postcode"]))) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => "Enter valid post code.",
                    'input' => "postcode",
                    'csrf' => csrf_hash()
                ]);
            } else if(trim($post["address"]) == "") {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => "Address is required.",
                    'input' => "address",
                    'csrf' => csrf_hash()
                ]);
            } else if(trim($post["shipping_fname"]) == "") {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => "First Name is required.",
                    'input' => "shipping_fname",
                    'csrf' => csrf_hash()
                ]);
            } else if(trim($post["shipping_lname"]) == "") {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => "Last Name is required.",
                    'input' => "shipping_lname",
                    'csrf' => csrf_hash()
                ]);
            } else if(trim($post["region"]) == "") {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => "Region/state is required.",
                    'input' => "shipping_region",
                    'csrf' => csrf_hash()
                ]);
            } else if(trim($post["shipping_city"]) == "") {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => "City is required.",
                    'input' => "shipping_city",
                    'csrf' => csrf_hash()
                ]);
            } else if(trim($post["shipping_postcode"]) == "") {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => "Post Code is required.",
                    'input' => "shipping_postcode",
                    'csrf' => csrf_hash()
                ]);
            } else if(!validateUKPostcode(trim($post["shipping_postcode"]))) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => "Enter valid post code.",
                    'input' => "shipping_postcode",
                    'csrf' => csrf_hash()
                ]);
            } else if(trim($post["shipping_phone"]) == "") {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => "Contact No. is required.",
                    'input' => "shipping_phone",
                    'csrf' => csrf_hash()
                ]);
            } else if(trim($post["shipping_address"]) == "") {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => "Address is required.",
                    'input' => "shipping_address",
                    'csrf' => csrf_hash()
                ]);
            } else {
                $customer = customer_info();
                $__amount = 0;

                $model = db_connect();
                $cart = $model->table("bd_carts c");
                $cart = $cart->join("bd_products p","p.id=c.product_id");
                $cart = $cart->join("bd_brands b","b.id=p.brand_id");
                $cart = $cart->join("bd_product_categories pc","pc.id=p.category_id");
                $cart = $cart->select("p.name,c.product_amt,c.product_discount_amt,c.quantity");
                $cart = $cart->where(["p.is_active" => 1,"p.deleted_by" => 0,"b.is_active" => 1,"b.deleted_by" => 0,"pc.is_active" => 1,"pc.deleted_by" => 0,"c.order_id" => 0,"c.customer_id" => $customer["id"]]);
                $cart = $cart->orderBy("c.id","desc");
                $items = $cart->get()->getResultArray();
                if($items) {
                    foreach ($items as $item) {
                        $amt = $item["product_discount_amt"] > 0 ? $item["product_discount_amt"] : $item["product_amt"];
                        $__amount = $__amount + ($amt*$item["quantity"]); 
                    }
                }
                $calc_charge = calc_charge($__amount);
                $shipping_charge = $calc_charge["shipping_charge"];
                $vat_charge = $calc_charge["vat_charge"];

                $order_no = time().$customer["id"];
                $insert_data = array(
                    "order_no" => $order_no,
                    "customer_id" => $customer["id"],
                    "amount" => $__amount,
                    "shipping_cost" => $shipping_charge,
                    "vat_charge" => $vat_charge,
                    "order_date" => date("Y-m-d"),
                    "status" => 0,
                    "customer_note" => $post["note"],
                    "created_by" => $customer["id"],
                    "created_at" => date("Y-m-d H:i:s")
                );
                $model = new Order;
                if($model->insert($insert_data)) {
                    $order_id = $model->getInsertID();

                    $model = new Order_Delivery;
                    $model->insert([
                        "order_id" => $order_id,
                        "customer_id" => $customer["id"],
                        "fname" => $post["fname"],
                        "lname" => $post["lname"],
                        "country" => "UK",
                        "region" => $post["region"],
                        "city" => $post["city"],
                        "postcode" => $post["postcode"],
                        "address" => $post["address"],
                        "shipping_fname" => $post["shipping_fname"],
                        "shipping_lname" => $post["shipping_lname"],
                        "shipping_country" => "UK",
                        "shipping_region" => $post["shipping_region"],
                        "shipping_city" => $post["shipping_city"],
                        "shipping_postcode" => $post["shipping_postcode"],
                        "shipping_address" => $post["shipping_address"],
                        "shipping_phone" => $post["shipping_phone"]
                    ]);

                    $model = new Cart;
                    $model->set(["order_id" => $order_id])->where(["order_id" => 0,"customer_id" => $customer["id"]])->update();

                    // Payment Gateway
                    $base_url = PAYPAL_LIVE_BASE_URL;
                    if(in_array($customer["email"],["vch242516@gmail.com"])) {
                        $base_url = PAYPAL_TEST_BASE_URL;
                    }
                    $accessToken = getAccessToken();
                    $orderData = [
                        "intent" => "CAPTURE",
                        "purchase_units" => [[
                            "amount" => [
                                "currency_code" => "GBP",
                                "value" => number_format($__amount,2)
                            ]
                        ]],
                        "application_context" => [
                            "return_url" => base_url('paypal/success?order_no='.$order_no),
                            "cancel_url" => base_url('paypal/cancel?order_no='.$order_no)
                        ]
                    ];

                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $base_url . '/v2/checkout/orders');
                    curl_setopt($ch, CURLOPT_HTTPHEADER, [
                        "Content-Type: application/json",
                        "Authorization: Bearer $accessToken"
                    ]);
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($orderData));
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                    $response = curl_exec($ch);
                    curl_close($ch);

                    $result = json_decode($response, true);
                    $approvalUrl = $result['links'][1]['href'] ?? null;

                    if ($approvalUrl) {
                        return $this->response->setJSON([
                            'status' => 'success',
                            'message' => "",
                            'redirect_url' => $approvalUrl
                        ]);
                    } else {
                        return $this->response->setJSON(['error' => 'Unable to create PayPal order', 'response' => $result]);
                    }

                    // $emaildata["customer_name"] = ucwords(strtolower($post["fname"]." ".$post["lname"]));
                    // $emaildata["customer_email"] = $customer["email"];
                    // $emaildata["customer_phone"] = $customer["phone"];
                    // $emaildata["order_id"] = $order_no;
                    // $emaildata["order_date"] = format_date(date("Y-m-d"));
                    // $emaildata["amount"] = ($__amount+$shipping_charge+$vat_charge);
                    // $emaildata["vat_charge"] = $vat_charge;
                    // $emaildata["shipping_charge"] = $shipping_charge;
                    // $emaildata["currency"] = currency();
                    // $emaildata["items"] = $items;
                    // $html = view("email/place_order",$emaildata);
                    // send_email(APP_EMAIL,"New Order Received",$html);

                    return $this->response->setJSON([
                        'status' => 'success',
                        'message' => "Order placed successfully.",
                        'redirect_url' => base_url("my-orders")
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

    public function my_refunds()
    {
        $_session = session();
        $customerdata = $_session->get('customerdata'); 

        $model = db_connect();
        $refunds = $model->table("bd_payment_requests pr");
        $refunds = $refunds->join("bd_orders o","o.id=pr.order_id");
        $refunds = $refunds->select("pr.*,o.order_no");
        $refunds = $refunds->where(["pr.customer_id" => $customerdata["id"],"request_type" => 1]);
        $refunds = $refunds->orderBy("pr.id","desc");
        $data["refunds"] = $refunds->get()->getResultArray();
        return view('customer/my_refunds',$data);
    }

    public function my_payment_requests()
    {
        $_session = session();
        $customerdata = $_session->get('customerdata'); 

        $model = db_connect();
        $payment_requests = $model->table("bd_payment_requests pr");
        $payment_requests = $payment_requests->join("bd_orders o","o.id=pr.order_id");
        $payment_requests = $payment_requests->select("pr.*,o.order_no");
        $payment_requests = $payment_requests->where(["pr.customer_id" => $customerdata["id"],"request_type" => 2]);
        $payment_requests = $payment_requests->orderBy("pr.id","desc");
        $data["payment_requests"] = $payment_requests->get()->getResultArray();
        return view('customer/my_payment_requests',$data);
    }

    public function pay_payment_requests($id)
    {
        $model = new Payment_request;
        $payment_request = $model->select("amount")->where("id",$id)->first();
        if($payment_request["amount"] > 0) {
            $amount = $payment_request["amount"];

            $_session = session();
            $customerdata = $_session->get('customerdata');
            $pg_id = time().$customerdata["id"];

            // Payment Gateway
            $base_url = PAYPAL_LIVE_BASE_URL;
            if(in_array($customerdata["email"],["vch242516@gmail.com"])) {
                $base_url = PAYPAL_TEST_BASE_URL;
            }
            $accessToken = getAccessToken();
            $orderData = [
                "intent" => "CAPTURE",
                "purchase_units" => [[
                    "amount" => [
                        "currency_code" => "GBP",
                        "value" => number_format($amount,2)
                    ]
                ]],
                "application_context" => [
                    "return_url" => base_url('paypal/payment-request-success?order_no='.$pg_id),
                    "cancel_url" => base_url('paypal/payment-request-cancel?order_no='.$pg_id)
                ]
            ];

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $base_url . '/v2/checkout/orders');
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                "Content-Type: application/json",
                "Authorization: Bearer $accessToken"
            ]);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($orderData));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($ch);
            curl_close($ch);

            $result = json_decode($response, true);
            $approvalUrl = $result['links'][1]['href'] ?? null;

            if ($approvalUrl) {
                $model = new Payment_request;
                $model->update($id,["pg_id" => $pg_id,"status" => 1,"updated_at" => date("Y-m-d H:i:s")]);

                return redirect()->to($approvalUrl);
            } else {
                return $this->response->setJSON(['error' => 'Unable to create PayPal order', 'response' => $result]);
            }
        }
    }

    public function return_order()
    {
        try {
            $post = $this->request->getVar();
            $_session = session();
            $customerdata = $_session->get('customerdata');
            
            $model = new Order;
            $data["order"] = $model->select("id,order_no")->where(["order_no" => $post["order_no"],"created_by" => $customerdata["id"]])->first();
            if($data["order"]) {
                $model = db_connect();
                $items = $model->table("bd_carts c");
                $items = $items->join("bd_products p","p.id=c.product_id");
                $items = $items->select("c.id,c.product_amt,c.product_discount_amt,c.quantity,p.id as product_id,p.name,p.avatar");
                $items = $items->where(["c.order_id" => $data["order"]["id"]]);
                $items = $items->orderBy("c.id","desc");
                $data["items"] = $items->get()->getResultArray();
                $html = view('customer/return_order_items',$data);

                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => "",
                    'html' => $html,
                    'csrf' => csrf_hash()
                ]);
            } else {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => "Order not found",
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

    public function submit_return_order()
    {
        try {
            $post = $this->request->getVar();
            $_session = session();
            $customerdata = $_session->get('customerdata');

            $uploadDir = "public/uploads/returned_order/";
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $images = array();
            if (!empty($_FILES['images']['name'][0])) {
                $no = 0;
                foreach ($_FILES['images']['name'] as $key => $name) {
                    $no++;

                    $fileName = time() . "_" . basename($name);
                    $target = $uploadDir . $fileName;
                    if (move_uploaded_file($_FILES['images']['tmp_name'][$key], $target)) {
                        $images[] = array("no" => time().$no,"avatar" => $fileName);
                    }
                }
            }
            if(empty($images)) {
                $images = "";
            } else {
                $images = json_encode($images);
            }

            $order_data = [
                "order_id" => $post["order_id"],
                "customer_id" => $customerdata["id"],
                "note" => $post["note"],
                "images" => $images,
                "status" => 0,
                "payment_status" => 0,
                "created_at" => date("Y-m-d H:i:s")
            ];
            $model = new Returned_order;
            if($model->insert($order_data)) {
                $returned_order_id = $model->getInsertID();

                $amount = 0;
                $count = count($post['price']);
                for($i = 0; $i < $count; $i ++) {
                    if(trim($post["entered_quantity"][$i]) != "" && trim($post["entered_quantity"][$i]) != "0") {
                        $amount = $amount + ($post["price"][$i]*$post["entered_quantity"][$i]);
                        $order_item_data = [
                            "returned_order_id" => $returned_order_id,
                            "product_id" => $post["product_id"][$i],
                            "quantity" => $post["quantity"][$i],
                            "entered_quantity" => $post["entered_quantity"][$i],
                            "amount" => $post["price"][$i],
                        ];
                        $model = new Returned_order_item;
                        $model->insert($order_item_data);
                    }
                }
                $model = new Returned_order;
                $model->update($returned_order_id,["amount" => $amount]);

                $model = new Order;
                $model->update($post["order_id"],["status" => 8]);

                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => "",
                    "href" => base_url("my-returned-orders"),
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

    public function my_returned_orders()
    {
        $_session = session();
        $customerdata = $_session->get('customerdata'); 

        $model = db_connect();
        $payment_requests = $model->table("bd_returned_orders ro");
        $payment_requests = $payment_requests->join("bd_orders o","o.id=ro.order_id");
        $payment_requests = $payment_requests->select("ro.*,o.order_no");
        $payment_requests = $payment_requests->where(["ro.customer_id" => $customerdata["id"]]);
        $payment_requests = $payment_requests->orderBy("ro.id","desc");
        $data["returned_orders"] = $payment_requests->get()->getResultArray();
        return view('customer/my_returned_orders',$data);
    }

    public function view_returned_order_items()
    {
        try {
            $post = $this->request->getVar();
            $_session = session();
            $customerdata = $_session->get('customerdata');
            
            $model = new Returned_order;
            $data["order"] = $model->where(["id" => $post["return_order_id"],"customer_id" => $customerdata["id"]])->first();
            if($data["order"]) {
                $model = new Order;
                $order = $model->select("order_no")->where(["id" => $data["order"]["order_id"]])->first();
                $data["order"]["order_no"] = $order["order_no"];

                $model = db_connect();
                $items = $model->table("bd_returned_order_items roi");
                $items = $items->join("bd_products p","p.id=roi.product_id");
                $items = $items->select("roi.*,p.id as product_id,p.name,p.avatar");
                $items = $items->where(["roi.returned_order_id" => $post["return_order_id"]]);
                $items = $items->orderBy("roi.id","asc");
                $data["items"] = $items->get()->getResultArray();
                $html = view('customer/returned_order_items',$data);

                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => "",
                    'html' => $html,
                    'csrf' => csrf_hash()
                ]);
            } else {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => "Order not found",
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
}
