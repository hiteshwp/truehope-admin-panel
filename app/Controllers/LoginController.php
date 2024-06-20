<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\AdminModel;
use App\Models\UserModel;

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

    public function login()
    {
        $adminModel = new AdminModel();
        $userModel = new UserModel();
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
            elseif( $userloginData )
            {
                if( trim($postData["txtloginpassword"]) == $encrypter->decrypt($userloginData["user_password"]) )
                {
                    $user_status = "Normal User";
                    if( $userloginData['user_role'] == "1" )
                    {
                        $user_status = "Admin User";
                    }
                    $sessionData = [
                        'login_id'              => $userloginData['user_id'],
                        'login_full_name'       => $userloginData['user_first_name']." ".$userloginData['user_last_name'],  
                        'login_email_address'   => $userloginData['user_email_id'],
                        'isLoggedIn'            => TRUE,
                        'login_type'            => $user_status,
                        'user_type'             => "user",
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
}
