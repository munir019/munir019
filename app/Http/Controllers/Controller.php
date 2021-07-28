<?php

namespace App\Http\Controllers;

use App\Orangebd\Network;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\App;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $version = '1.0.1'.time();
       
        App::setLocale('en');

        $siteTitle = 'Orange News Panel';
        $baseUrl = config('app.url');
       
        $share = array(
            'siteTitle' => $siteTitle,
            'baseUrl'=>$baseUrl,
            'version'=>$version
        );

        view()->share($share);
    }
}
