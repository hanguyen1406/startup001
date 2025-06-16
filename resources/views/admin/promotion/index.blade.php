@extends('admin.layout')

@section('content')
<div class="content container-fluid">
    <h3 class="mb-4">Quản lý khuyến mãi</h3>
    <div class="d-flex justify-content-between mb-3">
        <div>
            <a href="{{ route('admin.promotion.create') }}" class="btn btn-success">+ Thêm khuyến mãi</a>
            <select class="form-select ms-2 btn" style="width: 200px;">
                <option value="">Lọc theo trạng thái</option>
                <option value="active">Đang hoạt động</option>
                <option value="expired">Hết hạn</option>
            </select>
        </div>
        <div>
            <input type="text" class="form-control" placeholder="Tìm kiếm khuyến mãi..." style="width: 250px;">
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>Mã</th>
                    <th>Tên khuyến mãi</th>
                    <th>Giảm giá</th>
                    <th>Ngày bắt đầu</th>
                    <th>Ngày kết thúc</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>KM1</td>
                    <td>Test1</td>
                    <td>10%</td>
                    <td>1/6/2025</td>
                    <td>1/6/2025</td>
                    <td class="status-active">Đang hoạt động</td>
                    <td>
                        <a href="{{ route('admin.promotion.edit', 1) }}" class="action-btn"><i class="fas fa-edit"></i></a>
                        <a href="#" class="action-btn text-danger delete-btn" data-id="1"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
                <tr>
                    <td>KM1</td>
                    <td>test2</td>
                    <td>50%</td>
                    <td>1/6/2025</td>
                    <td>1/6/2025</td>
                    <td class="status-expired">Hết hạn</td>
                    <td>
                        <a href="{{ route('admin.promotion.edit', 2) }}" class="action-btn"><i class="fas fa-edit"></i></a>
                        <a href="#" class="action-btn text-danger delete-btn" data-id="2"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const promotionId = this.getAttribute('data-id');

            // Hiển thị thông báo xác nhận ở phía trên
            Swal.fire({
                title: 'Xác nhận xóa khuyến mãi',
                text: 'Bạn có chắc chắn muốn xóa khuyến mãi này không? Hành động không thể hoàn tác!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'OK',
                cancelButtonText: 'Cancel',
                position: 'top',
                customClass: {
                    popup: 'rounded',
                    confirmButton: 'btn btn-danger mx-2',
                    cancelButton: 'btn btn-secondary mx-2'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    // Hiển thị thông báo thành công ở góc trên trong 2 giây
                    Swal.fire({
                        icon: 'success',
                        title: 'Đã xóa thành công!',
                        text: 'Khuyến mãi đã được xóa thành công.',
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000,
                        toast: true,
                        customClass: {
                            popup: 'rounded',
                            confirmButton: 'btn btn-primary mx-auto'
                        },
                        buttonsStyling: false
                    }).then(() => {
                        this.closest('tr').remove(); // Xóa hàng khỏi bảng
                    });
                }
            });
        });
    });
</script>
@endsection