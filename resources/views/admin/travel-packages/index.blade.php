@extends('admin.layout')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800 font-weight-bold">Quản lý chuyến đi</h1>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="input-group" style="width: 300px;">
                <input type="text" class="form-control" placeholder="Tìm kiếm chuyến đi...">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>

            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createPackageModal">
                <i class="fas fa-plus"></i> Thêm chuyến đi
            </button>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered text-center">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>ID</th>
                        <th>Tên chuyến đi</th>

                        <th>Điểm đến</th>
                        <th>Điểm khởi hành</th>
                        <th>Thời gian</th>

                        <th>Giá</th>
                        <th>Thể loại vé</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($travelPackages as $package)
                        <tr>
                            <td>{{ $package->id }}</td>
                            <td>{{ $package->name }}</td>

                            <td>{{ $package->location }}</td>
                            <td>{{ $package->departure }}</td>
                            <td>{{ $package->duration }}</td>
                            <td>{{ number_format($package->price) }}đ</td>
                            <td>{{ $package->category ? $package->category->title : 'N/A' }}</td>
                            <td>
                                <a href="{{ route('admin.travel-packages.galleries.index', $package->id) }}"
                                    class="btn btn-sm btn-info me-2">
                                    <i class="fas fa-images"></i> Ảnh
                                </a>
                                <button type="button" class="btn btn-sm btn-primary me-2 edit-package-btn" data-toggle="modal"
                                    data-target="#editPackageModal"
                                    data-action="{{ route('admin.travel-packages.update', $package->id) }}"
                                    data-name="{{ $package->name }}" data-location="{{ $package->location }}"
                                    data-departure="{{ $package->departure }}" data-duration="{{ $package->duration }}"
                                    data-price="{{ $package->price }}" data-description="{{ $package->description }}"
                                    data-category-id="{{ $package->category_id }}">
                                    <i class="fas fa-edit"></i> Sửa
                                </button>

                                <form action="{{ route('admin.travel-packages.destroy', $package->id) }}" method="POST"
                                    class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger delete-btn">
                                        <i class="fas fa-trash-alt"></i> Xóa
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Create Package Modal -->
    <div class="modal fade" id="createPackageModal" tabindex="-1" role="dialog" aria-labelledby="createPackageModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createPackageModalLabel">Thêm mới chuyến đi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.travel-packages.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="createName" class="form-label">Tên chuyến đi</label>
                                <input type="text" class="form-control" id="createName" name="name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="createLocation" class="form-label">Điểm đến</label>
                                <input type="text" class="form-control" id="createLocation" name="location" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="createDuration" class="form-label">Thời gian (VD: 3 ngày 2 đêm)</label>
                                <input type="text" class="form-control" id="createDuration" name="duration" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="createPrice" class="form-label">Giá (VNĐ)</label>
                                <input type="text" class="form-control price-input" id="createPrice" name="price" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="createDeparture" class="form-label">Điểm khởi hành</label>
                                <input type="text" class="form-control" id="createDeparture" name="departure" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="createCategory" class="form-label">Chọn thể loại vé</label>
                                <select class="form-control" id="createCategory" name="category_id" required>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="createGalleries" class="form-label">Hình ảnh</label>
                            <input type="file" class="form-control" id="createGalleries" name="galleries[]" multiple>
                        </div>
                        <div class="mb-3">
                            <label for="createDescription" class="form-label">Mô tả</label>
                            <textarea class="form-control" id="createDescription" name="description" rows="4"
                                required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary">Thêm mới</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Package Modal -->
    <div class="modal fade" id="editPackageModal" tabindex="-1" role="dialog" aria-labelledby="editPackageModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPackageModalLabel">Chỉnh sửa thông tin chuyến đi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editPackageForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="packageName" class="form-label">Tên chuyến đi</label>
                                <input type="text" class="form-control" id="packageName" name="name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="packageLocation" class="form-label">Điểm đến</label>
                                <input type="text" class="form-control" id="packageLocation" name="location" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="packageDuration" class="form-label">Thời gian (VD: 3 ngày 2 đêm)</label>
                                <input type="text" class="form-control" id="packageDuration" name="duration" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="packagePrice" class="form-label">Giá (VNĐ)</label>
                                <input type="text" class="form-control price-input" id="packagePrice" name="price" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="packageDeparture" class="form-label">Điểm khởi hành</label>
                                <input type="text" class="form-control" id="packageDeparture" name="departure" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="packageCategory" class="form-label">Chọn thể loại vé</label>
                                <select class="form-control" id="packageCategory" name="category_id" required>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="packageGalleries" class="form-label">Hình ảnh (Chọn để thay đổi/thêm mới)</label>
                            <input type="file" class="form-control" id="packageGalleries" name="galleries[]" multiple>
                        </div>
                        <div class="mb-3">
                            <label for="packageDescription" class="form-label">Mô tả</label>
                            <textarea class="form-control" id="packageDescription" name="description" rows="4"
                                required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Handle Edit Button Click
            var editButtons = document.querySelectorAll('.edit-package-btn');
            var editForm = document.getElementById('editPackageForm');
            var nameInput = document.getElementById('packageName');
            var locationInput = document.getElementById('packageLocation');
            var departureInput = document.getElementById('packageDeparture');
            var durationInput = document.getElementById('packageDuration');
            var priceInput = document.getElementById('packagePrice');
            var descriptionInput = document.getElementById('packageDescription');
            var categoryInput = document.getElementById('packageCategory');

            editButtons.forEach(function (button) {
                button.addEventListener('click', function () {
                    var actionUrl = this.getAttribute('data-action');
                    editForm.action = actionUrl;

                    nameInput.value = this.getAttribute('data-name');

                    locationInput.value = this.getAttribute('data-location');
                    departureInput.value = this.getAttribute('data-departure');
                    durationInput.value = this.getAttribute('data-duration');
                    priceInput.value = this.getAttribute('data-price');
                    formatCurrency(priceInput); // Format immediately
                    descriptionInput.value = this.getAttribute('data-description');
                    categoryInput.value = this.getAttribute('data-category-id');
                });
            });

            // Handle Delete Confirmation
            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function (e) {
                    e.preventDefault();
                    var form = this.closest('form');

                    Swal.fire({
                        title: 'Xác nhận xóa',
                        text: 'Bạn có chắc chắn muốn xóa chuyến đi này?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Xóa',
                        cancelButtonText: 'Hủy'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
            // Format Currency Function
            function formatCurrency(input) {
                // Remove non-numeric chars
                let value = input.value.replace(/\D/g, "");
                // Format with commas
                value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                input.value = value;
            }

            // Apply formatting to price inputs
            document.querySelectorAll('.price-input').forEach(function (input) {
                input.addEventListener('input', function () {
                    formatCurrency(this);
                });
            });

            // Clean price before submit for Create Form
            var createForm = document.querySelector('form[action="{{ route('admin.travel-packages.store') }}"]');
            if (createForm) {
                createForm.addEventListener('submit', function (e) {
                    var priceInput = document.getElementById('createPrice');
                    priceInput.value = priceInput.value.replace(/,/g, '');
                });
            }

            // Clean price before submit for Edit Form
            if (editForm) {
                editForm.addEventListener('submit', function (e) {
                    var priceInput = document.getElementById('packagePrice');
                    priceInput.value = priceInput.value.replace(/,/g, '');
                });
            }
        });
    </script>
@endsection