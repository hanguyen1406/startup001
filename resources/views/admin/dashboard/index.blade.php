@extends('admin.layout')
@section('content')
<div class="container-fluid">
    <!-- Tiêu đề trang -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Bảng điều khiển</h1>
    </div>

    <!-- Dòng thống kê -->
    <div class="row">

        <!-- Người dùng -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow h-100 py-2 border-start border-primary border-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-xs fw-bold text-primary text-uppercase mb-1">Người dùng</div>
                            <div class="h5 mb-0 fw-bold text-gray-800">10,000</div>
                        </div>
                        <div class="bg-primary text-white rounded-circle p-3">
                            <i class="fas fa-users fa-lg"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chuyến đi -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow h-100 py-2 border-start border-success border-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-xs fw-bold text-success text-uppercase mb-1">Chuyến đi</div>
                            <div class="h5 mb-0 fw-bold text-gray-800">5,000</div>
                        </div>
                        <div class="bg-success text-white rounded-circle p-3">
                            <i class="fas fa-route fa-lg"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Vé đã đặt -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow h-100 py-2 border-start border-warning border-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-xs fw-bold text-warning text-uppercase mb-1">Vé đã đặt</div>
                            <div class="h5 mb-0 fw-bold text-gray-800">5,000</div>
                        </div>
                        <div class="bg-warning text-white rounded-circle p-3">
                            <i class="fas fa-ticket-alt fa-lg"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Doanh thu -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow h-100 py-2 border-start border-danger border-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-xs fw-bold text-danger text-uppercase mb-1">Doanh thu</div>
                            <div class="h5 mb-0 fw-bold text-gray-800">5,000,000₫</div>
                        </div>
                        <div class="bg-danger text-white rounded-circle p-3">
                            <i class="fas fa-coins fa-lg"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
