<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Customer;
use App\Models\Visitor;
use App\Controllers\CommonController;

class Auth extends CommonController
{
    protected $helpers = ["custom"];

    public function index()
    {
        return view('admin/auth/login');
    }

    public function submit_signin()
    {
        $session = session();
        $post = $this->request->getVar();
        
        $_obj = new User;
        $_row = $_obj->where("email",$post["email"])->first();
        if($_row) {
            if($_row["password"] == md5($post["password"])) {
                $session->set('userdata', $_row);
                return redirect("dashboard");
            } else {
                $session->setFlashData('error', 'Invalid password.');
                return redirect("admin-panel");
            }
        } else {
            $session->setFlashData('error', 'Email not found.');
            return redirect("admin-panel");
        }
    }

    public function sign_in()
    {
        $session = session();
        if($session->get('customerdata')) {
            return redirect("my-dashboard");
        }
        return view('auth/sign_in');
    }

    public function submit_customer_signin()
    {
        $post = $this->request->getVar();
        try {
            if(trim($post["email"]) == "") {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => "Email is required.",
                    'input' => "email",
                    'csrf' => csrf_hash()
                ]);
            } else if(trim($post["password"]) == "") {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => "Password is required.",
                    'input' => "password",
                    'csrf' => csrf_hash()
                ]);
            } else {
                $model = new Customer;
                $userdata = $model->where("email",$post["email"])->first();
                if($userdata) {
                    if($userdata["deleted_by"] == 0) {
                        if($userdata["is_verified"] == 1) {
                            if($userdata["is_active"] == 1) {
                                if($userdata["password"] == md5($post["password"])) {
                                    $_date = date("Y-m-d H:i:s",strtotime("-10 minute"));

                                    $model = new Visitor;
                                    $count = $model->where(["ip" => $this->request->getIPAddress(),"created_at >=" => $_date])->get()->getNumRows();

                                    $session = session();
                                    $session->set("customerdata",$userdata);
                                    return $this->response->setJSON([
                                        'status' => 'success',
                                        'redirect_url' => $count == 0 ? base_url("my-dashboard") : base_url('recently-visited')
                                    ]);  
                                } else {
                                    return $this->response->setJSON([
                                        'status' => 'error',
                                        'message' => "Password does not match.",
                                        'input' => "password",
                                        'csrf' => csrf_hash()
                                    ]);    
                                }
                            } else {
                                return $this->response->setJSON([
                                    'status' => 'error',
                                    'message' => "Your account is not active.",
                                    'input' => "email",
                                    'csrf' => csrf_hash()
                                ]);
                            }
                        } else {
                            return $this->response->setJSON([
                                'status' => 'error',
                                'message' => "Your account is not verified yet.",
                                'input' => "email",
                                'csrf' => csrf_hash()
                            ]);
                        }
                    } else {
                        return $this->response->setJSON([
                            'status' => 'error',
                            'message' => "Your account is deleted.",
                            'input' => "email",
                            'csrf' => csrf_hash()
                        ]);
                    }
                } else {
                    return $this->response->setJSON([
                        'status' => 'error',
                        'message' => "Email not found.",
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

    public function sign_up()
    {
        // $model = new Customer;
        // $model->truncate();
        $session = session();
        if($session->get('customerdata')) {
            return redirect("my-dashboard");
        }
        return view('auth/sign_up');
    }

    public function submit_signup()
    {
        try {
            $recaptchaResponse = $this->request->getPost('g-recaptcha-response');
            $secret = "6Ld5Je0rAAAAAJUQ2lwUG0dNt2Z36bLnHSbUaNTh";
            $verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$recaptchaResponse}");
            $responseData = json_decode($verify);
            
            $post = $this->request->getVar();
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
                    'input' => "email",
                    'csrf' => csrf_hash()
                ]);
            } else if(trim($post["password"]) == "") {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => "Password is required.",
                    'input' => "password",
                    'csrf' => csrf_hash()
                ]);
            } else if(trim($post["confirm_password"]) == "") {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => "Confirm password is required.",
                    'input' => "confirm_password",
                    'csrf' => csrf_hash()
                ]);
            } else if(strlen(trim($post["password"])) < 6) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => "The password must be at least 6 characters long.",
                    'input' => "password",
                    'csrf' => csrf_hash()
                ]);
            } else if(trim($post["password"]) != trim($post["confirm_password"])) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => "Password and Confirm Password must match.",
                    'input' => "confirm_password",
                    'csrf' => csrf_hash()
                ]);
            } else if(!$responseData->success) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => "reCAPTCHA verification failed",
                    'csrf' => csrf_hash()
                ]);
            } else {
                $model = new Customer;
                $count = $model->where("email",$post["email"])->get()->getNumRows();
                if($count == 0) {
                    $count = $model->where("phone",$post["phone"])->get()->getNumRows();
                    if($count == 0) {
                        $code = base64_encode(time());
                        $insert_data = array(
                            "fname" => $post["fname"],
                            "lname" => $post["lname"],
                            "email" => $post["email"],
                            "phone" => $post["phone"],
                            "password" => md5(trim($post["password"])),
                            "code" => $code,
                            "created_by" => 0,
                            "created_at" => date("Y-m-d H:i:s"),
                            "ip_address" => $this->request->getIPAddress()
                        );
                        $model->insert($insert_data);

                        // send verify email
                        $emaildata["app_name"] = APP_NAME;
                        $emaildata["app_address"] = APP_ADDRESS;
                        $emaildata["app_logo"] = APP_LOGO;
                        $emaildata["href"] = base_url("verify-email?code=".$code);
                        $emaildata["customer_name"] = $post["fname"]." ".$post["lname"];
                        $html = view("email/account_verify",$emaildata);
                        send_email($post["email"],"Verify Your Account",$html);

                        $session = session();
                        $session->setFlashData("message","Verification link sent to your email.");
                        return $this->response->setJSON(['status' => 'success',"redirect_url" => base_url("sign-in")]);
                    } else {
                        return $this->response->setJSON([
                            'status' => 'error',
                            'message' => "Phone no. is already used.",
                            'input' => "phone",
                            'csrf' => csrf_hash()
                        ]);
                    }
                } else {
                    return $this->response->setJSON([
                        'status' => 'error',
                        'message' => "Email is already used.",
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

    public function verify_email()
    {
        $session = session();

        $code = $_GET["code"];
        $code = base64_decode($code);
        $sentAt = date("Y-m-d H:i:s",$code);
        $currentDateTime = date("Y-m-d H:i:s",strtotime("-5 minute"));
        if(strtotime($sentAt) >= strtotime($currentDateTime)) {
            $model = new Customer;
            $customer = $model->where("code",$_GET["code"])->first();
            if($customer) {
                $model->update($customer["id"],["code" => "","is_verified" => 1]);
                $session->setFlashData("message","Your account verified successfully.");
            } else {
                $session->setFlashData("message","Link has been expired.");
            }
        } else {
            $session->setFlashData("message","Link has been expired.");
        }
        return redirect()->to('/sign-in');
    }

    public function forgot_password()
    {
        return view('auth/forgot_password');
    }

    public function submit_forgot_password()
    {
        $post = $this->request->getVar();
        try {
            if(trim($post["email"]) == "") {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => "Email is required.",
                    'input' => "email",
                    'csrf' => csrf_hash()
                ]);
            } else {
                $model = new Customer;
                $customer = $model->select("id,fname,lname")->where("email",$post["email"])->first();
                if($customer) {
                    $code = base64_encode(time());
                    $model->update($customer["id"],["code" => $code]);

                    // send link email
                    $emaildata["customer_name"] = $customer["fname"]." ".$customer["lname"];
                    $emaildata["app_name"] = APP_NAME;
                    $emaildata["app_address"] = APP_ADDRESS;
                    $emaildata["app_logo"] = APP_LOGO;
                    $emaildata["href"] = base_url("reset-password?code=".$code);
                    $html = view("email/reset_password_link",$emaildata);
                    send_email($post["email"],"Reset Password Link",$html);

                    $session = session();
                    $session->setFlashData("message","Reset password link sent to your email.");
                    return $this->response->setJSON(['status' => 'success',"redirect_url" => base_url("sign-in")]);
                } else {
                    return $this->response->setJSON([
                        'status' => 'error',
                        'message' => "Email not found.",
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

    public function reset_password()
    {
        $session = session();

        $code = $_GET["code"];
        $code = base64_decode($code);
        $sentAt = date("Y-m-d H:i:s",$code);
        $currentDateTime = date("Y-m-d H:i:s",strtotime("-15 minute"));
        if(strtotime($sentAt) >= strtotime($currentDateTime)) {
            $model = new Customer;
            $customer = $model->where("code",$_GET["code"])->first();
            if($customer) {
                $data["code"] = $_GET["code"];
                return view('auth/reset_password',$data);
            } else {
                $session->setFlashData("message","Link has been expired.");
                return redirect()->to('/sign-in');
            }
        } else {
            $session->setFlashData("message","Link has been expired.");
            return redirect()->to('/sign-in');
        }
    }

    public function submit_reset_password()
    {
        $code = $_GET["code"];
        $post = $this->request->getVar();
        try {
            if(trim($post["password"]) == "") {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => "Password is required.",
                    'input' => "password",
                    'csrf' => csrf_hash()
                ]);
            } else if (trim($post["confirm_password"]) == "") {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => "Confirm password is required.",
                    'input' => "confirm_password",
                    'csrf' => csrf_hash()
                ]);
            } else if (strlen(trim($post["password"])) < 6) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => "The password must be at least 6 characters long.",
                    'input' => "password",
                    'csrf' => csrf_hash()
                ]);
            } else if(trim($post["password"]) != trim($post["confirm_password"])) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => "Password and Confirm Password must match.",
                    'input' => "confirm_password",
                    'csrf' => csrf_hash()
                ]);
            } else {
                $model = new Customer;
                $customer = $model->select("id")->where("code",$code)->first();
                if($customer) {
                    $model->update($customer["id"],["code" => "","password" => md5(trim($post["password"]))]);

                    $session = session();
                    $session->setFlashData("message","Your password changed successfully.");
                    return $this->response->setJSON(['status' => 'success',"redirect_url" => base_url("sign-in")]);
                } else {
                    return $this->response->setJSON([
                        'status' => 'error',
                        'message' => "Email not found.",
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

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/admin-panel')->with('error', 'You have been logged out.');
    }

    public function my_logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/sign-in');
    }
}
