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
<section class="box-typical box-typical-dashboard scrollable">
        <header class="panel-heading position-relative clearfix en-font">
            <h3 class="panel-title mb-0">মামলার তথ্য</h3>
        </header>
    <?php //dd($get);?>
        <form id="submit-form" action="<?php echo $baseUrl ?>case/caseinformation" method="post" enctype="multipart/form-data" class="forms-sample">
            @csrf
            <div class="form-group row mt-2 mr-2">
                <div class="col-md-4 col-sm-4">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label form-control-sm text-right bn-font">মামলা নং</label>
                        <div class="col-sm-8 relative">
                            <input type="text" value="<?php echo(isset($get['caseNo'])?$get['caseNo'].'/'.$get['caseYear']:''); ?>" name="case_no" autocomplete="off" class="form-control form-control-sm">
                        </div>
                    </div>
                </div>

               
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-sm btn-success font-weight-normal"><i class="fa fa-search mr-2"></i><span class="bn-font">অনুসন্ধান করুন</span></button>
                </div>
            </div>

        </form>

        <div class="m-3 mt-0 mb-0 border p-3">
        <table class="table bg-light  border-0 font-14 mb-2">
            
            <tbody class style="background:#d6eeff">
                <?php
               
                foreach ($caseDetails as $k=>$v) {
                echo '<tr>';
                    echo '<td style="width:260px">';
                    echo '<div class=""><span class="bn-font  text-success">মামলা নং : </span>'.$v['case_no'].'/'.$v['case_year'].' ( '.'<span class="color-black-blue">'.(isset($caseType[$v['case_type']])?$caseType[$v['case_type']]['case_type']:'').'</span>'.' ) '.'</div>';
                    //echo '<div class="text-small text-success bn-font">ধরন : <span class="color-black-blue">'.(isset($caseType[$v['case_type']])?$caseType[$v['case_type']]['case_type']:'').'</span></div>';
                    echo '<div class="text-small text-primary bn-font">সাল : <span class="color-black-blue">'.en2bn($v['case_year']).'</span></div>';
                    echo '</td>';
                    echo '<td style="width:200px;">';
                    
                    echo '<div class=""><span class="bn-font text-center text-success">বাদী : </span>'.$v['complainant_name'].'</div>';
                    echo '<div class=""><span class="bn-font text-center text-success">মোবাইল নং : </span>'.$v['complainant_mobile'].'</div>';
                    echo '<div class="">'.'</div>';
                    echo '</td>';
                    echo '<td>';
                    
                    echo '<div class=""><span class="bn-font text-center text-success">বিবাদী : </span>'.$v['defender_name'].'</div>';
                    echo '<div class=""><span class="bn-font text-center text-success">মোবাইল নং : </span>'.$v['defender_mobile'].'</div>';
                    echo '</td>';
                    echo '<td>';
                    
                    echo '<div class=""><span class="bn-font text-center text-success">দায়েরের তারিখ : </span>'.en2bnDate($v['case_date']).'</div>';
                    echo '</td>';
                 
                   
                    
                echo '</tr>';
                }?>
            </tbody> 
        </table>       
        <table class="table bg-light border border-top-0 font-14">
            <thead>
                <tr>
                    <th style="width: 1px;00px"><div class="bn-font text-center">শুনানির তারিখ</div></th>
                    <th style="width: 1px;00px"><div class="bn-font text-center">সংশোধন</div></th>
                    <th style="width:100px"><div class="bn-font text-center">সংক্ষিপ্ত আদেশ</div></th>
                    <th style="width:100px"><div class="bn-font text-center" >মামলার অবস্থা</div></th>
                    
                </tr>
            </thead>
            <tbody>
                <?php
                //dd($causeList);
                    foreach ($causeList as $key=>$val) {
                        echo '<tr>';
                    
                            echo '<td><div class="bn-font text-center">'.en2bnDate($val['hearing_date']).'</div></td>';

                            if(empty($val['case_short_decision'])){
                            echo '<td align="center">';
                            echo'<button data-id="'.$val['id'].'"  class="btn btn-sm btn-warning hearing-date-update"><i class="fa fa-pencil"></i></button>';
                            echo '</td>';}
                            else{echo '<td></td>';}


                                
                            echo '<td>';
                            if(!empty($val['schedule_details'])){
                                echo '<div class="bn-font text-center">'.(isset($caseShortDecision[$val['schedule_details']])?$caseShortDecision[$val['schedule_details']]['case_short_decision']:'').'</div>';
                                }else{echo '<div class="bn-font text-center">'.(isset($caseShortDecision[$val['cause_of_hearing']])?$caseShortDecision[$val['cause_of_hearing']]['case_short_decision']:'').'</div>';
                                }
                           
                            echo '</td>';   
                            echo '<td>'; 
                                echo '<div class="bn-font text-center">';
                                        echo $caseStatus[$val['case_status']]['case_status'];
                                    echo '</div><br>';
                            echo '</td>'; 
                        echo '</tr>'   ; 
                        ?> 
                         

                   <?php }
                ?>
            </tbody>
        </table>
        <div class="modal fade" id="updateDateModal" tabindex="-1" role="dialog" aria-labelledby="addOffice" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-body">

                                        <div class="card card-green mt-2">
                                            <header class="card-header p-1 pl-3 bn-font">কার্যতালিকা সংশোধন করুন : </header>
                                            <div class="card-block ">
                                                <form class="" action="<?php echo $baseUrl ?>case/modifyHearingDate" method="post" enctype="multipart/form-data" >
                                                    @csrf
                                                <div class="form-group row">
                                                        <label class="col-md-6 col-sm-6 col-form-label form-control-sm text-right bn-font">পরবর্তী শুনানির তারিখ<span class="text-danger ml-1 font-16">*</span> : </label>
                                                        <div class="col-md-6 col-sm-6 relative relative-password">
                                                            
                                                            <input type="hidden" name="id" autocomplete="off"  data-id="id">
                                                            <input type="text" required value="<?php echo(isset($val['hearing_date'])?$val['hearing_date']:'') ?>"  name="hearing_date" autocomplete="off" class="form-control form-control-sm date required">
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
            
                
        </div>
        <?php
        //}
        ?>
        
    </section>
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
$('.hearing-date-update').on('click',function() {
    $('#updateDateModal').find('input[name="id"]').val($(this).attr('data-id'));
    $('#updateDateModal').modal().show();

    // $.ajax({
    //     type: 'GET',
    //     url: '<?php //echo $baseUrl ?>api?path=case/shortDecision?caseType='+$(this).attr('data-case-cat'),
    //     beforeSend: function () {
    //     },
    //     success: function (data) {
    //         console.log(data);
    //         data = JSON.parse(data);
    //         //console.log(data);
    //         var items = [];
    //         items.push('<option value="">আদেশের সারসংক্ষেপ</option>');

    //         $(data).each(function(i,v){
    //             items.push('<option value="'+v['id']+'">'+v['case_short_decision']+'</option>');
    //         });
    //         $('#solvedListModal').find('select[data-id="case_short_decision"]').html(items.join(''));
    //         //console.log(data);
    //         //$('select[name="case_short_decision"]').select2();

    //     }
    // });

});


    
        
   $('input.date').datepicker({
        changeMonth: true,
        changeYear: true,
        'dateFormat':'yy-mm-dd',
        yearRange: "-100:+100",
        showOn: "both",
        buttonImage: "<?php echo $baseUrl ?>/img/calendar.png",
        buttonImageOnly: true,
        beforeShowDay: noHolidays
    });
    function noHolidays(date){
      if (date.getDay() === 5 || date.getDay() === 6)  /* Monday */
            return [ false, "closed", "Closed on Friday and Saturday" ]
      else
            return [ true, "", "" ]
}

//    $(".yearpicker").yearpicker({
//        year: 2021,
//        startYear: 1980,
//        endYear: 2050,
//    });
   $('input[name="case_no"],input[name="case_category"],input[name="complainant_mobile"],input[name="defender_mobile"],input[name="case_no"]').bangla({ enable: true });
</script>
@endsection
