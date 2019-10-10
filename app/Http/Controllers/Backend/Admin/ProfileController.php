<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Image;

class ProfileController extends Controller
{
    public function index()
    {
        return view('backend.admin.profile.profile');
    }

    public function update(Request $request)
    {
        $request->validate([
            'firstname'         => 'required|min:2|max:20',
            'lastname'          => 'required|min:2|max:20',
            'number'            => 'required|numeric|digits_between:0,11',
            'image'             => 'image|mimes:jpeg,png,jpg,gif,svg|max:20000',
        ],
        [
            'number.required'       => 'Contact Number field is required.',
            'number.numeric'        => 'Contact Number should be numbers only.',
            'firstname.required'    => 'First Name field is required',
            'firstname.min'         => 'First Name should be atleast 2 characters',
            'lastname.min'          => 'Last Name should be atleast 2 characters',
            'lastname.max'          => 'Last Name maximum characters is 20',
            'firstname.max'         => 'First Name maximum characters is 20',
            'lastname.required'     => 'Last Name field is required',
            'image.image'           => 'Please Input an image file',
            'image.mimes'           => 'Profile Picture format is not supported',
            'image.max'             => 'Profile Picture max file size is 20MB',
        ]);

        $user = User::find(Auth::user()->user_id);

        $user->firstname = request('firstname');
        $user->lastname = request('lastname');
        $user->number = request('number');

        if($request->hasFile('image')){
            $image = request('image');
            $filename = time(). "." .$image->getClientOriginalExtension();
            Image::make($image)->resize(300,300)->save(public_path('/__backend/assets/images/avatars/'.$filename));

            $user->image = $filename;
        }

        $user->save();

        $notification = array(
            'message' => 'Your profile is updated!',
            'icon'  => 'success',
            'heading'   => 'success',
        );

        return back()->with($notification);
    }
}
