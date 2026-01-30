<?php

namespace App\Http\Controllers\Admin;

use App\Models\Gallery;
use App\Models\TravelPackage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StoreGalleryRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(TravelPackage $travelPackage): View
    {
        $galleries = $travelPackage->galleries;
        return view('admin.galleries.index', compact('travelPackage', 'galleries'));
    }

    public function store(StoreGalleryRequest $request, TravelPackage $travelPackage): RedirectResponse
    {
        if ($request->hasFile('path')) {
            $files = $request->file('path');
            // Check if it's a single file or array (handle multiple)
            if (!is_array($files)) {
                $files = [$files];
            }

            foreach ($files as $file) {
                $path = $file->store('assets/gallery', 'public');
                $travelPackage->galleries()->create(['path' => $path]);
            }
        }

        return redirect()->route('admin.travel-packages.galleries.index', $travelPackage)->with('message', 'Added Successfully !');
    }

    public function edit(TravelPackage $travelPackage, Gallery $gallery): View
    {
        return view('admin.galleries.edit', compact('travelPackage', 'gallery'));
    }

    public function update(StoreGalleryRequest $request, TravelPackage $travelPackage, Gallery $gallery): RedirectResponse
    {
        if ($request->path) {
            File::delete('storage/' . $gallery->path);
        }

        $data = $request->all();
        $data['path'] = $request->file('path')->store(
            'assets/gallery',
            'public'
        );
        $gallery->update($data);

        return redirect()->route('admin.travel-packages.edit', $travelPackage)->with('message', 'Updated Successfully !');
    }

    public function destroy(TravelPackage $travelPackage, Gallery $gallery): RedirectResponse
    {
        if ($gallery->path) {
            File::delete('storage/' . $gallery->path);
        }

        $gallery->delete();

        return redirect()->route('admin.travel-packages.galleries.index', $travelPackage)->with('message', 'Deleted Successfully !');
    }
}
