@extends('layouts.app')
@if (session('success'))
  <div class="alert alert-success">
    {{ session('success') }}
  </div>
@endif
@section('content')
  <main>
    <style>
      .highlight-section {
        background-color: #e0e0e0;
        padding: 30px 0;
      }

      .trip-card {
        background-color: white;
        border-radius: 10px;
        height: 200px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-weight: bold;
      }
    </style>
    <!--=============== HOME ===============-->
    <section class="hero" id="hero" style="
                      background-repeat: no-repeat;
                      background-size: cover;
                      height: 100vh;
                      background-image: url('https://images.unsplash.com/photo-1605752660759-2db7b7de8fa9?ixid=MnwxMjA3fDB8MHxzZWFyY2h8MXx8c2VuZ2dpZ2klMjBiZWFjaHxlbnwwfHwwfHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=60');
                    ">
      <div class="hero-content h-100 d-flex justify-content-center align-items-center flex-column">
        <h1 class="text-center text-white display-4">
          Khám phá thế giới theo cách của bạn
        </h1>
        <h3 style="color:white">Hơn 500 chuyến đi khắp mọi miền tổ quốc & quốc tế</h3>
        <a href="/detail/travel" class="btn btn-hero mt-5">Tìm chuyến đi ngay</a>
      </div>
    </section>
    <section>
      <div class="container py-5">
        <h5 class="text-center mb-4">Tìm kiếm chuyến đi</h5>

        <div class="row justify-content-center">
          <form action="/detail/travel" method="GET" class="row justify-content-center w-100">
            <div class="col-md-3">
              <input type="text" name="location" class="form-control" placeholder="Điểm đến (VD: Đà Lạt)">
            </div>
            <div class="col-md-3">
              <input type="text" name="keyword" class="form-control" placeholder="Tên tour...">
            </div>
            <div class="col-md-2">
              <input type="date" name="date" class="form-control" value="{{ date('Y-m-d') }}">
            </div>
            <div class="col-md-2">
              <button type="submit" class="btn btn-success w-100" style="color:white">Tìm kiếm</button>
            </div>
          </form>
        </div>
      </div>

      <div class="highlight-section">
        <div class="container">
          <h6 class="mb-4"><strong>Chuyến đi nổi bật</strong></h6>
          <div class="row justify-content-center g-4">
            @foreach($categories->pluck('travel_packages')->collapse()->take(3) as $package)
                <div class="col-md-3">
                  <div class="card h-100">
                    <img
                      src="{{ isset($package->galleries[0]) ? Storage::url($package->galleries[0]->path) : 'https://via.placeholder.com/300' }}"
                      class="card-img-top" alt="{{ $package->name }}" style="height: 200px; object-fit: cover;">
                    <div class="card-body d-flex flex-column">
                      <h5 class="card-title text-center">{{ $package->name }}</h5>
                      <div class="text-muted text-center mb-3 small d-flex flex-column align-items-center">
                        <div class="fw-bold w-100 text-truncate"><i class="bx bxs-map"></i> {{ $package->departure ?? '?' }}
                        </div>
                        <div class="my-1"><i class="bx bx-down-arrow-alt"></i></div>
                        <div class="fw-bold w-100 text-truncate"><i class="bx bxs-map-pin"></i> {{ $package->location }}</div>
                      </div>
                      @if($package->discount_percentage > 0)
                        <p class="card-text text-muted text-decoration-line-through small text-center mb-0">
                          {{ number_format($package->price) }} VND</p>
                        <p class="card-text text-danger fw-bold text-center mt-auto mb-2">
                          {{ number_format($package->discounted_price) }} VND</p>
                      @else
                        <p class="card-text text-danger fw-bold text-center mt-auto mb-2">{{ number_format($package->price) }}
                          VND</p>
                      @endif
                      <button onclick="window.location.href='/detail/travel?id={{ $package->id }}'"
                        class="btn btn-primary w-100">Xem chi tiết</button>
                    </div>
                  </div>
                </div>
              @endforeach
          </div>
        </div>
      </div>

    </section>
    <!--=============== Why us ===============-->
    <section class="container why-us text-center">
      <h2 class="section-title">Tại sao lên chọn chúng tôi</h2>
      <hr width="40" class="text-center" />
      <div class="row mt-5">
        <div class="col-lg-4 mb-3">
          <div class="card pt-4 pb-3 px-2">
            <div class="why-us-content">
              <i class="bx bx-money why-us-icon mb-4"></i>
              <h4 class="mb-3">Tiết kiệm chi phí</h4>
              <p>
                Gói kỳ nghỉ giá cả phải chăng và chất lượng cho mọi loại khách du lịch
              </p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 mb-3">
          <div class="card pt-4 pb-3 px-2">
            <div class="why-us-content">
              <i class="bx bxs-heart why-us-icon mb-4"></i>
              <h4 class="mb-3">An toàn</h4>
              <p>
                Đảm bảo sự an toàn và thoải mái của bạn thông qua các tiêu chuẩn vận hành chuyên nghiệp
              </p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 mb-3">
          <div class="card pt-4 pb-3 px-2">
            <div class="why-us-content">
              <i class="bx bx-timer why-us-icon mb-4"></i>
              <h4 class="mb-3">Tối ưu thời gian</h4>
              <p>
                Bạn không cần phải bối rối trong việc lựa chọn khách sạn hay nhà hàng, chúng tôi sẽ sắp xếp mọi việc.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>


    <!--=============== Video ===============-->
    <section class="container text-center">
      <h2 class="section-title">Video Tour</h2>
      <hr width="40" class="text-center" />
      <div class="row mt-5">
        <div class="col-12">
          <iframe width="100%" height="500px" src="https://www.youtube.com/embed/5O1ZmJvK-yI?controls=1">
          </iframe>
        </div>
      </div>
    </section>

  </main>
@endsection