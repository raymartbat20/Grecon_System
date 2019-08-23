<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\{Cart,Product};
use Auth;
use Session;

class OrderCartController extends Controller
{
    public function addToCart(Request $request)
    {
        $item = Product::find(request('product_id'));
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $itemQty = request('qty');
        $cart->add($item,$item->product_id,$itemQty);
        
        $request->session()->put('cart',$cart);
        
        $notification = array(
            'message'   => 'Successfully added',
            'icon'  => 'success',
            'heading'   => 'Success!',
        );

        return back()->with($notification);
    }

    public function index()
    {
        if(!Session::has('cart'))
        {
            $notification = array(
                'message'   => "Please add some item first",
                'icon'  => 'warning',
                'heading' => 'No items!',
            );
            return redirect(route('backend.admin.transaction.index'))->with($notification);
        }

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $items = $cart->items;
        $totalPrice = $cart->totalPrice;
        $totalQty = $cart->totalQty;

        return view('backend.admin.transactions.itemCart',compact('items','totalPrice','totalQty'));
    }
}
