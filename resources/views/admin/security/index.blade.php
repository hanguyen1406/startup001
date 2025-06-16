@extends('admin.layout')

@section('content')
<div class="content container-fluid">
    <h3 class="mb-4">Bảo mật, Sao lưu & Giám sát</h3>
    <div class="d-flex justify-content-between mb-3">
        <div>
            <button class="btn btn-primary tab-button active" data-tab="security">🔐 Cài đặt bảo mật</button>
            <button class="btn btn-primary tab-button" data-tab="backup">💾 Sao lưu dữ liệu</button>
            <button class="btn btn-primary tab-button" data-tab="monitor">📊 Giám sát hoạt động</button>
        </div>
    </div>

    <div class="tab-content">
        <!-- Cài đặt bảo mật -->
        <div class="tab-pane fade show active" id="security" role="tabpanel">
            <div class="card">
                <div class="card-header">Cài đặt bảo mật</div>
                <div class="card-body">
                    <form id="securityForm">
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="two_factor_auth" name="two_factor_auth" checked>
                            <label class="form-check-label" for="two_factor_auth">Bật xác thực hai lớp (2FA)</label>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="auto_logout" name="auto_logout">
                            <label class="form-check-label" for="auto_logout">Tự động đăng xuất sau 15 phút không hoạt động</label>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="alert_unusual_login" name="alert_unusual_login" checked>
                            <label class="form-check-label" for="alert_unusual_login">Gửi cảnh báo khi đăng nhập bất thường</label>
                        </div>
                        <button type="submit" class="btn btn-success">Lưu cài đặt</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sao lưu dữ liệu -->
        <div class="tab-pane fade" id="backup" role="tabpanel">
            <div class="card">
                <div class="card-header">Sao lưu dữ liệu</div>
                <div class="card-body">
                    <p>Lần sao lưu gần nhất: <strong>04/06/2025 - 22:00</strong></p>
                    <button class="btn btn-primary mb-3" id="backupBtn">Sao lưu ngay</button>
                    <p>Lịch sao lưu tự động: <strong>Hàng ngày lúc 23:00</strong></p>
                </div>
            </div>
        </div>

        <!-- Giám sát hoạt động -->
        <div class="tab-pane fade" id="monitor" role="tabpanel">
            <div class="card">
                <div class="card-header">Giám sát hoạt động</div>
                <div class="card-body">
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>Thời gian</th>
                                <th>Tài khoản</th>
                                <th>Hành động</th>
                                <th>IP</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>05/06/2025 10:32</td>
                                <td>admin1</td>
                                <td>Đăng nhập</td>
                                <td>192.168.1.12</td>
                            </tr>
                            <tr>
                                <td>05/06/2025 10:35</td>
                                <td>admin1</td>
                                <td>Cập nhật khuyến mãi</td>
                                <td>192.168.1.12</td>
                            </tr>
                            <tr>
                                <td>05/06/2025 10:50</td>
                                <td>admin2</td>
                                <td>Xem yêu cầu hỗ trợ</td>
                                <td>192.168.1.13</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .tab-pane.active {
        background-color: #d1e7dd; /* Màu xanh nhạt, bạn có thể thay đổi thành màu xanh khác nếu muốn */
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Chuyển đổi tab
    document.querySelectorAll('.tab-button').forEach(button => {
        button.addEventListener('click', function() {
            document.querySelectorAll('.tab-button').forEach(btn => btn.classList.remove('active'));
            document.querySelectorAll('.tab-pane').forEach(tab => tab.classList.remove('show', 'active'));

            this.classList.add('active');
            document.getElementById(this.getAttribute('data-tab')).classList.add('show', 'active');
        });
    });

    // Xử lý form cài đặt bảo mật
    document.getElementById('securityForm').addEventListener('submit', function(e) {
        e.preventDefault();
        Swal.fire({
            icon: 'success',
            text: 'Cài đặt bảo mật đã được lưu thành công!',
            position: 'top',
            showConfirmButton: true,
            confirmButtonText: 'OK',
            customClass: {
                popup: 'rounded',
                confirmButton: 'btn btn-success mx-auto'
            },
            buttonsStyling: false
        });
    });

    // Xử lý nút sao lưu
    document.getElementById('backupBtn').addEventListener('click', function(e) {
        Swal.fire({
            icon: 'success',
            text: 'Sao lưu dữ liệu thành công!',
            position: 'top',
            showConfirmButton: true,
            confirmButtonText: 'OK',
            customClass: {
                popup: 'rounded',
                confirmButton: 'btn btn-success mx-auto'
            },
            buttonsStyling: false
        });
    });
</script>
@endsection