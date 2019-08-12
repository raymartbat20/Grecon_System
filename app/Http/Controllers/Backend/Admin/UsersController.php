<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Hash;
use Image;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles  = [
            'ADMIN',
            'CASHIER',
            'INVENTORY',
            'MANAGER',
        ];
        return view('backend.admin.users.createUser',compact('roles'));        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'firstname'         => 'required|min:2|max:20',
            'lastname'          => 'required|min:2|max:20',
            'email'             => 'required|email|unique:users,email,NULL,user_id,deleted_at,NULL',
            'number'            => 'numeric|required|digits_between:0,11',
            'password'          => 'required|min:5',
            'confirm_password'  => 'required|same:password',
            'role'              => 'required',
            'image'             => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = new user();

        $user->firstname = request('firstname');
        $user->lastname = request('lastname');
        $user->email = request('email');
        $user->number = request('number');
        $user->password = Hash::make(request('password'));
        $user->role = request('role');

        if($request->hasFile('image')){
            $image = request('image');
            $filename = time(). "." .$image->getClientOriginalExtension();
            Image::make($image)->resize(300,300)->save(public_path('__backend/assets/images/avatars/'.$filename));

            $user->image = $filename;
        }

        $user->save();
        $name = $user->getFullName();

        $notification = array(
            'message' => "Employee ".$name." was successfully registered!",
            'icon' => 'success',
            'heading' => 'Success!',
        );

        return back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
