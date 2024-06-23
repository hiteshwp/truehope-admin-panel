<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\AdminModel;
use App\Models\UserModel;
use App\Models\UserActivitiesModel;

class LoginController extends BaseController
{
    public function __construct()
    {
        $session = session();
        if( $session->has('sessionData') )
        {
            $session = session();
            header("Location: dashboard");
            die;
        }
    }
    public function index()
    {
        $pageData = array(
            "pageTitle" =>  "Login | ".SITE_TITLE,
        );
        return view('login', $pageData);
    }

    public function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
           $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    public function login()
    {
        $adminModel = new AdminModel();
        $userModel = new UserModel();
        $userActivitiesModel = new UserActivitiesModel();
        $encrypter = \Config\Services::encrypter();
        $request   = service('request');
        $postData  = $request->getPost();
        $session   = session();

        if( isset($postData['action']) && isset($postData['txtloginemail']) && isset($postData['txtloginpassword']) && $postData['action'] == "actDoLogin" )
        {
            $emailPassword = $encrypter->encrypt($postData["txtloginpassword"]);

            //echo $emailPassword; die;

            $adminloginData = $adminModel->where("admin_email_address", trim($postData["txtloginemail"]))
                                    ->where("admin_status", "1")
                                    ->first();

            $userloginData = $userModel->where("user_email_id", trim($postData["txtloginemail"]))
                                        ->where("user_status", "1")
                                        ->first();

            if( $adminloginData )
            {
                if( trim($postData["txtloginpassword"]) == $encrypter->decrypt($adminloginData["admin_password"]) )
                {
                    $sessionData = [
                        'login_id'              => $adminloginData['admin_id'],
                        'login_full_name'       => $adminloginData['admin_fullname'],  
                        'login_email_address'   => $adminloginData['admin_email_address'],
                        'isLoggedIn'            => TRUE,
                        'login_type'            => "Super Admin",
                        'user_type'             => "admin",
                        'user_activity_id'      => 1,
                    ];
                    $session->set("sessionData", $sessionData);

                    $session->setFlashdata('login-success', 'Welcomes to '.SITE_TITLE.'!.');

                    $response = array(
                        "status"    =>  "Success",
                        "msg"       =>  "You have Successfully Login!.",
                    );
        
                }
                else
                {
                    $response = array(
                        "status"    =>  "Fail",
                        "msg"       =>  "Invalid Login Credentials !.",
                    );
        
                }
            } 
            else if( $userloginData )
            {
                if( trim($postData["txtloginpassword"]) == $encrypter->decrypt($userloginData["user_password"]) )
                {
                    $user_status = "Normal User";
                    if( $userloginData['user_role'] == "1" )
                    {
                        $user_status = "Admin User";
                    }

                    $mybrowser = $this->browser();

                    $inset_activities_data = array(
                        "user_id"               =>  $userloginData['user_id'],
                        "user_role"             =>  $user_status,
                        "user_ip_address"       =>  $this->get_client_ip(),
                        "user_platform"         =>  $mybrowser,
                        "created_at"            =>  date("Y-m-d H:i:s"),
                        "user_activities_status"=>  "1",
                    );
                    $userActivitiesModel->insert($inset_activities_data);

                    $lastInsertId = $userActivitiesModel->getInsertID();

                    $sessionData = [
                        'login_id'              => $userloginData['user_id'],
                        'login_full_name'       => $userloginData['user_first_name']." ".$userloginData['user_last_name'],  
                        'login_email_address'   => $userloginData['user_email_id'],
                        'isLoggedIn'            => TRUE,
                        'login_type'            => $user_status,
                        'user_type'             => "user",
                        'user_activity_id'      => $lastInsertId,
                    ];
                    $session->set("sessionData", $sessionData);

                    $session->setFlashdata('login-success', 'Welcomes to '.SITE_TITLE.'!.');
                    

                    $response = array(
                        "status"    =>  "Success",
                        "msg"       =>  "You have Successfully Login!.",
                    );
        
                }
                else
                {
                    $response = array(
                        "status"    =>  "Fail",
                        "msg"       =>  "Invalid Login Credentials !.",
                    );
        
                }
            }   
            else
            {
                $response = array(
                    "status"    =>  "Fail",
                    "msg"       =>  "Invalid Login Credentials !.",
                );
    
            }                     
        }
        else
        {
            $response = array(
                "status"    =>  "Fail",
                "msg"       =>  "Missing details !.",
            );

        }
        echo json_encode($response); die;
    }
    
    public function forgot_password()
    {
        $pageData = array(
            "pageTitle" =>  "Forgot Password | ".SITE_TITLE,
        );
        return view('forgot_password', $pageData);
    }

    public function browser()
    {
        $browser="";
        if(strrpos(strtolower($_SERVER["HTTP_USER_AGENT"]),strtolower("MSIE")))
        {
            $browser="Internet Explorer";
        }
        else if(strrpos(strtolower($_SERVER["HTTP_USER_AGENT"]),strtolower("Presto")))
        {
            $browser="Opera";
        }
        else if(strrpos(strtolower($_SERVER["HTTP_USER_AGENT"]),strtolower("CHROME")))
        {
            $browser="Google Chrome";
        }
        else if(strrpos(strtolower($_SERVER["HTTP_USER_AGENT"]),strtolower("SAFARI")))
        {
            $browser="Safari";
        }
        else if(strrpos(strtolower($_SERVER["HTTP_USER_AGENT"]),strtolower("FIREFOX")))
        {
            $browser="FIREFOX";
        }
        else
        {
            $browser="OTHER";
        }
        return $browser;
    }
}
