<?php

namespace App\Interfaces;
use Illuminate\Http\Request;

interface TravelInterface
{
    /**
     * Lấy dữ liệu để hiển thị (ví dụ: danh sách hoặc chi tiết một dịch vụ).
     * @param int|null $id ID của dịch vụ cụ thể, hoặc null để lấy tất cả.
     * @return mixed
     */
    public function getViewData(?int $id = null);

    public function detail(int $id);

    /**
     * Thêm một dịch vụ mới.
     * @param array $data Dữ liệu của dịch vụ.
     * @return mixed
     */
    public function add(array $request);
    public function order(Request $request, int $id);
    /**
     * Chỉnh sửa thông tin một dịch vụ.
     * @param int $id ID của dịch vụ cần sửa.
     * @param array $data Dữ liệu cập nhật.
     * @return mixed
     */
    public function edit(int $id, array $data);

    /**
     * Xóa một dịch vụ.
     * @param int $id ID của dịch vụ cần xóa.
     * @return bool
     */
    public function delete(int $id): bool;
}