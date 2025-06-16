@extends('admin.layout')

@section('content')
<div class="content container-fluid">
    <h3 class="mb-4">Quản lý khuyến mãi</h3>
    <h4>Thêm khuyến mãi mới</h4>
    <form method="POST" id="promotionForm">
        @csrf
        <div class="mb-3">
            <label for="code" class="form-label">Mã</label>
            <input type="text" class="form-control" id="code" name="code" value="KM3" required>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Tên khuyến mãi</label>
            <input type="text" class="form-control" id="name" name="name" value="Giảm giá lên đến 2/9" required>
        </div>
        <div class="mb-3">
            <label for="discount" class="form-label">Giảm giá</label>
            <input type="text" class="form-control" id="discount" name="discount" value="25%" required>
        </div>
        <div class="mb-3">
            <label for="start_date" class="form-label">Ngày bắt đầu</label>
            <input type="date" class="form-control" id="start_date" name="start_date" value="2025-09-01" required>
        </div>
        <div class="mb-3">
            <label for="end_date" class="form-label">Ngày kết thúc</label>
            <input type="date" class="form-control" id="end_date" name="end_date" value="2025-09-03" required>
        </div>
        <button type="submit" class="btn btn-success">Thêm</button>
        <a href="{{ route('admin.promotion.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('promotionForm').addEventListener('submit', function(e) {
        e.preventDefault(); // Ngăn chặn submit mặc định để mô phỏng

        const startDate = new Date(document.getElementById('start_date').value);
        const endDate = new Date(document.getElementById('end_date').value);
        const currentDate = new Date(); // Lấy ngày hiện tại (05:04 PM +07, 16/06/2025)

        // Kiểm tra nếu ngày bắt đầu lớn hơn ngày kết thúc
        if (startDate > endDate) {
            Swal.fire({
                icon: 'error',
                title: 'Thông báo',
                text: 'Thao tác không thành công vì ngày bắt đầu lớn hơn ngày kết thúc!',
                showConfirmButton: true,
                confirmButtonText: 'OK',
                customClass: {
                    popup: 'rounded',
                    confirmButton: 'btn btn-primary mx-auto'
                },
                buttonsStyling: false
            });
        } else {
            // Giả lập gửi dữ liệu và phản hồi thành công
            Swal.fire({
                icon: 'success',
                text: 'Thêm khuyến mãi thành công!',
                showConfirmButton: false,
                timer: 2000,
                customClass: {
                    popup: 'rounded',
                    confirmButton: 'btn btn-primary mx-auto'
                },
                buttonsStyling: false
            }).then(() => {
                // Sau khi thông báo, chuyển hướng về trang danh sách (mô phỏng)
                window.location.href = '{{ route('admin.promotion.index') }}';
            });
        }
    });
</script>
@endsection