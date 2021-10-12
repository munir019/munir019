<?php

namespace App\Http\Controllers;

use App\Models\DashboardAssign;
use App\Models\Office;
use App\Models\Officer;
use App\Models\CaseDetails;
use App\Models\CauseList;
use App\Models\JurisDiction;
use App\Models\BenchFormation;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Orangebd\Access;
use App\Orangebd\Api;

class BenchController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Bench Formation';
        $benchFormation = BenchFormation::where('division_type', session()->get('user')['divisionType'])->where('action', '<', 2)->get()->toArray();
        foreach ($benchFormation as $val) {
            $jurisDictionId[] = $val['jurisdiction_id'];
        }
        $api= new Api();
        $judgeList = $api->getData('judge/getJudgeByOfficeId?officeId=1');
        $judgeList= json_decode($judgeList, true);
        $tmp = array();
        foreach ($judgeList as $v) {
            $tmp[$v['id']] = $v;
        }
        $judgeList = $tmp;

        $tmp = array();
        if (!empty($jurisDictionId)) {
            $jurisDiction=JurisDiction::whereIn('id', $jurisDictionId)->get()->toArray();
            
            foreach ($jurisDiction as $val) {
                $tmp[$val['id']]=$val;
            }
        }
        $jurisDiction = $tmp;

        return view('bench.index', compact(['title','benchFormation','judgeList','jurisDiction']));
    }
    public function add(Request $request)
    {
        $title = 'Add Bench';
        $jurisDiction=JurisDiction::get()->toArray();
      
        return view('bench.modify', compact(['title','jurisDiction']));
    }
    public function update(Request $request)
    {
        $result = array('status'=>0);
        if ($request->isMethod('post')) {
            if (isset($request->id)) {
                $benchFormation = BenchFormation::find($request->id);
                $msg = 'বেঞ্চটি হালনাগাদ করা হয়েছে';
            } else {
                $benchFormation = new BenchFormation();
                $benchFormation->id = uniqid();
                $sendSms = true;
                $msg = 'বেঞ্চটি সংরক্ষণ করা হয়েছে';
            }

            $benchFormation->judge_list = json_encode($request->judge_list);
            $benchFormation->court_no = $request->court_no;
            $benchFormation->jurisdiction_id = $request->jurisdiction_id;
            $benchFormation->short_note = $request->short_note;
            $benchFormation->division_type= session()->get('user')['divisionType'];
            if (isset($request->action)) {
                $benchFormation->action = 1;
            } else {
                $benchFormation->action = 0;
            }
            $benchFormation->save();

            $result = array('status'=>1);
        }
        return redirect(config('app.url').'bench')->with('success', $msg);
    }
    public function modify(Request $request)
    {
        $benchFormation = BenchFormation::where('id', $request->id)->get()->toArray();
      
        $jurisDiction=JurisDiction::get()->toArray();
        if (!empty($benchFormation)) {
            $benchFormation =  $benchFormation[0];
        }

        return view('bench.modify', compact(['benchFormation','jurisDiction']));
    }

    public function dismiss(Request $request)
    {
        $result = array('status'=>0);
        if ($request->isMethod('get')) {
            if (isset($request->id)) {
                $benchFormation = BenchFormation::find($request->id);
                $msg = 'Bench is dismiss';
                $benchFormation->action = 2;
                $benchFormation->save();
            }
        }
        return redirect(config('app.url').'bench')->with('success', 'Bench is dismiss');
    }
}
