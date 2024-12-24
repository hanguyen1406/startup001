<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\TravelPackage;
use App\Mail\StoreContactMail;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\StoreEmailRequest;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
    public function home() : View
    {
        $categories = Category::with('travel_packages')->get();

        return view('home', compact('categories'));
    }

    public function detail(TravelPackage $travelPackage): View
    {
        return view('detail', compact('travelPackage'));
    }
    public function order(TravelPackage $travelPackage, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'travel_date' => 'required|date',
            'count' => 'required|integer|min:1',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->with('message', 'Điền thiếu thông tin hoặc thông tin không hợp lệ');
        }
        $order = Order::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'travel_date' => $request->travel_date,
            'travel_id' => $travelPackage->id,
            'count' => $request->count
        ]);

        return redirect()->route('detail', $travelPackage)
    ->with('message', 'Đặt vé thành công, chúng tôi sẽ liên hệ lại ngay!');

    }
    

    public function package(){
        $travelPackages = TravelPackage::with('galleries')->get();

        return view('package', compact('travelPackages'));
    }

    public function contact(){
        return view('contact');
    }

    public function getEmail(StoreEmailRequest $request){
        $detail = [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message
        ];

        return back()->with('message', 'Cảm ơn đã gửi báo cáo, chúng tôi sẽ liên hệ lại ngay!');
    }
}
