<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    function index(){
        
        $blogs = Blog::where('status', 0)->orderBy('view', 'DESC')->take(4)->get();
        
        $trending_left = Blog::where('status', 0)->whereDate('created_at', '>=', Carbon::now()->subDays(30))->orderBy('view', 'DESC')->take(1)->get();
        $trending_l = Blog::where('status', 0)->whereDate('created_at', '>=', Carbon::now()->subDays(30))->orderBy('view', 'DESC')->skip(2)->take(2)->get();
        $trending_right = Blog::where('status', 0)->whereDate('created_at', '>=', Carbon::now()->subDays(30))->orderBy('view', 'DESC')->skip(1)->take(1)->get();
        $trending_r = Blog::where('status', 0)->whereDate('created_at', '>=', Carbon::now()->subDays(30))->orderBy('view', 'DESC')->skip(4)->take(2)->get();

        $editors = Blog::where('status', 0)->latest('updated_at')->take(1)->get();
        $editors_right = Blog::where('status', 0)->latest('updated_at')->skip(1)->take(4)->get();

        $category = Category::where('status', 0)->orderBy('view', 'DESC')->take(1)->first()->id;
        $cat_view = Blog::where('status', 0)->where('category_id', $category)->latest()->take(1)->get();
        return view('frontend.index',[
            'blogs' => $blogs,
            'trending_left' => $trending_left,
            'trending_l' => $trending_l,
            'trending_right' => $trending_right,
            'trending_r' => $trending_r,
            'editors' => $editors,
            'editors_right' => $editors_right,
            'cat_view' => $cat_view,
        ]);
    }

    function contact(){
        return view('Frontend.contact');
    }

    function about_site(){
        return view('Frontend.about');
    }

    function message(Request $request){
        Message::insert([
            'name' =>$request->name,
            'email' =>$request->email,
            'title' =>$request->title,
            'description' =>$request->description,
            'created_at' =>Carbon::now(),
        ]);

        return back()->with('success', "Yor've sent a message!");
    }

    function show_message(){
        $messages = Message::all();
        return view('dashboard.message.messages',[
            'messages' => $messages,
        ]);
    }

    function message_delete($id){
        Message::find($id)->delete();
        return back()->with('delete', 'Message deleted!');
    }

    function select_msg_delete(Request $request){
        if($request->message_id == ''){
            return back();
        }
        else{
            foreach($request->message_id as $message){
                Message::find($message)->delete();
            }
            return back()->with('delete', 'Message deleted!');
        }
    }
    
    function view_message($id){
        $messages = Message::find($id);
        $messages->update([
            'status' => 0,
        ]);
        return view('dashboard.message.view',[
            'messages' => $messages,
        ]);
    }
}