@extends('layouts.app')

@section('content')
    <?php
    
    function en2bn ($number){
        $search_array= array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
        $replace_array= array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
        $en_number = str_replace($search_array, $replace_array, $number);

        return $en_number;
    }

    function en2bnDate ($number){
        $search_array= array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
        $replace_array= array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
        $en_number = str_replace($search_array, $replace_array, $number);

        $en_number = explode('-',$en_number);
        $en_number = $en_number[2].'-'.$en_number[1].'-'.$en_number[0]. ' ইং';

        return $en_number;
    }
    ?>
    <section class="box-typical box-typical-dashboard scrollable pb-2">
        <header class="panel-heading position-relative clearfix en-font">
            <h3 class="panel-title mb-0 bn-font text-center border-bottom pb-2">
                <a class="color-black-blue add-causes font-22 font-weight-bold text-success " >দৈনিক  কার্যতালিকা</a>
            </h3>
        </header>
        <form id="submit-form" action="<?php echo $baseUrl ?>causelist" method="post" enctype="multipart/form-data" class="forms-sample">
            @csrf
            <div class="form-group row pl-4 pr-3 mt-2">
                <label class="col-md-2 col-sm-12 col-form-label form-control-sm text-left bn-font font-18">শুনানির তারিখ:</label>
                <div class="col-md-3 col-sm-12 ">
                    <input type="text" value="<?php echo $date ?>" name="case_date" autocomplete="off" class="form-control form-control-sm date">
                </div>
                <div class="col-md-3 col-sm-12">
                    <button type="submit" class="btn btn-sm btn-primary bn-font font-weight-normal"><i class="fa fa-search mr-2"></i>অনুসন্ধান করুন</button>
                </div>

            </div>

        </form>
        
        {{-- <button type="save" class="btn btn-sm btn-success bn-font pull-right mr-3 update-causes font-weight-normal"><i class="fa fa-gavel mr-2"></i>সম্মিলিত  সিদ্ধান্ত</button> --}}

        <button type="save" class="btn btn-sm btn-success bn-font pull-right mr-3 update-multi-causes font-weight-normal mb-2"><i class="fa fa-gavel mr-2"></i>সিদ্ধান্ত</button>
        

        <div class="m-3 mt-0 mb-0">
             <form action="<?php echo $baseUrl ?>causelist/update" method="post" id="multi-submit">
                        @csrf
            <table class="table bg-light border border-top-0 case-list">
                <thead>
                <tr>
                    <th align="center" style="width:10px"></th>
                    <th align="center"  style="width:98px"><input class="all_cause mr-2"  type="checkbox"/><span class="bn-font font-16" align="center">ক্রমিক নং </span></th>
                    <!-- <th><div class="bn-font" align="center">ক্রমিক নং </div></th> -->
                    <th  style="width:80px"><div class="bn-font font-16" align="center">মামলা নং</div></th>
                    <th><div class="bn-font">বাদি</div></th>
                        <th><div class="bn-font">বিবাদি</div></th>
                    <th><div class="bn-font text-center font-16" align="center">কার্যক্রম</div></th>
                    <th><div class="bn-font text-center font-16"align="center" >পরবর্তী তারিখ</th>
                    <th><div class="bn-font font-16" align="center">সংক্ষিপ্ত আদেশ</div></th>
                </tr>
                </thead>
                <tbody>
                   
                    <?php

                    $i=1;
                    foreach ($causeList as $k=>$v) {
                  
                        if (isset($caseDetails[$v['case_id']])){
                        echo '<tr data-case-type-id="'.$caseDetails[$v['case_id']]['case_type'].'" data-case-category-id="'.$caseDetails[$v['case_id']]['case_category'].'" data-case-status="'.$v['case_status'].'">';
                        echo '<td>';
                        echo '<div class="text-small text-primary bn-font text-center">';
                                if(isset($caseStatus[$v['case_status']])){
                                    if($v['case_status']==1)
                                        $cl = 'success';
                                    else if($v['case_status']==2)
                                        $cl = 'warning';
                                    else if($v['case_status']==3)
                                        $cl = 'danger';
                                     echo    '<i class="fa fa-star text-'.$cl.'"></i>';
                                    //echo '<span class="bn-font label-'.$cl.' label font-weight-normal">';
                                       // echo $caseStatus[$v['case_status']]['case_status'];
                                    //echo '</span>';
                                }
                        echo '</div>';
                        echo '</td>';
                        
                        if(isset($v['case_short_decision'])){
                        echo  '<td>';
                        echo  '<span class="text-center ml-4" align="center">'.en2bn($i).'</span>';
                        echo '</td>';
                        }else{
                        echo  '<td class="text-left ml-3"><input class="causeId mr-2" type="checkbox" name="check['.$v['id'].']" value="'.$v['id'].'" />';
                        echo  '<span class="text-center" align="center">'.en2bn($i).'</span>';
                        echo '</td>';
                        }
                        // echo  '<td class="text-center" align="center">'.en2bn($i).'<div class="text-small text-primary bn-font text-center">';
                        // '</td>';
                        echo '<td>';
                        echo '<div class="text-small text-primary bn-font text-center"><span class="color-black-blue">';
                            /*if(isset($caseType[$caseDetails[$v['case_id']]['case_type']])){
                                echo '<span class="mr-1">'.$caseType[$caseDetails[$v['case_id']]['case_type']]['case_type'].'</span>';
                            }*/
                            if(isset($v['next_hearing_date'])){
                                echo '<a class="border-0" href="http://training-causelistapp.judiciary.org.bd/causelist?case_date='.$v['next_hearing_date'].'">'.en2bn($caseDetails[$v['case_id']]['case_no']).'</a>';
                             }else{
                                echo en2bn($caseDetails[$v['case_id']]['case_no']);
                               
                            }
                        echo '</span></div>';
                        echo '</td>';
                        echo '<td>';
                        echo en2bn($caseDetails[$v['case_id']]['complainant_name']);
                        echo '<div class="text-small text-success bn-font">মোবাইল নং : <span class="color-black-blue">'.en2bn($caseDetails[$v['case_id']]['complainant_mobile']).'</span></div>';
                        echo '</span></div>';
                        echo '</td>';
                        echo '<td>';
                        echo en2bn($caseDetails[$v['case_id']]['defender_name']);
                        echo '<div class="text-small text-success bn-font">মোবাইল নং : <span class="color-black-blue">'.en2bn($caseDetails[$v['case_id']]['defender_mobile']).'</span></div>';
                        echo '</span></div>';
                        echo '</td>';
                       
                        echo '<td class="text-center">';
                        if(isset($v['schedule_details'])){
                            echo $caseShortDecisionNew[$v['schedule_details']]['case_short_decision'];
                            
                        }
                        else if(isset($v['cause_of_hearing'])){
                            //echo $v['cause_of_hearing'];
                            if(isset($caseShortDecision[$v['cause_of_hearing']]) && isset($caseShortDecision[$v['cause_of_hearing']]['case_short_decision']))
                              echo $caseShortDecision[$v['cause_of_hearing']]['case_short_decision'];
                        }
                        if(isset($v['cause_of_hearing_details'])){
                            echo ' - '.'('. $v['cause_of_hearing_details'].')';
                        }
                    echo '</td>';
                     
                        echo '<td align="center">';
                        
                        if($v['hearing_date']<=date('Y-m-d')){
                        if($v['case_status']<3){
                            if(empty($v['next_hearing_date']))
                               {
                            //echo '<span class="btn btn-sm btn-primary font-weight-normal mr-3" data-id="'.$v['id'].'"><a class="text-white border-bottom-0 bn-font" href="'.$baseUrl.'causelist/decision?id='.$v['id'].'" ><i class="fa fa-gavel mr-2"></i>সিদ্ধান্ত</a></span>';
                            ?>
                            
                                <div class="form-group row" style="width:340px">
                                    {{-- <label class="col-sm-4 col-form-label form-control-sm bn-font">মামলার অবস্থা <span class="text-danger ml-1 font-16">*</span> : </label> --}}
                                    <div class="col-md-6 col-sm-6 relative text-center">
                                        <select class="form-control form-control-sm bn-font case_status" name="case_status[<?php echo $v['id'] ?>]" required data-id="case_status">
                                        </select>
                                    </div>
                                
                                    {{-- <label class="col-md-6 col-sm-6 col-form-label form-control-sm bn-font">পরবর্তী শুনানির তারিখ <span class="text-danger ml-1 font-16">*</span>: </label> --}}
                                    <div class="col-md-6 col-sm-6 relative">
                                        <input type="text" required  name="next_hearing_date[<?php echo $v['id'] ?>]" autocomplete="off" class="form-control form-control-sm date next_hearing_date font-16" required placeholder="পরবর্তী শুনানি">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <input type="hidden" value="<?php echo $causeList[0]['id'] ?>" name="id"> 
                                    </div>
                                    {{-- <div class="col-sm-8 mb-2 text-right">
                                        <button type="submit" class="btn btn-sm btn-primary bn-font font-weight-normal"><i class="fa fa-save mr-2"></i>সংরক্ষণ করুন</button>
                                    </div> --}}
                                </div>
                            
                            <?php
                            //echo '<span class="btn btn-sm btn-warning font-weight-normal" data-id="'.$v['id'].'"><a class="text-white border-bottom-0 bn-font" href="'.$baseUrl.'causelist/modify?id='.$v['id'].'" ><i class="fa fa-edit mr-2"></i>সংশোধন</a></span>';
                               }
                            else {
                               echo '<span class="font-12"><span class="bn-font text-left"></span>'.en2bnDate($v['next_hearing_date']).'</span>';

                            }
                        }
                    }
                        echo '</td>';
                        ?>
                        <td align="center">
                            <?php
                           
                            if(isset($v['case_short_decision'])){
                                //echo $v['case_short_decision'];
                                if(isset($caseShortDecision[$v['case_short_decision']]) && isset($caseShortDecision[$v['case_short_decision']]['case_short_decision']))
                                    echo $caseShortDecision[$v['case_short_decision']]['case_short_decision'];
                            }
                            if(isset($v['case_details_decision'])){
                                echo ' - '.'( '. $v['case_details_decision'].' )';
                                
                            }
                            if($v['hearing_date']<= date('Y-m-d')){
                                if($v['case_status']<3){
                                    if(empty($v['next_hearing_date']))
                                    {?>
                                <div class="form-group row" style="width:200px">
                                    <div class="col-md-12 col-sm-12 relative ">
                                        <select class="form-control form-control-sm en-font case_short_decision font-13" name="case_short_decision[<?php echo $v['id'] ?>]" data-id="case_short_decision_<?php echo $caseDetails[$v['case_id']]['case_category'] ?>">
                                        </select>
                                    </div>
                                </div> 
                                <div class="form-group row case-details">
                                    <!-- <label class="col-sm-4 col-form-label form-control-sm text-right bn-font">রায়ের বর্ণনা : </label> -->
                                    <div class="col-sm-12 relative relative-password text-cemnter">
                                        <textarea  name="case_details_decision" class="form-control bn-font" rows="2" cols="10" placeholder="সংক্ষিপ্ত বর্ণনা"></textarea>
                                    </div>
                                </div>
                                <?php
                                }
                            } 
                        }
                        ?>   
                        </td>    
                        <?php            
                    //     echo '<td class="text-center">';
                    //     if(isset($v['case_short_decision'])){
                    //         if(isset($caseShortDecision[$v['case_short_decision']]))
                    //             echo $caseShortDecision[$v['case_short_decision']]['case_short_decision'];
                    //     }
                    //     else if(isset($v['cause_of_hearing'])){
                    //         //echo $v['cause_of_hearing'];

                    //           if(isset($caseShortDecision[$v['cause_of_hearing']]))
                    //               echo $caseShortDecision[$v['cause_of_hearing']]['case_short_decision'];
                    //     }
                    // echo '</td>';
                        echo '</tr>';
                        $i++;
                        }
                    }
                    ?>
                
                </tbody>
            </table>
            <span class="mt-3 case-status-btn" data-id="1" style="float:left; cursor:pointer"><i class="fa fa-star text-success" style="width: 10px; height: 10px; display: block; float: left; margin: 4px 15px 8px 0px;"></i>চলমান</span>
            <span class="mt-3 ml-3 case-status-btn" data-id="2" style="float:left; cursor:pointer"><i class="fa fa-star text-warning" style="width: 10px; height: 10px; display: block; float: left; margin: 4px 15px 8px 0px; "></i>স্থগিত</span>
            <span  class="mt-3 ml-3 case-status-btn" data-id="3" style="float:left; cursor:pointer"><i class="fa fa-star text-danger" style="width: 10px; height: 10px; display: block; float: left; margin: 4px 15px 8px 0px;"></i>নিস্পত্তিকৃত</span>
            <span  class="mt-3 ml-3 case-status-all" style="float:left; cursor:pointer"><i class="fa fa-star text-black" style="width: 10px; height: 10px; display: block; float: left; margin: 4px 15px 8px 0px; cursor:pointer"></i>সকল</span>
           
        </form>
        </div>
        <div class="modal fade" id="causeListModal" tabindex="-1" role="dialog" aria-labelledby="addOffice" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">

                            <div class="card card-green mt-2">
                                <header class="card-header p-1 pl-3 bn-font">কার্যতালিকা হালনাগাদ করুন : </header>
                                <div class="card-block ">
                                    <form class="" action="<?php echo $baseUrl ?>causelist/update" method="post" enctype="multipart/form-data" >
                                        @csrf
                                        <div class="form-group row">
                                            <label class="col-md-4 col-sm-4 col-form-label form-control-sm text-right bn-font nxt-date">পরবর্তী শুনানি<span class="text-danger ml-1 font-16">*</span> : </label>
                                            <div class="col-md-6 col-sm-6 relative relative-password">
                                                <input type="text" required  name="next_hearing_date" autocomplete="off" class="form-control form-control-sm date required">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label form-control-sm text-right bn-font">মামলার অবস্থা<span class="text-danger ml-1 font-16">*</span> : </label>
                                            <div class="col-sm-6 relative">
                                                <select class="form-control form-control-sm bn-font " name="case_status" required>
                                                    <option>বাছাই করুন</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label form-control-sm text-right bn-font">রায়ের সারসংক্ষেপ <span class="text-danger ml-1 font-16">*</span> : </label>
                                            <div class="col-sm-6 relative">
                                                <select class="form-control form-control-sm bn-font" name="case_short_decision">
                                                    <option>বাছাই করুন</option>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="form-group row  case-details">
                                            <label class="col-sm-4 col-form-label form-control-sm text-right bn-font">রায়ের বর্ণনা : </label>
                                            <div class="col-sm-6 relative relative-password">
                                                <textarea  name="case_details_decision" class="form-control bn-font" rows="2" cols="10"></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer pull-left border-0">

                                            <button type="submit" class="btn btn-sm btn-primary bn-font font-weight-normal"><i class="fa fa-save mr-2"></i>সংরক্ষণ করুন</button>

                                            <button type="button" class="btn btn-sm btn-danger bn-font text-white font-weight-normal" data-dismiss="modal"><i class="fa fa-close mr-2"></i>বন্ধ করুন</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                    </div>

                </div>
            </div>
        </div>
    </section>
    <style>
   .panel-title a{color:darkblue!important}
   .bgcolor{background:#d6eeff;}
        </style>
    <?php
    if(session('success')){
    ?>
    <script>
        swal({
                title: "Success!",
                text: "<?php echo session('success') ?>",
                type: "success",
                confirmButtonClass: "btn-success",
                confirmButtonText: "Success"
            },
            function(isConfirm) {
                if (isConfirm) {
                    location.reload();
                }
            });
    </script>
    <?php
    }
    ?>
    <script>
        $('input.date').datepicker({
            changeMonth: true,
            changeYear: true,
            'dateFormat':'yy-mm-dd',
            yearRange: "-100:+100",
            showOn: "both",
            //minDate:0,
            buttonImage: "<?php //echo $baseUrl ?>/img/calendar.png",
            buttonImageOnly: true,
            beforeShowDay: noHolidays
            
        });
        
        function noHolidays(date){
            if (date.getDay() === 5 || date.getDay() === 6)  /* Monday */
                    return [ false, "closed", "Closed on Friday and Saturday" ]
            else
                    return [ true, "", "" ]
        }
        
       
        
        $('.all_cause').on('click',function(){
            if($(this).is(':checked')){
       
                $('.causeId').prop('checked',true);

            }else{
                $('.causeId').prop('checked',false);
            }
        });
        $('.case-status-btn').on('click',function(){
            $('table.case-list tbody tr').hide();
            $('table.case-list tbody tr[data-case-status="'+$(this).attr('data-id')+'"]').show();
            
        })
        $('.case-status-all').on('click',function(){
            $('table.case-list tbody tr').show();
        })
        $('.causeId').on('click',function(){
            if($(this).is(':checked')){
            //alert();
             $(this).parents('tr').addClass("bgcolor");
            }else
            $(this).parents('tr').removeClass("bgcolor");
        });
        $('.update-causes').on('click',function() {

            var caseId=[];

            $('.causeId').each(function () {
                if($(this).is(':checked')){
                   
                    caseId.push($(this).val());
                   
                }
            });

            if(caseId.length){
                $('#causeListModal').find('form').find('input[name="ids"]').remove();
                $('#causeListModal').find('form').append('<input type="hidden" name="ids" value="'+caseId.join(',')+'" />');

                $('#causeListModal').modal().show();
            }
            else{
                alert("Please select a case." );
            }


        });

        $('.update-multi-causes').on('click',function() {
            //alert();
            var caseId=[];
            var j=0; var l=1;

            $('select.case_short_decision').removeClass( "error");

            $('.causeId').each(function () {
                
                if($(this).is(':checked')){
                    j=1;
                   
                  
                    
                 if($(this).parents('tr').find( 'select.case_status' ).val()==''){
                     $(this).parents('tr').find('select.case_status').addClass( "error");
                    l=0;;
                    //alert('aa');
                } 
               
                else if($(this).parents('tr').find('select.case_status').val()==3){
                    //alert('33');
                    if($(this).parents('tr').find('select.case_short_decision').val()==''){
                        $(this).parents('tr').find('select.case_short_decision').addClass( "error");
                        l=0;
                    }
                }
                else {
                        //alert('bb');
                        if($(this).parents('tr').find('select.case_short_decision').val()==''){
                            $(this).parents('tr').find('select.case_short_decision').addClass( "error");
                            l=0;
                        }

                        if($(this).parents('tr').find('input.next_hearing_date').val()==''){
                            $(this).parent('tr').find('input.next_hearing_date').addClass( "error");
                           l=0
                        }
                    }
                }
                
            });

            if(j==0){alert("Please check the causelist" );}
            else if ((j==1)&&(l==1)){$('#multi-submit').submit();}
        });
        $('.case-details').hide();
        $('.case_short_decision').change(function(){
            $('.case-details').hide();
            //alert($(this).find('option[value="'+$(this).val()+'"]').text());
         if($(this).find('option[value="'+$(this).val()+'"]').text()=='অন্যান্য'){
          $(this).parents('td').find('.case-details').toggle();
         }
        
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
                items.push('<option value="">মামলার অবস্থা</option>');

                $(data).each(function(i,v){
                    items.push('<option value="'+v['id']+'">'+v['case_status']+'</option>');
                });
                $('select[data-id="case_status"]').html(items.join(''));
                //console.log(data);
                //$('select[data-id="case_status"]').select2();

            }
        });


        $('.case_status').change(function(){
            if($(this).val()!=''){
                var caseCategory = $(this).parents('tr').attr('data-case-category-id');
                var caseStatus = $(this).val();
                var par = $(this).parents('tr');
                $.ajax({
                    type: 'GET',
                    url: '<?php echo $baseUrl ?>api',
                    data: {'path':'case/shortDecision','caseType':caseCategory,'caseStatus':caseStatus},
                    beforeSend: function () {
                    },
                    success: function (data) {
                        data = JSON.parse(data);
                        var items = [];
                        items.push('<option value="">আদেশের সারসংক্ষেপ</option>');

                        $(data).each(function(i,v){
                            items.push('<option value="'+v['id']+'" data-case-type-id="' + v['case_id']  + '">'+v['case_short_decision']+'</option>');
                        });
                        par.find('select[data-id="case_short_decision_' + caseCategory + '"]').html(items.join(''));
                        filterCaseDecision();
                        par.find('select[data-id="case_short_decision_' + caseCategory + '"]').select2();
                    }

                });
            }
        });

        function filterCaseDecision(){
            $('table.case-list tbody tr').each(function(){
                var caseId = $(this).attr('data-case-type-id');
                if($(this).find('select.case_short_decision option[data-case-type-id="' + caseId + '"]').length>0){
                    $(this).find('select.case_short_decision option').hide();
                    $(this).find('select.case_short_decision option[data-case-type-id="' + caseId + '"]').show();
                }else{
                    $(this).find('select.case_short_decision option').hide();
                    $(this).find('select.case_short_decision option[data-case-type-id="0"]').show();
                }
            });
        }
    </script>
    <style>
        .error{border:1px solid red}
    </style>
@endsection
