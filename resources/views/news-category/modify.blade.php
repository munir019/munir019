@extends('layouts.app')
@section('content')
    <h5 class="card-title">News Category</h5>
    <hr>
    <form id="submit-form" action="<?php echo $baseUrl ?>newscategory/update" method="post" enctype="multipart/form-data" class="forms-sample">
        @csrf
        <div class="row">
            <div class="col-md-5 col-sm-12">
                <div class="card mb-2">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Basic Information</h5>

                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="name" value="<?php echo (isset($newscategory['name'])?$newscategory['name']:''); ?>">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Title</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="title" value="<?php echo (isset($newscategory['title'])?$newscategory['title']:''); ?>">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Url</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="url" value="<?php echo (isset($newscategory['url'])?$newscategory['url']:''); ?>">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Parent</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="parent_id" <?php echo (isset($newscategory['parent_id'])?'data-id="'.$newscategory['parent_id'].'"':''); ?> >
                                    <option >Select</option>
                                    <option value="1">1</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Hierarchy</label>
                            <div class="col-sm-3">
                                <input type="number" class="form-control" name="hierarchy" value="<?php echo (isset($newscategory['hierarchy'])?$newscategory['hierarchy']:'999'); ?>">
                            </div>
                            <label class="col-sm-3 col-form-label pe-0">Sub Hierarchy</label>
                            <div class="col-sm-3">
                                <input type="number" class="form-control" name="sub_hierarchy" value="<?php echo (isset($newscategory['sub_hierarchy'])?$newscategory['sub_hierarchy']:'999'); ?>">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Max News</label>
                            <label class="col-sm-2 col-form-label pe-0">On Front</label>
                            <div class="col-sm-2">
                                <input type="number" class="form-control" name="hierarchy" value="<?php echo (isset($newscategory['hierarchy'])?$newscategory['hierarchy']:'5'); ?>">
                            </div>
                            <label class="col-sm-3 col-form-label pe-0">On Category</label>
                            <div class="col-sm-2">
                                <input type="number" class="form-control" name="sub_hierarchy" value="<?php echo (isset($newscategory['sub_hierarchy'])?$newscategory['sub_hierarchy']:'15'); ?>">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Edition</label>
                            <div class="col-sm-9 pt-2">
                                <div class="form-check-inline me-4">
                                    <input class="form-check-input me-1" type="checkbox" name="online_edition" value="" id="onlineEdition" required>
                                    <label class="form-check-label" for="onlineEdition">
                                        Online
                                    </label>
                                </div>
                                <div class="form-check-inline">
                                    <input class="form-check-input me-1" type="checkbox" name="print_edition" value="" id="printEdition" required>
                                    <label class="form-check-label" for="printEdition">
                                        Print
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Publish</label>
                            <div class="col-sm-9 pt-2">
                                <div class="form-check-inline me-4">
                                    <input class="form-check-input me-1" type="checkbox" name="statusActive" value="" id="status" required>
                                    <label class="form-check-label" for="statusActive">
                                        Yes
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-12">
                <div class="card mb-2">
                    <div class="card-body">
                        <h5 class="card-title mb-4">On Web</h5>

                        <div class="mb-3 row">
                            <label class="col-sm-3 col-3 col-form-label">Header</label>
                            <div class="col-sm-3 col-3 pt-2">
                                <div class="form-check-inline me-0">
                                    <input class="form-check-input me-1" type="checkbox" name="header_display" value="" id="onHeader" required>
                                    <label class="form-check-label" for="onHeader">
                                        Yes
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-3 col-3">
                                <label class="col-form-label">
                                    Hierarchy
                                </label>
                            </div>
                            <div class="col-sm-3 col-3">
                                <input type="text" value="<?php echo (isset($newscategory['header_hierarchy'])?$newscategory['header_hierarchy']:'999'); ?>" name="header_hierarchy" class="form-control">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-3 col-3 col-form-label">Body</label>
                            <div class="col-sm-3 col-3 pt-2">
                                <div class="form-check-inline me-0">
                                    <input class="form-check-input me-1" type="checkbox" name="body_display" value="" id="onBody" required>
                                    <label class="form-check-label" for="onBody">
                                        Yes
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-3 col-3">
                                <label class="col-form-label">
                                    Hierarchy
                                </label>
                            </div>
                            <div class="col-sm-3 col-3">
                                <input type="text" value="<?php echo (isset($newscategory['body_hierarchy'])?$newscategory['body_hierarchy']:'999'); ?>" name="body_hierarchy" class="form-control">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-3 col-3 col-form-label">Footer</label>
                            <div class="col-sm-3 col-3 pt-2">
                                <div class="form-check-inline me-0">
                                    <input class="form-check-input me-1" type="checkbox" name="footer_display" value="" id="onFooter" required>
                                    <label class="form-check-label" for="onFooter">
                                        Yes
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-3 col-3">
                                <label class="col-form-label">
                                    Hierarchy
                                </label>
                            </div>
                            <div class="col-sm-3 col-3">
                                <input type="text" value="<?php echo (isset($newscategory['footer_hierarchy'])?$newscategory['footer_hierarchy']:'999'); ?>" name="footer_hierarchy" class="form-control">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-3 col-3 col-form-label">Right</label>
                            <div class="col-sm-3 col-3 pt-2">
                                <div class="form-check-inline me-0">
                                    <input class="form-check-input me-1" type="checkbox" name="right_display" value="" id="onRight" required>
                                    <label class="form-check-label" for="onRight">
                                        Yes
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-3 col-3">
                                <label class="col-form-label">
                                    Hierarchy
                                </label>
                            </div>
                            <div class="col-sm-3 col-3">
                                <input type="text" value="<?php echo (isset($newscategory['right_hierarchy'])?$newscategory['right_hierarchy']:'999'); ?>" name="right_hierarchy" class="form-control">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-3 col-3 col-form-label">Special</label>
                            <div class="col-sm-3 col-3 pt-2">
                                <div class="form-check-inline me-0">
                                    <input class="form-check-input me-1" type="checkbox" name="special_display" value="" id="onSpecial" required>
                                    <label class="form-check-label" for="onSpecial">
                                        Yes
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-3 col-3">
                                <label class="col-form-label">
                                    Hierarchy
                                </label>
                            </div>
                            <div class="col-sm-3 col-3">
                                <input type="text" value="<?php echo (isset($newscategory['special_hierarchy'])?$newscategory['special_hierarchy']:'999'); ?>" name="special_hierarchy" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-2">
                    <div class="card-body">
                        <h5 class="card-title mb-4">On Mobile</h5>

                        <div class="mb-3 row">
                            <label class="col-sm-3 col-3 col-form-label">Header</label>
                            <div class="col-sm-3 col-3 pt-2">
                                <div class="form-check-inline me-0">
                                    <input class="form-check-input me-1" type="checkbox" name="mobile_header_display" value="" id="onHeader" required>
                                    <label class="form-check-label" for="onHeader">
                                        Yes
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-3 col-3">
                                <label class="col-form-label">
                                    Hierarchy
                                </label>
                            </div>
                            <div class="col-sm-3 col-3">
                                <input type="text" value="<?php echo (isset($newscategory['mobile_header_hierarchy'])?$newscategory['mobile_header_hierarchy']:'999'); ?>" name="mobile_header_hierarchy" class="form-control">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-3 col-3 col-form-label">Body</label>
                            <div class="col-sm-3 col-3 pt-2">
                                <div class="form-check-inline me-0">
                                    <input class="form-check-input me-1" type="checkbox" name="mobile_body_display" value="" id="onBody" required>
                                    <label class="form-check-label" for="onBody">
                                        Yes
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-3 col-3">
                                <label class="col-form-label">
                                    Hierarchy
                                </label>
                            </div>
                            <div class="col-sm-3 col-3">
                                <input type="text" value="<?php echo (isset($newscategory['mobile_body_hierarchy'])?$newscategory['mobile_body_hierarchy']:'999'); ?>" name="mobile_body_hierarchy" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-12">
                <div class="card mb-2">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Advance</h5>

                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Color</label>
                            <div class="col-sm-9">
                                <input type="color" class="form-control" name="color" value="<?php echo (isset($newscategory['color'])?$newscategory['color']:''); ?>">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Icon</label>
                            <div class="col-sm-9">
                                <input type="file"  name="cat_image" class="form-control" >
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Banner</label>
                            <div class="col-sm-9">
                                <input type="file"  name="cat_banner_image" class="form-control" >
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-2">
                    <div class="card-body">
                        <h5 class="card-title mb-4">SEO</h5>

                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Meta Key</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="meta_key" value="<?php echo (isset($newscategory['meta_key'])?$newscategory['meta_key']:''); ?>">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Meta Description</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="meta_description" rows="3"><?php echo (isset($newscategory['meta_description'])?$newscategory['meta_description']:''); ?></textarea>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Social Image</label>
                            <div class="col-sm-9">
                                <input type="file"  name="social_image" class="form-control" >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">

            </div>
        </div>

    </form>

@endsection