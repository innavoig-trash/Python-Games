<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use Illuminate\Http\Request;
use Intervention\Image\Image;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\File;
use Illuminate\Http\RedirectResponse;

use App\Http\Requests\StorePlantRequest;
use App\Http\Requests\UpdatePlantRequest;


class PlantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $plants = Plant::query()
            ->when($request->query('search'), function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->paginate(12);

        return view('dashboard.plants.index', compact('plants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('dashboard.plants.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePlantRequest $request): RedirectResponse
    {
        $plant = Plant::create($request->except('image'));

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $filename = time() . '.' . $image->getClientOriginalExtension();
            if (!File::exists(storage_path('storage/images'))) {
                File::makeDirectory(storage_path('storage/images'), $mode = 0777, true, true);
            }

            Image::class::make($image)->resize(1080, 1080)->save(storage_path('storage/images/') . $filename);
            $validated['image'] = 'storage/images/' . $filename;
            $plant->update($validated);
        }

        return redirect()->route('dashboard.plants.show', $plant)->with('success', 'Plant created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Plant $plant): View
    {
        return view('dashbaord.plants.show', compact('plant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plant $plant): View
    {
        return view('dashboard.plants.edit', compact('plant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePlantRequest $request, Plant $plant)
    {
        $plant->update($request->except('image'));

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $filename = time() . '.' . $image->getClientOriginalExtension();
            if (!File::exists(storage_path('storage/images'))) {
                File::makeDirectory(storage_path('storage/images'), $mode = 0777, true, true);
            }

            Image::class::make($image)->resize(1080, 1080)->save(storage_path('storage/images/') . $filename);
            $validated['image'] = 'storage/images/' . $filename;
            $plant->update($validated);
        }

        return redirect()->route('dashboard.plants.show', $plant)->with('success', 'Plant updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plant $plant)
    {
        $plant->delete();

        return redirect()->route('dashboard.plants.index')->with('success', 'Plant deleted successfully!');
    }
}
