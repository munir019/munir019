<?php

namespace App\Http\Controllers;

use App\Models\DashboardAssign;
use App\Models\Office;
use App\Models\Officer;
use App\Models\CaseDetails;
use App\Models\CauseList;
use App\Models\JurisDiction;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Orangebd\Access;
use App\Orangebd\Api;

class JurisdictionController extends Controller
{
    public function index(Request $request)
    {
        $title = 'JurisDiction';
        $jurisDiction = JurisDiction::where('division_type', session()->get('user')['divisionType'])->get()->toArray();
       
        return view('jurisdiction.index', compact(['title','jurisDiction']));
    }
    public function add(Request $request)
    {
        $title = 'Add Jurisdiction';
        
        return view('jurisdiction.modify');
    }
    public function update(Request $request)
    {
        $result = array('status'=>0);
        if ($request->isMethod('post')) {
            if (isset($request->id)) {
                $jurisDiction = JurisDiction::find($request->id);
                $msg = 'অধিক্ষেত্রটি হালনাগাদ করা হয়েছে';
            } else {
                $jurisDiction = new JurisDiction();
                $jurisDiction->id = uniqid();
                $sendSms = true;
                $msg = 'অধিক্ষেত্রটি সংরক্ষণ করা হয়েছে';
            }
            

            $jurisDiction->description_en = $request->description_en;
            $jurisDiction->description = $request->description;
            $jurisDiction->division_type= session()->get('user')['divisionType'];
            $jurisDiction->save();

            $result = array('status'=>1);
        }
        return redirect(config('app.url').'jurisdiction')->with('success', $msg);
    }
    public function modify(Request $request)
    {
        $jurisDiction = JurisDiction::where('id', $request->id)->get()->toArray();
        
        if (!empty($jurisDiction)) {
            $jurisDiction =  $jurisDiction[0];
        }

        return view('jurisdiction.modify', compact(['jurisDiction']));
    }
}
