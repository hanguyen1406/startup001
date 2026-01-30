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
    .swiper-slide-shadow-right {
      height: 0% !important;
    }

    .swiper-slide-shadow-left {
      height: 0% !important;
    }

    .swiper-wrapper {
      height: fit-content !important;
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
      background-color: rgba(0, 0, 0, 0.5);
      /* Nền đen mờ */
      border-radius: 50%;
      /* Bo tròn */
      padding: 20px;
      /* Tăng kích thước vùng bấm */
      background-size: 50% 50%;
      /* Chỉnh kích thước mũi tên */
    }

    .carousel-control-prev,
    .carousel-control-next {
      width: 10%;
      /* Thu hẹp vùng bấm 2 bên để đỡ che ảnh */
      opacity: 0.8 !important;
      /* Luôn hiển thị rõ */
    }

    .carousel-control-prev:hover,
    .carousel-control-next:hover {
      opacity: 1 !important;
      background-color: rgba(0, 0, 0, 0.1);
      /* Hiệu ứng hover nhẹ */
    }
  </style>
  <main>
    <div class="container my-4">
      <div class="row">
        <!-- Hình ảnh và lịch trình -->
        <div class="col-md-8">
          @if($data->galleries->count() > 0)
            <div id="tourCarousel" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-inner">
                @foreach($data->galleries as $key => $gallery)
                  <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                    <img src="{{ Storage::url($gallery->path) }}" class="d-block w-100 tour-image" alt="{{ $data->name }}"
                      style="height: 400px; object-fit: cover; border-radius: 10px;">
                  </div>
                @endforeach
              </div>
              @if($data->galleries->count() > 1)
                <button class="carousel-control-prev" type="button" data-bs-target="#tourCarousel" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#tourCarousel" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              @endif
            </div>
          @else
            <img src="https://via.placeholder.com/600" class="tour-image" alt="{{ $data->name }}"
              style="width: 100%; height: 400px; object-fit: cover; border-radius: 10px;">
          @endif

          <h4 class="tour-title mt-3">{{ $data->name }}</h4>

          <h6 class="mt-4"><strong>📝 Mô tả chi tiết</strong></h6>
          <p>{!! nl2br(e($data->description)) !!}</p>

          <button onclick="window.location.href='{{ route('order', ['id' => $data->id]) }}'"
            class="btn btn-book me-3 mt-3">✅ Đặt ngay</button>
          <a href="{{ route('service.all', ['type' => 'travel']) }}" class="btn-back mt-3">← Quay lại danh sách chuyến
            đi</a>
        </div>

        <!-- Thông tin chung -->
        <div class="col-md-4">
          <div class="info-box">
            <h6><strong>🧳 Thông tin chung</strong></h6>
            <p><strong>Điểm đến:</strong> {{ $data->location }}</p>
            <p><strong>Thời gian:</strong> {{ $data->duration }}</p>
            <p><strong>Loại hình:</strong> {{ $data->category ? $data->category->title : 'N/A' }}</p>
            <p><strong>Giá:</strong> <span class="text-danger fw-bold">{{ number_format($data->price) }} VNĐ</span>/người
            </p>
          </div>
        </div>
      </div>
    </div>
  </main>
@endsection