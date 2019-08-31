<?php

namespace App\Http\Controllers\Backend\Cashier;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Image;

class ProfileController extends Controller
{
    public function index()
    {
        return view('backend.cashier.profile.profile');
    }

    public function update(Request $request)
    {
        $request->validate([
            'firstname'         => 'required|min:2|max:20',
            'lastname'          => 'required|min:2|max:20',
            'number'            => 'numeric|required|digits_between:0,11',
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

            $request->validate([
                'image'             => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $image = request('image');
            $filename = time(). '.' .$image->getClientOriginalExtension();

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
