@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <a href="{{ route('history') }}" class="text-decoration-none">&larr; Lịch sử đặt vé/Chi tiết vé đã đặt</a>

    <div class="mt-4">
        <h5 class="fw-bold mb-3">Thông tin chuyến đi</h5>
        <p><strong>Điểm đến:</strong> Hà nội</p>
        <p><strong>Ngày khởi hành:</strong> 15/03/2029</p>
        <p><strong>Giá vé:</strong> 2,000,000 VND</p>
        <hr style="border-top: 3px solid #ccc; width: 100%;"> 

        <h5 class="fw-bold mb-3">Thông tin khách hàng</h5>
        <p><strong>Họ tên:</strong> Nguyễn Văn A</p>
        <p><strong>Email:</strong> nguyenvana@gmail.com</p>
        <p><strong>Số Điện Thoại:</strong> 0434634848</p>
        <hr style="border-top: 3px solid #ccc; width: 100%;">

        <h5 class="fw-bold mb-3">Thông tin vé</h5>
        <p><strong>Mã vé:</strong> #3</p>
        <p><strong>Trạng thái:</strong> Đã thanh toán</p>
        <p><strong>Ngày đặt:</strong> 30/02/2029</p>
    </div>
</div>
@endsection
