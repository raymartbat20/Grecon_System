<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Hash;

class PasswordController extends Controller
{
    public function index()
    {
        return view('backend.admin.password.passwordForm');
    }

    public function update()
    {

        request()->validate([
            'password' => 'min:5|required',
            'confirm_password' => 'required|same:password',
        ]);

        if(Hash::check(request('old_password'), Auth::user()->password)){
            
            Auth::user()->password = Hash::make(request('password'));

            Auth::logout();

            $notification = array(
                'message' => 'Your password was successfully change!',
                'icon'  => 'success',
                'heading'   => 'Success!',
            );
            
            return redirect('/')->with($notification);
        }
        else{
            
            $notification = array(
                'message' => "Your current password doesn't match!",
                'icon'  => 'error',
                'heading'   => 'Failed!',
            );

            return back()->with($notification);
        }
    }

    public function showForgot()
    {
        return view ('backend.admin.password.forgotPassword');
    }

    public function forgot(Request $request)
    {

        $request->validate([
            'username'          => 'required',
            'new_password'      => 'min:5|required',
            'confirm_password'  => 'required|same:new_password',
        ]);

        $user = User::where('username',request('username'))->first();

        if($user)
        {
        $user->password = Hash::make(request('new_password'));

        $notification = array(
            'message'   => "Password was successfully reset",
            'icon'      => "success",
            "heading"   => "Password Reset!",
        );
        return back()->with($notification);
        }

        else
        {
            $notification = array(
                'message'   => "No user matched with this username",
                'icon'      => "error",
                "heading"   => "No User Found!",
            );
            return back()->with($notification);
        }
    }
}
