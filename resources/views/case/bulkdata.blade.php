@extends('layouts.app')

@section('content')
<section class="box-typical box-typical-dashboard scrollable pl-3 pr-3 hidd p-3">
    <header class="panel-heading position-relative clearfix bn-font px-0">
    <h3 class="panel-title mb-2 bn-font"><?php echo (isset(request()->id)?'মামলা হালনাগাদ করুন':'নতুন মামলা নথিভুক্ত করুন') ?></h3>
    </header>

    <form id="submit-form" action="<?php echo $baseUrl ?>case/bulkUpload" method="post" enctype="multipart/form-data" class="forms-sample">
        @csrf
        <div class="row entry-form">
            <div class="col-sm-12">
                <div class="row">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label form-control-sm bn-font text-right">Bulk Case Entry</label>
                        <div class="col-sm-8">
                            <input type="file"  name="file_upload">
                        </div>
                    </div>
                    <div class="mb-2 float-right">
                        <button type="submit" class="btn btn-sm btn-primary bn-font font-weight-normal"><i class="fa fa-save mr-2"></i>সংরক্ষণ করুন</button>
                    </div>
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
