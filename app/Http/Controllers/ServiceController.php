<?php

namespace App\Http\Controllers;

use App\Factories\TravelFactory;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ServiceController extends Controller
{
    /**
     * Hiển thị danh sách hoặc chi tiết dịch vụ.
     */
    public function index(string $type)
    {
        $serviceHandler = TravelFactory::create($type);
        if (!$serviceHandler) {
            abort(404, 'Loại dịch vụ không tồn tại.');
        }

        $data = $serviceHandler->getViewData(request()->all());
        //dd(request()->all());

        // if (!$data) {
        //     abort(404, 'Dịch vụ không tìm thấy.');
        // }

        // Trả về view phù hợp dựa trên loại dịch vụ và dữ liệu

        if ($type == 'travel') {
            $categories = Category::all();
            return view("{$type}.all", compact('data', 'categories'));
        }

        return view("{$type}.all", compact('data'));
    }

    public function detail(string $type, int $id)
    {
        $serviceHandler = TravelFactory::create($type);
        if (!$serviceHandler) {
            abort(404, 'Loại dịch vụ không tồn tại.');
        }

        $data = $serviceHandler->detail($id);
        return view("{$type}.detail", compact('data'));
    }

    /**
     * Hiển thị form thêm dịch vụ mới.
     */
    public function create(string $type)
    {
        // Kiểm tra loại dịch vụ có hợp lệ không
        if (!TravelServiceFactory::create($type)) {
            abort(404, 'Loại dịch vụ không tồn tại.');
        }
        $categories = Category::get();

        return view("admin.{$type}.create", compact('type', 'categories'));
    }

    public function order(Request $request, string $type, int $id)
    {
        $serviceHandler = TravelFactory::create($type);

        if (!$serviceHandler) {
            return back()->with('error', 'Loại dịch vụ không hợp lệ.');
        }

        // Validate dữ liệu. Sử dụng quy tắc cụ thể cho từng loại dịch vụ.

        $serviceHandler->order($request, $id);

        return redirect()->route('service.detail', ['type' => $type, 'id' => $id])->with('message', 'Thêm dịch vụ thành công!');
    }

    /**
     * Hiển thị form sửa dịch vụ.
     */
    public function edit(string $type, int $id)
    {
        $serviceHandler = TravelServiceFactory::create($type);

        if (!$serviceHandler) {
            abort(404, 'Loại dịch vụ không tồn tại.');
        }

        $data = $serviceHandler->getViewData($id); // Lấy dữ liệu để đổ vào form

        if (!$data) {
            abort(404, 'Dịch vụ không tìm thấy.');
        }

        return view("services.{$type}.edit", compact('data', 'type'));
    }

    /**
     * Cập nhật dịch vụ.
     */
    public function update(Request $request, string $type, int $id)
    {
        $serviceHandler = TravelServiceFactory::create($type);

        if (!$serviceHandler) {
            return back()->with('error', 'Loại dịch vụ không hợp lệ.');
        }

        // Validate dữ liệu. Sử dụng quy tắc cụ thể cho từng loại dịch vụ.
        $rules = $this->getValidationRules($type, $id);
        $request->validate($rules);

        $serviceHandler->editService($id, $request->all());

        return redirect()->route('services.index', $type)->with('success', 'Cập nhật dịch vụ thành công!');
    }

    /**
     * Xóa dịch vụ.
     */
    public function destroy(string $type, int $id)
    {
        $serviceHandler = TravelServiceFactory::create($type);

        if (!$serviceHandler) {
            return back()->with('error', 'Loại dịch vụ không hợp lệ.');
        }

        if ($serviceHandler->deleteService($id)) {
            return redirect()->route('services.index', $type)->with('success', 'Xóa dịch vụ thành công!');
        }
        return back()->with('error', 'Xóa dịch vụ thất bại.');
    }

    /**
     * Trả về các quy tắc validation dựa trên loại dịch vụ.
     */

}