<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class SessionController extends Controller
{
    public function showSignIn()
    {
        return view('root.signIn');
    }

    public function signIn(Request $request)
    {
        $request->validate([
            'email'     => 'required|email',
            'password'  => 'required',
        ]);

        $user_data = array(
            'email'     => $request->get('email'),
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
        Auth::logout();

        return redirect('/');
    }
}
