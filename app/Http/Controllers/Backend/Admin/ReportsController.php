<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\{Product,ItemLog};

class ReportsController extends Controller
{
    public function topSelling()
    {

        $products = ItemLog::where('type','sold')
                ->groupBy('primary_product_id')
                ->selectRaw('*, sum(qty) as sum')
                ->orderBy('sum','DESC')
                ->get();

        return view('backend.admin.reports.topSelling',compact('products'));
    }

    public function printTopSelling()
    {
        $products = ItemLog::where('type','sold')
        ->groupBy('primary_product_id')
        ->selectRaw('*, sum(qty) as sum')
        ->orderBy('sum','DESC')
        ->get();

        return view('backend.admin.reports.printTopSelling',compact('products'));
    }

    public function critical()
    {
        $products = Product::where('critical_status',1)
                            ->orderBy('qty','DESC')
                            ->get();

        return view('backend.admin.reports.criticalProducts',compact('products'));
    }

    public function printCritical()
    {
        $products = Product::where('critical_status',1)
                    ->orderBy('qty','DESC')
                    ->get();

        return view('backend.admin.reports.printCriticalProducts',compact('products'));
    }
}
