@extends('layouts.app')

@section('content')
<main>
      <!--=============== HOME ===============-->
      <section
        class="hero"
        id="hero"
        style="
          background-repeat: no-repeat;
          background-size: cover;
          height: 100vh;
          background-image: url('https://images.unsplash.com/photo-1605752660759-2db7b7de8fa9?ixid=MnwxMjA3fDB8MHxzZWFyY2h8MXx8c2VuZ2dpZ2klMjBiZWFjaHxlbnwwfHwwfHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=60');
        "
      >
        <div
          class="hero-content h-100 d-flex justify-content-center align-items-center flex-column"
        >
          <h1 class="text-center text-white display-4">
            Khám phá vẻ đẹp quê hương Việt Nam
          </h1>
          <a href="#package" class="btn btn-hero mt-5">Đặt vé ngay</a>
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

      <!--=============== Package ===============-->
      @foreach($categories as $category)
      <section class="container package text-center" id="package">
        <h2 class="section-title">{{ $category->title }}</h2>
        <hr width="40" class="text-center" />
        <div class="row mt-5 justify-content-center">

        @foreach($category->travel_packages as $travelPackage)
          <div class="col-lg-3" style="margin-bottom: 140px">
            <div class="card package-card">
              <a href="{{ route('detail', $travelPackage) }}" class="package-link">
                <div class="package-wrapper-img overflow-hidden">
                  <img
                    src="{{ Storage::url($travelPackage->galleries->first()->path) }}"
                    class="img-fluid"
                  />
                </div>
                <div class="package-price d-flex justify-content-center">
                  <span class="btn btn-light position-absolute package-btn">
                    {{ number_format($travelPackage->price) }} vnđ
                  </span>
                </div>
                <h5 class="btn position-absolute w-100">
                  {{ $travelPackage->name }}
                </h5>
              </a>
            </div>
          </div>
        @endforeach

        </div>
      </section>
      @endforeach

      <!--=============== Video ===============-->
      <section class="container text-center">
        <h2 class="section-title">Video Tour</h2>
        <hr width="40" class="text-center" />
        <div class="row mt-5">
          <div class="col-12">
            <iframe
              width="100%"
              height="500px"
              src="https://www.youtube.com/embed/5O1ZmJvK-yI?controls=1"
            >
            </iframe>
          </div>
        </div>
      </section>

    </main>
@endsection
