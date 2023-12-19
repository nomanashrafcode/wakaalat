<?php

namespace App\Http\Controllers\Admin;

use App\BlogCategory;
use App\Blog;
use App\ManageText;
use App\ValidationText;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Str;
use App\NotificationText;
class BlogCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories=BlogCategory::all();
        $blogs=Blog::all();
        $website_lang=ManageText::all();
        return view('admin.blog.category.index',compact('categories','blogs','website_lang'));
    }


    public function store(Request $request)
    {
                // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $valid_lang=ValidationText::all();
        $rules = [
            'name'=>'required|unique:blog_categories',
            'status'=>'required'

        ];
        $customMessages = [
            'name.required' => $valid_lang->where('lang_key','req_name')->first()->custom_lang,
            'name.unique' => $valid_lang->where('lang_key','unique_name')->first()->custom_lang,
            'status.unique' => $valid_lang->where('lang_key','req_status')->first()->custom_lang
        ];
        $this->validate($request, $rules, $customMessages);



        BlogCategory::create([
            'name'=>$request->name,
            'slug'=>Str::slug($request->name),
            'status'=>$request->status,
        ]);

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','create')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.blog-category.index')->with($notification);
    }

    public function update(Request $request, BlogCategory $blogCategory)
    {

                // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end

        $valid_lang=ValidationText::all();
        $rules = [
            'name'=>'required|unique:blog_categories,name,'.$blogCategory->id
        ];
        $customMessages = [
            'name.required' => $valid_lang->where('lang_key','req_name')->first()->custom_lang,
            'name.unique' => $valid_lang->where('lang_key','unique_name')->first()->custom_lang,
        ];
        $this->validate($request, $rules, $customMessages);


        $blogCategory->name=$request->name;
        $blogCategory->slug=Str::slug($request->name);
        $blogCategory->save();

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.blog-category.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BlogCategory  $blogCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlogCategory $blogCategory)
    {
                // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array('messege'=>env('NOTIFY_TEXT'),'alert-type'=>'error');
            return redirect()->back()->with($notification);
        }
        // end
        $blogCategory->delete();
        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','delete')->first()->custom_lang;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.blog-category.index')->with($notification);
    }

    public function changeStatus($id){
        $category=BlogCategory::find($id);
        if($category->status==1){
            $category->status=0;
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','inactive')->first()->custom_lang;
            $message=$notification;
        }else{
            $category->status=1;
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','active')->first()->custom_lang;
            $message=$notification;
        }
        $category->save();
        return response()->json($message);

    }
}
