<?php

namespace App\Http\Controllers;

use App\Models\DashboardAssign;
use App\Models\Office;
use App\Models\Officer;
use App\Models\CaseDetails;
use App\Models\CauseList;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Orangebd\Access;

class ApiController extends Controller
{
    private $url;
    //private $url = 'http://localhost/judiciary/api';
    //private $url = 'http://training-causelistapi.judiciary.org.bd';
    public function index(Request $request)
    {
        // if (Storage::disk('local')->exists('cache/'.md5($request->path).'.json')) {
        //     $time = Storage :: disk('local')->lastModified('cache/'.md5($request->path).'.json');
        //     $currentTime= time();
        //     if ($time+3600>$currentTime) {
        //         $result = Storage :: disk('local')->get('cache/'.md5($request->path).'.json');
        
        //         return $result;
        //     }
        // }
        $this->url = getenv('API_END_POINT');
        $curl = curl_init();
        $path = $request->path;
        $get = $request->all();
        unset($get['path']);
        //echo $this->url.'/'.$path.'?'.http_build_query($get);

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->url.'/'.$path.'?'.http_build_query($get),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER=> false,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
            ),
        ));

        $response = curl_exec($curl);

    
        $result = Storage::disk('local')->put('cache/'.md5($request->path).'.json', $response);
        curl_close($curl);
        return $response;
    }
}
