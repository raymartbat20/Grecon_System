<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Supplier;
use Auth;
use Hash;
use Image;

class SuppliersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::paginate(5);
        return view('backend.admin.suppliers.suppliers',compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.admin.suppliers.createSupplier');
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
            'lastname'      => 'required|min:2|max:20',
            'company'       => 'required|min:2|max:50',
        ]);

        $supplier = new supplier();

        if(request('email') == null && request('number') == null){
            $notification = array(
                'message' => "one of the email or number should have a value!",
                'icon' => 'error',
                'heading' => 'No Contacts!'
            );
            return back()->with($notification);
        }
        elseif(request('email') != null){
            $request->validate([
                'email' => 'email'
                ]);
            $supplier->email =  request('email');
        }
        else{
            $request->validate([
                'number' => 'numeric|digits_between:0,11',
            ]);
            $supplier->email =  request('number');
        }


        $supplier->firstname = request('firstname');
        $supplier->lastname = request('lastname');
        $supplier->company = request('company');

        
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

        return redirect(route('backend.admin.suppliers.index'))->with($notification);
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
            'lastname'      => 'required|min:2|max:20',
            'company'       => 'required|min:2|max:50',
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
        
        if(request('email') != null){
            $request->validate([
                'email' => 'email'
                ]);
            $supplier->email = request('email');
        }
        
        if(request('number') != null){
            $request->validate([
                'number' => 'numeric|digits_between:0,11',
            ]);
            $supplier->number = request('number');
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
            $supplier->delete();

            $name = $supplier->getFullName();
            $notification = array (
                'message' => "Supplier ".$name." was successfuly deleted!",
                'icon' => 'warning',
                'heading' => 'Success',
            );
            return back()->with($notification);
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
}
