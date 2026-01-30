<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Hiển thị form đăng nhập
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Xử lý đăng nhập
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Kiểm tra role và chuyển hướng
            if ($user->is_admin) {
                return redirect()->route('admin.dashboard')->with('success', 'Đăng nhập với quyền Admin!');
            }

            return redirect()->route('home')->with('success', 'Đăng nhập thành công!');
        }

        return back()->withErrors(['email' => 'Sai email hoặc mật khẩu'])->withInput();
    }

    /**
     * Hiển thị form đăng ký
     */
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    /**
     * Xử lý đăng ký
     */
    public function register(Request $request)
    {
        // Kiểm tra dữ liệu nhập vào
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Tạo user mới
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => 0, // Lưu role được chọn
        ]);

        // Đăng nhập user sau khi đăng ký
        Auth::login($user);

        // Chuyển hướng dựa trên role
        if ($user->is_admin) {
            return redirect()->route('admin.dashboard')->with('success', 'Đăng ký thành công với quyền Admin!');
        }

        return redirect()->route('home')->with('success', 'Đăng ký thành công!');
    }

    /**
     * Đăng xuất
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Đã đăng xuất!');
    }
}
