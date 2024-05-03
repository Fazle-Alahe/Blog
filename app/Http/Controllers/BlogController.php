<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Popular;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\SubscriberMail;
use App\Models\Subscriber;

class BlogController extends Controller
{
    function blog(){
        $tags = Tag::all();
        return view('dashboard.blog.create_blog',[
            'tags' => $tags,
        ]);
    }

    function post_blog(Request $request){
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'title' => 'required',
            'tags' => 'required',
            'sub_title' => 'required',
            'desp' => 'required',
            'photo' => 'required',
        ]);


        $remove = array("@", "!", "#", "(", ")", "*", "/", '"',' ','?');
        $slug = Str::lower( str_replace( $remove , '-', $request->title)).'-'.random_int(500000, 600000);

        $photo = $request->photo;
        $extension = $photo->extension();
        $photo_name = Str::lower(str_replace(' ','-', $request->name.random_int(100000, 999999).'.'.$extension));
        $photo->move(public_path('uploads/blog/'),$photo_name);

        $blog_id = Blog::insertGetId([
            'blogger' =>$request->name,
            'blogger_id' =>$request->blogger_id,
            'category_id' =>$request->category_id,
            'title' =>$request->title,               
            'tags'=> implode(',',$request->tags),
            'sub_title' => $request->sub_title,
            'description' => $request->desp,
            'slug' => $slug,
            'thumbnail' => $photo_name,
            'status' => 1,
            'created_at' => Carbon::now(),
        ]);

        $tag = implode(",",$request->tags);
        $explode_tag = explode(',',$tag);
        foreach($explode_tag as $tag){
            $pops = Tag::where('id', $tag)->first()->uses;
            Tag::find($tag)->update([
                'uses' => $pops+1,
            ]);
        }
        
        return back()->with('success', 'Blog added succefully.');
    }

    function all_blog(){
        $blogs = Blog::where('deleted_at', '=', Null)->latest()->get();
        return view('dashboard.blog.all_blog',[
            'blogs' => $blogs,
        ]);
    }

    function blog_status($id){
        $blog = Blog::find($id);

        if($blog->status == 0){
            $blog->update([
                'status' => 1,
            ]);
        }
        elseif($blog->status == 1){
            $blog->update([
                'status' => 0,
            ]);
            
            $subscribers = Subscriber::all();
            foreach($subscribers as $subscriber){
                Mail::to($subscriber->email)->queue(new SubscriberMail($id));
            }
        }
        

        return back();
    }

    function blog_soft_delete($id){
        $blog = Blog::find($id);

        $blog->update([
            'status' => 1,
        ]);

        $blog->delete();
        return redirect()->route('all.blog')->with('soft_delete', 'Blog moved to trash!');
    }

    function edit_blog($id){
        $blog = Blog::find($id);
        $tags = Tag::all();
        return view('dashboard.blog.edit_blog',[
            'blog' => $blog,
            'tags' => $tags,
        ]);
    }

    function post_edit_blog(Request $request,$id){
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'title' => 'required',
            'tags' => 'required',
            'sub_title' => 'required',
            'desp' => 'required',
        ]);

        $blog = Blog::find($id);

        if($request->hasFile('photo')){
            $photo_delete = public_path('uploads/blog/'.$blog->thumbnail);
            unlink($photo_delete);

            $photo = $request->photo;
            $extension = $photo->extension();
            $photo_name = Str::lower(str_replace(' ','-', $request->name.random_int(100000, 999999).'.'.$extension));
            $photo->move(public_path('uploads/blog/'),$photo_name);

            Blog::find($id)->update([
                'blogger' =>$request->name,
                'category_id' =>$request->category_id,
                'title' =>$request->title,
                'tags'=> implode(',',$request->tags),
                'sub_title' => $request->sub_title,
                'description' => $request->desp,
                'thumbnail' => $photo_name,
                'status' => 1,
                'updated_at' => Carbon::now(),
            ]);
        }
        else{
            Blog::find($id)->update([
                'blogger' =>$request->name,
                'category_id' =>$request->category_id,
                'title' =>$request->title,
                'tags'=> implode(',',$request->tags),
                'sub_title' => $request->sub_title,
                'description' => $request->desp,
                'status' => 1,
                'updated_at' => Carbon::now(),
            ]);
        }

        return back()->with('success', 'Blog edited successfully');
    }

    function trash_blog(){
        // $cat = Category::onlyTrashed()->get();
        $blogs = Blog::onlyTrashed()->get();

        // $all ='';
        
        // foreach($cat as $cats){
        //     $all.=$cats->id;
        // }

        // $explode = explode(',',$all);

        // Blog::find($explode);
        // $blogs = Blog::onlyTrashed()->where('category_id', $explode)->get();

        return view('dashboard.blog.trash_blog',[
            'blogs' => $blogs,
        ]);
    }

    function restore_blog($id){
        Blog::onlyTrashed()->find($id)->restore();
        return back()->with('blog_restore', 'Blog restored!');
    }

    function blog_permanent_delete($id){
        $blogs = Blog::onlyTrashed()->find($id);

        $photo_delete = public_path('uploads/blog/'.$blogs->thumbnail);
        unlink($photo_delete);

        $blogs->forceDelete();
        Tag::find($id)->delete();
        return back()->with('pDelete', 'Blog deleted permanently');
    }

    function select_blog_soft_delete(Request $request){
        
        if($request->blog_id == ''){
            return back();
        }
        else{
            foreach($request->blog_id as $blog){
            $blog_id = Blog::find($blog);
            $blog_id->update([
                'status' => 1,
            ]);
            $blog_id->delete();
        }
        return back()->with('soft_delete', "Blog moved to trash!");
        }
    }

    function blog_select_restore(Request $request){
        if($request->btn == 1){
            if($request->blog_id == ''){
                return back();
            }
            else{
                foreach($request->blog_id as $blog){
                    Blog::onlyTrashed()->find($blog)->restore();
                }
                return back()->with('blog_restore', 'Blog restored!');
            }
        }
        elseif($request->btn == 2){
            
        if($request->blog_id == ''){
            return back();
        }
        else{
            foreach($request->blog_id as $blog){
                $blog_id = Blog::onlyTrashed()->find($blog);
                
            if($blog_id->thumbnail == null){

            }else{
                $photo_delete = public_path('uploads/blog/'.$blog_id->thumbnail);
                unlink($photo_delete);
            }
        
                $blog_id->forceDelete();
            }
            return back()->with('pDelete', 'Blog deleted permanently');
        }
        }
    }

    function blog_view($id){
        $blog = Blog::find($id);
        return view('dashboard.blog.blog_view',[
            'blog' => $blog,
        ]);
    }

    function single_blog($slug){
        $blogs = Blog::where('slug', $slug)->where('status', 0)->first()->id;
        $blog = Blog::find($blogs);
        $tags = Blog::where('slug', $slug)->first()->tags;
        $tag = explode(',',$tags);
        
        $pops = Blog::where('slug', $slug)->first()->view;

        $cat_id = Blog::where('slug', $slug)->first()->category_id;
        $cat_view = Category::where('id', $cat_id)->first()->view;
        // $popps = $pops++;
        $blog->update([
            'view' => $pops+1,
        ]);

        Category::find($cat_id)->update([
            'view' => $cat_view+1,
        ]);

        return view('Frontend.single_blog',[
            'blog' => $blog,
            'tag' => $tag,
        ]);
    }

    function all_blogs(Request $request){
        $data = $request->all();
        $blogs = Blog::where('status', 0)->where(function ($q) use ($data){
            if(!empty($data['search_input']) && $data['search_input'] != '' && $data['search_input'] != 'undefined'){
                $q->where(function($q) use ($data){
                    $q->where('title', 'like', '%'.$data['search_input'].'%');
                });
            }
            if(!empty($data['tag']) && $data['tag'] != '' && $data['tag'] != 'undefined'){
                $q->where(function($q) use ($data){
                    $all ='';
                    foreach(Blog::all() as $blog){
                        $explode = explode(',',$blog->tags);
                        if(in_array($data['tag'],$explode)){
                            $all.=$blog->id.',';
                        }
                    }
                    $explode2 = explode(',',$all);
                    $q->find($explode2);
                });
            }
        })->orderBy('id', 'DESC')->get();
        // $blogs = Blog::where('status', 0)->orderBy('id', 'DESC')->get();
        return view('Frontend.all_blog',[
            'blogs' => $blogs,
            // 'search_blogs' => $search_blogs,
        ]);
    }

    function category_blogs($id){
        $category = Category::find($id);
        $blogs = Blog::where('category_id', $id)->where('status', 0)->orderBy('id', 'DESC')->get();
        return view('Frontend.category_blog',[
            'category' =>$category,
            'blogs' =>$blogs,
        ]);
    }
}
