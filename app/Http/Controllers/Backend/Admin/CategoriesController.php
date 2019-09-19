<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\CategoryResource;
use App\{Category,User};
use Hash;
use DB;
use Auth;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('backend.admin.categories.categories',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'category' => 'required|min:2|max:25|unique:categories,category,NULL,id,deleted_at,NULL'
        ]);

        $category = new category();

        $upper = strtoupper(request('category'));

        $category->category = $upper;

        $auth_user = Auth::user();
        $admins = User::where('role_id',1)->get();
        $badge = array(
            "bg" => "success",
            "icon" => "mdi mdi-layers mx-0"
        );

        $category->save();

        foreach($admins as $admin)
        {
            $admin->notify(new CategoryResource($auth_user,$category,"created",$badge));
        }

        $notification = array(
            'message' => "category ".$category->category." was successfuly created!",
            'icon'  => 'success',
            'heading'   => 'Success!',
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
    public function update(Request $request)
    {
        $request->validate([
            'category' => 'required|min:2|max:25|unique:categories,category,NULL,id,deleted_at,NULL'
        ]);

        $category = Category::find(request('catid'));
        $auth_user = Auth::user();
        $admins = User::where('role_id',1)->get();
        $badge = array(
            "bg" => "warning",
            "icon" => "mdi mdi-layers mx-0"
        );
        
        $category->category = request('category');

        $category->save();

        foreach($admins as $admin)
        {
            $admin->notify(new CategoryResource($auth_user,$category,"updated",$badge));
        }


        $notification = array(
            'message' => "category ".$category->category." was successfuly updated!",
            'icon'  => 'success',
            'heading'   => 'Success!',
        );

        return back()->with($notification);        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        if(Hash::check(request('password'),Auth::user()->password)){

            $count = DB::table('products')->where('category_id',request('categoryid'))
                                          ->where('deleted_at','=',null)->count();
                if($count == 0){
                $category = Category::find(request('categoryid'));
                $auth_user = Auth::user();
                $admins = User::where('role_id',1)->get();
                $badge = array(
                    "bg" => "danger",
                    "icon" => "mdi mdi-layers mx-0"
                );

                $category->delete();
                
                foreach($admins as $admin)
                {
                    $admin->notify(new CategoryResource($auth_user,$category,"deleted",$badge));
                }

                $notification = array(
                    'message' => "category ".$category->category." was successfuly deleted!",
                    'icon'  => 'warning',
                    'heading'   => 'Success!',
                );
        
                return back()->with($notification); 
            }
            else{
                $notification = array(
                    'message' => "Category is being used by other/s Product!",
                    'icon'  => 'error',
                    'heading'   => 'Failed!',
                );
            }
        }
        else{
            $notification = array(
                'message' => "Password Doesn't match!",
                'icon'  => 'error',
                'heading'   => 'Failed!',
            );

            return back()->with($notification);
        }
    }
}
