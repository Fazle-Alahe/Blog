<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Laravel\Facades\Image;
// use Intervention\Image\Image;
class UserController extends Controller
{
    function user_list(){
        $users = User::paginate(5);
        return view('dashboard.user.user_list',[
            'users' => $users,
        ]);
    }

    function user_add(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => [
                'required',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
            ],
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($request->password != $request->confirm_password){
            return back()->with('wrong', "Password doesn't match!");
        }
        else{
            if($request->hasFile('photo')){
                $photo = $request->photo;
                $extension = $photo->extension();
                $photo_name = Str::lower(str_replace(' ','-', $request->name.random_int(100000, 999999).'.'.$extension));
                Image::read($photo)->resize(931,600)->save(public_path('uploads/users/'.$photo_name));
                // Image::make($photo)->resize(550, 350)->save(public_path('uploads/users/'.$photo_name));
                // Image::make($photo)->save(public_path('uploads/users/'.$photo_name));

                User::insert([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                    'photo' => $photo_name,
                    'created_at' => Carbon::now(),
                ]);
            }
            else{
                User::insert([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                    'created_at' => Carbon::now(),
                ]);
            }
            return back()->with('success', "Blogger added successfully!!");
        }
    }

    function user_edit($id){
        $users = User::find($id);
        return view('dashboard.user.user_edit',[
            'users' => $users,
        ]);
    }

    function edit_user(Request $request,$id){

        $user = User::find($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        if($request->hasFile('photo')){
            $user = User::find($id);
            if($user->photo == null){

            }else{
                $photo_delete = public_path('uploads/users/'.$user->photo);
                unlink($photo_delete);
            }

            $photo = $request->photo;
            $extension = $photo->extension();
            $photo_name = Str::lower(str_replace(' ','-', $request->name.random_int(100000, 999999).'.'.$extension));
            $photo->move(public_path('uploads/users/'),$photo_name);
            // Image::make($photo)->save(public_path('uploads/users/'.$photo_name));
            // Image::read($photo)->resize(500,500)->save(public_path('uploads/users/'.$file_name));
            User::find($id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'photo' => $photo_name,
                'updated_at' => Carbon::now(),
            ]);
        }
        else{
            User::find($id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'updated_at' => Carbon::now(),
            ]);
        }
        return back()->with('success', "Blogger updated successfully!!");
    }

    function update_user_pass(Request $request,$id){
        $user = User::find($id);
        $request->validate([
            'new_password' => [
                'required',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
            ],
        ]);

        if(Hash::check($request->current_password, $user->password)){
            $user->update([
                'password' => bcrypt($request->new_password),
                'updated_at' => Carbon::now(),
            ]);
            return back()->with('pass_success', "Password updated successfully!!");
        }
        else{
            return back()->with('wrong_pass', "Current password is not correct!!");
        }
    }

    function user_profile(){
        return view('dashboard.user.my_profile');
    }

    function profile_update(Request $request){
        $user = Auth::user();
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        if($request->hasFile('photo')){
            // if($user->photo == null){

            // }else{
            //     $photo_delete = public_path('uploads/users/'.$user->photo);
            //     unlink($photo_delete);
            // }


            $photo = $request->photo;
            $extension = $photo->extension();
            $photo_name = Str::lower(str_replace(' ','-', $request->name.random_int(100000, 999999).'.'.$extension));
            // Image::read($photo)->resize(500,500)->save(public_path("uploads/users/"),$photo_name);
            Image::read($photo)->resize(931,600)->save(public_path('uploads/users/'.$photo_name));

            // Image::make($photo)->save(public_path('uploads/users/'.$photo_name));
            // Image::make($photo)->save(public_path('uploads/users/'.$photo_name));

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'photo' => $photo_name,
                'updated_at' => Carbon::now(),
            ]);
        }
        else{
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'updated_at' => Carbon::now(),
            ]);
        }
        return back()->with('success', "Profile updated successfully!!");
    }

    function profile_pass_update(Request $request){
        $user = Auth::user();
        $request->validate([
            'new_password' => [
                'required',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
            ],
        ]);

        if(Hash::check($request->current_password, $user->password)){
            $user->update([
                'password' => bcrypt($request->new_password),
                'updated_at' => Carbon::now(),
            ]);
            return back()->with('pass_success', "Password updated successfully!!");
        }
        else{
            return back()->with('wrong_pass', "Current password is not correct!!");
        }
    }

    function blogger_about(Request $request){
        // $request->validate([
        //    'title' => 'required', 
        //    'desp' => 'required', 
        // ]);
        Auth::user()->update([
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'instagram' => $request->instagram,
            'medium' => $request->medium,
            'pinterest' => $request->pinterest,
            'Youtube' => $request->Youtube,
            'title' => $request->title,
            'desp' => $request->desp,
            'updated_at' => Carbon::now(),
        ]);
        return back()->with('about_update', "Your details have updated!");
    }

    function user_soft_delete($id){
        $user_id = User::find($id);

        $user_id->update([
            'status' => 1,
        ]);
        $user_id->delete();

        $blogs = Blog::where('blogger_id', $id)->get();

        foreach($blogs as $blog){
            $blog->update([
                'status' => 1,
            ]);
        }

        return back()->with('soft_delete', "Blogger moved to trash!");
    }

    function trash_user(){
        $trash_user = User::onlyTrashed()->paginate(5);
        return view('dashboard.user.trash_delete',[
            'trash_user' => $trash_user,
        ]);
    }

    function restore_user($id){
        User::onlyTrashed()->find($id)->restore();
        return back()->with('user_restore', 'Blogger restored!');
    }

    function user_permanent_delete($id){
        $user_id = User::onlyTrashed()->find($id);
        
        if($user_id->photo == null){

        }else{
            $photo_delete = public_path('uploads/users/'.$user_id->photo);
            unlink($photo_delete);
        }

        
        $blogs = Blog::where('blogger_id', $id)->get();

        foreach($blogs as $blog){
            $blog->forceDelete();
        }
        $user_id->forceDelete();
        return back()->with('pDelete', 'Blogger deleted permanently');
    }

    
    function user_status($id){
        $user_id = User::find($id);
        if($user_id->status == 0){
            $user_id->update([
                'status' => 1 ,
            ]);
        }
        else{
            $user_id->update([
                'status' => 0 ,
            ]);
        }
        return back();
    }

    function user_select_soft_delete(Request $request){
        if($request->user_id == ''){
            return back();
        }
        else{
            foreach($request->user_id as $user){
                $blogs = Blog::where('blogger_id', $user)->get();
        
                foreach($blogs as $blog){
                    $blog->update([
                        'status' => 1,
                    ]);
                }
                $user_id = User::find($user);
                $user_id->update([
                    'status' => 1,
                ]);
                $user_id->delete();
            }
            return back()->with('soft_delete', "Blogger moved to trash!");
        }
    }

    function user_select_restore(Request $request){
        if($request->btn == 1){
            if($request->user_id == ''){
                return back();
            }
            else{
                foreach($request->user_id as $user){
                    User::onlyTrashed()->find($user)->restore();
                }
                return back()->with('user_restore', 'Blogger restored!');
            }
        }
        elseif($request->btn == 2){
            if($request->user_id == ''){
                return back();
            }
            else{
                foreach($request->user_id as $user){
                    // blog delete which is created by these user
                    $blogs = Blog::where('blogger_id', $user)->get();
            
                    foreach($blogs as $blog){
                        $blog->forceDelete();
                    }
                    $user_id = User::onlyTrashed()->find($user);
                    
                if($user_id->photo == null){
    
                }else{
                    $photo_delete = public_path('uploads/users/'.$user_id->photo);
                    unlink($photo_delete);
                }
            
                    $user_id->forceDelete();
                }
                return back()->with('pDelete', 'Blogger deleted permanently');
            }
        }
    }
}
