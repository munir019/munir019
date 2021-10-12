<?php

namespace App\Http\Controllers;

use App\Models\DashboardAssign;
use App\Models\Office;
use App\Models\Officer;
use App\Models\CaseDetails;
use App\Models\CauseList;
use App\Models\JurisDiction;
use App\Models\SupremeCauseList;
use App\Models\BenchFormation;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Orangebd\Access;
use App\Orangebd\Api;

class SupremeController extends Controller
{
    public function index(Request $request)
    {
        if(session()->get('user')['divisionType']==1)
            $title = 'Appellate Division Causelist';
        else if(session()->get('user')['divisionType']==2)
            $title = 'Highcourt Division Causelist';
        else
            abort(404);

        $api= new Api();
        $caseCategory = array();

        $caseCategory = $api->getData('case/category?courtType=2');
        $cat= json_decode($caseCategory, true);

        $caseType = array();
        $caseType = $api->getData('case/categoryType?catId=1');
        $temp = json_decode($caseType, true);
        
        $caseType = $api->getData('case/categoryType?catId=2');
        $caseType = json_decode($caseType, true);

        $caseTypeList = $api->getData('case/categoryType?catId=3');
        $caseTypeList = json_decode($caseTypeList, true);

        $caseType = array_merge($temp, $caseType, $caseTypeList);
        $tmp = array();
        foreach ($caseType as $v) {
            $tmp[$v['id']] = $v;
        }
        $caseType = $tmp;

        $hearingDate = date('Y-m-d');
        if (!empty($request->hearing_date)) {
            $hearingDate = $request->hearing_date;
            $appellate = SupremeCauseList::where('hearing_date', $hearingDate)->get()->toArray();
        } else {
            $appellate = SupremeCauseList::where('hearing_date', $hearingDate)->get()->toArray();
        }
        $api= new Api();
        $caseStatus = $api->getData('case/status');
        $caseStatus = json_decode($caseStatus, true);
        $tmp = array();
        foreach ($caseStatus as $v) {
            $tmp[$v['id']] = $v;
        }
        $caseStatus = $tmp;

        return view('supreme.index', compact(['title','appellate','caseType','hearingDate','caseStatus']));
    }
    public function add(Request $request)
    {
        $title = 'Add Causes List';
        $api= new Api();

        if(session()->get('user')['divisionType']==1)
            $judgeList = $api->getData('judge/getJudgeByOfficeId?officeId=1');
        else if(session()->get('user')['divisionType']==2)
            $judgeList = $api->getData('judge/getJudgeByOfficeId?officeId=2');

        $judgeList= json_decode($judgeList, true);

        $tmp = array();
        foreach ($judgeList as $v) {
            $tmp[$v['id']] = $v;
        }
        $judgeList = $tmp;

        $benchFormation = BenchFormation::Select('id', 'judge_list')->where('action', 1)->get()->toArray();
        $judge_list=array();
    
        foreach ($benchFormation as $v) {
            $tmp = json_decode($v['judge_list'], true);
            $name = array();
            foreach ($tmp as $val) {
                if (isset($judgeList[$val])) {
                    $name[] = $judgeList[$val]['name_bng'];
                }
            }
            $judge_list[$v['id']] = implode(',', $name);
        }

        return view('supreme.modify', compact('judge_list'));
    }
    public function decision(Request $request)
    {
        $appellateId = $request->id;
        $appellate = SupremeCauseList::where('id', $appellateId)->get()->toArray();
        $appellate=$appellate[0];
        $api= new Api();
        $caseType = array();
        $caseType = $api->getData('case/categoryType?catId=1');
        $temp = json_decode($caseType, true);
        
        $caseType = $api->getData('case/categoryType?catId=2');
        $caseType = json_decode($caseType, true);
        $caseTypeList = $api->getData('case/categoryType?catId=3');
        $caseTypeList = json_decode($caseTypeList, true);

        $caseType = array_merge($temp, $caseType, $caseTypeList);
        $tmp = array();
        foreach ($caseType as $v) {
            $tmp[$v['id']] = $v;
        }
        $caseType = $tmp;

        return view('supreme.decision', compact(['appellate','caseType']));
    }
    public function update(Request $request)
    {
        $result = array('status'=>0);
        if ($request->isMethod('post')) {
            if (isset($request->id)) {
                $appellate = SupremeCauseList::find($request->id);
                $msg = 'মামলাটি হালনাগাদ করা হয়েছে';
            } else {
                $appellate = new SupremeCauseList();
                $appellate->id = uniqid();
                $sendSms = true;
                $msg = 'মামলাটি সংরক্ষণ করা হয়েছে';
            }

            $appellate->division_type = session()->get('user')['divisionType'];
            $appellate->bench_id = $request->bench_id;
            $appellate->case_year = $request->case_year;
            $appellate->case_category = $request->case_category;
            $appellate->case_type = $request->case_type;
            $appellate->case_no = $request->case_no;
            $appellate->complainant_name = $request->complainant_name;
            $appellate->complainant_mobile = $request->complainant_mobile;
            $appellate->defender_name = $request->defender_name;
            $appellate->defender_mobile = $request->defender_mobile;
            $appellate->hearing_date = $request->hearing_date;
            $appellate->case_status = $request->case_status;
            $appellate->judge_name = $request->judge_name;
            $appellate->save();

            $result = array('status'=>1);
        }
        return redirect(config('app.url').'supreme')->with('success', $msg);
    }
    public function orderUpdate(Request $request)
    {
        if ($request->isMethod('post')) {
            if (isset($request->id)) {
                $appellate = SupremeCauseList::find($request->id);
                $appellate->next_hearing_date = $request->next_hearing_date;
                $appellate->case_status = $request->case_status;
                $appellate->case_short_decision = $request->case_short_decision;
                $appellate->case_details_decision =$request->case_details_decision;
                $appellate->save();

                if ($request->case_status!=3) {
                    $appellateNew = new SupremeCauseList();
                    $appellateNew->id = uniqid();
                    $appellateNew->bench_id = $appellate->bench_id;
                    $appellateNew->case_year = $appellate->case_year;
                    $appellateNew->case_category = $appellate->case_category;
                    $appellateNew->case_type = $appellate->case_type;
                    $appellateNew->case_no = $appellate->case_no;
                    $appellateNew->complainant_name = $appellate->complainant_name;
                    $appellateNew->complainant_mobile = $appellate->complainant_mobile;
                    $appellateNew->defender_name = $appellate->defender_name;
                    $appellateNew->defender_mobile = $appellate->defender_mobile;
                    $appellateNew->hearing_date = $appellate->next_hearing_date;
                    $appellateNew->case_status = $appellate->case_status;
                    $appellateNew->judge_name = $appellate->judge_name;
                    $appellateNew->save();
                }
            }
        }
        return redirect(config('app.url').'supreme')->with('success', 'Cause list is updated');
    }
    
    public function modify(Request $request)
    {
        $api= new Api();
        $judgeList = $api->getData('judge/getJudgeByOfficeId?officeId=1');
        $judgeList= json_decode($judgeList, true);
        $tmp = array();
        foreach ($judgeList as $v) {
            $tmp[$v['id']] = $v;
        }
        $judgeList = $tmp;

        $benchFormation = BenchFormation::Select('id', 'judge_list')->where('action', 1)->get()->toArray();
        $judge_list=array();
    
        foreach ($benchFormation as $v) {
            $tmp = json_decode($v['judge_list'], true);
            $name = array();
            foreach ($tmp as $val) {
                if (isset($judgeList[$val])) {
                    $name[] = $judgeList[$val]['name_bng'];
                }
            }
            $judge_list[$v['id']] = implode(',', $name);
        }
        $appellate = SupremeCauseList::where('id', $request->id)->get()->toArray();
        
        if (!empty($appellate)) {
            $appellate =  $appellate[0];
        }

        return view('supreme.modify', compact(['appellate','judge_list']));
    }
}
