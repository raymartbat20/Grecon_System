<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Session;

class SessionController extends Controller
{
    public function showSignIn()
    {
        return view('root.signIn');
    }

    public function signIn(Request $request)
    {
        $request->validate([
            'username'     => 'required',
            'password'  => 'required',
        ]);

        $user_data = array(
            'username'     => $request->get('username'),
            'password'  => $request->get('password'),
        );

        if(Auth::attempt($user_data)){
            return redirect('/');
        }
        else{
            return back()->with('error','Wrong Login Details!');
        }
    }

    public function logout()
    {
        if(Session::has('cart'))
        {
            Session::forget('cart');
        }
        if(Session::has('materials'))
        {
            Session::forget('materials');
        }
        Auth::logout();

        return redirect('/');
    }
}
