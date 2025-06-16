@extends('admin.layout')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800 font-weight-bold">Quản lý chuyến đi</h1>

    <div class="d-flex mb-3">
        <select class="form-control mr-2" style="width: 200px;">
            <option>Điểm khởi hành</option>
            <option>Hà Nội</option>
            <option>Hồ Chí Minh</option>
        </select>

        <select class="form-control mr-2" style="width: 200px;">
            <option>Điểm đến</option>
            <option>Đà Lạt</option>
            <option>Hải Phòng</option>
        </select>

        <a href="{{ route('admin.travel-packages.create') }}" class="btn btn-success">Thêm chuyến đi</a>

        <div class="ml-auto">
            <input type="text" class="form-control" placeholder="Tìm kiếm chuyến đi..." style="width: 250px;">
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered text-center">
            <thead class="bg-primary text-white">
                <tr>
                    <th>Id</th>
                    <th>Điểm đi</th>
                    <th>Điểm đến</th>
                    <th>Ngày khởi hành</th>
                    <th>Giá</th>
                    <th>Phương tiện</th>
                    <th>Loại hình</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ([
                    ['id' => '#T001', 'from' => 'Hà Nội', 'to' => 'Đà Lạt', 'date' => '1/6/2025', 'price' => '3,500,000đ', 'transport' => 'Máy bay', 'type' => 'Nghỉ dưỡng', 'edit_id' => 1],
                    ['id' => '#T002', 'from' => 'Hà Nội', 'to' => 'Hải Phòng', 'date' => '1/6/2025', 'price' => '4,200,000đ', 'transport' => 'Máy bay', 'type' => 'Trọn gói', 'edit_id' => 2],
                    ['id' => '#T003', 'from' => 'Hà Nội', 'to' => 'Quảng Ninh', 'date' => '15/7/2025', 'price' => '2,800,000đ', 'transport' => 'Ô tô', 'type' => 'Nghỉ dưỡng', 'edit_id' => 3]
                ] as $package)
                <tr>
                    <td>{{ $package['id'] }}</td>
                    <td>{{ $package['from'] }}</td>
                    <td>{{ $package['to'] }}</td>
                    <td>{{ $package['date'] }}</td>
                    <td>{{ $package['price'] }}</td>
                    <td>{{ $package['transport'] }}</td>
                    <td>{{ $package['type'] }}</td>
                    <td>
                        <a href="{{ route('admin.travel-packages.edit', $package['edit_id']) }}" class="text-primary mr-2"><i class="fas fa-edit"></i></a>
                        <a href="#" class="text-danger delete-btn" data-id="{{ $package['edit_id'] }}"><i class="fas fa-trash-alt"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const packageId = this.getAttribute('data-id');

            Swal.fire({
                title: 'Xác nhận xóa chuyến đi',
                text: 'Bạn có chắc chắn muốn xóa chuyến đi này không? Hành động không thể hoàn tác!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Xác nhận xóa',
                cancelButtonText: 'Hủy bỏ',
                customClass: {
                    popup: 'rounded',
                    confirmButton: 'btn btn-danger mx-2',
                    cancelButton: 'btn btn-secondary mx-2'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    // Simulate deletion (replace with actual AJAX call in production)
                    console.log(`Chuyến đi ${packageId} đã được xóa!`);

                    Swal.fire({
                        icon: 'success',
                        title: 'Thành công!',
                        text: 'Xóa chuyến đi thành công!',
                        showConfirmButton: false,
                        timer: 2000,
                        customClass: {
                            popup: 'rounded',
                            confirmButton: 'btn btn-primary mx-auto'
                        },
                        buttonsStyling: false
                    });

                    // Optionally remove the row from the table
                    this.closest('tr').remove();
                }
            });
        });
    });
</script>
@endsection