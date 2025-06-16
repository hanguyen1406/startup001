@extends('admin.layout')

@section('content')
<div class="content container-fluid">
    <h3 class="mb-4">Cấu hình thông tin toàn</h3>
    <div class="row">
        <!-- Momo Section -->
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header">Momo</div>
                <div class="card-body">
                    <form id="momoForm">
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="momo_status" name="momo_status" value="1">
                            <label class="form-check-label" for="momo_status">Kích hoạt</label>
                        </div>
                        <div class="mb-3">
                            <label for="momo_partner_id" class="form-label">Partner ID</label>
                            <input type="text" class="form-control" id="momo_partner_id" name="momo_partner_id" value="0123456">
                        </div>
                        <div class="mb-3">
                            <label for="momo_access_key" class="form-label">Access Key</label>
                            <input type="text" class="form-control" id="momo_access_key" name="momo_access_key" value="ABCD56XYZ">
                        </div>
                        <div class="mb-3">
                            <label for="momo_secret_key" class="form-label">Secret Key</label>
                            <input type="text" class="form-control" id="momo_secret_key" name="momo_secret_key" value="ahii1234">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Lưu</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Chuyển khoản ngân hàng Section -->
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header">Chuyển khoản ngân hàng</div>
                <div class="card-body">
                    <form id="bankForm">
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="bank_status" name="bank_status" value="1">
                            <label class="form-check-label" for="bank_status">Kích hoạt</label>
                        </div>
                        <div class="mb-3">
                            <label for="bank_account_name" class="form-label">Tên ngân hàng</label>
                            <input type="text" class="form-control" id="bank_account_name" name="bank_account_name" value="Tên ngân hàng">
                        </div>
                        <div class="mb-3">
                            <label for="bank_account_number" class="form-label">Số tài khoản</label>
                            <input type="text" class="form-control" id="bank_account_number" name="bank_account_number" value="56 tài khoản">
                        </div>
                        <div class="mb-3">
                            <label for="bank_account_holder" class="form-label">Chủ tài khoản</label>
                            <input type="text" class="form-control" id="bank_account_holder" name="bank_account_holder" value="Chủ tài khoản">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Lưu</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- VNPay Section -->
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header">VNPay</div>
                <div class="card-body">
                    <form id="vnpayForm">
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="vnpay_status" name="vnpay_status" value="1">
                            <label class="form-check-label" for="vnpay_status">Kích hoạt</label>
                        </div>
                        <div class="mb-3">
                            <label for="vnpay_tmn_code" class="form-label">TmnCode</label>
                            <input type="text" class="form-control" id="vnpay_tmn_code" name="vnpay_tmn_code" value="TmnCode">
                        </div>
                        <div class="mb-3">
                            <label for="vnpay_hash_secret" class="form-label">Hash Secret</label>
                            <input type="text" class="form-control" id="vnpay_hash_secret" name="vnpay_hash_secret" value="Hash Secret">
                        </div>
                        <div class="mb-3">
                            <label for="vnpay_url" class="form-label">URL thanh toán</label>
                            <input type="text" class="form-control" id="vnpay_url" name="vnpay_url" value="URL thanh toán">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Lưu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('momoForm').addEventListener('submit', function(e) {
        e.preventDefault();
        Swal.fire({
            icon: 'success',
            text: 'Lưu thanh toán thành công!',
            position: 'top',
            showConfirmButton: true,
            confirmButtonText: 'OK',
            customClass: {
                popup: 'rounded',
                confirmButton: 'btn btn-success mx-auto'
            },
            buttonsStyling: false
        });
    });

    document.getElementById('bankForm').addEventListener('submit', function(e) {
        e.preventDefault();
        Swal.fire({
            icon: 'success',
           text: 'Lưu thanh toán thành công!',
            position: 'top',
            showConfirmButton: true,
            confirmButtonText: 'OK',
            customClass: {
                popup: 'rounded',
                confirmButton: 'btn btn-success mx-auto'
            },
            buttonsStyling: false
        });
    });

    document.getElementById('vnpayForm').addEventListener('submit', function(e) {
        e.preventDefault();
        Swal.fire({
            icon: 'success',
            text: 'Lưu thanh toán thành công!',
            position: 'top',
            showConfirmButton: true,
            confirmButtonText: 'OK',
            customClass: {
                popup: 'rounded',
                confirmButton: 'btn btn-success mx-auto'
            },
            buttonsStyling: false
        });
    });
</script>
@endsection