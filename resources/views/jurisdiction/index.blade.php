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
            <a class="color-black-blue add-causes" href="<?php echo $baseUrl ?>jurisdiction/add" > Jurisdiction
            <span class="btn btn-sm btn-primary pull-right bn-font border-0 ml-2 bn-font"><i class="fa fa-plus pr-2"></i><span class="bn-font">Add Jurisdiction</span></span>
            </a>
        </h3>
        
    </header>
    
    <div class="m-3 mt-0 mb-0">
        <table class="table bg-light border border-top-0" id="datatable">
            <thead>
                <tr>
                    <th>#</th>
                    <th style="width:400px!important"><div class="bn-font">Description </div></th>
                    <th style="width:400px!important"><div class="bn-font">Description Bangali</div></th>
                    <th><div class="bn-font" align="center">Action</div></th>
                </tr>
            </thead>
            <tbody>
                <?php
                //print_r($jurisDiction);
                
                $i=1;

                foreach ($jurisDiction as $k=>$v) {

                    echo '<tr>';
                    echo '<td>'.$i.'</td>';
                    echo '<td>';
                    echo en2bn($v['description_en']);
                    
                    echo '</td>';
                    echo '<td>';
                    echo '<span class="bn-font">'.$v['description'].'</span>';
                    
                    echo '</td>';
                    echo '<td align="center">';
                        echo '<span class="btn btn-sm btn-warning edit-officer" data-id="'.$v['id'].'">
                            <a href="'.$baseUrl.'jurisdiction/modify?id='.$v['id'].'" >
                            <i class="fa fa-pencil"></i></a></span>';
                        echo '</td>';
                    echo '</tr>';
                    $i++;
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
@endsection