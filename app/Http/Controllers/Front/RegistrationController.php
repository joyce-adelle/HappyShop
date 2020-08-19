<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    public function index(){

        return view('registration.register');
    }

    public function store(Request $request){

        //Validate form
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);


        //save in database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        //session msg
        $request->session()->flash('msg','Thanks for signing up');

        Auth::login($user);

        //redirect
        return redirect('/');
    }

}
