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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TravelController extends Controller
{
    public function home(): View
    {
        $categories = Category::with([
            'travel_packages' => function ($query) {
                $query->with(['galleries']);
            }
        ])->get();

        return view('home', compact('categories'));
    }




    public function detail()
    {

        return view('travel.detail');
    }
    public function forget()
    {

        return view('forget');
    }
    public function reset()
    {

        return view('reset');
    }
    public function history()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $orders = Order::where('user_id', Auth::id())->with('travelPackage')->latest()->get();
        return view('history', compact('orders'));
    }
    public function profile()
    {

        return view('profile');
    }
    public function ticketbooked()
    {
        return view('ticketbooked');
    }
    public function order(Request $request)
    {
        // Nếu có ID tour truyền vào thì lấy thông tin tour
        $travelPackage = null;
        if ($request->has('id')) {
            $travelPackage = TravelPackage::with('galleries')->find($request->id);
        }
        return view('travel.order', compact('travelPackage'));
    }

    public function storeOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'travel_date' => 'required|date',
            'travel_id' => 'required|exists:travel_packages,id',
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('message', 'Vui lòng kiểm tra lại thông tin!');
        }

        if (!Auth::check()) {
            return redirect()->route('login')->with('message', 'Vui lòng đăng nhập để đặt vé!');
        }

        $travel = TravelPackage::find($request->travel_id);
        $totalPrice = $travel->price * $request->quantity;

        Order::create([
            'user_id' => Auth::id(),
            'travel_id' => $request->travel_id,
            'name' => $request->name,
            'phone' => $request->phone,
            'travel_date' => $request->travel_date,
            'total_price' => $totalPrice, // Lưu tổng tiền
            'status' => 'pending',
            'count' => $request->quantity,
        ]);

        return redirect()->route('history')->with('message', 'Đặt vé thành công! Vui lòng chờ xác nhận.');
    }
    public function updateLogin()
    {
        return view('updateLogin');
    }

    public function package()
    {
        $travelPackages = TravelPackage::with('galleries')->get();

        return view('package', compact('travelPackages'));
    }

    public function contact()
    {
        return view('contact');
    }

    public function getEmail(StoreEmailRequest $request)
    {
        $detail = [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message
        ];

        return back()->with('message', 'Cảm ơn đã gửi báo cáo, chúng tôi sẽ liên hệ lại ngay!');
    }
}
