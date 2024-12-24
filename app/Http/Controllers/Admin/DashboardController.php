<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        $orders = DB::select('SELECT * FROM vw_order_details');
        return view('admin.dashboard.index', compact('orders'));
    }
}
