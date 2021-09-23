<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\WelcomeMail;
use App\Models\Welcome;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;


class SubscribeController extends Controller
{

            public function index()
            {
                $subscribes = Welcome::all();
                return view('admin.welcomes.list', compact('subscribes'));
            }

            public function store(Request $request)
            {

            //  dd($request);

                $this->validate($request,[
                    'email' => 'required|email',
                ]);

                $subscribes =  Welcome::create([
                    'email' => $request['email'],
                ]);

            //   dd($subscribes);

                $subscribes->save();

               Mail::to($request->email)->send(new WelcomeMail());
               return redirect()->route('index')->with('success', 'Subscribed successfully.');
            }

            // public function sendmail(){

            //     Mail::to('tekbhatt1@gmail.com')->send(new WelcomeMail());
            //     return redirect()->route('index')->with('success', 'Subscribed successfully.');
            // }

            public function destroy($id)
            {
                $subscribes = Welcome::findorfail($id);
                $subscribes->delete();
                return redirect()->route('subscribe.index')->with('success', 'Subscriber deleted successfully.');

            }



}
