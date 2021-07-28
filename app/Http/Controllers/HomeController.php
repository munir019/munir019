<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Requests;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Dashboard';

        //dd(session()->get('user'));

        return view('home.index', compact(['title']));
    }
}