<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    function subscribe(Request $request){
        $request->validate([
            'email' => 'required|unique:subscribers',
        ]);
        // if()
        Subscriber::insert([
            'email' => $request->email,
            'created_at' => Carbon::now(),
        ]);
        return back()->with('subscribe', 'Thanks for your subscription.');
    }

    function subscriber_list(){
        $subscribers = Subscriber::all();
        return view('dashboard.subscribers.subscribers',[
            'subscribers' => $subscribers,
        ]);
    }

    function subscriber_delete($id){
        Subscriber::find($id)->delete();
        return back()->with('Delete', 'Subscriber deleted!');
    }

    function selected_subscriber_delete(Request $request){
        foreach($request->subscriber as $subscriber){
            Subscriber::find($subscriber)->delete();
        }
        return back()->with('Delete', 'Subscriber deleted!');
    }
}
