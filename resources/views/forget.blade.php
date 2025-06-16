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

    <!-- Form: Nhập mã xác minh -->
    <div class="col-md-6">
      <div class="card p-4 shadow-sm" style="border-radius: 12px; background: #f9f9f9;">
        <h5 class="mb-3 text-dark"><i class="bi bi-shield-lock-fill text-warning me-2"></i>Khôi phục mật khẩu?</h5>
        <p class="text-muted">Nhập mã xác minh gửi đến email của bạn</p>

        <form id="verifyForm">
          <div class="mb-3">
            <input type="text" class="form-control" placeholder="Nhập mã xác minh" required>
          </div>

          <button type="submit" class="btn btn-warning px-4">
            Xác nhận
          </button>
        </form>
      </div>
    </div>

  </div>
</div>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  document.getElementById('verifyForm').addEventListener('submit', function(e) {
    e.preventDefault();
    Swal.fire({
    icon: 'success',
    title: 'Xác minh thành công!',
    text: 'Mời bạn tiếp tục đặt lại mật khẩu.',
    confirmButtonText: 'OK',
    customClass: {
        popup: 'rounded',
        confirmButton: 'btn btn-primary mx-auto'
    },
    buttonsStyling: false
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '/reset';
        }
    });

  });
</script>
@endsection
