<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    function category(){
        $categories = Category::all();
        return view('dashboard.category.category',[
            'categories' => $categories,
        ]);
    }

    function add_category(Request $request){
        $request->validate([
            'category_name' => 'required',
            'icon' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($request->hasFile('icon')){
            $photo = $request->icon;
            $extension = $photo->extension();
            $photo_name = Str::lower(str_replace(' ','-', $request->category_name.random_int(100000, 999999).'.'.$extension));
            $photo->move(public_path('uploads/category/'),$photo_name);
            // Image::make($photo)->save(public_path('uploads/users/'.$photo_name));
            // Image::make($photo)->save(public_path('uploads/users/'.$photo_name));

            Category::insert([
                'category_name' => $request->category_name,
                'icon' => $photo_name,
                'created_at' => Carbon::now(),
            ]);
        }
        else{
            Category::insert([
                'category_name' => $request->category_name,
                'created_at' => Carbon::now(),
            ]);
        }
        return back()->with('success', "Category added successfully!!");
    
    }

    function edit_category($id){
        $categories = Category::find($id);
        return view('dashboard.category.edit_category',[
            'categories' => $categories,
        ]);
    }

    function update_category(Request $request,$id){
        
        $category = Category::find($id);

        $request->validate([
            'category_name' => 'required',
            'icon' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        if($request->hasFile('icon')){
            if($category->icon == null){

            }else{
                $photo_delete = public_path('uploads/category/'.$category->icon);
                unlink($photo_delete);
            }

            $photo = $request->icon;
            $extension = $photo->extension();
            $photo_name = Str::lower(str_replace(' ','-', $request->category_name.random_int(100000, 999999).'.'.$extension));
            $photo->move(public_path('uploads/category/'),$photo_name);
            // Image::make($photo)->save(public_path('uploads/users/'.$photo_name));
            // Image::make($photo)->save(public_path('uploads/users/'.$photo_name));

            $category->update([
                'category_name' => $request->category_name,
                'icon' => $photo_name,
                'updated_at' => Carbon::now(),
            ]);
        }
        else{
            $category->update([
                'category_name' => $request->category_name,
                'updated_at' => Carbon::now(),
            ]);
        }
        return back()->with('success', "Category updated successfully!!");
    }

    
    function category_soft_delete($id){
        $category_id = Category::find($id);
        $category_id->update([
            'status' => 1,
        ]);


        $category_id->delete();
        return back()->with('soft_delete', "Category moved to trash!");
    }

    
    function trash_category(){
        $trash_category = Category::onlyTrashed()->get();
        return view('dashboard.category.trash_category',[
            'trash_category' => $trash_category,
        ]);
    }

    
    function restore_category($id){
        Category::onlyTrashed()->find($id)->restore();
        return back()->with('category_restore', 'Category restored!');
    }

    
    function category_permanent_delete($id){
        $category_id = Category::onlyTrashed()->find($id);
        $blogs = Blog::where('category_id', $id)->get();
        foreach($blogs as $blog){
            $blog->update([
                'category_id' => 14,
            ]);
        }
        
        if($category_id->icon == null){

        }else{
            $photo_delete = public_path('uploads/category/'.$category_id->icon);
            unlink($photo_delete);
        }

        Category::onlyTrashed()->find($id)->forceDelete();
        return back()->with('pDelete', 'Category deleted permanently');
    }

    function category_status($id){
        $category_id = Category::find($id);
        $blogs = Blog::where('category_id', $id)->get();
        if($category_id->status == 0){
            $category_id->update([
                'status' => 1 ,
            ]);
            foreach($blogs as $blog){
                Blog::find($blog->id)->update([
                    'status' => 1,
                ]);
            }
        }
        else{
            $category_id->update([
                'status' => 0 ,
            ]);
        }
        return back();
    }

    function cat_select_soft_delete(Request $request){
        if($request->category_id == ''){
            return back();
        }
        else{
            foreach($request->category_id as $category){
                $category_id = Category::find($category);
                $category_id->update([
                    'status' => 1,
                ]);
                $category_id->delete();
            }
            return back()->with('soft_delete', "Category moved to trash!");
        }
    }

    function cat_select_restore(Request $request){
        if($request->btn == 1){
            if($request->category_id == ''){
                return back();
            }
            else{
                foreach($request->category_id as $category){
                    Category::onlyTrashed()->find($category)->restore();
                }
                return back()->with('category_restore', 'Category restored!');
            }
        }
        elseif($request->btn == 2){
            
            if($request->category_id == ''){
                return back();
            }
            else{
                foreach($request->category_id as $category){
                    $category_id = Category::onlyTrashed()->find($category);
                    $blogs = Blog::where('category_id', $category)->get();
                    
                    foreach($blogs as $blog){
                        $blog->update([
                            'category_id' => 14,
                        ]);
                    }
                    if($category_id->icon == null){
    
                    }else{
                        $photo_delete = public_path('uploads/category/'.$category_id->icon);
                        unlink($photo_delete);
                    }
                
                    Category::onlyTrashed()->find($category)->forceDelete();
                }
                return back()->with('pDelete', 'Category deleted permanently');
            }
        }
    }
}
