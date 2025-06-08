@include('flatpickr::components.style')
@include('flatpickr::components.script')
@extends('admin.layout')
@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Danh sách các vé đã đặt</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
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

    <!-- Danh sách vé -->
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
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                
                    <tr>
                        <td>{{ $order->name }}</td>
                        <td>{{ $order->phone }}</td>
                        <td>{{ $order->travelPackage->name }}</td>
                        <td>
                            <select class="form-control payment-status" data-order-id="{{ $order->id }}">
                                <option value="0" {{ $order->payment_status == 0 ? 'selected' : '' }}>Chưa thanh toán</option>
                                <option value="1" {{ $order->payment_status == 1 ? 'selected' : '' }}>Đã thanh toán</option>
                            </select>
                        </td>
                        <td>{{ $order->count }}</td>
                        <td>{{ \Carbon\Carbon::parse($order->travel_date)->format('d/m/Y') }}</td>
                        <td>
                            <i class="fas fa-save fa-2x text-primary"></i>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".payment-status").forEach(select => {
        select.addEventListener("change", function() {
            let orderId = this.getAttribute("data-order-id");
            let newStatus = this.value;

            fetch(`/admin/orders/${orderId}/update-status`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                },
                body: JSON.stringify({ payment_status: newStatus })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("Cập nhật trạng thái thành công!");
                } else {
                    alert("Có lỗi xảy ra!");
                }
            });
        });
    });
});
</script>

@endsection
