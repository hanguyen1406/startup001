<?php

namespace App\Interfaces;
use Illuminate\Http\Request;

interface TravelInterface
{
    /**
     * Lấy dữ liệu để hiển thị danh sách dịch vụ với bộ lọc.
     * @param array $filters Các tham số lọc (keyword, location, etc.).
     * @return mixed
     */
    public function getViewData(array $filters = []);

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