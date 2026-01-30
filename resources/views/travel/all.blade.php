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
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
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
              <label class="form-label">Thể loại vé</label>
              <select class="form-select" name="category_id">
                <option value="">Tất cả</option>
                @foreach($categories as $category)
                  <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->title }}
                  </option>
                @endforeach
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
            @forelse($data as $package)
              <div class="col-md-3 col-sm-6">
                <div
                  onclick="window.location.href='{{ route('service.detail', ['type' => 'travel', 'id' => $package->id]) }}'"
                  class="trip-card h-100" style="cursor: pointer;">
                  <div class="image"
                    style="background-image: url('{{ isset($package->galleries[0]) ? Storage::url($package->galleries[0]->path) : 'https://via.placeholder.com/300' }}'); background-size: cover; background-position: center; height: 180px;">
                    @if(!isset($package->galleries[0]))
                      <span class="text-muted">No Image</span>
                    @endif
                  </div>
                  <div class="info">
                    <div class="mb-1 text-truncate" title="{{ $package->name }}"><strong>{{ $package->name }}</strong></div>
                    <div class="small text-muted"><i class="fas fa-map-marker-alt"></i> {{ $package->location }}</div>
                    <div class="text-danger fw-bold my-1">{{ number_format($package->price) }} VNĐ</div>
                    <!-- <div class="small text-success">Ưu đãi: -0%</div> -->
                  </div>
                </div>
              </div>
            @empty
              <div class="col-12 text-center py-5">
                <h5 class="text-muted">Không tìm thấy chuyến đi nào phù hợp.</h5>
              </div>
            @endforelse
          </div>
        </div>

      </div>
    </div>
  </main>
@endsection