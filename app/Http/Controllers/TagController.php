<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TagController extends Controller
{
    function tag(){
        $tags = Tag::paginate(10);
        return view('dashboard.tag.tag',[
            'tags' => $tags,
        ]);
    }

    function store_tag(Request $request){
        $request->validate([
            'tag_name' => 'required|unique:tags',
        ]);

        Tag::insert([
            'tag_name' => $request->tag_name,
            'created_at' => Carbon::now(),
        ]);
        return back();
    }

    function tag_soft_delete($id){
        Tag::find($id)->delete();
        return back()->with('soft_delete', "Tags moved to trash!");
    }

    function tag_select_soft_delete(Request $request){
        if($request->tag_id == ''){
            return back();
        }
        else{
            foreach($request->tag_id as $tag){
                Tag::find($tag)->delete();
            }
            return back()->with('soft_delete', "Tags moved to trash!");
        }
    }

    function trash_tag(){
        $trash_tag = Tag::onlyTrashed()->get();
        return view('dashboard.tag.trash_tag',[
            'trash_tag' => $trash_tag,
        ]);
    }

    function restore_tag($id){
        Tag::onlyTrashed()->find($id)->restore();
        return back()->with('tag_restore', 'Tags restored!');
    }
    
    function user_permanent_delete($id){
        Tag::onlyTrashed()->find($id)->forceDelete();
        return back()->with('pDelete', 'Tags deleted permanently');
    }

    
    function tag_select_restore(Request $request){
        if($request->btn == 1){
            if($request->tag_id == ''){
                return back();
            }
            else{
                foreach($request->tag_id as $tag){
                    Tag::onlyTrashed()->find($tag)->restore();
                }
                return back()->with('tag_restore', 'Tags restored!');
            }
        }
        elseif($request->btn == 2){
            if($request->tag_id == ''){
                return back();
            }
            else{
                foreach($request->tag_id as $tag){
                    Tag::onlyTrashed()->find($tag)->forceDelete();
                }
                return back()->with('pDelete', 'Tags deleted permanently');
            }
        }
    }
}
