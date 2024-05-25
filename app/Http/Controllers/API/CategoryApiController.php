<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Viewer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Laravel\Sanctum\PersonalAccessToken;

class CategoryApiController extends Controller
{
    function get_category(){
        $categories = Category::select('category_name', 'icon', 'status')->get();
        return response()->json($categories);
    }

    function get_product(){
        $products = Blog::select('blogger_id', 'blogger', 'thumbnail')->get();
        return response()->json($products);
    }

    function registration(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|unique:viewers',
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
            $wrong = [
                'wrong' => "Password doesn't match!",
            ];
            return response()->json($wrong);
        }

        if($validator->fails()){
            return $validator->errors()->all();
        }

        $viewer = Viewer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'created_at' => Carbon::now(),
        ]);

        $token = $viewer->createToken('authtest')->plainTextToken;

        $response = [
            'success' => 'Registration success',
            'viewer' => $viewer,
            'token' => $token,
        ];

        return response()->json($response);
    }


    function login(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return $validator->errors()->all();
        }

        $viewer = Viewer::where('email', $request->email)->first();

        if(Viewer::where('email', $request->email)->exists()){
            if(Auth::guard('viewer')->attempt(['email'=>$request->email, 'password'=>$request->password])){
                $token = $viewer->createToken('authtest')->plainTextToken;
        
                $response = [
                    'success' => 'Login success',
                    'viewer' => $viewer->email,
                    'token' => $token,
                ];
        
                return response()->json($response);
            }
            else{
                return response(['wrong' => 'Wrong credential.']);
            }
        }
        else{
           return response(['exists' => 'Email does not exists.']) ;
        }
    }

    function logout(Request $request){
        $accessToken = $request->bearerToken();
        $token = PersonalAccessToken::findToken($accessToken);
        $token->delete();
        return response(['logout' => 'Logout success.']) ;
    }

}