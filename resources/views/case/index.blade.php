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
            <h3 class="panel-title mb-0">
                <a class="color-black-blue bn-font" href="<?php echo $baseUrl ?>case/add">মামলার তালিকা
                    <span class="btn btn-sm btn-primary pull-right bn-font border-0 ml-2 bn-font hidden"><i class="fa fa-plus pr-2"></i><span class="bn-font">নতুন মামলা</span></span>
                </a>
                <a class="color-black-blue bn-font ml-2" href="<?php echo $baseUrl ?>case/add?type=short">
                    <span class="btn btn-sm btn-success pull-right bn-font border-0 font-weight-normal"><i class="fa fa-plus mr-2"></i><span class="bn-font">নতুন মামলা</span></span>
                </a>
                <a class="color-black-blue bn-font " href="<?php echo $baseUrl ?>case/bulkAdd">
                    <span class="btn btn-sm btn-success pull-right bn-font border-0 font-weight-normal mr-2"><i class="fa fa-plus mr-2"></i><span class="bn-font">Bulk case</span></span>
                </a>
            </h3>
        </header>
    <?php //dd($get);?>
        <form id="submit-form" action="<?php echo $baseUrl ?>case/index" method="post" enctype="multipart/form-data" class="forms-sample">
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

                <div class="col-md-4 col-sm-4 ">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label form-control-sm bn-font text-right">প্রকার</label>
                        <div class="col-sm-9">
                            <select class="form-control form-control-sm bn-font" name="case_category" value="">
                                <option value="0">বাছাই করুন</option>
                                <?php

                                foreach ($cat as $k=>$v) {
                                    echo '<option value="'.$v['id'].'" '.(isset($get['caseCategory'])  && $v['id'] == $get['caseCategory']?'selected':'').'>'.$v['case_category'].'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label form-control-sm bn-font text-right">ধরন</label>
                        <div class="col-sm-9">
                            <select class="form-control form-control-sm bn-font" name="case_type" >
                                <option value="0">বাছাই করুন</option>
                            <?php
                                //dd($caseType)
                                if(isset($caseType) && is_array($caseType))
                                foreach ($caseType as $k=>$v) {
                                    echo '<option value="'.$v['id'].'" '.(isset($get['caseTyp']) && $v['id'] == $get['caseTyp']?'selected':'').'>'.$v['case_type'].'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-4 ">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label form-control-sm text-right bn-font">সাল</label>
                        <div class="col-sm-8">
                            <input type="text" value="<?php echo(isset($get['caseYear'])?$get['caseYear']:''); ?>" class=" form-control form-control-sm relative" name="case_year"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 ">
                    <div class="form-group row">
                        <label class="col-sm-6 col-form-label form-control-sm text-right bn-font">মামলা দায়েরের তারিখ</label>
                        <div class="col-sm-6 ">
                            <input type="text" value="<?php echo(isset($get['caseDate'])?$get['caseDate']:''); ?>" name="case_date" autocomplete="off" class="form-control form-control-sm date">
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-sm btn-primary font-weight-normal"><i class="fa fa-search mr-2"></i><span class="bn-font">অনুসন্ধান করুন</span></button>
                </div>
            </div>

        </form>
        <div class="m-3 mt-0 mb-0">
            <table class="table bg-light border border-top-0 font-14" id="datatable">
                <thead>
                    <tr>
                        <th><div class="bn-font text-center">ক্রমিক নং</div></th>
                        <th><div class="bn-font">মামলার তথ্য</div></th>
                        <th><div class="bn-font">বাদি</div></th>
                        <th><div class="bn-font">বিবাদি</div></th>
                        <th><div class="bn-font text-center">দায়েরের তারিখ</div></th>
                        <th><div class="bn-font">মামলার অবস্থা</div></th>

                        <th><div align="center" class="bn-font">সংশোধন</div></th>
                    </tr>
                </thead>
                <tbody>
                <?php
// echo '<pre>';
// print_r($caseDetails);
// echo '</pre>';

                $i=1;

                foreach ($caseDetails as $k=>$v) {
                    echo '<tr>';
                    echo '<td align="center">'.en2bn($i).'</td>';
                    echo '<td>';
                    echo '<div class="text-small text-success bn-font">মামলা নং : <span class="color-black-blue">'.en2bn($v['case_no']).'/'.en2bn($v['case_year']).'</span></div>';
                    echo '<div class="text-small text-success bn-font">ধরন : <span class="color-black-blue">'.(isset($caseType[$v['case_type']])?$caseType[$v['case_type']]['case_type']:'').'</span></div>';
                    echo '<div class="text-small text-primary bn-font">সাল : <span class="color-black-blue">'.en2bn($v['case_year']).'</span></div>';
                    
                    //echo '<div class="text-small text-success bn-font">ধরন : <span class="color-black-blue">'.$v['case_type'].'</span></div>';
                   
                    echo '</td>';
                   

                    echo '<td>';
                    echo '<div class="text-small text-primary bn-font">নাম : <span class="color-black-blue">'.$v['complainant_name'].'</span></div>';
                    //echo '<div class="text-small text-success bn-font">আইনজীবীর নাম : <span class="color-black-blue">'.$v['complainant_adv_name'].'</span></div>';
                    echo '<div class="text-small text-success bn-font">মোবাইল নং : <span class="color-black-blue">'.en2bn($v['complainant_mobile']).'</span></div>';
                    echo '</td>';

                    echo '<td>';
                    echo '<div class="text-small text-primary bn-font">নাম : <span class="color-black-blue">'.$v['defender_name'].'</span></div>';
                    //echo '<div class="text-small text-success bn-font">আইনজীবীর নাম : <span class="color-black-blue">'.$v['defender_adv_name'].'</span></div>';
                    echo '<div class="text-small text-success bn-font">মোবাইল নং : <span class="color-black-blue">'.en2bn($v['defender_mobile']).'</span></div>';

                    echo '</td>';

                    echo '<td align="center">'.en2bnDate($v['case_date']).'</td>'; 
                    echo '<td>';
                    echo '<div class="text-small color-black bn-font"> শুনানির তারিখ :  '.(isset($causeList[$v['id']]['hearing_date'])?en2bnDate($causeList[$v['id']]['hearing_date']):'').'<span class="color-black-blue"></span></div>';

                    if(isset($causeList[$v['id']])){
                        if(isset($caseStatus[$causeList[$v['id']]['case_status']])){

                            if($causeList[$v['id']]['case_status']==1)
                            $cl = 'success';
                            else if($causeList[$v['id']]['case_status']==2)
                            $cl = 'warning';
                            else if($causeList[$v['id']]['case_status']==3){
                            $cl = 'danger';
                            

                            echo '<button data-id="'.$v['id'].'" data-case-cat="'.$v['case_category'].'" class="btn btn-sm btn-success bn-font pull-right mr-3 solved-case font-weight-normal"><i class="fa fa-gavel mr-2"></i>নিষ্পতি মামলা পুনরুজ্জীবিত</button>';
                            }

                            echo '<span class="bn-font label-'.$cl.' label font-weight-normal">';
                                echo $caseStatus[$causeList[$v['id']]['case_status']]['case_status'];
                            echo '</span>';
                            
                        }
                    }
                    echo '</td>';
                    echo '<td align="center">';
                        echo '<span class="btn btn-sm btn-warning edit-officer" data-id="'.$v['id'].'">
                            <a href="'.$baseUrl.'case/modify?id='.$v['id'].'&type=short" >
                            <i class="fa fa-pencil"></i></a></span>';
                        echo '</td>';
                    echo '</tr>';
                    $i=$i+1;}
                ?>
                </tbody>
            </table>
            <div class="modal fade" id="solvedListModal" tabindex="-1" role="dialog" aria-labelledby="addOffice" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">

                            <div class="card card-green mt-2">
                                <header class="card-header p-1 pl-3 bn-font">কার্যতালিকা হালনাগাদ করুন : </header>
                                <div class="card-block ">
                                    <form class="" action="<?php echo $baseUrl ?>case/renewCase" method="post" enctype="multipart/form-data" >
                                        @csrf
                                       
                                        <input type="hidden" required  name="id" autocomplete="off" class="form-control form-control-sm date required" data-id="id">
                                        <input type="hidden" required  name="id" autocomplete="off" class="form-control form-control-sm date required" data-id="id"> 
                                        <div class="form-group row">
                                            <label class="col-md-6 col-sm-6 col-form-label form-control-sm text-right bn-font">পরবর্তী শুনানির তারিখ<span class="text-danger ml-1 font-16">*</span> : </label>
                                            <div class="col-md-6 col-sm-6">
                                                <input type="text" required  name="hearing_date" autocomplete="off" class="form-control form-control-sm date required">
                                            </div>
                                        </div>
                                        <!-- <div class="form-group row">
                                            <label class="col-md-6 col-sm-6 col-form-label form-control-sm text-right bn-font">আদেশের  সারসংক্ষেপ<span class="text-danger ml-1 font-16">*  </span> : </label>
                                            <div class="col-md-6 col-sm-6 relative relative-password">
                                            <?php
                                            //dd($caseDetails)?>
                                            <select class="form-control form-control-sm en-font case_short_decision font-14" name="case_short_decision" data-id="case_short_decision">
                                            </select>
                                            </div>
                                        </div> -->
                                        <!-- <div class="form-group row">
                                            <label class="col-sm-6 col-form-label form-control-sm bn-font">কার্যতালিকার বর্ণনা</label>
                                            <div class="col-sm-6 relative relative-password">
                                                <textarea name="schedule_details" class="form-control bn-font" rows="1" cols="10"></textarea>
                                            </div>
                                        </div> -->
                                        
                                            <div class="form-group row">
                                                <label class="col-sm-6 col-form-label form-control-sm bn-font text-right">সংক্ষিপ্ত আদেশ<span class="text-danger ml-1 font-20">*</span></label>
                                                <div class="col-sm-6">
                                                    <select class="form-control form-control-sm bn-font" name="schedule_details" required>
                                                        <option>সংক্ষিপ্ত আদেশ</option>
                                                    <?php
                                                        //dd($caseType)
                                                        if(isset($caseType) && is_array($caseType))
                                                        foreach ($caseType as $k=>$v) {
                                                            echo '<option value="'.$v['id'].'" '.(isset($get['caseTyp']) && $v['id'] == $get['caseTyp']?'selected':'').'>'.$v['case_type'].'</option>';
                                                        }
                                                        ?>
                                                    </select>
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
$('.solved-case').on('click',function() {
    $('#solvedListModal').find('input[name="id"]').val($(this).attr('data-id'));
    $('#solvedListModal').modal().show();

    $.ajax({
        type: 'GET',
        url: '<?php echo $baseUrl ?>api?path=case/shortDecision?caseType='+$(this).attr('data-case-cat'),
        beforeSend: function () {
        },
        success: function (data) {
            console.log(data);
            data = JSON.parse(data);
            //console.log(data);
            var items = [];
            items.push('<option value="">আদেশের সারসংক্ষেপ</option>');

            $(data).each(function(i,v){
                items.push('<option value="'+v['id']+'">'+v['case_short_decision']+'</option>');
            });
            $('#solvedListModal').find('select[data-id="case_short_decision"]').html(items.join(''));
            //console.log(data);
            //$('select[name="case_short_decision"]').select2();

        }
    });

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

   $(".yearpicker").yearpicker({
       year: 2021,
       startYear: 1980,
       endYear: 2050,
   });
   $('input[name="case_no"],input[name="case_category"],input[name="complainant_mobile"],input[name="defender_mobile"],input[name="case_no"]').bangla({ enable: true });
</script>
@endsection
