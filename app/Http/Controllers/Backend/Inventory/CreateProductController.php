<?php

namespace App\Http\Controllers\Backend\Inventory;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\{Product,Material,Category,Supplier,ItemLog};
use Auth;
use Session;
use Image;
use DB;

class CreateProductController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return view('backend.inventory.products.createProduct',compact('products'));
    }
    
    public function addMaterial(Request $request)
    {
        $item = Product::where('product_id',request('product_id'))->firstOrFail();
        if($item->unit == "pc")
        {
            request()->validate([
                'qty'  => 'required|numeric|integer|min:0',
            ],[
                'qty.min'  => "The quantity should be higher than 0 and doesn't contain decimal value",
                'qty.integer' => 'The quantity should be a whole number because this is a per piece item',
            ]);
            
            $itemQty = request('qty');
        }
        else
        {
            request()->validate([
                'qty'  => 'required|numeric|regex:/^\d*(\.\d{1,3})?$/',
            ],[
                'qty.regex'  => 'The quantity should only have 3 decimal values',
                'qty.numeric'    => 'The quantity should be a number'
            ]);
            
            $itemQty = request('qty');
        }
            $oldMaterials = Session::has('materials') ? Session::get('materials') : null;
            $materials = new Material($oldMaterials);
            $materials->add($item,$item->product_id,$itemQty);
            
            $request->session()->put('materials',$materials);
            
            $notification = array(
                'message'   => 'Successfully added',
                'icon'  => 'success',
                'heading'   => 'Success!',
            );

            return back()->with($notification);
    }

    public function materials()
    {
        // Session::forget('materials');
        if(!Session::has('materials'))
        {
            $notification = array(
                "message"   => "Please Add some materials first",
                "icon"      => "info",
                "heading"   => "No Materials Yet!",
            );
            return redirect(route('backend.inventory.createproduct.index'))->with($notification);
        }
        $oldMaterials = Session::get('materials');
        $materials = new Material($oldMaterials);
        $items = $materials->items;
        $totalQty = $materials->totalQty;
        return view('backend.inventory.products.materials',compact('items','totalQty'));
    }

    public function reduceMaterial(Request $request)
    {
        $product = Product::where('product_id',request('product_id'))->firstOrFail();

        if($product->unit == "pc")
        {
            request()->validate([
                'qty'  => 'required|numeric|integer|min:0',
            ],[
                'qty.min'  => "The quantity should be higher than 0 and doesn't contain decimal value",
                'qty.integer' => 'The quantity should be a whole number because this is a per piece item',
            ]);
        }
        else
        {
            request()->validate([
                'qty'  => 'required|numeric|regex:/^\d*(\.\d{1,3})?$/',
            ],[
                'qty.regex'  => 'The quantity should only have 3 decimal values',
                'qty.numeric'    => 'The quantity should be a number'
            ]);
        }

        $oldMaterials = Session::has('materials') ? Session::get('materials') : null;
        $materials = new Material($oldMaterials);
        $product_id = request('product_id');
        $reduceMaterial = request('qty');
        $materials->reduceQty($product_id,$reduceMaterial);

        Session::put('materials',$materials);

        $notification = array(
            'message'   => 'Success reduce of quantity',
            'icon'      => 'success',
            'heading'   => 'Success',
        );
        return back()->with($notification);
    }

    public function removeMaterial()
    {
        $oldMaterials = Session::has('materials') ? Session::get('materials') : null;
        $materials = new Material($oldMaterials);
        $product_id = request('product_id');
        $materials->removeItem($product_id);

        Session::put('materials',$materials);

        $notification = array(
            'message'   => 'Item was successfuly removed',
            'icon'      => 'success',
            'heading'   => 'Item Removed',
        );

        return back()->with($notification);
    }

    public function registerProduct()
    {
        $oldMaterials = Session::has('materials') ? Session::get('materials') : null;
        $materials  = new Material($oldMaterials);
        $items = $materials->items;
        $totalQty   = $materials->totalQty;
        if($totalQty <= 0)
        {
            $notification = array(
                "message"   => "Please Add some materials first",
                "icon"      => "info",
                "heading"   => "No Materials Yet!",
            );
            return redirect(route('backend.inventory.createproduct.index'))->with($notification);
        }
        $categories = Category::all();
        $supplier = Supplier::where('company','GRECON')->firstOrFail();

        return view('backend.inventory.products.registerProduct',compact('items','totalQty','categories','supplier'));
    }

    public function store(Request $request)
    {
        dd(request()->all());
        if(!Session::has('materials'))
        {
            $notification = array(
                "message"   => "Please Add some materials first",
                "icon"      => "info",
                "heading"   => "No Materials Yet!",
            );
            return redirect()->route('backend.inventory.createproduct.index')->with($notification);
        }

        $oldMaterials = Session::get('materials');
        $materials = new Material($oldMaterials);
        $items = $materials->items;
        $totalQty = $materials->totalQty;


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

        //Checking for quantity
        foreach($items as $item)
        {
            $qty_required = $item['qty'] * request('qty');
            $prod_qty = Product::where('product_id',$item['item']['product_id'])->firstOrFail();
            if($prod_qty->qty < $qty_required)
            {
                $notification = array(
                    "message"   => "Not Enough stocks for this item: ".$prod_qty->product_name,
                    "icon"      => "error",
                    "heading"   => "Not Enough Stocks",
                );
                return redirect()->route('backend.inventory.createproduct.materials')->with($notification);
            }
        }

        $product = new Product();
        $product->product_name = request('product_name');

        //Reducing Quantity
        foreach($items as $item)
        {
            $qty = $item['qty'] * request('qty');
            $prod = Product::where('product_id', $item['item']['product_id'])->firstOrFail();
            $prod->decrement('qty' , $qty);

            if($prod->qty == 0)
            {
                $prod->status = "OUT OF STOCK";
                $prod->save();
            }
            if($prod->critical_amount >= $prod->qty)
            {
                $prod->critical_status = 1;
                $prod->save();
            }

            //Creating the Log
            $itemLog = new ItemLog();

            $itemLog->primary_product_id = $prod->primary_product_id;
            $itemLog->type = "material";
            $itemLog->qty = $qty;
            $itemLog->user_id = Auth()->user()->user_id;
            $itemLog->description = "Used for making the product of ".$product->product_name."";
            $itemLog->save();

        }


        $grecon_supplier            = Supplier::where('company','Grecon')->firstOrFail();
        $product_id_upper           = strToUpper(request('product_id'));
        
        $product->product_id        = $product_id_upper;
        $product->category_id       = request('category');
        $product->supplier_id       = $grecon_supplier->supplier_id;
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
        $product->own_product       = 1;
        $product->materials         = serialize($materials);

        if($product->qty == 0)
        {
            $product->status = "OUT OF STOCK";

        }
        
        if($product->critcal_amount >= $product->qty)
        {
            $product->critcal_status = 1;
        }

        $product->save();

        $notification = array(
            "message"   => "Product Created Succesfully!",
            "icon"      => "success",
            "heading"   => "Created Successfully!",
        );
        Session::forget('materials');

        return redirect()->route('backend.inventory.createproduct.index')->with($notification);
    }
}
