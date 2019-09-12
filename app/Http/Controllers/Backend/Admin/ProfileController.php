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
            'number'            => 'numeric|required|digits_between:0,11',
            'image'  => 'image|mimes:jpeg,png,jpg,gif,svg|max:10000',
        ],
        [
            'number.required' => 'Contact Number field is required.',
            'number.numeric'    => 'Contact Number should be numbers only.'
        ]);

        $user = User::find(Auth::user()->user_id);

        $user->firstname = request('firstname');
        $user->lastname = request('lastname');
        $user->number = request('number');

        if($request->hasFile('image')){

            $image = request('image');
            $filename = time(). '.' .$image->getClientOriginalExtension();
            dd($filename);
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
