<?php

namespace App\Http\Controllers\Backend\Cashier;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\{User,Product,Cart,Customer,Category};
use Hash;
use Session;
use Auth;

class TransactionsController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = request('search');
        $products = Product::join('categories','products.category_id', '=' ,'categories.category_id')
                            ->where('product_name', 'LIKE', '%'.$search.'%')
                            ->orWhere('categories.category', 'LIKE' , '%'.$search.'%')
                            ->paginate(9);

        return view('backend.cashier.transactions.makePurchase',compact('products'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::find($id);
        $cart = unserialize($customer->items);
        $items = $cart->items;
        return view('backend.cashier.transactions.invoice',compact('customer','items','cart'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

    public function records()
    {
        $customers = Customer::orderBy('created_at','DESC')->get();

        return view('backend.cashier.transactions.records',compact('customers'));
    }

    public function printInvoice(Request $request, $id)
    {
        $customer = Customer::find($id);
        $cart = unserialize($customer->items);
        $items = $cart->items;
        return view('backend.cashier.transactions.invoicePrint',compact('customer','items','cart'));
    }
}
