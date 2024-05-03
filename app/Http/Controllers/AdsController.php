<?php

namespace App\Http\Controllers;

use App\Models\Advertise;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdsController extends Controller
{
    function advertise(){
        $advertise = Advertise::find(1);
        return view('dashboard.advertise.advertise',[
            'advertise' => $advertise,
        ]);
    }

    function update_ads(Request $request){
        if(!$request->hasFile('content_ads') && !$request->hasFile('side_ads')){
            return back();
        }

        $ads = Advertise::find(1);

        if(!$request->hasFile('content_ads')){
            
            $photo_delete = public_path('uploads/ads/'.$ads->side_ads);
            unlink($photo_delete);

            $s_ads = $request->side_ads;
            $extension = $s_ads->extension();
            $side_ads = Str::lower(str_replace(' ','-', 'side_ads'.random_int(100000, 999999).'.'.$extension));
            $s_ads->move(public_path('uploads/ads/'),$side_ads);


            $ads->update([
                'side_ads' => $side_ads,
                'updated_at' => Carbon::now(),
            ]);
            return back()->with('success', 'Advertise update successsfully!');
        }

        if(!$request->hasFile('side_ads')){

            $photo_delete = public_path('uploads/ads/'.$ads->content_ads);
            unlink($photo_delete);

            $c_ads = $request->content_ads;
            $extension = $c_ads->extension();
            $content_ads = Str::lower(str_replace(' ','-', 'content_ads'.random_int(100000, 999999).'.'.$extension));
            $c_ads->move(public_path('uploads/ads/'),$content_ads);

            $ads->update([
                'content_ads' => $content_ads,
                'updated_at' => Carbon::now(),
            ]);
            return back()->with('success', 'Advertise update successsfully!');
        }

        if($request->hasFile('content_ads') && $request->hasFile('side_ads')){
            
            
            $photo_delete = public_path('uploads/ads/'.$ads->content_ads);
            unlink($photo_delete);
            
            $photo_delete = public_path('uploads/ads/'.$ads->side_ads);
            unlink($photo_delete);

            $c_ads = $request->content_ads;
            $extension = $c_ads->extension();
            $content_ads = Str::lower(str_replace(' ','-', 'content_ads'.random_int(100000, 999999).'.'.$extension));
            $c_ads->move(public_path('uploads/ads/'),$content_ads);

            $s_ads = $request->side_ads;
            $extension = $s_ads->extension();
            $side_ads = Str::lower(str_replace(' ','-', 'side_ads'.random_int(100000, 999999).'.'.$extension));
            $s_ads->move(public_path('uploads/ads/'),$side_ads);

            $ads->update([
                'content_ads' => $content_ads,
                'side_ads' => $side_ads,
                'updated_at' => Carbon::now(),
            ]);
            return back()->with('success', 'Advertise update successsfully!');
        }
    }
}
