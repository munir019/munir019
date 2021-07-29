<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\NewsCategory;

class NewsCategoryController extends Controller
{
    public function index(Request $request)
    {
        $title = 'News Category';
        return view('news-category.index', compact(['title']));
    }
    public function add(Request $request)
    {
        $title = 'Add News Category';
        $newsCategory = '';
        return view('news-category.modify', compact(['newsCategory','title']));
    }
    public function update(Request $request)
    {
        $result = array('status'=>0);
        if ($request->isMethod('post')) {
           
            if (isset($request->id)) {
                $newsCategory = NewsCategory::find($request->id);
                //$msg = '';
            } else {
                $newsCategory = new NewsCategory();
                $newsCategory->id = uniqid();
                $sendSms = true;
                //$msg = '';
            }
            
            $newsCategory->name = $request->name;
            $newsCategory->url = $request->url;
            $newsCategory->color = $request->color;
            $newsCategory->parent_id = $request->parent_id;
            $newsCategory->hierarchy = $request->hierarchy;
            $newsCategory->sub_hierarchy = $request->sub_hierarchy;
            $newsCategory->header_display = $request->header_display;
            $newsCategory->header_hierarchy = $request->header_hierarchy;
            $newsCategory->body_display = $request->body_display;
            $newsCategory->body_hierarchy = $request->body_hierarchy;
            $newsCategory->footer_display = $request->footer_display;
            $newsCategory->footer_hierarchy = $request->footer_hierarchy;
            $newsCategory->right_display = $request->right_display;
            $newsCategory->right_hierarchy = $request->right_hierarchy;

            $newsCategory->mobile_header_display = $request->mobile_header_display;
            $newsCategory->mobile_header_hierarchy = $request->mobile_header_hierarchy;
            $newsCategory->mobile_body_display = $request->mobile_body_display;
            $newsCategory->mobile_body_hierarchy = $request->mobile_body_hierarchy;
            $newsCategory->special_display = $request->special_display;
            $newsCategory->special_hierarchy = $request->special_hierarchy;

            $newsCategory->online_edition = $request->online_edition;
            $newsCategory->print_edition = $request->print_edition;

            $newsCategory->meta_key = $request->meta_key;
            $newsCategory->meta_description = $request->meta_description;
            
            if ($request->hasfile('social_image')) {
                foreach ($request->file('social_image') as $file) {
                    $ext = $file->getClientOriginalName();
                    $token = time();
                    $prefix = 'social-image';
                    $name = $prefix.'_'.$token.'.'.$ext;
                    $path = public_path().'/img/social-image';
                    if (!is_dir($path)) {
                        mkdir($path);
                    }
                    $file->move($path, $name);
                    $social_image = $name;
                }
            }
            if ($request->hasfile('cat_image')) {
                foreach ($request->file('cat_image') as $file) {
                    $ext = $file->getClientOriginalName();
                    $token = time();
                    $prefix = 'cat-image';
                    $name = $prefix.'_'.$token.'.'.$ext;
                    $path = public_path().'/img/cat-image';
                    if (!is_dir($path)) {
                        mkdir($path);
                    }
                    $file->move($path, $name);
                    $cat_image = $name;
                }
            }
            $newsCategory->status = $request->status;
            $newsCategory->created_at = date('Y-m-d H:i:s');
            $newsCategory->updated_at = date('Y-m-d H:i:s');
            $newsCategory->published_time = date('Y-m-d H:i:s');
            $newsCategory->updated_time = date('Y-m-d H:i:s');

            $newsCategory->save();
            $result = array('status'=>1);
        }
        //return view('news-category.modify',compact(['newsCategory']));
        return redirect(config('app.url').'newsCategory')->with('success', $msg);
       
    }
}