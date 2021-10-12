<?php

namespace App\Http\Controllers;

use App\Models\CaseDetails;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $title = 'মামলার কার্যতালিকা';
        
        return view('home', compact(['title']));
    }
}
