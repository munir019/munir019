@extends('layouts.app')

@section('content')
    <section class="box-typical box-typical-dashboard scrollable pl-3 pr-3">
        <div class="row">
            <div class="col-sm-8 col-md-8 relative">
                <h3 class="panel-title mb-2 mt-2">কার্য তালিকা সংশোধন করুন</h3>

                <form class="" action="<?php echo $baseUrl ?>causelist/modifySchedule" method="post" enctype="multipart/form-data" >
                    @csrf
                    <div class="form-group row">
                        <div class="col-sm-2 form-control-sm">
                            সাল:
                        </div>
                        <div class="col-sm-10 form-control-sm">
                            <?php echo $caseDetails['case_year']; ?>
                        </div>
                        <div class="col-sm-2 form-control-sm">
                            ধরন :
                        </div>
                        <div class="col-sm-10 form-control-sm">
                            <?php echo $caseType[$caseDetails['case_type']]['case_type']; ?>
                        </div>
                        <div class="col-sm-2 form-control-sm">
                            মামলা নং:
                        </div>
                        <div class="col-sm-10 form-control-sm">
                            <?php echo $caseDetails['case_no']; ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label form-control-sm">পরবর্তী শুনানির তারিখ</label>
                        <div class="col-sm-6 relative relative-password">
                            <input type="hidden" value="<?php echo $causeList['id']; ?>" name="id">
                            <input type="text" value="<?php echo $causeList['hearing_date'] ?>" required  name="hearing_date" autocomplete="off" class="form-control form-control-sm date">
                        </div>
                    </div>

                    <div class="mb-2">
                        <button type="submit" class="btn btn-sm btn-primary bn-font font-weight-normal"><i class="fa fa-save mr-2"></i>সংশোধন করুন</button>
                    </div>
                </form>
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

            $('input[name="complainant_name"],input[name="defender_name"],input[name="complainant_mobile"],input[name="defender_mobile"],input[name="case_no"]').bangla({ enable: true });
        });
    </script>
@endsection
