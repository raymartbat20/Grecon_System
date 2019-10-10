<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\CreateUser;
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
            'number'            => 'required|numeric|digits_between:0,11',
            'password'          => 'required|min:5',
            'confirm_password'  => 'required|same:password',
            'role'              => 'required',
            'image'             => 'image|mimes:jpeg,png,jpg,gif,svg|max:10000',
        ],[
            'role.required'                 => 'Role field is required',
            'number.required'               => 'Contact Number is required',
            'number.numeric'                => 'Contact Number should be numbers only.',
            'number.digits_between'         => 'Contact Number should only contain 11 digits or lower',
            'confirm_password.required'     => 'Confirm Password is required',
            'confirm_password.same'         => 'Confirm Password and Password does not match',
            'firstname.required'            => 'First Name field is required',
            'firstname.min'                 => 'First Name should be atleast 2 characters',
            'lastname.min'                  => 'Last Name should be atleast 2 characters',
            'lastname.max'                  => 'Last Name maximum characters is 20',
            'firstname.max'                 => 'First Name maximum characters is 20',
            'lastname.required'             => 'Last Name field is required',
        ]);

        $auth_user = Auth::user();
        $users = User::where('role_id',1)->get();
        $user = new user();
        $badge = array(
            "bg"    => "success",
            "icon"  => "mdi mdi-account-box mx-0",   
        );

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

        foreach($users as $admin_user)
        {
            $admin_user->notify(new CreateUser($auth_user, $user,"Created",$badge));
        }

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
        ],
        [
            'number.required'               => 'Contact Number is required',
            'number.numeric'                => 'Contact Number should be numbers only.',
            'number.digits_between'         => 'Contact Number should only contain 11 digits or lower',
            'firstname.required'            => 'First Name field is required',
            'firstname.min'                 => 'First Name should be atleast 2 characters',
            'lastname.min'                  => 'Last Name should be atleast 2 characters',
            'lastname.max'                  => 'Last Name maximum characters is 20',
            'firstname.max'                 => 'First Name maximum characters is 20',
            'lastname.required'             => 'Last Name field is required',
            'role_id.required'              => 'Role field is required',
        ]);
        $user = User::find(request('userid'));
        $auth_user = Auth::user();
        $admins = User::where('role_id',1)->get();
        $badge = array(
            "bg"    => "warning",
            "icon"  => "mdi mdi-account-box mx-0",
        );

        $user->number      = request('number');
        $user->role_id     = request('role_id');

        $user->save();

        foreach($admins as $admin)
        {
            $admin->notify(new CreateUser($auth_user,$user,"Updated",$badge));
        }

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
            $auth_user = Auth::user();
            $admins = User::where('role_id',1)->get();
            $badge = array(
                "bg"    => "danger",
                "icon"  => "mdi mdi-account-box mx-0",
            );
            
            $user->delete();

            foreach($admins as $admin)
            {
                $admin->notify(new Createuser($auth_user,$user,"Deleted",$badge));
            }

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

}
