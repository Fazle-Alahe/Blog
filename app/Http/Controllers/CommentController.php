<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    function store_comment(Request $request,$id){
        Comment::insert([
            'post_id' => $id,
            'blogger_id' => $request->blogger_id,
            'commentor_id' => $request->commentor_id,
            'comment' => $request->comment,
            'created_at' => Carbon::now(),
        ]);
        return back()->with('comment', "You've commented successfully.");
    }

    function comment_view($id){
        $comment = Comment::find($id);
        $comment->update([
            'status' => 1,
        ]);
        return view('Frontend.comment_view',[
            'comment' => $comment,
        ]);
    }
}
