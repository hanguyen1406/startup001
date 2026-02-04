<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;


class DashboardController extends Controller
{
    public function index()
    {
        $users_count = \App\Models\User::where('is_admin', 0)->count();
        $travel_packages_count = \App\Models\TravelPackage::count();
        $orders_count = Order::count();
        $revenue = Order::whereIn('status', ['confirmed', 'completed'])->sum('total_price');

        // Revenue Chart Data (12 months of current year)
        $revenueData = Order::select(
            DB::raw('sum(total_price) as sum'),
            DB::raw("DATE_FORMAT(created_at,'%m') as month")
        )
            ->whereYear('created_at', date('Y'))
            ->whereIn('status', ['confirmed', 'completed'])
            ->groupBy('month')
            ->pluck('sum', 'month');

        $chartRevenue = [];
        for ($i = 1; $i <= 12; $i++) {
            $month = str_pad($i, 2, '0', STR_PAD_LEFT);
            $chartRevenue[] = (float) ($revenueData[$month] ?? 0);
        }

        // Order Status Chart Data
        $statusCounts = Order::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status')->all();

        $chartStatus = [
            $statusCounts['pending'] ?? 0,
            $statusCounts['confirmed'] ?? 0,
            $statusCounts['completed'] ?? 0,
            $statusCounts['cancelled'] ?? 0
        ];

        return view('admin.dashboard.index', compact('users_count', 'travel_packages_count', 'orders_count', 'revenue', 'chartRevenue', 'chartStatus', 'statusCounts'));
    }
    public function usermanager()
    {
        $users = \App\Models\User::where('is_admin', 0)->paginate(7);
        return view('admin.usermanager.index', compact('users'));
    }

    public function editUser($id)
    {
        $user = \App\Models\User::findOrFail($id);
        return view('admin.usermanager.edit', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        $user = \App\Models\User::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $data['password'] = \Illuminate\Support\Facades\Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.usermanager')->with('success', 'Cập nhật thông tin khách hàng thành công!');
    }

    public function destroyUser($id)
    {
        \App\Models\User::destroy($id);
        return redirect()->route('admin.usermanager')->with('success', 'Xóa khách hàng thành công!');
    }

}
