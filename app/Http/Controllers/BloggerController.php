<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;

class BloggerController extends Controller
{
    function blogger(){
        return view('Frontend.bloggers');
    }

    function single_blogger($id){
        $user = User::find($id);
        $blogs = Blog::where('status', 0)->where('blogger_id', $id)->paginate(9);
        return view('Frontend.blogger_single',[
            'user' => $user,
            'blogs' => $blogs,
        ]);
    }
}
