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
        $revenue = Order::where('status', '!=', 'cancelled')->sum('total_price');

        return view('admin.dashboard.index', compact('users_count', 'travel_packages_count', 'orders_count', 'revenue'));
    }
    public function usermanager()
    {
        $users = \App\Models\User::where('is_admin', 0)->paginate(10);
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
