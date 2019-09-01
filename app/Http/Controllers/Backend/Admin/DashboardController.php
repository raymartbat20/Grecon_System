<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\{Product,Category,Supplier,Customer,ItemLog};
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
    $products_count = Product::all()->count();

    $yesterday = Carbon::today()->toDateString();
    $sales_records = Customer::whereDate('created_at',$yesterday)->sum("total");
    $salesRecordsCount = Customer::whereDate('created_at',$yesterday)->get()->count();
    $getSoldProducts = Customer::all();

    $top_product = ItemLog::where('type','sold')
                            ->groupBy('primary_product_id')
                            ->selectRaw('*, sum(qty) as sum')
                            ->orderBy('sum','DESC')
                            ->first();

    $top10_products = ItemLog::where('type','sold')
                            ->groupBy('primary_product_id')
                            ->selectRaw('*, sum(qty) as sum')
                            ->orderBy('sum','DESC')
                            ->take(10)
                            ->get();

    $critical_products = Product::where('critical_status',1)
                                ->get()
                                ->count();
    return view('backend.admin.dashboard.dashboard',compact('products_count','salesRecordsCount','sales_records',
    'top_product','critical_products','top10_products'));
    }
}
