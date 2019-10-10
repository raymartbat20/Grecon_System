<?php

namespace App\Http\Controllers\Backend\Inventory;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\SupplierResource;
use App\{Supplier,User};
use Auth;
use Hash;
use Image;
use DB;

class SuppliersController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::all();
        return view('backend.inventory.suppliers.suppliers',compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.inventory.suppliers.createSupplier');
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
            'firstname'     => 'required|min:2|max:20',
            'lastname'      => 'nullable|min:2|max:20',
            'company'       => 'required|min:2|max:50',
            'email'         => 'nullable|email',
            'number'        => 'nullable|numeric|digits_between:0,11',
        ]);

        $supplier = new supplier();

        if(request('email') == null && request('number') == null)
        {
            $notification = array(
                'message' => "one of the email or number should have a value!",
                'icon' => 'error',
                'heading' => 'No Contacts!'
            );
            return back()->with($notification);
        }


        $supplier->firstname = request('firstname');
        $supplier->lastname = request('lastname');
        $supplier->company = request('company');
        $supplier->email = request('email');
        $supplier->number = request('number');


        
        if($request->hasFile('image')){
            $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $image = request('image');
            $filename = time(). '.' .$image->getClientOriginalExtension();

            $supplier->image = $filename;
        Image::make($image)->resize(300,300)->save(public_path('/__backend/assets/images/suppliers/'.$filename));
        }

        $supplier->save();

        $name = $supplier->getFullName();
        $notification = array(
            'message' => 'Supplier '.$name.' is successfuly added to suppliers list!',
            'icon' => 'success',
            'heading' => 'Success',
        );

        return redirect(route('backend.inventory.suppliers.index'))->with($notification);
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
            'firstname'     => 'required|min:2|max:20',
            'lastname'      => 'nullable|min:2|max:20',
            'company'       => 'required|min:2|max:50',
            'email'         => 'nullable|email',
            'number'        => 'nullable|numeric|digits_between:0,11',

        ]);

        $supplier = Supplier::find(request('supplier_id'));

        if(request('email') == null && request('number') == null){
            $notification = array(
                'message' => "one of the email or number should have a value!",
                'icon' => 'error',
                'heading' => 'No Contacts!'
            );
            return back()->with($notification);
        }

        if($request->hasFile('image')){
            $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $image = request('image');
            $filename = time(). '.' .$image->getClientOriginalExtension();
            Image::make($image)->resize(300,300)->save(public_path('/__backend/assets/images/suppliers/'.$filename));

            $supplier->image = $filename;

        }

        $supplier->firstname = request('firstname');
        $supplier->lastname = request('lastname');
        $supplier->company = request('company');
        $supplier->email = request('email');
        $supplier->number = request('number');

        $supplier->save();

        $name = $supplier->getFullName();
        $notification = array(
            'message' => 'Supplier '.$name.' was successfuly updated!',
            'icon' => 'success',
            'heading' => 'Success',
        );

        return back()->with($notification);
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
            $supplier = Supplier::find(request('supplier_id'));
            $count = DB::table('products')
                        ->where('supplier_id',$supplier->supplier_id)
                        ->where('deleted_at','=',null)
                        ->count();

            if($count == 0)
            {
                $auth_user  = Auth::user();
                $admins = User::where('role_id',1)->get();
                $badge = array(
                    'bg' => "danger",
                    'icon' => "fa fa-address-card mx-0",
                );
                $supplier->delete();
                
                foreach($admins as $admin)
                {
                    $admin->notify(new SupplierResource($auth_user,$supplier,"archived",$badge));
                }

                $name = $supplier->getFullName();
                $notification = array (
                    'message' => "Supplier ".$name." was successfuly deleted!",
                    'icon' => 'success',
                    'heading' => 'Success',
                );
                return back()->with($notification);
            }
            else
            {
                $notification = array(
                    'message' => "Supplier is being used by other/s Product!",
                    'icon'  => 'error',
                    'heading'   => 'Failed!',
                );
                
                return back()->with($notification);
            }
        }
        else{
            $notification = array (
                'message' => "Password Doesn't match!",
                'icon' => 'error',
                'heading' => 'Error!',
            );
            return back()->with($notification);
        }
    }

    public function restore(Request $request)
    {
        $supplier = Supplier::onlyTrashed()
                            ->where('supplier_id',request('supplier_id'))
                            ->firstOrFail();
        $auth_user = Auth::user();
        $admins = User::where('role_id',1)->get();
        $badge = array(
            'bg' => "info",
            'icon' => "fa fa-address-card mx-0",
        );

        $supplier->restore();

        foreach($admins as $admin)
        {
            $admin->notify(new SupplierResource($auth_user,$supplier,"restored",$badge));
        }
       
        $notification = array(
            'message' => 'Supplier successfully Restored!',
            'icon'    => 'success',
            'heading' => 'SUccess!',
        );

        return back()->with($notification);
    }

    public function archive()
    {
        $suppliers = Supplier::onlyTrashed()->get();

        return view('backend.admin.suppliers.suppliersArchive',compact('suppliers'));
    }
}
