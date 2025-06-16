@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">

        <!-- Sidebar Profile -->
        <div class="col-md-4 d-flex justify-content-center mb-4">
            <div class="card text-center p-4 shadow-sm" style="border-radius: 15px; width: 100%; max-width: 320px;">
                <img width="120" class="rounded-circle mb-3 mx-auto" src="https://www.dabico.com/wp-content/uploads/2025/04/default-avatar-profile-icon-social-media-user-image-gray-avatar-icon-blank-profile-silhouette-illustration-vector.jpg" alt="Avatar">
                <h5 class="mb-1">Người dùng Hạ</h5>
                <a href="/profile" class="d-block text-decoration-none text-primary mt-2">&gt; Cập nhật thông tin cá nhân</a>
                <a href="#" class="d-block text-decoration-none text-secondary mt-1">Thông tin đăng nhập</a>
            </div>
        </div>

        <!-- Login Info Form -->
        <div class="col-md-8">
            <div class="card p-4 shadow-sm" style="border-radius: 15px;">
                <h5 class="mb-3 text-warning"><i class="bi bi-lock-fill me-2"></i>Thông tin đăng nhập</h5>

                <form id="profileForm">
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" placeholder="Nhập email" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Mật khẩu cũ</label>
                        <input type="password" class="form-control" placeholder="Nhập mật khẩu cũ" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Mật khẩu mới</label>
                        <input type="password" class="form-control" placeholder="Nhập mật khẩu mới" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nhập lại mật khẩu mới</label>
                        <input type="password" class="form-control" placeholder="Nhập lại mật khẩu mới" required>
                    </div>

                    <a href="{{ route('forget') }}" class="d-block mb-3 text-primary text-end">Quên mật khẩu?</a>

                    <button type="submit" class="btn btn-warning w-100 fw-bold">
                        Lưu thay đổi
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('profileForm').addEventListener('submit', function (e) {
        e.preventDefault();

        Swal.fire({
            icon: 'success',
            title: 'Cập nhật thông tin thành công',
            confirmButtonText: 'OK',
            customClass: {
                popup: 'rounded',
                confirmButton: 'btn btn-primary mx-auto'
            },
            buttonsStyling: false
        });
    });
</script>
@endsection
