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
        $orders = Order::with(['user', 'travelPackage'])->latest()->get();
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
}
