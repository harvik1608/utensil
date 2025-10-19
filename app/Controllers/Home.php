<?php

namespace App\Controllers;

use App\Controllers\CommonController;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Faq;
use App\Models\Favourite;
use App\Models\Visitor;
use App\Models\Inquiry;
use App\Models\Banner;

class Home extends CommonController
{
    protected $helpers = ["custom"];

    public function index()
    {
        $model = db_connect();
        $products = $model->table("bd_products p");
        $products = $products->join("bd_brands b","b.id=p.brand_id");
        $products = $products->join("bd_product_categories pc","pc.id=p.category_id");
        $products = $products->select("p.id,p.slug,p.name,b.name AS brand,p.avatar,p.price,p.discount_price,p.description,pc.name AS category");
        $products = $products->where(["p.is_active" => 1,"p.deleted_by" => 0,"b.is_active" => 1,"b.deleted_by" => 0,"pc.is_active" => 1,"pc.deleted_by" => 0,"p.is_top_collection" => 1]);
        $data["products"] = $products->get()->getResultArray();

        $model = new Banner;
        $data["banners"] = $model->get()->getResultArray();
        return view('index',$data);
    }

    public function about_us()
    {
        $data["title"] = "About Us";
        $data["content"] = ABOUT_US;
        return view('content',$data);
    }

    public function return_policy()
    {
        $data["title"] = "Return Policy";
        $data["content"] = RETURN_POLICY;
        return view('content',$data);
    }

    public function privacy_policy()
    {
        $data["title"] = "Privacy Policy";
        $data["content"] = PRIVACY_POLICY;
        return view('content',$data);
    }

    public function term_conditions()
    {
        $data["title"] = "Terms & Conditions";
        $data["content"] = TERMS_AND_CONDITIONS;
        return view('content',$data);
    }

    public function shipping_policy()
    {
        $data["title"] = "Shipping Policy";
        $data["content"] = SHIPPING_POLICY;
        return view('content',$data);
    }

    public function all_products()
    {
        $data["search_text"] = isset($_GET["search_text"]) ? $_GET["search_text"] : "";
        $data["perPage"] = PER_PAGE;
        
        $model = new Category;
        $data["categories"] = $model->select("id,name")->where(["is_active" => 1,"deleted_by" => 0])->get()->getResultArray();

        $model = new Brand;
        $data["brands"] = $model->select("id,name")->where(["is_active" => 1,"deleted_by" => 0])->get()->getResultArray();

        $model = new Product;
        $max_price = $model->selectMax("price")->first();
        if(isset($max_price["price"])) {
            $data["max_price"] = $max_price["price"];   
        } else {
            $data["max_price"] = 0;
        }
        $min_price = $model->selectMin("price")->first();
        if(isset($min_price["price"])) {
            $data["min_price"] = $min_price["price"];   
        } else {
            $data["min_price"] = 0;
        }
        $model = db_connect();
        $products = $model->table("bd_products p");
        $products = $products->join("bd_brands b","b.id=p.brand_id");
        $products = $products->join("bd_product_categories pc","pc.id=p.category_id");
        $products = $products->select("p.id,p.slug,p.name,b.name AS brand,p.avatar,p.price,p.discount_price,p.description,pc.name AS category");
        $products = $products->where(["p.is_active" => 1,"p.deleted_by" => 0,"b.is_active" => 1,"b.deleted_by" => 0,"pc.is_active" => 1,"pc.deleted_by" => 0]);
        $total_products = $products->get()->getNumRows();

        return view('all_products',$data);
    }

    public function category_search($slug)
    {
        $data["perPage"] = PER_PAGE;

        $model = new Category;
        $data["category"] = $model->select("id")->where(["is_active" => 1,"deleted_by" => 0,"slug" => $slug])->first();
        if($data["category"]) {
            $data["categories"] = $model->select("id,name")->where(["is_active" => 1,"deleted_by" => 0])->get()->getResultArray();

            $model = new Brand;
            $data["brands"] = $model->select("id,name")->where(["is_active" => 1,"deleted_by" => 0])->get()->getResultArray();

            $model = new Product;
            $max_price = $model->selectMax("price")->first();
            if(isset($max_price["price"])) {
                $data["max_price"] = $max_price["price"];   
            } else {
                $data["max_price"] = 0;
            }
            $min_price = $model->selectMin("price")->first();
            if(isset($min_price["price"])) {
                $data["min_price"] = $min_price["price"];   
            } else {
                $data["min_price"] = 0;
            }
            $total_products = $model->where(["is_active" => 1,"deleted_by" => 0,"category_id" => $data["category"]["id"]])->get()->getNumRows();

            return view('all_products',$data);
        } else {
            return redirect(base_url());
        }
    }

    public function brand_search($slug)
    {
        $data["perPage"] = PER_PAGE;
        
        $model = new Brand;
        $data["brand"] = $model->select("id")->where(["is_active" => 1,"deleted_by" => 0,"slug" => $slug])->first();
        if($data["brand"]) {
            $data["categories"] = $model->select("id,name")->where(["is_active" => 1,"deleted_by" => 0])->get()->getResultArray();

            $model = new Brand;
            $data["brands"] = $model->select("id,name")->where(["is_active" => 1,"deleted_by" => 0])->get()->getResultArray();

            $model = new Product;
            $max_price = $model->selectMax("price")->first();
            if(isset($max_price["price"])) {
                $data["max_price"] = $max_price["price"];   
            } else {
                $data["max_price"] = 0;
            }
            $min_price = $model->selectMin("price")->first();
            if(isset($min_price["price"])) {
                $data["min_price"] = $min_price["price"];   
            } else {
                $data["min_price"] = 0;
            }
            return view('all_products',$data);
        } else {
            return redirect(base_url());
        }
    }

    public function load_all_products()
    {
        try {
            $post = $this->request->getVar();
            
            $__page = $post["page"];
            $_limit = PER_PAGE;
            $offset = ($__page*1) * $_limit; 

            $model = db_connect();
            $products = $model->table("bd_products p");
            $products = $products->join("bd_brands b","b.id=p.brand_id");
            $products = $products->join("bd_product_categories pc","pc.id=p.category_id");
            $products = $products->select("p.id,p.slug,p.name,b.name AS brand,p.avatar,p.price,p.discount_price,p.description,pc.name AS category");
            $products = $products->where(["p.is_active" => 1,"p.deleted_by" => 0,"b.is_active" => 1,"b.deleted_by" => 0,"pc.is_active" => 1,"pc.deleted_by" => 0]);
            if(!empty($post["search_text"])) {
                $products = $products->where("p.name LIKE '".$post["search_text"]."%'");
            }
            if(isset($post["categories"]) && !empty($post["categories"])) {
                $products = $products->whereIn("p.category_id",$post["categories"]);
            }
            if(isset($post["brands"]) && !empty($post["brands"])) {
                $products = $products->whereIn("p.brand_id",$post["brands"]);
            }
            if(isset($post["minPrice"]) && $post["minPrice"] > 0) {
                $products = $products->where("p.price >=",$post["minPrice"]);
            }
            if(isset($post["minPrice"]) && $post["maxPrice"] > 0) {
                $products = $products->where("p.price <=",$post["maxPrice"]);
            }
            if(isset($post["sortBy"])) {
                switch($post["sortBy"]) {
                    case "1":
                        $products = $products->orderBy("p.name","ASC");
                        break;

                    case "2":
                        $products = $products->orderBy("p.name","DESC");
                        break;

                    case "3":
                        $products = $products->orderBy("p.price","ASC");
                        break;

                    case "4":
                        $products = $products->orderBy("p.price","DESC");
                        break;

                    default:
                        $products = $products->orderBy("p.id","DESC");
                        break;
                }
            }
            $totalProducts = clone $products;
            $total_count = $totalProducts->countAllResults(false);

            $products = $products->limit($_limit,$offset);
            $data["products"] = $products->get()->getResultArray();

            $html = view('ajax/all_product_listing',$data);
            return $this->response->setJSON(['status' => 'success','html' => $html,"total_count" => $total_count]);
        } catch(\Throwable $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $e->getMessage(),
                'csrf' => csrf_hash()
            ]);
        }
    }

    public function search($slug)
    {
        $session = session();

        $model = db_connect();
        $product = $model->table("bd_products p");
        $product = $product->join("bd_brands b","b.id=p.brand_id");
        $product = $product->join("bd_product_categories pc","pc.id=p.category_id");
        $product = $product->select("p.id,p.slug,p.name,p.code,p.min_order,p.category_id,p.photos,p.in_stock,p.sku,p.product_condition,p.barcode,p.reference,b.name AS brand,p.avatar,p.price,p.discount_price,p.description,pc.name AS category,p.sub_category_id,p.video");
        $product = $product->where(["p.slug" => $slug,"p.is_active" => 1,"p.deleted_by" => 0,"b.is_active" => 1,"b.deleted_by" => 0,"pc.is_active" => 1,"pc.deleted_by" => 0]);
        $data["product"] = $product->get()->getRowArray();
        if($data["product"]) {
            $other_product = $model->table("bd_products p");
            $other_product = $other_product->join("bd_brands b","b.id=p.brand_id");
            $other_product = $other_product->join("bd_product_categories pc","pc.id=p.category_id");
            $other_product = $other_product->select("p.id,p.slug,p.name,p.code,p.min_order,p.category_id,p.in_stock,p.sku,p.product_condition,p.barcode,p.reference,b.name AS brand,p.avatar,p.price,p.discount_price,p.description,pc.name AS category");
            $other_product = $other_product->where(["p.category_id" => $data["product"]["category_id"],"p.id !=" => $data["product"]["id"],"p.is_active" => 1,"p.deleted_by" => 0,"b.is_active" => 1,"b.deleted_by" => 0,"pc.is_active" => 1,"pc.deleted_by" => 0]);
            $other_product = $other_product->limit(4);
            $data["other_products"] = $other_product->get()->getResultArray();

            $data["is_favourite"] = 0;
            if($session->get("customerdata")) {
                $customerdata = $session->get("customerdata");

                $model = new Favourite;
                $data["is_favourite"] = $model->where(["product_id" => $data["product"]["id"],"customer_id" => $customerdata["id"]])->get()->getNumRows();
            }
            $data["product"]["sub_category"] = "-";
            $model = new Category;
            $category = $model->select("name")->where("id",$data["product"]["sub_category_id"])->first();
            if($category) {
                $data["product"]["sub_category"] = $category["name"];
            }
            return view('product',$data);
        } else {
            return redirect("all-products");
        }
    }

    public function all_faqs()
    {
        $model = new Faq;
        $data["faqs"] = $model->select("id,query,answer")->where(["is_active" => 1,"deleted_by" => 0])->get()->getResultArray();
        return view('faq',$data);
    }

    public function recently_visited()
    {
        $_date = date("Y-m-d H:i:s",strtotime("-10 minute"));

        $model = db_connect();
        $products = $model->table("bd_visitors v");
        $products = $products->join("bd_products p","p.id=v.product_id");
        $products = $products->join("bd_brands b","b.id=p.brand_id");
        $products = $products->join("bd_product_categories pc","pc.id=p.category_id");
        $products = $products->select("p.id,p.slug,p.name,b.name AS brand,p.avatar,p.price,p.discount_price,pc.name AS category");
        $products = $products->where(["p.is_active" => 1,"p.deleted_by" => 0,"b.is_active" => 1,"b.deleted_by" => 0,"pc.is_active" => 1,"pc.deleted_by" => 0,"v.ip" => $this->request->getIPAddress(),"v.created_at >=" => $_date]);
        $products = $products->orderBy("id","desc");
        $data["products"] = $products->get()->getResultArray();
        return view('recently_visited',$data);
    }

    public function all_categories()
    {
        return view('all_categories');
    }

    public function contact_us()
    {
        return view('contact_us');
    }

    public function submit_inquiry()
    {
        try {
            // if ($this->request->getPost('website') != '') {
                $recaptchaResponse = $this->request->getPost('g-recaptcha-response');
                $secret = "6Ld5Je0rAAAAAJUQ2lwUG0dNt2Z36bLnHSbUaNTh";
                $verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$recaptchaResponse}");
                $responseData = json_decode($verify);

                $post = $this->request->getVar();
                if(trim($post["fname"]) == "") {
                    return $this->response->setJSON(['status' => 'error','message' => "First Name is required.",'input' => "fname",'csrf' => csrf_hash()]);
                } else if(trim($post["lname"]) == "") {
                    return $this->response->setJSON(['status' => 'error','message' => "Last Name is required.",'input' => "lname",'csrf' => csrf_hash()]);
                } else if(trim($post["email"]) == "") {
                    return $this->response->setJSON(['status' => 'error','message' => "Email is required.",'input' => "email",'csrf' => csrf_hash()]);
                } else if(trim($post["phone"]) == "") {
                    return $this->response->setJSON(['status' => 'error','message' => "Phone Number is required.",'input' => "phone",'csrf' => csrf_hash()]);
                } else if(trim($post["comment"]) == "") {
                    return $this->response->setJSON(['status' => 'error','message' => "Comment is required.",'input' => "comment",'csrf' => csrf_hash()]);
                } else if(!$responseData->success) {
                    return $this->response->setJSON([
                        'status' => 'error',
                        'message' => "reCAPTCHA verification failed",
                        'csrf' => csrf_hash()
                    ]);
                } else {
                    $post["name"] = $post["fname"]." ".$post["lname"];
                    $post["ip_address"] = $this->request->getIPAddress();
                    $post["created_at"] = date("Y-m-d H:i:s");
                    $model = new Inquiry;
                    if($model->insert($post)) {
                        $html = view("email/inquiry_form",$post);
                        send_email("vch242516@gmail.com","New Inquiry Received",$html);

                        return $this->response->setJSON([
                            'status' => 'success',
                            'message' => "Inquiry sent successfully.",
                            'csrf' => csrf_hash()
                        ]);
                    }
                }
            // }
        } catch(\Throwable $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $e->getMessage(),
                'csrf' => csrf_hash()
            ]);
        }
    }

    public function lookup($ip = '223.178.118.125')
    {
        $url = "http://ip-api.com/json/{$ip}?fields=status,message,country,regionName,city,zip,lat,lon,timezone,isp,org,as,query";
        $client = \Config\Services::curlrequest();
        $response = $client->get($url);
        if ($response->getStatusCode() !== 200) {
            return $this->response->setJSON(['error' => 'API request failed'])->setStatusCode(502);
        }

        $data = json_decode($response->getBody(), true);

        if (empty($data) || (isset($data['status']) && $data['status'] !== 'success')) {
            return $this->response->setJSON(['error' => $data['message'] ?? 'Lookup failed'])->setStatusCode(404);
        }

        // Example: sanitize/format
        $result = [
            'ip'      => $data['query'] ?? $ip,
            'country' => $data['country'] ?? null,
            'region'  => $data['regionName'] ?? null,
            'city'    => $data['city'] ?? null,
            'zip'     => $data['zip'] ?? null,
            'lat'     => $data['lat'] ?? null,
            'lon'     => $data['lon'] ?? null,
            'timezone'=> $data['timezone'] ?? null,
            'isp'     => $data['isp'] ?? null,
            'org'     => $data['org'] ?? null,
            'as'      => $data['as'] ?? null,
        ];

        echo "<pre>";
        print_r ($this->response->setJSON($result));
        exit;
    }
}
