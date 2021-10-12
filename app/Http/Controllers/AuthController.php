<?php

namespace App\Http\Controllers;

use App\Models\CourtInfo;
use App\JISFSSO\JISFRequest;
use App\JISFSSO\JISFResponse;
use Illuminate\Http\Request;
use App\Http\Requests;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        
        $title = 'Login';
        return view('login', compact(['title']));
    }

    public function auth(Request $request){

        $curl = curl_init();
        $url = getenv('LOGIN_END_POINT');
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,//"http://dashboard.judiciary.org.bd/users/userVerify",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => array('username' => $request->userid,'password' => $request->password)
        ));

        $response = curl_exec($curl);
        
        curl_close($curl);
        $response = json_decode($response,true);

        if($response['status']==1){
            $user = array();
            $user['name'] = $response['personal_info']['name_bng'];
            $user['nameEn'] = $response['personal_info']['name_eng'];
            $user['officeName'] = $response['office_records'][0]['office_name'];
            $user['officeNameEn'] = $response['office_records'][0]['office_name'];
            $user['officeUnitName'] = $response['office_records'][0]['unit_name'];
            $user['officeUnitNameEn'] = $response['office_records'][0]['unit_name'];
            $user['officeDesignation'] = $response['office_records'][0]['designation'];
            $user['officeDesignationEn'] = $response['office_records'][0]['designation'];
            $user['officeId'] = $response['office_records'][0]['office_id'];
            $user['officeUnitId'] = $response['office_records'][0]['office_unit_id'];
            $user['officeUnitOrganogramId'] = $response['office_records'][0]['office_unit_organogram_id'];
            $user['divisionType']=1;
            $user['officeLayerId']=5;

            $user['username'] = $request->userid;
            $user['password'] = $request->password;

            //Munir
            $user['courtUnitId'] = '';
            $officeName = explode(',',$user['officeUnitName']);
            if(isset($officeName[0])) {
                $officeName = $officeName[0];
                $courtInfo = CourtInfo::where('court_name',$officeName)->limit(1)->get()->toArray();
                if(!empty($courtInfo)) {
                    $user['courtUnitId'] = $courtInfo[0]['court_unit_id'];
                    $user['is_civil'] = $courtInfo[0]['is_civil'];
                    $user['is_criminal'] = $courtInfo[0]['is_criminal'];
                }
            }
            //Munir

            session()->put('user', $user);
            return redirect(config('app.url'));
        }else{

        }

        return redirect(config('app.url').'login')->with('error','Invalid UserId or Password.');
    }

    public function logout(Request $request)
    {
        if(\Auth::check())
        {
            \Auth::logout();
            $request->session()->invalidate();
        }
        session()->flash('user');
        return redirect(config('app.url').'login');
    }

    public function ssologin(Request $request){
        $jisf = new JISFRequest();
        $state = $jisf->getState(10);

        $jisf->buildLogin($state);
    }

    public function ssoauth(Request $request){
        $jisf = new JISFResponse();
        $response = $jisf->parseResponse($request);

        $user = array();
        $user['name'] = $response['name'];
        $user['nameEn'] = $response['full_name_eng'];
        $user['officeName'] = $response['office_name_bng'];
        $user['officeNameEn'] = $response['office_name_eng'];
        $user['officeUnitName'] = $response['office_unit_name_bng'];
        $user['officeUnitNameEn'] = $response['office_unit_name_eng'];
        $user['officeDesignation'] = $response['designation'];
        $user['officeDesignationEn'] = $response['office_layer_name_eng'];
        $user['officeId'] = $response['office_id'];
        $user['officeUnitId'] = $response['office_unit_id'];
        $user['officeUnitOrganogramId'] = $response['office_unit_organogram_id'];
        $user['officeLayerId'] = $response['office_layer_id'];
        $user['divisionType'] = $response['office_layer_id'];
        $user['access_token'] = $response['access_token'];
        $user['refresh_token'] = $response['refresh_token'];
        $user['response'] = $response;

        session()->put('user', $user);

        return redirect(config('app.url'));
    }

    public function ssologout(Request $request){
        if(!empty(session()->get('user'))) {
            $tmpUser = session()->get('user');

            $request->session()->invalidate();
            session()->flash('user');

            $jisf = new JISFRequest();
            $response = $jisf->logout($tmpUser);
        }
        return redirect(config('app.url').'ssologin');
    }
}