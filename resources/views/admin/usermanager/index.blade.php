@extends('admin.layout')
@section('content')
<div class="container-fluid">
    <h3 class="mb-4 text-gray-800">Quản lý người dùng</h3>

    <!-- Tìm kiếm -->
    <div class="d-flex justify-content-end mb-3">
        <input type="text" class="form-control w-25" placeholder="Tìm kiếm...">
    </div>

    <!-- Bảng người dùng -->
    <div class="table-responsive">
        <table class="table table-bordered text-center">
            <thead class="table-primary">
                <tr>
                    <th>ID</th>
                    <th>Họ tên</th>
                    <th>Email</th>
                    <th>Vai trò</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <!-- Dữ liệu giả -->
                <tr>
                    <td>#001</td>
                    <td>Nguyễn Thị A</td>
                    <td>nguyena@gmail.com</td>
                    <td>
                        <select class="form-select">
                            <option selected>Khách hàng</option>
                            <option>Quản trị viên</option>
                        </select>
                    </td>
                    <td>
                        <select class="form-select text-success fw-bold">
                            <option selected class="text-success">Hoạt động</option>
                            <option class="text-danger">Tạm khóa</option>
                        </select>
                    </td>
                    <td>
                        <button onclick="showSuccessToast()" class="btn btn-sm btn-primary me-2">
                            <i class="fas fa-save"></i>
                        </button>
                        <button class="btn btn-sm btn-danger">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>#001</td>
                    <td>Nguyễn Thị A</td>
                    <td>nguyena@gmail.com</td>
                    <td>
                        <select class="form-select">
                            <option selected>Khách hàng</option>
                            <option>Quản trị viên</option>
                        </select>
                    </td>
                    <td>
                        <select class="form-select text-success fw-bold">
                            <option class="text-success">Hoạt động</option>
                            <option selected class="text-danger">Tạm khóa</option>
                        </select>
                    </td>
                    <td>
                        <button onclick="showSuccessToast()" class="btn btn-sm btn-primary me-2">
                            <i class="fas fa-save"></i>
                        </button>
                        <button class="btn btn-sm btn-danger">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
                <!-- Thêm dòng bằng vòng lặp nếu dùng dữ liệu thật -->
            </tbody>
        </table>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function showSuccessToast() {
    Swal.fire({
        icon: 'success',
        title: 'Cập nhật thông tin người dùng thành công!',
        toast: true,
        position: 'top',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        background: '#eeeeee',
        iconColor: '#00c851',
        customClass: {
            popup: 'rounded shadow-sm'
        }
    });
}
</script>

@endsection
