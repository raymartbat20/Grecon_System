<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\{Category,Supplier,Product};
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
