@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h5 class="mb-4 fw-bold">Lịch sử đặt vé</h5>

    <table class="table table-bordered text-center align-middle">
        <thead class="table-secondary">
            <tr>
                <th>Mã vé</th>
                <th>Tour</th>
                <th>Ngày đặt</th>
                <th>Số lượng</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th>Chi tiết</th>
            </tr>
        </thead>
        <tbody class="table-light">
            @for ($i = 1; $i <= 7; $i++)
            <tr>
                <td>#{{ $i }}</td>
                <td>Hà Nội</td>
                <td>30/02/2029</td>
                <td>{{ sprintf('%02d', ($i % 3) + 1) }}</td>
                <td>{{ number_format((($i % 3) + 1) * 1000000, 0, ',', '.') }} VND</td>
                <td class="text-success">Đã thanh toán</td>
                <td>
                    <a href="/ticketbooked" title="Xem chi tiết">
                        <i class="bi bi-eye"></i>
                    </a>
                </td>
            </tr>
            @endfor
        </tbody>
    </table>

    <!-- Trang -->
    <div class="d-flex justify-content-end pe-2">
        <small class="text-muted">&lt; 1/20 &gt;</small>
    </div>
</div>

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
@endsection
