<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Requests;

class ErrorController extends Controller
{
    public function index(Request $request)
    {
        if($request->type=='unauthorized-network') {
            $title = 'Unauthorized Network';
            $code = '500';
            $message = 'Unauthorized network access';
        }
        return response()->view('error.index', compact(['title','code','message']),$code);
    }
}