@extends('layouts.app')

@section('content')
<div class="container mt-4">
  <div class="row">
    
    <!-- Profile Card -->
    <div class="col-md-4">
      <div class="profile-card">
        <img width="200" src="https://www.dabico.com/wp-content/uploads/2025/04/default-avatar-profile-icon-social-media-user-image-gray-avatar-icon-blank-profile-silhouette-illustration-vector.jpg" alt="Avatar" class="profile-avatar">
        <h5>Người dùng Hạ</h5>
        <p class="text-muted">Cập nhật thông tin cá nhân</p>
        <a href="{{ route('updateLogin') }}" class="text-decoration-none">> Thông tin đăng nhập</a>
      </div>
    </div>

    <!-- Form Thông tin -->
    <div class="col-md-8">
      <div class="form-section">
        <h6 class="text-warning"><i class="bi bi-info-circle"></i> Thông tin cá nhân</h6>
        <p class="text-muted">Thông tin này chỉ được sử dụng để cá nhân hoá trải nghiệm của bạn.<br>
        Thông tin của bạn sẽ được lưu trữ an toàn và không công khai.</p>

        <form onsubmit="submitForm(event)">
          <div class="mb-3">
            <label for="name" class="form-label">Họ và tên</label>
            <input type="text" class="form-control" id="name" placeholder="Nhập tên của bạn">
          </div>
          <div class="mb-3">
            <label for="phone" class="form-label">Số điện thoại</label>
            <input type="text" class="form-control" id="phone" placeholder="Nhập số điện thoại">
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" placeholder="mail">
          </div>
          <div class="mb-3">
            <label for="address" class="form-label">Địa chỉ</label>
            <input type="text" class="form-control" id="address" placeholder="Nhập địa chỉ">
          </div>
          <button onclick="showSuccessAlert()" class="btn btn-success">
            Đặt vé ngay
            </button>

            <script>
            function showSuccessAlert() {
                Swal.fire({
                icon: 'success',
                title: 'Thêm chuyến đi thành công',
                confirmButtonText: 'OK',
                confirmButtonColor: '#3085d6',
                background: '#e6f7ff'
                });
            }
            function submitForm(e) {
            e.preventDefault(); // Chặn reload
            }

            </script>
        </form>
      </div>
    </div>

  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
