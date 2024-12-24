@extends('admin.layout')

@section('content')
<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Danh sách các vé đã đặt</h1>
</div>

<!-- Content Row -->
<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-4 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                           Tổng vé</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">10k</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-hotel fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-4 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Doanh thu</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">5k</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tên Khách Hàng</th>
                <th>Số Điện Thoại</th>
                <th>Tên Vé</th>
                <th>Trạng Thái Thanh Toán</th>
                <th>Số Lượng</th>
                <th>Ngày Đặt</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->customer_name }}</td>
                    <td>{{ $order->customer_phone }}</td>
                    <td>{{ $order->travel_package_name }}</td>
                    <td>{{ $order->payment_status }}</td>
                    <td>{{ $order->number_of_tickets }}</td>
                    <td>{{ $order->order_date }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection