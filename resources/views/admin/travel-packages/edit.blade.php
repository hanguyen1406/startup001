@extends('admin.layout')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Sửa chuyến đi</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Chỉnh sửa thông tin chuyến đi
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <form role="form" action="#" method="POST"> {{-- Replace # with your update route --}}
                                @csrf
                                @method('PUT') {{-- Use PUT for updates --}}

                                <div class="form-group">
                                    <label>ID</label>
                                    <input class="form-control" placeholder="ID" disabled value="00022"> {{-- ID is usually not editable --}}
                                </div>
                                <div class="form-group">
                                    <label>Điểm khởi hành</label>
                                    <input class="form-control" name="departure_point" value="Hà Nội">
                                </div>
                                <div class="form-group">
                                    <label>Ngày khởi hành</label>
                                    <input type="date" class="form-control" name="departure_date" value="2025-06-03"> {{-- Use type="date" for date pickers --}}
                                </div>
                                <div class="form-group">
                                    <label>Giá tiền ( VND )</label>
                                    <input class="form-control" name="price" value="3,500,000 VND"> {{-- Consider using number type and formatting on display --}}
                                </div>
                                <div class="form-group">
                                    <label>Loại hình du lịch</label>
                                    <select class="form-control" name="travel_type">
                                        <option value="nghi_duong" selected>Nghỉ dưỡng</option>
                                        <option value="kham_pha">Khám phá</option>
                                        <option value="tham_quan">Tham quan</option>
                                        {{-- Add more options as needed --}}
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Phương tiện di chuyển</label>
                                    <select class="form-control" name="transportation">
                                        <option value="may_bay" selected>Máy bay</option>
                                        <option value="o_to">Ô tô</option>
                                        <option value="tau_hoa">Tàu hỏa</option>
                                        {{-- Add more options as needed --}}
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Mô tả</label>
                                    <textarea class="form-control" rows="3" name="description">Thích ăn gà</textarea>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-6">
                             <form role="form" action="#" method="POST"> {{-- This second form is just for layout, typically you'd have one form --}}
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>Tên chuyến đi</label>
                                    <input class="form-control" name="trip_name" value="Du lịch">
                                </div>
                                <div class="form-group">
                                    <label>Điểm đến</label>
                                    <input class="form-control" name="destination_point" value="Cà Mau">
                                </div>
                                {{-- You would add any other fields that logically belong in this column if not already in the first column's form --}}
                            </form>
                        </div>
                        </div>
                    <div class="row">
                        <div class="col-lg-12 text-right">
                             <button onclick="confirmSubmit(event)" type="submit" class="btn btn-primary">Sửa chuyến đi</button> {{-- This button should be part of the main form --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</div>
    <script>
        function confirmSubmit(event) {
            event.preventDefault(); // Prevent the default form submission
            Swal.fire({
            icon: 'success',
            text: 'Sửa chuyến đi thành công.',
            confirmButtonText: 'OK',
            customClass: {
                popup: 'rounded',
                confirmButton: 'btn btn-primary mx-auto'
            },
            buttonsStyling: false
            }).then((result) => {
                window.location.href = "{{ route('admin.travel-packages.index') }}"; // Redirect to the index page after confirmation
            });
        }
    
    </script>
@endsection