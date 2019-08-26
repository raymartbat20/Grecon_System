<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\{Cart,Product,Customer};
use Auth;
use Session;

class OrderCartController extends Controller
{
    public function addToCart(Request $request)
    {
        $item = Product::where('product_id',request('product_id'))->firstOrFail();
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

    public function reduceQty()
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $product_id = request('product_id');
        $reduce_qty = request('reduce_qty');
        $cart->reduceQty($product_id,$reduce_qty);

        Session::put('cart',$cart);

        $notification = array(
            'message'   => 'Success reduce of quantity',
            'icon'      => 'success',
            'heading'   => 'Success',
        );
        return back()->with($notification);
    }

    public function removeItem()
    {
        // dd(request()->all());
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $product_id = request('product_id');
        $cart->removeItem($product_id);

        Session::put('cart',$cart);

        $notification = array(
            'message'   => 'Success of removing item',
            'icon'      => 'success',
            'heading'   => 'Success',
        );

        return back()->with($notification);
    }

    public function checkout()
    {
        if(!Session::has('cart')){
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

        return view('backend.admin.transactions.checkout',compact('items','totalPrice','totalQty'));
    }

    public function store(Request $request)
    {
        // dd(request()->all());
        if(!Session::has('cart'))
        {
            $notification = array(
                'message'   => "Please add some item first",
                'icon'  => 'warning',
                'heading' => 'No items!',
            );

            return redirect(route('backend.admin.transaction.index'))->with($notification);
        }

        $request->validate([
            'name'  => 'required|max:15',
            'contact_number' => '|numeric',
            'address'   => 'max:250',
            'discount'  => 'numeric'
        ]);

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $items = $cart->items;

        foreach($items as $item)
        {
            $product = Product::where('product_id',$item['item']['product_id'])->firstOrFail();

            if($item['qty'] > $product->qty)
            {
                $notification = array(
                    "message"   => "you have more stock request to this ".$product->product_name." current stock",
                    'icon'      => 'error',
                    'heading'   => 'WARNING!',
                );
                return back()->with($notification);
            }
        }

        foreach($items as $item)
        {
            $product = Product::where('product_id',$item['item']['product_id'])->firstOrFail();
            
            $product->decrement('qty',$item['qty']);

            if($product->qty == 0)
            {
                $product->status = "OUT OF STOCK";
            }
            if($product->critical_status >= $product->qty)
            {
                $product->critical_status = 1;
            }

            $product->save();
        }

        $customer = new customer();
        $customer->name = request('name');
        $customer->contact_number = request('number');
        $customer->address = request('address');
        $customer->items = serialize($cart);
        $customer->amount_paid = request('amount_paid');
        $customer->original_price = $cart->totalPrice;
        $customer->discount = request('discount');
        $customer->total = request('discounted_price');
        
        $customer->save();

        Session::forget('cart');

        $notification = array(
            "message"   => "Order successfully created",
            'icon'      => 'success',
            'heading'   => 'SUCCESS!',
        );
        return redirect(route('backend.admin.transaction.index'))->with($notification);
    }
}
