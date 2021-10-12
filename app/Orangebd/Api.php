<?php

namespace App\Orangebd;
use Illuminate\Support\Facades\Storage;

class Api
{
    private $url;
    public function getData($path)
    {
        /*if (Storage::disk('local')->exists('cache/'.md5($path).'.json')) {
            $time = Storage :: disk('local')->lastModified('cache/'.md5($path).'.json');
            $currentTime= time();
            if ($time+3600>$currentTime) {
                $result = Storage :: disk('local')->get('cache/'.md5($path).'.json');
        
                return $result;
            }
        }*/
        $this->url = getenv('API_END_POINT');
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->url.'/'.$path,
            CURLOPT_RETURNTRANSFER => true,
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
        //$result = Storage::disk('local')->put('cache/'.md5($path).'.json', $response);
        curl_close($curl);
        return $response;
    }
}

