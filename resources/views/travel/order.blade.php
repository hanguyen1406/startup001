@extends('layouts.app')

@section('content')
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
<div class="container my-4">
     <style>
    .form-section {
      background-color: #ffe6e6;
      padding: 20px;
      border-radius: 10px;
    }

    .form-section h5 {
      font-weight: bold;
      margin-bottom: 15px;
    }

    .btn-submit {
      background-color: #fbb;
      font-weight: bold;
      width: 100%;
    }

    .image-box img {
      width: 100%;
      border-radius: 8px;
      max-height: 300px;
      object-fit: cover;
    }

    .image-caption {
      text-align: center;
      background: #eee;
      padding: 10px;
      font-weight: 500;
    }

    .form-control:disabled {
      background-color: #f8f8f8;
    }
  </style>
  <div class="row">
    <!-- Hình ảnh -->
    <div class="col-md-7 image-box">
      <img src="https://media.istockphoto.com/id/478073811/vi/anh/l%E1%BB%91i-v%C3%A0o-%C4%91%E1%BA%B9p-t%E1%BA%A1i-v%C4%83n-mi%E1%BA%BFu-qu%E1%BB%91c-t%E1%BB%AD-gi%C3%A1m.jpg?s=612x612&w=0&k=20&c=FXgEWvQQLlDi9iP8tacv4_QbnjyaAGWlT2Pij_awKTc=">
      <div class="image-caption">Văn miếu Quốc Tử Giám</div>
    </div>

    <!-- Form thông tin vé -->
    <div class="col-md-5">
      <div class="form-section">
        <h5>🧾 Thông tin vé</h5>

        <div class="mb-3">
          <label class="form-label">Thời gian:</label>
          <input type="text" class="form-control" value="3h" disabled>
        </div>

        <div class="mb-3">
          <label class="form-label">Giá vé:</label>
          <input type="text" class="form-control" value="237.000 vnd" disabled>
        </div>

        <div class="mb-3">
          <input type="text" class="form-control" placeholder="Họ tên">
        </div>

        <div class="mb-3">
          <input type="text" class="form-control" placeholder="Số điện thoại">
        </div>

        <div class="mb-3">
          <input type="number" class="form-control" placeholder="Số lượng vé">
        </div>

        <div class="mb-3">
          <input type="date" class="form-control" value="2025-06-15">
        </div>

        <div class="mb-3">
          <select class="form-select">
            <option selected>Thanh toán qua ngân hàng trực tuyến</option>
            <option>Thanh toán khi đến nơi</option>
            <option>Ví điện tử</option>
          </select>
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
        </script>

      </div>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@endsection