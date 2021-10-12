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
use App\Orangebd\Access;
use App\Orangebd\Api;

class CauselistController extends Controller
{
    public function index(Request $request)
    {
        
        $title = 'Causes List';
        $access = new Access();
        if (!$access->hasAccess()) {
            return abort(404);
        }

        $caseDetails = array();
        $causeList = array();

        $officeId = session()->get('user')['officeId'];
        $officeUnitId = session()->get('user')['officeUnitId'];

        $date= date('Y-m-d');
        $caseDetails = CaseDetails::get()->toArray();

        if (!empty($caseDetails)) {
            foreach ($caseDetails as $val) {
                $caseId[] = $val['id'];
            }
            if (!empty($request->case_date)) {
                $date = $request->case_date;
                $causeList = CauseList::where('office_id', $officeId)
                    ->where('office_unit_id', $officeUnitId)
                    ->whereIn('case_id', $caseId)->where('hearing_date', $date)->get()->toArray();
            } else {
                $causeList = CauseList::where('office_id', $officeId)
                    ->where('office_unit_id', $officeUnitId)
                    ->whereIn('case_id', $caseId)->where('hearing_date', $date)->get()->toArray();
            }
        }

        $caseDetails = array();
        if (!empty($causeList)) {
            $tmp = array();
            foreach ($causeList as $v) {
                $tmp[$v['case_id']] = $v['case_id'];
            }
            $caseDetails = CaseDetails::whereIn('id', $tmp)->get()->toArray();
            $tmp = array();
            foreach ($caseDetails as $v) {
                $tmp[$v['id']] = $v;
            }
            $caseDetails = $tmp;
        }

        $api= new Api();
        $caseStatus = $api->getData('case/status');
        $caseStatus = json_decode($caseStatus, true);
        $tmp = array();
        foreach ($caseStatus as $v) {
            $tmp[$v['id']] = $v;
        }
        $caseStatus = $tmp;

        $caseCategory = array();
        $caseCategory = $api->getData('case/category?courtType=4');
        $cat= json_decode($caseCategory, true);

        $caseType = array();
        $caseType = $api->getData('case/categoryType?catId=8');
        $temp = json_decode($caseType, true);

        $caseType = $api->getData('case/categoryType?catId=9');
        $caseType = json_decode($caseType, true);
        $caseType = array_merge($temp, $caseType);
        $tmp = array();
        foreach ($caseType as $v) {
            $tmp[$v['id']] = $v;
        }
        $caseType = $tmp;
       

        $caseShortDecision = $api->getData('case/shortDecision');
        $temp = json_decode($caseShortDecision, true);
        foreach ($temp as $v) {
            $tmp[$v['id']] = $v;
        }
        $caseShortDecision = $tmp;


        $caseShortDecisionNew = $api->getData('case/shortDecision?caseType=8');
        $shortDecision = json_decode($caseShortDecisionNew, true);
        $caseShortDecisionNew = $api->getData('case/shortDecision?caseType=9');
        $shortDecisioncriminal = json_decode($caseShortDecisionNew, true);

        $caseShortDecisionNew = array_merge($shortDecision, $shortDecisioncriminal);
        $tmp = array();
        foreach ($caseShortDecision as $v) {
            $tmp[$v['id']] = $v;
        }
        $caseShortDecisionNew = $tmp;
        
        return view('causelist.index', compact(['title','causeList','caseDetails','caseShortDecision','caseShortDecisionNew','date','caseStatus','caseType','caseCategory']));
    }
    public function decision(Request $request)
    {
        $causeListId = $request->id;
        $causeList = CauseList::where('id', $causeListId)->get()->toArray();
        foreach ($causeList as $val) {
            $caseId[]=$val['case_id'];
        }
        $caseDetails = CaseDetails::whereIn('id', $caseId)->get()->toArray();
        $caseDetails = $caseDetails[0];

        $api= new Api();
        $caseType = $api->getData('case/categoryType?catId=8');
        $temp = json_decode($caseType, true);
        $caseType = $api->getData('case/categoryType?catId=9');
        $caseType = json_decode($caseType, true);
        $caseType = array_merge($temp, $caseType);
        $tmp = array();
        foreach ($caseType as $v) {
            $tmp[$v['id']] = $v;
        }
        $caseType = $tmp;

        return view('causelist.decision', compact(['caseDetails','causeList','caseType']));
    }
    public function update(Request $request)
    {
        if (isset($request->check)) {
            $value = $request->all();
            //dd($value);
            foreach ($value['check'] as $val) {
                $next_hearing_date = $value['next_hearing_date'][$val];
                $case_status = $value['case_status'][$val];
                $case_short_decision = $value['case_short_decision'][$val];
                $case_short_decision = $value['case_short_decision'][$val];

                $causeListval = CauseList::find($val);
                $causeListval->next_hearing_date = $next_hearing_date;
                $causeListval->case_status = $case_status;
                $causeListval->case_short_decision = $case_short_decision;
                $causeListval->case_details_decision = $request->case_details_decision;
                //$causeListval->cause_of_hearing_details = $request->case_details_decision;
                $causeListval->save();

                if ($case_status!=3) {
                    $causeList = new CauseList();
                    $causeList->id = uniqid();
                    $causeList->office_id = $causeListval->office_id;
                    $causeList->office_unit_id = $causeListval->office_unit_id;
                    $causeList->case_id = $causeListval->case_id;
                    $causeList->court_no = $causeListval->court_no;
                    $causeList->hearing_date = $next_hearing_date;
                    $causeList->case_status = $case_status;
                    $causeList->cause_of_hearing = $case_short_decision;
                    $causeList->cause_of_hearing_details = $request->case_details_decision;
                    $causeList->save();
                }
            }
        } else {
            $ids = array();
            if (isset($request->id)) {
                $ids[] = $request->id;
            } elseif (isset($request->ids)) {
                $ids = explode(',', $request->ids);
            }

            foreach ($ids as $id) {
                $causeListval = CauseList::find($id);
                $causeListval->next_hearing_date = $request->next_hearing_date;
                $causeListval->case_status = $request->case_status;
                $causeListval->case_short_decision = $request->case_short_decision;
                $causeListval->case_details_decision = $request->case_details_decision;
                $causeListval->save();

                if ($causeListval->case_status!=3) {
                    $causeList = new CauseList();
                    $causeList->id = uniqid();
                    $causeList->office_id = $causeListval->office_id;
                    $causeList->office_unit_id = $causeListval->office_unit_id;
                    $causeList->case_id = $causeListval->case_id;
                    $causeList->court_no = $causeListval->court_no;
                    $causeList->hearing_date = $request->next_hearing_date;
                    $causeList->case_status = $request->case_status;
                    $causeList->cause_of_hearing = $request->case_short_decision;
                  
                    $causeList->save();
                }
            }
        }

        return redirect(config('app.url').'causelist')->with('success', 'কার্যতালিকার নতুন সিদ্ধান্ত দেওয়া হয়েছে');
        ;
    }

    public function modify(Request $request)
    {
        $causeListId = $request->id;
        $causeList = CauseList::where('id', $causeListId)->get()->toArray();
        if (!empty($causeList)) {
            $causeList = $causeList[0];

            $caseDetails = CaseDetails::where('id', $causeList['case_id'])->get()->toArray();
            if (!empty($caseDetails)) {
                $caseDetails = $caseDetails[0];

                $api = new Api();
                $caseType = $api->getData('case/categoryType?catId=8');
                $temp = json_decode($caseType, true);
                $caseType = $api->getData('case/categoryType?catId=9');
                $caseType = json_decode($caseType, true);
                $caseType = array_merge($temp, $caseType);
                $tmp = array();
                foreach ($caseType as $v) {
                    $tmp[$v['id']] = $v;
                }
                $caseType = $tmp;

                return view('causelist.modify', compact(['causeList', 'caseDetails', 'caseType']));
            }
        }
        return redirect(config('app.url').'causelist');
    }

    public function modifySchedule(Request $request)
    {
        $causeList = CauseList::find($request->id);
        $causeList->hearing_date = $request->hearing_date;
        $causeList->save();
        return redirect(config('app.url').'causelist')->with('success', 'কার্যতালিকা সংশোধন করা হয়েছে');
        ;
    }
}
