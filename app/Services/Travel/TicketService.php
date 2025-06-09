<?php

namespace App\Services\Travel;

use App\Models\TravelPackage;
use App\Models\Category; // Để tìm category ID
use App\Models\Order;
use App\Interfaces\TravelInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TicketService implements TravelInterface
{
    private $ticketCategoryId;

    public function __construct()
    {
        // Lấy ID của Category 'Ticket' hoặc tạo mới nếu chưa có
        $this->ticketCategoryId = Category::firstOrCreate(['title' => 'Ticket'])->id;
    }

    public function getViewData(?int $id = null)
    {
        $data = TravelPackage::with('galleries')->get();
        return $data;
    }
    public function detail(int $id) {
        $travelPackage = TravelPackage::where('id', $id)->first();
        if (!$travelPackage) {
            abort(404, 'Travel Package not found');
        }
        
        // dd($travelPackage);
        return $travelPackage;
    }
    public function order(Request $request, int $id){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'travel_date' => 'required|date',
            'count' => 'required|integer|min:1',
        ]);
    
        if ($validator->fails()) {
            return false;
        }
        $order = Order::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'travel_date' => $request->travel_date,
            'travel_id' => $id,
            'count' => $request->count
        ]);

        return true;
    }
    public function add(array $data)
    {
        return DB::transaction(function () use ($data) {
            $packageData = [
                'name' => $data['name'],
                'duration' => $data['duration'] ?? 'N/A', // Duration có thể không áp dụng trực tiếp cho Vé
                'location' => $data['location'],
                'description' => $data['description'],
                'price' => $data['price'],
                'category_id' => $this->ticketCategoryId,
                'details' => [ // Lưu thông tin đặc thù của vé vào cột JSON 'details'
                    'valid_from' => $data['valid_from'],
                    'valid_to' => $data['valid_to'],
                    'quantity_available' => $data['quantity_available'] ?? 0,
                ],
            ];
            // $package = TravelPackage::create($packageData);

            $slug = Str::slug($data['name']);        
            TravelPackage::create($request->validated() + ["slug" => $slug]);

            // $this->handleGalleries($package, $data);

            return $package;
        });
    }

    public function edit(int $id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $package = TravelPackage::where('category_id', $this->ticketCategoryId)->find($id);
            if (!$package) {
                return null;
            }

            $packageData = [
                'name' => $data['name'],
                'duration' => $data['duration'] ?? 'N/A',
                'location' => $data['location'],
                'description' => $data['description'],
                'price' => $data['price'],
                'category_id' => $this->ticketCategoryId, // Đảm bảo giữ nguyên category_id
                'details' => [ // Cập nhật thông tin đặc thù của vé
                    'valid_from' => $data['valid_from'],
                    'valid_to' => $data['valid_to'],
                    'quantity_available' => $data['quantity_available'] ?? 0,
                ],
            ];
            $package->update($packageData);

            $this->handleGalleries($package, $data);

            return $package;
        });
    }

    public function delete(int $id): bool
    {
        return DB::transaction(function () use ($id) {
            $package = TravelPackage::where('category_id', $this->ticketCategoryId)->find($id);
            if (!$package) {
                return false;
            }

            // Xóa tất cả ảnh gallery liên quan trước
            foreach ($package->galleries as $gallery) {
                Storage::disk('public')->delete($gallery->path);
                $gallery->delete();
            }

            return $package->delete();
        });
    }

    /**
     * Helper method để xử lý lưu và xóa ảnh gallery.
     */
    protected function handleGalleries(TravelPackage $package, array $data): void
    {
        // Thêm ảnh mới
        if (isset($data['galleries']) && is_array($data['galleries'])) {
            foreach ($data['galleries'] as $file) {
                if ($file && $file->isValid()) {
                    $path = $file->store('assets/gallery', 'public');
                    $package->galleries()->create(['path' => $path]);
                }
            }
        }

        // Xóa ảnh cũ
        if (isset($data['deleted_gallery_ids']) && is_array($data['deleted_gallery_ids'])) {
            $galleriesToDelete = $package->galleries()->whereIn('id', $data['deleted_gallery_ids'])->get();
            foreach ($galleriesToDelete as $gallery) {
                Storage::disk('public')->delete($gallery->path); // Xóa file vật lý
                $gallery->delete(); // Xóa khỏi DB
            }
        }
    }
}