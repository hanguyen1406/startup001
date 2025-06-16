@extends('layouts.app')

@section('content')
<div class="container mt-5">
  <div class="row justify-content-center">
    <!-- Cột bên trái: Thẻ hồ sơ người dùng -->
    <div class="col-md-4 d-flex justify-content-center mb-4">
      <div class="card text-center p-4 shadow-sm" style="border-radius: 15px; width: 100%; max-width: 320px;">
        <img width="120" src="https://www.dabico.com/wp-content/uploads/2025/04/default-avatar-profile-icon-social-media-user-image-gray-avatar-icon-blank-profile-silhouette-illustration-vector.jpg" class="rounded-circle mb-3" alt="Avatar" width="120" height="120">
        <h5 class="mb-0">Người dùng Hạ</h5>
        <p class="text-muted">Cập nhật thông tin cá nhân</p>
        <a href="{{ route('updateLogin') }}" class="text-decoration-none text-primary">> Thông tin đăng nhập</a>
      </div>
    </div>

    <!-- Cột bên phải: Form nhập thông tin -->
    <div class="col-md-8">
      <div class="card shadow-sm p-4" style="border-radius: 15px;">
        <h5 class="text-warning"><i class="bi bi-info-circle"></i> Thông tin cá nhân</h5>
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
          <button type="submit" class="btn btn-success w-100 fw-bold">
            Cập nhật thông tin
          </button>
        </form>
      </div>
    </div>

  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  function showSuccessAlert() {
    Swal.fire({
      icon: 'success',
      title: 'Cập nhật thành công',
      confirmButtonText: 'OK',
      confirmButtonColor: '#3085d6',
      background: '#e6f7ff'
    });
  }

  function submitForm(e) {
    e.preventDefault();
    showSuccessAlert();
  }
</script>
@endsection
