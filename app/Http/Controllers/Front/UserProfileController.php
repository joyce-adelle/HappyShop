<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Order;
use App\User;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function index(Request $request){

        $user = User::where('id', auth()->user()->id)->first();
        return view('front.profile.index', compact('user'));
    }

    public function edit(Request $request){

        $user = User::find(auth()->user()->id);
        return view('front.profile.edit', compact('user'));
    }

    public function update(Request $request, $id){

        //Find user
        $user = User::find($id);

        //Validate Form
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        //Update user
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        //send message
        $request->session()->flash('msg','Your profile has been updated');

        //redirect
        return redirect('/user/profile');
    }

    public function show($id){

        $order = Order::find($id);

        return view('front.profile.orderDetails', compact('order'));
    }

}
