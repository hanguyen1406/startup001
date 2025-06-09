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
      <section class="container mt-5" style="margin-bottom: 70px">
        <div class="col-12 col-md">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a class="title-alt" href="{{ route('home') }}">Trang chủ</a>
              </li>
              <li class="breadcrumb-item main-color">Thông tin vé</li>
            </ol>
          </nav>
        </div>

        <div class="col-12 col-md text-center">
          <h1 class="main-color">{{ $data->name }}</h1>
          <span class="title-alt">{{ $data->location }}</span>
        </div>
      </section>

      <!--=============== Package Travel ===============-->
      <section class="container detail">
        <div class="swiper mySwiper detail-container">
          <div class="swiper-wrapper">
              
            @foreach($data->galleries as $gallery)
                <div class="detail-card swiper-slide">
                    <img
                        src="{{ Storage::url($gallery->path) }}"
                        alt=""
                        class="detail-img"
                    />
                </div>
            @endforeach

          </div>
        </div>

        <div class="row" style="margin-top: 120px">
          <div class="col-12 col-md-12 col-lg-7 mb-5">
            <div class="card border-0 p-2">
              <h3 class="fw-bolder title mb-4">{{ $data->name }}</h3>
              {{ $data->description }}
            </div>
          </div>
          <div class="col-12 col-md-12 col-lg-5">
            <form action="{{ route('service.order', ['id'=>$data->id, 'type'=>'travel']) }}" method="post">
            @csrf  
              <div class="card bordered card-form" style="padding: 30px 40px">
                <h4 class="text-center">Thông tin vé</h4>
                <div
                  class="alert alert-secondary"
                  style="background-color: #f5f5f5; border: 1px solid #f5f5f5"
                  role="alert"
                >
                  Thời gian : {{ $data->duration }}
                </div>
                <div
                  class="alert alert-secondary"
                  style="background-color: #f5f5f5; border: 1px solid #f5f5f5"
                  role="alert"
                >
                  Giá vé :
                  <span class="text-gray-500 font-weight-light"
                    >{{ number_format($data->price) }} vnđ</span
                  >
                </div>
              <div class="align-items-center justify-content-around">
                <input
                  type="text"
                  class="form-control mb-1"
                  placeholder="Họ và tên"
                  name="name"/>
                <input type="text" class="mb-1 form-control" placeholder="Số điện thoại" name="phone"/>  
                <input
                  type="number"
                  class="form-control mb-1"
                  placeholder="Số lượng"
                  name="count"
                />
                <x-flatpickr 
                  name="travel_date" 
                  class="form-control"
                  placeholder="Ngày đi" 
                  date-format="d/m/Y"
                  :config="[
                    'dateFormat' => 'Y-m-d',          // Format gửi về
                    'altInput' => true,
                    'altFormat' => 'd/m/Y',           // Format hiển thị cho người dùng
                  ]"
                />

              </div>
              <button
                type="submit"
                class="btn btn-book btn-block mt-3"
                onclick="return confirm('Chắc chắn đặt vé này?')"
              >
                Đặt vé ngay
              </button>
              </div>
            </form>
          </div>
        </div>
      </section>
    </main>
@endsection

@push('style-alt')
    <link rel="stylesheet" href="{{ asset('frontend/assets/libraries/swipper/css/style.css') }}">
    <style>
        .swiper-container-3d .swiper-slide-shadow-left,
        .swiper-container-3d .swiper-slide-shadow-right {
        background-image: none;
      }
      figure{
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
      }
      figure table {
        --bs-table-bg: transparent;
        --bs-table-accent-bg: transparent;
        --bs-table-striped-color: #212529;
        --bs-table-striped-bg: rgba(0, 0, 0, 0.05);
        --bs-table-active-color: #212529;
        --bs-table-active-bg: rgba(0, 0, 0, 0.1);
        --bs-table-hover-color: #212529;
        --bs-table-hover-bg: rgba(0, 0, 0, 0.075);
        width: 100%;
        margin-bottom: 1rem;
        color: #212529;
        vertical-align: top;
        border-color: #dee2e6;
      }

      tbody, td, tfoot, th, thead, tr {
        border-color: inherit;
        border-style: solid;
      }
      table>:not(caption)>*>*{
        border: 1px solid #dee2e6;
      }
      table>:not(caption)>*>* {
        padding: 0.5rem 0.5rem;
        background-color: transparent;
        border-bottom-width: 1px;
        box-shadow: inset 0 0 0 9999px transparent;
      }
    </style>
@endpush

@push('script-alt')
    <script src="{{ asset('frontend/assets/libraries/swipper/js/app.js') }}"></script>
     <script>
      var swiper = new Swiper(".mySwiper", {
        effect: "coverflow",
        grabCursor: true,
        centeredSlides: true,
        slidesPerView: "auto",
        loop: true,
        spaceBetween: 32,
        coverflowEffect: {
          rotate: 0,
        },
      });
    </script>
@endpush
