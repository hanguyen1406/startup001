@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800 font-weight-bold">Quản lý Khuyến mãi</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>ID</th>
                        <th>Tên chuyến đi</th>
                        <th>Điểm khởi hành</th>
                        <th>Giá gốc</th>
                        <th>Giảm giá (%)</th>
                        <th>Giá sau giảm</th>
                        <th>Cập nhật</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($travelPackages as $package)
                        <tr>
                            <td>{{ $package->id }}</td>
                            <td>{{ $package->name }}</td>
                            <td>{{ $package->departure }}</td>
                            <td>{{ number_format($package->price) }}đ</td>
                            <form action="{{ route('admin.promotions.update', $package->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <td>
                                    <input type="number" name="discount_percentage" class="form-control text-center mx-auto"
                                        style="width: 80px;" value="{{ $package->discount_percentage }}" min="0" max="100">
                                </td>
                                <td class="font-weight-bold text-danger">
                                    {{ number_format($package->discounted_price) }}đ
                                </td>
                                <td>
                                    <button type="submit" class="btn btn-sm btn-success">
                                        <i class="fas fa-save"></i> Lưu
                                    </button>
                                </td>
                            </form>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center">
            {{ $travelPackages->links() }}
        </div>
    </div>
@endsection