@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800 font-weight-bold">Quản lý Đơn hàng</h1>

        @if(session('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered text-center w-100">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>ID</th>
                        <th>Khách hàng</th>
                        <th>Số điện thoại</th>
                        <th>Tour</th>
                        <th>Ngày đi</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td style="font-size: 0.85rem;">
                                <div>
                                    <a href="#" style="color: inherit;"><strong>{{ $order->name }}</strong></a>
                                </div>
                            </td>
                            <td>{{ $order->phone }}</td>
                            <td>{{ $order->travelPackage->name ?? 'N/A' }}</td>
                            <td>{{ $order->travel_date }}</td>
                            <td>{{ number_format($order->total_price) }} VND</td>
                            <td>
                                @if($order->status == 'pending')
                                    <span class="badge bg-warning text-dark">Chờ duyệt</span>
                                @elseif($order->status == 'confirmed')
                                    <span class="badge bg-success">Đã duyệt</span>
                                @elseif($order->status == 'cancelled')
                                    <span class="badge bg-danger">Đã hủy</span>
                                @else
                                    <span class="badge bg-info">{{ $order->status }}</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <form action="{{ route('admin.orders.update_status', $order->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    <input type="hidden" name="status" value="confirmed">
                                    <button type="submit" class="btn btn-sm btn-success" {{ $order->status == 'confirmed' ? 'disabled' : '' }}>
                                        <i class="fas fa-check"></i> Duyệt
                                    </button>
                                </form>
                                <form action="{{ route('admin.orders.update_status', $order->id) }}" method="POST"
                                    class="d-inline ms-1">
                                    @csrf
                                    <input type="hidden" name="status" value="cancelled">
                                    <button type="submit" class="btn btn-sm btn-danger" {{ $order->status == 'cancelled' ? 'disabled' : '' }}>
                                        <i class="fas fa-times"></i> Hủy
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-3">
            {{ $orders->links() }}
        </div>
    </div>
@endsection