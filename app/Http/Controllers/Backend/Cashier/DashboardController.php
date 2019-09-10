<?php

namespace App\Http\Controllers\Backend\Cashier;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\{Customer,Product};
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today()->toDateString();
        $sales_records = Customer::whereDate('created_at',$today)->sum("total");
        $salesRecordsCount = Customer::whereDate('created_at',$today)->get()->count();
        $products_count = Product::all()->count();

        return view('backend.cashier.dashboard.dashboard',
        compact('sales_records','salesRecordsCount','products_count'));
    }
}
