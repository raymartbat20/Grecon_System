<?php

namespace App\Http\Controllers\Backend\Cashier;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('backend.cashier.dashboard.dashboard');
    }
}
