<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionsController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {

        // Get URLs
        $urlPrevious = url()->previous();
        $urlBase = url()->to('/');

        // Set the previous url that we came from to redirect to after successful login but only if is internal
        if (($urlPrevious != $urlBase . '/login') && (substr($urlPrevious, 0, strlen($urlBase)) === $urlBase)) {
            session()->put('url.intended', $urlPrevious);
        }

        return view('front.login');
    }

    public function store(Request $request)
    {

        $rules = [
            'email' => 'required|email',
            'password' => 'required'
        ];

        //validate user
        $request->validate($rules);

        //login user
        $credentials = $request->only('email', 'password');
        if (!Auth::attempt($credentials)) {
            return back()->withErrors([
                'message' => 'Wrong credentials try again'
            ]);
        }

        //session msg
        session()->flash('msg', 'Logged in successfully');

        //redirect
        return redirect()->intended('/');
    }

    public function logout()
    {

        auth()->logout();

        //session msg
        session()->flash('msg', 'Logged out successfully');

        //redirect
        return redirect('/');
    }
}
