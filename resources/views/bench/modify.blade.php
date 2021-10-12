@extends('layouts.app')

@section('content')
<section class="box-typical box-typical-dashboard scrollable pl-3 pr-3 hidd" style="overflow: auto">
    <header class="panel-heading position-relative clearfix bn-font px-0">
    <h3 class="panel-title mb-2 bn-font"><?php echo (isset(request()->id)?'Edit Bench':'Add New Bench') ?></h3>
    </header>

    <form id="submit-form" action="<?php echo $baseUrl ?>bench/update" method="post" enctype="multipart/form-data" class="forms-sample">
        @csrf
        <div class="row entry-form">
            <div class="col-sm-12">
                <div class="card card-green">
                    <header class="card-header bn-font p-2">Bench</header>
                    <div class="card-block">
                        <div class="row mb-3">
                            <input type="hidden" name="id" value="<?php echo (isset($benchFormation['id'])?$benchFormation['id']:''); ?>">
                           
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label form-control-sm bn-font">Judge List<span class="text-danger ml-1 font-16">*</span></label>
                                    <div class="col-sm-9">
                                        <select multiple="multiple" class="form-control form-control-sm bn-font case_category" name="judge_list[]" id="demo" <?php echo (isset($benchFormation['judge_list'])?'data-id="'.implode(',',json_decode($benchFormation['judge_list'],true)).'"':''); ?>>
                                            
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label form-control-sm bn-font">Court No<span class="text-danger ml-1 font-16">*</span></label>
                                    <div class="col-sm-9 relative">
                                        <input type="text" value="<?php echo (isset($benchFormation['court_no'])?$benchFormation['court_no']:''); ?>" name="court_no" autocomplete="off" class="form-control form-control-sm" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label form-control-sm bn-font">Jurisdiction<span class="text-danger ml-1 font-16">*</span></label>
                                    <div class="col-sm-9 relative">
                                        <select class="form-control form-control-sm bn-font" name="jurisdiction_id" required >
                                            <option value="0">Select</option>
                                            <?php
                                        
                                            foreach($jurisDiction as $val){
                                                $t=array();
                                                    $t = explode(' ',$val['description']);
                                                    echo '<option value="'.$val['id'].'" '.(isset($benchFormation['jurisdiction_id']) && $val['id']==$benchFormation['jurisdiction_id']?'selected':'').'>'.implode(' ',array_slice($t,0,10)).'</option>';
                                                    
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label form-control-sm bn-font">Short Note</label>
                                    <div class="col-sm-9 relative">
                                        
                                            <textarea name="short_note" value="" class="form-control bn-font" rows="3" cols="10"><?php echo (isset($benchFormation['short_note'])?$benchFormation['short_note']:''); ?></textarea>
                                        
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label form-control-sm">Publish</label>
                                    <div class="col-sm-9">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" name="action" value="1" <?php echo (isset($benchFormation['action']) && $benchFormation['action']==1 ? 'checked':''); ?> class="form-check-input feature-check">Yes
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>    
                            
                        </div>
                    </div>
                    <div class="mb-2 mr-2">
                        <button type="submit" class="btn btn-sm btn-primary bn-font font-weight-normal pull-right"><i class="fa fa-save mr-2"></i>Save</button>
                    </div>
                </div>
                
            </div>
        </div>
        
    </form>

</section>
<script>
jQuery(document).ready(function($) {
    $.fn.hasAttr = function(name) {
        return this.attr(name) !== undefined;
    };
});
$.ajax({
    type: 'GET',
    url: '<?php echo $baseUrl ?>api',
    //?path=judge/getUnusedJudgeByOfficeId?officeId=1<?php //echo (isset($benchFormation['judge_list'])?'%26jid='.implode(',',json_decode($benchFormation['judge_list'],true)).'':''); ?>',
    data: {'path':'judge/getUnusedJudgeByOfficeId','officeId':1,<?php echo (isset($benchFormation['judge_list'])?'jid:'.implode(',',json_decode($benchFormation['judge_list'],true)).'':''); ?>},
    beforeSend: function () {
    },
    success: function (data) {
        //console.log(data);
        data = JSON.parse(data);
        //console.log(data);
        var items = [];
        items.push('<optgroup label="">');
        
        $(data).each(function(i,v){
            items.push('<option value="'+v['id']+'">'+v['name_bng']+'</option>');
        });

        items.push('</optgroup>');

        $('select[name="judge_list[]"]').html(items.join(''));
        
        if($('select[name="judge_list[]"]').hasAttr('data-id')){
            var v = $('select[name="judge_list[]"]').attr('data-id');
            var vv = v.split(",");

            for(var i=0;i<vv.length;i++)
                $('select[name="judge_list[]"]').find('optgroup option[value="'+vv[i]+'"]').attr('selected','selected');
        }

        $('#demo').multiselect({
            enableFiltering: true,
            buttonWidth: '100%',
            numberDisplayed: 10
        });

    }
});
</script>

@endsection
