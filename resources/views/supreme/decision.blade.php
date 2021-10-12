@extends('layouts.app')

@section('content')
    <section class="box-typical box-typical-dashboard scrollable pl-3 pr-3">
        <div class="row">
            <div class="col-md-12 col-sm-12">

                <div class="card card-blue mt-2">
                    <header class="card-header p-1 pl-3 bn-font">Bench List: </header>
                    <div class="card-block ">
                        <div class="col-sm-4 col-md-12">
                            <div class="form-group row mb-0">
                                <label class="col-sm-4 col-form-label form-control-sm bn-font">Judges : </label>
                                <label class="col-sm-8 col-form-label form-control-sm"><?php echo $appellate['judge_name'] ?></label>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>           
            
        </div>
        <div class="row">

            <div class="col-md-4 col-sm-4 ">

                <div class="card card-green mt-2">
                    <header class="card-header p-1 pl-3 bn-font">Case Information : </header>
                    <div class="card-block ">
                        <div class="col-sm-4 col-md-12">
                            <div class="form-group row mb-0">
                                <label class="col-sm-4 col-form-label form-control-sm bn-font">Year : </label>
                                <label class="col-sm-8 col-form-label form-control-sm"><?php echo $appellate['case_year'] ?></label>
                            </div>
                        </div>
                        <?php
                        //dd($appellate);
                        ?>
                        <div class="col-sm-4 col-md-12">
                            <div class="form-group row mb-0">
                                <label class="col-sm-4 col-form-label form-control-sm bn-font">Type : </label>
                                    <label class="col-sm-8 col-form-label form-control-sm bn-font"><?php 
                                    echo '<div class="text-small text-success bn-font"><span class="color-black-blue">'.(isset($caseType[$appellate['case_type']])?$caseType[$appellate['case_type']]['case_type']:'').'</span></div>';?>
                                </label>
                            </div>
                        </div>
                       <div class="col-sm-4 col-md-12">
                            <div class="form-group row mb-0">
                                <label class="col-sm-4 col-form-label form-control-sm bn-font">Case No: </label>
                                    <label class=" col-sm-8 col-form-label form-control-sm"><?php echo $appellate['case_no'] ?></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-green mt-2">
                    <header class="card-header p-1 pl-3 bn-font ">Complainer Information : </header>
                    <div class="card-block ">
                        <div class="col-sm-4 col-md-12">
                          <div class="form-group row mb-0">
                            <label class="col-sm-4 col-form-label form-control-sm bn-font">Name: </label>
                            <label class="col-sm-8 col-form-label form-control-sm bn-font"><?php echo $appellate['complainant_name'] ?></label>
                          </div>
                        </div>
                        <div class="col-sm-4 col-md-12">
                            <div class="form-group row mb-0">
                                <label class="col-sm-4 col-form-label form-control-sm bn-font">Mobile : </label>
                                <label class="col-sm-8 col-form-label form-control-sm"><?php echo $appellate['complainant_mobile'] ?></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-green mt-2">
                    <header class="card-header p-1 pl-3 bn-font">Defender Information : </header>
                    <div class="card-block ">
                        <div class="col-sm-4 col-md-12">

                            <div class="form-group row mb-0">
                                <label class="col-sm-4 col-form-label form-control-sm bn-font">Name : </label>
                                <label class="col-sm-8 col-form-label form-control-sm bn-font"><?php echo $appellate['defender_name'] ?></label>
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-12">
                            <div class="form-group row mb-0">
                                <label class="col-sm-4 col-form-label form-control-sm bn-font">Mobile : </label>
                                <label class="col-sm-8 col-form-label form-control-sm"><?php echo $appellate['defender_mobile'] ?></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-8 col-md-8 relative">
                <div class="card card-purple mt-2">
                    <header class="card-header p-1 pl-3 bn-font">Edit Cause List : </header>
                    <div class="card-block ">
                        <form class="" action="<?php echo $baseUrl ?>supreme/orderUpdate" method="post" enctype="multipart/form-data" >
                            @csrf
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label form-control-sm bn-font">Next Hearing Date<span class="text-danger ml-1 font-16">*</span>: </label>
                                <div class="col-md-5 relative relative-password">
                                    <input type="text" required  name="next_hearing_date" autocomplete="off" class="form-control form-control-sm date" required >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label form-control-sm bn-font">Case Status<span class="text-danger ml-1 font-16">*</span> : </label>
                                <div class="col-sm-5 relative">
                                    <select class="form-control form-control-sm bn-font" name="case_status" required>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label form-control-sm bn-font">Case Short Decision<span class="text-danger ml-1 font-16">*</span> : </label>
                                <div class="col-sm-5 relative">
                                    <select class="form-control form-control-sm en-font" name="case_short_decision">
                                     </select>
                                </div>

                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label form-control-sm bn-font">Case Details : </label>
                                <div class="col-sm-5 relative relative-password">
                                    <textarea  name="case_details_decision" class="form-control bn-font" rows="2" cols="10"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <input type="hidden" value="<?php echo $appellate['id'] ?>" name="id">
                                </div>
                                <div class="col-sm-5 mb-2 text-right">
                                    <button type="submit" class="btn btn-sm btn-primary bn-font font-weight-normal"><i class="fa fa-save mr-2"></i>Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function() {
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
            $.ajax({
                type: 'GET',
                url: '<?php echo $baseUrl ?>api?path=case/status',
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
                    $('select[name="case_status"]').select2();

                }
            });
            $.ajax({
                type: 'GET',
                url: '<?php echo $baseUrl ?>api?path=case/shortDecision',
                beforeSend: function () {
                },
                success: function (data) {
                    //console.log(data);
                    data = JSON.parse(data);
                    //console.log(data);
                    var items = [];
                    items.push('<option value="">বাছাই করুন</option>');

                    $(data).each(function(i,v){
                        items.push('<option value="'+v['id']+'">'+v['case_short_decision']+'</option>');
                    });
                    $('select[name="case_short_decision"]').html(items.join(''));
                    //console.log(data);
                    $('select[name="case_short_decision"]').select2();

                }
            });
        });
    </script>
@endsection
