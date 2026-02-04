@extends('admin.layout')

@section('content')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Quản lý Khách hàng</h3>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-stripped table-hover datatable">
                                <thead class="thead-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Tên Khách hàng</th>
                                        <th>Email</th>
                                        <th>Ngày tham gia</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>#{{ $user->id }}</td>
                                            <td>
                                                <div class="table-avatar">
                                                    <a href="#" style="font-size: 14px; font-weight: 600;">{{ $user->name }}</a>
                                                </div>
                                            </td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->created_at->format('d/m/Y') }}</td>
                                            <td class="text-end">
                                                <div class="actions">
                                                    <button type="button" class="btn btn-sm btn-primary me-2 edit-user-btn"
                                                        data-toggle="modal" data-target="#editUserModal"
                                                        data-action="{{ route('admin.usermanager.update', $user->id) }}"
                                                        data-name="{{ $user->name }}" data-email="{{ $user->email }}">
                                                        <i class="fas fa-edit"></i> Sửa
                                                    </button>
                                                    <form action="{{ route('admin.usermanager.destroy', $user->id) }}"
                                                        method="POST" class="d-inline"
                                                        onsubmit="return confirm('Bạn có chắc chắn muốn xóa khách hàng này?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            <i class="fas fa-trash-alt"></i> Xóa
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-center">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Edit User Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Chỉnh sửa thông tin khách hàng</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editUserForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="userName" class="form-label">Họ tên</label>
                            <input type="text" class="form-control" id="userName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="userEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="userEmail" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="userPassword" class="form-label">Mật khẩu mới (Để trống nếu không đổi)</label>
                            <input type="password" class="form-control" id="userPassword" name="password"
                                autocomplete="new-password" placeholder="Nhập mật khẩu mới...">
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var editButtons = document.querySelectorAll('.edit-user-btn');
            var editForm = document.getElementById('editUserForm');
            var nameInput = document.getElementById('userName');
            var passwordInput = document.getElementById('userPassword');

            editButtons.forEach(function (button) {
                button.addEventListener('click', function () {
                    var actionUrl = this.getAttribute('data-action');
                    var name = this.getAttribute('data-name');
                    var email = this.getAttribute('data-email');

                    editForm.action = actionUrl;
                    nameInput.value = name;
                    emailInput.value = email;
                    passwordInput.value = ''; // Xóa mật khẩu khi mở modal
                });
            });
        });
    </script>
@endsection