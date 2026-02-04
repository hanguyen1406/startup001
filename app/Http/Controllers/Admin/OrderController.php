<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::with(['user', 'travelPackage'])->latest()->paginate(7);
        return view('admin.orders.index', compact('orders'));
    }

    public function updateStatus(Request $request, $id): RedirectResponse
    {
        $order = Order::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,completed'
        ]);

        $order->update(['status' => $validated['status']]);

        return redirect()->back()->with('message', 'Cập nhật trạng thái đơn hàng thành công!');
    }

    public function checkIn($id)
    {
        $order = Order::findOrFail($id);

        if ($order->status == 'confirmed') {
            $order->update(['status' => 'completed']);
            return redirect()->route('admin.orders.index')->with('message', 'Check-in thành công! Vé đã được sử dụng.');
        }

        return redirect()->route('admin.orders.index')->with('error', 'Vé không hợp lệ hoặc chưa được duyệt.');
    }
}
