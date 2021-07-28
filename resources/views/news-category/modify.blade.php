@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <form id="submit-form" action="<?php echo $baseUrl ?>newscategory/update" method="post" enctype="multipart/form-data" class="forms-sample">
        @csrf
        <div class="entry-form">
            <div class="grid-margin bg-white">
                <div class="row">
                    <div class="com-md-4 col-sm-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">News category</h4>
                                <div class="card-block">
                                    <div class="form-group row">
                                        <label for="exampleInputUsername1" class="col-sm-4 col-form-label form-control-sm">Name<span class="text-danger ml-1 font-20">*</span></label>
                                        <div class="col-sm-8">
                                            <input type="text" value="<?php echo (isset($newscategory['name'])?$newscategory['name']:''); ?>" class="form-control form-contron-sm" id="exampleInputUsername1" name="name" required autocomplete="off" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="exampleInputUsername1" class="col-sm-4 col-form-label form-control-sm">Url<span class="text-danger ml-1 font-20">*</span></label>
                                        <div class="col-sm-8">
                                            <input type="text" value="<?php echo (isset($newscategory['url'])?$newscategory['url']:''); ?>" class="form-control form-control-sm" id="exampleInputUsername1" name="url" required autocomplete="off" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="exampleInputUsername1" class="col-sm-4 col-form-label form-control-sm">Color</label>
                                        <div class="col-sm-8">
                                            <input type="text" value="<?php echo (isset($newscategory['color'])?$newscategory['color']:''); ?>" class="form-control form-control-sm" id="exampleInputUsername1" name="color" required autocomplete="off" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="exampleInputUsername1" class="col-sm-4 col-form-label form-control-sm">Parent Menu</label>
                                        <div class="col-sm-8">
                                            <select class="form-control form-control-sm" id="exampleInputUsername1" name="parent_id" <?php echo (isset($newscategory['parent_id'])?'data-id="'.$newscategory['parent_id'].'"':''); ?> >
                                                <option >Select</option>
                                                <option value="1">Yes</option>
                                                <option value="0">No </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label form-control-sm">Hierarchy</label>
                                        <div class="col-sm-8 relative">
                                            <input type="text" value="<?php echo (isset($newscategory['hierarchy'])?$newscategory['hierarchy']:''); ?>" name="hierarchy" autocomplete="off" class="form-control form-control-sm" id="exampleInputUsername1" >
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label form-control-sm">Sub-hierarchy</label>
                                        <div class="col-sm-8">
                                            <input type="text" value="<?php echo (isset($newscategory['sub_hierarchy'])?$newscategory['sub_hierarchy']:''); ?>" name="sub_hierarchy" autocomplete="off" class="form-control form-control-sm" >
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label form-control-sm">Header Display</label>
                                        <div class="col-sm-8">
                                            <select class="form-control form-control-sm" name="header_display" <?php echo (isset($newscategory['header_display'])?'data-id="'.$newscategory['header_display'].'"':''); ?> >
                                                <option>Select</option>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label form-control-sm">Header Hierarchy</label>
                                        <div class="col-sm-8 relative">
                                            <input type="text" value="<?php echo (isset($newscategory['header_hierarchy'])?$newscategory['header_hierarchy']:''); ?>" name="header_hierarchy" autocomplete="off" class="form-control form-control-sm" id="exampleInputUsername1" >
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label form-control-sm">Body Display</label>
                                        <div class="col-sm-8">
                                            <select class="form-control form-control-sm" name="body_display" <?php echo (isset($newscategory['body_display'])?'data-id="'.$newscategory['body_display'].'"':''); ?> >
                                                <option>Select</option>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>    
                        </div>
                    </div>
                    <div class="com-md-4 col-sm-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"></h4>
                                <div class="card-block">
                                   <div class="form-group row">
                                        <label class="col-sm-4 col-form-label form-control-sm">Body Hierarchy</label>
                                        <div class="col-sm-8 relative">
                                            <input type="text" value="<?php echo (isset($newscategory['body_hierarchy'])?$newscategory['body_hierarchy']:''); ?>" name="body_hierarchy" autocomplete="off" class="form-control form-control-sm" id="exampleInputUsername1" >
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label form-control-sm">Footer Display</label>
                                        <div class="col-sm-8">
                                            <select class="form-control form-control-sm" name="footer_display" <?php echo (isset($newscategory['footer_display'])?'data-id="'.$newscategory['footer_display'].'"':''); ?> >
                                                <option>Select</option>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label form-control-sm">Footer Hierarchy</label>
                                        <div class="col-sm-8 relative">
                                            <input type="text" value="<?php echo (isset($newscategory['footer_hierarchy'])?$newscategory['footer_hierarchy']:''); ?>" name="footer_hierarchy" autocomplete="off" class="form-control form-control-sm" id="exampleInputUsername1" >
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label form-control-sm">Right Display</label>
                                        <div class="col-sm-8">
                                            <select class="form-control form-control-sm" name="right_display" <?php echo (isset($newscategory['right_display'])?'data-id="'.$newscategory['right_display'].'"':''); ?> >
                                                <option>Select</option>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label form-control-sm">Right Hierarchy</label>
                                        <div class="col-sm-8 relative">
                                            <input type="text" value="<?php echo (isset($newscategory['right_hierarchy'])?$newscategory['right_hierarchy']:''); ?>" name="right_hierarchy" autocomplete="off" class="form-control form-control-sm" id="exampleInputUsername1" >
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label form-control-sm">Mobile Header</label>
                                        <div class="col-sm-8">
                                            <select class="form-control form-control-sm" name="mobile_header_display" <?php echo (isset($newscategory['mobile_header_display'])?'data-id="'.$newscategory['mobile_header_display'].'"':''); ?> >
                                                <option>Select</option>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label form-control-sm">Mobile Header Hierarchy</label>
                                        <div class="col-sm-8 relative">
                                            <input type="text" value="<?php echo (isset($newscategory['mobile_header_hierarchy'])?$newscategory['mobile_header_hierarchy']:''); ?>" name="mobile_header_hierarchy" autocomplete="off" class="form-control form-control-sm" id="exampleInputUsername1" >
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label form-control-sm">Mobile Body Display</label>
                                        <div class="col-sm-8">
                                            <select class="form-control form-control-sm" name="mobile_body_display" <?php echo (isset($newscategory['mobile_body_display'])?'data-id="'.$newscategory['mobile_body_display'].'"':''); ?> >
                                                <option>Select</option>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label form-control-sm">Mobile Body Hierarchy</label>
                                        <div class="col-sm-8 relative">
                                            <input type="text" value="<?php echo (isset($newscategory['mobile_body_hierarchy'])?$newscategory['mobile_body_hierarchy']:''); ?>" name="mobile_body_hierarchy" autocomplete="off" class="form-control form-control-sm" id="exampleInputUsername1" >
                                        </div>
                                    </div>
                                    
                                       
                                </div>
                            </div>    
                        </div>
                    </div> 
                    <div class="com-md-4 col-sm-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"></h4>
                                <div class="card-block">
                                   
                                    
                                    
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label form-control-sm">Special Display</label>
                                        <div class="col-sm-8">
                                            <select class="form-control form-control-sm" name="special_display" <?php echo (isset($newscategory['special_display'])?'data-id="'.$newscategory['special_display'].'"':''); ?> >
                                                <option>Select</option>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label form-control-sm">Special Hierarchy</label>
                                        <div class="col-sm-8 relative">
                                            <input type="text" value="<?php echo (isset($newscategory['special_hierarchy'])?$newscategory['special_hierarchy']:''); ?>" name="special_hierarchy" autocomplete="off" class="form-control form-control-sm" id="exampleInputUsername1" >
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label form-control-sm">Online Edition</label>
                                        <div class="col-sm-8">
                                            <select class="form-control form-control-sm" name="online_edition" <?php echo (isset($newscategory['online_edition'])?'data-id="'.$newscategory['online_edition'].'"':''); ?> >
                                                <option>Select</option>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label form-control-sm">Print Edition</label>
                                        <div class="col-sm-8">
                                            <select class="form-control form-control-sm" name="print_edition" <?php echo (isset($newscategory['print_edition'])?'data-id="'.$newscategory['print_edition'].'"':''); ?> >
                                                <option>Select</option>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label form-control-sm">Meta Key</label>
                                        <div class="col-sm-8 relative">
                                            <input type="text" value="<?php echo (isset($newscategory['meta_key'])?$newscategory['meta_key']:''); ?>" name="meta_key" autocomplete="off" class="form-control form-control-sm" id="exampleInputUsername1" >
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label form-control-sm">Meta description</label>
                                        <div class="col-sm-8 relative">
                                            <input type="text" value="<?php echo (isset($newscategory['meta_description'])?$newscategory['meta_description']:''); ?>" name="meta_description" autocomplete="off" class="form-control form-control-sm" id="exampleInputUsername1" >
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label form-control-sm">Social Images</label>
                                        <div class="col-sm-8 relative">
                                            <input type="file"  name="social_image" autocomplete="off" class="form-control form-control-sm" id="exampleInputUsername1" >
                                            
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label form-control-sm">Category image</label>
                                        <div class="col-sm-8 relative">
                                            <input type="file"  name="cat_image" autocomplete="off" class="form-control form-control-sm" id="exampleInputUsername1" >
                                            
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label form-control-sm">Publish</label>
                                        <div class="col-sm-8">
                                            <select class="form-control form-control-sm" name="status" <?php echo (isset($newscategory['status'])?'data-id="'.$newscategory['status'].'"':''); ?> >
                                                <option>Select</option>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success float-right">Save</button>
                                 </div>
                            </div>    
                        </div>
                    </div> 
                </div>    
            </div>
        </div>

    </form>
</div>

@endsection