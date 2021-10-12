@extends('layouts.app')

@section('content')
<section class="box-typical box-typical-dashboard scrollable pl-3 pr-3 hidd">
    <header class="panel-heading position-relative clearfix bn-font px-0">
    <h3 class="panel-title mb-2 bn-font"><?php echo (isset(request()->id)?'মামলা হালনাগাদ করুন':'নতুন মামলা নথিভুক্ত করুন') ?></h3>
    </header>

    <form id="submit-form" action="<?php echo $baseUrl ?>case/update" method="post" enctype="multipart/form-data" class="forms-sample">
        @csrf
        <div class="row entry-form">
            <div class="col-sm-4">
                <div class="card card-green">
                    <header class="card-header bn-font p-2">মামলার তথ্য</header>
                    <div class="card-block">
                        <div class="row mb-3">
                            <input type="hidden" name="id" value="<?php echo (isset($caseDetails['id'])?$caseDetails['id']:''); ?>">
                            <!-- <div class="col-sm-12">
                                <div class="form-group row">
                                    <label class="col-sm-5 col-form-label form-control-sm bn-font">সাল</label>
                                    <div class="col-sm-7">
                                        <input type="text" value="<?php echo (isset($caseDetails['case_year'])?$caseDetails['case_year']:''); ?>" class="yearpicker form-control bn-font" name="case_year" required />
                                    </div>
                                </div>
                            </div> -->
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label class="col-sm-5 col-form-label form-control-sm bn-font">প্রকার<span class="text-danger ml-1 font-20">*</span></label>
                                    <div class="col-sm-7">
                                        <select class="form-control form-control-sm bn-font case_category" name="case_category" required <?php echo (isset($caseDetails['case_category'])?'data-id="'.$caseDetails['case_category'].'"':''); ?>>
                                            <option value="0">বাছাই করুন</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label class="col-sm-5 col-form-label form-control-sm bn-font">ধরন <span class="text-danger ml-1 font-20">*</span></label>
                                    <div class="col-sm-7">
                                        <select class="form-control form-control-sm bn-font" name="case_type" required <?php echo (isset($caseDetails['case_type'])?'data-id="'.$caseDetails['case_type'].'"':''); ?> >

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label class="col-sm-5 col-form-label form-control-sm bn-font">থানা</label>
                                    <div class="col-sm-7">
                                        <select class="form-control form-control-sm bn-font" name="thana_id" <?php echo (isset($caseDetails['thana_id'])?'data-id="'.$caseDetails['thana_id'].'"':''); ?> >
                                            <option value="0">বাছাই করুন</option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-5 col-form-label form-control-sm bn-font">মামলা নং <span class="text-danger ml-1 font-20">*</span></label>
                                    <div class="col-sm-7 relative">
                                        <div style="width: 40%;float: left;"><input style="padding: 5px !important;" type="text" value="<?php echo (isset($caseDetails['case_no'])?$caseDetails['case_no']:''); ?>" name="case_no" autocomplete="off" class="form-control form-control-sm" required>
                                        <span style="margin-left:10px" class="font-12">মামলা নং</span>
                                        </div>
                                        <div style="width: 10%;float: left;margin: 6px 0 0 11px">/</div>
                                       <div style="width: 40%;float: left;;"><input style="padding: 5px !important;" type="text" value="<?php echo (isset($caseDetails['case_year'])?$caseDetails['case_year']:''); ?>" class=" form-control bn-font" name="case_year"minlength="4" maxlength="4" required autocomplete="off"/><span style="margin-left:25px" class="font-12">সাল</span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label class="col-sm-5 col-form-label form-control-sm bn-font">দায়েরের তারিখ</label>
                                    <div class="col-sm-7 relative">
                                        <input type="text" value="<?php echo (isset($caseDetails['case_date'])?$caseDetails['case_date']:''); ?>"  name="case_date" autocomplete="off" class="form-control form-control-sm date">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 <?php echo (isset(request()->type)?'hidden':'') ?>">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label form-control-sm">বিবরণ</label>
                                    <div class="col-sm-8">
                                        <div class="form-check pl-0">
                                            <label class="form-check-label">
                                                <textarea name="case_details" value="" class="form-control bn-font" rows="3" cols="10"><?php echo (isset($caseDetails['case_details'])?$caseDetails['case_details']:''); ?></textarea>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 <?php echo (isset(request()->type)?'hidden':'') ?>">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label form-control-sm ">সংযুক্তি</label>
                                    <div class="col-sm-8">
                                        <input type="file" name="file[]"  id="exampleFormControlFile1" autocomplete="off" class="form-control form-control-sm border-0 font-14 w-100 overflow-hidden">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-4">
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card card-green">
                            <header class="card-header bn-font p-2">বাদির তথ্য</header>
                            <div class="card-block">

                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label form-control-sm bn-font">নাম</label>
                                    <div class="col-sm-8 relative relative-password">
                                        <input type="text" value="<?php echo (isset($caseDetails['complainant_name'])?$caseDetails['complainant_name']:''); ?>" name="complainant_name" autocomplete="off" class="form-control form-control-sm bn-font">
                                    </div>
                                </div>
                                <div class="form-group row <?php echo (isset(request()->type)?'hidden':'') ?>">
                                    <label class="col-sm-4 col-form-label form-control-sm bn-font">আইনজীবীর নাম</label>
                                    <div class="col-sm-8 relative relative-password">
                                        <input type="text" value="<?php echo (isset($caseDetails['complainant_adv_name'])?$caseDetails['complainant_adv_name']:''); ?>" name="complainant_adv_name" autocomplete="off" class="form-control form-control-sm bn-font">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label form-control-sm bn-font">মোবাইল নং</label>
                                    <div class="col-sm-8 relative relative-password">
                                        <input type="text" value="<?php echo (isset($caseDetails['complainant_mobile'])?$caseDetails['complainant_mobile']:''); ?>" name="complainant_mobile" onkeypress="return isNumberKey(event)" pattern="([0-9]{10})|(\([0-9]{3}\)\s+[0-9]{3}\-[0-9]{4})" minlength="11" maxlength="11" autocomplete="off" class="form-control form-control-sm bn-font">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label form-control-sm bn-font">এনআইডি নং</label>
                                    <div class="col-sm-8 relative relative-password">
                                        <input type="text" value="<?php echo (isset($caseDetails['complainant_nid'])?$caseDetails['complainant_nid']:''); ?>" name="complainant_nid" onkeypress="return isNumberKey(event)" pattern="([0-9]{10})|(\([0-9]{3}\)\s+[0-9]{3}\-[0-9]{4})" minlength="11" maxlength="11" autocomplete="off" class="form-control form-control-sm bn-font">
                                    </div>
                                </div>
                                <div class="form-group row <?php echo (isset(request()->type)?'hidden':'') ?>">
                                    <label class="col-sm-4 col-form-label form-control-sm bn-font"> ঠিকানা</label>
                                    <div class="col-sm-8 relative">
                                        <textarea name="complainant_address" class="form-control bn-font" rows="2" cols="10"><?php echo (isset($caseDetails['complainant_address'])?$caseDetails['complainant_address']:''); ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group row <?php echo (isset(request()->type)?'hidden':'') ?>">
                                    <label class="col-sm-4 col-form-label form-control-sm bn-font">তথ্য</label>
                                    <div class="col-sm-8 relative relative-password">
                                        <textarea name="complainant_information" class="form-control bn-font" rows="1" cols="10"><?php echo (isset($caseDetails['complainant_information'])?$caseDetails['complainant_information']:''); ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <div class="card card-green">
                            <header class="card-header bn-font p-2">বিবাদির তথ্য</header>
                            <div class="card-block">

                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label form-control-sm bn-font">নাম</label>
                                    <div class="col-sm-8 relative relative-password">
                                        <input type="text" value="<?php echo (isset($caseDetails['defender_name'])?$caseDetails['defender_name']:''); ?>"  name="defender_name" autocomplete="off" class="form-control form-control-sm bn-font">
                                    </div>
                                </div>
                                <div class="form-group row <?php echo (isset(request()->type)?'hidden':'') ?>">
                                    <label class="col-sm-4 col-form-label form-control-sm bn-font">আইনজীবীর নাম</label>
                                    <div class="col-sm-8 relative relative-password">
                                        <input type="text" value="<?php echo (isset($caseDetails['defender_adv_name'])?$caseDetails['defender_adv_name']:''); ?>" name="defender_adv_name" autocomplete="off" class="form-control form-control-sm bn-font">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label form-control-sm bn-font">মোবাইল নং</label>
                                    <div class="col-sm-8 relative relative-password">
                                        <input type="text" onkeypress="return isNumberKey(event)" minlength="11" maxlength="11" pattern="([0-9]{10})|(\([0-9]{3}\)\s+[0-9]{3}\-[0-9]{4})" value="<?php echo (isset($caseDetails['defender_mobile'])?$caseDetails['defender_mobile']:''); ?>" name="defender_mobile" autocomplete="off" class="form-control form-control-sm bn-font">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label form-control-sm bn-font">এনআইডি নং</label>
                                    <div class="col-sm-8 relative relative-password">
                                        <input type="text" onkeypress="return isNumberKey(event)" minlength="11" maxlength="11" pattern="([0-9]{10})|(\([0-9]{3}\)\s+[0-9]{3}\-[0-9]{4})" value="<?php echo (isset($caseDetails['defender_nid'])?$caseDetails['defender_nid']:''); ?>" name="defender_nid" autocomplete="off" class="form-control form-control-sm bn-font">
                                    </div>
                                </div>
                                <div class="form-group row <?php echo (isset(request()->type)?'hidden':'') ?>">
                                    <label class="col-sm-4 col-form-label form-control-sm bn-font"> ঠিকানা</label>
                                    <div class="col-sm-8 relative">
                                        <textarea name="defender_address" class="form-control bn-font" rows="2" cols="10"><?php echo (isset($caseDetails['defender_address'])?$caseDetails['complainant_address']:''); ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group row <?php echo (isset(request()->type)?'hidden':'') ?>">
                                    <label class="col-sm-4 col-form-label form-control-sm bn-font">তথ্য</label>
                                    <div class="col-sm-8 relative relative-password">
                                        <textarea name="defender_information" class="form-control bn-font" rows="1" cols="10"><?php echo (isset($caseDetails['defender_information'])?$caseDetails['complainant_information']:''); ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if(empty($caseDetails)){ ?>
                    <div class="col-12">
                    <div class="card card-purple mx-0 mt-2">
                        <header class="card-header bn-font p-2">শুনানীর তথ্য</header>
                        <div class="card-block ">
                            <div class="row entry-form">
                                <div class="col-md-6 col-sm-6 ">
                                <div class="form-group row">
                                        <label class="col-sm-5col-form-label form-control-sm bn-font">শুনানির তারিখ<span class="text-danger ml-1 font-20">*</span></label>
                                        <div class="col-sm-7 relative relative-password">
                                            <input type="text" value="" name="hearing_date" autocomplete="off" class="form-control form-control-sm date" required>
                                        </div>
                                    </div>
                                </div>
                                <?php /*<div class="col-sm-4 col-md-4">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label form-control-sm">কোর্ট নং</label>
                                        <div class="col-sm-8 relative relative-password">
                                            <input type="text" value="" name="court_no" autocomplete="off" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>*/ ?>
                               
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-sm-5 col-form-label form-control-sm bn-font">সংক্ষিপ্ত আদেশ<span class="text-danger ml-1 font-20">*</span></label>
                                        <div class="col-sm-7">
                                            <select class="form-control form-control-sm bn-font" name="schedule_details" required>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-md-6 col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label form-control-sm bn-font">কার্যতালিকার বর্ণনা</label>
                                        <div class="col-sm-8 relative relative-password">
                                            <textarea name="schedule_details" class="form-control bn-font" rows="1" cols="10"></textarea>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    </div>
                    <?php } ?>
                </div>
                <div class="mb-2 float-right">
                    <button type="submit" class="btn btn-sm btn-primary bn-font font-weight-normal"><i class="fa fa-save mr-2"></i>সংরক্ষণ করুন</button>
                </div>
            </div>

        </div>

</form>

</section>
<script>
    function en2bn (num){
        var res = str.replace(/1/g, "১");
        var res = str.replace(/2/g, "২");
        var res = str.replace(/3/g, "৩");
        var res = str.replace(/4/g, "৪");
        var res = str.replace(/5/g, "৫");
        var res = str.replace(/6/g, "৬");
        var res = str.replace(/7/g, "৭");
        var res = str.replace(/8/g, "৮");
        var res = str.replace(/9/g, "৯");
        var res = str.replace(/0/g, "০");
        return res;
    }

jQuery(document).ready(function($) {

    $.fn.hasAttr = function(name) {
        return this.attr(name) !== undefined;
    };

    $('input.date').datepicker({
            changeMonth: true,
            changeYear: true,
            'dateFormat':'yy-mm-dd',
            yearRange: "-100:+100",
            showOn: "both",
            //minDate:0,
            buttonImage: "<?php echo $baseUrl ?>/img/calendar.png",
            buttonImageOnly: true,
            beforeShowDay: noHolidays
        });
        $("input.date").datepicker("setDate", new Date());
    function noHolidays(date){
        if (date.getDay() === 5 || date.getDay() === 6)  /* Friday Saturday */
            return [ false, "closed", "Closed on Friday and Saturday" ]
        else
            return [ true, "", "" ]
    }


    $(".yearpicker").yearpicker({
        year: 2021,
        startYear: 1980,
        endYear: 2050,
    });

    $('input[name="case_year"],input[name="complainant_name"],input[name="defender_name"],input[name="complainant_mobile"],input[name="defender_mobile"],input[name="case_no"]').bangla({ enable: true });

    $.ajax({
        type: 'GET',
        url: '<?php echo $baseUrl ?>api',
        data: {'path':'case/category','courtType':4},
        beforeSend: function () {
        },
        success: function (data) {
            data = JSON.parse(data);
             var items = [];
             items.push('<option value="">বাছাই করুন</option>');

             $(data).each(function(i,v){
                 if((v['id']==8 && 1=='<?php echo session()->get('user')['is_civil'] ?>') ||
                     (v['id']==9 && 1=='<?php echo session()->get('user')['is_criminal'] ?>'))
                     items.push('<option value="'+v['id']+'"  >'+v['case_category']+'</option>');
             });
            $('select[name="case_category"]').html(items.join(''));
            //console.log(data);
            $('select[name="case_category"]').select2();
            if($('select[name="case_category"]').hasAttr('data-id')){
                $('select[name="case_category"]').find('option[value="'+$('select[name="case_category"]').attr('data-id')+'"]').attr('selected','selected');
                caseTypeChange();
                $('select[name="case_category"]').select2();
            }

        }
    });
    function caseTypeChange(){
        var v = $('select[name="case_category"]').val();
        if(v!='') {
            $.ajax({
                type: 'GET',
                url: '<?php echo $baseUrl ?>api',
                //api?path=case/categoryType?catId='+v
                data: {
                    'path': 'case/categoryType',
                    'catId': v,
                    'courtUnitId': '<?php echo session()->get('user')['courtUnitId'] ?>'
                },
                beforeSend: function () {
                },
                success: function (data) {
                    data = JSON.parse(data);
                    var items = [];

                    items.push('<option value="">বাছাই করুন</option>');
                    $(data).each(function (i, v) {

                        items.push('<option value="' + v['id'] + '">' + v['case_type'] + '</option>');
                    });
                    $('select[name="case_type"]').html(items.join(''));
                    $('select[name="case_type"]').select2();
                    if ($('select[name="case_type"]').hasAttr('data-id')) {
                        $('select[name="case_type"]').find('option[value="' + $('select[name="case_type"]').attr('data-id') + '"]').attr('selected', 'selected');
                        $('select[name="case_type"]').select2();
                    }

                }
            });
        }
    }
    $('select[name="case_category"]').change(function () {
       caseTypeChange();
       $.ajax({
            type: 'GET',
            url: '<?php echo $baseUrl ?>api?path=case/shortDecision?caseType='+$(this).val(),
            beforeSend: function () {
            },
            success: function (data) {
                //console.log(data);
                data = JSON.parse(data);
                console.log(data);
                var items = [];
                items.push('<option value="">আদেশের সারসংক্ষেপ</option>');

                $(data).each(function(i,v){
                    items.push('<option value="'+v['id']+'" data-case-type-id="' + v['case_id']  + '">'+v['case_short_decision']+'</option>');
                });
                $('select[name="schedule_details"]').html(items.join(''));
                
                $('select[name="schedule_details"]').select2();
            }
        });

    });

    
    $.ajax({
        type: 'GET',
        url: '<?php echo $baseUrl ?>api',
        //?path=geo/getThana?districtId=1
        data: {'path':'geo/getThana','districtId':1},
        beforeSend: function () {
        },
        success: function (data) {
            data = JSON.parse(data);
            var items = [];
            items.push('<option value="">বাছাই করুন</option>');

            $(data).each(function(i,v){
                items.push('<option value="'+v['id']+'">'+v['thana_name_bng']+'</option>');
            });
            $('select[name="thana_id"]').html(items.join(''));
            $('select[name="thana_id"]').select2();
            if($('select[name="thana_id"]').hasAttr('data-id')) {
                $('select[name="thana_id"]').find('option[value="' + $('select[name="thana_id"]').attr('data-id') + '"]').attr('selected', 'selected');
                $('select[name="thana_id"]').select2();
            }

        }
    });
    // $.ajax({
    //     type: 'GET',
    //     url: '<?php echo $baseUrl ?>api?path=case/status',
    //     beforeSend: function () {
    //     },
    //     success: function (data) {
    //         //console.log(data);
    //         data = JSON.parse(data);
    //         //console.log(data);
    //         var items = [];
    //         items.push('<option value="">বাছাই করুন</option>');

    //         $(data).each(function(i,v){
    //             items.push('<option value="1">'+v['case_status']+'</option>');
    //         });
    //         $('select[name="case_status"]').html(items.join(''));
    //         //console.log(data);
    //         $('select[name="case_status"]').select2();
    //     }
    // });


});
function isNumberKey(evt)
{
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;

    return true;
}

</script>
@endsection
