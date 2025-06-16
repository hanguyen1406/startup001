@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-4">
            <div class="profile-card p-4 text-center border rounded">
                <img width="150" class="rounded-circle mb-3" src="https://www.dabico.com/wp-content/uploads/2025/04/default-avatar-profile-icon-social-media-user-image-gray-avatar-icon-blank-profile-silhouette-illustration-vector.jpg" alt="Avatar">
                <h5>Người dùng Hạ</h5>
                <a href="/profile" class="d-block mt-2 text-decoration-none">&gt; Cập nhật thông tin cá nhân</a>
                <a href="#" class="d-block mt-1 text-decoration-none">Thông tin đăng nhập</a>
            </div>
        </div>

        <!-- Form -->
        <div class="col-md-8">
            <div class="card p-4">
                <h5><i class="bi bi-lock-fill me-2"></i>Thông tin đăng nhập</h5>

                <form id="profileForm">
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" class="form-control" placeholder="Nhập email" required>
                    </div>

                    <div class="mb-3">
                        <label>Mật khẩu cũ</label>
                        <input type="password" class="form-control" placeholder="Nhập mật khẩu cũ" required>
                    </div>
                    <div class="mb-3">
                        <label>Mật khẩu mới</label>
                        <input type="password" class="form-control" placeholder="Nhập mật khẩu mới" required>
                    </div>
                    <div class="mb-3">
                        <label>Nhập lại mật khẩu mới</label>
                        <input type="password" class="form-control" placeholder="Nhập lại mật khẩu mới" required>
                    </div>

                    <a href="#" class="d-block mb-3 text-primary">Quên mật khẩu?</a>

                    <button type="submit" class="btn btn-warning w-100">Lưu thay đổi</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- SweetAlert2 + Xử lý Submit -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('profileForm').addEventListener('submit', function(e) {
        e.preventDefault();

        Swal.fire({
            icon: 'success',
            title: 'Cập nhật thông tin thành công',
            confirmButtonText: 'OK',
            customClass: {
                popup: 'rounded',
                confirmButton: 'mx-auto btn btn-primary'
            },
            buttonsStyling: false
        });
    });
</script>
@endsection
