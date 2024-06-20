<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;

class UserController extends BaseController
{
    public function __construct()
    {
        $session = session();
        //echo "<pre>"; print_r($session); die;
        if( !$session->has('sessionData') )
        {
            $session = session();
            header("Location: ".base_url("/"));
            die;
            
        }
    }
    public function index()
    {
        $session = session();
        $curUserData = $session->get('sessionData');
        if( $curUserData["login_type"] != "Super Admin" )
        {
            $session->setFlashdata("error-message", " Access Denied!!");
            return redirect()->to('dashboard');
        }
        
        $userModel = new UserModel();
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => API_BASE_URL.'dashboard',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic dHJ1ZV9ob3BlX2FwaV91c2VyOlRydWVAQEBIb3BlIyMjMTIz'
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $dashboard_result = json_decode($response, true);

        $user_data = $userModel->orderBy('user_id','DESC')->findAll();

        $pageData = array(
            "pageTitle"     =>  "Manage User | ".SITE_TITLE,
            "main_content"  =>  "user-list",
            "dashboard_data"=>  $dashboard_result,
            "user_data"     =>  $user_data,
        );
        return view('/innerpage/template', $pageData);
    }

    public function store_user_data()
    {
        $session = session();
        $curUserData = $session->get('sessionData');
        if( $curUserData["login_type"] != "Super Admin" )
        {
            $session->setFlashdata("error-message", " Access Denied!!");
            return redirect()->to('dashboard');
        }

        $userModel = new UserModel();
        $encrypter = \Config\Services::encrypter();
        $request   = service('request');
        $postData  = $request->getPost();

        if( isset($postData['action']) && isset($postData['userfirstname']) && isset($postData['userlastname']) && isset($postData['useremailaddress']) && isset($postData['userrole']) &&  isset($postData['userpassword']) && $postData['action'] == "actStoreUserData" )
        {
            //$password_generate = $this->randomPassword();
            $emailPassword = $encrypter->encrypt($postData['userpassword']);

            $userData = $userModel->where("user_email_id", trim($postData["useremailaddress"]))
                                    ->first();
            if( $userData )
            {
                $response = array(
                    "status"    =>  "Fail",
                    "msg"       =>  "Email address not available",
                );
            }
            else
            {
                $insertdata = [
                    'user_first_name'   =>  $postData["userfirstname"],
                    'user_last_name'    =>  $postData["userlastname"],
                    'user_email_id'     =>  $postData["useremailaddress"],
                    'user_password'     =>  $emailPassword,
                    'user_role'         =>  $postData["userrole"],
                    'created_at'        =>  date("Y-m-d H:i:s"),
                    'user_status'       =>  "1",
                ];

                if($userModel->insert($insertdata))
                {
                    $response = array(
                        "status"    =>  "Success",
                        "msg"       =>  "User successfully created",
                    );
                }
                else
                {
                    $response = array(
                        "status"    =>  "Fail",
                        "msg"       =>  "Something went wrong",
                    );
                }
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

    public function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 15; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }
}
