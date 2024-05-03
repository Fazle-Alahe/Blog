<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Viewer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;

class ViewerController extends Controller
{
    function registration(){
        return view('Frontend.viewers.registration');
    }

    function viewer_store(Request $request){
        $request->validate([
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
                $photo->move(public_path('uploads/viewer/'),$photo_name);
                // Image::make($photo)->save(public_path('uploads/users/'.$photo_name));
                // Image::make($photo)->save(public_path('uploads/users/'.$photo_name));

                Viewer::insert([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                    'photo' => $photo_name,
                    'created_at' => Carbon::now(),
                ]);
            }
            else{
                Viewer::insert([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                    'created_at' => Carbon::now(),
                ]);
            }
            return back()->with('success', "You are registered successfully!!");
        }
    }

    function login_viewer(){
        return view('Frontend.viewers.login');
    }

    function loggged_viewer(Request $request){
        if(Viewer::where('email', $request->email)->exists()){
            if(Auth::guard('viewer')->attempt(['email'=>$request->email, 'password'=>$request->password])){
                return redirect()->route('index')->with('logged', "You're logged in!!");
            }
            else{
                return back()->with('wrong', 'Wrong credential.');
            }
        }
        else{
            // if(User::where('email', $request->email)->exists()){
            //     if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password])){
            //         return redirect()->route('index')->with('logged', "You're logged in!!");
            //     }
            //     else{
            //         return back()->with('wrong', 'Wrong credential.');
            //     }
            // }
            return back()->with('exists', 'Email does not exists.');
        }
    }

    function viewer_profile($id){
        $viewer = Viewer::find($id);
        return view('Frontend.viewers.viewer_profile',[
            'viewer' => $viewer,
        ]);
    }

    function viewer_update(Request $request,$id){
        $request->validate([
            'name' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $viewer = Viewer::find($id);

        if(!$request->password && !$request->photo){
            $viewer->update([
                'name'=>$request->name,
                'updated_at'=>Carbon::now(),
            ]);
        }
        else{
            if(!$request->password){

                if($viewer->photo == null){

                }else{
                    $photo_delete = public_path('uploads/viewer/'.$viewer->photo);
                    unlink($photo_delete);
                }

                $photo = $request->photo;
                $extension = $photo->extension();
                $photo_name = Str::lower(str_replace(' ','-', $request->name.random_int(100000, 999999).'.'.$extension));
                $photo->move(public_path('uploads/viewer/'),$photo_name);

                $viewer->update([
                    'name'=>$request->name,
                    'photo'=>$photo_name,
                    'updated_at'=>Carbon::now(),
                ]);
                return back()->with('success', "Profile updated successfully!!");
            }
            if(!$request->photo){
                $request->validate([
                    'new_password' => [
                        'required',
                        Password::min(8)
                            ->mixedCase()
                            ->numbers()
                            ->symbols()
                    ],
                ]);
        
                if(Hash::check($request->password, $viewer->password)){
                    $viewer->update([
                        'name'=>$request->name,
                        'password' => bcrypt($request->new_password),
                        'updated_at' => Carbon::now(),
                    ]);
                    return back()->with('success', "Profile updated successfully!!");
                }
                else{
                    return back()->with('wrong_pass', "Current password is not correct!!");
                }
            }
            else{
                $request->validate([
                    'new_password' => [
                        'required',
                        Password::min(8)
                            ->mixedCase()
                            ->numbers()
                            ->symbols()
                    ],
                ]);
                
                if($viewer->photo == null){

                }else{
                    $photo_delete = public_path('uploads/viewer/'.$viewer->photo);
                    unlink($photo_delete);
                }

                $photo = $request->photo;
                $extension = $photo->extension();
                $photo_name = Str::lower(str_replace(' ','-', $request->name.random_int(100000, 999999).'.'.$extension));
                $photo->move(public_path('uploads/viewer/'),$photo_name);

                
                if(Hash::check($request->password, $viewer->password)){
                    $viewer->update([
                        'name'=>$request->name,
                        'password' => bcrypt($request->new_password),
                        'photo'=>$photo_name,
                        'updated_at' => Carbon::now(),
                    ]);
                }
                else{
                    return back()->with('wrong_pass', "Current password is not correct!!");
                }
            }
        }
        return back()->with('success', "Profile updated successfully!!");
    }


    
    function viewer_logout(){
        Auth::guard('viewer')->logout();
        return redirect()->route('index');

    }
}
