<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TravelPackage;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function index()
    {
        $travelPackages = TravelPackage::paginate(7);
        return view('admin.promotions.index', compact('travelPackages'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'discount_percentage' => 'required|integer|min:0|max:100',
        ]);

        $travelPackage = TravelPackage::findOrFail($id);
        $travelPackage->update(['discount_percentage' => $request->discount_percentage]);

        return redirect()->back()->with('success', 'Cập nhật khuyến mãi thành công!');
    }
}
