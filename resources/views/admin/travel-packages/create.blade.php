@extends('admin.layout')

@section('content')
<div class="container-fluid">
    <h2 style="font-weight: bold;">Thêm chuyến đi mới</h2>
    <form action="{{ route('admin.travel-packages.store') }}" method="POST">
        @csrf

        <div style="display: flex; gap: 20px;">
            <div style="flex: 1;">
                <label>ID</label>
                <input type="text" class="form-control" value="Tự động" disabled>
            </div>

            <div style="flex: 1;">
                <label>Tên chuyến đi</label>
                <input type="text" name="title" class="form-control" placeholder="Nhập tên chuyến đi">
            </div>
        </div>

        <div style="display: flex; gap: 20px; margin-top: 10px;">
            <div style="flex: 1;">
                <label>Điểm khởi hành</label>
                <input type="text" name="departure" class="form-control" placeholder="Nhập điểm khởi hành">
            </div>
            <div style="flex: 1;">
                <label>Điểm đến</label>
                <input type="text" name="destination" class="form-control" placeholder="Nhập điểm đến">
            </div>
        </div>

        <div style="margin-top: 10px;">
            <label>Ngày khởi hành</label>
            <input type="date" name="departure_date" class="form-control">
        </div>

        <div style="margin-top: 10px;">
            <label>Giá tiền (VND)</label>
            <input type="number" name="price" class="form-control" placeholder="Nhập mức giá">
        </div>

        <div style="margin-top: 10px;">
            <label>Loại hình du lịch</label>
            <select name="category" class="form-control">
                <option value="">Chọn loại hình du lịch</option>
                <option value="nghiduong">Nghỉ dưỡng</option>
                <option value="trongoi">Trọn gói</option>
            </select>
        </div>

        <div style="margin-top: 10px;">
            <label>Phương tiện di chuyển</label>
            <select name="transportation" class="form-control">
                <option value="">Chọn loại phương tiện</option>
                <option value="maybay">Máy bay</option>
                <option value="tauhoa">Tàu hỏa</option>
            </select>
        </div>

        <div style="margin-top: 10px;">
            <label>Mô tả</label>
            <textarea name="description" class="form-control" placeholder="Nhập mô tả" rows="3"></textarea>
        </div>

        <button onclick="confirmSubmit(event)" type="submit" style="margin-top: 20px; background-color: #0000FF; color: white; padding: 10px 20px; border: none;">
            Lưu chuyến đi
        </button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function confirmSubmit(event) {
        event.preventDefault(); // Ngăn chặn gửi form ngay lập tức

        Swal.fire({
        icon: 'success',
        text: 'Thêm mới chuyến đi thành công.',
        confirmButtonText: 'OK',
        customClass: {
            popup: 'rounded',
            confirmButton: 'btn btn-primary mx-auto'
        },
        buttonsStyling: false
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('admin.travel-packages.index') }}"; // Chuyển hướng đến trang danh sách chuyến đi
            }
        });
    }
</script>

@endsection

