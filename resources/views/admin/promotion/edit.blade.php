@extends('admin.layout')

@section('content')
<div class="content container-fluid">
    <h3 class="mb-4">Quản lý khuyến mãi</h3>
    <h4>Chỉnh sửa khuyến mãi</h4>
    <form method="POST" id="promotionEditForm">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="code" class="form-label">Mã</label>
            <input type="text" class="form-control" id="code" name="code" value="KM1" readonly>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Tên khuyến mãi</label>
            <input type="text" class="form-control" id="name" name="name" value="Test1" required>
        </div>
        <div class="mb-3">
            <label for="discount" class="form-label">Giảm giá</label>
            <input type="text" class="form-control" id="discount" name="discount" value="10%" required>
        </div>
        <div class="mb-3">
            <label for="start_date" class="form-label">Ngày bắt đầu</label>
            <input type="date" class="form-control" id="start_date" name="start_date" value="2025-06-01" required>
        </div>
        <div class="mb-3">
            <label for="end_date" class="form-label">Ngày kết thúc</label>
            <input type="date" class="form-control" id="end_date" name="end_date" value="2025-06-01" required>
        </div>
        <button type="submit" class="btn btn-success">Thêm</button>
        <a href="{{ route('admin.promotion.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('promotionEditForm').addEventListener('submit', function(e) {
        e.preventDefault(); // Ngăn chặn submit mặc định để mô phỏng

        const startDate = new Date(document.getElementById('start_date').value);
        const endDate = new Date(document.getElementById('end_date').value);

        // Kiểm tra nếu ngày bắt đầu lớn hơn ngày kết thúc
        if (startDate > endDate) {
            Swal.fire({
                icon: 'error',
                title: 'Thông báo',
                text: 'Thao tác không thành công vì ngày bắt đầu lớn hơn ngày kết thúc!',
                position: 'top',
                showConfirmButton: true,
                confirmButtonText: 'OK',
                customClass: {
                    popup: 'rounded',
                    confirmButton: 'btn btn-primary mx-auto'
                },
                buttonsStyling: false
            });
        } else {
            // Giả lập chỉnh sửa thành công
            Swal.fire({
                icon: 'success',
                title: 'Thông báo',
                text: 'Chỉnh sửa thành công!',
                position: 'top',
                showConfirmButton: true,
                confirmButtonText: 'OK',
                customClass: {
                    popup: 'rounded',
                    confirmButton: 'btn btn-success mx-auto'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '{{ route('admin.promotion.index') }}'; // Chuyển hướng về danh sách
                }
            });
        }
    });
</script>
@endsection