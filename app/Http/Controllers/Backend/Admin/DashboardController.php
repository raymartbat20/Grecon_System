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

    $startDate = Carbon::parse(request('date_start'))->format('Y-m-d');
    $endDate = Carbon::parse(request('date_end'))->format('Y-m-d');

    $firstDayofMonth = Carbon::now()->startOfMonth()->toDateString();
    $lastDayofMonth = Carbon::now()->endOfMonth()->toDateString();

    $today = Carbon::today()->toDateString();

    $sales_records = Customer::whereDate('created_at',$today)->sum("total");
    $salesRecordsCount = Customer::whereDate('created_at',$today)->get()->count();

    $getSoldProducts = Customer::all();

    $top_product = ItemLog::where('type','sold')
                            ->whereDate('created_at', '>=' ,$firstDayofPreviousMonth)
                            ->whereDate('created_at', '<=' , $lastDayofPreviousMonth)
                            ->groupBy('primary_product_id')
                            ->selectRaw('*, sum(qty) as sum')
                            ->orderBy('sum','DESC')
                            ->first();

    if(request('date_start') != null && request('date_end') != null)
    {
    $top10_products = ItemLog::where('type','sold')
                    ->whereDate('created_at', '>=' ,$startDate)
                    ->whereDate('created_at', '<=' , $endDate)
                    ->groupBy('primary_product_id')
                    ->selectRaw('*, sum(qty) as sum')
                    ->orderBy('sum','DESC')
                    ->take(10)
                    ->get();
    }
    else
    {
    $top10_products = ItemLog::where('type','sold')
                ->whereDate('created_at', '>=' ,$firstDayofMonth)
                ->whereDate('created_at', '<=' , $lastDayofMonth)
                ->groupBy('primary_product_id')
                ->selectRaw('*, sum(qty) as sum')
                ->orderBy('sum','DESC')
                ->take(10)
                ->get();
    }

    $critical_products = Product::where('critical_status',1)
                                ->get()
                                ->count();

    return view('backend.admin.dashboard.dashboard',compact('products_count','salesRecordsCount','sales_records',
    'top_product','critical_products','top10_products'));
    }
}
