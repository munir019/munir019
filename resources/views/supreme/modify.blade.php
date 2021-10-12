@extends('layouts.app')

@section('content')
<section class="box-typical box-typical-dashboard scrollable pl-3 pr-3 hidd">
    <header class="panel-heading position-relative clearfix bn-font px-0">
    <h3 class="panel-title mb-2 bn-font"><?php echo (isset(request()->id)?'Edit case':'Add New Cause List') ?></h3>
    </header>

    <form id="submit-form" action="<?php echo $baseUrl ?>supreme/update" method="post" enctype="multipart/form-data" class="forms-sample">
        @csrf
        <div class="row entry-form">
            <div class="col-sm-12">
                <div class="card card-blue">
                    <header class="card-header bn-font p-2">Bench Information</header>
                    <div class="card-block">
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label form-control-sm bn-font">Bench List<span class="text-danger ml-1 font-16">*</span></label>
                                <div class="col-sm-9">
                                
                                    <select  class="form-control form-control-sm bn-font" name="bench_id">
                                        <option>Select</option>
                                        <?php
                                        
                                        foreach($judge_list as $key=>$val)
                                        {
                                            echo'<option value="'.$key.'" '.(isset($appellate['bench_id']) && $key==$appellate['bench_id']?'selected':'').'>'.$val.'</option>'; 
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div> 
            </div>
        </div>        
        <div class="row entry-form">
            
            <div class="col-sm-4">
                   
                <div class="card card-green">
                    <header class="card-header bn-font p-2">Case Information</header>
                        
                    <div class="card-block">
                        <div class="row mb-3">
                            <input type="hidden" name="id" value="<?php echo (isset($appellate['id'])?$appellate['id']:''); ?>">
                            
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label class="col-sm-5 col-form-label form-control-sm bn-font">Year</label>
                                    <div class="col-sm-7">
                                        <input type="text" value="<?php echo (isset($appellate['case_year'])?$appellate['case_year']:''); ?>" class="yearpicker form-control bn-font" name="case_year" required />
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label class="col-sm-5 col-form-label form-control-sm bn-font">Category<span class="text-danger ml-1 font-16">*</span></label>
                                    <div class="col-sm-7">
                                        <select class="form-control form-control-sm bn-font case_category" name="case_category" required <?php echo (isset($appellate['case_category'])?'data-id="'.$appellate['case_category'].'"':''); ?>">
                                            
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label class="col-sm-5 col-form-label form-control-sm bn-font">Type <span class="text-danger ml-1 font-16">*</span></label>
                                    <div class="col-sm-7">
                                        <select class="form-control form-control-sm bn-font" name="case_type" required <?php echo (isset($appellate['case_type'])?'data-id="'.$appellate['case_type'].'"':''); ?> >
                                            
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-sm-4 col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-5 col-form-label form-control-sm bn-font">Case No <span class="text-danger ml-1 font-16">*</span></label>
                                    <div class="col-sm-7 relative">
                                        <input type="text" value="<?php echo (isset($appellate['case_no'])?$appellate['case_no']:''); ?>" name="case_no" autocomplete="off" class="form-control form-control-sm" required>
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
                            <header class="card-header bn-font p-2">Complainant Information</header>
                            <div class="card-block">

                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label form-control-sm bn-font">Name</label>
                                    <div class="col-sm-8 relative relative-password">
                                        <input type="text" value="<?php echo (isset($appellate['complainant_name'])?$appellate['complainant_name']:''); ?>" name="complainant_name" autocomplete="off" class="form-control form-control-sm bn-font">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label form-control-sm bn-font">Mobile No</label>
                                    <div class="col-sm-8 relative relative-password">
                                        <input type="text" value="<?php echo (isset($appellate['complainant_mobile'])?$appellate['complainant_mobile']:''); ?>" name="complainant_mobile" onkeypress="return isNumberKey(event)" pattern="([0-9]{10})|(\([0-9]{3}\)\s+[0-9]{3}\-[0-9]{4})" minlength="11" maxlength="11" autocomplete="off" class="form-control form-control-sm bn-font">
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <div class="card card-green">
                            <header class="card-header bn-font p-2">Defender Information</header>
                            <div class="card-block">

                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label form-control-sm bn-font">Name</label>
                                    <div class="col-sm-8 relative relative-password">
                                        <input type="text" value="<?php echo (isset($appellate['defender_name'])?$appellate['defender_name']:''); ?>"  name="defender_name" autocomplete="off" class="form-control form-control-sm bn-font">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label form-control-sm bn-font">Mobile No</label>
                                    <div class="col-sm-8 relative relative-password">
                                        <input type="text" onkeypress="return isNumberKey(event)" minlength="11" maxlength="11" pattern="([0-9]{10})|(\([0-9]{3}\)\s+[0-9]{3}\-[0-9]{4})" value="<?php echo (isset($appellate['defender_mobile'])?$appellate['defender_mobile']:''); ?>" name="defender_mobile" autocomplete="off" class="form-control form-control-sm bn-font">
                                    </div>
                                </div>
                                
                                
                            </div>
                        </div>
                    </div>
                    <?php if(empty($caseDetails)){ ?>
                    <div class="col-12">
                    <div class="card card-purple mx-0 mt-2">
                        <header class="card-header bn-font p-2">Hearing Information</header>
                        <div class="card-block ">
                            <div class="row entry-form">
                                <div class="col-md-6 col-sm-6 ">
                                <div class="form-group row">
                                        <label class="col-sm-5col-form-label form-control-sm bn-font">Hearing Date<span class="text-danger ml-1 font-16">*</span></label>
                                        <div class="col-sm-7 relative relative-password">
                                            <input type="text" value=" <?php echo (isset($appellate['hearing_date'])?$appellate['hearing_date']:''); ?>" name="hearing_date" value="<?php ?>" autocomplete="off" class="form-control form-control-sm date" required>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-sm-5 col-form-label form-control-sm bn-font">Case Condition<span class="text-danger ml-1 font-16">*</span></label>
                                        <div class="col-sm-7">
                                            <select class="form-control form-control-sm bn-font" name="case_status"<?php echo (isset($appellate['case_status'])?'data-id="'.$appellate['case_status'].'"':''); ?> required>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    <?php } ?>
                </div>
                <div class="mb-2 float-right">
                    <button type="submit" class="btn btn-sm btn-primary bn-font font-weight-normal"><i class="fa fa-save mr-2"></i>Save</button>
                </div>
            </div>

        </div>
        <input type="hidden" name="judge_name" class="judge_name"/>
</form>

</section>
<script>
    jQuery(document).ready(function($) {
    $.fn.hasAttr = function(name) {
        return this.attr(name) !== undefined;
    };
});
    jQuery(document).ready(function($) {
        $.fn.hasAttr = function(name) {
            return this.attr(name) !== undefined;
        };
        $('.judge_name').val($(this).find('option[value="'+$('select[name="bench_id"]').val()+'"]').text());
        $('select[name="bench_id"]').change(function(){
            $('.judge_name').val($(this).find('option[value="'+$(this).val()+'"]').text());
        });

    });
    
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
    $('input.date').datepicker({
            changeMonth: true,
            changeYear: true,
            'dateFormat':'yy-mm-dd',
            yearRange: "-100:+100",
            showOn: "both",
            buttonImage: "<?php echo $baseUrl ?>/img/calendar.png",
            buttonImageOnly: true,
        });

    $(".yearpicker").yearpicker({
        year: 2020,
        startYear: 1980,
        endYear: 2050,
    });

    //$('input[name="complainant_name"],input[name="defender_name"],input[name="complainant_mobile"],input[name="defender_mobile"],input[name="case_no"]').bangla({ enable: true });

    $.ajax({
        type: 'GET',
        url: '<?php echo $baseUrl ?>api',
        //?path=case/category?courtType=<?php //echo (session()->get('user')['divisionType']==1?2:3) ?>',
        data: {'path':'case/category','courtType':'<?php echo (session()->get('user')['divisionType']==1?2:3) ?>'},
        beforeSend: function () {
        },
        success: function (data) {
            data = JSON.parse(data);
             var items = [];
             items.push('<option value="">বাছাই করুন</option>');

             $(data).each(function(i,v){
                 items.push('<option value="'+v['id']+'"  >'+v['case_category']+'</option>');
             });
            $('select[name="case_category"]').html(items.join(''));
            //console.log(data);
           
            if($('select[name="case_category"]').hasAttr('data-id')){
                $('select[name="case_category"]').find('option[value="'+$('select[name="case_category"]').attr('data-id')+'"]').attr('selected','selected');
                caseTypeChange();
            }
        $('select[name="case_category"]').select2();

        }
    });
    function caseTypeChange(){
        var v = $('select[name="case_category"]').val();
        $.ajax({
            type: 'GET',
            url: '<?php echo $baseUrl ?>api',//?path=case/categoryType?catId='+v,
            data: {'path':'case/categoryType','catId':v},
            beforeSend: function () {
            },
            success: function (data) {
                data = JSON.parse(data);
                var items = [];

                items.push('<option value="">বাছাই করুন</option>');
                $(data).each(function(i,v){

                        items.push('<option value="'+v['id']+'">'+v['case_type']+'</option>');
                });
                 $('select[name="case_type"]').html(items.join(''));
                
                if($('select[name="case_type"]').hasAttr('data-id')){
                    $('select[name="case_type"]').find('option[value="'+$('select[name="case_type"]').attr('data-id')+'"]').attr('selected','selected');
                }

                
                $('select[name="case_type"]').select2();
            }
        });

    }
    $('select[name="case_category"]').change(function () {
       caseTypeChange();
    });

    
    $.ajax({
        type: 'GET',
        url: '<?php echo $baseUrl ?>api',
        data: {'path':'case/status'},
        beforeSend: function () {
        },
        success: function (data) {
            //console.log(data);
            data = JSON.parse(data);
            //console.log(data);
            var items = [];
            items.push('<option value="">বাছাই করুন</option>');

            $(data).each(function(i,v){
                items.push('<option value="'+v['id']+'">'+v['case_status']+'</option>');
            });
            $('select[name="case_status"]').html(items.join(''));
            //console.log(data);
            
            if($('select[name="case_status"]').hasAttr('data-id')){
           $('select[name="case_status"]').find('option[value="'+$('select[name="case_status"]').attr('data-id')+'"]').attr('selected','selected');
                }
            $('select[name="case_status"]').select2();
        }
    });
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
