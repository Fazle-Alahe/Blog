<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    function store_reply(Request $request,$id){
        $request->validate([
            'reply' => 'required',
        ]);
        // echo $request->blogger_id;
        // die;
        Reply::insert([
            'comment_id' => $id,
            'post_id' => $request->post_id,
            'blogger_id' => $request->blogger_id,
            'commentor_id' => $request->commentor_id,
            'reply' => $request->reply,
            'created_at' => Carbon::now(),
        ]);
        return back()->with('reply', "You've replied successfully.");
    }

    function store_child_reply(Request $request,$id){
        // echo $request->$id;
        $request->validate([
            'child_reply' => 'required',
        ]);

        Reply::insert([
            'comment_id' => $request->comment_id,
            'post_id' => $request->post_id,
            'blogger_id' => $request->blogger_id,
            'commentor_id' => $request->commentor_id,
            'reply' => $request->child_reply,
            'parent_reply' => $id,
            'created_at' => Carbon::now(),
        ]);
        return back()->with('reply', "You've replied successfully.");
    }

    function notification(){
        return view('Frontend.notification');
    }

    
    function reply_view($id){
        $reply = Reply::find($id);
        $reply->update([
            'status' => 1,
        ]);
        return view('Frontend.reply_view',[
            'reply' => $reply,
        ]);
    }
}
