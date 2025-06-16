@extends('layouts.app')

@section('content')
<div class="container mt-5">
  <div class="row justify-content-center align-items-start">

    <!-- Sidebar: Hồ sơ người dùng -->
    <div class="col-md-4 d-flex justify-content-center mb-4">
      <div class="card text-center p-4 shadow-sm" style="border-radius: 10px; width: 100%; max-width: 320px;">
        <div class="bg-primary text-white py-3 rounded-top" style="background: linear-gradient(135deg, #27a5e2, #3cc1e8);">
          <img src="https://www.dabico.com/wp-content/uploads/2025/04/default-avatar-profile-icon-social-media-user-image-gray-avatar-icon-blank-profile-silhouette-illustration-vector.jpg" alt="Avatar" class="rounded-circle bg-white p-1" width="90">
        </div>
        <div class="mt-3">
          <h6 class="fw-bold">Người dùng Hạ</h6>
          <p class="mb-1 text-muted">Cập nhật thông tin cá nhân</p>
          <a href="/profile" class="d-block text-decoration-none text-primary">Thông tin đăng nhập &gt;</a>
        </div>
      </div>
    </div>

    <!-- Form: Đặt lại mật khẩu mới -->
    <div class="col-md-6">
      <div class="card p-4 shadow-sm" style="border-radius: 12px; background: #f9f9f9;">
        <h5 class="mb-3 text-dark"><i class="bi bi-shield-lock-fill text-warning me-2"></i>Khôi phục mật khẩu?</h5>

        <form id="resetPasswordForm">
          <div class="mb-3">
            <label class="form-label">Nhập mật khẩu mới</label>
            <input type="password" class="form-control" placeholder="Nhập mật khẩu mới" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Nhập lại mật khẩu mới</label>
            <input type="password" class="form-control" placeholder="Nhập lại mật khẩu" required>
          </div>
          <button type="submit" class="btn btn-warning px-4">Xác nhận</button>
        </form>
      </div>
    </div>

  </div>
</div>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  document.getElementById('resetPasswordForm').addEventListener('submit', function(e) {
    e.preventDefault();
    Swal.fire({
    icon: 'success',
    title: 'Đặt lại mật khẩu thành công!',
    text: 'Bạn có thể đăng nhập với mật khẩu mới.',
    confirmButtonText: 'OK',
    customClass: {
        popup: 'rounded',
        confirmButton: 'btn btn-primary mx-auto'
    },
    buttonsStyling: false
    }).then((result) => {
    if (result.isConfirmed) {
        window.location.href = '/profile'; // hoặc route cụ thể của bạn
    }
    });

  });
</script>
@endsection
