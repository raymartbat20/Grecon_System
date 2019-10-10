<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\{Cart,Product,Customer,ItemLog,User};
use App\Notifications\{ProductCritical,OutOfStock,Transaction};
use Auth;
use Session;

class OrderCartController extends Controller
{
    public function addToCart(Request $request)
    {

        if(request("qty_kilo") == null && request("qty_pc") == null)
        {
            $notification = array(
                "message"   => "Please add some quantity!",
                "icon"      => "error",
                "heading"   => "No value inserted",
            );
            return back()->with($notification);
        }
        if(request("qty_kilo") != null)
        {
            $request->validate([
                'qty_kilo'  => 'required|numeric|regex:/^\d*(\.\d{1,3})?$/',
            ],[
                'qty_kilo.regex'  => 'The quantity should only have 3 decimal values',
                'qty_kilo.numeric'    => 'The quantity should be a number'
            ]);
            
            $itemQty = request('qty_kilo');
        }

        if(request("qty_pc") != null)
        {
            $request->validate([
                'qty_pc'  => 'required|numeric|integer|min:0',
            ],[
                'qty_pc.min'  => "The quantity should be higher than 0 and doesn't contain decimal value",
                'qty_pc.integer' => 'The quantity should be a whole number because this is a per piece item',
            ]);
            
            $itemQty = request('qty_pc');
        }
        
            $item = Product::where('product_id',request('product_id'))->firstOrFail();
            $oldCart = Session::has('cart') ? Session::get('cart') : null;
            $cart = new Cart($oldCart);
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
        if(!Session::has('cart') || Session::get('cart')->totalQty <= 0)
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
        $product = Product::where("product_id", $product_id)->firstOrFail();
        if($product->unit == "pc")
        {
            request()->validate([
                'reduce_qty'  => 'required|numeric|integer|min:0',
            ],[
                'reduce_qty.min'  => "The quantity should be higher than 0 and doesn't contain decimal value",
                'reduce_qty.integer' => 'The quantity should be a whole number because this is a per piece item',
            ]);
        }
        else
        {
            request()->validate([
                'reduce_qty'  => 'required|numeric|regex:/^\d*(\.\d{1,3})?$/',
            ],[
                'reduce_qty.regex'  => 'The quantity should only have 3 decimal values',
                'reduce.numeric'    => 'The quantity should be a number'
            ]);
        }

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
            'discount'  => 'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/'
        ],[
            'discount.regex'    => 'This should ony have 2 decimal value',
        ]);

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $items = $cart->items;
        $admins = User::where('role_id',1)->get();
        $auth_user = Auth::user();

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

        $users = User::where('role_id',1)
                      ->orWhere('role_id',3)
                      ->get();

        foreach($items as $item)
        {
            $product = Product::where('product_id',$item['item']['product_id'])->firstOrFail();
            
            $product->decrement('qty',$item['qty']);

            if($product->critical_amount >= $product->qty)
            {
                if($product->critical_status != 1)
                {
                    $product->critical_status = 1;

                    foreach($users as $user)
                    {
                        if($user->role_id == 1)
                        {
                            $user->notify(new ProductCritical($product,"admin"));
                        }
                        else
                            $user->notify(new ProductCritical($product,"inventory_clerk"));
                    }
                }
            }

            if($product->qty == 0)
            {
                $product->status = "OUT OF STOCK";

                foreach($users as $user)
                {
                    if($user->role_id == 1)
                    {
                        $user->notify(new OutOfStock($product,"admin"));
                    }
                    else
                        $user->notify(new OutofStock($product,"inventory_clerk"));
                }
            }

            $product->save();

            $sold_item = new ItemLog();
            $sold_item->primary_product_id = $item['item']['primary_product_id'];
            $sold_item->user_id = Auth()->user()->user_id;
            $sold_item->qty = $item['qty'];
            $sold_item->type = "sold";

            $sold_item->save();
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

        if(request('discount') == null)
        {
            $customer->total = $cart->totalPrice;
            $customer->discount =  0;
        }
        
        $customer->save();

        foreach($admins as $admin)
        {
            $admin->notify(new Transaction($auth_user,$customer));
        }

        Session::forget('cart');

        $notification = array(
            "message"   => "Order successfully created",
            'icon'      => 'success',
            'heading'   => 'SUCCESS!',
        );
        return redirect("admin/transaction/$customer->customer_id")->with($notification);
    }
}
