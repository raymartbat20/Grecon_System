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

    $firstDayofPreviousMonth = Carbon::now()->startOfMonth()->subMonth()->toDateString();
    $lastDayofPreviousMonth = Carbon::now()->subMonth()->endOfMonth()->toDateString();
    // dd($firstDayofPreviousMonth.'-'.$lastDayofPreviousMonth);

    $today = Carbon::today()->toDateString();

    $sales_records = Customer::whereDate('created_at',$today)->sum("total");
    $salesRecordsCount = Customer::whereDate('created_at',$today)->get()->count();

    $getSoldProducts = Customer::all();

    // dd($yesterday);
    // dd(Carbon::now());

    $top_product = ItemLog::where('type','sold')
                            ->whereDate('created_at', '>=' ,$firstDayofPreviousMonth)
                            ->whereDate('created_at', '<=' , $lastDayofPreviousMonth)
                            ->groupBy('primary_product_id')
                            ->selectRaw('*, sum(qty) as sum')
                            ->orderBy('sum','DESC')
                            ->first();
    // dd($top_product);
    $top10_products = ItemLog::where('type','sold')
                            ->whereDate('created_at', '>=' ,$firstDayofPreviousMonth)
                            ->whereDate('created_at', '<=' , $lastDayofPreviousMonth)
                            ->groupBy('primary_product_id')
                            ->selectRaw('*, sum(qty) as sum')
                            ->orderBy('sum','DESC')
                            ->take(10)
                            ->get();

    $critical_products = Product::where('critical_status',1)
                                ->get()
                                ->count();

    // foreach($top10_products as $product)
    // {
    //     dump($product->product->product_name);
    // }
    // die();
    return view('backend.admin.dashboard.dashboard',compact('products_count','salesRecordsCount','sales_records',
    'top_product','critical_products','top10_products'));
    }
}
