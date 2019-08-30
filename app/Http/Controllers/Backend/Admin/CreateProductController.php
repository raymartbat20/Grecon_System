<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\{Product,Material};
use Session;

class CreateProductController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return view('backend.admin.products.createProduct',compact('products'));
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
        if(!Session::has('materials'))
        {
            $notification = array(
                "message"   => "Please Add some materials first",
                "icon"      => "info",
                "Heading"   => "No Materials",
            );
            return back()->with($notification);
        }
        $oldMaterials = Session::get('materials');
        $materials = new Material($oldMaterials);
        $items = $materials->items;
        $totalQty = $materials->totalQty;
        return view('backend.admin.products.materials',compact('items','totalQty'));
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
}
