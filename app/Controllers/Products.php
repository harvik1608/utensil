<?php

namespace App\Controllers;

use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;

class Products extends BaseController
{
    protected $session;
    protected $helpers = ["custom"];

    public function __construct()
    {
        $this->session = session();
    }

    public function index()
    {
        if(!check_permission('product')) {
            return redirect('dashboard');
        }
        return view('admin/product/list');
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
        $builder = $db->table('bd_products p');
        $builder->select("p.id,p.name,c.name as category,p.price,p.in_stock,p.is_top_collection,p.is_active");
        $builder->join("bd_product_categories c","c.id=p.category_id");
        $builder->where('p.deleted_by', 0);
        $builder->where('c.deleted_by', 0);
        $builder->where('c.is_active', 1);
        if (!empty($searchValue)) {
            $builder->groupStart()->like('p.name', $searchValue)->orLike('p.price', $searchValue)->orLike('c.name', $searchValue)->groupEnd();
        }
        $countBuilder = clone $builder;
        $totalRecords = $countBuilder->countAllResults(false);
        $builder->orderBy($orderBy, $orderDir);
        $builder->limit($length, $start);
        $results = $builder->get()->getResultArray();
        foreach ($results as $key => $val) {
            $_editUrl = base_url("products/" . $val["id"] . "/edit");
            $trashUrl = base_url("products/" . $val["id"]);

            switch($val['is_active']) {
                case 1:
                    $status = '<span class="badge bg-success">Active</span>';
                    break;

                default:
                    $status = '<span class="badge bg-danger">Inactive</span>';
                    break;
            }
            switch($val['in_stock']) {
                case 1:
                    $in_stock = '<span class="badge bg-success">In Stock</span>';
                    break;

                default:
                    $in_stock = '<span class="badge bg-danger">Out of Stock</span>';
                    break;
            }
            switch($val['is_top_collection']) {
                case 1:
                    $is_top_collection = '<span class="badge bg-success">Yes</span>';
                    break;

                default:
                    $is_top_collection = '<span class="badge bg-danger">No</span>';
                    break;
            }

            $buttons = "";
            $buttons .= '<a href="'.$_editUrl.'"><i class="icon-base bx bx-edit icon-sm"></i></a>&nbsp;';
            $buttons .= '<a href="javascript:;" onclick=remove_row("'.$trashUrl.'")><i class="icon-base bx bx-trash icon-sm"></i></a>';
            
            $result['data'][$key] = [
                ($key + 1),
                $val['name'],
                $val['category'],
                currency()." ".$val['price'],
                $in_stock,
                $is_top_collection,
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
        if(!check_permission('product')) {
            return redirect('dashboard');
        }
        $data["product"] = array();

        $model = new Category;
        $data["categories"] = $model->select("id,name")->where(["is_active" => 1,"category_id" => 0,"deleted_by" => 0])->orderBy("name","asc")->get()->getResultArray();

        $model = new Brand;
        $data["brands"] = $model->select("id,name")->where(["is_active" => 1,"deleted_by" => 0])->orderBy("name","asc")->get()->getResultArray();

        return view('admin/product/add_edit',$data);    
    }

    public function create()
    {
        try {
            $post = $this->request->getVar();

            $default_avatar = "";
            $photos = [];
            $files = $this->request->getFiles();
            if ($files && isset($files['photos'])) {
                $no = 0;
                foreach ($files['photos'] as $file) {
                    if ($file->isValid() && !$file->hasMoved()) {
                        $no++;
                        $avatar = $file->getRandomName();
                        $file->move(FCPATH . 'public/uploads/product', $avatar);
                        $photos[] = ["no" => time()."".$no,"avatar" => $avatar,"is_default" => $no == 1 ? 1 : 0];
                        if($no == 1) {
                            $default_avatar = $avatar;
                        }
                    }
                }
            }
            if(empty($photos)) {
                $photos = "";
            } else {
                $photos = json_encode($photos);
            }
            $video = "";
            $file = $this->request->getFile('video');
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $video = $file->getRandomName();
                $file->move(FCPATH . 'public/uploads/product/video', $video);
            }
            $userdata = $this->session->get("userdata");
            $insert_data = [
                "slug" => slug($post["name"]),
                "name" => $post["name"],
                "code" => $post["code"],
                "category_id" => $post["category_id"],
                "sub_category_id" => $post["sub_category_id"],
                "brand_id" => $post["brand_id"],
                "price" => $post["price"],
                "discount_price" => $post["discount_price"],
                "sku" => $post["sku"],
                "reference" => $post["reference"],
                "product_condition" => $post["product_condition"],
                "barcode" => $post["barcode"],
                "min_order" => $post["min_order"],
                "description" => $post["description"],  
                "in_stock" => $post["in_stock"],
                "stock" => $post["stock"],
                "avatar" => $default_avatar,
                "video" => $video,
                "photos" => $photos,
                "is_top_collection" => $post["is_top_collection"],
                "is_active" => $post["is_active"],
                "created_by" => $userdata["id"],
                "created_at" => date("Y-m-d H:i:s")
            ];
            $model = new Product;
            $model->insert($insert_data);

            $this->session->setFlashData('success_message',"Product added successfully.");
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
        if(!check_permission('product')) {
            return redirect('dashboard');
        }
        $model = new Product;
        $data["product"] = $model->where(["deleted_by" => 0,"id" => $id])->first();
        if(!$data["product"]) {
            return redirect('products');
        }
        $model = new Category;
        $data["categories"] = $model->select("id,name")->where(["is_active" => 1,"category_id" => 0,"deleted_by" => 0])->orderBy("name","asc")->get()->getResultArray();

        $model = new Brand;
        $data["brands"] = $model->select("id,name")->where(["is_active" => 1,"deleted_by" => 0])->orderBy("name","asc")->get()->getResultArray();

        return view('admin/product/add_edit',$data);
    }

    public function update($id)
    {
        try {
            $post = $this->request->getVar();

            $default_avatar = "";
            $photos = [];
            $model = new Product;
            $product = $model->select("photos")->where("id",$id)->first();
            if($product && $product["photos"] != "") {
                $photos = json_decode($product["photos"],true);
            }
            
            $files = $this->request->getFiles();
            if ($files && isset($files['photos'])) {
                $no = 0;
                foreach ($files['photos'] as $file) {
                    if ($file->isValid() && !$file->hasMoved()) {
                        $no++;
                        $avatar = $file->getRandomName();
                        $file->move(FCPATH . 'public/uploads/product', $avatar);
                        if(empty($photos) && $no == 1) {
                            $default_avatar = $avatar;
                        }
                        $photos[] = ["no" => time()."".$no,"avatar" => $avatar,"is_default" => empty($photos) && $no == 1 ? 1 : 0];
                    }
                }
            }
            if(empty($photos)) {
                $photos = "";
            } else {
                $photos = json_encode($photos);
            }
            $video = $post["old_video"];
            $file = $this->request->getFile('video');
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $video = $file->getRandomName();
                $file->move(FCPATH . 'public/uploads/product/video', $video);
                if($post["old_video"] != "" && file_exists(FCPATH.'public/uploads/product/video/'.$post["old_video"])) {
                    unlink(FCPATH.'public/uploads/product/video/'.$post["old_video"]);
                }
            }
            $userdata = $this->session->get("userdata");
            $update_data = [
                "slug" => slug($post["name"]),
                "name" => $post["name"],
                "code" => $post["code"],
                "category_id" => $post["category_id"],
                "sub_category_id" => $post["sub_category_id"],
                "brand_id" => $post["brand_id"],
                "price" => $post["price"],
                "discount_price" => $post["discount_price"],
                "sku" => $post["sku"],
                "reference" => $post["reference"],
                "product_condition" => $post["product_condition"],
                "barcode" => $post["barcode"],
                "min_order" => $post["min_order"],
                "description" => $post["description"],  
                "in_stock" => $post["in_stock"],
                "stock" => $post["stock"], 
                "photos" => $photos,
                "video" => $video,
                "is_top_collection" => $post["is_top_collection"],
                "is_active" => $post["is_active"],
                "updated_by" => $userdata["id"],
                "updated_at" => date("Y-m-d H:i:s")
            ];
            if($default_avatar != "") {
                $update_data["avatar"] = $default_avatar;
            }
            $model->update($id,$update_data);

            $this->session->setFlashData('success_message',"Product updated successfully.");
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
            $model = new Product;
            $model->update($id,$update_data);

            $this->session->setFlashData('success_message',"Product deleted successfully.");
            return $this->response->setJSON(['status' => 'success']);
        } catch(\Throwable $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $e->getMessage(),
                'csrf' => csrf_hash()
            ]);
        }
    }

    public function set_product_photo($no,$id)
    {
        try {
            $model = new Product;
            $product = $model->select("photos")->where("id",$id)->first();
            if($product && $product["photos"] != "") {
                $photos = json_decode($product["photos"],true);
                if(!empty($photos)) {
                    $avatar = "";
                    foreach($photos as $key => $val) {
                        if($val["no"] == $no) {
                            $avatar = $val["avatar"];
                            $photos[$key]["is_default"] = 1;
                        } else {
                            $photos[$key]["is_default"] = 0;
                        }
                    }
                    $model = new Product;
                    $model->update($id,["avatar" => $avatar,"photos" => json_encode($photos)]);

                    $this->session->setFlashData('success_message',"Photo set successfully.");
                    return redirect()->to("products/$id/edit");
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

    public function remove_product_photo($no,$id)
    {
        try {
            $model = new Product;
            $product = $model->select("photos")->where("id",$id)->first();
            if($product && $product["photos"] != "") {
                $photos = json_decode($product["photos"],true);
                if(!empty($photos)) {
                    foreach($photos as $key => $val) {
                        if($val["no"] == $no) {
                            remove_file($val["avatar"],"product");
                            unset($photos[$key]);
                        }
                    }
                    $photos = array_values($photos);
                    $model = new Product;
                    $model->update($id,["photos" => json_encode($photos)]);

                    $this->session->setFlashData('success_message',"Photo removed successfully.");
                    return redirect()->to("products/$id/edit");
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
}
