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
                <a class="color-black-blue bn-font" href="<?php echo $baseUrl ?>supreme/add">Cause List
                    <span class="btn btn-sm btn-primary pull-right bn-font border-0 ml-2 bn-font"><i class="fa fa-plus pr-2"></i><span class="bn-font">Add Cause List</span></span>
                </a>
                
            </h3>
        </header>
        <form id="submit-form" action="<?php echo $baseUrl ?>supreme" method="post" enctype="multipart/form-data" class="forms-sample">
            @csrf
            <div class="form-group row pl-4 pr-3 mt-2">
                <label class="col-md-2 col-sm-12 col-form-label form-control-sm text-left bn-font">Hearing Date :</label>
                <div class="col-md-3 col-sm-12 ">
                    <input type="text" value="<?php echo $hearingDate ?>" name="hearing_date" autocomplete="off" class="form-control form-control-sm date">
                </div>
                <div class="col-md-3 col-sm-12">
                    <button type="submit" class="btn btn-sm btn-primary bn-font font-weight-normal"><i class="fa fa-search mr-2"></i>Search</button>
                </div>

            </div>

        </form>
       
        <div class="m-3 mt-0 mb-0">
            <table class="table bg-light border border-top-0 font-14" id="datatable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th style="width:200px"><div class="bn-font">Bench List</div></th>
                        <th><div class="bn-font">Case Information</div></th>
                        <th><div class="bn-font text-center">Parties Information</div></th>
                        <th><div class="bn-font">Case Status</div></th>
                        <th><div align="center" class="bn-font">Action</div></th>
                    </tr>
                </thead>
                <tbody>
                <?php


                $i=1;

                foreach ($appellate as $k=>$v) {
                    echo '<tr>';
                    echo '<td>'.$i.'</td>';
                    echo '<td>';
                    echo $v['judge_name'];
                    echo '<td>';
                    echo '<div class="text-small text-primary bn-font">Year : <span class="color-black-blue">'.$v['case_year'].'</span></div>';
                    echo '<div class="text-small text-success bn-font">Case Type : <span class="color-black-blue">'.(isset($caseType[$v['case_type']])?$caseType[$v['case_type']]['case_type']:'').'</span></div>';
                    
                    echo '<div class="text-small text-success bn-font">Case no : <span class="color-black-blue">'.$v['case_no'].'</span></div>';
                    echo '</td>';

                    echo '<td>';
                    echo '<div class="text-small text-primary bn-font text-center"><span class="color-black-blue">'.$v['complainant_name'].'</span></div>';
                    
                    //echo '<div class="text-small text-success bn-font">Mobile No : <span class="color-black-blue">'.$v['complainant_mobile'].'</span></div>';

                    echo '<div class="text-center font-11 vs">VS</div>';

                    echo '<div class="text-small text-primary bn-font text-center"><span class="color-black-blue">'.$v['defender_name'].'</span></div>';
                    
                    //echo '<div class="text-small text-success bn-font">Mobile No : <span class="color-black-blue">'.$v['defender_mobile'].'</span></div>';
                   
                    

                    echo '</td>';
                    echo '<td>';
                            echo '<div class="text-small text-primary bn-font text-center">';
                                if(isset($caseStatus[$v['case_status']])){
                                    if($v['case_status']==1)
                                        $cl = 'warning';
                                    else if($v['case_status']==2)
                                        $cl = 'danger';
                                    else if($v['case_status']==3)
                                        $cl = 'success';

                                    echo '<span class="bn-font label-'.$cl.' label font-weight-normal">';
                                        echo $caseStatus[$v['case_status']]['case_status'];
                                    echo '</span>';
                                }
                    echo '</td>';

                    echo '<td>';
                     
                        if($v['case_status']<3){
                            if(empty($v['next_hearing_date']))
                                {
                            echo '<span class="btn btn-sm btn-primary font-weight-normal mr-3" data-id="'.$v['id'].'"><a class="text-white border-bottom-0 bn-font" href="'.$baseUrl.'supreme/decision?id='.$v['id'].'" ><i class="fa fa-gavel mr-2"></i>
                           Decision</a></span>';
                            echo '<span class="btn btn-sm btn-warning font-weight-normal" data-id="'.$v['id'].'"><a class="text-white border-bottom-0 bn-font" href="'.$baseUrl.'supreme/modify?id='.$v['id'].'" ><i class="fa fa-edit mr-2"></i>
                            Edit</a></span>';
                                }
                            else {
                                echo '<span class="font-12"><span class="bn-font">Next Hearing Date: </span>'.($v['next_hearing_date']).'</span>';

                            }
                            }
                    echo '</td>';
                   
                    echo '</tr>';
                    $i=$i+1;
                }
                ?>
                </tbody>
            </table>
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
   //$('input[name="case_no"],input[name="case_category"],input[name="complainant_mobile"],input[name="defender_mobile"],input[name="case_no"]').bangla({ enable: true });
</script>
@endsection
