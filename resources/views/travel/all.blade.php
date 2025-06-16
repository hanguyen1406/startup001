@extends('layouts.app')

@section('content')
    <main>
      <style>
    .sidebar {
      background-color: #f5f7f7;
      padding: 20px;
      height: 100vh;
    }

    .filter-title {
      font-weight: bold;
      font-size: 18px;
      margin-bottom: 20px;
    }

    .trip-card {
      background-color: #f1f1f1;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 0 5px rgba(0,0,0,0.1);
    }

    .trip-card .image {
      background-color: #a8d0f0;
      height: 120px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
    }

    .trip-card .info {
      padding: 10px;
      background-color: #eaeaea;
    }
  </style>
      <div class="container-fluid">
  <div class="row">

    <!-- Sidebar: Bộ lọc -->
    <div class="col-md-3 sidebar">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="filter-title">
          <img src="https://img.icons8.com/emoji/24/000000/magnifying-glass-tilted-left-emoji.png" />
          Lọc nâng cao
        </div>
        <button class="btn btn-outline-dark btn-sm">Xóa lọc</button>
      </div>

      <form>
        <div class="mb-2">
          <label class="form-label">Điểm khởi hành</label>
          <input type="text" class="form-control" placeholder="VD: Hà Nội">
        </div>
        <div class="mb-2">
          <label class="form-label">Điểm đến</label>
          <input type="text" class="form-control" placeholder="VD: Đà Lạt">
        </div>
        <div class="mb-2">
          <label class="form-label">Ngày khởi hành</label>
          <input type="date" class="form-control">
        </div>
        <div class="mb-2">
          <label class="form-label">Loại hình du lịch</label>
          <select class="form-select">
            <option>Du lịch nghỉ dưỡng</option>
            <option>Du lịch khám phá</option>
          </select>
        </div>
        <div class="mb-2">
          <label class="form-label">Phương tiện</label>
          <select class="form-select">
            <option>Xe khách</option>
            <option>Máy bay</option>
            <option>Tàu hỏa</option>
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label">Mức giá</label>
          <input type="number" class="form-control" placeholder="VNĐ">
        </div>
        <button type="submit" class="btn btn-success w-100">Áp dụng</button>
      </form>
    </div>

    <!-- Main content: Kết quả -->
    <div class="col-md-9 py-4">
      <!-- Thanh tìm kiếm -->
      <div class="input-group mb-4">
        <input type="text" class="form-control" placeholder="Tìm kiếm chuyến đi...">
        <button class="btn btn-outline-secondary" type="button">Tìm kiếm</button>
      </div>

      <!-- Danh sách các chuyến đi -->
      <div class="row g-3">
        <!-- Card 1 -->
        <div class="col-md-3 col-sm-6">
          <div onclick="window.location.href='/ticket'" class="trip-card">
            <div class="image">Ảnh</div>
            <div class="info">
              <div><strong>Tên chuyến đi</strong></div>
              <div>Đánh giá: ★★★★☆</div>
              <div>Giá: 3.000.000 VNĐ</div>
              <div>Ưu đãi: -20%</div>
            </div>
          </div>
        </div>

        <!-- Copy thêm nhiều card tùy thích -->
        <!-- Card 2, Card 3, v.v -->
        <!-- Dưới đây là ví dụ copy lại -->
        <div class="col-md-3 col-sm-6">
          <div class="trip-card">
            <div class="image">Ảnh</div>
            <div class="info">
              <div><strong>Tên chuyến đi</strong></div>
              <div>Đánh giá: ★★★★☆</div>
              <div>Giá: 2.500.000 VNĐ</div>
              <div>Ưu đãi: -15%</div>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6">
          <div class="trip-card">
            <div class="image">Ảnh</div>
            <div class="info">
              <div><strong>Tên chuyến đi</strong></div>
              <div>Đánh giá: ★★★★☆</div>
              <div>Giá: 2.500.000 VNĐ</div>
              <div>Ưu đãi: -15%</div>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6">
          <div class="trip-card">
            <div class="image">Ảnh</div>
            <div class="info">
              <div><strong>Tên chuyến đi</strong></div>
              <div>Đánh giá: ★★★★☆</div>
              <div>Giá: 2.500.000 VNĐ</div>
              <div>Ưu đãi: -15%</div>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6">
          <div class="trip-card">
            <div class="image">Ảnh</div>
            <div class="info">
              <div><strong>Tên chuyến đi</strong></div>
              <div>Đánh giá: ★★★★☆</div>
              <div>Giá: 2.500.000 VNĐ</div>
              <div>Ưu đãi: -15%</div>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6">
          <div class="trip-card">
            <div class="image">Ảnh</div>
            <div class="info">
              <div><strong>Tên chuyến đi</strong></div>
              <div>Đánh giá: ★★★★☆</div>
              <div>Giá: 2.500.000 VNĐ</div>
              <div>Ưu đãi: -15%</div>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6">
          <div class="trip-card">
            <div class="image">Ảnh</div>
            <div class="info">
              <div><strong>Tên chuyến đi</strong></div>
              <div>Đánh giá: ★★★★☆</div>
              <div>Giá: 2.500.000 VNĐ</div>
              <div>Ưu đãi: -15%</div>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6">
          <div class="trip-card">
            <div class="image">Ảnh</div>
            <div class="info">
              <div><strong>Tên chuyến đi</strong></div>
              <div>Đánh giá: ★★★★☆</div>
              <div>Giá: 2.500.000 VNĐ</div>
              <div>Ưu đãi: -15%</div>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6">
          <div class="trip-card">
            <div class="image">Ảnh</div>
            <div class="info">
              <div><strong>Tên chuyến đi</strong></div>
              <div>Đánh giá: ★★★★☆</div>
              <div>Giá: 2.500.000 VNĐ</div>
              <div>Ưu đãi: -15%</div>
            </div>
          </div>
        </div>
        <!-- ... thêm bao nhiêu card tùy bạn -->
      </div>
    </div>

  </div>
</div>
    </main>
@endsection