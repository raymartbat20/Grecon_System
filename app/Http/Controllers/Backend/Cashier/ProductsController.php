<?php

namespace App\Http\Controllers\Backend\Cashier;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return view('backend.cashier.products.products',compact('products'));
    }
}
