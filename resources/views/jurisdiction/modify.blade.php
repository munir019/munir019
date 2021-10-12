@extends('layouts.app')

@section('content')
<section class="box-typical box-typical-dashboard scrollable pl-3 pr-3 hidd">
    <header class="panel-heading position-relative clearfix bn-font px-0">
    <h3 class="panel-title mb-2 bn-font"><?php echo (isset(request()->id)?'Edit Jurisdiction':'Add New Jurisdiction') ?></h3>
    </header>

    <form id="submit-form" action="<?php echo $baseUrl ?>jurisdiction/update" method="post" enctype="multipart/form-data" class="forms-sample">
        @csrf
        <div class="row entry-form">
            <div class="col-sm-12">
                <div class="card card-green">
                    <header class="card-header bn-font p-2">JurisDiction</header>
                    <div class="card-block">
                        <div class="row mb-3">
                            <input type="hidden" name="id" value="<?php echo (isset($jurisDiction['id'])?$jurisDiction['id']:''); ?>">
                            
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label form-control-sm bn-font">Description
                                         <span class="text-danger ml-1 font-16">*</span></label>
                                        <div class="col-sm-8 relative">
                                            <textarea name="description_en" value="" class="form-control bn-font" rows="3" cols="10" required><?php echo (isset($jurisDiction['description_en'])?$jurisDiction['description_en']:''); ?></textarea>
                                        </div>
                                </div>
                            </div>
                            
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label form-control-sm">Description Bangla  <span class="text-danger ml-1 font-16">*</span></label>
                                    <div class="col-sm-8">
                                        <div class="form-check pl-0">
                                            <label class="form-check-label">
                                                <textarea name="description" value="" class="form-control bn-font" rows="3" cols="10" required><?php echo (isset($jurisDiction['description'])?$jurisDiction['description']:''); ?></textarea>
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

@endsection
