@extends('admin.layout')

@section('content')
<div class="content container-fluid">
    <h3 class="mb-4">Xử lý yêu cầu hỗ trợ</h3>
    <div class="d-flex justify-content-between mb-3">
        <div>
            <select class="form-select" style="width: 200px;" id="statusFilter">
                <option value="">Lọc theo trạng thái</option>
                <option value="all">Tất cả</option>
                <option value="unresolved">Chưa xử lý</option>
                <option value="resolving">Đang xử lý</option>
                <option value="resolved">Đã xử lý</option>
            </select>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>Người gửi</th>
                    <th>Email</th>
                    <th>Trạng thái</th>
                    <th>Thời gian</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Nguyễn Văn A</td>
                    <td>nguyenA@gmail.com</td>
                    <td>
                        <select class="form-select status-select" data-id="1">
                            <option value="unresolved">Chưa xử lý</option>
                            <option value="resolving" selected>Đang xử lý</option>
                            <option value="resolved">Đã xử lý</option>
                        </select>
                    </td>
                    <td>1/6/2025 10:10</td>
                    <td><button class="btn btn-info btn-sm" onclick="respondRequest(1)">Phản hồi</button></td>
                </tr>
                <tr>
                    <td>Trần Thị B</td>
                    <td>tranB@gmail.com</td>
                    <td>
                        <select class="form-select status-select" data-id="2">
                            <option value="unresolved" selected>Chưa xử lý</option>
                            <option value="resolving">Đang xử lý</option>
                            <option value="resolved">Đã xử lý</option>
                        </select>
                    </td>
                    <td>12/6/2025 10:10</td>
                    <td><button class="btn btn-info btn-sm" onclick="respondRequest(2)">Phản hồi</button></td>
                </tr>
                <tr>
                    <td>Lê Minh C</td>
                    <td>leC@gmail.com</td>
                    <td>
                        <select class="form-select status-select" data-id="3">
                            <option value="unresolved">Chưa xử lý</option>
                            <option value="resolving">Đang xử lý</option>
                            <option value="resolved" selected>Đã xử lý</option>
                        </select>
                    </td>
                    <td>21/6/2025 10:10</td>
                    <td><button class="btn btn-info btn-sm" onclick="respondRequest(3)">Phản hồi</button></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Function to apply status colors
    function applyStatusColors() {
        document.querySelectorAll('.status-select').forEach(select => {
            select.classList.remove('status-unresolved', 'status-resolving', 'status-resolved');
            select.classList.add('status-' + select.value);
        });
    }

    // Apply colors on page load
    document.addEventListener('DOMContentLoaded', applyStatusColors);

    // Lọc theo trạng thái (mô phỏng)
    document.getElementById('statusFilter').addEventListener('change', function() {
        const status = this.value.toLowerCase();
        const rows = document.querySelectorAll('tbody tr');

        rows.forEach(row => {
            const rowStatus = row.querySelector('.status-select').value;
            if (status === '' || status === 'all' || rowStatus === status) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

    // Cập nhật trạng thái khi thay đổi dropdown
    document.querySelectorAll('.status-select').forEach(select => {
        select.addEventListener('change', function() {
            applyStatusColors();
        });
    });

    // Hàm phản hồi yêu cầu (mô phỏng)
    function respondRequest(id) {
        Swal.fire({
            icon: 'success',
            title: 'Thông báo',
            text: `Phản hồi yêu cầu ID ${id} thành công!`,
            position: 'top',
            showConfirmButton: true,
            confirmButtonText: 'OK',
            customClass: {
                popup: 'rounded',
                confirmButton: 'btn btn-success mx-auto'
            },
            buttonsStyling: false
        });
    }
</script>

<style>
    .status-select {
        width: 120px;
        display: inline-block;
        color: #fff; /* Keep text white for all statuses */
        font-weight: bold;
    }

    .status-unresolved {
        background-color: #dc3545; /* Red for Unresolved */
        border-color: #dc3545;
    }

    .status-resolving {
        background-color: #ffc107; /* Yellow/Orange for Resolving */
        border-color: #ffc107;
        /* Removed 'color: #343a40;' here */
    }

    .status-resolved {
        background-color: #28a745; /* Green for Resolved */
        border-color: #28a745;
    }
</style>
@endsection