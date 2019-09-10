<?php

namespace App\Http\Controllers\Backend\Inventory;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\{Product,Category,Supplier,ItemLog};
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $products_count = Product::all()->count();
        
        $critical_products = Product::where('critical_status',1)
        ->get()
        ->count();
        return view('backend.inventory.dashboard.dashboard'
        ,compact('products_count','critical_products'));
    }
}
