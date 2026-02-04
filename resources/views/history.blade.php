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
                            <a href="#" data-bs-toggle="modal" data-bs-target="#ticketModal-{{ $order->id }}"
                                title="Xem chi tiết">
                                <i class="bi bi-eye text-primary" style="font-size: 1.2rem;"></i>
                            </a>

                            <!-- Modal Chi tiết Vé -->
                            <div class="modal fade text-start" id="ticketModal-{{ $order->id }}" tabindex="-1"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title">Chi tiết vé #{{ $order->id }}</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body p-4">
                                            <div class="mb-3">
                                                <strong>Tour:</strong> {{ $order->travelPackage->name ?? 'N/A' }}
                                            </div>
                                            <div class="mb-3">
                                                <strong>Ngày đi:</strong>
                                                {{ \Carbon\Carbon::parse($order->travel_date)->format('d/m/Y') }}
                                            </div>
                                            <div class="mb-3">
                                                <strong>Số lượng:</strong> {{ $order->count }} người
                                            </div>
                                            <div class="mb-3">
                                                <strong>Tổng tiền:</strong> <span
                                                    class="text-danger fw-bold">{{ number_format($order->total_price) }}
                                                    VND</span>
                                            </div>
                                            <div class="mb-3">
                                                <strong>Trạng thái:</strong>
                                                @if($order->status == 'pending')
                                                    <span class="badge bg-warning text-dark">Chờ duyệt</span>
                                                @elseif($order->status == 'confirmed')
                                                    <span class="badge bg-success">Đã duyệt</span>
                                                @elseif($order->status == 'cancelled')
                                                    <span class="badge bg-danger">Đã hủy</span>
                                                @elseif($order->status == 'completed')
                                                    <span class="badge bg-primary">Hoàn thành</span>
                                                @endif
                                            </div>
                                            <hr>

                                            <div class="text-center mt-4">
                                                @if($order->status == 'confirmed')
                                                    <h6 class="text-success fw-bold mb-3">VÉ ĐIỆN TỬ (QR CODE)</h6>
                                                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ route('admin.orders.checkIn', $order->id) }}"
                                                        alt="QR Code" class="img-fluid border p-2 rounded">
                                                    <p class="small text-muted mt-2">Đưa mã này cho nhân viên để check-in</p>
                                                @elseif($order->status == 'completed')
                                                    <div class="alert alert-success">
                                                        <i class="bi bi-check-circle-fill"></i> Vé đã được sử dụng
                                                    </div>
                                                @elseif($order->status == 'cancelled')
                                                    <div class="alert alert-danger">
                                                        <i class="bi bi-x-circle-fill"></i> Vé đã bị hủy
                                                    </div>
                                                @else
                                                    <div class="alert alert-warning">
                                                        <i class="bi bi-exclamation-circle-fill"></i> Vui lòng thanh toán để nhận vé
                                                        điện tử (QR).
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Đóng</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
            {{ $orders->links() }}
        </div>
    </div>

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
@endsection