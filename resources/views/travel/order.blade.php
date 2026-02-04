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
        background-color: #ff6699;
        /* màu hồng */
        font-weight: bold;
        width: 100%;
        font-size: 18px;
        padding: 12px;
        border: none;
        color: white;
        border-radius: 30px;
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
        @if(isset($travelPackage) && $travelPackage->galleries->count() > 0)
          <img src="{{ Storage::url($travelPackage->galleries[0]->path) }}" alt="{{ $travelPackage->name }}">
        @else
          <img src="https://via.placeholder.com/600" alt="No Image">
        @endif
        <div class="image-caption">{{ isset($travelPackage) ? $travelPackage->name : 'Vui lòng chọn chuyến đi' }}</div>
      </div>

      <!-- Form thông tin vé -->
      <div class="col-md-5">
        <div class="form-section">
          <h5>🧾 Thông tin vé</h5>

          <form action="{{ route('order.store') }}" method="POST">
            @csrf

            <!-- Hidden Input for Travel ID -->
            @if(isset($travelPackage))
              <input type="hidden" name="travel_id" value="{{ $travelPackage->id }}">
              <div class="mb-3">
                <label class="form-label text-primary">Đang đặt vé cho: <strong>{{ $travelPackage->name }}</strong></label>
              </div>
            @else
              <!-- Fallback or selection if no ID passed (Optional logic) -->
              <div class="mb-3">
                <input type="number" name="travel_id" class="form-control" placeholder="Nhập ID Tour (Tạm thời)" required>
              </div>
            @endif

            <div class="mb-3">
              <label class="form-label">Giá vé:</label>
              @if(isset($travelPackage) && $travelPackage->discount_percentage > 0)
                <div>
                  <span class="text-muted text-decoration-line-through small">{{ number_format($travelPackage->price) }}
                    VND</span>
                  <span class="text-danger fw-bold ms-2">{{ number_format($travelPackage->discounted_price) }} VND</span>
                </div>
              @else
                <input type="text" class="form-control"
                  value="{{ isset($travelPackage) ? number_format($travelPackage->price) . ' VND' : '---' }}" disabled>
              @endif
            </div>

            <div class="mb-3">
              <label class="form-label">Tên người đại diện:</label>
              <input type="text" name="name" class="form-control" placeholder="Họ tên"
                value="{{ Auth::user() ? Auth::user()->name : '' }}" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Số điện thoại:</label>
              <input id="phone" type="text" name="phone" class="form-control" placeholder="Số điện thoại" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Số lượng vé:</label>
              <input type="number" name="quantity" class="form-control" placeholder="Số lượng vé" value="1" min="1"
                required>
            </div>

            <div class="mb-3">
              <label class="form-label">Ngày check-in:</label>
              <input type="date" name="travel_date" class="form-control" value="{{ date('Y-m-d') }}" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Phương thức thanh toán:</label>
              <select name="payment_method" class="form-select">
                <option value="bank">Thanh toán qua ngân hàng trực tuyến</option>
                <option value="cash">Thanh toán khi đến nơi</option>
                <option value="wallet">Ví điện tử</option>
              </select>
            </div>

            <button type="submit" class="btn btn-submit btn-success">
              Đặt vé ngay
            </button>
          </form>

        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@endsection