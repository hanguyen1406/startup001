<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Models\TravelPackage;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreTravelPackageRequest;
use App\Models\Category;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class TravelPackageController extends Controller
{

    public function index(): View
    {
        $travelPackages = TravelPackage::with('category')->get();
        $categories = Category::all();

        return view('admin.travel-packages.index', compact('travelPackages', 'categories'));
    }

    public function create(): RedirectResponse
    {
        return redirect()->route('admin.travel-packages.index');
    }

    public function store(StoreTravelPackageRequest $request): RedirectResponse
    {
        DB::transaction(function () use ($request) {
            $slug = Str::slug($request->name);
            $travelPackage = TravelPackage::create($request->validated() + ["slug" => $slug]);
            $this->handleGalleries($travelPackage, $request->file('galleries'));
        });

        return redirect()->route('admin.travel-packages.index')->with('message', 'Added Successfully !');
    }

    public function edit(): RedirectResponse
    {
        return redirect()->route('admin.travel-packages.index');
    }

    public function update(StoreTravelPackageRequest $request, TravelPackage $travelPackage): RedirectResponse
    {
        DB::transaction(function () use ($request, $travelPackage) {
            $slug = Str::slug($request->name);
            $travelPackage->update($request->validated() + ["slug" => $slug]);
            $this->handleGalleries($travelPackage, $request->file('galleries'));
        });

        return redirect()->route('admin.travel-packages.index')->with('message', 'Updated Successfully !');
    }

    public function destroy(TravelPackage $travelPackage): RedirectResponse
    {
        DB::transaction(function () use ($travelPackage) {
            foreach ($travelPackage->galleries as $gallery) {
                Storage::delete($gallery->path);
                $gallery->delete();
            }
            $travelPackage->delete();
        });

        return redirect()->route('admin.travel-packages.index')->with('message', 'Deleted Successfully');
    }

    protected function handleGalleries(TravelPackage $package, $files): void
    {
        if ($files && is_array($files)) {
            foreach ($files as $file) {
                if ($file && $file->isValid()) {
                    $path = $file->store('assets/gallery', 'public');
                    $package->galleries()->create(['path' => $path]);
                }
            }
        }
    }
}
