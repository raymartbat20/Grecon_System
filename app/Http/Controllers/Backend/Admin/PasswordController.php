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
            'password' => 'required|min:5',
            'confirm_password' => 'required|same:password',
        ],
        [
            'password.required'         => 'New Password field is required',
            'password.min'              => 'New Password should be atleast 5 characters',
            'confirm_password.required' => 'Confirm Password field is required',
            'confirm_password.same'     => 'Confirm Password and Password does not match',
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
            'new_password'      => 'required|min:5',
            'confirm_password'  => 'required|same:new_password',
        ],
        [
            'new_password.required'     => 'New Password field is required',
            'new_password.min'          => 'New Password should be atleast 5 characters',
            'confirm_password.required' => 'Confirm Password field is required',
            'confirm_password.same'     => 'Confirm Password and Password does not match',
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
