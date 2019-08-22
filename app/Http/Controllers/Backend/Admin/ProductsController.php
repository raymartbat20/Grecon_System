<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\{Category,Supplier,Product,Defective,AddStock};
use Hash;
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
        $products = Product::paginate(20);

        return view('backend.admin.products.products',compact('products'));
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

        return view('backend.admin.products.createProduct',compact('categories','suppliers'));
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
            'product_id'        => 'required|unique:products',
            'product_name'      => 'required|min:2|max:20',
            'category'          => 'required',
            'supplier'          => 'required',
            'price'             => 'required|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'qty'               => 'numeric|integer',
            'critical_amount'   => 'numeric|integer',
            'height'            => 'numeric|integer',
            'weight'            => 'numeric|integer',
            'width'             => 'numeric|integer',
            'description'       => 'max:200',
        ],[
            'price.regex' => 'price could only have 2 decimals',
        ]);
        
        $product = new product();
        
        if($request->hasFile('image')){
            $image = request('image');
            $filename = time().'.'.$image->getClientOriginalExtension();

            Image::make($image)->resize(300,300)->save(public_path('/__backend/assets/images/products/'.$filename));
            $product->image = $filename;
        }

        $product->product_id        = request('product_id');
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

        if($product->qty == 0){
            $product->status = "OUT OF STOCK";
        }

        if($product->critical_amount > $product->qty){
            $product->critical_status = 1;
        }
        Product::created($product);
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
            'AVAILABLE','UNAVAILABLE','RESERVED','OUT OF STOCK'
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
        $request->validate([
            'product_name'      => 'required|min:2|max:20',
            'category'          => 'required',
            'supplier'          => 'required',
            'price'             => 'required|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'critical_amount'   => 'numeric|integer',
            'height'            => 'numeric|integer',
            'weight'            => 'numeric|integer',
            'width'             => 'numeric|integer',
            'description'       => 'max:200',
        ],[
            'price.regex' => 'price could only have 2 decimals',
        ]);

        $product = Product::where('product_id', $product_id)->firstOrFail();

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
                    'message'   => 'Product Deleted Successfully!',
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

    public function addStocks(Request $request)
    {

        $request->validate([
            'added_stocks'  => 'required|numeric|integer|min:0',
        ],[
            'added_stocks.min'  => 'The adding stocks should be higher than 0',
            'added_stocks.integer'  => 'The adding stocks should be a whole number',
        ]);

        $product_id = request('product_id');
        $product = Product::where('product_id' , $product_id)->firstOrFail();
        $product->increment('qty', request('added_stocks'));

        if($product->qty == 0){
            $product->status = "OUT OF STOCK";
        }

        if($product->critical_amount >= $qty){
            $product->critical_status = 1;
        }
        else{
            $product->critical_status = 0;
        }


        $product->save();

        $addStock = new addstock();

        $addStock->primary_product_id = $product->primary_product_id;
        $addStock->user_id = Auth()->user()->user_id;
        $addStock->add_qty = request('added_stocks');

        $addStock->save();

        $notification = array(
            'message'   => 'Stocks added successfully  to product '.$product->product_id,
            'icon'  => 'success',
            'heading' => 'Successful!'
        );
        return redirect(route('backend.admin.products.index'))->with($notification);
    }

    public function removeDefectives(Request $request)
    {
        $request->validate([
            'defectiveProducts'  => 'required|numeric|integer|min:0',
        ],[
            'defectiveProducts.min'  => 'The removing stocks should be higher than 0',
            'defectiveProducts.integer' => 'The removing stocks should be a whole number',
        ]);
        $product_id = request('product_id');
        $defectiveProducts = request('defectiveProducts');
        $product = Product::where('product_id',$product_id)->firstOrFail();

        $product->decrement('qty',$defectiveProducts);

        if($product->qty == 0){
            $product->status = "OUT OF STOCK";
        }

        if($product->critical_amount >= $qty){
            $product->critical_status = 1;
        }
        else{
            $product->critical_status = 0;
        }

        $product->save();

        $defective = new defective();

        $defective->primary_product_id = $product->primary_product_id;
        $defective->user_id = Auth()->user()->user_id;
        $defective->description = request('description');
        $defective->defectives_qty = $defectiveProducts;

        $defective->save();

        $notification = array(
            'message'   => 'Stocks remove successfully to product '.$product->product_id,
            'icon'  => 'success',
            'heading' => 'Successful!'
        );
        return redirect(route('backend.admin.products.index'))->with($notification);
    }

    public function productLog($product_id)
    {
        $product = Product::where('product_id',$product_id)->firstOrFail();
        $product_name = $product->product_name;
        $defectives = Defective::where('primary_product_id',$product->primary_product_id)->orderBy('created_at', 'DESC')->get();
        $addStocks = AddStock::where('primary_product_id',$product->primary_product_id)->orderBy('created_at', 'DESC')->get();

        return view('backend.admin.products.productLog',compact('product','defectives','addStocks','product_name'));
    }
}
