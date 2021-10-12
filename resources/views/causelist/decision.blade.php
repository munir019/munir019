@extends('layouts.app')

@section('content')
    <section class="box-typical box-typical-dashboard scrollable pl-3 pr-3">
        <div class="row">

            <div class="col-md-4 col-sm-4 ">

                <div class="card card-green mt-2">
                    <header class="card-header p-1 pl-3 bn-font">মামলার তথ্য : </header>
                    <div class="card-block ">
                        <div class="col-sm-4 col-md-12">
                            <div class="form-group row mb-0">
                                <label class="col-sm-4 col-form-label form-control-sm bn-font">সাল : </label>
                                <label class="col-sm-8 col-form-label form-control-sm"><?php echo $caseDetails['case_year'] ?></label>
                            </div>
                        </div>
                        <?php
                        //dd($caseType);
                        ?>
                        <div class="col-sm-4 col-md-12">
                            <div class="form-group row mb-0">
                                <label class="col-sm-4 col-form-label form-control-sm bn-font">ধরন : </label>
                                    <label class="col-sm-8 col-form-label form-control-sm bn-font"><?php echo (isset($caseType[$caseDetails['case_type']])?$caseType[$caseDetails['case_type']]['case_type']:'') ?></label>
                            </div>
                        </div>
                       <div class="col-sm-4 col-md-12">
                            <div class="form-group row mb-0">
                                <label class="col-sm-4 col-form-label form-control-sm bn-font">মামলা নং : </label>
                                    <label class=" col-sm-8 col-form-label form-control-sm"><?php echo $caseDetails['case_no'] ?></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-green mt-2">
                    <header class="card-header p-1 pl-3 bn-font ">বাদীর তথ্য : </header>
                    <div class="card-block ">
                        <div class="col-sm-4 col-md-12">
                          <div class="form-group row mb-0">
                            <label class="col-sm-4 col-form-label form-control-sm bn-font">নাম : </label>
                            <label class="col-sm-8 col-form-label form-control-sm bn-font"><?php echo $caseDetails['complainant_name'] ?></label>
                          </div>
                        </div>
                        <div class="col-sm-4 col-md-12">
                            <div class="form-group row mb-0">
                                <label class="col-sm-4 col-form-label form-control-sm bn-font">মোবাইল : </label>
                                <label class="col-sm-8 col-form-label form-control-sm"><?php echo $caseDetails['complainant_mobile'] ?></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-green mt-2">
                    <header class="card-header p-1 pl-3 bn-font">বিবাদীর তথ্য : </header>
                    <div class="card-block ">
                        <div class="col-sm-4 col-md-12">

                            <div class="form-group row mb-0">
                                <label class="col-sm-4 col-form-label form-control-sm bn-font">নাম : </label>
                                <label class="col-sm-8 col-form-label form-control-sm bn-font"><?php echo $caseDetails['defender_name'] ?></label>
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-12">
                            <div class="form-group row mb-0">
                                <label class="col-sm-4 col-form-label form-control-sm bn-font">মোবাইল : </label>
                                <label class="col-sm-8 col-form-label form-control-sm"><?php echo $caseDetails['defender_mobile'] ?></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-8 col-md-8 relative">
                <div class="card card-purple mt-2">
                    <header class="card-header p-1 pl-3 bn-font">কার্যতালিকা হালনাগাদ করুন : </header>
                    <div class="card-block ">
                        <form class="" action="<?php echo $baseUrl ?>causelist/update" method="post" enctype="multipart/form-data" >
                            @csrf
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label form-control-sm bn-font">পরবর্তী শুনানির তারিখ <span class="text-danger ml-1 font-16">*</span>: </label>
                                <div class="col-md-5 relative relative-password">
                                    <input type="text" required  name="next_hearing_date" autocomplete="off" class="form-control form-control-sm date" required >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label form-control-sm bn-font">মামলার অবস্থা <span class="text-danger ml-1 font-16">*</span> : </label>
                                <div class="col-sm-5 relative">
                                    <select class="form-control form-control-sm bn-font" name="case_status" required>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label form-control-sm bn-font">রায়ের সারসংক্ষেপ<span class="text-danger ml-1 font-16">*</span> : </label>
                                <div class="col-sm-5 relative">
                                    <select class="form-control form-control-sm en-font" name="case_short_decision">
                                     </select>
                                </div>

                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label form-control-sm bn-font">রায়ের বর্ণনা : </label>
                                <div class="col-sm-5 relative relative-password">
                                    <textarea  name="case_details_decision" class="form-control bn-font" rows="2" cols="10"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <input type="hidden" value="<?php echo $causeList[0]['id'] ?>" name="id"> 
                                </div>
                                <div class="col-sm-5 mb-2 text-right">
                                    <button type="submit" class="btn btn-sm btn-primary bn-font font-weight-normal"><i class="fa fa-save mr-2"></i>সংরক্ষণ করুন</button>
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
