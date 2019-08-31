<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\{Category,Supplier,Product,Material,ItemLog};
use Hash;
use Session;
use DB;
use Auth;
use Image;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        $archive = Product::onlyTrashed()->count();

        return view('backend.admin.products.products',compact('products','archive'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $suppliers = Supplier::all();

        return view('backend.admin.products.addProduct',compact('categories','suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $products = Product::all();
        
        $request->validate([
            'product_id'        => 'required|unique:products',
            'product_name'      => 'required|min:2|max:50',
            'category'          => 'required',
            'supplier'          => 'required',
            'price'             => 'required|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'height'            => 'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'weight'            => 'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'width'             => 'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'description'       => 'nullable|max:200',
        ],[
            'price.regex' => 'price could only have 2 decimals',
            'height.regex' => 'height could only have 2 decimals',
            'weight.regex' => 'weight could only have 2 decimals',
            'width.regex'  => 'width could only have 2 decimals',
        ]);

        if(request('unit') == "pc")
        {
            request()->validate([
                'qty' => 'required|numeric|integer|min:0',
                'critical_amount'   => 'nullable|numeric|integer|min:0',
            ],[
                'qty.min' => "The quantity should be higher than 0 and doesn't contain decimal value",
                'qty.integer' => 'The quantity should be a whole number because this is a per piece item',
                'critical_amount.min' => "The Critical Amount should be higher than 0 and doesn't contain decimal value",
                'critical_amount.integer'   => 'The Critical Amount should be a whole number because this is a per piece item',
            ]);
        }
        else
        {
            request()->validate([
                'qty'               => 'required|numeric|regex:/^\d*(\.\d{1,3})?$/',
                'critical_amount'   => 'nullable|numeric|regex:/^\d*(\.\d{1,3})?$/',
            ],[
                'qty.regex'                 => "The quantity should only have 3 decimal values",
                'qty.integer'               => 'The quantity should be a number',
                'critical_amount.regex'     => "The Critical Amount should only have 3 decimal values",
                'critical_amount.integer'   => "The Critical Amount should be a number",
            ]);
        }
        
        $product = new product();
        
        if($request->hasFile('image')){
            $image = request('image');
            $filename = time().'.'.$image->getClientOriginalExtension();

            Image::make($image)->resize(300,300)->save(public_path('/__backend/assets/images/products/'.$filename));
            $product->image = $filename;
        }
        $product_id_upper           = strToUpper(request('product_id'));
        
        $product->product_id        = $product_id_upper;
        $product->product_name      = request('product_name');
        $product->category_id       = request('category');
        $product->supplier_id       = request('supplier');
        $product->price             = request('price');
        $product->qty               = request('qty');
        $product->critical_amount   = request('critical_amount');
        $product->height            = request('height');
        $product->height_label      = request('height_label');
        $product->weight            = request('weight');
        $product->weight_label      = request('weight_label');
        $product->width             = request('width');
        $product->width_label       = request('width_label');
        $product->description       = request('description');
        $product->unit              = request('unit');

        if($product->qty == 0){
            $product->status = "OUT OF STOCK";
        }

        if($product->critical_amount > $product->qty){
            $product->critical_status = 1;
        }

        $product->save();

        $notification = array(
            'message' => "Product is successfully Registered",
            'icon'  => 'success',
            'heading'   => 'Success',
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
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($product_id)
    {
        $categories = Category::all();
        $suppliers = Supplier::all();
        $status = [
            'AVAILABLE','UNAVAILABLE','OUT OF STOCK'
        ];
        $product = Product::where('product_id',$product_id)->firstOrFail();

        return view('backend.admin.products.editProduct',compact('categories','suppliers','product','status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $product_id)
    {
        $product = Product::where('product_id', $product_id)->firstOrFail();

        if(request('product_id') !=  $product->product_id)
        {
            $request->valdate([
                'product_id' => 'required|unique:products',
            ]);
        }
        $request->validate([
            'product_name'      => 'required|min:2|max:50',
            'category'          => 'required',
            'supplier'          => 'required',
            'height'            => 'nullable|numeric|regex:/^\d*(\.\d{1,2})?$',
            'weight'            => 'nullable|numeric|regex:/^\d*(\.\d{1,2})?$',
            'width'             => 'nullable|numeric|regex:/^\d*(\.\d{1,2})?$',
            'description'       => 'nullable|max:200',
        ],[
            'price.regex' => 'price could only have 2 decimals',
            'height.regex' => 'height could only have 2 decimals',
            'weight.regex' => 'weight could only have 2 decimals',
            'width.regex'  => 'width could only have 2 decimals',
        ]);

        if(request('unit') == "pc")
        {
            request()->validate([
                'qty' => 'required|numeric|integer|min:0',
                'critical_amount'   => 'nullable|numeric|integer|min:0',
            ],[
                'qty.min' => "The quantity should be higher than 0 and doesn't contain decimal value",
                'qty.integer' => 'The quantity should be a whole number because this is a per piece item',
                'critical_amount.min' => "The Critical Amount should be higher than 0 and doesn't contain decimal value",
                'critical_amount.integer'   => 'The Critical Amount should be a whole number because this is a per piece item',
            ]);
        }
        else
        {
            request()->validate([
                'qty'               => 'required|numeric|regex:/^\d*(\.\d{1,3})?$/',
                'critical_amount'   => 'nullable|numeric|regex:/^\d*(\.\d{1,3})?$/',
            ],[
                'qty.regex'                 => "The quantity should only have 3 decimal values",
                'qty.integer'               => 'The quantity should be a number',
                'critical_amount.regex'     => "The Critical Amount should only have 3 decimal values",
                'critical_amount.integer'   => "The Critical Amount should be a number",
            ]);
        }

        if($request->hasFile('image')){
            $image = request('image');
            $filename = time().'.'.$image->getClientOriginalExtension();

            Image::make($image)->resize(300,300)->save(public_path('/__backend/assets/images/products/'.$filename));

            $product->image = $filename;
        }

        $product->product_name      = request('product_name');
        $product->category_id       = request('category');
        $product->supplier_id       = request('supplier');
        $product->price             = request('price');
        $product->qty               = request('qty');
        $product->critical_amount   = request('critical_amount');
        $product->height            = request('height');
        $product->height_label      = request('height_label');
        $product->weight            = request('weight');
        $product->weight_label      = request('weight_label');
        $product->width             = request('width');
        $product->width_label       = request('width_label');
        $product->description       = request('description');
        $product->status            = request('status');

        $product->
        $product->save();

        $notification = array(
            'message' => 'Product '.$product->product_id.' successfully updated!',
            'icon'      => 'success',
            'heading'   => 'Updated!'
        );

        return redirect(route('backend.admin.products.index'))->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $product_id)
    {
        $request->validate([
            'password_confirm' => 'required'
        ],[
            'password_confirm.required' => 'Please enter your password'
        ]);
        if(Hash::check(request('password_confirm'),Auth()->user()->password)){
            $product = Product::where('product_id',$product_id)->firstOrFail();
            if($product->qty == 0){
                $product->delete();

                $notification = array(
                    'message'   => 'Product added to archives Successfully!',
                    'icon'      => 'success',
                    'heading'   => 'success',
                );
            return redirect(route('backend.admin.products.index'))->with($notification);
            }
            else{
                $notification = array(
                    'message'   => 'Product '.$product->product_id.' has still '.$product->qty.' stock(s) left, it should be 0 to delete this',
                    'icon'      => 'error',
                    'heading'   => 'Failed',
                );
                return back()->with($notification);
            }
        }
        else{
            $notification = array(
                'message'   => "Password Doesn't Match!",
                'icon'      => 'error',
                'heading'   => 'Failed!'
            );
            return back()->with($notification);
        }
    }

    public function archiveProducts()
    {
        $products = Product::onlyTrashed()->get();
        
        
        return view('backend.admin.products.archiveProducts',compact('products'));
    }

    public function restoreProduct(Request $request)
    {
       $product = Product::onlyTrashed()
                        ->where('product_id', request('product_id'))
                        ->firstOrFail();

       $product->restore();

       if($product->qty == 0){
           $product->status = "OUT OF STACK";
       }

       if($product->critical_amount >= $product->qty)
       {
           $product->critical_status = "CRITICAL";
       }

       $notification = array(
            "message"   => "Product ".$product->product_name." restored!",
            "icon"      => "success",
            "heading"   => "Restored",
       );

       return back()->with($notification);
    }

    public function addStocks(Request $request)
    {

        $product_id = request('product_id');
        $product = Product::where('product_id' , $product_id)->firstOrFail();

        if($product->unit == "pc")
        {
            $request->validate([
                'added_stocks'  => 'required|numeric|integer|min:0',
            ],[
                'added_stocks.min'  => 'The adding stocks should be higher than 0',
                'added_stocks.integer'  => 'The adding stocks should be a whole number because this is a per piece item',
            ]);
        }
        else
        {
            $request->validate([
                'added_stocks'  => 'required|numeric|regex:/^\d*(\.\d{1,3})?$/',
            ],[
                'added_stocks.regex'                 => "The quantity should only have 3 decimal values",
                'added_stocks.integer'               => 'The quantity should be a number',
            ]);
        }

        if($product->own_product == 1)
        {
            $product_id = $product->product_id;

            session(['id' => $product_id,
                    'qty' => request('added_stocks'),
                    ]);
            
            return redirect()->action('Backend\Admin\ProductsController@requirements');
        }

        $product->increment('qty', request('added_stocks'));

        if($product->qty == 0){
            $product->status = "OUT OF STOCK";
        }
        else
        {
            $product->status = "AVAILABLE";
        }

        if($product->critical_amount >= $product->qty)
        {
            $product->critical_status = 1;
        }
        else
        {
            $product->critical_status = 0;
        }


        $product->save();

        $addStock = new ItemLog();

        $addStock->primary_product_id = $product->primary_product_id;
        $addStock->user_id = Auth()->user()->user_id;
        $addStock->qty = request('added_stocks');
        $addStock->type = "add";

        $addStock->save();

        $notification = array(
            'message'   => 'Stocks added successfully  to product '.$product->product_id,
            'icon'  => 'success',
            'heading' => 'Successful!'
        );
        return redirect(route('backend.admin.products.index'))->with($notification);
    }

    public function requirements()
    {
        $product_id = session('id');
        $product = Product::where('product_id',$product_id)->firstOrFail();
        $product_id = $product->product_id;
        $adding_stocks = session('qty');
        $used_materials = unserialize($product->materials);
        $materials = new Material($used_materials);
        $items = $materials->items;

        return view('backend.admin.products.requirements',compact('items','adding_stocks','product_id'));
    }

    public function requirementsStore()
    {
        $product = Product::where('product_id', request('product_id'))->firstOrFail();
        $addingQty = request('adding_qty');
        $materials = unserialize($product->materials);
        $items = $materials->items;
        foreach($items as $item)
        {
            $checkProd = Product::where('product_id',$item['item']['product_id'])->firstOrFail();
            $reduction = $item['qty'] * $addingQty;
            if($checkProd->qty < $reduction)
            {
                $notification = array(
                    "message"   => "Not Enough Stocks for this item:".$item['item']['product_name'],
                    "icon"      => "error",
                    "heading"   => "Not Enough Stocks!"
                );
                return back()->with($notification);
            }
            if($checkProd->status != "AVAILABLE")
            {
                $notification = array(
                    "message"   => "this item:".$item['item']['product_name']." is not available",
                    "icon"      => "error",
                    "heading"   => "Not Available!"
                );
                return back()->with($notification);
            }
        }

        foreach($items as $item)
        {
            $reduction = $item['qty'] * $addingQty;
            $prod = Product::where('product_id',$item['item']['product_id'])->firstOrFail();
            $prod->decrement('qty', $reduction);

            if($prod->qty == 0)
            {
                $prod->status = "OUT OF STACK";
            }
            if($prod->critical_amount >= $prod->qty)
            {
                $prod->critical_status = 1;
            }
        }

        $product->increment('qty',$addingQty);

        $notification = array(
            'message'   => 'Stocks added successfully  to product '.$product->product_id,
            'icon'  => 'success',
            'heading' => 'Successful!'
        );

        return redirect()->route('backend.admin.products.index')->with($notification);
    }

    public function removeDefectives(Request $request)
    {
        $product_id = request('product_id');
        $product = Product::where('product_id',$product_id)->firstOrFail();

        if($product->unit == "pc")
        {
            $request->validate([
                'defectiveProducts'  => 'required|numeric|integer|min:0',
            ],[
                'defectiveProducts.min'  => "The removing stocks should be higher than 0 and doesn't contain decimal value",
                'defectiveProducts.integer' => 'The removing stocks should be a whole number',
            ]);
        }
        else
        {
            $request->validate([
                'defectiveProducts'  => 'required|regex:/^\d*(\.\d{1,3})?$/',
            ],[
                'defectiveProducts.min'  => 'The removing stocks should be higher than 0',
                'defectiveProducts.integer' => 'The removing stocks should be a whole number',
            ]);
        }
        
        $defectiveProducts = request('defectiveProducts');

        if($product->qty == 0){
            $notification = array(
                'message'   => "Stocks is currenty at 0. Can't reduct more",
                'icon'  => 'error',
                'heading' => 'Failed!!'
            );
            return back()->with($notification);
        }
        if($product->qty >= $defectiveProducts){

        $product->decrement('qty',$defectiveProducts);

        if($product->qty == 0)
        {
            $product->status = "OUT OF STOCK";
        }
        else
        {
            $product->status = "AVAILABLE";
        }

        if($product->critical_amount >= $product->qty)
        {
            $product->critical_status = 1;
        }
        else
        {
            $product->critical_status = 0;
        }

        $product->save();

        $defective = new ItemLog();

        $defective->primary_product_id = $product->primary_product_id;
        $defective->user_id = Auth()->user()->user_id;
        $defective->description = request('description');
        $defective->qty = $defectiveProducts;
        $defective->type = "defective";

        $defective->save();

        $notification = array(
            'message'   => 'Stocks remove successfully to product '.$product->product_id,
            'icon'  => 'success',
            'heading' => 'Successful!'
        );
        return redirect(route('backend.admin.products.index'))->with($notification);
    }
    else{
        $notification = array(
            'message'   => 'Defective products is higher than current stocks!',
            'icon'  => 'error',
            'heading' => 'Failed!!'
        );
        return back()->with($notification);

    }
    }

    public function productLog($product_id)
    {
        $product = Product::where('product_id',$product_id)->firstOrFail();
        $product_name = $product->product_name;
        $defectives = ItemLog::where('primary_product_id',$product->primary_product_id)
                                ->where('type', 'defective')
                                ->orderBy('created_at', 'DESC')
                                ->get();
        $addStocks = ItemLog::where('primary_product_id',$product->primary_product_id)
                                ->where('type','add')
                                ->orderBy('created_at', 'DESC')
                                ->get();

        $materials = ItemLog::where('primary_product_id',$product->primary_product_id)
                                ->where('type','material')
                                ->orderBy('created_at', 'DESC')
                                ->get();

        return view('backend.admin.products.productLog',compact('product','defectives','addStocks','product_name','materials'));
    }
}
