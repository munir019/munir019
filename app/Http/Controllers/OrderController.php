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

class CaseController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Cases';
        $caseId= array();
        $access = new Access();
        if (!$access->hasAccess()) {
            return abort(404);
        }

        $officeId = session()->get('user')['officeId'];
        $officeUnitId = session()->get('user')['officeUnitId'];

        $api= new Api();
        $caseCategory = $api->getData('case/category?courtType=4');
        $cat= json_decode($caseCategory, true);

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
        //dd($caseType);
        $caseStatus = $api->getData('case/status');
        $caseStatus = json_decode($caseStatus, true);
        $temp=array();
        foreach ($caseStatus as $v) {
            $temp[$v['id']]= $v;
        }
        $caseStatus=$temp;
        $date= date('Y-m-d');

        $tmp = explode('/',$request->case_no);
        $caseNo= $tmp[0]; //$request->case_no;
        $caseCategory= $request->case_category;
        $caseTyp= $request->case_type;
        if(isset($tmp[1]))
            $caseYear= $tmp[1];
        else
            $caseYear= $request->case_year;
            
        $caseDate= $request->case_date;

        $get = array();
        if (!empty($caseNo)) {
            $get['caseNo'] = $caseNo;
        }
        if (!empty($caseCategory)) {
            $get['caseCategory'] = $caseCategory;
        }
        if (!empty($caseTyp)) {
            $get['caseTyp'] = $caseTyp;
        }
        if (!empty($caseYear)) {
            $get['caseYear'] = $caseYear;
        }
        if (!empty($caseDate)) {
            $get['caseDate'] = $caseDate;
        }


        $caseDetails = CaseDetails::where('office_id', $officeId)
            ->where('office_unit_id', $officeUnitId)
            ->when($caseYear, function ($query, $caseYear) {
                return $query->where('case_year', $caseYear);
            })->when($caseDate, function ($query, $caseDate) {
                return $query->where('case_date', $caseDate);
            })->when($caseCategory, function ($query, $caseCategory) {
                return $query->where('case_category', $caseCategory);
            })->when($caseTyp, function ($query, $caseTyp) {
                return $query->where('case_type', $caseTyp);
            })->when($caseNo, function ($query, $caseNo) {
                return $query->where('case_no', $caseNo);
            })->orderBy('created_at', 'Asc')->limit(100)->get()->toArray();
        foreach ($caseDetails as $val) {
            $caseId[] =$val['id'];
        }

        $causeList = CauseList::whereIn('case_id', $caseId)->orderBy('created_at', 'ASC')->get()->toArray();
        $tmp = array();
        foreach ($causeList as $v) {
            $tmp[$v['case_id']] = $v;
        }
        $causeList = $tmp;

        return view('case.index', compact(['title','caseDetails','causeList','caseId','get','caseType','caseStatus','cat']));
    }

    public function caseinformation(Request $request)
    {
        $title = 'Cases';
        $caseId= array();
        $access = new Access();
        if (!$access->hasAccess()) {
            return abort(404);
        }

        $officeId = session()->get('user')['officeId'];
        $officeUnitId = session()->get('user')['officeUnitId'];

        $api= new Api();
        $caseCategory = $api->getData('case/category?courtType=4');
        $cat= json_decode($caseCategory, true);

        $caseShortDecision = $api->getData('case/shortDecision?caseType=8');
        $shortDecision = json_decode($caseShortDecision, true);
        $caseShortDecision = $api->getData('case/shortDecision?caseType=9');
        $shortDecisioncriminal = json_decode($caseShortDecision, true);

        $caseShortDecision = array_merge($shortDecision, $shortDecisioncriminal);
        $tmp = array();
        foreach ($caseShortDecision as $v) {
            $tmp[$v['id']] = $v;
        }
        $caseShortDecision = $tmp;
        //dd($caseShortDecision);

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

        $caseStatus = $api->getData('case/status');
        $caseStatus = json_decode($caseStatus, true);
        $temp=array();
        foreach ($caseStatus as $v) {
            $temp[$v['id']]= $v;
        }
        $caseStatus=$temp;
        //dd($caseStatus);
        $date= date('Y-m-d');

        $tmp = explode('/',$request->case_no);
        $caseNo= $tmp[0]; //$request->case_no;
        $caseCategory= $request->case_category;
        $caseTyp= $request->case_type;
        if(isset($tmp[1]))
            $caseYear= $tmp[1];
        else
            $caseYear= $request->case_year;
            
        $caseDate= $request->case_date;

        $get = array();
        if (!empty($caseNo)) {
            $get['caseNo'] = $caseNo;
        }
        if (!empty($caseCategory)) {
            $get['caseCategory'] = $caseCategory;
        }
        if (!empty($caseTyp)) {
            $get['caseTyp'] = $caseTyp;
        }
        if (!empty($caseYear)) {
            $get['caseYear'] = $caseYear;
        }
        if (!empty($caseDate)) {
            $get['caseDate'] = $caseDate;
        }
    $caseDetails= array();
    if(!empty($get)){
        $caseDetails = CaseDetails::where('office_id', $officeId)
            ->where('office_unit_id', $officeUnitId)
            ->when($caseYear, function ($query, $caseYear) {
                return $query->where('case_year', $caseYear);
            })->when($caseDate, function ($query, $caseDate) {
                return $query->where('case_date', $caseDate);
            })->when($caseCategory, function ($query, $caseCategory) {
                return $query->where('case_category', $caseCategory);
            })->when($caseTyp, function ($query, $caseTyp) {
                return $query->where('case_type', $caseTyp);
            })->when($caseNo, function ($query, $caseNo) {
                return $query->where('case_no', $caseNo);
            })->orderBy('created_at', 'desc')->limit(100)->get()->toArray();
           
        foreach ($caseDetails as $val) {
            $caseId[] =$val['id'];
        }
    }

        $causeList = CauseList::whereIn('case_id', $caseId)->orderBy('created_at', 'ASC')->get()->toArray();
        
        $tmp = array();
        foreach ($caseDetails as $v) {
            $tmp[$v['id']] = $v;
        }
        $caseDetails = $tmp;
        //dd($caseDetails);
        return view('caseinformation.index', compact(['title','caseDetails','caseShortDecision','causeList','caseId','get','caseType','caseStatus','cat']));
    }
    public function modifyHearingDate(Request $request)
    {
       
        $causeList = CauseList::find($request->id);
        //dd($causeList);
        $causeList->hearing_date = $request->hearing_date;
        $causeList->save();
        return redirect(config('app.url').'case')->with('success','updated');
       
    }

    public function add(Request $request)
    {
        $title = 'Add Case';
        $caseDetails = '';
        return view('case.modify', compact(['caseDetails']));
    }

    public function update(Request $request)
    {
        $result = array('status'=>0);
        if ($request->isMethod('post')) {
            $officeId = session()->get('user')['officeId'];
            $officeUnitId = session()->get('user')['officeUnitId'];

            $caseId='';
            if (isset($request->id)) {
                $caseDetails = CaseDetails::find($request->id);
                $msg = 'মামলাটি হালনাগাদ করা হয়েছে';
            } else {
                $caseDetails = new CaseDetails();
                $caseId = $caseDetails->id = uniqid();
                $caseDetails->office_id = $officeId;
                $caseDetails->office_unit_id = $officeUnitId;
                $sendSms = true;
                $msg = 'মামলাটি সংরক্ষণ করা হয়েছে';
            }
            $image = array();
            if ($request->hasfile('file')) {
                foreach ($request->file('file') as $file) {
                    $ext = $file->getClientOriginalName();
                    $token = time();
                    $prefix = 'attachment';
                    $name = $prefix.'_'.$token.'.'.$ext;
                    $path = public_path().'/img/attachment';
                    if (!is_dir($path)) {
                        mkdir($path);
                    }
                    $file->move($path, $name);
                    $image[] = $name;
                }
            }

            $caseDetails->case_year = $request->case_year;
            $caseDetails->case_category = $request->case_category;
            $caseDetails->case_type = $request->case_type;
            $caseDetails->thana_id = $request->thana_id;
            $caseDetails->case_no = $request->case_no;
            if (empty($request->case_date)) {
                $caseDetails->case_date = date('Y-m-d');
            } else {
                $caseDetails->case_date = $request->case_date;
            }
            $caseDetails->case_details = $request->case_details;
            if (!empty($image)) {
                $caseDetails->attachment= json_encode($image, JSON_UNESCAPED_UNICODE);
            }

            $caseDetails->complainant_name = $request->complainant_name;
            $caseDetails->complainant_adv_name = $request->complainant_adv_name;
            $caseDetails->complainant_mobile = $request->complainant_mobile;
            $caseDetails->complainant_nid = $request->complainant_nid;
            $caseDetails->complainant_address = $request->complainant_address;
            $caseDetails->complainant_information = $request->complainant_information;
            $caseDetails->defender_name = $request->defender_name;
            $caseDetails->defender_adv_name = $request->defender_adv_name;
            $caseDetails->defender_mobile = $request->defender_mobile;
            $caseDetails->defender_nid = $request->defender_nid;
            $caseDetails->defender_address = $request->defender_address;
            $caseDetails->defender_information = $request->defender_information;

            $caseDetails->save();

            if (isset($request->hearing_date)!='') {
                $causeList= new CauseList();
                $causeList->id = uniqid();
                $causeList->office_id = $officeId;
                $causeList->office_unit_id = $officeUnitId;
                $causeList->case_id = $caseId;
                $causeList->hearing_date = $request->hearing_date;
                $causeList->court_no = $request->court_no;
                $causeList->case_status = 1;
                $causeList->schedule_details = $request->schedule_details;
                $causeList->case_short_decision = $request->case_short_decision;
                $causeList->save();
            }
            $result = array('status'=>1);
        }
        return redirect(config('app.url').'case')->with('success', $msg);
        //return view('case.index',compact(['caseDetails','causeList']));
    }
    public function renewCase(Request $request)
    {
        if (isset($request->hearing_date)!='') {
            $caseDetails = CaseDetails::find($request->id);
            $causeList= new CauseList();
            $causeList->id = uniqid();
            $causeList->case_id = $caseDetails->id;
            $causeList->hearing_date = $request->hearing_date;
            $causeList->case_short_decision = $request->case_short_decision;
            $causeList->schedule_details = $request->schedule_details;
            $causeList->office_id = $caseDetails->office_id;
            $causeList->office_unit_id = $caseDetails->office_unit_id;
            $causeList->case_status = 1;
            $causeList->save();
        }
        return redirect(config('app.url').'case')->with('success','মামলাটি সংরক্ষণ করা হয়েছে');
    }


    public function modify(Request $request)
    {
        $caseDetails = CaseDetails::where('id', $request->id)->get()->toArray();
        if (!empty($caseDetails)) {
            $caseDetails =  $caseDetails[0];
        }

        return view('case.modify', compact(['caseDetails']));
    }
}
