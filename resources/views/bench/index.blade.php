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
        <h3 class="panel-title mb-0 bn-font">
            <a class="color-black-blue add-causes" href="<?php echo $baseUrl ?>bench/add" >Bench Formation
            <span class="btn btn-sm btn-primary pull-right bn-font border-0 ml-2 bn-font"><i class="fa fa-plus pr-2"></i><span class="bn-font">Add Bench</span></span>
            </a>
        </h3>
        
    </header>
    
    <div class="m-3 mt-0 mb-0">
        <table class="table bg-light border border-top-0" id="datatable">
            <thead>
                <tr>
                    <th>#</th>
                    <th style="width:120px!important"><div class="bn-font">Court No</div></th>
                    <th style="width:150px!important"><div class="bn-font">Judge List</div></th>
                    
                    <th style="width:450px!important"><div class="bn-font" >Jurisdiction</div></th>
                    <th><div class="bn-font" align="center">Action</div></th>
                </tr>
            </thead>
            <tbody>
                <?php
                //print_r($benchFormation);
                
                 $i=1;

                 foreach ($benchFormation as $k=>$v) {

                    echo '<tr>';
                    echo '<td>'.$i.'</td>';
                    echo '<td>';
                    echo '<span class="bn-font">'.($v['court_no']).'</span>';
                    echo '</td>';
                    echo '<td>';
                        $tmp = json_decode($v['judge_list'],true);
                        foreach($tmp as $va)
                            echo $judgeList[$va]['name_bng'].',';
                    
                    echo '</td>';
                    
                    echo '<td>';
                        echo '<span>'.$v['short_note'].'</span>'.'<br>';
                        echo '<span class="bn-font fa-align-justify">'.(isset($jurisDiction[$v['jurisdiction_id']]['description'])?($jurisDiction[$v['jurisdiction_id']]['description']):'').'</span>';
                   echo '</td>';
                    echo '<td align="center">';
                        echo '<span class="btn btn-sm btn-warning edit-officer mt-1 mr-1" data-id="'.$v['id'].'">
                            <a class="text-white border-0" href="'.$baseUrl.'bench/modify?id='.$v['id'].'" >
                            <i class="fa fa-pencil text-white mr-2"></i>Edit</a></span>';

                        echo '<span class="btn btn-sm btn-danger bench mt-1" data-id="'.$v['id'].'">
                               <i class="fa fa-close text-white mr-2"></i>Dismiss
                             </span>';
                    echo '</td>';
                        
                        
                    echo '</tr>';
                     $i++;
                 }
                ?>
            </tbody>
        </table>
        <div class="modal fade" id="benchModel" tabindex="-1" role="dialog" aria-labelledby="addOffice" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Dismiss Bench</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body text-center">
                        <h5 class="font-16">Do you want to dismiss the bench?</h5>
                    </div>
                    <div class="mt-2 mb-3 text-center">

                        <a href="" class="btn btn-sm btn-primary bn-font font-weight-normal"><i class="fa fa-trash mr-2"></i>Yes</a>

                        <button type="button" class="btn btn-sm btn-danger bn-font text-white font-weight-normal" data-dismiss="modal"><i class="fa fa-close mr-2"></i>No</button>
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
     $('.bench').on('click',function(){
        $('#benchModel').modal().show();
        $('#benchModel').find('a').attr('href','<?php echo $baseUrl ?>bench/dismiss?id='+$(this).attr('data-id'));
    });
</script>
@endsection