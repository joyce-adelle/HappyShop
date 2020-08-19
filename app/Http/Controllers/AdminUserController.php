<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function index() {
        return view('admin.login');
    }

    public function store(Request $request){

        //validate user
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        //login user
            $credentials = $request->only('email','password');
            if (! Auth::guard('admin')->attempt($credentials)) {
               return back()->withErrors([
                   'message' => 'Wrong credentials try again'
               ]);
           }

        //session msg
        session()->flash('msg', 'Logged in successfully');

        //redirect
        return redirect('/admin');

    }

    public function logout(){

        auth()->guard('admin')->logout();

        //session msg
        session()->flash('msg', 'Logged out successfully');

        //redirect
        return redirect('/admin/login');

    }
}
