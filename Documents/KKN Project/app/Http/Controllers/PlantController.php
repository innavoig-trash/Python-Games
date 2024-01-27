<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\File;
use Illuminate\Http\RedirectResponse;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

use App\Http\Requests\StorePlantRequest;
use App\Http\Requests\UpdatePlantRequest;
use Throwable;

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
            ->latest()
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
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();

            try {
                $manager = new ImageManager(new Driver());
                $image = $manager
                    ->read($image)
                    ->scaleDown(900, 900)
                    ->save(storage_path('app/public/plants/' . $filename));
            } catch (Throwable $th) {
                return redirect()
                    ->back()
                    ->with('error', 'Plant image is not valid!');
            }

            $request->merge([
                'image' => $filename
            ]);
        }

        $plant = Plant::create($request->all());

        return redirect()
            ->route('plants.show', $plant)
            ->with('success', 'Plant created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Plant $plant): View
    {
        return view('plants.show', compact('plant'));
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
        if ($request->hasFile('image')) {
            if (File::exists(storage_path('app/public/plants/' . $plant->image))) {
                File::delete(storage_path('app/public/plants/' . $plant->image));
            }

            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();

            try {
                $manager = new ImageManager(new Driver());
                $image = $manager
                    ->read($image)
                    ->scaleDown(900, 900)
                    ->save(storage_path('app/public/plants/' . $filename));
            } catch (Throwable $th) {
                return redirect()
                    ->back()
                    ->withErrors([
                        'image' => 'Plant image is not valid!'
                    ]);
            }

            $plant->update([
                'image' => $filename
            ]);
        }

        $plant->update($request->except('image'));

        return redirect()
            ->route('plants.show', $plant)
            ->with('success', 'Plant updated successfully!');
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
