<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Blog;
use App\Models\Comment;
use App\Models\Logo;
use App\Models\Reply;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    
    function login(){
        
        return view('dashboard.user.login');
    }

    function login_post(Request $request){
        $request->validate([
            'email' => 'required|exists:users',
            'password' => 'required',
        ]);

        // $block = User::where('email', $request->email)->where('deleted_at')->exists();
        // User::where()
        // if(User::)
        
     $user_data = array(
        'email'  => $request->email,
        'password' => $request->password,
       );
    
    //    if(User::where('email', $request->email)->where('deleted_at', !null)->exists()){
    //     return back()->with('blocked', "You're blocked!!, please contact with ADMIN");
    //    }
    //     else{
            if(Auth::attempt($user_data)){
                return redirect()->route('dashboard')->with('logged', "You're logged in!!");
            }
            else{
                return back()->with('error', 'Wrong Login Details');
        }
    //    }

    }

    function logout(){
        Auth::logout();
        return redirect('login');

    }

    function dashboard(){
        $trending = Blog::where('status', 0)->whereDate('created_at', '>=', 
                    Carbon::now()->subDays(7))->orderBy('view', 'DESC')->take(7)->get();
        
        $popular = Blog::where('status', 0)->orderBy('view', 'DESC')->take(15)->get();
        $views = Blog::where('status', 0)->where('blogger_id', Auth::user()->id)->sum('view');
        $blogs = Blog::where('blogger_id', Auth::user()->id)->where('status', 0)->latest()->paginate(5);
        $p_blogs = Blog::where('blogger_id', Auth::user()->id)->where('status', 1)->latest()->paginate(5);

        // $blog = Blog::where('status', 1)->latest()->get();
        // die;
        return view('dashboard.dashboard',[
            'trending' => $trending,
            'popular' => $popular,
            'views' => $views,
            'blogs' => $blogs,
            'p_blogs' => $p_blogs,
        ]);
    }


    // Logo

    function logo(){
        $logo = Logo::find(1);
        return view('dashboard.logo.logo',[
            'logo' => $logo,
        ]);
    }

    function update_logo(Request $request){
        $request->validate([
            'logo' => 'required',
        ]);

        $logo = Logo::find(1);
        
        $logo_delete = public_path('uploads/logo/'.$logo->logo);
        unlink($logo_delete);
        
        $logo = $request->logo;
        $extension = $logo->extension();
        $logo_name = Str::lower(str_replace(' ','-', 'logo'.random_int(100000, 999999).'.'.$extension));
        $logo->move(public_path('uploads/logo/'),$logo_name);

        Logo::find(1)->update([
            'logo' => $logo_name,
            'updated_at' => Carbon::now(),
        ]);
        return back()->with('success', "Logo updated successfully!!");
    }

    function icon_update(Request $request){$request->validate([
        'icon' => 'required',
    ]);

    $icon = Logo::find(1);
    
    $icon_delete = public_path('uploads/icon/'.$icon->icon);
    unlink($icon_delete);
    
    $icon = $request->icon;
    $extension = $icon->extension();
    $icon_name = Str::lower(str_replace(' ','-', 'icon'.random_int(100000, 999999).'.'.$extension));
    $icon->move(public_path('uploads/logo/'),$icon_name);

    Logo::find(1)->update([
        'icon' => $icon_name,
        'updated_at' => Carbon::now(),
    ]);
    return back()->with('success', "Icon updated successfully!!");
    }

    // About
    function about(){
        $about = About::find(1);
        return view('dashboard.about.about',[
            'about' => $about,
        ]);
    }

    function update_about(Request $request){
        $request->validate([
            'email' => 'required',
            'location' => 'required',
            'title' => 'required',
            'desp' => 'required',
        ]);

        About::find(1)->update([
            'phone' => $request->phone,
            'email' => $request->email,
            'location' => $request->location,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'instagram' => $request->instagram,
            'medium' => $request->medium,
            'pinterest' => $request->pinterest,
            'youtube' => $request->youtube,
            'title' => $request->title,
            'desp' => $request->desp,
            'updated_at' => Carbon::now(),
        ]);
        return back()->with('success', 'About information updated successfully');
    }

}
