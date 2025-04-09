<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;


class DashboardController extends Controller
{
    public function index(){
        $orders = Order::with('travelPackage')->get();
        // dd($orders);
        return view('admin.dashboard.index', compact('orders'));
    }
}
