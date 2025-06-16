@include('flatpickr::components.style')
@include('flatpickr::components.script')
@extends('layouts.app')

@section('content')
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <style>
      .swiper-slide-shadow-right{
        height: 0% !important;
      }
      .swiper-slide-shadow-left{
        height: 0% !important;
      }
      .swiper-wrapper {
        height: fit-content !important;
      }
    </style>
    <main>
      <div class="container my-4">
  <div class="row">
    <!-- Hình ảnh và lịch trình -->
    <div class="col-md-8">
      <img src="https://media.istockphoto.com/id/478073811/vi/anh/l%E1%BB%91i-v%C3%A0o-%C4%91%E1%BA%B9p-t%E1%BA%A1i-v%C4%83n-mi%E1%BA%BFu-qu%E1%BB%91c-t%E1%BB%AD-gi%C3%A1m.jpg?s=612x612&w=0&k=20&c=FXgEWvQQLlDi9iP8tacv4_QbnjyaAGWlT2Pij_awKTc=" class="tour-image" alt="Văn Miếu Quốc Tử Giám">

      <h4 class="tour-title">Văn miếu Quốc Tử Giám</h4>

      <h6><strong>📝 Lịch trình chi tiết</strong></h6>
      <ul class="mb-4">
        <li class="schedule-day"><strong>Ngày 1:</strong> Khởi hành từ TP.HCM → Đến Đà Lạt → Tham quan Thung lũng Tình yêu</li>
        <li class="schedule-day"><strong>Ngày 2:</strong> Dạo quanh hồ Xuân Hương → Tham quan Dinh Bảo Đại → Vườn hoa thành phố</li>
        <li class="schedule-day"><strong>Ngày 3:</strong> Mua sắm đặc sản → Trả phòng → Khởi hành về TP.HCM</li>
      </ul>

      <button onclick="window.location.href='/order'" class="btn btn-book me-3">✅ Đặt ngay</button>
      <a href="/detail/travel" class="btn-back">← Quay lại danh sách chuyến đi</a>
    </div>

    <!-- Thông tin chung -->
    <div class="col-md-4">
      <div class="info-box">
        <h6><strong>🧳 Thông tin chung</strong></h6>
        <p><strong>Điểm đến:</strong> Đà Lạt</p>
        <p><strong>Ngày khởi hành:</strong> 15/06/2025</p>
        <p><strong>Thời gian:</strong> 3 ngày 2 đêm</p>
        <p><strong>Phương tiện:</strong> Xe giường nằm</p>
        <p><strong>Loại hình:</strong> Tour nghỉ dưỡng</p>
        <p><strong>Giá:</strong> 3.200.000đ/người</p>
      </div>
    </div>
  </div>
</div>
    </main>
@endsection


