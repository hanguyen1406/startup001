@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Quản lý thư viện ảnh: {{ $travelPackage->name }}</h1>
            <a href="{{ route('admin.travel-packages.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
        </div>

        @if(session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <div class="row">
            <!-- Form Upload -->
            <div class="col-md-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Thêm ảnh mới</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.travel-packages.galleries.store', $travelPackage) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="path">Chọn ảnh (Có thể chọn nhiều)</label>
                                <input type="file" class="form-control" name="path[]" multiple required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Tải lên</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- List Images -->
            <div class="col-md-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Danh sách ảnh</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @forelse($galleries as $gallery)
                                <div class="col-md-4 mb-3">
                                    <div class="card">
                                        <img src="{{ Storage::url($gallery->path) }}" class="card-img-top"
                                            style="height: 150px; object-fit: cover;">
                                        <div class="card-body text-center">
                                            <form
                                                action="{{ route('admin.travel-packages.galleries.destroy', [$travelPackage, $gallery]) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Bạn có chắc chắn muốn xóa ảnh này?')">
                                                    <i class="fas fa-trash"></i> Xóa
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12 text-center text-muted">Chưa có ảnh nào.</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection