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
                @forelse($orders as $order)
                    <tr>
                        <td>#{{ $order->id }}</td>
                        <td>{{ $order->travelPackage->name ?? 'N/A' }}</td>
                        <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y') }}</td>
                        <td>{{ $order->count ?? 1 }}</td>
                        <td>{{ number_format($order->total_price) }} VND</td>
                        <td>
                            @if($order->status == 'pending')
                                <span class="text-warning fw-bold">Chờ duyệt</span>
                            @elseif($order->status == 'confirmed')
                                <span class="text-success fw-bold">Đã duyệt</span>
                            @elseif($order->status == 'cancelled')
                                <span class="text-danger fw-bold">Đã hủy</span>
                            @elseif($order->status == 'completed')
                                <span class="text-primary fw-bold">Hoàn thành</span>
                            @else
                                {{ $order->status }}
                            @endif
                        </td>
                        <td>
                            <a href="#" title="Xem chi tiết">
                                <i class="bi bi-eye"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Bạn chưa có lịch sử đặt vé nào.</td>
                    </tr>
                @endforelse
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