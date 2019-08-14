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
}
