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
    public function home() : View
    {
        $categories = Category::with(['travel_packages' => function ($query) {
            $query->with(['galleries']);
        }])->get();

        return view('home', compact('categories'));
    }

    public function myTickets()
    {
        $orders = Order::with('travelPackage')->get(); // Lấy danh sách vé của user hiện tại
        return view('my_ticket', compact('orders'));
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
        return view('history');
    }
    public function profile()
    {

        return view('profile');
    }
    public function ticketbooked()
    {
        return view('ticketbooked');
    }
    public function order()
    {
        return view('travel.order');
    }
    public function updateLogin()
    {
        return view('updateLogin');
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
