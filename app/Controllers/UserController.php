<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;
use App\Models\UserActivitiesModel;

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

    public function update_user_data()
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

        if( isset($postData['action']) && isset($postData['userfirstname']) && isset($postData['userlastname']) && isset($postData['useremailaddress']) && isset($postData['updateuserid']) && isset($postData['userrole']) && isset($postData['userstatus']) && $postData['action'] == "actUpdateUserData" )
        {
            $update_user_id = $postData['updateuserid'];
            $updatedata = [
                'user_first_name'   =>  $postData["userfirstname"],
                'user_last_name'    =>  $postData["userlastname"],
                'user_email_id'     =>  $postData["useremailaddress"],
                'user_role'         =>  $postData["userrole"],
                'updated_at'        =>  date("Y-m-d H:i:s"),
                'user_status'       =>  $postData['userstatus'],
            ];

            if( isset($postData['userpassword']) && $postData['userpassword'] != "" )
            {
                $updatedata["user_password"] = $encrypter->encrypt($postData['userpassword']);
            }

            if($userModel->update($update_user_id, $updatedata))
            {
                $response = array(
                    "status"    =>  "Success",
                    "msg"       =>  "User successfully updated",
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

    public function user_login_history($id)
    {
        $userActivitiesModel = new UserActivitiesModel();
        $userModel = new UserModel();
        $session = session();
        $curUserData = $session->get('sessionData');

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

        $user_activity_data = $userActivitiesModel->select("tbl_user_activities.*, tbl_user.user_first_name, tbl_user.user_last_name, tbl_user.user_email_id, tbl_user.user_role")
                                                    ->join("tbl_user","tbl_user.user_id=tbl_user_activities.user_id")
                                                    ->where("tbl_user_activities.user_id", $id)
                                                    ->orderBy("tbl_user_activities.user_activities_id","DESC")
                                                    ->findAll();
        $user_details = $userModel->where("user_id", $id)->first();
        //echo "<pre>"; print_r($user_activity_data); die;
        $pageData = array(
            "pageTitle"             =>  "User Login History | ".SITE_TITLE,
            "main_content"          =>  "login-history",
            "dashboard_data"        =>  $dashboard_result,
            "user_activity_data"    =>  $user_activity_data,
            "user_data"             => $user_details
        );
        return view('/innerpage/template', $pageData);
    }

    public function change_user_activity_status()
    {
        $session = session();
        $curUserData = $session->get('sessionData');
        if( $curUserData["login_type"] != "Super Admin" )
        {
            $session->setFlashdata("error-message", " Access Denied!!");
            return redirect()->to('dashboard');
        }

        $userActivitiesModel = new UserActivitiesModel();
        $request   = service('request');
        $postData  = $request->getPost();

        if( isset($postData["action"]) && isset($postData["user_activity_id"]) && $postData["action"] == "actChangeUserActivityStatus" && $postData["user_activity_id"] != "" )
        {
            $update_id = $postData["user_activity_id"];
            $udate_data = array(
                "updated_at"             => date("Y-m-d H:i:s"),
                "user_activities_status"=> "0",
            );

            if($userActivitiesModel->update($update_id, $udate_data))
            {
                $response = array(
                    "status"    =>  "Success",
                    "msg"       =>  "User successfully logged out",
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
        else
        {
            $response = array(
                "status"    =>  "Fail",
                "msg"       =>  "Missing details !.",
            );

        }
        echo json_encode($response); die;
    }

    public function change_user_status()
    {
        $session = session();
        $curUserData = $session->get('sessionData');
        if( $curUserData["login_type"] != "Super Admin" )
        {
            $session->setFlashdata("error-message", " Access Denied!!");
            return redirect()->to('dashboard');
        }

        $userModel = new UserModel();
        $request   = service('request');
        $postData  = $request->getPost();
        if( isset($postData["action"]) && isset($postData["user_id"]) && $postData["action"] == "actChangeUserStatus" && $postData["user_id"] != "" )
        {
            $update_id = $postData["user_id"];
            $udate_data = array(
                "updated_at" => date("Y-m-d H:i:s"),
                "user_status"=> "0",
            );

            if($userModel->update($update_id, $udate_data))
            {
                $response = array(
                    "status"    =>  "Success",
                    "msg"       =>  "User successfully deactivated",
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
        else
        {
            $response = array(
                "status"    =>  "Fail",
                "msg"       =>  "Missing details !.",
            );

        }
        echo json_encode($response); die;
    }
}
