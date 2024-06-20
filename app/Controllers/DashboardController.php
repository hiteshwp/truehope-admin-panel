<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class DashboardController extends BaseController
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
        $session   = session();
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

        $pageData = array(
            "pageTitle"        =>   "Dashboard | ".SITE_TITLE,
            "main_content"     =>   "dashboard",
            "dashboard_data"   =>   $dashboard_result,
            "curUserData"      =>   $session->get('sessionData')
        );
        return view('/innerpage/template', $pageData);
    }

    public function logout()
    {
        $session = session();
        unset($_SESSION['sessionData']);
        $session->setFlashdata('logout-success', 'You have successfully Logout!.');
        return redirect()->to('/');
    }

    public function IND_money_format($number){
        $decimal = (string)($number - floor($number));
        $money = floor($number);
        $length = strlen($money);
        $delimiter = '';
        $money = strrev($money);

        for($i=0;$i<$length;$i++){
            if(( $i==3 || ($i>3 && ($i-1)%2==0) )&& $i!=$length){
                $delimiter .=',';
            }
            $delimiter .=$money[$i];
        }

        $result = strrev($delimiter);
        $decimal = preg_replace("/0\./i", ".", $decimal);
        $decimal = substr($decimal, 0, 3);

        if( $decimal != '0'){
            $result = $result.$decimal;
        }

        return $result;
    }

    public function category($id)
    {
        $session   = session();
        if( $id != "" )
        {
            $category_id = $id;
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => API_BASE_URL.'get-category-wise-donation-data',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('term_id' => $category_id),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic dHJ1ZV9ob3BlX2FwaV91c2VyOlRydWVAQEBIb3BlIyMjMTIz'
            ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            $donation_result = json_decode($response, true);

        }

        $pageData = array(
            "pageTitle"        =>   "Category Wise Donation Data | ".SITE_TITLE,
            "main_content"     =>   "category",
            "dashboard_data"   =>   $donation_result,
            "category_id"      =>   $category_id,
            "curUserData"      =>   $session->get('sessionData')
        );
        return view('/innerpage/template', $pageData);
    }

    public function change_password()
    {
        $session   = session();
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

        $pageData = array(
            "pageTitle"        =>   "Change Password | ".SITE_TITLE,
            "main_content"     =>   "change-password",
            "dashboard_data"   =>   $dashboard_result,
            "curUserData"      =>   $session->get('sessionData')
        );
        return view('/innerpage/template', $pageData);
    }
}
