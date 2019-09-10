<?php

namespace App\Http\Controllers\Backend\Inventory;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;

class ReportsController extends Controller
{
    public function critical()
    {
        $products = Product::where('critical_status',1)
                            ->orderBy('qty','DESC')
                            ->get();

        return view('backend.inventory.reports.criticalProducts',compact('products'));
    }

    public function printCritical()
    {
        $products = Product::where('critical_status',1)
                    ->orderBy('qty','DESC')
                    ->get();

        return view('backend.inventory.reports.printCriticalProducts',compact('products'));
    }
}
