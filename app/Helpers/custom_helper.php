<?php 
	use App\Models\General_setting;
	use App\Models\Page_setting;
	use App\Models\User;
	use App\Models\Category;
	use App\Models\Brand;
	use App\Models\Product;
	use App\Models\Favourite;
	use App\Models\Cart;
	use App\Models\Customer;
	use App\Models\Bd_email;
	use App\Models\Order;

	function preview($data) 
	{
		echo "<pre>";
		print_r ($data);
		exit;
	}

	function general_setting($key)
	{
		$_obj = new General_setting;
		$_row = $_obj->where("setting_key",$key)->first();
		if($_row) {
			return $_row["setting_val"];
		} else {
			return "";
		}
	}

	function page_setting($key)
	{
		$_obj = new Page_setting;
		$_row = $_obj->where("setting_key",$key)->first();
		if($_row) {
			return $_row["setting_val"];
		} else {
			return "";
		}
	}

	function slug($string)
	{
	    // Convert to lowercase
	    $slug = strtolower($string);

	    // Remove special characters
	    $slug = preg_replace('/[^a-z0-9\s-]/', '', $slug);

	    // Replace spaces and underscores with hyphens
	    $slug = preg_replace('/[\s_]+/', '-', $slug);

	    // Remove multiple hyphens
	    $slug = preg_replace('/-+/', '-', $slug);

	    // Trim hyphens from start and end
	    $slug = trim($slug, '-');

	    return $slug;
	}

	function check_permission($module)
	{
		$session = session();
		$userdata = $session->get('userdata');
		if($userdata['role'] == 1) {
			return true;
		} else {
			$model = new User;
			$udata = $model->select("permissions")->where('id',$userdata["id"])->first();
			if($udata) {
				if($udata["permissions"] != "") {
					$permissions = explode(",", $udata["permissions"]);
					if(in_array($module,$permissions)) {
						return true;
					} else {
						return false;
					}
				} else {
					return false;
				}
			} else {
				return false;
			}
		}
	}

	function remove_file($file,$folder)
	{
		if($file != "" && file_exists("public/uploads/".$folder."/".$file)) {
			unlink("public/uploads/".$folder."/".$file);
		}
	}

	function format_date($date)
	{
		return date("d M, Y",strtotime($date));
	}

	function currency()
	{
		return "£";
	}

	function fetch_categories($is_child = 0)
	{
		$model = new Category;
		if($is_child == 0) {
			$_rows = $model->select("id,slug,name,avatar")->where(["is_active" => 1,"deleted_by" => 0,"category_id" => 0])->orderBy("orderBy","asc")->get()->getResultArray();
		} else {
			$_rows = $model->select("id,slug,name,avatar")->where(["is_active" => 1,"deleted_by" => 0,"category_id" => 0])->orderBy("orderBy","asc")->get()->getResultArray();
			if($_rows) {
				$model = new Product;
				foreach($_rows as $key => $val) {
					$products = $model->select("id,slug,name")->where(["is_active" => 1,"deleted_by" => 0,"category_id" => $val["id"]])->get()->getResultArray();
					if($products) {
						$_rows[$key]["products"] = $products;
					} else {
						$_rows[$key]["products"] = [];
					}
				}
			}
		}
		return $_rows;
	}

	function fetch_brands($is_child = 0)
	{
		$model = new Brand;
		if($is_child == 0) {
			$_rows = $model->select("id,slug,name")->where(["is_active" => 1,"deleted_by" => 0])->orderBy("orderBy","asc")->get()->getResultArray();
		} else {
			$_rows = $model->select("id,slug,name")->where(["is_active" => 1,"deleted_by" => 0])->orderBy("orderBy","asc")->get()->getResultArray();
			if($_rows) {
				$model = new Product;
				foreach($_rows as $key => $val) {
					$products = $model->select("id,slug,name")->where(["is_active" => 1,"deleted_by" => 0,"brand_id" => $val["id"]])->limit(5)->get()->getResultArray();
					if($products) {
						$_rows[$key]["products"] = $products;
					} else {
						$_rows[$key]["products"] = [];
					}
				}
			}
		}
		return $_rows;
	}

	function fetch_products($is_child = 0)
	{
		$model = new Product;
		$products = $model->select("*")->where(["is_active" => 1,"deleted_by" => 0])->get()->getResultArray();
		return $products;
	}

	function send_email($to,$subject,$message)
	{
		// preview(SMTP_FROM_NAME);
		// mail: embellishlondon@gmail.com
		// name: Embellish beauty
		// Pass: sypjgqejcdhhgwjy
		// host: smtp.gmail.com
		$model = new Bd_email;
		$model->insert(["email" => $to,"message" => $message,"created_at" => date("Y-m-d H:i:s")]);
		$last_id = $model->getInsertID();

	    $config = [
            'protocol'    => 'smtp',
            'SMTPHost'    => SMTP_HOST,
            'SMTPUser'    => SMTP_FROM_EMAIL,
            'SMTPPass'    => SMTP_PASSWORD,
            'SMTPPort'    => 587,
            'SMTPCrypto'  => 'tls',
            'mailType'    => 'html',
            'charset'     => 'utf-8',
        ];
        $email = \Config\Services::email();
        $email->initialize($config);
        $email->setFrom(SMTP_FROM_EMAIL, SMTP_FROM_NAME);
        $email->setTo($to);
        $email->setSubject($subject);
        $email->setMessage($message);
        if ($email->send()) {
        	$model->set(["is_sent" => 1])->where("id",$last_id)->update();
            return 200;
        } else {
            echo $email->printDebugger(['headers']);
        }
	}

	function send_admin_email($to,$subject,$message)
	{
		// preview(SMTP_FROM_NAME);
		// mail: embellishlondon@gmail.com
		// name: Embellish beauty
		// Pass: sypjgqejcdhhgwjy
		// host: smtp.gmail.com
	    $config = [
            'protocol'    => 'smtp',
            'SMTPHost'    => general_setting('smtp_host'),
            'SMTPUser'    => general_setting('smtp_from_email'),
            'SMTPPass'    => general_setting('smtp_password'),
            'SMTPPort'    => 587,
            'SMTPCrypto'  => 'tls',
            'mailType'    => 'html',
            'charset'     => 'utf-8',
        ];
        $email = \Config\Services::email();
        $email->initialize($config);
        $email->setFrom(general_setting('smtp_from_email'), general_setting('smtp_from_name'));
        $email->setTo($to);
        $email->setSubject($subject);
        $email->setMessage($message);
        if ($email->send()) {
            return 200;
        } else {
            echo $email->printDebugger(['headers']);
        }
	}

	function get_count($type)
	{
		$count = 0;
		$session = session();
		if($session->get("customerdata")) {
			$session_data = $session->get("customerdata");
			if($type == "wishlist") {
				$model = new Favourite;
				$count = $model->where("customer_id",$session_data["id"])->get()->getNumRows(); 
			} else {
				$model = new Cart;
				$count = $model->where(["order_id" => 0,"customer_id" => $session_data["id"]])->get()->getNumRows();
			}
		}
		return $count;
	}

	function customer_info()
	{
		$_ret_arr = [];
		$_session = session();
		$session_data = $_session->get("customerdata");
		if($session_data) {
			$model = new Customer;
			$customer = $model->where(["id" => $session_data["id"],"is_active" => 1,"deleted_by" => 0])->first();
			if($customer) {
				$_ret_arr = $customer;
			}
		}
		return $_ret_arr;
	}

	function order_status($status,$format = 0)
	{
		if($format == 0) {
			switch($status) {
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
		} else {
			switch($status) {
				case 0:
	               	$status = 'Order Placed';
	               	break;

	          	case 1:
	                $status = 'Order Shipped';
	               	break;

	           	case 2:
	               	$status = 'On The Way';
	               	break;

	           	case 3:
	               	$status = 'Cancelled By Customer';
	               	break;

	           	case 4:
	               	$status = 'Cancelled By Us';
	               	break;

	           	case 5:
	               	$status = 'Reached at Your City';
	               	break;

	           	case 6:
	               	$status = 'Out of Delivery';
	               	break;

	           	case 7:
	               	$status = 'Delivered';
	               	break;

	           	case 8:
	               	$status = 'Returned Order';
	               	break;
			}
		}
		return $status;
	}

	function calc_charge($total)
	{
		$shipping_charge = SHIPPING_CHARGE;
		if($total >= SHIPPING_CHARGE) {
			$shipping_charge = 0;
		}
		$vat_charge = (VAT_CHARGE*$total)/100;
		return array("shipping_charge" => $shipping_charge,"vat_charge" => $vat_charge);
	}

	function validateUKPostcode($postcode) 
	{
	    // Clean input
	    $postcode = strtoupper(trim($postcode));
	    $postcode = preg_replace('/\s+/', '', $postcode);

	    // Special case: GIR 0AA
	    if ($postcode === 'GIR0AA') {
	        return 'GIR 0AA';
	    }

	    // BFPO (British Forces Post Office)
	    if (preg_match('/^BFPO\d{1,4}$/', $postcode)) {
	        return 'BFPO ' . substr($postcode, 4);
	    }

	    // UK postcode regex (official format)
	    $pattern = '/^(?:[A-PR-UWYZ][A-HK-Y]?\d[\dA-HJKSTUW]?)(\d[ABD-HJLNP-UW-Z]{2})$/';

	    if (preg_match($pattern, $postcode)) {
	        // Format: insert a space before last 3 characters
	        return substr($postcode, 0, -3) . ' ' . substr($postcode, -3);
	    }
	    return false; // Not valid
	}

	function getAccessToken()
    {
    	// $base_url = PAYPAL_LIVE_BASE_URL;
    	// $client_id = PAYPAL_CLIENT_ID;
    	// $client_secret_key = PAYPAL_CLIENT_SECRET_KEY;
    	$base_url = PAYPAL_TEST_BASE_URL;
		$client_id = PAYPAL_TEST_CLIENT_ID;
		$client_secret_key = PAYPAL_TEST_CLIENT_SECRET_KEY;
    	// $customer = customer_info();
    	// if(in_array($customer["email"],["vch242516@gmail.com"])) {
    	// 	$base_url = PAYPAL_TEST_BASE_URL;
    	// 	$client_id = PAYPAL_TEST_CLIENT_ID;
    	// 	$client_secret_key = PAYPAL_TEST_CLIENT_SECRET_KEY;
    	// }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $base_url.'/v1/oauth2/token');
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Accept: application/json',
            'Accept-Language: en_US',
        ]);
        curl_setopt($ch, CURLOPT_USERPWD,  $client_id. ':' .$client_secret_key);
        curl_setopt($ch, CURLOPT_POSTFIELDS, 'grant_type=client_credentials');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($response, true);
        return $result['access_token'] ?? null;
    }

   	function productStock($product_id)
    {
    	$stock = 0;

    	$model = new Product;
    	$product = $model->select("stock")->where("id",$product_id)->first();
    	if($product) {
    		$stock = $product["stock"];
    	}

    	$model = db_connect();
    	$order = $model->table("bd_carts c");
    	$order = $order->join("bd_orders o","o.id=c.order_id","left");
    	$order = $order->selectSum("c.quantity","qty");
    	$order = $order->where("c.product_id",$product_id);
    	$order = $order->whereIn("o.status",[0,1,2,5,6,7]);
    	$order = $order->whereIn("o.payment_status",[1]);
    	$_row = $order->get()->getRowArray();
    	if($_row) {
    		$sold_stock = $_row["qty"];
    		$stock = $stock - $sold_stock;
    	}
    	
    	$returned = $model->table("bd_returned_order_items roi");
    	$returned = $returned->join("bd_returned_orders ro","ro.id=roi.returned_order_id","left");
    	$returned = $returned->selectSum("roi.approved_quantity","approved_qty");
    	$returned = $returned->selectSum("roi.quantity","qty");
    	$returned = $returned->where("roi.product_id",$product_id);
    	$returned = $returned->whereIn("ro.status",[1]);
    	$returned_row = $returned->get()->getRowArray();
    	if($returned_row) {
    		$stock = $stock - ($returned_row["qty"]-$returned_row["approved_qty"]);
    	}
    	if($stock < 0) {
    		$stock = 0;
    	}
    	return $stock;
    }


