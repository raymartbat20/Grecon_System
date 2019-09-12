<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\{User,Role};
use Auth;
use DB;
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
        $roles = Role::all();
        $users = User::paginate(5);
        return view('backend.admin.users.users',compact('users','roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $roles = Role::all();
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
            'username'          => 'required|unique:users,username,NULL,user_id,deleted_at,NULL',
            'number'            => 'numeric|required|digits_between:0,11',
            'password'          => 'required|min:5',
            'confirm_password'  => 'required|same:password',
            'role'              => 'required',
            'image'             => 'image|mimes:jpeg,png,jpg,gif,svg',
        ],[
            'role.required' => 'Role field is required',
        ]);

        $user = new user();

        $user->firstname = request('firstname');
        $user->lastname = request('lastname');
        $user->username = request('username');
        $user->number = request('number');
        $user->password = Hash::make(request('password'));
        $user->role_id = request('role');

        if($request->hasFile('image')){
            $image = request('image');
            $filename = time(). "." .$image->getClientOriginalExtension();
            Image::make($image)->resize(300,300)->save(public_path('/__backend/assets/images/avatars/'.$filename));
            $user->image = $filename;
        }
        $user->save();
        $name = $user->getFullName();
        $notification = array(
            'message' => "Employee ".$name." was successfully registered!",
            'icon' => 'success',
            'heading' => 'Success!',
        );

        return redirect(route('backend.admin.users.index'))->with($notification);
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
     *  the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'firstname'         => 'required|min:2|max:20',
            'lastname'          => 'required|min:2|max:20',
            'number'            => 'numeric|required|digits_between:0,11',
            'role_id'           => 'required',
        ]);
        $user = User::find(request('userid'));

        $user->number      = request('number');
        $user->role_id     = request('role_id');

        $user->save();

        $name = $user->getFullName();

        $notification = array(
            'message' => "Employee ".$name." was successfully updated!",
            'icon' => 'success',
            'heading' => 'Updated!',
        );

        return redirect(route('backend.admin.users.index'))->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if(Hash::check(request('password'),Auth::user()->password)){
            $user = User::find(request('myid'));

            $user->delete();

            $name = $user->getFullName();
            $notification = array(
                'message' => "Employee ".$name." was successfully deleted!",
                'icon' => 'success',
                'heading' => 'Deleted!',
            );
            
            return back()->with($notification);
        }
        else{

            $notification = array(
                'message' => "Password Doesn't match",
                'icon' => 'error',
                'heading' => 'Failed!',
            );
            return back()->with($notification);
        }
    }

    public function try()
    {
        $count = DB::table('users')->where('role_id', 2)
                                   ->where('deleted_at', '=', null)->count();
        if($count == 0){
            Role::find(2)->delete();
            $notification = array(
                'message' => "Password Doesn't match",
                'icon' => 'success',
                'heading' => 'Failed!',
            );
            return redirect(route('backend.admin.users.index'))->with($notification);
        }
        $notification = array(
            'message' => "Password Doesn't match",
            'icon' => 'error',
            'heading' => 'Failed!',
        );
        return redirect(route('backend.admin.users.index'))->with($notification);
    }
}
